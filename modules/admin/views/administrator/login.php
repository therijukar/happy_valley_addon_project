<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Administrator */
/* @var $form yii\widgets\ActiveForm */
?>
<style>

    .card-1 {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    .card-1:hover {
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }
    </style>
<section class="body-sign">





    <div class="middle-box text-center loginscreen animated fadeInDown card-1" style="width: 350px; margin-top: 10%; background: #ffd2a0; padding: 20px;">
                <h1 class="logo-name" style="margin-top: 0;"><img src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>img/logo.png"  alt="logohvp" style="width: 45%;"></h1>
            <?php
            if(isset($msg) && $msg=='Invalid')
            {
                echo"<div class='alert alert-danger'>Please check your Email and Password!</div>";

            }
            if(isset($msg) && $msg=='User Type')
            {
                echo"<div class='alert alert-danger'>You aren't eligible access to this module !</div>";

            }
            ?>
                <?php $form = ActiveForm::begin(['options' => ['class' => 'm-t']]); ?>
                <div class="form-group">
                    <input name="Administrator[email]" id="administrator-email" type="text" placeholder="Email" class="form-control input-lg" />
                </div>
                <div class="form-group">
                    <input name="Administrator[password]" id="administrator-password" type="password" placeholder="PASSWORD" class="form-control input-lg" />
                </div>
                <button type="submit" class="btn btn-danger block full-width m-b">Login</button>
               
            <a style="color: #000; font-weight: bold;" href="<?php echo  Yii::$app->request->baseUrl;?>/admin/administrator/forgot">Forgot password ?</a>
                <?php ActiveForm::end(); ?>
    </div>
		</section>