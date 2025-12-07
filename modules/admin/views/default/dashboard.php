<?php
/* @var $this yii\web\View */
$session = Yii::$app->session;
?>


    <style>

    .card-1 {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    .card-1:hover {
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }
</style>



    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Dashboard</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li class="active">
                    <strong>Dashboard</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <!-- start: page -->

<div class="wrapper wrapper-content" style="height: 500px;">
    <div class="row">
        <div class="col-sm-3 ">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title" style="background: #7266BA;">
                    <span class="label label-success pull-right">Active</span>
                    <h5 style="color: #fff;">Tickets</h5>
                </div>
                <div class="ibox-content" style="background: #7266BA;">
                    <h1 class="no-margins" style="color: #fff;"><?php echo $ticket; ?></h1>
                    <small style="color: #fff;">Total</small>
                </div>
            </div>
        </div>



        <div class="col-lg-3 ">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title"  style="background:#E91E63;">
                    <span class="label label-info pull-right">Active</span>
                    <h5 style="color: #fff;">Restaurant</h5>
                </div>
                <div class="ibox-content" style="background:#E91E63;">
                    <h1 class="no-margins" style="color: #fff;"><?php echo $restaurant; ?></h1>
                    <small style="color: #fff;">Total</small>
                </div>
            </div>
        </div>


        <div class="col-lg-3 ">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title" style="background:#FF9800;">
                    <span class="label label-primary pull-right">Active</span>
                    <h5 style="color: #fff;">Banquet</h5>
                </div>
                <div class="ibox-content" style="background:#FF9800;">
                    <h1 class="no-margins" style="color: #fff;"><?php echo $banquet; ?></h1>
                    <small style="color: #fff;">Total</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3 ">
            <div class="ibox float-e-margins card-1">
                <div class="ibox-title" style="background:#149b36;">
                    <span class="label label-danger pull-right">Active</span>
                    <h5 style="color: #fff;">Picnic Spots</h5>
                </div>
                <div class="ibox-content" style="background:#149b36;">
                    <h1 class="no-margins" style="color: #fff;"><?php echo $picnic_spots; ?></h1>
                    <small style="color: #fff;">Total</small>
                </div>
            </div>
        </div>
        <div style="margin-bottom:380px"></div>
        
        </div>
