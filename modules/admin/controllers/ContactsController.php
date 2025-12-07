<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Contacts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ContactsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {
        $this->view->title = 'Happy Vally Park - Admin';
        $this->layout = 'admin';
        $lists = Contacts::find()->orderBy(['id'=> SORT_DESC])->all();
        
        return $this->render('list', ['lists' => $lists]);
        
    }

}
