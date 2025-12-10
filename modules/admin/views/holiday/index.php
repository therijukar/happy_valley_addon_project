<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\bootstrap\Alert;

$this->title = 'Holiday Management';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-title">
    <?= Html::encode($this->title) ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight" style="padding: 0;">
    <div class="row">
        <div class="col-lg-12">
            
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= Yii::$app->session->getFlash('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= Yii::$app->session->getFlash('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Holiday List</h5>
                    <div class="ibox-tools">
                        <?= Html::button('<i class="fa fa-plus"></i> Add Holiday', ['class' => 'btn btn-primary btn-sm', 'id' => 'add-holiday-button']) ?>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' => ['class' => 'table dataTable'],
                            'summary' => '',
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'date',
                                    'format' => ['date', 'php:d M Y'], // Premium date format
                                    'label' => 'DATE',
                                    'contentOptions' => ['style' => 'font-weight: 600; color: var(--text-main);'],
                                ],
                                [
                                    'attribute' => 'reason',
                                    'label' => 'HOLIDAY TYPE',
                                    'value' => function($model) use ($ticketTypes) {
                                        return isset($ticketTypes[$model->reason]) ? $ticketTypes[$model->reason] : $model->reason;
                                    },
                                    'contentOptions' => ['style' => 'color: var(--text-muted);'],
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'ACTIONS',
                                    'template' => '{delete}',
                                    'buttons' => [
                                        'delete' => function ($url, $model, $key) {
                                            return Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
                                                'title' => Yii::t('yii', 'Delete'),
                                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this holiday?'),
                                                'data-method' => 'post',
                                                'class' => 'btn btn-white btn-sm',
                                                'style' => 'color: var(--danger); border-color: var(--border-color);'
                                            ]);
                                        },
                                    ],
                                ],
                            ]
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Holiday Modal -->
<div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otpModalLabel">Add New Holiday</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <?php $form = ActiveForm::begin([
                'id' => 'add-holiday-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => false,
            ]); ?>
            
            <div class="modal-body">
                <div class="form-group">
                    <label>Select Date</label>
                    <?= $form->field($model, 'date')->textInput(['class' => 'form-control', 'id' => 'datepicker', 'autocomplete' => 'off', 'placeholder' => 'YYYY-MM-DD'])->label(false) ?>
                </div>

                <div class="form-group">
                    <label>Holiday Type (Block Booking)</label>
                    <?= $form->field($model, 'reason')->dropDownList($ticketTypes, ['class' => 'form-control', 'prompt' => 'Select Ticket Type'])->label(false) ?>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Save Holiday', ['class' => 'btn btn-primary', 'form' => 'add-holiday-form']) ?>
            </div>
            
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>

<script>
$(function() {
    // Initialize the datepicker
    $('#datepicker').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: false,
        autoclose: true,
        startDate: new Date(),
        format: "yyyy-mm-dd"
    });

    $('#add-holiday-button').click(function () {
        $('#otpModal').modal('show');
    });

    $('#add-holiday-form').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission
        
        var selectedDate = $('#datepicker').val();
         
        if(selectedDate == "") {
            alert('Date cannot be empty');
            return false;
        }

        $.ajax({
            url: "<?= Url::to(['/admin/holiday/create']) ?>",
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if(response.success) {
                    $('#otpModal').modal('hide');
                    location.reload(); 
                } else {
                    alert('Error saving holiday');
                }
            },
            error: function (xhr, status, error) {
                alert('Network Error');
            }
        });
    });
});
</script>