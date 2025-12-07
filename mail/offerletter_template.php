<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\invoice */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $this->beginPage() ?>
<html lang="en">
<head>
    <style>
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 4px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }
        .table > caption + thead > tr:first-child > th,
        .table > colgroup + thead > tr:first-child > th,
        .table > thead:first-child > tr:first-child > th,
        .table > caption + thead > tr:first-child > td,
        .table > colgroup + thead > tr:first-child > td,
        .table > thead:first-child > tr:first-child > td {
            border-top: 0;
        }
        .table > tbody + tbody {
            border-top: 2px solid #ddd;
        }
        .table .table {
            background-color: #fff;
        }
        .table-bordered {
            border: 1px solid #ddd;
        }
        .table-bordered > thead > tr > th,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > tbody > tr > td,
        .table-bordered > tfoot > tr > td {
            border: 1px solid #ddd;
        }
        .table-bordered > thead > tr > th,
        .table-bordered > thead > tr > td {
            border-bottom-width: 2px;
        }
        .table-hover > tbody > tr:hover {
            background-color: #f5f5f5;
        }
        table col[class*="col-"] {
            position: static;
            display: table-column;
            float: none;
        }
        table td[class*="col-"],
        table th[class*="col-"] {
            position: static;
            display: table-cell;
            float: none;
        }
        .table > thead > tr > td.active,
        .table > tbody > tr > td.active,
        .table > tfoot > tr > td.active,
        .table > thead > tr > th.active,
        .table > tbody > tr > th.active,
        .table > tfoot > tr > th.active,
        .table > thead > tr.active > td,
        .table > tbody > tr.active > td,
        .table > tfoot > tr.active > td,
        .table > thead > tr.active > th,
        .table > tbody > tr.active > th,
        .table > tfoot > tr.active > th {
            background-color: #f5f5f5;
        }
        .table-hover > tbody > tr > td.active:hover,
        .table-hover > tbody > tr > th.active:hover,
        .table-hover > tbody > tr.active:hover > td,
        .table-hover > tbody > tr:hover > .active,
        .table-hover > tbody > tr.active:hover > th {
            background-color: #e8e8e8;
        }

        .table-responsive {
            min-height: .01%;
            overflow-x: auto;
        }
        table {
            border-spacing: 0;
            border-collapse: collapse;
            width:100%;
            margin-bottom: 0;
        }
        td,
        th {
            padding: 0;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd !important;
        }
        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
            width: 1170px;
        }
        .row {
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-12 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
            float: left;
            width: 100%;
        }
        .text-center {
            text-align: center;
        }
        h1,h2,h3,h4,h5,h6{margin:0 0 5px; padding:0;}
        .clearfix{clear:both;}
    </style>
</head>


<body>
<?php $this->beginBody() ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">


<style type="text/css">
.full{width:100%; margin-bottom:1%; display:inline-block; }
.half{ float:left; width:48%; margin:0 1%; }
.text-left{ text-align:left; }
.text-right{ text-align:right; }
.text-center{ text-align:center; }
p{ font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif; }



</style>


</head>

<body>

<div style="width:800px; margin:0 auto;">
<div class="full">
    <div class="text-center"><img src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>img/optsolutionlogo.png"  alt="logobrring" style="width: 30%;">
        <h2 class="logo-name" style="margin-top: 0;">Offer Letter</h2>
    </div>
</div>
<div class="full">
	<div class="half text-left">
    	<p>HR/ OPT-SOLUTIONZ/2018</p>
    </div>
   
</div>
    
 
<div class="full">
	<p style="margin-bottom:2%;">Dated: <?php echo date('F d, Y', strtotime($model->created_date)); ?><br><br>
	<p style="margin-bottom:2%;">Dear, <?php echo $model->name; ?><br><br><br>
    This is further to the interview you had with us. We are pleased to forward to you this Offer Letter as per the terms indicated hereunder:</p>
    <p><strong>Designation :<?php echo $designationMaster->name; ?></strong> </p>
    <p><strong>Location :<?php echo $model->address; ?></strong> </p>
    <p><strong>DOJ :<?php echo date('F d, Y', strtotime($model->created_date)); ?></strong> </p>
    <p><strong>Salary Details: CTC (Includes TA, Mobile):</strong> </p>
    <p>The management reserves the right to withdraw this offer letter in case any of the information given by you is found to be incorrect.</p>
    <p>You are advised your ID Proof, Address Proof, Pan Card, 4 Pass-port size photographs, Original Educational and Experience certificates along with a set of copy at the time of reporting for work.</p>
    <p>Please return the copy of this letter duly signed, confirming the date of you reporting for work. Our formal appointment will be issued to you soon after your joining our services.<br><br>
    With Best Wishes</p>
    <p><strong>Authorized Signatory</strong></p>
    <p style="margin-top:150px;"><strong>OPT-SOLUTIONZ</strong><br><br>
    I have completely read and understood the above terms and conditions of the above offer letter and accept the same.</p>
    
    
    
    
    
</div>

<footer class="text-center full" style="margin-top:30px;">
<hr>
	<p style="font-size:14px;">REGISTERED OFFICE: - 20/1/1L,BALLYGUNGE STATION ROAD,GROUND FLOOR,KOLKATA-700019</p>
    <p style="font-size:12px;">EMAIL: - <a href="mailto:support@opt-solutionz.com">support@opt-solutionz.com</a> ; website: - <a href="www.opt-solutionz.com" target="_blank">www.opt-solutionz.com?</a></p>
</footer>





</div>

</body>
</html>

<?php $this->endBody() ?>
<div><p><b>NOTE : Early check in & Late checkout subject to room availability as per hotel policy</b></p></div>
</body>
</html>
<?php $this->endPage() ?>
