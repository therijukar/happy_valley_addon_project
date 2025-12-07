<?php

namespace app\controllers;

use Yii;
use app\models\Booking;
use app\models\Payments;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\Util\GlobalUtilities;
use yii\helpers\Json;

class PaymentController extends \yii\web\Controller
{
    public function actionIndex($booking_id,$payment_id)
    {
    	$this->view->title = 'Happy Valley Park';
    	$this->layout = 'index';

        $booking = Booking::find()->where(['id' => $booking_id])->one();
        $payment = Payments::find()->where(['id' => $payment_id])->one();
        
        $MERCHANT_KEY = "rzp_test_Fe5zpss4xWlEbu";
        $SALT = "7HAukv5eMHbfDXMj9cTvFtU7";
        // Merchant Key and Salt as provided by Payu.

        //$PAYU_BASE_URL = "https://sandboxsecure.payu.in/_payment";   // For Sandbox Mode
        $PAYU_BASE_URL = "https://secure.payu.in";      // For Production Mode
        $surl = "https://gohappyvalley.com/payment/success";
        $furl = "https://gohappyvalley.com/payment/failure";
        
        $action = '';
        $amount = $booking->amount;
        $email = $booking->email;
        $name = $booking->name;
        $phone = $booking->phone;

        $product = json_encode(json_decode('[{"id":"'.$booking->id.'","description":"Happy Valley Park - Ticket","amount":"'.$booking->amount.'"}]'));

        // Generate random transaction id
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $hash = '';
        // Hash Sequence
        $hashSequence = $MERCHANT_KEY."|".$txnid."|".$amount."|".$product."|".$name."|".$email."||||||||||";

        $hashVarsSeq = explode('|', $hashSequence);
          $hash_string = '';  
        foreach($hashVarsSeq as $hash_var) {
          $hash_string .= isset($hash_var) ? $hash_var : '';
          $hash_string .= '|';
        }
        $hash_string .= $SALT;
        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAYU_BASE_URL . '/_payment';
        return $this->render('payment',['booking' => $booking, 'MERCHANT_KEY'=>$MERCHANT_KEY,'hash' => $hash, 'txnid' => $txnid,'name' => $name, 'phone' => $phone, 'amount' => $amount, 'email' => $email, 'product' => $product, 'action' => $action, 'surl' => $surl, 'furl' => $furl]);
    }
    
    public function actionSuccess()
    {
        $productinfo=$_POST["productinfo"];
        $amount_paid = $_POST['net_amount_debit'];
        $txn_id = $_POST['txnid'];
        $mode = $_POST['mode'];
        $status = $_POST['status'];
        $datetime = $_POST['addedon'];
        $pg_type = $_POST['PG_TYPE'];
        $error_msg = $_POST['error_Message'];
        $payment_id = $_POST['encryptedPaymentId'];
        $payu_money_id = $_POST['payuMoneyId'];
        $bank_ref_no = $_POST['bank_ref_num'];
        $firstname=$_POST["firstname"];
        $amount=$_POST["amount"];
        $posted_hash=$_POST["hash"];
        $key=$_POST["key"];
        $email=$_POST["email"];
        $salt="WO89iI4hUC";
        $user_ip = $_SERVER['REMOTE_ADDR'];

        $product = json_decode($productinfo,true);
        $booking_id = $product[0]['id'];
        
         //Creating A Ticket and Inserting Ticket Number to booking table
        $model = Booking::find()->where(['id' => $booking_id])->one();
        $num = rand(1000,9999);
        $string = '';
        for ($i=0; $i < 5; $i++) { 
            $string = $string.chr(rand(65,90));
        }
        $ticket = $string.(string)($num);
        $model->ticket_no = $ticket;
        $model->save();
        
        $payments = Payments::find()->where(['booking_id' => $booking_id])->one();
        if ($payments->amount == $amount_paid) {
            //Confirming hash
            $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txn_id.'|'.$key;
            $hash = hash("sha512", $retHashSeq);
            if ($hash === $posted_hash ) {
                $payments->amount_paid = $amount_paid;
                $payments->txn_id = $txn_id;
                $payments->mode = $mode;
                $payments->status = $status;
                $payments->datetime = $datetime;
                $payments->pg_type = $pg_type;
                $payments->error_msg = $error_msg;
                $payments->payment_id = $payment_id;
                $payments->payu_money_id = $payu_money_id;
                $payments->bank_ref_no = $bank_ref_no;
                $payments->user_ip = $user_ip;
                $payments->confirmation = 1;
                $payments->save();
                $this->mailFire($booking_id);
                $this->mailFireAdmin($booking_id);
            }
            else{
                return $this->failureError($error_msg);
            }
        }else{
            return $this->failureError($error_msg);
        }
    }

    public function actionFailure()
    {
        $productinfo=$_POST["productinfo"];
        $product = json_decode($productinfo,true);
        $error = $_POST['error_Message'];
        $txn_id = $_POST['txnid'];
        $booking_id = $product[0]['id'];
        $payments = Payments::find()->where(['booking_id' => $booking_id])->one();
        $payments->txn_id = $txn_id;
        $payments->error_msg = $error;
        $payments->save();
    }

    public function failureError($err)
    {
        $productinfo=$_POST["productinfo"];
        $product = json_decode($productinfo,true);
        $error = $_POST['error_Message'];
        $txn_id = $_POST['txnid'];
        $booking_id = $product[0]['id'];
        $payments = Payments::find()->where(['booking_id' => $booking_id])->one();
        $payments->txn_id = $txn_id;
        $payments->error_msg = $error;
        $payments->save();
    }
    
    private function mailFire($booking_id)
    {
        $model = Booking::find()->where(['id' => $booking_id])->one();
        $subject = "Order Confirmation";
        $qrPublicUrl = '';
        $qrFilePath = '';
        if (!empty($model->ticket_no)) {
            $qrPublicUrl = $this->generateQrImage($model);
            $qrFilePath = Yii::getAlias('@app').'/qrcodes/'.($model->ticket_no ? $model->ticket_no : ('booking_'.$model->id)).'.png';
        }
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
                        ".(!empty($qrPublicUrl) ? ("<div style='margin-top:12px'><img src='".$qrPublicUrl."' alt='Scan at entry' style='width:160px;height:160px;border:1px solid #ddd;padding:6px;border-radius:4px'></div>") : '')."
                <br>
            </div>
        </div>
    </div>
    <table style='background-image:url('https://ci6.googleusercontent.com/proxy/sPnmh3V0WliR2gdg0ilLbCqxIxea0F03_7YH24CK_sL_AyQMcXtksFay2e2yZsQ1v0mURcFd-prcASNcJwTNz3UhuWWtAotQGaNqVt1_n_AENXr2R-YiTIKI=s0-d-e1-ft#https://res.klook.com/image/upload/q_80/v1511432357/download_wttzdl.png')' width='100%' height='180px' cellspacing='0' cellpadding='0' border='0' align='center'>
        <tbody>
            <tr>
                <td valign='middle' align='center'>
                    <a href='https://play.google.com/store/apps/details?id=happy.park.inwdaretech&hl=en' style='margin-top:12px;text-decoration:none;background:#ff5722;color:#fff;padding:11px 30px;font-weight:bold;border-radius:2px;display:inline-block;font-size:16px'  target='_blank'> Download App Now </a>
                </td>
            </tr>
        </tbody>
	</table>
</div>";
        $to=$model->email;
        $finalbody = $body;

        //$rand = rand(10000,999999);
        // $pdf = Yii::$app->pdf; // or new Pdf();
        // $mpdf = $pdf->api;
        // $mpdf->WriteHTML($this->renderPartial('ticket', ['model' => $model]));
        // $path =  $mpdf->Output('', 'S');
        $mail = Yii::$app->mailer->compose()
            ->setFrom(['booking@gohappyvalley.com' => 'Happy Valley Park'])
            ->setSubject($subject)
            ->setHtmlBody($finalbody);
        if (!empty($qrFilePath) && file_exists($qrFilePath)) {
            $mail->attach($qrFilePath);
        }
        $mail->setTo($to)
             ->send();

    }

    private function generateQrImage($model)
    {
        $payload = Json::encode([
            'booking_id' => (int)$model->id,
            'ticket_no' => (string)$model->ticket_no,
        ]);
        $encoded = rawurlencode($payload);
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=".$encoded;
        $dir = Yii::getAlias('@app').'/qrcodes';
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }
        $filename = $model->ticket_no ? $model->ticket_no : ('booking_'.$model->id);
        $filePath = $dir.'/'.$filename.'.png';
        try {
            $img = @file_get_contents($qrUrl);
            if ($img !== false) {
                @file_put_contents($filePath, $img);
            }
        } catch (\Exception $e) {
        }
        $base = Yii::$app->request->hostInfo.Yii::$app->request->baseUrl;
        return $base.'/qrcodes/'.$filename.'.png';
    }
    
    private function mailFireAdmin($booking_id){
        
        $model = Booking::find()->where(['id' => $booking_id])->one();
        // Mail To Admin
        $subject_admin = "Order Confirmation";
        $body_admin = "<br><br>An Order of Rs. ".$model->amount." for ".$model->no_of_units." tickets has arrived.<br>Name: ".$model->name."<br>Email : ".$model->email."<br>Phone no. : ".$model->phone."<br>Ticket No. : ".$model->ticket_no."<br>Date : ".$model->date;
        $to_admin='support@gohappyvalley.com';
        $finalbody_admin = $body_admin;
        
        $mail_admin =    Yii::$app->mailer->compose()
            ->setFrom(['booking@gohappyvalley.com' => 'Happy Valley Park'])
            ->setSubject($subject_admin)
            ->setHtmlBody($finalbody_admin);

        $mail_admin->setTo($to_admin)
             ->send();
    }

}
