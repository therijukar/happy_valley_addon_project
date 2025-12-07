<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\Util;

/* @var $this yii\web\View */
/* @var $model app\models\Administrator */
/* @var $form yii\widgets\ActiveForm */
$session = Yii::$app->session;

?>
<style>
    .normal-body {
        display: none;
    }
    .input-group-addon{
        cursor: pointer;
    }
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Change Password</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>

            <li class="active">
                <strong>Change Password</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<!-- start: page -->

<?php
if (isset($session['False']) == 'False') {
    echo "<div class='alert alert-danger' style='text-align: center;'><strong>New Password and Confirm Password not same</strong></div>";
    unset($session['False']);
}
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Change Password</h5>
                </div>
                <div class="ibox-content">
                    <?php $form = ActiveForm::begin(['action' =>['administrator/change-pass'],'options' => ['enctype' => 'multipart/form-data']]); ?>
                    <input type="hidden" name = "admin_id" value="<?php echo $model->administratorid; ?>">
                    <div class="row">
                        <div class="col-md-1">
                            <label class="control-label">New Password</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="password" class="form-control" name="new_pass" id="new_pass">
                                <span class="input-group-addon" id="shownew"><i class="fa fa-eye"></i></span>    
                            </div>
                        </div>
                        <div class="col-md-offset-1 col-md-1">
                            <label class="control-label">Confirm Password</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="password" class="form-control" name="cnf_pass" id="cnf_pass">
                                <span class="input-group-addon" id="showcnf"><i class="fa fa-eye"></i></span>    
                            </div>
                        </div><br><br><br>

                        <div class="col-md-2 col-md-offset-5">
                            <input type="submit" class="btn btn-success" value="Change">
                        </div>
                         <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#shownew').on('click', showpass);
        $('#showcnf').on('click', showpass);
    });
    function showpass(){
        $(this).children().toggleClass('fa-eye-slash','fa-eye');

        if ($(this).children().hasClass('fa-eye-slash')) {
            $(this).siblings().attr('type','text');
        }
        else{
            $(this).siblings().attr('type','password');
        }
    }
</script>