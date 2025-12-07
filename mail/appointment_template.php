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
            width: 70%;
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
ul li{ margin-bottom:30px; }


</style>


</head>

<body>

<div style="width:800px; margin:0 auto;">
<div class="full">
<div class="text-center"><img src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>img/opt solution logo.png"  alt="logobrring" style="width: 30%;">
      
    </div>
</div>
<div class="full">
	<div class="half text-left">
    	<p><strong>Emp name:-</strong><?php echo $model->name; ?><br>
        Emp ID:-<?php echo $model->emp_id; ?><br>
        Dated: <?php echo date('F d, Y', strtotime($model->created_date)); ?></p>
    </div>
  
    <div style="clear:both"></div>
    <p class="text-center"><u>FIXED TERM LETTER OF APPOINTMENT</u></p>
</div>
<div class="full">
	<p style="margin-bottom:2%;">Dear,<br>
    We are pleased to appoint you at the position of MIS Executive with OPT-SOLUTIONZ for our project with <?php echo $projectMaster->name; ?>.</p>
    <p><strong>Terms of Employment</strong> </p>
    <ul>
    	<li>Your appointment as <?php echo $designationMaster->name; ?> shall commence on <?php echo date('F d, Y', strtotime($model->created_date)); ?> for a term agreed between OPT-SOLUTIONZ & <?php echo $clientMaster->name; ?>. and same shall be binding on you. </li>
        <li>
            As ISD, you shall be entitled for a remuneration as stated in Annexure –1(SALARY BREAK UP). Your appointment & its continuation will remain valid as per the terms and conditions agreed between both the parties.
        </li>
        <li>
            Your present place of work shall be at <?php echo $outletMaster->name; ?> but during the course of the service, you shall be liable to be posted / transferred anywhere to serve any of the Company's units/ divisions/departments/projects or any associated companies, business or technical collaborations or any other establishments in India or outside, at the sole discretion of the Management, without any extra compensation thereof. 
        </li>
        <li>
            You shall be on a Probation period for a minimum of Six months. Based on your performance your services will be confirmed with the Company in written after six months. Confirmation is the absolute discretion of the Management. Mere expiry of the minimum period of probation will not entitle you for confirmation automatically.
        </li>
        <li>
            Regular performance review will be conducted to assess your performance and suitability. If your services are found not meeting with the standard as required by the organization, the Company shall terminate your services by giving 15 days’ notice. Contractually you are also entitled to terminate your agreement with the Company by giving notice as per notice period mentioned above.
        </li>
        <li>
            Your appointment shall also be liable to be terminated earlier than the stipulated period of time as mentioned above in case our Client with whom the Company has entered into an agreement terminates the said agreement due to any reason whatsoever before the stipulated period of time and you shall not be paid anything extra except 15 days’ notice or salary. No compensation or remaining wages shall be payable for the unexpired period remaining of your appointment. 
        </li>
        <li>
            You shall be eligible for 1 day leave per month which you shall enjoy in the following month and shall not be allowed to be accumulated at the end of the calendar year.
        </li>
        <li>
            Absence for a continuous period of three working days without prior approval of your superior, (including overstay on leave / training) would result automatically into ending of your term employment without any notice or intimation. 
        </li>
        <li>
            During the period of your employment with the Company, you shall devote full time to the work of the Company. Further, you shall not take up any other employment (including self and job employment) or assignment or any office, honorary or for any consideration, in cash or in kind or otherwise, without the prior written permission of the Company.
        </li>
        <li>
            You will be required to maintain utmost secrecy in respect of Project documents, commercial offer, design documents, Project cost & Estimation, Technology, Software packages license, 
            Company’s polices, Company’s patterns & Trade Mark and Company’s Human assets profile. 
        </li>
        <li>
            Any technical or other important information which might come into your possession during the continuance of your service with us shall not be disclosed, divulged or made public by you even thereafter.
        </li>
        <li>
            If at any time in our opinion, which is final in this matter you are found non- performer or guilty of fraud, dishonest, disobedience, disorderly behavior, negligence, indiscipline, absence from duty without permission or any other conduct considered by us deterrent to our interest or of violation of one or more terms of this letter, your services may be terminated without notice and on account of reason of any of the acts or omission the company shall be entitled to recover the damages from you.
        </li>
        <li>
            You will be responsible for safekeeping and return in good condition and order of all property which might come into your possession during the continuance of your service with us, which may be in your use, custody or charge. The Management reserves the right to deduct the money value of such articles from your dues, or take such action as may be proper in case of failure on your part to account for such property. In the event of termination of your employment (voluntary or involuntary) you shall promptly deliver to the Company all property belonging to Company which is in your possession or under your control. You shall also inform the Management of whereabouts of any such items, of which the locations is known to you but not to the Company
        </li>
        <li>
            This Fixed Term appointment letter is being issued to you on the basis of the information and particulars furnished by you in your application (including bio-data), at the time of your interview and subsequent discussions. If it transpires that you have made a false statement (or have not disclosed a material fact) resulting in your being offered this appointment, the Management may take such action as it deems fit in its sole discretion, including termination of your employment.
        </li>
        <li>
            Your address (postal or email address) as indicated in your application for appointment shall be deemed to be correct for sending any communication to you and every communication addressed to you at the given address shall deem to have been served upon you.
        </li>
        <li>
            In case of there being any change in residential address you shall intimate the same in writing to the Human Resource department/manager of the Company within three days from date of such change, failing which any communication addressed to you at your last known address shall be deemed to have been served upon you. 
        </li>
        <li>
            You will be required to comply with all such rules and regulations and office orders as the Company may frame from time to time in relation to your service conditions, which will form part of your terms of employment. 
        </li>
        <li>
            Your continuance in service with the Company is subject to your remaining physically and mentally fit. You will submit yourself to medical examination as per the direction(s) of the Management. 
        </li>
        <li>
            Please sign and return to the undersigned the duplicate copy of this letter signifying your acceptance. 
        </li>
    </ul>
    
    
    
</div>

<div class="full table-responsive" style="margin: 0 auto;">
    <h3 class="text-center">Annexure I</h3>
    <table class="table-bordered">
        <tr>
            <th colspan="2">SALARY BREAK UP</th>
        </tr>
        <tr>
            <th>Employee Code</th>
            <td><?php echo $model->emp_id; ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo $model->name; ?></td>
        </tr>
        <tr>
            <th colspan="2">Yearly</th>
        </tr>
        <tr>
            <th>Basic</th>
            <td><?php echo $amt[1]; ?></td>
        </tr>
        <tr>
            <th>HRA</th>
            <td><?php echo $amt[2]; ?></td>
        </tr>
        <tr>
            <th>Conveyance</th>
            <td><?php echo $amt[3]; ?></td>
        </tr>
        <tr>
            <th>Travelling Allowance</th>
            <td><?php echo $amt[4]; ?></td>
        </tr>
        <tr>
            <th>Mobile Allowance</th>
            <td><?php echo $amt[5]; ?></td>
        </tr>
        <tr>
            <th>Medical Allowance</th>
            <td><?php echo $amt[11]; ?></td>
        </tr>
        <tr>
            <th>Special Allowance</th>
            <td><?php echo $amt[12]; ?></td>
        </tr>
        <tr>
            <th>Bonus Allowance</th>
            <td><?php echo $amt[13]; ?></td>
        </tr>
        <tr>
            <th>CCA</th>
            <td><?php echo $amt[6]; ?></td>
        </tr>
        <tr>
            <th>Gross Salary</th>
            <td><?php echo $gross; ?></td>
        </tr>
        <tr>
            <th>Employee Share PF@12%</th>
            <td><?php echo $amt[7]; ?></td>
        </tr>
        <tr>
            <th>Employee Share ESI@1.75%</th>
            <td><?php echo $amt[8]; ?></td>
        </tr>
        <tr>
            <th>Employee Share Welfare Fund</th>
            <td><?php echo $amt[9]; ?></td>
        </tr>
        <tr>
            <th>Profession Tax</th>
            <td><?php echo $amt[10]; ?></td>
        </tr>
        <tr>
            <th>Medical Insurance</th>
            <td><?php echo $amt[14]; ?></td>
        </tr>
        <tr>
            <th>TDS</th>
            <td><?php echo $amt[15]; ?></td>
        </tr>
        <tr>
            <th>Net Salary</th>
            <td><?php echo $netSal; ?></td>
        </tr>
        <tr>
            <th>Employer Share PF@13.15%</th>
            <td><?php echo $epf; ?></td>
        </tr>
        <tr>
            <th>Employer Share ESI@4.75%</th>
            <td><?php echo $esic; ?></td>
        </tr>
        <tr>
            <th>Employer Share Welfare Fund</th>
            <td></td>
        </tr>
        <tr>
            <th>Total Benefits</th>
            <td></td>
        </tr>
        <tr>
            <th>CTC</th>
            <td></td>
        </tr>
    </table>
</div>
<div class="full">
    <p>We welcome you to OPT-SOLUTIONZ family and look forward to a fruitful collaboration.<br><br>
    Yours Sincerely
    </p>
    <p><strong>OPT-SOLUTIONZ</strong></p>
	<div class="half text-left">
    	<p>Authorized Signatory</p>
    </div>
    <div class="half text-right">
        <p><b><?php //echo $model->name; ?></b></p>
    	<p>Employee Name</p>
    </div>
</div>





</div>

</body>
</html>

<?php $this->endBody() ?>
<div><p><b>NOTE : Early check in & Late checkout subject to room availability as per hotel policy</b></p></div>
</body>
</html>
<?php $this->endPage() ?>
