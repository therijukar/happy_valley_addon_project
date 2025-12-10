<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Administrator */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="login-container animated fadeInDown">
    <div class="login-card">
        <div class="login-logo">
            <img src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>img/logo.png" alt="Happy Valley Park">
        </div>
        
        <h3 class="login-title">Welcome Back</h3>
        <p class="login-subtitle">Please sign in to your account</p>

        <?php
        if(isset($msg) && $msg=='Invalid')
        {
            echo"<div class='alert alert-danger'>Invalid Email or Password</div>";
        }
        if(isset($msg) && $msg=='User Type')
        {
            echo"<div class='alert alert-danger'>Access Denied</div>";
        }
        ?>

        <?php $form = ActiveForm::begin(['options' => ['class' => 'login-form']]); ?>
            <div class="input-group-modern">
                <input name="Administrator[email]" id="administrator-email" type="text" class="form-control" placeholder=" " required />
                <label for="administrator-email">Email Address</label>
            </div>
            
            <div class="input-group-modern">
                <input name="Administrator[password]" id="administrator-password" type="password" class="form-control" placeholder=" " required />
                <label for="administrator-password">Password</label>
            </div>
            
            <button type="submit" class="btn btn-primary login-btn">Sign In</button>
            
            <div>
                <a class="forgot-link" href="<?php echo Yii::$app->request->baseUrl;?>/admin/administrator/forgot">Forgot password?</a>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    
    <div style="text-align: center; margin-top: 20px; color: rgba(255,255,255,0.5); font-size: 12px;">
        &copy; <?php echo date('Y'); ?> Happy Valley Park
    </div>
</div>