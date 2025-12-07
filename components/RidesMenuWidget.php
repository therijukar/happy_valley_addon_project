<?php
namespace app\components;
use yii\base\Widget;
use app\models\Rides;

class RidesMenuWidget extends Widget {
public $rides;
public function init(){
    $this->rides=Rides::find(['soft_delete'=>'0'])->all();
	parent::init();
    if($this->rides===null) {
        $this->rides= array();
    }else{
        $this->rides=$this->rides;
    }
}
public function run(){
                 
return $this->render('ridesView',['models' => $this->rides]);
}
}