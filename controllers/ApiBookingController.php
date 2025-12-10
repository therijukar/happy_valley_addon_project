<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Booking;
use app\models\User;
use app\models\Payments;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Razorpay\Api\Api;

class ApiBookingController extends Controller
{
    public $enableCsrfValidation = false;

    private function getAuthenticatedUser()
    {
        $headers = Yii::$app->request->headers;
        $authHeader = $headers->get('Authorization');

        if ($authHeader && preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
            $token = $matches[1];
            try {
                $key = 'happyvalley_secret_key'; // Config
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                return User::findOne($decoded->sub);
            } catch (\Exception $e) {
                return null;
            }
        }
        return null;
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $user = $this->getAuthenticatedUser();

        if (!$user) {
            Yii::$app->response->statusCode = 401;
            return ['status' => 'error', 'message' => 'Unauthorized'];
        }

        $request = Yii::$app->request;
        $params = $request->bodyParams;
        
        $model = new Booking();
        $model->name = $params['name'] ?? $user->phone; // Allow name update
        $model->phone = $user->phone;
        $model->email = $params['email'] ?? null;
        $model->user_id = $user->id;
        $model->product = $params['product'] ?? null;
        $model->date = $params['date'] ?? null;
        
        // Enforce No Same-Day Booking
        if ($model->date <= date('Y-m-d')) {
             return ['status' => 'error', 'message' => 'Same-day booking is not allowed. Please select a future date.'];
        }
        
        // Detailed counts
        $model->belowtenyears = $params['belowtenyears'] ?? 0;
        $model->abovetenyears = $params['abovetenyears'] ?? 0;
        
        // Auto-update user profile if empty
        $profileUpdated = false;
        if(empty($user->full_name) && !empty($model->name)) {
             $user->full_name = $model->name;
             $profileUpdated = true;
        }
        if(empty($user->email_id) && !empty($model->email)) {
             $user->email_id = $model->email;
             $profileUpdated = true;
        }
        if($profileUpdated) {
             $user->save();
        }
        
        // Calculate total units if not provided (for Water World logic)
        if ($model->product == '8' || $model->product == '9') { // Water World or Combo
             $model->no_of_units = $model->belowtenyears + $model->abovetenyears;
        } else {
             $model->no_of_units = $params['unit'] ?? 1;
        }

        $model->amount = $params['amount'] ?? 0;
        $model->created_date = date('Y-m-d H:i:s');
        $model->type = '0'; // Mobile
        $model->status = 0; // Pending Payment

        if ($model->validate()) {
            try {
                if(!$model->save()) {
                    file_put_contents('debug_log.txt', print_r($model->errors, true), FILE_APPEND);
                    return ['status' => 'error', 'message' => 'DB Save Failed'];
                }
                
                // Create Payments record
                $payment = new Payments();
                $payment->booking_id = $model->id;
                $payment->amount = $model->amount;
                if(!$payment->save()) {
                     file_put_contents('debug_log.txt', "Payment Save Failed: " . print_r($payment->errors, true), FILE_APPEND);
                }
    
                // Generate Ticket Number (to be confirmed by webhook)
                $num = rand(1000,9999);
                $string = '';
                for ($i=0; $i < 5; $i++) { 
                     $string = $string.chr(rand(65,90));
                }
                $ticket = $string.(string)($num);
    
                // Razorpay Order Creation
                $keyId = 'rzp_live_JnKcmAb28MNsO6';
                $keySecret = 'E07BXooQBUw0ohmVBegkRZ22';
                $razorpay = new Api($keyId, $keySecret);
    
                $orderData = [
                    'receipt' => (string)$model->id,
                    'amount' => $model->amount * 100, // paise
                    'currency' => 'INR',
                    'payment_capture' => 1,
                    'notes' => [
                        'booking_metadata' => json_encode([
                            'booking_id' => $model->id,
                            'ticket_no' => $ticket
                        ])
                    ]
                ];
    
                $razorpayOrder = $razorpay->order->create($orderData);
                
                return [
                    'status' => 'initiated',
                    'order_id' => $razorpayOrder['id'],
                    'key_id' => $keyId, // useful for client
                    'amount' => $model->amount,
                    'currency' => 'INR',
                    'booking_id' => $model->id,
                    'customer' => [
                        'name' => $model->name,
                        'phone' => $model->phone,
                        'email' => $model->email
                    ]
                ];
            } catch (\Exception $e) {
                file_put_contents('debug_log.txt', "Exception: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n", FILE_APPEND);
                Yii::error("Razorpay Error: " . $e->getMessage());
                return ['status' => 'error', 'message' => 'Payment initiation failed: ' . $e->getMessage()];
            }
        } else {
            file_put_contents('debug_log.txt', "Validation Failed: " . print_r($model->errors, true), FILE_APPEND);
            return ['status' => 'error', 'message' => 'Validation failed', 'errors' => $model->errors];
        }
    }

    public function actionVerify()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $user = $this->getAuthenticatedUser();

        if (!$user) {
            Yii::$app->response->statusCode = 401;
            return ['status' => 'error', 'message' => 'Unauthorized'];
        }

        $request = Yii::$app->request;
        $orderId = $request->post('razorpay_order_id');
        $paymentId = $request->post('razorpay_payment_id');
        $signature = $request->post('razorpay_signature');
        $bookingId = $request->post('booking_id');

        // Verify Signature
        $keySecret = 'E07BXooQBUw0ohmVBegkRZ22'; // Hardcoded as in Create
        $generatedSignature = hash_hmac('sha256', $orderId . "|" . $paymentId, $keySecret);

        if ($generatedSignature == $signature) {
            // Update Booking Status
            $booking = Booking::findOne($bookingId);
            if ($booking && $booking->user_id == $user->id) {
                $booking->status = 1; // Paid/Confirmed
                // Ensure ticket number is set if not already (it was set in create, but verifying)
                if (empty($booking->ticket_no)) {
                     $num = rand(1000,9999);
                     $string = '';
                     for ($i=0; $i < 5; $i++) { $string .= chr(rand(65,90)); }
                     $booking->ticket_no = $string.$num;
                }
                $booking->save();
                
                // Update Payment Record
                $payment = Payments::findOne(['booking_id' => $bookingId]);
                if($payment) {
                    $payment->txn_id = $paymentId;
                    $payment->status = 'success';
                    $payment->save();
                }

                return ['status' => 'success', 'message' => 'Payment verified and Ticket generated', 'ticket_no' => $booking->ticket_no];
            }
            return ['status' => 'error', 'message' => 'Booking not found or access denied'];
        } else {
            return ['status' => 'error', 'message' => 'Invalid Signature'];
        }
    }

    public function actionHistory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $user = $this->getAuthenticatedUser();

        if (!$user) {
            Yii::$app->response->statusCode = 401;
            return ['status' => 'error', 'message' => 'Unauthorized'];
        }

        $bookings = Booking::find()
            ->where(['user_id' => $user->id])
            // Filter by active status if needed, or show all. 
            // Assuming status 1 is paid.
            ->andWhere(['status' => 1]) 
            ->orderBy(['id' => SORT_DESC])
            ->all();

        $result = [];
        foreach ($bookings as $booking) {
            $result[] = [
                'booking_id' => $booking->id,
                'ticket_no' => $booking->ticket_no,
                'product' => $booking->product,
                'amount' => $booking->amount,
                'date' => $booking->date,
                'qr_code_url' => "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . rawurlencode(json_encode(['booking_id'=>$booking->id, 'ticket'=>$booking->ticket_no]))
            ];
        }

        return ['status' => 'success', 'tickets' => $result];
    }

    public function actionProfile()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $user = $this->getAuthenticatedUser();
        if ($user) {
            return ['status' => 'success', 'user' => [
                'phone' => $user->phone,
                'full_name' => $user->full_name,
                'email_id' => $user->email_id,
            ]];
        }
        return ['status' => 'error', 'message' => 'User not found'];
    }

    public function actionPricing()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $pricing = \app\models\Pricing::find()->all();
        return ['status' => 'success', 'pricing' => $pricing];
    }
}
