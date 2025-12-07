<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class ClientController extends Controller
{
    public $layout = 'client';

    public function actionIndex()
    {
        return $this->redirect(['client/dashboard']);
    }

    public function actionLogin()
    {
        return $this->render('login');
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
