<?php

/* @var $this \yii\web\View */
/* @var $content string */

$siteKey = '6LeFj4oUAAAAALFU_p_b4mu3EYv5bhudCUQGZNq2';
$secret = '6LeFj4oUAAAAAOSYksd9fU9PP1q-v03cNZKRRnRx';

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Holiday; // Assuming Holiday model namespace

AppAsset::register($this);


// Define the conditions for each type of ticket
$conditions = [
    'entry_ticket' => ['entryTicketDates', 'entry_ticket'],
    'fived_ticket' => ['fivedTicketDates', 'fived_ticket'],
    'water_world' => ['waterWorldDates', 'water_world'],
];

// Initialize arrays to store holiday dates
$entryTicketDates = [];
$fivedTicketDates = [];
$waterWorldDates = [];

// Iterate through conditions and populate respective arrays
foreach ($conditions as $key => [$arrayName, $reason]) {
    ${$arrayName} = Holiday::find()
        ->select('date')
        ->where(['reason' => $reason])
        ->column();

    // Check if the array is empty
    if (empty(${$arrayName})) {
        // Handle the case where no dates are found for a specific reason
        // You can set a default value or perform any other action
        ${$arrayName} = [];
    } else {
        // Convert holiday dates to yyyy-mm-dd format
        ${$arrayName} = array_map(function($date) {
            return date('Y-m-d', strtotime($date));
        }, ${$arrayName});
    }
}

// Now you have three arrays $entryTicketDates, $fivedTicketDates, and $waterWorldDates

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- meta tag -->
        
        <meta name="description" content="">

        <!-- Global site tag (gtag.js) - Google Analytics -->

        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130553750-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag(){dataLayer.push(arguments);}

            gtag('js', new Date());

            gtag('config', 'UA-130553750-1');

        </script>
        <meta name="theme-color" content="#000"/>
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!-- favicon -->

        <link rel="apple-touch-icon" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>apple-touch-icon.html">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/fav.png">

        <!-- bootstrap v3.3.7 css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/bootstrap.min.css">

        <!-- font-awesome css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/font-awesome.min.css">

        <!-- animate css -->

       <!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/animate.css">-->

        <!-- owl.carousel css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/owl.carousel.css">

        <!-- slick css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/slick.css">

        <!-- off canvas css -->

<!--        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/off-canvas.css">-->

        <!-- linea-font css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>fonts/linea-fonts.css">

        <!-- nivo slider CSS -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>inc/custom-slider/css/nivo-slider.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>inc/custom-slider/css/preview.css">

        <!-- magnific popup css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/magnific-popup.css">

        <!-- Main Menu css -->

        <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/rsmenu-main.css">

        <!-- Custom css -->

        <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/custom.css">

        <!-- rsmenu transitions css -->

        <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/rsmenu-transitions.css">
        <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/bootstrap-datepicker3.min.css">
       <!-- <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/bootstrap-datetimepicker.min.css">-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/jquery.timepicker.css" />

        <!-- style css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/style.css">

        <!-- responsive css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/responsive.css">
        <link href="/web/assets/css/fonts/roboto.css" type="text/css" rel="stylesheet">
        <link href="/web/assets/css/fonts/oswald.css" type="text/css" rel="stylesheet">
        <link href="/web/assets/css/fonts/open-sans.css" type="text/css" rel="stylesheet">
        <style type="text/css">
        .doted-box { border: 1px dashed #fff; color: #fff; padding: 20px; font-size: 18px; background: #03a84e; margin: 40px 0px; }
        .blink_me {
  animation: blinker 1s linear infinite;
  color:#f8de14;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
        </style>
</head>
    <body class="defult-home">
        <!-- Preloader area start here -->
      <!--<div id="loading">-->
      <!--      <div id="loading-center">-->
      <!--          <div id="loading-center-absolute">-->
      <!--              <div class="object" id="object_one"></div>-->
      <!--              <div class="object" id="object_two"></div>-->
      <!--              <div class="object" id="object_three"></div>-->
      <!--              <div class="object" id="object_four"></div>-->
      <!--          </div>-->
      <!--      </div>-->
      <!--  </div> -->
        <!--End preloader here-->

        <!--popup-->
        
 <!--<?php ?><div id="boxes">
<div style="top: 50%; left: 50%; display: none;" id="dialog" class="window">
<div id="san" >
<a href="#" class="close agree"><img src="https://gohappyvalley.com/web/assets/close-icon.png" style="float:right; margin-right: -25px; margin-top: -20px; width:25px;"></a>
<img src="https://gohappyvalley.com/web/assets/notice.png" width="100%">
</div>
</div>
<div style="width: 24We 78px; font-size: 32pt; color:white; height: 1202px; display: none; opacity: 0.4;" id="mask"></div>
</div><?php ?>-->


        <!--Header Start-->

        <header id="rs-header" class="rs-header"> 
          
          <!-- Toolbar Start -->
          
          <div class="toolbar-area">
            <div class="container">
              <div class="row">
                <div class="col-lg-7 ">
                  <div class="toolbar-sl-share">
                    <ul style="display:inline-block;">
                      <li><a target="_blank" href="https://www.facebook.com/Happy-Valley-Park-127586478173741/"><i class="fa fa-facebook"></i></a></li>
                      <li><a target="_blank" href="http://instagram.com/happyvalleypark"><i class="fa fa-instagram"></i></a></li>
                      <li><a target="_blank" href="https://www.youtube.com/channel/UCveU7dn0LzbJ2ykH_hQBX8Q/featured"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-5 ">
                  <ul class="h_btn pull-right">
                    <li>
                      <button class="btn btn-danger top_btn"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/h_mpin.png"></button>
                    </li>
                    <li class="res-top"><a target="_blank" href="https://www.google.com/maps/place/Happy+Valley+Park/@22.774218,88.59315,16z/data=!4m5!3m4!1s0x0:0x23a7e7a2ea394fc8!8m2!3d22.7742183!4d88.59315?hl=en-US" class="btn btn-danger top_btm_btn"> GET DIRECTION</a></li>
                    <li style="padding: 0 0 0 60px;"><a target="_blank" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/park-map.jpg" class="btn btn-danger map_btn"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/h_mpin2.png"> PARK MAP</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Toolbar End --> 
          
          <!-- Header Menu Start -->
          
          <div class="menu-area rs-defult-header menu-sticky">
            <div class="container">
              <div class="row align-items-center">
                <div class="col-lg-3">
                  <div class="logo-area"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/" class="custom_logo"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/logo.png" alt="logo"></a> </div>
                </div>
                <div class="col-lg-9">
                  <div class="main-menu"> <a class="rs-menu-toggle rs-menu-toggle-close"><i class="fa fa-bars"></i>Menu</a>
                    <nav class="rs-menu">
                      <ul class="nav-menu">
                        <li class="current-menu-item"><a class="active" href="<?php echo  Yii::$app->request->baseUrl;?>/">Home </a></li>
                        <li class="current-menu-item"><a href="<?php echo  Yii::$app->request->baseUrl;?>/waterworld"><img class="new1" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/new1.GIF" alt="">WATER WORLD </a></li>
                        <li class="rs-mega-menu menu-item-has-children"><a href="#"> Experiences<i class="fa fa-angle-down"></i></a> 
                          
                          
                          <ul class="mega-menu home-megamenu">
                            <li class="mega-menu-innner">
                              <div class="single-magemenu">
                                <ul class="sub-menu text-center mycustom">
                                  <li class="active"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/restaurant"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/res-menu.jpg" alt="Restaurant">
                                    <h4>Restaurant</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/banquet"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/banq-menu1.jpg" alt="Banquet">
                                    <h4>Banquet</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/picnic-spots"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/picnic-menu.jpg" alt="Picnic Spot">
                                    <h4>Picnic Spot</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/theatre"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/5d-menu.jpg" alt="5D Theatre">
                                    <h4>5D Theatre</h4>
                                    </a> </li>
                                </ul>
                              </div>
                              
                                                            <!--                      <div class="single-magemenu">-->

                                                            <!--    <ul class="sub-menu">-->

                                                                    

                                                            <!--    </ul>-->

                                                            <!--</div>-->
                            </li>
                          </ul>
                          <!-- //.mega-menu --> 
                          
                        </li>
                        <li class="rs-mega-menu menu-item-has-children"><a href="#"> Rides & Slides<i class="fa fa-angle-down"></i></a> 
                          
                          <ul class="mega-menu home-megamenu">
                            <li class="mega-menu-innner">
                              <div class="single-magemenu">
                                <ul class="sub-menu text-left mycustom">
                                  <li class="active"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/striking-car"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/DG8A6331.jpg" alt="Striking Car">
                                    <h4>Striking Car</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/boating"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/b6.jpg" alt="Boating">
                                    <h4>Boating</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/children-boating"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/cb1.jpg" alt="Children Boating">
                                    <h4>Children Boating</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/children-pool"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/cp2.jpg" alt="Children Pool">
                                    <h4>Children Pool</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/happy-bees"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/hbm.jpg" alt="Happy Bees Round">
                                    <h4>Happy Bees Round</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/jumping-house"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/jh1.jpg" alt="Jumping House">
                                    <h4>Jumping House</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/horse-train"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/htm.jpg" alt="Water Horse Train">
                                    <h4>Water Horse Train</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/gaming"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/gaming.jpg" alt="Gaming zone">
                                    <h4>Gaming zone</h4>
                                    </a> </li>
                                </ul>
                              </div>
                            </li>
                          </ul>
                          <!-- //.mega-menu --> 
                          
                        </li>
                        
                        <!-- End Home -->
                        
                        <!--<li><a href="<?php echo  Yii::$app->request->baseUrl;?>/events">Events </a></li>-->
                        <li><a href="<?php echo  Yii::$app->request->baseUrl;?>/contact">Contact </a></li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Header Menu End --> 
          
        </header>

        <!--Header End-->
        <?= $content ?>
        
        <!-- start scrollUp  -->
         <!--<a class="rig" href="https://www.payumoney.com/webfronts/#/index/Happy_Valley_Park" target="_blank" data-disable-scroll=true>PAY ONLINE</a>-->
         <div id="scrollUp"> <i class="fa fa-angle-up"></i> </div>
         
        <!-- Footer Start -->

        <footer id="rs-footer" class="rs-footer">
          <div class="footer-top">
            <div class="container">
              <div class="row">
                <div class="recent-post-widget col-md-6">
                      <h5 class="con-foo">
                        <span><i class="fa fa-envelope"></i> support@gohappyvalley.com</span>
                      </h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <h5 class="con-foo">
                        <span><i class="fa fa-phone"></i> +91 88201 02846</span>
                      </h5>
                    </div>
                <!--<div class="recent-post-widget col-md-4 text-right">
                    <span class="app">Download App <a href="https://play.google.com/store/apps/details?id=happy.park.inwdaretech" target="_blank"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/google-play.png"></a> </span>
                    </div>-->


              </div>
            </div>
          </div>
          <div class="footer-bottom">
            <div class="container"> 
              
              <!--<div class="copyright pull-right">

                            <p>Powered by Indware Technologies.</p>

                        </div>-->
              
              <div class="row">
                <div class="copyright col-md-6 text-left">
                  <p>&copy; Happy Valley Park. All Rights Reserved.</p>
                </div>
                <div class="copyright col-md-6 text-right">
                  <p><a href="<?php echo  Yii::$app->request->baseUrl;?>/privacy">Privacy Policy</a> | <a href="<?php echo  Yii::$app->request->baseUrl;?>/terms">Terms & Condition</a> <br> <a href="https://www.royal300.com">Powered By <strong>Royal300</strong></a></p>
                </div>
              </div>
            </div>
          </div>
        </footer>

        <!-- Footer End -->

        <!-- start scrollUp  -->
        <div id="scrollUp">
            <i class="fa fa-angle-up"></i>
        </div>
        <!-- modernizr js --> 

      <!--  <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/modernizr-2.8.3.min.js"></script> -->

        <!-- jquery latest version --> 

        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> 

        <!-- bootstrap js --> 

        <!--<script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/bootstrap.min.js"></script> -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

        <!-- Menu js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/rsmenu-main.js"></script> 

        <!-- op nav js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/jquery.nav.js"></script> 

        <!-- owl.carousel js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/owl.carousel.min.js"></script> 
        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/slick.min.js"></script> 

        <!-- isotope.pkgd.min js --> 

      <!--  <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/isotope.pkgd.min.js"></script> -->

        <!-- imagesloaded.pkgd.min js --> 

      <!--  <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/imagesloaded.pkgd.min.js"></script> -->

        <!-- wow js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/wow.min.js"></script> 

        <!-- Skill bar js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/skill.bars.jquery.js"></script> 
        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/jquery.counterup.min.js"></script> 

        <!-- counter top js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/waypoints.min.js"></script> 

        <!-- video js --> 

      <!--  <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/jquery.mb.YTPlayer.min.js"></script> -->

        <!-- magnific popup --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/jquery.magnific-popup.min.js"></script> 

        <!-- Nivo slider js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>inc/custom-slider/js/jquery.nivo.slider.js"></script> 

        <!-- plugins js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/plugins.js"></script> 

        <!-- contact form js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/bootstrap-datepicker.min.js"></script> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/bootstrap-datetimepicker.min.js"></script> 
       
        <script type="text/javascript" src="<?php echo Yii::getAlias('@web') . '/web/assets' ?>/js/jquery.timepicker.js"></script>

        <!-- main js --> 
        <script>
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/main.js"></script> 
        
        <script type="text/javascript">

              $(function() {

              $('#datetimepicker3').datetimepicker({

                pickDate: false

              });

              });

              

                  $(window).load(function(){

                        $('#onload').modal('show');

                    });

            </script>

        <!--Start of Tawk.to Script--> 

        <!--<script type="text/javascript">-->

        <!--var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();-->

        <!--(function(){-->

        <!--var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];-->

        <!--s1.async=true;-->

        <!--s1.src='https://embed.tawk.to/5bff9a38fd65052a5c930406/default';-->

        <!--s1.charset='UTF-8';-->

        <!--s1.setAttribute('crossorigin','*');-->

        <!--s0.parentNode.insertBefore(s1,s0);-->

        <!--})();-->

        <!--</script>-->
        

        <script async>
        var available = 0
       
          $(document).ready(function(){
            $('.data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                startDate: new Date(),
                format: "yyyy-mm-dd",
                    datesDisabled: <?= json_encode($entryTicketDates) ?>


            });
            
             $('.data_2 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                startDate: new Date(),
                format: "yyyy-mm-dd",
                    datesDisabled: <?= json_encode($fivedTicketDates) ?>


            });
            
             $('.data_3 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                startDate: new Date(),
                format: "yyyy-mm-dd",
                    datesDisabled: <?= json_encode($waterWorldDates) ?>


            });

            $('input.timepicker').timepicker({
                    timeFormat: 'H:mm:ss',
                    interval: 30,
                    minTime: '10',
                    // maxTime: '6:00pm',
                    // defaultTime: '11',
                    startTime: '10:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true,
                    zindex: 9999
                });

            $('#people1').on('keyup change', price1);
            $('#people2').on('keyup change', price2);
            $('#people3').on('keyup change', price3);
            $('#people4').on('keyup change', price4);
            $('#people5').on('keyup change', price5);
            $('#people6').on('keyup change', price6);
            $('#people7').on('keyup change', price7);
            $('#people8').on('keyup change', price8);
            $('#people9').on('keyup change', price9);
            $('#people10').on('keyup change', price10);
            $('#people11').on('keyup change', price11);
            $('#people12').on('keyup change', price12);
            $('#people13').on('keyup change', price13);
            $('#people14').on('keyup change', price14);
            $('.picnicdate').on('keyup change', picnicdate);
            $('#maxspot').on('keyup change', picnicspotprice);
          });
          function price1() {
            var people = $('#people1').val();
            //alert(people);
            var amt = 40.00*people;
            //var amt = 1.00*people;
            $('#people2').val(people);
            $('#amount').val(amt);
            $('#amt').val(amt);
          }
          function price2() {
            var people = $('#people2').val();
            var amt =40.00*people;
            $('#people1').val(people);
            $('#amount').val(amt);
            $('#amt').val(amt);
          }
          function price3() {
            var people = $('#people3').val();
            alert(people);
            var amt = 500.00*people;
            $('#people4').val(people);
            $('#amount1').val(amt);
            $('#amt1').val(amt);
          }
          function price4() {
            var people = $('#people4').val();
            var amt = 500.00*people;
            $('#people3').val(people);
            $('#amount1').val(amt);
            $('#amt1').val(amt);
          }
          function price5() {
            var people = $('#people5').val();
            var amt = 200.00*people;
            $('#people6').val(people);
            $('#amount2').val(amt);
            $('#amt2').val(amt);
          }
          
          
          function price6() {
            var people = $('#people6').val();
            var amt = 200.00*people;
            $('#people5').val(people);
            $('#amount2').val(amt);
            $('#amt2').val(amt);
          }
          function price7() {
            var people = $('#people7').val();
            var amt = 250.00*people;
            $('#people8').val(people);
            $('#amount3').val(amt);
            $('#amt3').val(amt);
          }
          function price8() {
            var people = $('#people8').val();
            var amt = 250.00*people;
            $('#people7').val(people);
            $('#amount3').val(amt);
            $('#amt3').val(amt);
          }
          function price9() {
            var peoplebelowten = $('#people9').val();
            var peopleaboveten = $('#people10').val();
            //alert(peopleaboveten);
            var amunt1 = 250.00*peoplebelowten;
            var amunt2 = 300.00*peopleaboveten;
            var amt = (amunt1 + amunt2);
            $('#people11').val(peoplebelowten);
            $('#people12').val(peopleaboveten);
            $('#amount4').val(amt);
            $('#amt4').val(amt);
          }
          function price10() {
            var peoplebelowten = $('#people9').val();
            var peopleaboveten = $('#people10').val();
            //alert(peopleaboveten);
            var amunt1 = 250.00*peoplebelowten;
            var amunt2 = 300.00*peopleaboveten;
            var amt = (amunt1 + amunt2);
            $('#people11').val(peoplebelowten);
            $('#people12').val(peopleaboveten);
            $('#amount4').val(amt);
            $('#amt4').val(amt);
          }
          function price11() {
            var peoplebelowten = $('#people11').val();
            var peopleaboveten = $('#people12').val();
            //alert(peopleaboveten);
            var amunt1 = 240.00*peoplebelowten;
            var amunt2 = 400.00*peopleaboveten;
            var amt = (amunt1 + amunt2);
            $('#people9').val(peoplebelowten);
            $('#people10').val(peopleaboveten);
            $('#amount4').val(amt);
            $('#amt4').val(amt);
          }
          function price12() {
            var peoplebelowten = $('#people11').val();
            var peopleaboveten = $('#people12').val();
            //alert(peopleaboveten);
            var amunt1 = 240.00*peoplebelowten;
            var amunt2 = 400.00*peopleaboveten;
            var amt = (amunt1 + amunt2);
            $('#people9').val(peoplebelowten);
            $('#people10').val(peopleaboveten);
            $('#amount4').val(amt);
            $('#amt4').val(amt);
          }
          function price13() {
            var people = $('#people13').val();
            var amt = 1000.00;
            $('#people14').val(people);
            $('#amount5').val(amt);
            $('#amt5').val(amt);
          }
          function price14() {
            var people = $('#people14').val();
            var amt = 1000.00;
            $('#people13').val(people);
            $('#amount5').val(amt);
            $('#amt5').val(amt);
          }
          function picnicspotprice() {
            var maxspot = $('#maxspot').val();
            var amt = 1500.00*maxspot;
            //$('#people2').val(people);
            $('#amount6').val(amt);
            $('#amt6').val(amt);
          }
          function picnicdate() {
            var picnicdate = $('.picnicdate').val();
            $('#date').val(picnicdate);
            //alert(picnicdate);
            $.ajax({
                    url: "<?php echo  Yii::$app->request->baseUrl;?>/booking/picnicspot-count",
                    type: 'POST',
                    data: {picnicdate: picnicdate},
                    success: function (data) {
                      var dataJson = JSON.parse(data);
                        console.log(dataJson);
                        // if(dataJson.status == 500)
                        // {
                        //     $('#availablespot').val(21);
                        //     document.getElementById("bookpicbtn").disabled = false;
                        //     $('#maxspot').attr({'min':1,'max':vacant});
                        //         console.log($('#maxspot').attr('min'));
                        // }
                        // else if(dataJson.status == 200)
                        // {
                        //     var count = dataJson.count;
                        //     //alert(count);
                        //     var vacant = (21 - count);
                        //     //alert(vacant);
                        //     if(vacant == 0){
                        //         document.getElementById("bookpicbtn").disabled = true;
                        //         $('#availablespot').val(vacant);
                        //     }if(vacant != 0){
                        //         //alert('+++');
                        //         //$("#bookpicbtn").removeAttr("disabled");
                        //         document.getElementById("bookpicbtn").disabled = false;
                        //         $('#availablespot').val(vacant); 
                        //     }
                            
                        // }
                        
                        if(dataJson.status == 200){
                            available = dataJson.available;
                            var price = 1500.00 * available;
                            if(available == 0){
                                document.getElementById("spotSubmit").disabled = true;
                                $('#maxspot').attr('readonly', true);
                                $('#amount6').attr('readonly', true);
                            }else{
                                document.getElementById("spotSubmit").disabled = false;
                                $('#maxspot').attr({'min':1,'max':available});
                                $('#maxspot').attr('readonly', false);
                                $('#amount6').attr('readonly', false);
                            }
                            $('#maxspot').val(available);
                            $('#amount6').val(price);
                        }
                    
                    }
                });
          }
        document.getElementById("bookpicbtn").disabled = true;
        
        $('#maxspot').on('keyup', function(){
          if($('#maxspot').val() < 1 || $('#maxspot').val() > available){
              $('#spotSubmit').attr('disabled', true);
          }else{
              $('#spotSubmit').attr('disabled', false);
          }
        });
        </script>
        
        <script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
        <script>
        var recaptcha1;
        var recaptcha2;
        var recaptcha3;
        var myCallBack = function() {
          //Render the recaptcha1 on the element with ID "recaptcha1"
          recaptcha1 = grecaptcha.render('recaptcha1', {
            'sitekey' : '6LeFj4oUAAAAALFU_p_b4mu3EYv5bhudCUQGZNq2', //Replace this with your Site key
            'theme' : 'light'
          });
          
          //Render the recaptcha2 on the element with ID "recaptcha2"
          recaptcha2 = grecaptcha.render('recaptcha2', {
            'sitekey' : '6LeFj4oUAAAAALFU_p_b4mu3EYv5bhudCUQGZNq2', //Replace this with your Site key
            'theme' : 'light'
          });

          //Render the recaptcha3 on the element with ID "recaptcha3"
          recaptcha3 = grecaptcha.render('recaptcha3', {
            'sitekey' : '6LeFj4oUAAAAALFU_p_b4mu3EYv5bhudCUQGZNq2', //Replace this with your Site key
            'theme' : 'light'
          });
        };
    </script> 

        <!--End of Tawk.to Script-->
		
<style type="text/css">
#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#26262c;
  display:none;
}  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:100%;
  height:auto;
  display:none;
  z-index:9999;
  padding:20px;
  border-radius: 5px;
  text-align: center;
}
#boxes #dialog {
  width:90%; 
  height:auto;
  padding: 10px 10px 10px 10px;
  background-color:#ffffff;
  font-size: 15pt;
}

.agree:hover{
  background-color: #D1D1D1;
}
.popupoption:hover{
	background-color:#D1D1D1;
	color: green;
}
.popupoption2:hover{
	color: red;
}
</style>
<script type="text/javascript">
$(document).ready(function() {	
	var id = '#dialog';
	//Get the screen height and width
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();
	
	//Set heigth and width to mask to fill up the whole screen
	$('#mask').css({'width':maskWidth,'height':maskHeight});
	
	//transition effect		
	$('#mask').fadeIn(500);	
	$('#mask').fadeTo("slow",0.9);	
	
	//Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();
		  
	//Set the popup window to center
	$(id).css('top',  '10%');
	$(id).css('left', '5%');
	
	//transition effect
	$(id).fadeIn(2000); 	
	
	//if close button is clicked
	$('.window .close').click(function (e) {
	//Cancel the link behavior
	e.preventDefault();
	
	$('#mask').hide();
	$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
	$(this).hide();
	$('.window').hide();
	});		
});
</script>



</html>
<?php $this->endPage() ?>
