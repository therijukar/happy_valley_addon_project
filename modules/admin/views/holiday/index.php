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

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>


        <div class="col-md-6 text-right">
            <?= Html::button('Add Holiday', ['class' => 'btn btn-success mb-3', 'style' => 'margin-top: 14px;', 'id' => 'add-holiday-button']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <?php
    // Display success flash message if available
    if (Yii::$app->session->hasFlash('success')) {
    echo Alert::widget([
    'options' => ['class' => 'alert-success'],
    'body' => Yii::$app->session->getFlash('success'),
    ]);
    }
    
    // Display error flash message if available
    if (Yii::$app->session->hasFlash('error')) {
    echo Alert::widget([
    'options' => ['class' => 'alert-danger'],
    'body' => Yii::$app->session->getFlash('error'),
    ]);
    }
?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'date',
                'format' => ['datetime', 'php:d/m/Y']
            ],
            [
                'attribute' => 'reason',
                'label' => 'Type'
               
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}', // Show only the delete button
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'class' => 'btn btn-xs btn-danger',
                        ]);
                    },
                ],
            ],
        ]
    ]); ?>

</div>
<div class="modal fade  " id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otpModalLabel">Holiday Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- OTP input form -->
                <?php
                    $form = ActiveForm::begin([
                        'id' => 'add-holiday-form',
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                    ]);
                    ?>

                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group">
                        <?= $form->field($model, 'date')->textInput(['class' => 'form-control', 'id' => 'datepicker', 'autocomplete' => 'off']) ?>


                                 </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?= $form->field($model, 'reason')->dropDownList(['entry_ticket' => 'Entry Ticket','fived_ticket' => 'Five D Show Ticket','water_world' => 'Water World Ticket'])->label('Type') ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'form' => 'add-holiday-form']) ?>

            </div>
            <?php ActiveForm::end();?>

        </div>
    </div>
</div>


<script>
$(function() {
    // Get the current date
    var currentDate = new Date();

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

});

    $('#add-holiday-button').click(function () {

        $('#otpModal').modal('show');
    });
    $('#add-holiday-form').on('submit', function (e) {
    e.preventDefault(); // Prevent default form submission
    
    var selectedDate = $('#datepicker').val();
     
    if(selectedDate == "")
    {
        
        alert('Date cannot be empty');
        return false;
    }
    $.ajax({
        url: "<?= Url::to(['/admin/holiday/create']) ?>",
        type: 'POST', // Use POST method
        data: $(this).serialize(), // Serialize form data
        success: function (response) {
            $('#add-holiday-modal').modal('hide');
            window.location.reload();
        },
        error: function (xhr, status, error) {
            // Handle errors
        }
    });
});

</script>