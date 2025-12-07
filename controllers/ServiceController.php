<?php

namespace app\controllers;

use Yii;
use yii\filters\Cors;

class ServiceController extends \yii\web\Controller
{
    public function behaviors()
    {
       return array_merge([
			'cors' => [
				'class' => Cors::className(),
				#special rules for particular action
				'actions' => [
					'registeruser' => [
						#web-servers which you alllow cross-domain access
						'Origin' => ['*'],
						'Access-Control-Request-Method' => ['POST','OPTIONS'],
						'Access-Control-Request-Headers' => ['*'],
						'Access-Control-Allow-Credentials' => null,
						'Access-Control-Max-Age' => 1728000,
						'Access-Control-Expose-Headers' => [],
					],
					'call' => [
						#web-servers which you alllow cross-domain access
						'Origin' => ['*'],
						'Access-Control-Request-Method' => ['POST','OPTIONS'],
						'Access-Control-Request-Headers' => ['*'],
						'Access-Control-Allow-Credentials' => null,
						'Access-Control-Max-Age' => 1728000,
						'Access-Control-Expose-Headers' => [],
					],
				],
				#common rules
				'cors' => [
					'Origin' => ['*'],
					'Access-Control-Request-Method' => ['POST','OPTIONS'],
					'Access-Control-Request-Headers' => ['*'],
					'Access-Control-Allow-Credentials' => null,
					'Access-Control-Max-Age' => 1728000,
					'Access-Control-Expose-Headers' => [],
				]
			],
		], parent::behaviors());
    }

    public function beforeAction($action)
    {

        if ($action->id == 'index') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        $request = Yii::$app->request;
		if ($request->isOptions) {
			header('access-control-allow-origin: *');
			header('access-control-allow-method: post');
			header('access-control-allow-headers: content-type, Accept');
			return;
		}

		header('access-control-allow-origin: *');
		header('access-control-allow-method: post');
		header('access-control-allow-headers: content-type, Accept');


        Yii::info('Inside ServiceController.actionCall', 'service');
        header('Content-type: application/json');
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE);

        switch ($input['action']) {
            case 'Booking':
                Yii::$app->serviceendpointcomp->Booking($inputJSON);
                break;
            case 'Enquiry':
                Yii::$app->serviceendpointcomp->Enquiry($inputJSON);
                break;
            case 'Feedback':
                Yii::$app->serviceendpointcomp->Feedback($inputJSON);
                break;
            default:
                echo json_encode('Action Not Found');
        }
    }
}