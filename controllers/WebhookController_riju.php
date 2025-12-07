<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\BadRequestHttpException;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use \app\models\Booking as Booking;
class WebhookController extends Controller
{
    public $enableCsrfValidation = false; // Disable CSRF for this action as it is triggered by external system

    public function actionHandle()
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;

        $webhookSecret = 'gohappyvalley'; // Set your webhook secret key
        $postData = file_get_contents('php://input');
        $headers = Yii::$app->request->headers;

        $signature = $headers->get('X-Razorpay-Signature');
        
        $keyId = 'rzp_live_JnKcmAb28MNsO6';
        $keySecret = 'E07BXooQBUw0ohmVBegkRZ22';

        $api = new Api($keyId, $keySecret);
        

         

        

        try {
            // $api->utility->verifyWebhookSignature($postData, $signature, $webhookSecret);

            $data = json_decode($postData, true);
          

          

            // $filePath = Yii::getAlias('@app/runtime/logs/webhook.log');
            
            // // Format the data as a string to be saved
            // $dataToSave = date('Y-m-d H:i:s') . " - " . print_r($data, true) . PHP_EOL;

            // // Append the data to the file
            // file_put_contents($filePath, $dataToSave, FILE_APPEND);

           
            if (in_array($data['event'], ['payment.captured', 'payment.failed'])) {
                
                
                $paymentId = $data['payload']['payment']['entity']['id'];
                $notes = $data['payload']['payment']['entity']['notes'];
                

             
                if (!empty($notes) && !empty($notes['booking_metadata'])) {
                    $bookingMetadata = json_decode($notes['booking_metadata'], true);
                   
                    if ($bookingMetadata && !empty($bookingMetadata['booking_id'])) {
                        $bookingId = $bookingMetadata['booking_id'];
                      
                        // Fetch the booking record
                        $booking = \app\models\Booking::findOne($bookingId);

                      
                        if ($booking) {
                            if ($data['event'] === 'payment.captured') {
                                

                              
                                if (empty($booking->ticket_no)) {
                                    // Generate ticket number and OTP
                                   
                                    $otp = rand(1000, 9999);
                                    
            
                                    $ticket  = $bookingMetadata['ticket_no'];
                                    // Assign values to booking
                                    $booking->ticket_no = $bookingMetadata['ticket_no'];
                                    $booking->otp = $otp;
            
                                    // Save booking with new ticket number and OTP
                                    $booking->save();
            
                                    // Prepare and send SMS
                                    $date = date('d/m/Y', strtotime($booking->date));
                                    $message = "$ticket|$date|$booking->no_of_units|$otp|";
                                    $phone = $booking->phone;
            
                                    // Normalize phone number format
                                    if (strpos($phone, '+91') === 0) {
                                        $phone = substr($phone, 3);
                                    } elseif (strpos($phone, '0') === 0) {
                                        $phone = substr($phone, 1);
                                    }
            
                                    $this->sendSms($phone, $message);
            
                                    // Send email if email is provided
                                    if (!empty($booking->email)) {
                                        $this->mailFire($bookingId);
                                    }
                                }
                            } elseif ($data['event'] === 'payment.failed') {
                                
                                // Clear ticket number and OTP
                                $booking->ticket_no = null;
                                $booking->otp = null;
                                $booking->save();
                            }
            
                            // Update the payment model with booking ID, status, and transaction ID
                            $payment = \app\models\Payments::findOne(['booking_id' => $bookingId]);
                            if ($payment) {
                                $payment->confirmation = $data['event'] === 'payment.captured' ? 1 : 0; // Update status based on event
                                $payment->payment_id = $paymentId;
                                $payment->txn_id = $paymentId;
                                $payment->save();
                            }
                        }
                    }
                }
            }

               

                Yii::info('Webhook processed successfully');

            return ['status' => 'success', 'message' => 'Webhook processed successfully'];
        } catch (SignatureVerificationError $e) {
            throw new BadRequestHttpException('Invalid signature: ' . $e->getMessage());
        }
    }

    public function sendSMS($numbers, $variables_values) {
        $apiKey = 'RSyJt9aO7pfXx05sUqwDW4IiYQ3bECGNVKHLTuvncA6zgeZ1kmpTbhaQs8Hy2ZLOBMDFlJY4R96SoiIq'; // Replace 'Your-API-Key' with your actual Fast2SMS API key
        $senderId = 'RYLTHR'; // Your sender ID
        $route = 'dlt'; // Route for sending the message (p for promotional, t for transactional)
        $postData = array(
            'sender_id' => $senderId,
            'message' => '169565',
            'language' => 'english',
            'route' => $route,
            'numbers' => $numbers,
            'variables_values' => $variables_values,
        );
    
        $url = 'https://www.fast2sms.com/dev/bulkV2';
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'authorization: ' . $apiKey,
            'content-type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }


    private function mailFire($booking_id)
    {
        $model = Booking::find()->where(['id' => $booking_id])->one();
        $subject = "Order Confirmation";
        $body = "<div style='width:600px;margin:0 auto 0;background:#ededed; font-family:arial;'>
    <a href=''> </a>
    <div style='padding:14px 0 12px; background:#2D5772; text-align:center;' >
        <img src='https://gohappyvalley.com/web/assets/images/logo.png' alt='' style='width:70px; margin:0 auto;'>
    </div>
	<div style='padding:32px 0 12px'>
        <!-- <img src='https://ci5.googleusercontent.com/proxy/iULdgEtpFw2O5A5wZaZMmloseXgoCwZE85uRAHmOT1Vn4WTACZCUopVQ3tDojpWzZDvpeYeaZ_2-J7L9GNO2SzAlXiWllwlQZZXGNLKOYwepFqh_qspS=s0-d-e1-ft#https://res.klook.com/image/upload/q_80/v1511508878/email/step-3.png' alt='' style='width:100%' class='CToWUd'> -->
    </div>
    <table style='width:100%;font-size:14px;line-height:17px;text-align:center' cellpadding='0' border='0' align='center'>
        <tbody><tr>
            <td style='width:25%'><p style='margin:0 auto;width:120px;font-weight:bold;color:#ff5722'>Order Placed</p></td>
            <span style='font-size: 60px;color:#ff5722;'>→</span>
            <td style='width:25%'><p style='margin:0 auto;width:120px;font-weight:bold;color:#ff5722'>Payment Successful</p></td>
            <span style='font-size: 60px;color:#ff5722;'>→</span>
            <td style='width:25%'><p style='margin:0 auto;width:120px;font-weight:bold;color:#ff5722'>Booking Confirmed</p></td>
        </tr>
    </tbody>
	</table>
    <div style='padding:30px 50px 0px;background:#ededed;font-size:14px;line-height:1.7'>
        <p style='margin-top:0;font-weight:bold;font-size:18px'>
            <b style='font-size:18px'>Hi , ".$model->name."</b><br>
        </p>
        <p>
            Your booking for <b>Ticket</b> to <b>Happy Valley Park</b> is confirmed. This is your ticket. Kindly bring this ticket with you to the park.
        </p>
        
        <div style='margin-top:30px;min-height:150px;display:table'>
            <img src='https://gohappyvalley.com/web/assets/images/video-img.jpg' alt='' style='width:120px;height:96px;margin-right:20px'>
            <div style='display:table-cell;vertical-align:top;width:360px;line-height:1.7;font-size:14px'>
                <b style='line-height:1.2;font-size:18px;font-weight:500;margin-bottom:8px;display:inline-block'>Ticket To Happy Valley Park</b><br>
                Name: ".$model->name." <br>
                    Date: ".date('d-M-Y', strtotime($model->date))." <br>
                    No Of People: ".$model->no_of_units." <br>
                    Ticket Number: <b>".$model->ticket_no."</b><br>
                    Otp: <b>".$model->otp."</b><br>
                <br>
            </div>
        </div>
    </div>
    <table style='background-image:url('https://ci6.googleusercontent.com/proxy/sPnmh3V0WliR2gdg0ilLbCqxIxea0F03_7YH24CK_sL_AyQMcXtksFay2e2yZsQ1v0mURcFd-prcASNcJwTNz3UhuWWtAotQGaNqVt1_n_AENXr2R-YiTIKI=s0-d-e1-ft#https://res.klook.com/image/upload/q_80/v1511432357/download_wttzdl.png')' width='100%' height='180px' cellspacing='0' cellpadding='0' border='0' align='center'>
        <tbody>
            <tr>
                <td valign='middle' align='center'>
                    <a style='margin-top:12px;text-decoration:none;background:#ff5722;color:#fff;padding:11px 30px;font-weight:bold;border-radius:2px;display:inline-block;font-size:16px' href='https://play.google.com/store/apps/details?id=happy.park.inwdaretech&hl=en' target='_blank'> Download App Now </a>
                </td>
            </tr>
        </tbody>
	</table>
</div>";
        $to=$model->email;
        $finalbody = $body;

        // $rand = rand(10000,999999);
        // $pdf = Yii::$app->pdf; // or new Pdf();
        // $mpdf = $pdf->api;
        // $mpdf->WriteHTML($this->renderPartial('ticket', ['model' => $model]));
        // $path =  $mpdf->Output('', 'S');
        $mail = Yii::$app->mailer->compose()
            ->setFrom(['booking@gohappyvalley.com' => 'Happy Valley Park'])
            ->setSubject($subject)
            ->setHtmlBody($finalbody);

        $mail->setTo($to)
             ->send();

    }
}
