<?php
/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 18-07-2018
 * Time: 16:44
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$session = Yii::$app->session;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>

            <li class="active">
                <strong>Booking</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<!-- start: page -->

<!-- FLASH MESSAGE STARTS HERE -->

<?php
if (isset($session['Falseinc']) == 'Falseinc') {
    echo "<div class='alert alert-danger' style='text-align: center;'><strong>Password Incorrct</strong></div>";
    unset($session['Falseinc']);
}
?>

<?php
if (isset($session['False']) == 'False') {
    echo "<div class='alert alert-danger' style='text-align: center;'><strong>New Password and Confirm Password not same</strong></div>";
    unset($session['False']);
}


?>

<!-- FLASH MESSAGE ENDS HERE -->


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Booking</h5>

                    <!--<div class="mb-md" style="float: right;">
                        <a href="<?php /*echo  Yii::$app->request->baseUrl;*/?>/admin/administrator/list" class="btn btn-primary" style="margin-top: -8px;">User</a>

                    </div>-->
                </div>
                <div class="ibox-content">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>


                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Booking[name]" id="productmaster-name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Booking[phone]" id="productmaster-price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="Booking[email]" id="productmaster-max_unit">
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" name="Booking[is_active]" value="1" checked> Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="Booking[is_active]" value="0"> Inactive
                                </label>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>


                        <div class="col-sm-9 col-sm-offset-2 float_1">
                            <!--<button class="btn btn-primary">Submit</button>-->
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <!--<input name="submit" id="submit" value="Submit" type="submit" class="btn btn-primary">-->
                            <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/booking/list" class="btn btn-white">Cancel</a>
                            <!-- <button type="reset" class="btn btn-default">Reset</button> -->

                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- PAGE ENDS HERE -->
<script>
    $(function(){
        $('#state-name').on('blur',function(){
             var eid = $('#state-name').val();
             if(eid =='')
             {
                 //alert ("Please give a email id first");
                 $('#state-name').val('');
                 $('#state-name').css({'border-color': 'red'});
                 $('#sml-msg').show();
                 $('#sml-msg').text('Please Give a State Name first');
             }
             else
             {        
                $.ajax({
                    url: "<?php echo  Yii::$app->request->baseUrl;?>/admin/state-master/get-zone-name",
                    type: 'POST',
                    data: {eid: eid},
                    success: function (data) {
                      var dataJson = JSON.parse(data);
                        //console.log(dataJson);
                        if(dataJson.status == 200)
                        {
                            $('#state-name').css({'border-color': 'green'});
                            $('#sml-msg').hide();
                            $('#sml-msg').text('');
                        }
                        else if(dataJson.status == 500)
                        {
                            $('#sml-msg').show();
                            $('#sml-msg').text('This State Name already in use, please give another one');
                            $('#state-name').css({'border-color': 'red'});
                            $('#state-name').val('');
                        }
                    
                    }
                });

            }
        });

    });
    
    </script>