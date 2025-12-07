<?php
/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 18-07-2018
 * Time: 14:35
 */
use \app\models\ZoneMaster;
/* @var $this yii\web\View */
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
<br>

<!-- FLASH MESSAGE STARTS HERE -->


<!-- FLASH MESSAGE ENDS HERE -->


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['action' =>['booking/bulkdelete'], 'id' => 'administratorbulkdelete', 'method' => 'post',],['options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Bookings</h5>
                    <div class="mb-md" style="float: right;">
                        <button class="btn btn-danger" id="bulk" style="margin-top: -8px;" onClick="return confirm('Are you sure you want to delete?');">Bulk Delete</button>
                        <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/booking/add" class="btn btn-success" style="margin-top: -8px;"><i class="fa fa-plus"></i>Add</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped  dataTables-zone-list" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><input type="checkbox" name="select_all" id="select_all" value=""/></th>
                                    <th>Email</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $increment=1;
                                        foreach($lists as $list)
                                        {
                                            ?>
                                                <tr>
                                                    <td><?=$increment?></td>
                                                    <td align="left"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $list->id; ?>"/></td>
                                                    <td><?=$list->booking->email;?></td>
                                                    <td><?=$list->product->name;?></td>
                                                    <td>
                                                        <select id="<?php echo $list->id; ?>" class="chng form-control">
                                                            <option value="0" <?php if ($list->is_active == '0') echo "selected"; ?>>Inactive</option>
                                                            <option value="1" <?php if ($list->is_active == '1') echo "selected"; ?>>Active</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-info btn-circle" title="Detail" onclick="getDetail(<?php echo $list->id; ?>)"><i class="fas fa-info-circle"></i></a> |
                                                        <a href="<?php echo Yii::$app->homeUrl.'admin/booking/edit-booking?id='.$list->id;?>" class="btn btn-primary btn-circle" title="EDIT"><i class="fa fa-edit"></i></a> | <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/booking/delete-booking?id=<?php echo $list->id;?>" onClick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-circle" title="DELETE"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            $increment++;
                                        }
                                    ?>
                                   
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

<!-- DETAIL MODAL STARTS HERE -->
<div class="modal fade" id="getDetail" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Booking Details</h4>
            </div>
            <div class="modal-body" id="getCode">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3 id="email"></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div>
                                <label for="Product" class="col-md-2">Product</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'product'></span>  
                            </div>
                            <div>
                                <label for="amount" class="col-md-2">Amount</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'amount'></span>  
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label for="units" class="col-md-2">Units</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'units'></span>
                            </div>
                            <div>
                                <label for="units" class="col-md-2">Spots</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'spots'></span>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label for="addons" class="col-md-2">Addons</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'addons'></span>
                            </div>
                            <div>
                                <label for="to" class="col-md-2">Time</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'time'></span>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label for="from" class="col-md-2">From Date</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'from_date'></span>
                            </div>
                            <div>
                                <label for="to" class="col-md-2">To Date</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'to_date'></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- DETAIL MODAL ENDS HERE -->

<!-- MODAL STARTS HERE -->
<div class="modal fade" id="getCodeModal" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">MESSAGE</h4>
            </div>
            <div class="modal-body" id="getCode">
                <h3 class="text-center">Successfully Updated</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- MODAL ENDS HERE -->


<script>
    $(document).ready(function(){

        $('.dataTables-zone-list').DataTable({

            responsive: true,
            dom: "<'html5buttons'B>lfrt<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [

                {extend: 'csv',title:'BookingList',exportOptions: {
                    columns: [0,2,3]
                }},
                {extend: 'excel', title: 'BookingList',exportOptions: {
                    columns: [0,2,3]
                }},
                {extend: 'pdf', title: 'BookingList',exportOptions: {
                    columns: [0,2,3]
                }},


                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ],

        });

        $('#select_all').on('click',function(){
            if(this.checked){
                $('.checkbox').each(function(){
                    this.checked = true;
                });
            }else{
                $('.checkbox').each(function(){
                    this.checked = false;
                });
            }
        });

        $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#select_all').prop('checked',true);
            }else{
                $('#select_all').prop('checked',false);
            }
        });

        $('#bulk').on('click',function(){
            var chks = document.getElementsByName('checked_id[]');
            var hasChecked = false;
            for (var i = 0; i < chks.length; i++)
            {
                if (chks[i].checked)
                {
                    hasChecked = true;
                    break;
                }
            }
            if (hasChecked == false)
            {
                alert("Please select a Product.");
                return false;
            }
            return true;
        });

    });
</script>
<script>
    $(document).ready(function () {
        $(".chng").on("change", function () {
            var is_active = $(this).val();
            var id = $(this).attr('id');
            // alert(is_active);
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl . '/admin/booking/status' ?>',
                type: 'post',
                data: {is_active: is_active, id: id, success: 'true'},
                dataType: "text",
                success: function (data, status, xhr) {
                    if(xhr.status==200)
                    {
                        $("#getCodeModal").modal('show');
                    }
                }

            });
        });
    });

    function getDetail(id){
        $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl . '/admin/booking/booking-detail' ?>',
                type: 'post',
                data: {id: id, success: 'true'},
                dataType: "text",
                success: function (data, status, xhr) {
                    if(xhr.status==200)
                    {
                        var output = JSON.parse(data);
                        var email = output['email'];
                        var time = output['time'];
                        var units = output['units'];
                        var spots = output['spots'];
                        var amount = output['amount'];
                        var from_date = output['from_date'];
                        var to_date = output['to_date'];
                        var product = output['product'];
                        var addons = output['addons'];

                        // if output is not available for a particular attr its divv is hidden
                        $('#email').text(email)
                        units == 'N/A' ? $('#units').parent().attr('hidden',true):$('#units').text(units);
                        spots == 'N/A' ? $('#spots').parent().attr('hidden',true):$('#spots').text(spots);
                        amount == 'N/A' ? $('#amount').parent().attr('hidden',true):$('#amount').text(amount);
                        from_date == 'N/A' ? $('#from_date').parent().attr('hidden',true):$('#from_date').text(from_date);
                        to_date == 'N/A' ? $('#to_date').parent().attr('hidden',true):$('#to_date').text(to_date);
                        time == 'N/A' ? $('#time').parent().attr('hidden',true):$('#time').text(time);
                        product == 'N/A' ? $('#product').parent().attr('hidden',true):$('#product').text(product);
                        addons == 'N/A' ? $('#addons').parent().attr('hidden',true):$('#addons').text(addons);

                        $("#getDetail").modal('show');
                    }
                }

            });        
    }
</script>
