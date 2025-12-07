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
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Bookings</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped  dataTables-zone-list" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Booked From</th>
                                    <th>Booking Category</th>
                                    <th>Below 10 Years</th>
                                    <th>Above 10 Years</th>
                                    <th>Total Booking</th>
                                    <th>Date</th>
                                    <th>Ticket No.</th>
                                    <th>Transaction Id.</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Verify Booking</th>
                                    <th>Resend Otp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $increment=1;
                                        foreach($lists as $list)
                                        {
                                            if($list->product==1){
                                                $booking_category= "Resturant Booking";
                                            }
                                            if($list->product==2){
                                                $booking_category= "Banquet Booking";
                                            }
                                            if($list->product==3){
                                                $booking_category= "Picnic Spot Booking";
                                            }
                                            if($list->product==4){
                                                $booking_category= "Entry Ticket";
                                            }
                                            if($list->product==5){
                                                $booking_category= "Water Park + Park Ride Booking";
                                            }
                                            // if($list->product==6){
                                            //     $booking_category= "5D Ticket Booking";
                                                if($list->product==6){
                                                $booking_category= "Dry Park Combo";
                                            }
                                            if($list->product==7){
                                                $booking_category= "Full Package";
                                            }
                                            if($list->product==8){
                                                $booking_category= "Water World";
                                            }
                                            if($list->product==9){
                                                $booking_category= "Water Dry Combo";
                                            }
                                            ?>
                                                <tr>
                                                    <td><?=$increment?></td>
                                                    <td><?=$list->name;?></td>
                                                    <td><?=$list->phone;?></td>
                                                    <td><?php echo $list->type=='1'?'Web':'App'; ?></td>
                                                    <td><?php echo $booking_category ; ?></td>
                                                    <td><?php echo $list->belowtenyears ; ?></td> 
                                                    <td><?php echo $list->abovetenyears ; ?></td>
                                                    <td><?php echo $list->no_of_units ; ?></td>
                                                    <td><?php echo isset($list->date)? date('d-m-Y', strtotime($list->date)) : ''; ?></td>
                                                    <td><?php echo $list->ticket_no; ?></td>
                                                    <td><?php echo $list->payment->txn_id; ?></td>
                                                    <td>
                                                        <?php if ($list->visited == '0') {
                                                            ?>
                                                            <button class="btn btn-primary chng" id="<?php echo $list->id; ?>" data-visit = "1" >Not Visited</button>
                                                            <?php 
                                                        }else{
                                                        ?>
                                                            <button class="btn btn-danger" id="<?php echo $list->id; ?>" data-visit = "0">Visited</button>
                                                        <?php 
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-info btn-circle" title="Detail" onclick="getDetail(<?php echo $list->id; ?>)"><i class="fas fa-info-circle"></i></a>
                                                    </td>
                                                    <td>
                                                        
                                                          <?php if (($list->status == 0) && ($list->otp != null )){ ?>
                                                         
        <button type="button" class="btn btn-primary" onclick="setBookingId(<?= $list->id ?>)" data-toggle="modal" data-target="#otpModal">Verify</button>

                                                          <?php } else{ ?>
                                                          
                                                          
                                                          <p>Booking Verified</p>
                                                          
                                                          <?php } ?>
                                                        
                                                    </td>
                                                   
                                                    <td>
                                                          <?php if (($list->status == 0)){ ?>                                                      
                                                 <button type="button" class="btn btn-primary" onclick="resendOtp(<?= $list->id ?>)">Send</button>

                                                    
                                                         <?php } ?> 
                                                         
                                                         
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
        </div>
    </div>

</div>

<div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otpModalLabel">Enter OTP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- OTP input form -->
                <form id="otpForm">
                    <div class="form-group">
                        <label for="otpInput">OTP:</label>
                        <input type="text" class="form-control" id="otpInput" name="otp">
                        <input type="hidden" id="bookingIdInput" name="bookingId">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitOtpBtn">Submit OTP</button>
            </div>
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
                                <label for="Product" class="col-md-2">Name</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'name'></span>  
                            </div>
                            <div>
                                <label for="amount" class="col-md-2">Phone</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'phone'></span>  
                            </div>
                        </div>
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
                                <label for="to" class="col-md-2">Date</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'date'></span>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label for="txnid" class="col-md-2">Transaction Id</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'txnid'></span>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label for="payuid" class="col-md-2">PayuMoney Id</label>
                                <span class="col-md-1">:</span>
                                <span class="col-md-3" id = 'payu_id'></span>
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

   function setBookingId(bookingId) {
        document.getElementById('bookingIdInput').value = bookingId;
    }

      $('#submitOtpBtn').click(function() {
        var otp = $('#otpInput').val();
        let bookingId = $('#bookingIdInput').val();

         console.log('otp');
         console.log(otp);
         console.log('booking id');
          console.log(bookingId);
        // Make an AJAX request to verify OTP
        $.ajax({
            url: '/admin/booking/verify-otp',
            type: 'POST',
            data: { otp: otp, bookingId: bookingId },
            success: function(response) {

                if (response.success) {
                    alert(response.message);
                    $('#otp-modal').modal('hide');
                } else {
                    // Display error message
                    alert(response.message);
                }
                location.reload(); 
            },
            error: function(xhr, status, error) {
                // Handle error (e.g., display error message)
                alert('Error: ' + error);
            }
        });
    });

    function resendOtp(bookingId) {
     
        $.ajax({
            url: '/admin/booking/resend-otp',
            type: 'POST',
            data: { bookingId: bookingId },
            success: function(response) {

                if (response.success) {
                    alert('Otp Sent Sucessfully');
                } else {
                    // Display error message
                    alert(response.message);
                }
                location.reload(); 
            },
            error: function(xhr, status, error) {
                // Handle error (e.g., display error message)
                alert('Error: ' + error);
            }
        });
    };

    $(document).ready(function(){

        $('.dataTables-zone-list').DataTable({

            responsive: true,
            dom: "<'html5buttons'B>lfrt<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [

                {extend: 'csv',title:'BookingList',exportOptions: {
                    columns: [0,5,6]
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
        $(".chng").on("click", function () {
            var visited = $(this).attr("data-visit");
            var id = $(this).attr('id');
            // alert(visited);
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl . '/admin/booking/status' ?>',
                type: 'post',
                data: {visited: visited, id: id, success: 'true'},
                dataType: "text",
                success: function (data, status, xhr) {
                    if(xhr.status==200)
                    {
                        $("#getCodeModal").modal('show');
                        setTimeout(function(){
                            location.reload();
                        },2000);
                    }
                }

            });
        });
    });
ch
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
                        var name = output['name'];
                        var phone = output['phone'];
                        var units = output['units'];
                        var amount = output['amount'];
                        var date = output['date'];
                        var product = output['product'];
                        var txnid = output['txnid'];
                        var payu_id = output['payu_id'];

                        // if output is not available for a particular attr its divv is hidden
                        name == 'N/A' ? $('#name').parent().attr('hidden',true):$('#name').text(name) && $('#name').parent().removeAttr('hidden');
                        phone == 'N/A' ? $('#phone').parent().attr('hidden',true):$('#phone').text(phone) && $('#phone').parent().removeAttr('hidden');
                        units == 'N/A' ? $('#units').parent().attr('hidden',true):$('#units').text(units) && $('#units').parent().removeAttr('hidden');
                        amount == 'N/A' ? $('#amount').parent().attr('hidden',true):$('#amount').text(amount) && $('#amount').parent().removeAttr('hidden');
                        date == 'N/A' ? $('#date').parent().attr('hidden',true):$('#date').text(date) && $('#date').parent().removeAttr('hidden');
                        product == 'N/A' ? $('#product').parent().attr('hidden',true):$('#product').text(product) && $('#product').parent().removeAttr('hidden');
                        txnid == 'N/A' ? $('#txnid').parent().attr('hidden',true):$('#txnid').text(txnid) && $('#txnid').parent().removeAttr('hidden');
                        payu_id == 'N/A' ? $('#payu_id').parent().attr('hidden',true):$('#payu_id').text(payu_id) && $('#payu_id').parent().removeAttr('hidden');

                        $("#getDetail").modal('show');
                    }
                }

            });        
    }
</script>
