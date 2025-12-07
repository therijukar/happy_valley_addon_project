<?php
namespace app\components;
use Yii;
use app\models\Administrator;

class ServicevalidationComponent{
	
	
	public static function commonCheckParam($inputJSON,$fromAction){
		Yii::info('Inside ServicevalidationComponent.commonCheckParam', 'service');
		Yii::info('Input parameter '.$inputJSON.' From Action '.$fromAction, 'service');
		$status=true;
		$input= json_decode($inputJSON, TRUE );
		foreach ($input as $key => $value) {
			if($key=='' || $value==''){
				$status=false;
				Yii::error('Inside ServicevalidationComponent.marchantLogin. Parameter Missing '.$key.' or '.$value, 'service');
			}
		}
		return $status;
	}
	
	public static function checkUser($inputJSON,$fromAction){
		Yii::info('Inside ServicevalidationComponent.checkUser', 'service');
		Yii::info('Input parameter '.$inputJSON.' From Action '.$fromAction, 'service');
		$status=true;
		$input= json_decode($inputJSON, TRUE );
		if(!isset($input['UserId'])){
			$status=false;
		}else{
			$appuser=Administrator::findOne(['administratorid'=>$input['UserId']]);
			if($appuser==''){
				$status=false;
			}
		}
		return $status;
	}
	

	
}