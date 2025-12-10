<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pricing */

$this->title = 'Update Price: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pricing Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-title">
    <?= Html::encode($this->title) ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight" style="padding: 0;">
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Edit Ticket Details</h5>
                </div>
                <div class="ibox-content">
                    <div class="pricing-form">

                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => '0.01', 'class' => 'form-control']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'price_child')->textInput(['type' => 'number', 'step' => '0.01', 'class' => 'form-control']) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'original_price')->textInput(['type' => 'number', 'step' => '0.01', 'class' => 'form-control', 'placeholder' => 'Enter MRP (e.g., 700)']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'discount_label')->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Leave empty to auto-calculate']) ?>
                            </div>
                        </div>
                        
                        <?= $form->field($model, 'description')->textarea(['rows' => 4, 'class' => 'form-control']) ?>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <?= Html::submitButton('Update Ticket', ['class' => 'btn btn-primary btn-lg']) ?>
                            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-white btn-lg']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
