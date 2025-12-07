<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
	    return $this->redirect(Yii::$app->request->baseUrl.'/cms');
    	// $this->layout = 'index';
     //    return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
  /*  public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
   /* public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
      public function actionRazorpayWebhook()
        {
            // Disable CSRF validation for this action
            Yii::$app->request->enableCsrfValidation = false;
        
            // Get the request body
            $requestBody = Yii::$app->request->getRawBody();
        
            // Verify the signature (You need to implement this part)
            // $isValidSignature = $this->verifySignature(Yii::$app->request->getHeaders()->get('X-Razorpay-Signature'), $requestBody);
        
            // If signature is valid
            // if ($isValidSignature) {
                // Process the webhook event
              
              
              
                 $data = json_decode($requestBody, true);
                if ($data['event'] === 'payment.captured') {
                    $paymentId = $data['payload']['payment']['entity']['id'];
                    // Retrieve the booking metadata from the payment details
                    $bookingMetadata = json_decode($data['payload']['payment']['entity']['notes']['booking_metadata'], true);
                    if ($bookingMetadata) {
                        $bookingId = $bookingMetadata['booking_id'];
                        // Update the booking with the ticket number
                        $booking = Booking::findOne($bookingId);
                        if ($booking) {
                            
                            if(empty($booking->ticket_no))
                           {
                               
                             $booking->ticket_no = $bookingMetadata['ticket'];
                             $booking->save();
                             
                            $num = rand(1000,9999);  
                            $string = '';
                            for ($i=0; $i < 5; $i++) { 
                                $string = $string.chr(rand(65,90));
                            }
                            $otp = rand(1000,9999);  
                        
                            $ticket = $string.(string)($num);
                            $booking->ticket_no = $ticket;
                            $booking->otp = $otp;
                            $booking->save();
                        
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
                             
                             

                           }
                            $booking->save();
                        }
                        // Update the payment model with booking ID, status, and transaction ID
                        $payment = Payments::findOne(['booking_id' => $bookingId]);
                        if ($payment) {
                            // $payment->booking_id = $bookingId;
                            $payment->confirmation = 1; // Update status to indicate payment captured
                            $payment->payment_id = $paymentId; 
                             $payment->txn_id = $paymentId; 
                             $payment->save();
                        }
                    }
                }
              
              
              
              
            // }
        
            // Return a response
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['status' => 'success'];
        }
        
    



}
