<?php

namespace app\controllers;

class AdministratorController extends \yii\web\Controller
{
	

    public function actionIndex()
    {
        return $this->render('index');
    }

}
