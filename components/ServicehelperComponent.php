<?php

namespace app\components;

use Yii;
use yii\base\Component;

use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\base\InvalidConfigException;
use yii\helpers\Url;
use app\Util\ReturnCodes;
use app\Util\DaysUtil;
use \yii\db\Expression;
use app\Util\GeoUtil;

use app\models\Booking;
use app\models\Payments;
use app\models\Enquiry;
use app\models\Feedback;

class ServicehelperComponent extends Component
{
    private $serviceUitl;
    public function __construct()
    {
        $this->serviceUitl = new ServiceUtilComponent();
    }
    
    // Booking A Product Helper for Happy Valley
   public function BookingHelper($inputJSON){
        try {
            $input = json_decode($inputJSON, TRUE);

            $model = new Booking();
            $model->name = $input['name'];
            $model->phone = $input['phone'];
            $model->email = $input['email'];
            $model->no_of_units = $input['no_of_people'];
            $model->amount = $input['amount'];
            $model->date = $input['date'];
            $model->type = '0';

            if($model->save()) {
                $payments = new Payments();
                $payments->booking_id = $model->id;
                $payments->amount = $model->amount;
                $payments->save();
                return array(
                    "data" => [
                        "message" => "Redirecting To Payment Page!",
                        "booking_id" => $model->id,
                        "payment_id" => $payments->id,
                    ],
                    "status" => ReturnCodes::SUCCESS
                    );
                } else {
                    return array(
                        "data" => [
                            "message" => "Something went wrong!"
                        ],
                        "status" => ReturnCodes::FAILURE
                    );
                }
            } 
        catch (\Exception $ex) {
            return $status = ["status" => ReturnCodes::SYSTEM_ERROR, "data" => $ex->getMessage()];
        }
        
    }

    public function EnquiryHelper($inputJSON)
    {
        try {
            $input = json_decode($inputJSON, TRUE);

            $model = new Enquiry();

            $model->name = $input['name'];
            $model->phone = $input['phone'];
            $model->email = $input['email'];
            $model->product = (string)$input['product'];
            $model->from_date = $input['from_date'];
            $model->to_date = $input['to_date'];
            $model->time = $input['time'];
            $model->no_of_people = $input['no_of_people'];
            $model->no_of_spots = $input['no_of_spots'];
            $model->type = '0';
            // vardump
            if($model->save()) {
                
                return array(
                    "data" => [
                        "message" => "Enquiry Posted Successfully !!",
                    ],
                    "status" => ReturnCodes::SUCCESS
                    );
                } else {
                    return array(
                        "data" => [
                            "message" => "Something went wrong!"
                        ],
                        "status" => ReturnCodes::FAILURE
                    );
                }
            } 
        catch (\Exception $ex) {
            return $status = ["status" => ReturnCodes::SYSTEM_ERROR, "data" => $ex->getMessage()];
        }
    }

    // Service For Feedback from the customer

    public function FeedbackHelper($inputJSON)
    {
        try {
            $input = json_decode($inputJSON, TRUE);

            $model = new Feedback();

            $model->applicant_name = $input['name'];
            $model->phone = $input['phone'];
            $model->email = $input['email'];
            $model->comment = $input['comment'];
            // vardump
            if($model->save()) {
                
                return array(
                    "data" => [
                        "message" => "Feedback Posted Successfully !!",
                    ],
                    "status" => ReturnCodes::SUCCESS
                    );
                } else {
                    return array(
                        "data" => [
                            "message" => "Something went wrong!"
                        ],
                        "status" => ReturnCodes::FAILURE
                    );
                }
            } 
        catch (\Exception $ex) {
            return $status = ["status" => ReturnCodes::SYSTEM_ERROR, "data" => $ex->getMessage()];
        }
    }


    public function mailFire($booking_id)
    {
        $model = Booking::find()->where(['id' => $booking_id])->one();
        $booking = BookingProd::find()->where(['booking_id' => $booking_id])->one();
        $subject = "Order Confirmation";
        $body = "Thankyou For Booking, Your Order for ".$booking->product->name." which costs ".$booking->amount." has been confirmed. This is your Confirmation Mail<br>";
        $to=$model->email;
        $finalbody = $body;

        // $pdf = Yii::$app->pdf; // or new Pdf();
        // $mpdf = $pdf->api;
        // $path =  $mpdf->Output('', 'I');
        $mail =    Yii::$app->mailer->compose()
            ->setFrom(['no-reply@baryon.in' => 'Happy Valley Park'])
            ->setSubject($subject)
            ->setHtmlBody($finalbody);

        $mail->setTo($to)
             ->send();

        // Mail To Admin
        $subject_admin = "Order Confirmation";
        $body_admin = "<br><br>An Order of  ".$booking->product->name." has arrived.";
        $to_admin='support@gohappyvalley.com';
        $finalbody_admin = $body_admin;
        
        $mail_admin =    Yii::$app->mailer->compose()
            ->setFrom(['no-reply@baryon.in' => 'Happy Valley Park'])
            ->setSubject($subject_admin)
            ->setHtmlBody($finalbody_admin);

        $mail_admin->setTo($to_admin)
             ->send();
    }
   
}