<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$session = Yii::$app->session;

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

                    <div class="middle-box text-center loginscreen animated fadeInDown card-1" style="width: 350px; margin-top: 12%; background: #ffd2a0; padding: 20px;">
                        <h1 class="logo-name" style="margin-top: 0;"><img src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>img/logo.png"  alt="OPT" style="width: 45%;"></h1>
                        <?php

                            if (isset($session['Sent']) == 'Sent') {
                                echo "<div class='alert alert-success' style='text-align: center;'><strong>Mail Sent Successfully Please check your email!</strong></div>";
                                unset($session['Sent']);
                            }elseif(isset($session['failed']) == 'failed') {
                                echo "<div class='alert alert-danger' style='text-align: center;'><strong>Mail not sent!</strong></div>";
                                unset($session['failed']);
                            }
                            ?>
                            <?php $form = ActiveForm::begin(['options' => ['class' => 'm-t']]); ?>
                            <div class="form-group">
                                <input name="email" id="email" type="text" placeholder="Email" class="form-control input-lg" />
                            </div>
                            <button type="submit" style="float: left; width: 48%; margin-right: 2%" class="btn btn-danger block m-b">Submit</button>

                            <a class="btn btn-danger block m-b" style="float: left; width: 48%; " href="<?php echo  Yii::$app->request->baseUrl;?>/admin/administrator/login">BACK</a>
                        <br><br>
                            <?php ActiveForm::end(); ?>


                    </div>
                </section>
