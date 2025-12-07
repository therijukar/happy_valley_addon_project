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
        <h2><?php echo $product; ?> Enquiries</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>Enquiry for <?php echo $product; ?></strong>
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
            <?php $form = ActiveForm::begin(['action' =>['enquiry/bulkdelete'], 'id' => 'administratorbulkdelete', 'method' => 'post',],['options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Enquiry For <?php echo $product; ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped  dataTables-zone-list" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Enquired From</th>
                                    <th>Product</th>
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
                                                    <td><?=$list->name;?></td>
                                                    <td><?=$list->email;?></td>
                                                    <td><?php echo $list->type=='1'?'Web':'App'; ?></td>
                                                    <td><?=$product;?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-info btn-circle" title="Detail" onclick="getDetail(<?php echo $list->id; ?>)"><i class="fas fa-info-circle"></i></a>
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
                <h4 class="modal-title">Enquiry Details</h4>
            </div>
            <div class="modal-body" id="getCode">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3 id="name1"></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div>
                                <label for="Name" class="col-md-2">Name</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'name2'></span>  
                            </div>
                            <div>
                                <label for="Phone" class="col-md-2">Phone</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'phone'></span>  
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label for="Email" class="col-md-2">Email</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'email'></span>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label for="Product" class="col-md-2">Product</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'product'></span>
                            </div>
                            <div>
                                <label for="to" class="col-md-2">Time</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'time'></span>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label for="from" class="col-md-2">Date</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'from_date'></span>
                            </div>
                            <div>
                                <label for="to" class="col-md-2">To Date</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'to_date'></span>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label for="No. Of People" class="col-md-2">No. Of People</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'people'></span>
                            </div>
                            <div>
                                <label for="No. Of Spots" class="col-md-2">No. Of Spots</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'spots'></span>
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

                {extend: 'csv',title:'EnquiryList',exportOptions: {
                    columns: [0,2,3]
                }},
                {extend: 'excel', title: 'EnquiryList',exportOptions: {
                    columns: [0,2,3]
                }},
                {extend: 'pdf', title: 'EnquiryList',exportOptions: {
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
function getDetail(id){
    $.ajax({
            url: '<?php echo Yii::$app->request->baseUrl . '/admin/enquiry/enquiry-detail' ?>',
            type: 'post',
            data: {id: id, success: 'true'},
            dataType: "text",
            success: function (data, status, xhr) {
                if(xhr.status==200)
                {
                    var output = JSON.parse(data);
                    var name = output['name'];
                    var phone = output['phone'];
                    var email = output['email'];
                    var time = output['time'];
                    var product = output['product'];
                    var people = output['people'];
                    var spots = output['spots'];
                    var from_date = output['from_date'];
                    var to_date = output['to_date'];

                    // if output is not available for a particular attr its divv is hidden
                    $('#name1').text(name);
                    $('#name2').text(name);
                    $('#phone').text(phone);
                    $('#email').text(email);
                    spots == 'N/A' ? $('#spots').parent().attr('hidden',true):$('#spots').text(spots);
                    people == 'N/A' ? $('#people').parent().attr('hidden',true):$('#people').text(people);
                    from_date == 'N/A' ? $('#from_date').parent().attr('hidden',true):$('#from_date').text(from_date);
                    to_date == 'N/A' ? $('#to_date').parent().attr('hidden',true):$('#to_date').text(to_date);
                    time == 'N/A' ? $('#time').parent().attr('hidden',true):$('#time').text(time);
                    product == 'N/A' ? $('#product').parent().attr('hidden',true):$('#product').text(product);

                    $("#getDetail").modal('show');
                }
            }

        }); 
    }       
</script>
