<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class ClientController extends Controller
{
    public function beforeAction($action)
    {
        if (in_array($action->id, ['login', 'signup'])) {
            $this->layout = 'auth';
        } else {
            $this->layout = 'client';
        }
        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        return $this->redirect(['client/dashboard']);
    }

    public function actionLogin()
    {
        return $this->render('login');
    }

    public function actionSignup()
    {
        return $this->render('signup');
    }

    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    public function actionBook()
    {
        return $this->render('book');
    }
}
