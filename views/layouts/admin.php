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
    <link rel="shortcut icon" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/img/favicon.jpg" type="image/x-icon"/>
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/animate.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/style.css"/>


    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <!-- Head Libs -->
    <!--<link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' *?>/css/bootstrap-datetimepicker.min.css">-->
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/jquery-2.1.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/jquery.timepicker.css" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="fixed-sidebar md-skin">
<!--class="fixed-sidebar md-skin"-->
<?php $this->beginBody() ?>
<?php
$session = Yii::$app->session;

if (!isset($session['administrator']['administratorid'])) {
    return Yii::$app->getResponse()->redirect(array('admin/administrator/login',));
} else if ($session['administrator']['administratorid'] == '') {
    return Yii::$app->getResponse()->redirect(array('admin/administrator/login',));
}
?>


<section class="body">
    <!-- header start -->
    <link rel="shortcut icon" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin/' ?>icon/favicon.jpg" type="image/x-icon"/>

    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                           <!-- <img alt="image" height="48px" width="48px" class="img-circle" src="<?php /*echo Yii::getAlias('@web') . '/web/assets/admin' */?>/img/user.png"/>-->
                             </span>

                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs"><strong class="font-bold">WELCOME</strong></span>
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $session['administrator']->username; ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $session['administrator']->email; ?> <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo Yii::$app->request->baseUrl; ?>/vendorpanel/editprofile?id=<?php echo $session['administrator']->administratorid; ?>">Profile</a></li>

                                <li class="divider"></li>
                                <li><a href="<?php echo Yii::$app->homeUrl . 'admin/administrator/logout' ?>">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            HT
                        </div>
                    </li>

                    <li  <?php if (strstr($_SERVER['REQUEST_URI'], "admin")){ ?>class="active"<?php } ?>>
                        <a href="<?php echo Yii::$app->homeUrl . 'vendorpanel/dashboard' ?>">
                            <i class="fa fa-dashboard" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>


                    <li>
                        <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Transaction</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li <?php if (strstr($_SERVER['REQUEST_URI'], "roadactivity")){ ?>class="active"<?php } ?>>
                                <a href="<?php echo Yii::$app->homeUrl . 'vendorpanel/roadactivity' ?>">
                                    <i class="fa fa-arrows" aria-hidden="true"></i>
                                    <span>Activity</span>
                                </a>
                            </li>

                            <li <?php if (strstr($_SERVER['REQUEST_URI'], "oohactivity")){ ?>class="active"<?php } ?>>
                                <a href="<?php echo Yii::$app->homeUrl . 'vendorpanel/oohactivity' ?>">
                                    <i class="fa fa-arrows" aria-hidden="true"></i>
                                    <span>OOH Monitoring</span>
                                </a>
                            </li>

                            <li <?php if (strstr($_SERVER['REQUEST_URI'], "retailactivity")){ ?>class="active"<?php }?>>
                                <a href="<?php echo Yii::$app->homeUrl . 'vendorpanel/retailactivity' ?>">
                                    <i class="fa fa-arrows" aria-hidden="true"></i>
                                    <span>Retail Activity</span>
                                </a>
                            </li>


                            <li <?php if (strstr($_SERVER['REQUEST_URI'], "supervisor")){ ?>class="active"<?php }?>>
                                <a href="<?php echo Yii::$app->homeUrl . 'vendorpanel/supervisoractivity' ?>">
                                    <i class="fa fa-arrows" aria-hidden="true"></i>
                                    <span>Supervisor</span>
                                </a>
                            </li>


                        </ul>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <!--<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>-->
                        <!--<form role="search" class="navbar-form-custom" action="http://webapplayers.com/inspinia_admin-v2.5/search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>-->
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                       <!-- <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome <?php /*echo $session['administrator']->name; */?></span>
                        </li>-->
                        <li>
                            <a href="<?php echo Yii::$app->homeUrl . 'admin/administrator/logout' ?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

            <?= $content ?>

            <div class="footer">
                <div style="text-align: center">
                   <!-- 10GB of <strong>250GB</strong> Free.-->
                    <strong> Copyright © 2018.<a href="javascript:void(0);">Emami Limited</a></strong>
                </div>
                <div>
                    <!--<strong>CRM</strong> (Hotel)-->
                </div>
            </div>

        </div>
    </div>
<?php $this->endBody() ?>
</body>


<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/bootstrap.min.js"></script>

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
    });
</script>
</html>
<?php $this->endPage() ?>
