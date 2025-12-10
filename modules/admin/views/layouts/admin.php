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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= Html::encode($this->title) ?> - Admin</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Core & Vendor CSS (Retaining necessary legacy overrides via Bootstrap) -->
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/css/admin-v2.css?v=1.0' ?>"/>

    <!-- Plugins CSS (From original layout) -->
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/css/jquery.timepicker.css" />
    
    <!-- Essential Scripts (Must be in head for inline view scripts) -->
    <script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/jquery-2.1.1.min.js"></script>

    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
$session = Yii::$app->session;
if (!isset($session['administrator']['administratorid'])) {
    return Yii::$app->getResponse()->redirect(array('admin/administrator/login',));
} 
?>

<div class="admin-container">
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="brand-icon">HV</div>
            <div class="brand-text">Happy Valley</div>
        </div>
        
        <div class="sidebar-scroll">
            <div class="nav-label">Main Menu</div>
            
            <nav class="nav-menu">
                <a href="<?= Yii::$app->homeUrl . 'admin' ?>" class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "admin") && !strstr($_SERVER['REQUEST_URI'], "booking") && !strstr($_SERVER['REQUEST_URI'], "enquiry") ? 'active' : '' ?>">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="<?= Yii::$app->homeUrl . 'admin/booking/list' ?>" class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "booking") ? 'active' : '' ?>">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Tickets</span>
                </a>

                <div class="nav-label" style="margin-top: 24px;">Management</div>

                <a href="<?= Yii::$app->homeUrl . 'admin/enquiry/list?pid=1' ?>" class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "pid=1") ? 'active' : '' ?>">
                    <i class="fas fa-utensils"></i>
                    <span>Restaurant</span>
                </a>
                
                <a href="<?= Yii::$app->homeUrl . 'admin/enquiry/list?pid=2' ?>" class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "pid=2") ? 'active' : '' ?>">
                    <i class="fas fa-hotel"></i>
                    <span>Banquets</span>
                </a>
                
                <a href="<?= Yii::$app->homeUrl . 'admin/enquiry/list?pid=3' ?>" class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "pid=3") ? 'active' : '' ?>">
                    <i class="fas fa-tree"></i>
                    <span>Picnic Spots</span>
                </a>
                
                <a href="<?= Yii::$app->homeUrl . 'admin/pricing/index' ?>" class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "pricing") ? 'active' : '' ?>">
                    <i class="fas fa-tags"></i>
                    <span>Pricing</span>
                </a>
                
                <a href="<?= Yii::$app->homeUrl . 'admin/holiday/index' ?>" class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "holiday") ? 'active' : '' ?>">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Holidays</span>
                </a>
                
                <a href="<?= Yii::$app->homeUrl . 'admin/popup/index' ?>" class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "popup") ? 'active' : '' ?>">
                    <i class="fas fa-images"></i>
                    <span>Website Popups</span>
                </a>
                
                <div class="nav-label" style="margin-top: 24px;">System</div>
                
                <a href="<?= Yii::$app->homeUrl . 'admin/feedback/list' ?>" class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "feedback") ? 'active' : '' ?>">
                    <i class="fas fa-comment-dots"></i>
                    <span>Feedback</span>
                </a>
                
                <a href="<?= Yii::$app->homeUrl . 'admin/contacts/list' ?>" class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "contacts") ? 'active' : '' ?>">
                    <i class="fas fa-address-book"></i>
                    <span>Contacts</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display:flex; align-items:center;">
                <button class="header-toggle-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <!-- Breadcrumbs could go here if needed -->
            </div>

            <div class="user-dropdown">
                <div class="user-info d-none d-sm-block">
                    <div class="user-name"><?= $session['administrator']->name ?></div>
                    <div class="user-role">Administrator</div>
                </div>
                <div class="user-avatar">
                    <?= strtoupper(substr($session['administrator']->name, 0, 1)) ?>
                </div>
                
                <a href="<?= Yii::$app->homeUrl . 'admin/administrator/logout' ?>" class="logout-btn-v2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span style="margin-left:8px;">Logout</span>
                </a>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            <?= $content ?>
        </main>
    </div>
</div>

<!-- Essential Scripts -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/bootstrap.min.js"></script>

<!-- Plugin Scripts -->
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/jquery.timepicker.js"></script>
<script src="<?php echo Yii::getAlias('@web') . '/web/assets/admin' ?>/js/plugins/chartJs/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.6.1/clipboard.min.js"></script>

<script>
    // New Mobile Sidebar Toggle Logic
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('mobile-open');
        document.querySelector('.sidebar-overlay').classList.toggle('show');
    }

    // Initialize Plugins Globally
    $(document).ready(function(){
        // DataTables
        if($.fn.DataTable) {
            $('.dataTables-example').DataTable({
                responsive: true,
                dom: '<"html5buttons"B>lfrtip',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Export'},
                    {extend: 'pdf', title: 'Export'},
                    {extend: 'print'}
                ]
            });
        }
        
        // Datepicker
        if($.fn.datepicker) {
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            });
        }
        
        // Select2
        if($.fn.select2) {
            $(".selecttwo").select2();
        }
        
        // Timepicker
        if($.fn.timepicker) {
            $('.basicExample').timepicker();
        }
        
        // Hide preloader if exists
        $('#preloader').fadeOut();
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
