<center>
	<h2>Transaction Failed <?php echo isset($msg)? ', Error : '.$msg : '' ;?></h2>
	<h3>Redirecting To Home</h3>
</center>
<?php 
    // var_dump(Yii::$app->request->baseUrl);
	header('Refresh: 10; URL= https://gohappyvalley.com/');
 ?>
