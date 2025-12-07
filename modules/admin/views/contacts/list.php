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
        <h2>Contacts</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>Contacts</strong>
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
                    <h5>Contact Details</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped  dataTables-zone-list" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Message</th>
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
                                                    <td><?=$list->phone;?></td>
                                                    <td><?=$list->email;?></td>
                                                    <td><?php echo date('d-M-Y', strtotime($list->date));?></td>
                                                    <td><?=$list->message;?></td>
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

