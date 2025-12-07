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

    public function actionSendOtp()
    {
        try {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $request = Yii::$app->request;
            $phone = $request->post('phone_number');

            if (empty($phone)) {
                Yii::error("SendOTP: Phone number missing");
                return ['status' => 'error', 'message' => 'Phone number is required'];
            }

            // Generate OTP
            $otp = rand(100000, 999999);
            $expiry = time() + 300; // 5 minutes

            // Store OTP in DB
            $connection = Yii::$app->db;
            $connection->createCommand()->insert('otp_store', [
                'phone' => $phone,
                'otp' => $otp,
                'expiry' => $expiry,
                'is_verified' => 0,
                'created_at' => time()
            ])->execute();
            
            Yii::info("SendOTP: OTP generated for $phone: $otp");

            // Send OTP via Fast2SMS
            $res = $this->sendFast2Sms($phone, $otp);

            if ($res) {
                Yii::info("SendOTP: SMS sent successfully to $phone");
                return ['status' => 'success', 'message' => 'OTP sent successfully'];
            } else {
                Yii::error("SendOTP: SMS failed for $phone");
                return ['status' => 'error', 'message' => 'Failed to send OTP'];
            }
        } catch (\Exception $e) {
            Yii::error("SendOTP Exception: " . $e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function actionVerifyOtp()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $phone = $request->post('phone_number');
        $otp = $request->post('entered_otp');
        
        if (empty($phone) || empty($otp)) {
            return ['status' => 'error', 'message' => 'Phone and OTP are required'];
        }

        // Verify OTP
        $otpRecord = (new \yii\db\Query())
            ->select('*')
            ->from('otp_store')
            ->where(['phone' => $phone, 'otp' => $otp, 'is_verified' => 0])
            ->andWhere(['>', 'expiry', time()])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        if ($otpRecord) {
            // Mark OTP as verified
            Yii::$app->db->createCommand()
                ->update('otp_store', ['is_verified' => 1], ['id' => $otpRecord['id']])
                ->execute();

            // Find or Create User
            $user = User::findByPhone($phone);
            if (!$user) {
                $user = new User();
                $user->phone = $phone;
                $user->save();
            }

            // Generate JWT
            $key = 'happyvalley_secret_key'; // Should be in config
            $payload = [
                'iss' => 'http://gohappyvalley.com',
                'aud' => 'http://gohappyvalley.com',
                'iat' => time(),
                'exp' => time() + (60 * 60 * 24 * 30), // 30 days
                'sub' => $user->id
            ];
            $jwt = JWT::encode($payload, $key, 'HS256');

            return ['status' => 'verified', 'user_token' => $jwt];
        } else {
            return ['status' => 'failed', 'message' => 'Invalid or expired OTP'];
        }
    }

    private function sendFast2Sms($phone, $otp)
    {
        $apiKey = 'RSyJt9aO7pfXx05sUqwDW4IiYQ3bECGNVKHLTuvncA6zgeZ1kmpTbhaQs8Hy2ZLOBMDFlJY4R96SoiIq';
        $message = "Your OTP is: $otp"; 
        
        // Fast2SMS API (Bulk V2)
        $url = "https://www.fast2sms.com/dev/bulkV2";
        // Using route 'q' (Quick) for generic content as no DLT template ID was provided for Login
        $data = [
            'message' => $message,
            'language' => 'english',
            'route' => 'q', 
            'numbers' => $phone,
        ];

        // Use CURL with robust options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "authorization: $apiKey"
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // As requested implicitly by robustness needs
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $json = json_decode($response, true);
        Yii::info("Fast2SMS Response: " . $response, 'sms');
        
        return isset($json['return']) && $json['return'] == true;
    }
}
