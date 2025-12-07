<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
 ?>
    <!-- Main content Start -->
         <div class="main-content"> 
           
           <!-- Slider Start --> 
           
           <!-- Slider begins here -->
           
           <video poster="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/poster.jpg" autoplay loop id="video-background" muted playsinline preload="auto">
             <source src="http://www.indware.com/assets/images/hvp.mp4" type="video/mp4"/>
             <source src="http://www.indware.com/assets/images/hvp.mp4" type="video/mp4"/>
           </video>
           
           <!-- Slider End --> 
           
           <!-- Services Start -->
           
           <section id="rs-services" class="rs-services-3 price mp-212" style="position: relative; background: #f9f9f9;">
             <div class="container-fluid mob-dis">
               <div class="row m-auto text-center">
             <div class="rs-carousel owl-carousel" data-loop="true" data-items="4" data-margin="100" data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="true" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="true" data-ipad-device-dots2="false" data-md-device="3" data-md-device-nav="true" data-md-device-dots="false">

               <div class="team-item">
                 <div class="princing-item red">
                   <div class="pricing-divider ">
                     <h3 class="text-light">Book Ticket</h3>
                     <h4 class="my-0 display-4 text-light font-weight-normal"><span class="h3">₹</span> 20 <span class="h5">/per person</span></h4>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">
                     <ul class="list-unstyled position-relative mb-3">
                       <li>
                         <label style="color:#000; display:block; text-align:left; width:60%; float:left;"><b>No. of People</b></label>
                         <input type="number" min="1" class="form-control" name="person" required style="float:left; width:40%; position: relative;top: -5px;">
                       </li>
                     </ul>
                     <button type="button" class="btn btn-lg btn-block  btn-custom ">Book Now</button>
                   </div>
                 </div>
               </div>
               <div class="team-item">
                 <div class="princing-item orange">
                   <div class="pricing-divider ">
                     <h3 class="text-light">Book Banquet</h3>
                     <p class="text-light font-weight-normal">Banquet Halls for Weddings, Anniversaries, Birthday is available. Book now and avail best prices. </p>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">  <button type="button" style="background:#F7921E" class="btn btn-lg btn-block  btn-custom" data-toggle="modal" data-target="#exampleModal">Book Now</button> </div>
                 </div>
               </div>
               <div class="team-item">
                 <div class="princing-item blue">
                   <div class="pricing-divider ">
                     <h3 class="text-light">Book Restaurant</h3>
                     <p class="text-light font-weight-normal"> Come here with your friends & family and enjoy the best quality food & beverages at Happy Vally Park.</p>
                   </div>
                   <div class="card-body bg-white mt-0 shadow"> <button type="button" type="button" style="background:#2D5772" class="btn btn-lg btn-block btn-custom " data-toggle="modal" data-target="#exampleModal2">Book Now</button> </div>
                 </div>
               </div>
               <div class="team-item">
                 <div class="princing-item green">
                   <div class="pricing-divider ">
                     <h3 class="text-light">Book Picnic Spot</h3>
                     <p class="text-light font-weight-normal"> Its Picnic time! Come here with your friends & family to enjoy at Happy Valley Park. Contact us for booking. </p>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">  <button type="button" style="background:#1AA85C; color:#fff;" class="btn btn-lg btn-block  btn-custom" data-toggle="modal" data-target="#exampleModal1">Book Now</button> </div>
                 </div>

               </div>
             </div>
               </div>
             </div>
             <div class="container-fluid bg-gradient p-5 mob-ndis" style="position: absolute;">
               <div class="row m-auto text-center">
                 <div class="col-md-3 princing-item red">
                   <div class="pricing-divider ">
                     <h3 class="text-light">Book Ticket</h3>
                     <h4 class="my-0 display-4 text-light font-weight-normal"><span class="h3">₹</span> 20 <span class="h5">/per person</span></h4>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">
                     <ul class="list-unstyled position-relative mb-3">
                       <li>
                         <label style="color:#000; display:block; text-align:left; width:60%; float:left;"><b>No. of People</b></label>
                         <input type="number" min="1" class="form-control" name="person" required style="float:left; width:40%; position: relative;top: -5px;">
                       </li>
                     </ul>
                     <button type="button" class="btn btn-lg btn-block  btn-custom ">Book Now</button>
                   </div>
                 </div>
                <div class="col-md-3 princing-item orange">
                           <div class="pricing-divider ">
                     <h3 class="text-light">Book Banquet</h3>
                     <p class="text-light font-weight-normal">Banquet Halls for Weddings, Anniversaries, Birthday is available. Book now and avail best prices. </p>
                   </div>
                           <div class="card-body bg-white mt-0 shadow">  <button type="button" style="background:#F7921E" class="btn btn-lg btn-block  btn-custom" data-toggle="modal" data-target="#exampleModal">Book Now</button> </div>
                         </div>

                <div class="col-md-3 princing-item blue">
                           <div class="pricing-divider ">
                     <h3 class="text-light">Book Restaurant</h3>
                     <p class="text-light font-weight-normal"> Come here with your friends & family and enjoy the best quality food & beverages at Happy Vally Park.</p>
                   </div>
                           <div class="card-body bg-white mt-0 shadow"> <button type="button" type="button" style="background:#2D5772" class="btn btn-lg btn-block btn-custom " data-toggle="modal" data-target="#exampleModal2">Book Now</button>  </div>
                         </div>
                      <div class="col-md-3 princing-item green">
                           <div class="pricing-divider ">
                     <h3 class="text-light">Book Picnic Spot</h3>
                     <p class="text-light font-weight-normal"> Its Picnic time! Come here with your friends & family to enjoy at Happy Valley Park. Contact us for booking. </p>
                   </div>
                  <div class="card-body bg-white mt-0 shadow">  <button type="button" style="background:#1AA85C; color:#fff;" class="btn btn-lg btn-block  btn-custom" data-toggle="modal" data-target="#exampleModal1">Book Now</button> </div>
                         </div>
               </div>
             </div>
           </section>
           
           <!-- Services End --> 
           
           <!-- HOW WE WORK Start -->
           
           <div id="rs-team" class="sec-color" style="background:url(<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/rides.png); background-repeat:no-repeat; background-size:cover; padding-bottom:50px; padding-top: 25%;">
             <div class="container">
               <div class="service-title text-center wow fadeInDown" style="padding-top:70px;">
                 <h3 class="text-center"><span>Ride <strong>&</strong> Slides </span></h3>
               </div>
               <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="70" data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="true" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="true" data-ipad-device-dots2="false" data-md-device="3" data-md-device-nav="true" data-md-device-dots="false"> 
                 
                 <!--team item start -->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/1.png" alt="team Image" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/cms/jumping-house">
                     <h4 class="title">Jumping <strong>House</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <!--team item end --> 
                 
                 <!--team item start -->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/2.png" alt="team Image" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/cms/children-pool">
                     <h4 class="title">Children <strong>Pool</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <!--team item end --> 
                 
                 <!--team item start -->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/3.png" alt="team Image" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/cms/striking-car">
                     <h4 class="title">Striking <strong>Car</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <!--team item end --> 
                 
                 <!--team item start -->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/4.jpg" alt="team Image" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/cms/children-boating">
                     <h4 class="title">Children <strong>Boating</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <!--team item end --> 
                 
                 <!--team item start -->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/5.png" alt="team Image" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/cms/happy-bees">
                     <h4 class="title">Happy <strong>Bees</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <!--team item end --> 
                 
               </div>
             </div>
           </div>
           
           <!-- HOW WE WORK END --> 
           
           <!-- Portfolio Start -->
           
           <section id="rs-portfolio2" class="rs-portfolio2 defutl-style" style="background:url(<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/ex-bg.png); background-repeat:no-repeat; background-size:cover; padding-bottom:50px;">
             <div class="container">
               <div class="service-title text-center wow fadeInDown" style="padding-top:70px;">
                 <h3 class="text-center"><span style="color:#555555; background:#fff; border:1px solid #ccc">Your Happy Valley <strong>Experience</strong> </span></h3>
               </div>
               <div class="container-fluid">
                 <div class="row">
                   <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/bg_rides.png">
                     <h5 style="padding:10px 8px; color:#fff; background:rgba(190,21,28,0.8); position: absolute;left: 0;bottom: 0;right: 0; margin: 0 15px;"><a style="color:#fff;" href="<?php echo  Yii::$app->request->baseUrl;?>/cms/restaurant">See Video</a></h5>
                   </div>
                   <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".4s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/2.png">
                     <h5 style="padding:10px 8px; color:#fff; background:rgba(186,9,193,0.8); position: absolute;left: 0;bottom: 0;right: 0; margin: 0 15px;"><a style="color:#fff;" href="<?php echo  Yii::$app->request->baseUrl;?>/cms/picnic-spots">See Video</a></h5>
                   </div>
                   <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".6s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/4.png">
                     <h5 style="padding:10px 8px; color:#fff; background:rgba(40,150,14,0.8); position: absolute;left: 0;bottom:0;right: 0; margin: 0 15px;"><a style="color:#fff;" href="<?php echo  Yii::$app->request->baseUrl;?>/cms/theatre">See Video</a></h5>
                   </div>
                   <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".8s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/5.png">
                     <h5 style="padding:10px 8px; color:#fff; background:rgba(9,94,160,0.8); position: absolute;left: 0;bottom: 0;right: 0; margin: 0 15px;">See Video</h5>
                   </div>
                 </div>
               </div>
             </div>
           </section>
           
           <!-- Portfolio End -->
           
           <div id="rs-team2" class="sec-spacer sec-color" style="background:url(<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/rides1.png);  background-repeat:no-repeat; background-size:cover; ">
             <div class="container">
               <div class="container-fluid">
                 <div class="row wow fadeInUp" data-wow-duration="1s">
                   <div class="col-md-4 pad-30">
                     <div class="card mb-4" style="-webkit-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);

         -moz-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);

         box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);"> <img class="card-img-top" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/picnic.png" alt="Card image cap">
                       <div class="card-body text-center">
                         <h4 class="title">PICNIC <strong>SPOT</strong></h4>
                         <p class="card-text">The underrated pleasure of picnic has been forgotten by many. Take out some time from your busy
                           
                           schedule and plan a short picnic with your friend.</p>
                         <a href="<?php echo  Yii::$app->request->baseUrl;?>/cms/picnic-spots"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/btn.png" style="width:50%;"></a> </div>
                     </div>
                   </div>
                   <div class="col-md-4 pad-30">
                     <div class="card mb-4" style="-webkit-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);

         -moz-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);

         box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);"> <img class="card-img-top" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/ban.png" alt="Card image cap">
                       <div class="card-body text-center">
                         <h4 class="title">BANQUET</h4>
                         <p class="card-text">We provide the ideal venues for corporate meetings, birthdays, weddings, conferences, theme
                           
                           events and seminars etc which are thoughtfully designed.</p>
                         <a href="<?php echo  Yii::$app->request->baseUrl;?>/cms/banquet"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/btn.png" style="width:50%;"></a> </div>
                     </div>
                   </div>
                   <div class="col-md-4 pad-30">
                     <div class="card mb-4" style="-webkit-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);

         -moz-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);

         box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);"> <img class="card-img-top" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/res.png" alt="Card image cap">
                       <div class="card-body text-center">
                         <h4 class="title">RESTAURANT</h4>
                         <p class="card-text">The best memories are made when gathered around the table. Enjoy the delights of our restaurant and make the day even more happening!</p>
                         <a href="<?php echo  Yii::$app->request->baseUrl;?>/cms/restaurant"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/btn.png" style="width:50%;"></a> </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           
           <!-- Portfolio Start -->
           
           <section id="rs-portfolio3" class="rs-portfolio2 defutl-style">
             <div class="row">
               <div class="col-md-7">
                 <div class="container">
                   <div class="wow fadeIn exp_pad" data-wow-duration="1s" data-wow-delay=".2s">
                     <h4 style="color:#BE151C; font-size:36px;"><span class="exp_heading">Experience</span> <br>
                       5D with Us</h4>
                     <p>Happy Valley Park presents to you the state-of-the-art theatre that takes you on a thrilling journey
                       
                       engaging all yours senses in a way that you have never imagined. Synchronized spectrum of visual
                       
                       effects, sophisticated motion ride system, special live environmental effects and high end surround
                       
                       sound systems generate a highly realistic experience .Immerse yourself in the movie magic instead
                       
                       of just watching them!</p>
                     <a href="<?php echo  Yii::$app->request->baseUrl;?>/cms/theatre" style="background:#A72BC9; padding: 6px 50px;; color:#fff; border-radius:0;"  class="btn">Read More</a> </div>
                 </div>
               </div>
               <div class="col-md-5"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/maxresdefault.jpg"> </div>
             </div>
           </section>
           
           <!-- Portfolio End -->
           
           <section id="rs-pricing" class="rs-pricing gray-color">
             <div class="container">
               <div class="row">
                 <p class="doted-box"> Banquet Halls for Weddings, Anniversaries, Birthday is available. Book now and avail best prices. 
                   Its Picnic time enjoy at Happy Valley Park. Contact us for booking. Come here with your friends & family and enjoy the best quality food & beverages at Happy Vally Park.</p>
               </div>
             </div>
           </section>
           <div id="rs-team3" class="rs-contact">
             <div class="service-title text-center wow fadeInDown" style="padding-top:70px;">
               <h3 class="text-center"><span style="color:#555555; background:#fff; border:1px solid #ccc">News <strong>&</strong> Events </span></h3>
             </div>
             <div class="row">
               <div style="position:relative; padding:0;" class="col-md-6 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/christmas.png">
                 <h5 class="news_heading">MERRY CHRISTMAS
                   <p>Enjoy your christmas with us!</p>
                 </h5>
               </div>
               <div style="position:relative; padding:0;" class="col-md-6 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".4s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/rail.png">
                 <h5 class="news_heading">WATER THEME PARK
                   <p>Happy Valley Park is coming with an amazing water park very soon</p>
                 </h5>
               </div>
             </div>
           </div>
         </div>

         <!-- Model Starts Here -->

         <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">
           <div class="modal-dialog modal-lg">
             <div class="modal-content">
               <div class="modal-body">
                 <button type="button" class="close cross" data-dismiss="modal"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/cross.png" alt=""></button>
                 <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/offer.png" alt=""> </div>
             </div>
           </div>
         </div>
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelw" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabelw">Book Banquet</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form>
                   <div class="form-group">
                     <input type="text" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" class="form-control" placeholder="Email" required>
                   </div>
                   <div class="form-group">
                     <input type="number" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group">
                     <input type="number" class="form-control" min="1" placeholder="No of People" required>
                   </div>
                   <div class="form-group">
                     <input type="text" class="form-control" onfocus="(this.type='date')" value="DD-MM-YYYY" placeholder="Date" id="datew" name="date" required>
                   </div>
                   <div class="form-group">
                     <input type="text" value="Banquet" class="form-control" readonly>
                   </div>
                 </form>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-primary">Submit</button>
               </div>
             </div>
           </div>
         </div>
         <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Book Picnic Spot</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form>
                   <div class="form-group">
                     <input type="text" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" class="form-control" placeholder="Email" required>
                   </div>
                   <div class="form-group">
                     <input type="number" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group">
                     <input type="number" class="form-control" min="1" placeholder="No of People" required>
                   </div>
                   <div class="form-group">
                     <input type="number" class="form-control" min="1" placeholder="No of Spot" required>
                   </div>
                   <div class="form-group">
                     <input type="text" class="form-control" onfocus="(this.type='date')" value="DD-MM-YYYY" placeholder="Date" id="date" name="date" required>
                   </div>
                   <div class="form-group">
                     <input type="text" value="Picnic Spot" class="form-control" readonly>
                   </div>
                 </form>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-primary">Submit</button>
               </div>
             </div>
           </div>
         </div>
         <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabe2">Book Restaurant</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form>
                   <div class="form-group">
                     <input type="text" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" class="form-control" placeholder="Email" required>
                   </div>
                   <div class="form-group">
                     <input type="number" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group">
                     <input type="number" class="form-control" min="1" placeholder="No of People" required>
                   </div>
                   <div class="form-group">
                     <select class="form-control">
                       <option>Select Time Slot</option>
                       <option>10am - 12pm</option>
                       <option>12pm - 2pm</option>
                       <option>2pm - 4pm</option>
                       <option>4pm - 6pm</option>
                     </select>
                   </div>
                   <div class="form-group">
                     <input type="text" class="form-control" onfocus="(this.type='date')" value="DD-MM-YYYY" placeholder="Date" id="date2" name="date" required>
                   </div>
                   <div class="form-group">
                     <input type="text" value="Restaurant" class="form-control" readonly>
                   </div>
                 </form>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-primary">Submit</button>
               </div>
             </div>
           </div>
         </div>

         <!-- Model Ends Here -->
         
         <!-- start scrollUp  -->
         <a class="rig" href="https://www.payumoney.com/webfronts/#/index/Happy_Valley_Park" target="_blank" data-disable-scroll=true>PAY ONLINE</a>
         <div id="scrollUp"> <i class="fa fa-angle-up"></i> </div>