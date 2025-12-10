<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add New Popup';
?>

<div class="page-title">
    <?= Html::encode($this->title) ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight" style="padding: 0;">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Upload Popup Image</h5>
                </div>
                <div class="ibox-content">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($model, 'title')->textInput(['class' => 'form-control', 'placeholder' => 'Enter Title (Optional)']) ?>

                    <?= $form->field($model, 'image_url')->fileInput(['class' => 'form-control'])->label('Popup Image') ?>
                    
                    <div class="form-group form-check">
                         <?= $form->field($model, 'status')->checkbox(['class' => 'form-check-input', 'label' => 'Set as Active (Will deactivate others)']) ?>
                    </div>

                    <div class="form-group mt-3">
                        <?= Html::submitButton('Save Popup', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-white']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
