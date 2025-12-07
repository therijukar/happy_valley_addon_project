<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAdminAsset;
AppAdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/animate.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/style.css"/>
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Head Libs -->
		<link rel="shortcut icon" href="<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/img/fav.png"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="gray-bg" style="height: auto; background-image: url('<?php echo Yii::getAlias('@web').'/web/assets/admin'?>/img/hvp.jpg'); background-repeat: no-repeat;background-size: cover;">
<!-- -------- body start  -->
<?php $this->beginBody() ?>
<?= $content ?>

<!-- -------- body end  -->

<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/jquery-2.1.1.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/bootstrap.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
