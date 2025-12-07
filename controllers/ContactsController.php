<?php

namespace app\controllers;

use Yii;
use app\models\Contacts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

class ContactsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAddContact()
    {
    	$this->layout = 'index';
        $model = new Contacts();
        require_once 'src/autoload.php';
        $siteKey = '6LeFj4oUAAAAALFU_p_b4mu3EYv5bhudCUQGZNq2';
        $secret = '6LeFj4oUAAAAAOSYksd9fU9PP1q-v03cNZKRRnRx';
        // reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
        $lang = 'en';
        $recaptcha = new \ReCaptcha\ReCaptcha($secret , new \ReCaptcha\RequestMethod\Curl());
        if ($model->load(Yii::$app->request->post())) {
            $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            if ($resp->isSuccess()){
            $model->date = date('Y-m-d');
                if($model->save()){
                	$session = new Session();
                	$session['msg'] = 'contact submitted';
                	$this->mailFire($model->id);
                    return $this->redirect(Yii::$app->request->baseUrl.'/contact');
                }
                else{
                ?>
                <script>
                    alert('Invalid Captcha.');
                </script>
                <?php
                    return $this->redirect(Yii::$app->request->baseUrl.'/contact');
                }
            }
        }
    }

    private function mailFire($contact_id)
    {
        $model = Contacts::find()->where(['id' => $contact_id])->one();
        // Mail To Admin
        $subject_admin = "Mr. ".$model->name." contacted you";
        $body_admin = "<br><br>Name: ".$model->name."<br>Email : ".$model->email."<br>Phone no. : ".$model->phone."<br>Message : ".$model->message."<br>Date : ".date('d-M-Y', strtotime($model->date));
        $to_admin='support@gohappyvalley.com';
        $finalbody_admin = $body_admin;
        
        $mail_admin =    Yii::$app->mailer->compose()
            ->setFrom(['support@gohappyvalley.com' => 'Happy Valley Park'])
            ->setSubject($subject_admin)
            ->setHtmlBody($finalbody_admin);

        $mail_admin->setTo($to_admin)
             ->send();
    }

}
