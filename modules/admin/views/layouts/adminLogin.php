<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= Html::encode($this->title) ?></title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/css/admin-v2.css?v=1.3' ?>"/>
    
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="login-page">
<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
