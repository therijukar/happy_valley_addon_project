<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAdminAsset;

AppAdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="fixed">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/img/fav.png" type="image/favicon"/>
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/animate.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/style.css"/>
    <!-- MODERN UI OVERRIDE -->
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/css/admin-modern.css?v=1.2' ?>"/>

    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Head Libs -->
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/jquery-2.1.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/jquery.timepicker.css" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="fixed-sidebar md-skin">

<?php
$session = Yii::$app->session;

if (!isset($session['administrator']['administratorid'])) {
    return Yii::$app->getResponse()->redirect(array('admin/administrator/login',));
} 
?>
<section class="body">
    <!-- header start -->

    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                     
                    <li class="nav-header">
                        <div class="dropdown profile-element"> 
                             <h2 style="color: white; font-weight: 700; margin-bottom: 20px; font-size: 20px;">Happy Valley</h2>
                            
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $session['administrator']->name; ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $session['administrator']->email; ?><b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo Yii::$app->request->baseUrl; ?>/admin/administrator/profile?id=<?php echo $session['administrator']->administratorid; ?>">Change Password</a></li>

                                <li class="divider"></li>
                                <li><a href="<?php echo Yii::$app->homeUrl . 'admin/administrator/logout' ?>">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                         HV
                        </div>
                    </li>
                    

                    <li  <?php if (strstr($_SERVER['REQUEST_URI'], "admin")){ ?>class="active"<?php } ?>>
                        <a href="<?php echo Yii::$app->homeUrl . 'admin' ?>">
                            <i class="fas fa-tachometer-alt" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li <?php if (strstr($_SERVER['REQUEST_URI'], "booking")){ ?>class="active"<?php } ?>>
                        <a href="<?php echo Yii::$app->homeUrl . 'admin/booking/list' ?>">
                            <i class="fas fa-ticket-alt"></i>
                            <span>Ticket</span>
                        </a>
                    </li>
                    <li <?php if(strstr($_SERVER['REQUEST_URI'],"enquiry")){ ?>class="active"<?php }?>>
                        <a href="#"><i class="fas fa-question"></i></i> <span class="nav-label">Enquiry</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li <?php if (strstr($_SERVER['REQUEST_URI'], "pid=1")){ ?>class="active"<?php } ?>>
                                <a href="<?php echo Yii::$app->homeUrl . 'admin/enquiry/list?pid=1' ?>">
                                    <i class="fas fa-utensils"></i>
                                    <span>Restaurant</span>
                                </a>
                            </li>
                            <li <?php if (strstr($_SERVER['REQUEST_URI'], "pid=2")){ ?>class="active"<?php } ?>>
                                <a href="<?php echo Yii::$app->homeUrl . 'admin/enquiry/list?pid=2' ?>">
                                    <i class="fas fa-vihara"></i>
                                    <span>Banquets</span>
                                </a>
                            </li>
                            <li <?php if (strstr($_SERVER['REQUEST_URI'], "pid=3")){ ?>class="active"<?php } ?>>
                                <a href="<?php echo Yii::$app->homeUrl . 'admin/enquiry/list?pid=3' ?>">
                                    <i class="fas fa-tree"></i>
                                    <span>Picnic Spots</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if (strstr($_SERVER['REQUEST_URI'], "feedback")){ ?>class="active"<?php } ?>>
                        <a href="<?php echo Yii::$app->homeUrl . 'admin/feedback/list' ?>">
                            <i class="fas fa-edit"></i>
                            <span>Feedback</span>
                        </a>
                    </li>
                    <li <?php if (strstr($_SERVER['REQUEST_URI'], "contacts")){ ?>class="active"<?php } ?>>
                        <a href="<?php echo Yii::$app->homeUrl . 'admin/contacts/list' ?>">
                            <i class="fas fa-phone"></i>
                            <span>Contact</span>
                        </a>
                    </li> 
                     <li <?php if (strstr($_SERVER['REQUEST_URI'], "pricing")){ ?>class="active"<?php } ?>>
                        <a href="<?php echo Yii::$app->homeUrl . 'admin/pricing/index' ?>">
                            <i class="fas fa-tags"></i>
                            <span>Pricing Management</span>
                        </a>
                    </li>
                     <li <?php if (strstr($_SERVER['REQUEST_URI'], "holiday")){ ?>class="active"<?php } ?>>
                        <a href="<?php echo Yii::$app->homeUrl . 'admin/holiday/index' ?>">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Holiday Management</span>
                        </a>
                    </li>  
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="<?php echo Yii::$app->homeUrl . 'admin/administrator/logout' ?>">
                                <i class="fas fa-sign-out-alt"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

            <?= $content ?>

            <div class="footer">
                <div style="text-align: center">
                   <!-- 10GB of <strong>250GB</strong> Free.-->
                    <strong>Happy Valley Park</strong>
                </div>
                <div>
                    <!--<strong>CRM</strong> (Hotel)-->
                </div>
            </div>

        </div>
    </div>
<?php $this->endBody() ?>
</body>
<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<!--<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/bootstrap.min.js"></script>-->

<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/jeditable/jquery.jeditable.js"></script>

<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/select2/select2.full.min.js"></script>

<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/inspinia.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/pace/pace.min.js"></script>
<!-- Data picker -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.6.1/clipboard.min.js"></script>
<!--<script src="<?php /*echo Yii::getAlias('@web') . '/web/assets/admin' */?>/js/jQuery.print.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
<script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/jquery.timepicker.js"></script>


<!-- Flot -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/flot/jquery.flot.pie.js"></script>

<!-- ChartJS-->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/chartJs/Chart.min.js"></script>

<!-- d3 and c3 charts -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/d3/d3.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/c3/c3.min.js"></script>
<!--<script src="<?php /*echo Yii::getAlias('@web') . '/web/assets/admin' */?>/js/bootstrap-datetimepicker.min.js"></script>-->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    var clip = new Clipboard('.templatebtn');
</script>
<!--<script type='text/javascript'>
    //<![CDATA[
    jQuery(function($) { 'use strict';
        $("#ele2").find('.print-link').on('click', function() {
            //Print ele2 with default options
            $.print("#ele2");
        });
</script>-->
<script type="text/javascript">
    function onPrint(btn) {
        btn.style.display = "none";
        window.print();
        btn.style.display = "";
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //alert('test');
        //$(".loader").fadeOut("slow");
        setTimeout(function () { $('#preloader').fadeOut(); }, 50);
    });
</script>
<script>
    $(document).ready(function(){
        /*$('.dataTables-example').DataTable({
            responsive: true,
            dom: "<'html5buttons'B>lfrt<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [

                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},


                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ],

            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }

        });*/

          /*  $('.datetimepicker3').datetimepicker({
                pickDate: false
            });*/
        $('.basicExample').timepicker();

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "yyyy-mm-dd"
        });


    });


</script>

<!--<script>
    $(document).ready(function() {
        $('.dataTables-example').DataTable( {
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );
    } );
</script>-->

<script type="text/javascript">
    $(document).ready(function() {
        $(".selecttwo").select2();
        $(".select2_demo_2").select2();
    });
</script>
</html>
<?php $this->endPage() ?>
