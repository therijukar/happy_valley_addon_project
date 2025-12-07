<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    die;
 ?>
 		<!-- Main content Start -->
         <div class="main-content">
             <!-- Slider Start -->

    
 <!-- Slider begins here -->
 <video poster="http://partnershipforum.se2.com/wp-content/uploads/2018/05/poster.png" autoplay loop id="video-background" muted playsinline preload="auto">      
 
   <!--<source src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/video/hvp.mp4" type="video/mp4"/>-->
 </video> 
             <!-- Slider End -->  
       <!-- Services Start -->
 			<section id="rs-services" class="rs-services-3 rs-contact form-tab rs-service-style1 pt-45 pb-30 f-min">
 				<div class="container">
                 <!--<div class="service-title text-center">
                 <!--                <h3>Booking Forms </h3>-->
                 <!--            </div> -->-->
 	<div class="row">
 		<div class="col-md-12">
 				<nav>
 					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
 						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">TICKETS</a>
 						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">RESTAURANT </a>
 						<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">BANQUET </a>
 						<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">PICNIC SPOT</a>
 					</div>
 				</nav>
 				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent" style="background: rgba(255,255,255,.4);">
 					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
 						<div class="contact-form" style="max-width:inherit; padding:0 5px;">
                                 <div id="form-messages"></div>
                                 <?php $form = ActiveForm::begin(['action' =>['booking/add-tickets'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
                                <input type="hidden" name="product" value="1">
                                     <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="name" placeholder="Name" id="name" name="Booking[name]" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="phone" placeholder="Phone" id="phone" name="Booking[phone]" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="email" placeholder="Email Id" id="email" name="Booking[email]" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field data_1" id="">
                                             	<div class="input-group date">
                                             	    <span class="input-group-addon"></span>
                                                 	<input type="text" autocomplete="off" placeholder="Date" id="date" name="from_date" required>
                                                </div>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="number" placeholder="No. of People" id="people" name="Booking[no_of_units]" min="0" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="text" placeholder="Amount" id="amount" name="Booking[amount]" required>
                                             </div>                              
                                         </div>
                                     </div>
                                     <div class="form-button text-center">
                                         <button type="submit" class="readon">Book Now</button>                            
                                     </div>
                                  <?php ActiveForm::end(); ?>
                             </div> 
                         </div>  
 					
 					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
 						<div class="contact-form" style="max-width:inherit; padding:0 5px;">
                                 <div id="form-messages1"></div>
                                 <?php $form = ActiveForm::begin(['action' =>['booking/add-tickets'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
                                <input type="hidden" name="product" value="2">
                                     <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="name" placeholder="Name" id="name" name="Booking[name]" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="phone" placeholder="Phone" id="phone" name="Booking[phone]" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="email" placeholder="Email Id" id="email" name="Booking[email]" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="number" placeholder="No. of People" id="people" name="units" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field data_1" id="">
                                             	<div class="input-group date">
                                             	    <span class="input-group-addon"></span>
                                                 	<input type="text" autocomplete="off" placeholder="Date" id="date" name="from_date" required>
                                                </div>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                             	<div class="input-group">
                                             	    <span class="input-group-addon"></span>
                                                 	<input type="text" class="form-control timepicker" placeholder="Time" name="from_time"
			                                       id="time" maxlength="200" aria-required="true"
			                                       aria-invalid="true">
                                                </div>
                                             </div>                              
                                         </div>
                                     </div>
                                         
                                     <div class="form-button text-center">
                                         <button type="submit" class="readon">Book Now</button>                            
                                     </div>
                                  <?php ActiveForm::end(); ?>
                             </div>
 					</div>
                     
 					<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
 						<div class="contact-form" style="max-width:inherit; padding:0 5px;">
                                 <div id="form-messages2"></div>
                                 <?php $form = ActiveForm::begin(['action' =>['booking/add-tickets'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
                                <input type="hidden" name="product" value="3">
                                     <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="name" placeholder="Name" id="name" name="Booking[name]" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="phone" placeholder="Phone" id="phone" name="Booking[phone]" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="email" placeholder="Email Id" id="email" name="Booking[email]" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="number" placeholder="No. of People" id="people" name="units" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field data_1" id="">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" autocomplete="off" placeholder="From Date" id="from_date" name="from_date" required>
                                                </div>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field data_1" id="">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" autocomplete="off" placeholder="To Date" id="to_date" name="to_date" required>
                                                </div>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                <div class="input-group">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" class="form-control timepicker" placeholder="From Time" name="time"
                                                   id="time" maxlength="200" aria-required="true"
                                                   aria-invalid="true">
                                                </div>
                                             </div>                              
                                         </div>
                                     </div>

                                         
                                     <div class="form-button text-center">
                                         <button type="submit" class="readon">Book Now</button>                            
                                     </div>
                                  <?php ActiveForm::end(); ?>
                             </div>
 					</div>
                     
 					<div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
 						<div class="contact-form" style="max-width:inherit; padding:0 5px;">
                                 <div id="form-messages3"></div>
                                 <?php $form = ActiveForm::begin(['action' =>['booking/add-tickets'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
                                    <input type="hidden" name="product" value="4">
                                     <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="name" placeholder="Name" id="name" name="Booking[name]" required>
                                             </div>                              
                                         </div>
                                         <div class="col-md-3 col-sm-12">
                                             <div class="form-field">
                                                 <input type="phone" placeholder="Phone" id="phone" name="Booking[phone]" required>
                                             </div>                              
                                         </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-field">
                                                 <input type="email" placeholder="Email Id" id="email3" name="Booking[email]" required>
                                            </div>                              
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-field">
                                                 <input type="number" placeholder="No. of People" id="people3" name="units" required>
                                            </div>                              
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-field">
                                                 <input type="number" placeholder="No. of Spots" id="spots3" name="spots" required>
                                            </div>                              
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                             <div class="form-field data_1" id="">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" autocomplete="off" placeholder="Date" id="from_date" name="from_date" required>
                                                </div>
                                             </div>                              
                                         </div>
                                     </div>
                                                           
                                     <div class="form-button text-center">
                                         <button type="submit" class="readon">Book Now</button>
                                     </div>
                                  <?php ActiveForm::end(); ?>
                             </div>
 					</div>
 					</div>
 				</div>
 			
 			</div>                                
 </div>
 	</div>

 			</section>
 			<!-- Services End -->      
             <!-- HOW WE WORK Start -->
             <div id="rs-team" class="sec-color" style="background:url(images/bg/rides.png); background-repeat:no-repeat; background-size:cover; padding-bottom:50px;">
                 <div class="container">
                 <div class="service-title text-center wow fadeInDown" style="padding-top:70px;">
                                 <h3 class="text-center"><span>Ride <strong>&</strong> Slides</span></h3>
                             </div> 
                     <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="70" data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true" data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="true" data-ipad-device-dots="false" data-ipad-device2="1" data-ipad-device-nav2="true" data-ipad-device-dots2="false" data-md-device="3" data-md-device-nav="true" data-md-device-dots="false">
                         <!--team item start -->
                         <div class="team-item">                            
                             <div class="team-overlay">
                                 <div class="team-img">
                                     <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/1.png" alt="team Image" />
                                 </div>
                             </div>                       
                             <div class="team-info">
                                 <a href="team-details.html"><h4 class="title">Jumping <strong>House</strong></h4></a>
                                 <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                             </div>
                         </div>
                         <!--team item end -->
                         
                         <!--team item start -->
                         <div class="team-item">
                             <div class="team-overlay">
                                 <div class="team-img">
                                     <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/2.png" alt="team Image" />
                                 </div>
                             </div>
                             <div class="team-info">
                                 <a href="team-details.html"><h4 class="title">Children <strong>Pool</strong></h4></a>
                                 <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                             </div>
                         </div>
                         <!--team item end -->
                         
                         <!--team item start -->
                         <div class="team-item">                            
                             <div class="team-overlay">
                                 <div class="team-img">
                                     <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/3.png" alt="team Image" />
                                 </div>
                             </div>
                             <div class="team-info">
                                 <a href="team-details.html"><h4 class="title">Striking <strong>Car</strong></h4></a>
                                 <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                             </div>
                         </div>
                         <!--team item end -->
                         
                         <!--team item start -->
                         <div class="team-item">
                             <div class="team-overlay">
                                 <div class="team-img">
                                     <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/4.jpg" alt="team Image" />
                                 </div>
                             </div>
                             <div class="team-info">
                                 <a href="team-details.html"><h4 class="title">Children <strong>Boating</strong></h4></a>
                                 <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                             </div>
                         </div>
                         <!--team item end -->
                         
                         <!--team item start -->
                         <div class="team-item">
                             <div class="team-overlay">
                                 <div class="team-img">
                                     <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/rides-bee.png" alt="team Image" />
                                 </div>
                             </div>
                             <div class="team-info">
                                 <a href="team-details.html"><h4 class="title">Happy <strong>Bees</strong></h4></a>
                                 <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                             </div>
                         </div>
                         <!--team item end -->     
                     </div>
                 </div>
             </div>
             <!-- HOW WE WORK END -->
             
             
             
             <!-- Portfolio Start -->
             <!--<section id="rs-portfolio2" class="rs-portfolio2 defutl-style" style="background:url(images/bg/ex-bg.png); background-repeat:no-repeat; background-size:cover; padding-bottom:50px;">
                 <div class="container">
                <div class="service-title text-center wow fadeInDown" style="padding-top:70px;">
                                 <h3 class="text-center"><span style="color:#555555; background:#fff; border:1px solid #ccc">Your Happy Valley <strong>Experience</strong> </span></h3>
                             </div> 
                     
                     <div class="container-fluid">
                         <div class="row">
                         
                             <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s">
                             <img src="<?php //echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/bg_rides.png">
                             <h5 style="padding:10px 8px; color:#fff; background:rgba(190,21,28,0.8); position: absolute;left: 0;bottom: 0;right: 0; margin: 0 15px;"><a style="color:#fff;" href="restaurant.html">See Video</a></h5>
                             </div>
                             <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".4s">
                             <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/2.png">
                             <h5 style="padding:10px 8px; color:#fff; background:rgba(186,9,193,0.8); position: absolute;left: 0;bottom: 0;right: 0; margin: 0 15px;"><a style="color:#fff;" href="picnic_spot.html">See Video</a></h5>
                             </div>
                             <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".6s">
                             <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/4.png">
                             <h5 style="padding:10px 8px; color:#fff; background:rgba(40,150,14,0.8); position: absolute;left: 0;bottom:0;right: 0; margin: 0 15px;"><a style="color:#fff;" href="theatre.html">See Video</a></h5>
                             </div>
                             <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".8s">
                             <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/banquet.png">
                             <h5 style="padding:10px 8px; color:#fff; background:rgba(9,94,160,0.8); position: absolute;left: 0;bottom: 0;right: 0; margin: 0 15px;">See Video</h5>
                             </div>
                         </div>
                     </div>
                 </div>
             </section>-->
             <!-- Portfolio End -->
         <div id="rs-team2" class="sec-spacer sec-color" style="background:url(images/bg/rides1.png);  background-repeat:no-repeat; background-size:cover; ">
                 <div class="container">
                             
                              <div class="container-fluid">
                         <div class="row wow fadeInUp" data-wow-duration="1s">
       <div class="col-md-4 pad-30">
          <div class="card mb-4" style="-webkit-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);
 -moz-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);
 box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);">
             <img class="card-img-top" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/picnic.png" alt="Card image cap">
             <div class="card-body text-center">
                <h4 class="title">PICNIC <strong>SPOT</strong></h4>
                <p class="card-text">The underrated pleasure of picnic has been forgotten by many. Take out some time from your busy
 schedule and plan a short picnic with your friend.</p>
                <a href="picnic_spot"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/btn.png" style="width:50%;"></a>
             </div>
          </div>
       </div>
       <div class="col-md-4 pad-30">
          <div class="card mb-4" style="-webkit-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);
 -moz-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);
 box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);">
             <img class="card-img-top" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/ban.png" alt="Card image cap">
             <div class="card-body text-center">
                <h4 class="title">BANQUET</h4>
                <p class="card-text">We provide the ideal venues for corporate meetings, birthdays, weddings, conferences, theme
 events and seminars etc which are thoughtfully designed.</p>
                <a href="banquet.html"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/btn.png" style="width:50%;"></a>
             </div>
          </div>
       </div>
       <div class="col-md-4 pad-30">
          <div class="card mb-4" style="-webkit-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);
 -moz-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);
 box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);">
             <img class="card-img-top" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/res.png" alt="Card image cap">
             <div class="card-body text-center">
                <h4 class="title">RESTAURANT</h4>
                <p class="card-text">The best memories are made when gathered around the table. Enjoy the delights of our restaurant and make the day even more happening!</p>
                <a href="restaurant.html"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/btn.png" style="width:50%;"></a>
             </div>
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
                         <h4 style="color:#BE151C; font-size:36px;"><span class="exp_heading">Experience</span> <br>5D with Us</h4>     
                         <p>Happy Valley Park presents to you the state-of-the-art theatre that takes you on a thrilling journey
 engaging all yours senses in a way that you have never imagined. Synchronized spectrum of visual
 effects, sophisticated motion ride system, special live environmental effects and high end surround
 sound systems generate a highly realistic experience .Immerse yourself in the movie magic instead
 of just watching them!</p>
                         
                         <a href="theatre.html" style="background:#A72BC9; padding: 6px 50px;; color:#fff; border-radius:0;"  class="btn">Read More</a>
                     </div>
                 </div>
                 </div>
                 <div class="col-md-5">
                 <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/maxresdefault.jpg">
                 </div>
                 </div>
             </section>
             <!-- Portfolio End -->
             
             <!--<section id="rs-pricing" class="rs-pricing gray-color pt-100 pb-100">-->
             <!--    <div class="container">-->
             <!--        <div class="sec-title3 text-center">-->
             <!--            <h3>Deals & Offers</h3>                    -->
             <!--        </div>-->
             <!--        <div class="row">-->
             <!--            <div class="col-lg-4 col-md-6 col-sm-12 mb-md-30">-->
             <!--                <div class="pricing-plan">-->
             <!--                    <div class="pricing-head">-->
             <!--                        <div class="name">-->
             <!--                            Custom Package-->
             <!--                        </div>-->
             <!--                        <div class="price">-->
             <!--                            <span class="value">-->
             <!--                                <sup>₹</sup>240-->
             <!--                            </span>-->
             <!--                            <span class="duration">-->
             <!--                                / per Person-->
             <!--                            </span>-->
             <!--                        </div>-->
             <!--                    </div>-->
             <!--                    <div class="pricing-body">-->
             <!--                        <ul>-->
             <!--                            <li>-->
             <!--                                Entry +-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Main Park (All Rides & Attractions)-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Water Park +-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Vegetarian OR Non Vegetarian Meal-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Shows & Games are not included.-->
             <!--                            </li>-->
             <!--                        </ul>-->
             <!--                    </div>-->
             <!--                    <div class="pricing-footer">-->
             <!--                        <a href="#" class="p-button">Buy Now</a>-->
             <!--                    </div>-->
             <!--                </div>-->
             <!--            </div>-->
             <!--            <div class="col-lg-4 col-md-6 col-sm-12">-->
             <!--                <div class="pricing-plan featured">-->
             <!--                    <div class="pricing-head">-->
             <!--                        <div class="name">-->
             <!--                            Basic Package-->
             <!--                        </div>-->
             <!--                        <div class="price">-->
             <!--                            <span class="value">-->
             <!--                                <sup>₹</sup>300-->
             <!--                            </span>-->
             <!--                            <span class="duration">-->
             <!--                                / per Person-->
             <!--                            </span>-->
             <!--                        </div>-->
             <!--                    </div>-->
             <!--                    <div class="pricing-body">-->
             <!--                        <ul>-->
             <!--                            <li>-->
             <!--                                Entry +-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Main Park (All Rides & Attractions)-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Water Park +-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Vegetarian OR Non Vegetarian Meal-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Shows & Games are not included.-->
             <!--                            </li>-->
             <!--                        </ul>-->
             <!--                    </div>-->
             <!--                    <div class="pricing-footer">-->
             <!--                        <a href="#" class="p-button">Buy Now</a>-->
             <!--                    </div>-->
             <!--                </div>-->
             <!--            </div>-->
             <!--            <div class="col-lg-4 col-md-6 hidden-md">-->
             <!--                <div class="pricing-plan">-->
             <!--                    <div class="pricing-head">-->
             <!--                        <div class="name">-->
             <!--                            Extendend Package-->
             <!--                        </div>-->
             <!--                        <div class="price">-->
             <!--                            <span class="value">-->
             <!--                                <sup>₹</sup>350-->
             <!--                            </span>-->
             <!--                            <span class="duration">-->
             <!--                                / per Person-->
             <!--                            </span>-->
             <!--                        </div>-->
             <!--                    </div>-->
             <!--                    <div class="pricing-body">-->
             <!--                        <ul>-->
             <!--                            <li>-->
             <!--                                Entry +-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Main Park (All Rides & Attractions)-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Water Park +-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Vegetarian OR Non Vegetarian Meal-->
             <!--                            </li>-->
             <!--                            <li>-->
             <!--                                Shows & Games are not included.-->
             <!--                            </li>-->
             <!--                        </ul>-->
             <!--                    </div>-->
             <!--                    <div class="pricing-footer">-->
             <!--                        <a href="#" class="p-button">Buy Now</a>-->
             <!--                    </div>-->
             <!--                </div>-->
             <!--            </div>-->
             <!--        </div>-->
             <!--    </div>-->
             <!--</section>-->-->
             
             <div id="rs-team3" class="rs-contact">
             <div class="service-title text-center wow fadeInDown" style="padding-top:70px;">
                                 <h3 class="text-center"><span style="color:#555555; background:#fff; border:1px solid #ccc">News <strong>&</strong> Events </span></h3>
                             </div> 
             <div class="row">
                 <div style="position:relative; padding:0;" class="col-md-6 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s">
                             <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/christmas.png">
                             <h5 class="news_heading">MERRY CHRISTMAS
                             <p>Enjoy your christmas with us!</p></h5>
                             
                             </div>
                             <div style="position:relative; padding:0;" class="col-md-6 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".4s">
                             <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/rail.png">
                             <h5 class="news_heading">WATER THEME PARK
                             <p>Happy Valley Park is coming with an amazing water park very soon</p></h5>
                             </div>
                             </div>

         </div>
         </div>
         
         
         <script>
             $(document).ready(function () {
                 console.log("here");
    const today = new Date();
    $('#date').datepicker({
        format: 'dd-mm-yyyy',
        startDate: tomorrow(today),
        autoclose: true,
        todayHighlight: false
    }).on('changeDate', function (e) {
        console.log("in change");
        validateDateInput(e.date);
    });

    // Disable manual entry of past dates
    $('#date').on('change', function () {
        console.log("in change2");
        const inputDate = parseDate($(this).val());
        if (inputDate && inputDate < tomorrow(today)) {
            $(this).val('');
            alert('Please select a future date.');
        }
    });

    function tomorrow(date) {
        let t = new Date(date);
        t.setDate(t.getDate() + 1);
        return t;
    }

    function parseDate(str) {
        const [day, month, year] = str.split('-');
        return new Date(`${year}-${month}-${day}`);
    }

    function validateDateInput(date) {
        if (date < tomorrow(today)) {
            $('#date').datepicker('update', '');
        }
    }
});

         </script>