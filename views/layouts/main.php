<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="fixed">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/magnific-popup/magnific-popup.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/bootstrap-datepicker/css/datepicker3.css"/>
    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/select2/select2.css"/>
  <!--  <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/jquery-datatables-bs3/assets/css/datatables.css"/>-->
    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/stylesheets/theme.css"/>
    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/stylesheets/skins/default.css"/>
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/stylesheets/theme-custom.css">
    <!-- Head Libs -->
   <!-- <script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/modernizr/modernizr.js"></script>-->
    <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/javascripts/jquery-2.1.1.min.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
$session = Yii::$app->session;

if($session['loggeduser']!=null || $session['loggeduser']!=''){

?>
<section class="body">
    <!-- header start -->
    <link rel="shortcut icon" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin/' ?>icon/logo.ico" type="image/x-icon"/>
    <header class="header">
        <div class="logo-container">
            <a href="<?php echo Yii::$app->homeUrl . 'admin' ?>" class="logo">
                <img height="45" width="150" alt="Happy Valley" src="<?php echo Yii::getAlias('@web') . '/web/assets/admin/' ?>icon/logo.png">
            </a>
            <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>
        <!-- start: search & user box -->
        <div class="header-right">
            <span class="separator"></span>
            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture">
                        <img src="<?php echo Yii::getAlias('@web') . '/web/assets/admin/' ?>/images/!logged-user.png" alt="Admin" class="img-circle" data-lock-picture="assets/images/!logged-user.png"/>
                    </figure>
                    <div class="profile-info" data-lock-name="Administrator" data-lock-email="<?php echo 'ADMIN_EMAIL'; ?>">
                        <span class="name"><?php echo $session['loggedUser']->name; ?></span>
                        <span class="role"></span></div>
                    <i class="fa custom-caret"></i></a>
                <div class="dropdown-menu">
                    <ul class="list-unstyled">
                        <li class="test"><?php echo $session['loggedUser']->email; ?></li>
                        <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::$app->request->baseUrl; ?>/appuser/editprofile?id=<?php echo $session['loggedUser']->appuser_id; ?>"><i class="fa fa-user"></i> Profile</a></li>
                        <!--<li><a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a></li>-->
                        <li><a role="menuitem" tabindex="-1" href="<?php echo Yii::$app->homeUrl . 'appuser/logout' ?>"><i class="fa fa-power-off"></i> Logout</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- end: search & user box -->
    </header>
    <!-- Header END -->
    <div class="inner-wrapper">
        <!-- left menu start -->
        <aside id="sidebar-left" class="sidebar-left">
            <div class="sidebar-header">
                <div class="sidebar-title">
                    Navigation
                </div>
                <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main" role="navigation">
                        <ul class="nav nav-main">
                            <li class="nav-active " <?php if (strstr($_SERVER['REQUEST_URI'], "appuser")){ ?>class="active"<?php } ?>>
                                <a href="<?php echo Yii::$app->homeUrl . 'appuser' ?>">
                                    <i class="fa fa-dashboard" aria-hidden="true"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>



                            <li class="nav-active">
                                <a href="<?php echo Yii::$app->homeUrl . 'outlet/list' ?>">
                                    <i class="fa fa-outdent" aria-hidden="true"></i>
                                    <span>Outlet List</span>
                                </a>
                            </li>

                            <li class="nav-active">
                                <a href="<?php echo Yii::$app->homeUrl . 'coupon/list' ?>">
                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                    <span>Coupon List</span>
                                </a>
                            </li>


                            <li class="nav-active">
                                <a href="<?php echo Yii::$app->homeUrl . 'subscriptionpackage/list' ?>">
                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    <span>Subscription List</span>
                                </a>
                            </li>

                            <li class="nav-active">
                                <a href="<?php echo Yii::$app->homeUrl . 'promotiongroup/list' ?>">
                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    <span>Customer Group List</span>
                                </a>
                            </li>


                            <li class="nav-active">
                                <a href="<?php echo Yii::$app->homeUrl . 'campaign/list' ?>">
                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    <span>Campaign List</span>
                                </a>
                            </li>
                </div>
            </div>
        </aside>
        <!-- left menu end -->
        <?php } ?>
        <?= $content ?>

    </div>
</section>
<?php $this->endBody() ?>
</body>

<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/bootstrap/js/bootstrap.js"></script>
<!--<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/nanoscroller/nanoscroller.js"></script>-->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/magnific-popup/magnific-popup.js"></script>
<!--<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/jquery-placeholder/jquery.placeholder.js"></script>-->
<!-- Specific Page Vendor -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/select2/select2.js"></script>
<!--<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>-->
<!-- Theme Base, Components and Settings -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/javascripts/theme.js"></script>
<!-- Theme Custom -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/javascripts/theme.custom.js"></script>
<!-- Theme Initialization Files -->
<!--<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/javascripts/theme.init.js"></script>-->
<!-- Examples -->
<!--<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/javascripts/tables/examples.datatables.default.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/javascripts/tables/examples.datatables.row.with.details.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/javascripts/tables/examples.datatables.tabletools.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.6.1/clipboard.min.js"></script>
<script type="text/javascript">
    var clip = new Clipboard('.templatebtn');
</script>
</html>
<?php $this->endPage() ?>
