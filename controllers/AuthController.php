<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public $enableCsrfValidation = false;

    // --- LOGIN FLOW ---

    public function actionSendLoginOtp()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $phone = Yii::$app->request->post('phone_number');

        if (empty($phone)) return ['status' => 'error', 'message' => 'Phone number is required'];

        $user = User::findByPhone($phone);
        if (!$user) {
            return ['status' => 'error', 'message' => 'User not found. Please Sign Up first.'];
        }

        return $this->processSendOtp($phone);
    }

    public function actionVerifyLoginOtp()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $phone = Yii::$app->request->post('phone_number');
        $otp = Yii::$app->request->post('entered_otp');
        
        if (empty($phone) || empty($otp)) return ['status' => 'error', 'message' => 'Phone and OTP are required'];

        if ($this->verifyOtpInternal($phone, $otp)) {
            $user = User::findByPhone($phone);
            if ($user) {
                return ['status' => 'verified', 'user_token' => $this->generateJwt($user->id)];
            }
        }
        return ['status' => 'error', 'message' => 'Invalid OTP'];
    }

    // --- SIGNUP FLOW ---

    public function actionSendSignupOtp()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $phone = Yii::$app->request->post('phone_number');

        if (empty($phone)) return ['status' => 'error', 'message' => 'Phone number is required'];

        $user = User::findByPhone($phone);
        if ($user) {
            return ['status' => 'error', 'message' => 'User already exists. Please Login.'];
        }

        return $this->processSendOtp($phone);
    }

    public function actionRegister() 
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $phone = $request->post('phone');
        $otp = $request->post('otp');
        $name = $request->post('name');
        $email = $request->post('email');

        if (empty($phone) || empty($otp) || empty($name)) {
            return ['status' => 'error', 'message' => 'Missing required fields'];
        }

        if ($this->verifyOtpInternal($phone, $otp)) {
            // Check existence again just in case
            if (User::findByPhone($phone)) {
                 return ['status' => 'error', 'message' => 'User already exists'];
            }

            $user = new User();
            $user->phone = $phone;
            $user->full_name = $name;
            $user->email_id = $email;
            
            // Handle Referral
            $refCode = $request->post('referral_code');
            if (!empty($refCode)) {
                $referrer = User::findOne(['referral_code' => $refCode]);
                if ($referrer) {
                    $user->referred_by = $referrer->id;
                }
            }
            
            // Generate own referral code
            $user->generateReferralCode();

            if ($user->save()) {
                return ['status' => 'success', 'user_token' => $this->generateJwt($user->id)];
            } else {
                return ['status' => 'error', 'message' => 'Registration failed: ' . json_encode($user->errors)];
            }
        }
        return ['status' => 'error', 'message' => 'Invalid OTP'];
    }

    // --- HELPERS ---

    private function processSendOtp($phone)
    {
        try {
            $otp = rand(100000, 999999);
            $expiry = time() + 300; 

            Yii::$app->db->createCommand()->insert('otp_store', [
                'phone' => $phone, 'otp' => $otp, 'expiry' => $expiry, 'is_verified' => 0, 'created_at' => time()
            ])->execute();
            
            Yii::info("SendOTP: OTP generated for $phone: $otp");
            $res = $this->sendFast2Sms($phone, $otp);

            if ($res) return ['status' => 'success', 'message' => 'OTP sent successfully']; //, 'otp_dev' => $otp]; // remove dev otp in prod
            else return ['status' => 'error', 'message' => 'Failed to send OTP'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    private function verifyOtpInternal($phone, $otp)
    {
        $otpRecord = (new \yii\db\Query())
            ->from('otp_store')
            ->where(['phone' => $phone, 'otp' => $otp, 'is_verified' => 0])
            ->andWhere(['>', 'expiry', time()])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        if ($otpRecord) {
            Yii::$app->db->createCommand()
                ->update('otp_store', ['is_verified' => 1], ['id' => $otpRecord['id']])
                ->execute();
            return true;
        }
        return false;
    }

    private function generateJwt($userId) 
    {
        $key = 'happyvalley_secret_key'; 
        $payload = [
            'iss' => 'http://gohappyvalley.com',
            'aud' => 'http://gohappyvalley.com',
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24 * 30), 
            'sub' => $userId
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    private function sendFast2Sms($phone, $otp)
    {
        $apiKey = 'RSyJt9aO7pfXx05sUqwDW4IiYQ3bECGNVKHLTuvncA6zgeZ1kmpTbhaQs8Hy2ZLOBMDFlJY4R96SoiIq';
        
        // Fast2SMS API (Bulk V2) with DLT parameters
        // URL: https://www.fast2sms.com/dev/bulkV2?authorization=...&route=dlt&sender_id=RYLTHR&message=167170&variables_values=1234&flash=0&numbers=...
        $url = "https://www.fast2sms.com/dev/bulkV2";
        
        $data = [
            'authorization' => $apiKey,
            'route' => 'dlt',
            'sender_id' => 'RYLTHR',
            'message' => '167170',
            'variables_values' => $otp, // Variable for the OTP in the template
            'flash' => 0,
            'numbers' => $phone,
        ];

        // Use CURL
        $ch = curl_init();
        // Determine URL with query params
        $urlWithParams = $url . '?' . http_build_query($data);
        
        curl_setopt($ch, CURLOPT_URL, $urlWithParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // The user request shows GET request format in the URL example provided
        curl_setopt($ch, CURLOPT_HTTPGET, true); 
        
        $response = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($response, true);
        Yii::info("Fast2SMS DLT Response ($phone): " . $response, 'sms');
        
        return isset($json['return']) && $json['return'] == true;
    }
}
