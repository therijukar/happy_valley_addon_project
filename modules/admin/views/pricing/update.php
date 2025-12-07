<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pricing */

$this->title = 'Update Price: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pricing Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pricing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="pricing-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => '0.01']) ?>

        <?= $form->field($model, 'price_child')->textInput(['type' => 'number', 'step' => '0.01']) ?>

        <?= $form->field($model, 'original_price')->textInput(['type' => 'number', 'step' => '0.01', 'placeholder' => 'Enter MRP (e.g., 700)']) ?>

        <?= $form->field($model, 'discount_label')->textInput(['maxlength' => true, 'placeholder' => 'Leave empty to auto-calculate (e.g., 20% OFF)']) ?>
        
        <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
