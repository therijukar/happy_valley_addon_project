<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//$session = Yii::$app->session;

?>
<style>
    .container{
        height: 100%;
    }
</style>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading text-center">
                <h4>Select Addons For <?php echo $name ?></h4>
            </div>
            <?php $form = ActiveForm::begin(['action' =>['booking/book'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
            <input type="hidden" name="booking_prod" value="<?php echo $booking_prod ?>">
            <div class="panel-body row">
                <div class="col-md-2 col-sm-2">
                    <label for="number">#</label>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label for="Name">Name</label>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label for="Price">Price</label>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label for="Category">Category</label>
                </div>
                <div class="col-md-1 col-sm-1">
                    <label for="Select">Select</label>
                </div>
                <?php 
                    $i = 1;
                    foreach ($lists as $list) {
                    ?>
                    <div class="col-md-2 col-sm-2"><?php echo $i; ?></div>
                    <div class="col-md-3 col-sm-3">
                        <span><?php echo $list->name ?></span>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <span><?php echo $list->price ?></span>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <span><?php echo $list->category ?></span>
                    </div>
                    <div class="col-md-1 col-sm-1">
                        <input type="checkbox" name="addons[]" onclick="calcTot(<?php echo $list->price ?>, this.checked)" value="<?php echo $list->id; ?>">
                    </div>
                    <?php 
                    $i++;
                    }
                 ?>
                 <br><br>
                 <div class="col-md-1">
                    <label for="number">Total : </label>
                </div>
                <div class="col-md-2">
                    <input type="hidden" name="BookingProd[amount]" id="hid_total" value="<?php echo $tot_price ?>">
                    <span id="total"><?php echo $tot_price; ?></span>
                </div>

                 <div class="col-md-4 text-right">
                     <br><button class="btn btn-primary" name="submit">Submit</button>
                 </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>

<script>
    function calcTot(price,chk){
        var prev_tot = parseFloat($('#hid_total').val());
        if (chk == false) {price = -price;}
        var new_tot = price+prev_tot;
        $('#total').html(new_tot); 
        $('#hid_total').val(new_tot);
    }
</script>

<!-- PAGE ENDS HERE -->