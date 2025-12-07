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
        <h2>Enquiries</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>Enquiries</strong>
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
                    <h5>All Feedbacks<h5>
                    <div class="mb-md" style="float: right;">
                        <button class="btn btn-danger" id="bulk" style="margin-top: -8px;" onClick="return confirm('Are you sure you want to delete?');">Bulk Delete</button>
                        <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/enquiry/add" class="btn btn-success" style="margin-top: -8px;"><i class="fa fa-plus"></i>Add</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped  dataTables-zone-list" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><input type="checkbox" name="select_all" id="select_all" value=""/></th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Comment</th>
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
                                                    <td><?=$list->applicant_name?></td>
                                                    <td><?=$list->phone?></td>
                                                    <td><?=$list->email?></td>
                                                    <td><?=$list->website?></td>
                                                    <td><?=$list->comment?></td>
                                                    <td>
                                                        <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/enquiry/delete-enquiry?id=<?php echo $list->id;?>" onClick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-circle" title="DELETE"><i class="fas fa-trash"></i></a>
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
                    columns: [0,2,3,4,5,6]
                }},
                {extend: 'excel', title: 'EnquiryList',exportOptions: {
                    columns: [0,2,3,4,5,6]
                }},
                {extend: 'pdf', title: 'EnquiryList',exportOptions: {
                    columns: [0,2,3,4,5,6]
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
                alert("Please select an Enquiry.");
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
                url: '<?php echo Yii::$app->request->baseUrl . '/admin/enquiry/status' ?>',
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
</script>
