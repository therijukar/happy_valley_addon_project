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

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
        <!-- meta tag -->
        <meta charset="<?= Yii::$app->charset ?>">
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

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/animate.css">

        <!-- owl.carousel css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/owl.carousel.css">

        <!-- slick css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/slick.css">

        <!-- off canvas css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/off-canvas.css">

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
        <link rel="stylesheet" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/jquery.timepicker.css" />

        <!-- style css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/style.css">

        <!-- responsive css -->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>css/responsive.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
        <style type="text/css">
        .doted-box { border: 1px dashed #fff; color: #fff; padding: 20px; font-size: 18px; background: #03a84e; margin: 40px 0px; }
        </style>
    </head>
    <body class="defult-home">
        <!-- Preloader area start here -->
        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_four"></div>
                </div>
            </div>
        </div>
        <!--End preloader here -->

        <!--Header Start-->

        <header id="rs-header" class="rs-header"> 
          
          <!-- Toolbar Start -->
          
          <div class="toolbar-area hidden-md">
            <div class="container">
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <div class="toolbar-sl-share">
                    <ul>
                      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-8 ">
                  <ul class="h_btn pull-right">
                    <li>
                      <button class="btn btn-danger top_btn"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/h_mpin.png"></button>
                    </li>
                    <li><a target="_blank" href="https://www.google.com/maps/place/Happy+Valley+Park/@22.774218,88.59315,16z/data=!4m5!3m4!1s0x0:0x23a7e7a2ea394fc8!8m2!3d22.7742183!4d88.59315?hl=en-US" class="btn btn-danger top_btm_btn"> GET DIRECTION</a></li>
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
                  <div class="main-menu"> <a class="rs-menu-toggle"><i class="fa fa-bars"></i>Menu</a>
                    <nav class="rs-menu">
                      <ul class="nav-menu">
                        <li class="current-menu-item"><a class="active" href="<?php echo  Yii::$app->request->baseUrl;?>/">Home </a></li>
                        <li class="rs-mega-menu menu-item-has-children"><a href="#"> Experiences<i class="fa fa-angle-down"></i></a> 
                          
                          <!--<ul class="sub-menu"> 

                                                        <li class="active"><a href="restaurant.html"> Restaurant</a></li> 

                                                        <li><a href="banquet.html"> Banquet</a></li>   

                                                        <li><a href="picnic_spot.html"> Picnic Spot</a></li>   

                                                        <li><a href="theatre.html"> 5D Theatre</a></li>

                                                    </ul>-->
                          
                          <ul class="mega-menu home-megamenu">
                            <li class="mega-menu-innner">
                              <div class="single-magemenu">
                                <ul class="sub-menu text-center mycustom">
                                  <li class="active"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/restaurant"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/res-menu.jpg" alt="Restaurant">
                                    <h4>Restaurant</h4>
                                    </a> </li>
                                  <li> <a href="<?php echo  Yii::$app->request->baseUrl;?>/banquet"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/menu/banq-menu.jpg" alt="Banquet">
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
                              
                              <!--                                                    <div class="single-magemenu">

                                                                <ul class="sub-menu">

                                                                    

                                                                </ul>

                                                            </div>--> 
                            </li>
                          </ul>
                          <!-- //.mega-menu --> 
                          
                        </li>
                        <li class="rs-mega-menu menu-item-has-children"><a href="#"> Rides & Slides<i class="fa fa-angle-down"></i></a> 
                          
                          <!--<ul class="sub-menu"> 

                                                        <li class="active"><a href="restaurant.html"> Restaurant</a></li> 

                                                        <li><a href="banquet.html"> Banquet</a></li>   

                                                        <li><a href="picnic_spot.html"> Picnic Spot</a></li>   

                                                        <li><a href="theatre.html"> 5D Theatre</a></li>

                                                    </ul>-->
                          
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
                        
                        <li><a href="<?php echo  Yii::$app->request->baseUrl;?>/events">Events </a></li>
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
         <a class="rig" href="https://www.payumoney.com/webfronts/#/index/Happy_Valley_Park" target="_blank" data-disable-scroll=true>PAY ONLINE</a>
         <div id="scrollUp"> <i class="fa fa-angle-up"></i> </div>
         
        <!-- Footer Start -->

        <footer id="rs-footer" class="rs-footer">
          <div class="footer-top">
            <div class="container">
              <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 mb-md-30">
                  <h5 class="footer-title pad-80 pt-30">Quick Links</h5>
                  <div class="about-widget">
                    <div class="row">
                      <ul class="footer-address col-md-6">
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/restaurant">Restaurant</a></li>
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/picnic-spots">Picnic Spot</a></li>
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/theatre">5D Theatre </a></li>
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/banquet">Banquet </a></li>
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/events">Events </a></li>
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/contact">Contact </a></li>
                      </ul>
                      <ul class="footer-address col-md-6">
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/striking-car">Striking Car</a></li>
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/boating">Boating</a></li>
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/happy-bees">Happy Bees Round </a></li>
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/jumping-house">Jumping House </a></li>
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/house-train">Water Horse Train </a></li>
                        <li><i class="fa fa-angle-double-right"></i><a href="<?php echo  Yii::$app->request->baseUrl;?>/gaming">Gaming Zone </a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 mb-md-30">
                  <h5 class="footer-title pad-80">Quick Contact</h5>
                  <div class="row">
                    <div class="recent-post-widget col-md-6">
                      <h5 style="color:#fff; font-size:16px; font-weight:400; padding-bottom:10px;">Happy Valley Park<br>
                        <br>
                        <span>Near Barasat, Bira More</span><br>
                      </h5>
                    </div>
                    <div class="recent-post-widget col-md-6" style="padding: 0;">
                      <h5  style="color:#fff; font-size:16px; font-weight:400; padding-bottom:10px;">
                          <span><i class="fa fa-phone"></i> 8820102846</span><br><br>
                        <span><i class="fa fa-phone"></i> 7029609594</span><br><br>
                        <span><i class="fa fa-phone"></i> 08069640279</span><br><br>
                        <span><i class="fa fa-phone"></i> 03216261116</span>
                      </h5>
                    </div>
                    <div class="recent-post-widget col-md-6" >
                      <h5  style="color:#fff; font-size:16px; font-weight:400; padding-bottom:0; margin-bottom: 0;">Download App<br>
                        <br>
                        <span><a href="https://play.google.com/store/apps/details?id=happy.park.inwdaretech" target="_blank"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/google-play.png"></a> </span><br>
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/f_logo.png"> </div>
              </div>
            </div>
          </div>
          <div class="footer-bottom">
            <div class="container"> 
              
              <div class="copyright pull-right">

                            <p>Powered by <a href="royal300.com">ROYAL 300</a></p>

                        </div>-->
              
              <div class="row">
                <div class="copyright col-md-6 text-left">
                  <p>&copy; Happy Valley Park 2018. All Rights Reserved.</p>
                </div>
                <div class="copyright col-md-6 text-right">
                  <p><a href="<?php echo  Yii::$app->request->baseUrl;?>/privacy">Privacy Policy</a> | <a href="<?php echo  Yii::$app->request->baseUrl;?>/terms">Terms & Condition</a></p>
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

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/modernizr-2.8.3.min.js"></script> 

        <!-- jquery latest version --> 

        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> 

        <!-- bootstrap js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/bootstrap.min.js"></script> 

        <!-- Menu js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/rsmenu-main.js"></script> 

        <!-- op nav js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/jquery.nav.js"></script> 

        <!-- owl.carousel js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/owl.carousel.min.js"></script> 
        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/slick.min.js"></script> 

        <!-- isotope.pkgd.min js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/isotope.pkgd.min.js"></script> 

        <!-- imagesloaded.pkgd.min js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/imagesloaded.pkgd.min.js"></script> 

        <!-- wow js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/wow.min.js"></script> 

        <!-- Skill bar js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/skill.bars.jquery.js"></script> 
        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/jquery.counterup.min.js"></script> 

        <!-- counter top js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/waypoints.min.js"></script> 

        <!-- video js --> 

        <script src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>js/jquery.mb.YTPlayer.min.js"></script> 

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

        <script type="text/javascript">

        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();

        (function(){

        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];

        s1.async=true;

        s1.src='https://embed.tawk.to/5bff9a38fd65052a5c930406/default';

        s1.charset='UTF-8';

        s1.setAttribute('crossorigin','*');

        s0.parentNode.insertBefore(s1,s0);

        })();

        </script>

        <script>
          $(document).ready(function(){
            $('.data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
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
          });
          function price1() {
            var people = $('#people1').val();
            var amt = 20.00*people;
            $('#people2').val(people);
            $('#amount').val(amt);
            $('#amt').val(amt);
          }
          function price2() {
            var people = $('#people2').val();
            var amt = 20.00*people;
            $('#people1').val(people);
            $('#amount').val(amt);
            $('#amt').val(amt);
          }
        </script>

        <script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
        <script>
        var recaptcha1;
        var myCallBack = function() {
          //Render the recaptcha1 on the element with ID "recaptcha1"
          recaptcha1 = grecaptcha.render('recaptcha1', {
            'sitekey' : '6LeFj4oUAAAAALFU_p_b4mu3EYv5bhudCUQGZNq2', //Replace this with your Site key
            'theme' : 'light'
          });
        };
    </script> 

        <!--End of Tawk.to Script-->
</html>
<?php $this->endPage() ?>
