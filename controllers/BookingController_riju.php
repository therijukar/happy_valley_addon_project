<?php

namespace app\controllers;

use Yii;
use app\models\Booking;
use app\models\Payments;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\Util\GlobalUtilities;
use yii\helpers\Url;
use Razorpay\Api\Api;
use yii\helpers\Json;



class BookingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

   public function actionAddTickets()
{
    try {
        $this->layout = 'index';
        $model = new Booking();
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            $number = $data['Booking']['no_of_units'];
            $productid = $data['Booking']['product'];
            $amount = 40.00*$number;

            if ($amount == $data['Booking']['amount']) {
                $model->type = '1';
                $model->product = $productid;
                if($model->save()){
                    $payments = new Payments();
                    $payments->booking_id = $model->id;
                    $payments->amount = $model->amount;
                    $payments->save();

                    // $MERCHANT_KEY = "rzp_test_kNHpDdaCblGHR2";
                    // $SALT = "dLrCqKh2aPrKLiou7SCif2W4";
                    // $PAYU_BASE_URL = "https://api.razorpay.com/v1/";

                    // $action = '';

                    // $amount = $model->amount;
                    // $email = $model->email;
                    // $name = $model->name;
                    // $phone = $model->phone;

                    // $product = json_encode(json_decode('[{"id":"'.$model->id.'","description":"Happy Valley Park - Ticket","amount":"'.$model->amount.'"}]'));

                    // $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                    // $hash = '';

                    // $hashSequence = $MERCHANT_KEY."|".$txnid."|".$amount."|".$product."|".$name."|".$email."||||||||||";

                    // $hashVarsSeq = explode('|', $hashSequence);
                    // $hash_string = '';  
                    // foreach($hashVarsSeq as $hash_var) {
                    //     $hash_string .= isset($hash_var) ? $hash_var : '';
                    //     $hash_string .= '|';
                    // }

                    // $hash_string .= $SALT;


                    // $hash = strtolower(hash('sha512', $hash_string));
                    // $action = $PAYU_BASE_URL . '/_payment';
                    //               return $this->redirect(Yii::$app->request->baseUrl);
                        $num = rand(1000,9999);
                    
                    $string = '';
                    for ($i=0; $i < 5; $i++) { 
                        $string = $string.chr(rand(65,90));
                    }
                    
                    $ticket = $string.(string)($num);
                    
                    //die($ticket);
                    //var_dump($model); die;
        
                        $bookingDate = $model->date;
                        $model->save();
                        $message = "Your booking has been successfully confirmed. Your ticket number is: $ticket. Booking date: $bookingDate. Thank you for choosing our service!";

                        // $this->sendSms($model->phone,$message);
                        // $send = Yii::$app->mailer->compose()
                        // ->setFrom('mailtrap@demomailtrap.com')
                        // ->setTo('gauravsandhu00@gmail.com')
                        // ->setSubject('Test Message')
                        // ->setTextBody('Plain text content. YII2 Application')
                        // ->setHtmlBody('<b>HTML content <i>Ram Pukar</i></b>')
                        // ->send();
                        // if($send){
                        //     echo "Send";
                        // }

                        //  $this->mailFire($booking_id);
                         Yii::$app->session->setFlash('success', 'Your Booking is Successfull.');

                        // Redirect to the home page (assuming the home page route is 'site/index')

                        // return $this->redirect(Url::home());

                        $orderData = [
                            'receipt' => $model->id,
                            'amount' => $amount * 100, // Amount in paise
                            'currency' => 'INR',
                            'payment_capture' => 1 // Auto capture payment
                        ];
                        $keyId = 'rzp_live_JnKcmAb28MNsO6';
                        $keySecret = 'E07BXooQBUw0ohmVBegkRZ22';

                        $razorpay = new Api($keyId, $keySecret);
            
                        $razorpayOrder = $razorpay->order->create($orderData);
            
                        // Return data to client-side JavaScript
                        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return [
                            'success' => true,
                            'order_id' => $razorpayOrder['id'],
                            'amount' => $amount,
                            'currency' => 'INR',
                            'data' => $model
                        ];
                    // return $this->render('payuForm',['booking' => $model, 'MERCHANT_KEY'=>$MERCHANT_KEY,'hash' => $hash, 'txnid' => $txnid,'name' => $name, 'phone' => $phone, 'amount' => $amount, 'email' => $email, 'product' => $product, 'action' => $action]);
                }
            } else {
                throw new \Exception("Amount mismatch detected.");
            }
        }
    } catch (\Exception $e) {
        Yii::error($e->getMessage());
        
        echo"<pre>";
        print_r($e->getMessage());
        die;
        // Handle the exception here, such as redirecting to a failure page
        return $this->redirect(Yii::$app->request->baseUrl.'/booking/failure');
    }
}

    
    public function actionAddparkCombo()
    {
        //return $this->redirect('https://gohappyvalley.com/dev');
        $this->layout = 'index';
        $model = new Booking();
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            // echo'<pre>';var_dump(Yii::$app->request->post());die;
            $number = $data['Booking']['no_of_units'];
            $productid = $data['Booking']['product'];
            //echo'<pre>';var_dump($productid);die;
            $amount = 500.00*$number;
            if ($amount == $data['Booking']['amount']) {
            	$model->type = '1';
            	$model->product = $productid;
                if($model->save()){
                    $payments = new Payments();
                    $payments->booking_id = $model->id;
                    $payments->amount = $model->amount;
                    $payments->save();
                    
                    $MERCHANT_KEY = "S3V0YRhx";
                    $SALT = "WO89iI4hUC";

                    //$PAYU_BASE_URL = "https://sandboxsecure.payu.in";   // For Sandbox Mode
                    $PAYU_BASE_URL = "https://secure.payu.in";      // For Production Mode

                    $action = '';

                    $amount = $model->amount;
                    $email = $model->email;
                    $name = $model->name;
                    $phone = $model->phone;

                    $product = json_encode(json_decode('[{"id":"'.$model->id.'","description":"Happy Valley Park - Ticket","amount":"'.$model->amount.'"}]'));
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
                    return $this->render('payuForm',['booking' => $model, 'MERCHANT_KEY'=>$MERCHANT_KEY,'hash' => $hash, 'txnid' => $txnid,'name' => $name, 'phone' => $phone, 'amount' => $amount, 'email' => $email, 'product' => $product, 'action' => $action]);
               }
            }else{
                //return $this->redirect(Yii::$app->request->baseUrl.'/dev/booking/failure');
                return $this->redirect(Yii::$app->request->baseUrl.'/booking/failure');
            }
        }
    }
    
    public function actionFivedBooking()
    {
        //return $this->redirect('https://gohappyvalley.com/dev');
        $this->layout = 'index';
        $model = new Booking();
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            //echo'<pre>';var_dump(Yii::$app->request->post());die;
            $number = $data['Booking']['no_of_units'];
            $productid = $data['Booking']['product'];
            $amount = 200.00*$number;
            if ($amount == $data['Booking']['amount']) {
            	$model->type = '1';
            	$model->product = $productid;
                if($model->save()){
                    $payments = new Payments();
                    $payments->booking_id = $model->id;
                    $payments->amount = $model->amount;
                    $payments->save();
                   
                    $num = rand(1000,9999);
                    
                    $string = '';
                    for ($i=0; $i < 5; $i++) { 
                        $string = $string.chr(rand(65,90));
                    }
                    
                    $ticket = $string.(string)($num);
                    
                    //die($ticket);
                    //var_dump($model); die;
        
                        $bookingDate = $model->date;
                        $model->save();
                        $message = "Your booking has been successfully confirmed. Your ticket number is: $ticket. Booking date: $bookingDate. Thank you for choosing our service!";

                        // $this->sendSms($model->phone,$message);
                        // $send = Yii::$app->mailer->compose()
                        // ->setFrom('mailtrap@demomailtrap.com')
                        // ->setTo('gauravsandhu00@gmail.com')
                        // ->setSubject('Test Message')
                        // ->setTextBody('Plain text content. YII2 Application')
                        // ->setHtmlBody('<b>HTML content <i>Ram Pukar</i></b>')
                        // ->send();
                        // if($send){
                        //     echo "Send";
                        // }

                        //  $this->mailFire($booking_id);
                         Yii::$app->session->setFlash('success', 'Your Booking is Successfull.');

                        // Redirect to the home page (assuming the home page route is 'site/index')

                        // return $this->redirect(Url::home());

                        $orderData = [
                            'receipt' => $model->id,
                            // 'amount' => 1 * 100,
                            'amount' => $amount * 100, // Amount in paise
                            'currency' => 'INR',
                            'payment_capture' => 1 // Auto capture payment
                        ];
                         $keyId = 'rzp_live_JnKcmAb28MNsO6';
                        $keySecret = 'E07BXooQBUw0ohmVBegkRZ22';

                        $razorpay = new Api($keyId, $keySecret);
            
                        $razorpayOrder = $razorpay->order->create($orderData);
            
                        // Return data to client-side JavaScript
                        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return [
                            'success' => true,
                            'order_id' => $razorpayOrder['id'],
                            'amount' => $amount,
                            'currency' => 'INR',
                            'data' => $model
                        ];             
    
    
    }
            }else{
                //return $this->redirect(Yii::$app->request->baseUrl.'/dev/booking/failure');
                return $this->redirect(Yii::$app->request->baseUrl.'/booking/failure');
            }
        }
    }
    public function actionResturantBooking()
    {
        //return $this->redirect('https://gohappyvalley.com/dev');
        $this->layout = 'index';
        $model = new Booking();
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            //echo'<pre>';var_dump(Yii::$app->request->post());die;
            $number = $data['Booking']['no_of_units'];
            $productid = $data['Booking']['product'];
            $amount = 1000;
            if ($amount == $data['Booking']['amount']) {
            	$model->type = '1';
            	$model->product = $productid;
                if($model->save()){
                    $payments = new Payments();
                    $payments->booking_id = $model->id;
                    $payments->amount = $model->amount;
                    $payments->save();
                    
                    $MERCHANT_KEY = "S3V0YRhx";
                    $SALT = "WO89iI4hUC";

                    //$PAYU_BASE_URL = "https://sandboxsecure.payu.in";   // For Sandbox Mode
                    $PAYU_BASE_URL = "https://secure.payu.in";      // For Production Mode

                    $action = '';

                    $amount = $model->amount;
                    $email = $model->email;
                    $name = $model->name;
                    $phone = $model->phone;

                    $product = json_encode(json_decode('[{"id":"'.$model->id.'","description":"Happy Valley Park - Ticket","amount":"'.$model->amount.'"}]'));
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
                    return $this->render('payuForm',['booking' => $model, 'MERCHANT_KEY'=>$MERCHANT_KEY,'hash' => $hash, 'txnid' => $txnid,'name' => $name, 'phone' => $phone, 'amount' => $amount, 'email' => $email, 'product' => $product, 'action' => $action]);
               }
            }else{
                //return $this->redirect(Yii::$app->request->baseUrl.'/dev/booking/failure');
                return $this->redirect(Yii::$app->request->baseUrl.'/booking/failure');
            }
        }
    }
    public function actionFullPackage()
    {
        //die('+++');
        //return $this->redirect('https://gohappyvalley.com/dev');
        $this->layout = 'index';
        $model = new Booking();
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            //echo'<pre>';var_dump(Yii::$app->request->post());die;
            $number = $data['Booking']['no_of_units'];
            $productid = $data['Booking']['product'];
            $amount = 250.00*$number;
            if ($amount == $data['Booking']['amount']) {
            	$model->type = '1';
            	$model->product = $productid;
                if($model->save()){
                    $payments = new Payments();
                    $payments->booking_id = $model->id;
                    $payments->amount = $model->amount;
                    $payments->save();
                    
                    $MERCHANT_KEY = "S3V0YRhx";
                    $SALT = "WO89iI4hUC";

                    //$PAYU_BASE_URL = "https://sandboxsecure.payu.in";   // For Sandbox Mode
                    $PAYU_BASE_URL = "https://secure.payu.in";      // For Production Mode

                    $action = '';

                    $amount = $model->amount;
                    $email = $model->email;
                    $name = $model->name;
                    $phone = $model->phone;

                    $product = json_encode(json_decode('[{"id":"'.$model->id.'","description":"Happy Valley Park - Ticket","amount":"'.$model->amount.'"}]'));
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
                    return $this->render('payuForm',['booking' => $model, 'MERCHANT_KEY'=>$MERCHANT_KEY,'hash' => $hash, 'txnid' => $txnid,'name' => $name, 'phone' => $phone, 'amount' => $amount, 'email' => $email, 'product' => $product, 'action' => $action]);
               }
            }else{
                //return $this->redirect(Yii::$app->request->baseUrl.'/dev/booking/failure');
                return $this->redirect(Yii::$app->request->baseUrl.'/booking/failure');
            }
        }
    }
    public function actionPicnicspotBooking()
    {
        //die('+++');
        //return $this->redirect('https://gohappyvalley.com/dev');
        $this->layout = 'index';
        $model = new Booking();
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            //echo'<pre>';var_dump($data['Booking']['amount']);die;
            $number = $data['Booking']['no_of_units'];
            $productid = $data['Booking']['product'];
            $amount = 1500.00*$number;
            //echo'<pre>';var_dump($amount);die;
            if ($amount == $data['Booking']['amount']) {
            	$model->type = '1';
            	$model->product = $productid;
                if($model->save()){
                    $payments = new Payments();
                    $payments->booking_id = $model->id;
                    $payments->amount = $model->amount;
                    $payments->save();
                    
                    $MERCHANT_KEY = "S3V0YRhx";
                    $SALT = "WO89iI4hUC";

                    //$PAYU_BASE_URL = "https://sandboxsecure.payu.in";   // For Sandbox Mode
                    $PAYU_BASE_URL = "https://secure.payu.in";      // For Production Mode

                    $action = '';

                    $amount = $model->amount;
                    $email = $model->email;
                    $name = $model->name;
                    $phone = $model->phone;

                    $product = json_encode(json_decode('[{"id":"'.$model->id.'","description":"Happy Valley Park - Ticket","amount":"'.$model->amount.'"}]'));
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
                    return $this->render('payuForm',['booking' => $model, 'MERCHANT_KEY'=>$MERCHANT_KEY,'hash' => $hash, 'txnid' => $txnid,'name' => $name, 'phone' => $phone, 'amount' => $amount, 'email' => $email, 'product' => $product, 'action' => $action]);
               }
            }else{
                //return $this->redirect(Yii::$app->request->baseUrl.'/dev/booking/failure');
                return $this->redirect(Yii::$app->request->baseUrl.'/booking/failure');
            }
        }
    }
    public function actionWaterWorld()
    {
        //die('+++');
        //return $this->redirect('https://gohappyvalley.com/dev');
        $this->layout = 'index';
        $model = new Booking();
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            //echo'<pre>';var_dump(Yii::$app->request->post());die;
            //$number = $data['Booking']['no_of_units'];
            $productid = $data['Booking']['product'];
            $belowtenyears = !empty($data['Booking']['belowtenyears']) ?$data['Booking']['belowtenyears']: 0;

            $abovetenyears = $data['Booking']['abovetenyears'];
            $number = ($belowtenyears + $abovetenyears);
           
            $amount1 = 240.00*$belowtenyears ?? 0;
            $amount2 = 400.00*$abovetenyears;
            $amount= ($amount1 + $amount2);
            //echo'<pre>';var_dump($amount);die;
            if ($amount == $data['Booking']['amount']) {
            	$model->type = '1';
            	$model->product = $productid;
            	$model->no_of_units = $number;
                if($model->save()){
                    $payments = new Payments();
                    $payments->booking_id = $model->id;
                    $payments->amount = $model->amount;
                    $payments->save();
               
                    $num = rand(1000,9999);
                    
                    $string = '';
                    for ($i=0; $i < 5; $i++) { 
                        $string = $string.chr(rand(65,90));
                    }
                    
                    $ticket = $string.(string)($num);
                    
                    //die($ticket);
                    //var_dump($model); die;
        

                        $bookingDate = $model->date;
                        $model->save();
                        $message = "Your booking has been successfully confirmed. Your ticket number is: $ticket. Booking date: $bookingDate. Thank you for choosing our service!";

                      
                         Yii::$app->session->setFlash('success', 'Your Booking is Successfull.');

                        // Redirect to the home page (assuming the home page route is 'site/index')

                        // return $this->redirect(Url::home());

                        $bookingMetadata = [
                            'booking_id' => $model->id,
                            'ticket_no' => $ticket,
                            // Add any other booking details you want to include
                        ];
                        $orderData = [
                            'receipt' => $model->id,
                            // 'amount' => 1 * 100, // Amount in paise
                            'amount' => $amount * 100,
                            'currency' => 'INR',
                            'payment_capture' => 1, // Auto capture payment
                            'notes' => [
                            'booking_metadata' => json_encode($bookingMetadata) // Add booking metadata
                        ]
                        ];
                        
                        
                        $keyId = 'rzp_live_JnKcmAb28MNsO6';
                        $keySecret = 'E07BXooQBUw0ohmVBegkRZ22';

                        $razorpay = new Api($keyId, $keySecret);
            
                        $razorpayOrder = $razorpay->order->create($orderData);
            
                        // Return data to client-side JavaScript
                        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return [
                            'success' => true,
                            'order_id' => $razorpayOrder['id'],
                            'amount' => $amount,
                            'currency' => 'INR',
                            'data' => $model
                        ];
                        
                        
                }
            }else{
                //return $this->redirect(Yii::$app->request->baseUrl.'/dev/booking/failure');
                return $this->redirect(Yii::$app->request->baseUrl.'/booking/failure');
            }
        }
    }
    private function generateTicketNumber()
    {
        return strtoupper(Yii::$app->security->generateRandomString(5)) . rand(1000, 9999);
    }

    
    public function actionWaterDryCombo()
    {
        $this->layout = 'index';
        $model = new Booking();
    
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('Booking');
    
            $belowTenYears = (int)($post['belowtenyears'] ?? 0);
            $aboveTenYears = (int)($post['abovetenyears'] ?? 0);
            $totalUnits = $belowTenYears + $aboveTenYears;
    
            // Use constants for pricing
            $priceBelow10 = 410.00;
            $priceAbove10 = 550.00;
    
            $amountCalculated = ($belowTenYears * $priceBelow10) + ($aboveTenYears * $priceAbove10);
            $amountPosted = (float)($post['amount'] ?? 0);
            
            
            if (abs($amountCalculated - $amountPosted) > 0) {
                Yii::$app->session->setFlash('error', 'Amount mismatch.');
                echo 1;exit;
                return $this->redirect(Yii::$app->request->baseUrl . '/booking/failure');
            }
    
            $model->type = '1';
            $model->product = $post['product'];
            $model->no_of_units = $totalUnits;
            $model->amount = $amountCalculated;
    
            if ($model->save()) {
                // Save payment
                $payment = new Payments();
                $payment->booking_id = $model->id;
                $payment->amount = $model->amount;
                $payment->save();
    
                // Generate ticket
                $ticket = $this->generateTicketNumber();
                $bookingDate = $model->date;
    
                Yii::$app->session->setFlash('success', "Booking successful. Ticket: $ticket. Date: $bookingDate");
    
                // Prepare Razorpay order
                $orderData = [
                    'receipt' => $model->id,
                    // 'amount' => (int)( 1 * 100 ), // in paise
                    'amount' => (int)($amountCalculated * 100), // in paise
                    'currency' => 'INR',
                    'payment_capture' => 1,
                    'notes' => [
                        'booking_metadata' => json_encode([
                            'booking_id' => $model->id,
                            'ticket_no' => $ticket,
                        ])
                    ]
                ];
                
                $keyId = 'rzp_live_JnKcmAb28MNsO6';
                $keySecret = 'E07BXooQBUw0ohmVBegkRZ22';

                $razorpay = new Api($keyId, $keySecret);
    
                
    
                try {
                    $razorpayOrder = $razorpay->order->create($orderData);
    
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'success' => true,
                        'order_id' => $razorpayOrder['id'],
                        'amount' => $amountCalculated,
                        'currency' => 'INR',
                        'data' => $model
                    ];
                } catch (\Exception $e) {
                    Yii::error("Razorpay order creation failed: " . $e->getMessage());
                    Yii::$app->session->setFlash('error', 'Payment failed. Try again.');
                    echo $e->getMessage();exit;
                    return $this->redirect(Yii::$app->request->baseUrl . '/booking/failure');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Booking failed. Please try again.');
                echo 3;exit;
                return $this->redirect(Yii::$app->request->baseUrl . '/booking/failure');
            }
        }
    
        return $this->render('water-world', ['model' => $model]);
    }

    
    
    
    
    public function actionSuccess()
    {
        $this->layout = 'index';
    
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
        //die($product[0]['id']);
        $booking_id = $product[0]['id'];
        
        //Creating A Ticket and Inserting Ticket Number to booking table
        $model = Booking::find()->where(['id' => $booking_id])->one();
        $num = rand(1000,9999);
        
        $string = '';
        for ($i=0; $i < 5; $i++) { 
            $string = $string.chr(rand(65,90));
        }
        
        $ticket = $string.(string)($num);
        
        //die($ticket);
        //var_dump($model); die;
        
        $model->ticket_no = $ticket;
        $model->save(false);
        
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
                return $this->render('success.php',['status'=>$status,'txn_id'=>$txn_id,'amount'=>$amount]);
            }
            else{
                return $this->failureError($error_msg);
            }
        }else{
            return $this->failureError($error_msg);
        }
    }
    public function actionPicnicspotCount()
    {
        $picnicdate = $_POST['picnicdate'];
        //var_dump($picnicdate);die;
        // $model = Booking::find()->where(['soft_delete'=>'0', 'date'=>$picnicdate, 'product'=>'8','is_active'=>'1' ])->all();
        $model = Booking::find()->where(['soft_delete'=>'0', 'date'=>$picnicdate, 'product'=>'3','is_active'=>'1' ])->sum('no_of_units');
        $available = 21 - $model;
        //$available = 21 - count($model);
        echo json_encode(['status'=>'200','available'=>$available]);
        //echo'<pre>';var_dump($model);die;
        //echo'<pre>';var_dump($model1);die;
        // if($model)
        // {
        //     echo json_encode(['status'=>'200','count'=>$available]);
        // }
        // else
        // {
        //     echo json_encode(['status'=>'500','count'=>'0']);
        // }
    }

    public function actionFailure()
    {
        //var_dump($_POST["productinfo"]);die;
        $productinfo=$_POST["productinfo"];
        $product = json_decode($productinfo,true);
        $txn_id = $_POST['txnid'];
        $error = $_POST['error_Message'];
        $booking_id = $product[0]['id'];
        $payments = Payments::find()->where(['booking_id' => $booking_id])->one();
        
        if(!empty($txn_id))
        {
                    $payments->txn_id = $txn_id ;

        }
        $payments->error_msg = !empty($error) ? $error: null;
        $payments->save();
        $this->layout = 'index';
        return $this->render('failure.php');
    }
    
    public function failureError($err)
    {
        $productinfo=$_POST["productinfo"];
        $product = json_decode($productinfo,true);
        $booking_id = $product[0]['id'];
        $txn_id = $_POST['txnid'];
        $payments = Payments::find()->where(['booking_id' => $booking_id])->one();
        $payments->txn_id = $txn_id;
        $payments->error_msg = $err;
        $payments->save();
        $this->layout = 'index';
        return $this->render('failure.php',['msg' => $err]);
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

public function actionUpdateStatus()
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $request = Yii::$app->getRequest();
    $requestData = Json::decode($request->getRawBody(), true); // Decode JSON data sent from client

    $paymentId = $requestData['payment_id']; // Extract payment ID from request
    $booking_id = $requestData['booking_id']; // Extract payment ID from request

    // Perform database update to mark payment as successful or update payment status
    // Example: You may have a Payment model with a status attribute
    $payment = Payments::findOne(['booking_id' => $booking_id]);
    $booking = Booking::findOne($booking_id);

    
    $num = rand(1000,9999);  
    $string = '';
    for ($i=0; $i < 5; $i++) { 
        $string = $string.chr(rand(65,90));
    }
    $otp = rand(1000,9999);  

    $ticket = $string.(string)($num);
    $booking->ticket_no = $ticket;
    $booking->otp = $otp;
    $booking->save(false);

    $date = date('d/m/Y', strtotime($booking->date));
    $message = "$ticket|$date|$booking->no_of_units|$otp|";



    $phone = $booking->phone;
    if (strpos($phone, '+91') !== false) {
        // Remove '+91' prefix
        $phone = substr($phone, 3);
    } elseif (strpos($phone, '0') === 0) {
        // Remove '0' prefix
        $phone = substr($phone, 1);
    }
   
    $send =$this->sendSms($phone,$message);
 

    if(!empty($booking->email))
    {
    
        $this->mailFire($booking_id);
    }
    
    
    if ($payment) {
        // Update payment status
        $payment->txn_id = $paymentId;
        $payment->payment_id = $paymentId;
        $payment->confirmation = 1;
        $payment->save(); // Save changes to database
        return ['success' => true, 'message' => 'Payment status updated successfully','booking_id' => (int)$booking_id];
    } else {
        return ['success' => false, 'message' => 'Payment not found'];
    }
}




public function actionOrderSuccess()

{
    $this->layout ="index";
    $request = Yii::$app->getRequest();
    $requestData = Json::decode($request->getRawBody(), true); // Decode JSON data sent from client

   
    $booking_id = Yii::$app->request->get('booking_id');
    $booking = Booking::findOne(['id' => $booking_id]);
    $payment = Payments::findOne(['booking_id' => $booking_id]);
   
 
   if(empty($booking->ticket_no))
   {
       $num = rand(1000,9999);
                    
        $string = '';
        for ($i=0; $i < 5; $i++) { 
            $string = $string.chr(rand(65,90));
        }
        
        $ticket = $string.(string)($num);
        $booking->ticket_no = $ticket;
        $booking->save(false);
   }
    return $this->render('success.php',['status'=>"Confirmed",'txn_id'=>$payment->payment_id,'amount'=>$payment->amount]);


}

public function actionTestEmail()
    {
        $mailer = Yii::$app->mailer;
        $message = $mailer->compose()
            ->setFrom('booking@gohappyvalley.com')
            ->setTo('gauravsandhu00@gmail.com')
            ->setSubject('Test Email')
            ->setTextBody('This is a test email from Yii2.');

        if ($message->send()) {
            echo 'Email sent successfully.';
        } else {
            echo 'Failed to send email. Error: ' . $mailer->ErrorInfo;
        }
    }
}
