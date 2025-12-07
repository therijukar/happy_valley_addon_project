<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class IndexController extends Controller
{
 
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->request->baseUrl.'/cms');
    }


}
