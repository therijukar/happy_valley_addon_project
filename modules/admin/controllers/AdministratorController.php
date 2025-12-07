<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Administrator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

class AdministratorController extends \yii\web\Controller
{

	public function sessionValidate(){
        $session = Yii::$app->session;
        if(!isset($session['administrator']['administratorid'])){
            return Yii::$app->getResponse()->redirect(array('admin/administrator/login',));
        }else if($session['administrator']['administratorid']==''){
            return Yii::$app->getResponse()->redirect(array('admin/administrator/login',));
        }
        return False;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->view->title = 'Happy Vally Park - Admin Login';
        $this->layout = 'adminLogin';
        $model = new Administrator();

        if ($model->load(Yii::$app->request->post())) {

            $admin = Administrator::findOne(['email' => $model->email,'password' => md5($model->password),'active'=>"1"]);
            $session = new Session();
            $session->open();
            $session['administrator']=$admin;
            
            return $this->redirect(['/admin']);

        } else {
            
            return $this->render('login', ['model' => $model]);
        }


    }
    
    /**
    * Editing Profile of an employee, change passwords, etc.
     */
    public function actionProfile($id){
        $msg='';
        $this->view->title = 'Happy Valley Park - Edit Profile';
        $this->layout = 'admin';
          $session = Yii::$app->session;

        // $imgmodel = new UploadForm();
        $model = Administrator::findOne(['administratorid' => $id]);
        return $this->render('UpdateProfile',['model' => $model]);
    }

    public function actionLogout()
    {
        $session = new Session();
        $session->open();
        unset($session['administrator']);
        return $this->redirect(['/admin/administrator/login']);
    }
    
    public function actionForgot()
    {
        $this->view->title = 'Happy Valley Park - Forgot Password';
        $this->layout = 'adminLogin';
        $msg = "Type Your Email";

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $email = $data['email'];

            $check_email= Administrator::find()
                                       ->select(['email','administratorid'])
                                       ->where(['email' => $email])
                                       ->one();


            //var_dump($check_email->email);die;
            if($check_email !=null){
                $send_email=$check_email->email;
                $id = $check_email->administratorid;
                $this->Mailsend($send_email,$id);
                $session = new Session();
                $session->open();
                $session['Sent'] = 'Sent';
                //$msg = true;
            }else{
                $session = new Session();
                $session->open();
                $session['failed'] = 'failed';
                $msg = false;
            }


            return $this->render('forgot_password', ['msg'=>$msg]);
        }

        return $this->render('forgot_password', ['msg'=>$msg]);
    }

    public function Mailsend($send_email,$id){
        $to = $send_email;

        $user_id = base64_encode($id);
        //$body = '<h1></h1>' ;
        $subject = "Password Reset link";
        // $link = Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.
        $body = "<p><a target='_blank' href='https://gohappyvalley.com/admin/administrator/reset?id=".$user_id."'>Please reset your by clicking on the link</a></p>";

        $mail =    Yii::$app->mailer->compose()
                                    ->setFrom(['support@gohappyvalley.com' => 'Happy Valley Park'])
                                    ->setSubject($subject)
                                    ->setHtmlBody($body);
        $mail->setTo($to)
             ->send();

    }

    public function actionReset($id)
    {
        $this->view->title = 'Happy Valley Park - Reset Password';
        $this->layout = 'adminLogin';

        $user_id = base64_decode($id);

        $msg = '';
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $new_password = $data['new_password'];
            $confirm_password = $data['confirm_password'];
            if($new_password == $confirm_password ){
                $model = Administrator::findOne(['administratorid' => $user_id]);
                // var_dump($model);die;
                $model->password = md5($new_password);
                $model->save();
                $msg = true;
                return $this->redirect(['/admin/administrator/login']);
            }
            else{
                $msg = false;
                return $this->render('reset_password', ['msg'=>$msg]);
            }

        }
        return $this->render('reset_password', ['msg'=>$msg]);
    }
    
    public function actionChangePass()
    {
        $this->view->title = 'Happy Valley Park - Reset Password';
        $this->layout = 'adminLogin';
        $session = new Session();

        $user_id = isset($_POST['admin_id']) ? $_POST['admin_id'] : 0 ;

        $msg = '';
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $new_password = $data['new_pass'];
            $confirm_password = $data['cnf_pass'];
            if($new_password == $confirm_password ){
                $model = Administrator::findOne(['administratorid' => $user_id]);
                //var_dump($model);
                $model->password = md5($new_password);
                $model->save();
                unset($session);
                return $this->redirect(['/admin/administrator/login']);
            }
            else{
                $session['False'] = 'False';
                return $this->actionProfile($user_id);
            }
        }
        return $this->actionProfile($user_id);
    }

}
