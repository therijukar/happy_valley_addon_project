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
        <h2>Addon</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>

            <li class="active">
                <strong>Addon</strong>
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
                    <h5>Edit Addon</h5>

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
                                 <input type="text" class="form-control"  name="AddonMaster[name]" id="addon-name" value="<?php echo $model->name;?>" title="Only Text Allow">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-8">
                                 <input type="text" class="form-control" name="AddonMaster[price]" id="addon-price" value="<?php echo $model->price;?>" title="Only Text Allow">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label">Product</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="AddonMaster[product_id]" id="product" required>
                                    <?php
                                        foreach($products as $pro)
                                        {
                                            ?>
                                                <option value="<?=$pro->id?>" <?php echo ($pro->id == $model->product_id)?'selected':'' ?> ><?=$pro->name?></option>
                                            <?php
                                        }
                                    ?>

                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-8">
                                 <input type="text" class="form-control" name="AddonMaster[category]" id="addon-category" value="<?php echo $model->category;?>" title="Only Text Allow">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" name="AddonMaster[is_active]" value="1" <?php echo ($model->is_active==1) ?'checked':'' ?> > Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="AddonMaster[is_active]" value="0" <?php echo ($model->is_active==0) ?'checked':'' ?> > Inactive
                                </label>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>


                        <div class="col-sm-9 col-sm-offset-2 float_1">
                            <!--<button class="btn btn-primary">Submit</button>-->
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <!--<input name="submit" id="submit" value="Submit" type="submit" class="btn btn-primary">-->
                            <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/addon-master/list" class="btn btn-white">Cancel</a>
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