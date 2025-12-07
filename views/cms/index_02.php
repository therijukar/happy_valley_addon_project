<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
   
 ?>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 <style type="text/css">
 .doted-box { border: 1px dashed #fff; color: #fff; padding: 20px; font-size: 18px; background: #03a84e; margin: 40px 0px 0px 0px; }
  .doted-box1 { border: 1px dashed #fff; color: #fff; padding: 20px; font-size: 18px; background: #fb7b43; margin: }
   .doted-box2 { border: 1px dashed #fff; color: #fff; padding: 20px; font-size: 18px; background: #a72bc9;  }
 
 
 		.ticketModal .modal-title {
		    font-weight: 700;
		    font-size: 28px;
		    display: block;
		    width: 100%;
		    text-align: center;
		    color: #BE151C;
		}
		.ticketModal .modal-content.modal-center {
		    border-radius: 15px;
		    box-shadow: 0 0 10px #000;
		    padding: 30px 15px;
		}
		.modal-footer button {
		    display: inline-block;
		    padding: 8px 25px;
		    background: #BE151C;
		    border-color: #BE151C;
		    min-width: 180px;
		    font-size: 20px;
		    line-height: 1.5;
		}
		.ticketModal .form-group input.form-control {
    height: 50px;
    padding: 18px;
    box-shadow: 0 0 8px #cccc;
    background: #fff;
}	
.ticketModal .form-group input.form-control:focus{
	border-color: #000;
}
		.modal-footer button:hover, .modal-footer button:focus{
			color:#BE151C;
			background: transparent;
			border-color: #BE151C;
			box-shadow: unset;
		}
		.ticketModal .modal-content.modal-center .modal-header button.close {
    position: absolute;
    top: 10px;
    right: 20px;
}

 </style>
 		<!-- Main content Start -->
         <div class="main-content"> 
           
           <!-- Slider Start --> 
           
           <!-- Slider begins here -->
           <marquee style="background: darkred;color: yellow; margin-bottom: -8px;">Synthetic cloth is mandatory for the water park. Alcohol and Outside food is not allowed.</marquee>
           <video poster="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/slider/happy-valley-park.png" autoplay loop id="video-background" muted playsinline preload="auto">
             <source src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/video/hvp3.mp4" type="video/mp4"/>
           </video>
           
           <!-- Slider End --> 
           
           <!-- Water world Services Start -->
       
           
           <section id="rs-services" class="rs-services-3 price mp-212" style="position: relative;">
             <div class="container-fluid bg-gradient p-5 mob-ndis" style="position: absolute;">
               <div class="row m-auto text-center">
             <div class="rs-carousel owl-carousel" data-loop="true" data-items="4" data-margin="30" data-autoplay="false" data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false" data-nav="false" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true" data-mobile-device-dots="false" data-ipad-device="3" data-ipad-device-nav="true" data-ipad-device-dots="false" data-ipad-device2="3" data-ipad-device-nav2="true" data-ipad-device-dots2="false" data-md-device="4" data-md-device-nav="true" data-md-device-dots="false">
            
            <!--water world commented-->
            
            <!--<div class="team-item ">-->
            <!--   <div class="princing-item green">-->
            <!--       <div class="pricing-divider">-->
            <!--         <h3 class="text-light">Water World</h3>-->
                     
            <!--         <span style="color: red; font-weight: bold; text-shadow: -2px -2px 0 white, 2px -2px 0 white, -2px 2px 0 white, 2px 2px 0 white; font-family: Arial, sans-serif; font-size: 30px; margin-top: -10px;">20% OFF</span>-->


            <!--         <p class="text-light font-weight-normal" data-toggle="tooltip" title="₹ 240/Below 10 Years, ₹400/Above 10 Years">* Condition Apply</p> -->
            <!--         <p class="text-light font-weight-normal" data-toggle="tooltip" title=""> Rs. 40 Entry Ticket Free with this Ticket</p>-->
            <!--         <h3 style="display: inline-block; text-decoration: line-through; color: white;">₹500 </h3>-->
            <!--         <h4 class="my-0 display-4 text-light font-weight-normal" style="display: inline-block;"><span class="h3">₹</span> 400<span class="h5"></span></h4>-->

            <!--       </div>-->
            <!--       <div class="card-body bg-white mt-0 shadow">-->
            <!--         <button type="button" style="background:#1AA85C; color:#fff;" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#waterworldModal">Book Now</button>-->
                     <!--<button type="button" style="background:#1AA85C; color:#fff;" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#waterworldModal" >Book Now</button>-->
            <!--       </div>-->
            <!--     </div>-->
            <!--   </div>-->

            <!-- Entry Ticket Services Start -->
               <div class="team-item">
               <div class="princing-item red">
                   <div class="pricing-divider ">
                     <h3 class="text-light">Entry Ticket</h3>
                     <h4 class="my-0 display-4 text-light font-weight-normal"><span class="h3">₹</span> 40 <span class="h5">/per person</span></h4>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">
                     <ul class="list-unstyled position-relative mb-3">
                       <li>
                         <label style="color:#000; display:block; text-align:left; width:60%; float:left;"><b>No. of People</b></label>
                         <input type="number" id="people1" min="1" class="form-control" name="person" required style="float:left; width:40%; position: relative;top: -5px;">
                       </li>
                     </ul>
                     <!--<button type="button" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#ticketModal">Book Now</button>-->
                      <button type="button" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#ticketModal">Book Now</button>
                   </div>
                 </div>
               </div>
               <!--      <div class="team-item ">-->
               <!--<div class="princing-item green">-->
               <!--    <div class="pricing-divider">-->
               <!--      <h3 class="text-light">Water World</h3>-->
               <!--      <p class="text-light font-weight-normal" data-toggle="tooltip" title="₹ 300/Below 10 Years, ₹500/Above 10 Years">* Condition Apply</p>-->
               <!--      <h4 class="my-0 display-4 text-light font-weight-normal"><span class="h3">₹</span> 500 <span class="h5"></span></h4>-->
               <!--    </div>-->
               <!--    <div class="card-body bg-white mt-0 shadow">-->
               <!--      <button type="button" style="background:#1AA85C; color:#fff;" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#waterworldModal">Book Now</button>-->
               <!--      <button type="button" style="background:#1AA85C; color:#fff;" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#waterworldModal" >Book Now</button>-->
               <!--    </div>-->
               <!--  </div>-->
               <!--</div>-->
               
                <!-- 5D Show Services Start -->
                
                <div class="team-item">
               <div class="princing-item green">
                   <div class="pricing-divider">
                     <h3 class="text-light">5D Show</h3>
                     <p class="text-light font-weight-normal" data-toggle="tooltip" title="Separate charges per person will be payable for 5D show which is not included in the Entry Fee or any other Ride Charges. ">* Condition Apply</p>
                     <h4 class="my-0 display-4 text-light font-weight-normal"><span class="h3">₹</span> 50 <span class="h5">/per person</span></h4>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">
                     <!--<button type="button" style="background:#1AA85C; color:#fff;" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#fiveDModal">Book Now</button>-->
                     <button type="button" style="background:#1AA85C; color:#fff;" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#fiveDModal">Book Now</button>
                   </div>
                 </div>
               </div>
               <div class="team-item">
                 <div class="princing-item orange">
                   <div class="pricing-divider ban-res">
                     <h3 class="text-light">Banquet Booking</h3>
                     <p class="text-light font-weight-normal" data-toggle="tooltip" title="Banquet Halls for Corporate Conferences, Seminars, Wedding, Anniversary, Birthday and other events is available.&#013; Book now and avail best prices.">* Condition Apply</p>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">  
                   <!--<button type="button" style="background:#F7921E" class="btn btn-lg btn-block  btn-custom" data-toggle="modal" data-target="#exampleModal">Book Now</button> -->
                   <button type="button" style="background:#F7921E" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#exampleModal">Book Now</button>
                   </div>
                 </div>
               </div>
               
               <!--<div class="team-item">
               <div class="princing-item red">
                   <div class="pricing-divider">
                     <h3 class="text-light">Water Park + Park Ride</h3>
                     <p class="text-light font-weight-normal" data-toggle="tooltip" title="Water Park + Rides (5D Show, Striking Car, Booting, Bees Round, Gaming Zone, Jumping House & Water Horse Train for Child)">* Condition Apply</p>
                     <h4 class="my-0 display-4 text-light font-weight-normal"><span class="h3">₹</span> 500 <span class="h5">/per person</span></h4>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">
                     <button type="button" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#parkcomboModal">Book Now</button>
                     <button type="button" class="btn btn-lg btn-block btn-custom" data-toggle="#" data-target="#">Book Now</button>
                   </div>
                 </div>
               </div>-->
               
              
               
               <div class="team-item">
               <div class="princing-item orange">
                   <div class="pricing-divider">
                     <h3 class="text-light">Full Package</h3>
                     <p class="text-light font-weight-normal" data-toggle="tooltip" title="Entry Ticket + Rides (5D Show, Striking Car, Booting, Bees Round, Gaming Zone, Jumping House & Water Horse Train for Child)">* Condition Apply</p>
                     <h4 class="my-0 display-4 text-light font-weight-normal"><span class="h3">₹</span> 250 <span class="h5">/per person</span></h4>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">
                     <!--<button type="button" style="background:#F7921E" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#fullpackageModal">Book Now</button>-->
                     <button type="button" style="background:#F7921E" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#fullpackageModal">Book Now</button>
                   </div>
                 </div>
               </div>
               
         
               
               <div class="team-item">
               <div class="princing-item green">
                   <div class="pricing-divider">
                     <h3 class="text-light">Restaurant Booking</h3>
                     <p class="text-light font-weight-normal" data-toggle="tooltip" title="The deposit amount will be adjusted from the food bill.">* Condition Apply</p>
                     <h4 class="my-0 display-4 text-light font-weight-normal"><span class="h3">₹</span> 1000 <span class="h5"></span></h4>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">
                     <!--<button type="button" style="background:#1AA85C; color:#fff;" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#resturantModal">Book Now</button>-->
                     <button type="button" style="background:#1AA85C; color:#fff;" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#resturantModal">Book Now</button>
                   </div>
                 </div>
               </div>
               
               <div class="team-item">
               <div class="princing-item green">
                   <div class="pricing-divider">
                     <h3 class="text-light">Picnic Spot Booking</h3>
                     <p class="text-light font-weight-normal" data-toggle="tooltip" title="21 picnic spot available for booking, booking amount is not including Entry Fees to the park.">* Condition Apply</p>
                     <h4 class="my-0 display-4 text-light font-weight-normal"><span class="h3">₹</span> 1500 <span class="h5"></span></h4>
                   </div>
                   <div class="card-body bg-white mt-0 shadow">
                     <!--<button type="button" style="background:#1AA85C; color:#fff;" id="bookpicbtn" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#picnicspotbookingModal">Book Now</button>-->
                     <button type="button" style="background:#1AA85C; color:#fff;" id="bookpicbtn" class="btn btn-lg btn-block btn-custom" data-toggle="modal" data-target="#picnicspotbookingModal">Book Now</button>
                   </div>
                 </div>
               </div>
               
               
               
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
                
               <!--Dry Park Rides Added-->
                
                <!--team item start -->
                 <!--amit-->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/frisbee.jpg" alt="" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/#">
                     <h4 class="title"><strong>Frisbee</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/1.png" alt="" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/jumping-house">
                     <h4 class="title">Jumping <strong>House</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <!--team item end --> 
                
                 
                 <!--team item start -->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/wat1.jpg" alt="" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/jumping-house">
                     <h4 class="title">Water <strong>World</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/1.png" alt="" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/jumping-house">
                     <h4 class="title">Jumping <strong>House</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <!--team item end --> 
                 
                 <!--team item start -->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/2.png" alt="" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/children-pool">
                     <h4 class="title">Children <strong>Pool</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <!--team item end --> 
                 
                 <!--team item start -->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/3.png" alt="" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/striking-car">
                     <h4 class="title">Striking <strong>Car</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <!--team item end --> 
                 
                 <!--team item start -->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/4.jpg" alt="" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/children-boating">
                     <h4 class="title">Children <strong>Boating</strong></h4>
                     </a>
                     <p>With every bounce there is a whole new experience waiting for your little ones. Put some bounce into your kid’s routine with this enormous, inflatable, exciting experience.</p>
                   </div>
                 </div>
                 
                 <!--team item end --> 
                 
                 <!--team item start -->
                 
                 <div class="team-item">
                   <div class="team-overlay">
                     <div class="team-img"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/team/rides-bee.png" alt="" /> </div>
                   </div>
                   <div class="team-info"> <a href="<?php echo  Yii::$app->request->baseUrl;?>/happy-bees">
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
           
           <!--<section id="rs-portfolio2" class="rs-portfolio2 defutl-style" style="background:url(<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/ex-bg.png); background-repeat:no-repeat; background-size:cover; padding-bottom:50px;">
             <div class="container">
               <div class="service-title text-center wow fadeInDown" style="padding-top:70px;">
                 <h3 class="text-center"><span style="color:#555555; background:#fff; border:1px solid #ccc">Your Happy Valley <strong>Experience</strong> </span></h3>
               </div>
               <div class="container-fluid">
                 <div class="row">
                   <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/res.jpg">
                     <h5 style="padding:10px 8px; color:#fff; background:rgba(190,21,28,0.8); position: absolute;left: 0;bottom: 0;right: 0; margin: 0 15px;"><a style="color:#fff;" href="<?php echo  Yii::$app->request->baseUrl;?>/restaurant">Restaurant</a></h5>
                   </div>
                   <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".4s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/banquet.png">
                     <h5 style="padding:10px 8px; color:#fff; background:rgba(186,9,193,0.8); position: absolute;left: 0;bottom: 0;right: 0; margin: 0 15px;"><a style="color:#fff;" href="<?php echo  Yii::$app->request->baseUrl;?>/picnic-spots">Banquet</a></h5>
                   </div>
                   <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".6s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/pic.jpg">
                     <h5 style="padding:10px 8px; color:#fff; background:rgba(40,150,14,0.8); position: absolute;left: 0;bottom:0;right: 0; margin: 0 15px;"><a style="color:#fff;" href="<?php echo  Yii::$app->request->baseUrl;?>/theatre">Picnic Spot</a></h5>
                   </div>
                   <div style="position:relative; margin-bottom:30px;" class="col-md-6 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".8s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/5d.jpg">
                     <h5 style="padding:10px 8px; color:#fff; background:rgba(9,94,160,0.8); position: absolute;left: 0;bottom: 0;right: 0; margin: 0 15px;">5D Theatre</h5>
                   </div>
                 </div>
               </div>
             </div>
           </section>-->
           
           <!-- Portfolio End -->
           
           <div id="rs-team2" class="sec-spacer sec-color" style="background:url(<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/rides1.png);  background-repeat:no-repeat; background-size:cover; ">
             <div class="container">
                <div class="service-title text-center wow fadeInDown" style="padding-bottom:30px;">
                 <h3 class="text-center"><span>Events</span></h3>
               </div>
               <div class="container-fluid">
                 <div class="row wow fadeInUp" data-wow-duration="1s">
                     
                     <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="false" data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false" data-nav="false" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true" data-mobile-device-dots="false" data-ipad-device="3" data-ipad-device-nav="true" data-ipad-device-dots="false" data-ipad-device2="2" data-ipad-device-nav2="true" data-ipad-device-dots2="false" data-md-device="2" data-md-device-nav="true" data-md-device-dots="false">
                     
                   <div class="team-item">
                     <div class="card mb-4" style="-webkit-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75); -moz-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75); box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);"> <img class="card-img-top" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/ban.png" alt="Card image cap">
                       <div class="card-body text-center">
                         <h4 class="title">Inauguration of Dream Banquet Hall at Happy Valley Park</h4>
                         <p class="card-text">Happy Valley Park is one of the best family parks in West Bengal. You can visit here with your family and friends. All kind of amazement and fun you can get here.</p>
                    </div>
                     </div>
                   </div>
                   <div class="team-item">
                     <div class="card mb-4" style="-webkit-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75); -moz-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75); box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);"> <img class="card-img-top" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/ev1.jpg" alt="Card image cap">
                       <div class="card-body text-center">
                         <h4 class="title">Inauguration of Dream Banquet Hall at Happy Valley Park</h4>
                         <p class="card-text">Happy Valley Park is one of the best family parks in West Bengal. You can visit here with your family and friends. All kind of amazement and fun you can get here.</p>
                        </div>
                     </div>
                   </div>
                   <div class="team-item">
                     <div class="card mb-4" style="-webkit-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75); -moz-box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75); box-shadow: 10px 9px 6px -8px rgba(0,0,0,0.75);"> <img class="card-img-top" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/ev2.jpg" alt="Card image cap">
                       <div class="card-body text-center">
                         <h4 class="title">Inauguration of Dream Banquet Hall at Happy Valley Park</h4>
                         <p class="card-text">Happy Valley Park is one of the best family parks in West Bengal. You can visit here with your family and friends. All kind of amazement and fun you can get here.</p>
                        </div>
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
                     <h4 style="color:#BE151C; font-size:36px;"><span class="exp_heading">Experience</span> <br>
                       5D with Us</h4>
                     <p>Happy Valley Park presents to you the state-of-the-art theatre that takes you on a thrilling journey
                       
                       engaging all yours senses in a way that you have never imagined. Synchronized spectrum of visual
                       
                       effects, sophisticated motion ride system, special live environmental effects and high end surround
                       
                       sound systems generate a highly realistic experience .Immerse yourself in the movie magic instead
                       
                       of just watching them!</p>
                     <a href="<?php echo  Yii::$app->request->baseUrl;?>/theatre" style="background:#A72BC9; padding: 6px 50px;; color:#fff; border-radius:0;"  class="btn">Read More</a> </div>
                 </div>
               </div>
               <div class="col-md-5"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/maxresdefault.jpg"> </div>
             </div>
           </section>
           
           <!-- Portfolio End -->
           
           <!--<section id="rs-pricing" class="rs-pricing gray-color">
             <div class="container">
               <div class="row">
                 <div class="doted-box" style="width:100%; text-align:center"> Banquet Halls for Weddings, Anniversaries, Birthday is available. Book now and avail best prices.  </div>

<div class="doted-box1" style="width:100%; text-align:center"> 
 Its Picnic time enjoy at Happy Valley Park. Contact us for booking. 
 </div>

<div class="doted-box2" style="width:100%; text-align:center"> 
Come here with your friends & family and enjoy the best quality food & beverages at Happy Vally Park.</div>

               </div>
             </div>
           </section>-->
           <div id="rs-team3" class="rs-contact">
             <div class="service-title text-center wow fadeInDown" style="padding-top:70px;">
               <h3 class="text-center"><span style="color:#555555; background:#fff; border:1px solid #ccc">Water <strong>World</strong></span></h3>
             </div>
             <div class="row">
               <!--<div style="position:relative; padding:0;" class="col-md-6 wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/christmas.png">
                 <h5 class="news_heading">MERRY CHRISTMAS
                   <p>Enjoy your christmas with us!</p>
                 </h5>
               </div>-->
               <div style="position:relative; padding:0;" class="col-md-12 wow fadeInRight" data-wow-duration="1.5s" data-wow-delay=".4s"> <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/bg/rail.jpg">
                 <h5 class="news_heading">WATER WORLD<br>
                 <!--<a type="button" style="color:#F7921E; font-size:18px; cursor:pointer" data-toggle="modal" data-target="#waterworldModal">Book Now<i class="fa fa-arrow-right"></i></a></h5>-->
                 
               </div>
             </div>
           </div>
         </div>

         <!-- Model Starts Here -->

         <!--<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">
           <div class="modal-dialog modal-lg">
             <div class="modal-content">
               <div class="modal-body">
                 <button type="button" class="close cross" data-dismiss="modal"><img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/cross.png" alt=""></button>
                 <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/offer1.jpg" alt=""> </div>
             </div>
           </div>
         </div>-->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelw" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
              <?php $form = ActiveForm::begin(['action' =>['enquiry/add-enquiry'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabelw">Send Enquiry For Banquet</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                   <div class="form-group">
                     <input type="text" name="Enquiry[name]" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" name="Enquiry[email]" class="form-control" placeholder="Email" required>
                   </div>
                   <div class="form-group">
                     <input type="number" name="Enquiry[phone]" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group">
                     <input type="number" name="Enquiry[no_of_people]" class="form-control" min="1" placeholder="No of People" required>
                   </div>
                   <div class="form-group data_1" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control" autocomplete="off" placeholder="From Date" id="date1" name="Enquiry[from_date]" required>
                      </div>
                   </div>
                   <div class="form-group data_1" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control" autocomplete="off" placeholder="To Date" id="date" name="Enquiry[to_date]" required>
                      </div>
                   </div> 
                   <div class="form-group">
                      <input type="text" value="Banquet" class="form-control" readonly>
                      <input type="hidden" name="Enquiry[product]" value="2">
                   </div>
                   <div class="form-group">
                     <div class="controls">
                         <div id="recaptcha1"></div>
                     </div>
                   </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" title="On Submit, Your Enquiry Will Be Posted And You Will Be Redirected To Home.">Submit</button>
                  </div> 
              <?php ActiveForm::end(); ?>
             </div>
           </div>
         </div>
         <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
              <?php $form = ActiveForm::begin(['action' =>['enquiry/add-enquiry'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Send Enquiry For Picnic Spot</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                   <div class="form-group">
                     <input type="text" name="Enquiry[name]" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" name="Enquiry[email]" class="form-control" placeholder="Email" required>
                   </div>
                   <div class="form-group">
                     <input type="number" name="Enquiry[phone]" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group">
                     <input type="number" name="Enquiry[no_of_spots]" class="form-control" min="1" placeholder="No of Spot" required>
                   </div>
                   <div class="form-group data_1" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control" autocomplete="off" placeholder="Date" id="date" name="Enquiry[from_date]" required>
                      </div>
                   </div>
                   <div class="form-group">
                     <input type="text" value="Picnic Spot" class="form-control" readonly>
                      <input type="hidden" name="Enquiry[product]" value="3">
                   </div>
                   <div class="form-group">
                     <div class="controls">
                         <div id="recaptcha2"></div>
                     </div>
                   </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" title="On Submit, Your Enquiry Will Be Posted And You Will Be Redirected To Home.">Submit</button>
                  </div>
              <?php ActiveForm::end(); ?>
             </div>
           </div>
         </div>
         <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
              <?php $form = ActiveForm::begin(['action' =>['enquiry/add-enquiry'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabe2">Send Enquiry For Restaurant</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                   <div class="form-group">
                     <input type="text" name="Enquiry[name]" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" name="Enquiry[email]" class="form-control" placeholder="Email" required>
                   </div>
                   <div class="form-group">
                     <input type="number" name="Enquiry[phone]" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group">
                     <input type="number" name="Enquiry[no_of_people]" class="form-control" min="1" placeholder="No of People" required>
                   </div>
                   <div class="form-group data_1" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control" autocomplete="off" placeholder="Date" id="date" autocomplete="off" name="Enquiry[from_date]" required>
                      </div>
                   </div>
                   <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" autocomplete="off" class="form-control timepicker" placeholder="Time" name="Enquiry[time]"
                           id="time" maxlength="200" aria-required="true"
                           aria-invalid="true">
                        </div>
                    </div>
                   <div class="form-group">
                     <input type="text" value="Restaurant" class="form-control" readonly>
                      <input type="hidden" name="Enquiry[product]" value="1">
                   </div>
                   <div class="form-group">
                     <div class="controls">
                         <div id="recaptcha3"></div>
                     </div>
                   </div>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" title="On Submit, Your Enquiry Will Be Posted And You Will Be Redirected To Home.">Submit</button>
                   </div>
              <?php ActiveForm::end(); ?>
             </div>
           </div>
         </div>
        
        <div class="modal fade ticketModal" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
					<div class="modal-content modal-center">
 <?php $form = ActiveForm::begin(['action' =>['booking/add-tickets'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal','id'=>"booking-form"]]); ?>
						<div class="modal-header d-block border-0 pb-0">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h5 class="modal-title" id="exampleModalLabe2">Book Tickets</h5>							
						</div>
						<div class="modal-body">
							<div class="row">								
								<div class="col-lg-6">
									<div class="form-group">
										<input type="text" name="Booking[name]" class="form-control" placeholder="Name" required>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input type="email" name="Booking[email]" class="form-control" placeholder="Email">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input type="number" name="Booking[phone]" class="form-control" placeholder="Phone" required>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group data_1" id="">
										<div class="input-group date">
											<span class="input-group-addon"></span>
											<input type="text" class="form-control" autocomplete="off" placeholder="Date" id="date" autocomplete="off" name="Booking[date]" required>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input type="number" id="people2" name="Booking[no_of_units]" class="form-control" min="1" placeholder="No of People" required>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<input type="number" id="amount" class="form-control" placeholder="Amount" readonly>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<input type="text" value="Ticket" class="form-control" readonly>
										<input type="hidden" id="amt" name="Booking[amount]" value="" class="form-control" readonly>
										<input type="hidden" id="productid" name="Booking[product]" value="4" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer  justify-content-center border-0 pt-0">
							<button type="submit" class="btn btn-primary" title="On Submit, Your Ticket Will Be Booked And You Will Receive An Email For The Same.">Submit</button>

						</div>
						<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
        <!-- Model For Ticket Booking -->
          <div class="modal fade" id="ticketModal2" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
              <?php $form = ActiveForm::begin(['action' =>['booking/add-tickets'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabe2">Book Tickets</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                   <div class="form-group">
                     <input type="text" name="Booking[name]" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                    <input type="number" name="Booking[phone]" class="form-control" placeholder="Phone" required="">
                   </div>
                   <div class="form-group">
                     <input type="number" name="Booking[phone]" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group data_1" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control" autocomplete="off" placeholder="Date" id="date" autocomplete="off" name="Booking[date]" required>
                      </div>
                   </div>
                   <div class="form-group">
                     <input type="number" id="people2" name="Booking[no_of_units]" class="form-control" min="1" placeholder="No of People" required>
                   </div>
                   <div class="form-group">
                     <input type="number" id="amount" class="form-control" placeholder="Amount" readonly>
                   </div>
                   <div class="form-group">
                     <input type="text" value="Ticket" class="form-control" readonly>
                     <input type="hidden" id="amt" name="Booking[amount]" value="" class="form-control" readonly>
                     <input type="hidden" id="productid" name="Booking[product]" value="4" class="form-control">
                   </div>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" title="On Submit, Your Ticket Will Be Booked And You Will Receive An Email For The Same.">Submit
                     </button>
                   </div>
              <?php ActiveForm::end(); ?>
             </div>
           </div>
         </div>

        
         <!-- Water Park + Park Ride -->
         <div class="modal fade" id="parkcomboModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
              <?php $form = ActiveForm::begin(['action' =>['booking/addpark-combo'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabe2">Book Water Park + Park Ride</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                   <div class="form-group">
                     <input type="text" name="Booking[name]" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" name="Booking[email]" class="form-control" placeholder="Email" >
                   </div>
                   <div class="form-group">
                     <input type="number" name="Booking[phone]" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group data_1" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control" autocomplete="off" placeholder="Date" id="date_waterpark" autocomplete="off" name="Booking[date]" required>
                      </div>
                   </div>
                   <div class="form-group">
                     <input type="number" id="people4" name="Booking[no_of_units]" class="form-control" min="1" placeholder="No of People" required>
                   </div>
                   <div class="form-group">
                     <input type="number" id="amount1" class="form-control" placeholder="Amount" readonly>
                   </div>
                   <div class="form-group">
                     <input type="text" value="Book Water Park + Park Ride" class="form-control" readonly>
                     <input type="hidden" id="amt1" name="Booking[amount]" value="" class="form-control" readonly>
                     <input type="hidden" id="productid2" name="Booking[product]" value="5" class="form-control">
                   </div>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" title="On Submit, Your Ticket Will Be Booked And You Will Receive An Email For The Same.">Submit
                     </button>
                   </div>
              <?php ActiveForm::end(); ?>
             </div>
           </div>
         </div>
         <!-- Water Park + Park Ride -->

         <!-- 5D -->
         <div class="modal fade ticketModal" id="fiveDModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
              <?php $form = ActiveForm::begin(['action' =>['booking/fived-booking'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal','id'=>"fived-form"]]); ?>
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabe2">Book 5D Ticket</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">

               <div class="row">								
								<div class="col-lg-6">
                <div class="form-group">
                     <input type="text" name="Booking[name]" class="form-control" placeholder="Name" required>
                   </div>
                </div>
                <div class="col-lg-6">
                <div class="form-group">
                     <input type="email" name="Booking[email]" class="form-control" placeholder="Email" >
                   </div>
                </div>
                <div class="col-lg-6">
                <div class="form-group">
                     <input type="number" name="Booking[phone]" class="form-control" placeholder="Phone" required>
                   </div>
                </div>
                <div class="col-lg-6">
                   
                <div class="form-group data_2" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control" autocomplete="off" placeholder="Date" id="date" autocomplete="off" name="Booking[date]" required>
                      </div>
                   </div>
                </div>
                <div class="col-lg-6">
                <div class="form-group">
                     <input type="number" id="people6" name="Booking[no_of_units]" class="form-control" min="1" placeholder="No of People" required>
                   </div>
                </div>
                <div class="col-lg-6">
                  
                <div class="form-group">
                     <input type="number" id="amount2" class="form-control" placeholder="Amount" readonly>
                   </div>
                </div>

                <div class="col-lg-6">
                <div class="form-group">
                     <input type="text" value="Book 5D Ticket" class="form-control" readonly>
                     <input type="hidden" id="amt2" name="Booking[amount]" value="" class="form-control" readonly>
                     <input type="hidden" id="productid3" name="Booking[product]" value="6" class="form-control">
                   </div>
                   </div>
                </div>
</div>
                   
                  
                  
                 
                 
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" title="On Submit, Your Ticket Will Be Booked And You Will Receive An Email For The Same.">Submit
                     </button>
                   </div>
              <?php ActiveForm::end(); ?>
             </div>
           </div>
         </div>
         <!-- 5D -->
         <!-- Full Package -->
         <div class="modal fade" id="fullpackageModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
              <?php $form = ActiveForm::begin(['action' =>['booking/full-package'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabe2">Book Full Package</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                   <div class="form-group">
                     <input type="text" name="Booking[name]" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" name="Booking[email]" class="form-control" placeholder="Email" >
                   </div>
                   <div class="form-group">
                     <input type="number" name="Booking[phone]" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group data_1" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control" autocomplete="off" placeholder="Date" id="date" autocomplete="off" name="Booking[date]" required>
                      </div>
                   </div>
                   <div class="form-group">
                     <input type="number" id="people8" name="Booking[no_of_units]" class="form-control" min="1" placeholder="No of People" required>
                   </div>
                   <div class="form-group">
                     <input type="number" id="amount3" class="form-control" placeholder="Amount" readonly>
                   </div>
                   <div class="form-group">
                     <input type="text" value="Book Full Package" class="form-control" readonly>
                     <input type="hidden" id="amt3" name="Booking[amount]" value="" class="form-control" readonly>
                     <input type="hidden" id="productid4" name="Booking[product]" value="7" class="form-control">
                   </div>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" title="On Submit, Your Ticket Will Be Booked And You Will Receive An Email For The Same.">Submit
                     </button>
                   </div>
              <?php ActiveForm::end(); ?>
             </div>
           </div>
         </div>
         <!-- Full Package -->
         <!-- Water World-->
         <div class="modal fade ticketModal" id="waterworldModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
              <?php $form = ActiveForm::begin(['action' =>['booking/water-world'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal','id'=>"waterworld-form"]]); ?>
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabe2">Book Water World Ticket</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                   <div class="form-group">
                     <input type="text" name="Booking[name]" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" name="Booking[email]" class="form-control" placeholder="Email" >
                   </div>
                   <div class="form-group">
                     <input type="tel" name="Booking[phone]" class="form-control" placeholder="Phone" maxlength="10" pattern="\d{10}" title="Please enter a 10-digit mobile number"
                     required />
                   </div>
                   <div class="form-group data_3" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control" autocomplete="off" placeholder="Date" id="date" autocomplete="off" name="Booking[date]" required>
                      </div>
                   </div>
                   <div class="form-group">
                     <input type="number" id="people11" name="Booking[belowtenyears]" class="form-control" min="1" placeholder="No of People Below 10 Years">
                   </div>
                   <div class="form-group">
                     <input type="number" id="people12" name="Booking[abovetenyears]" class="form-control" min="1" placeholder="No of People Above 10 Years" required>
                   </div>
                   <div class="form-group">
                     <input type="number" id="amount4" class="form-control" placeholder="Amount" readonly>
                   </div>
                   <div class="form-group">
                     <input type="text" value="Book Water World Ticket" class="form-control" readonly>
                     <input type="hidden" id="amt4" name="Booking[amount]" value="" class="form-control" readonly>
                     <input type="hidden" id="productid5" name="Booking[product]" value="8" class="form-control">
                   </div>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" title="On Submit, Your Ticket Will Be Booked And You Will Receive An Email For The Same.">Submit
                     </button>
                   </div>
              <?php ActiveForm::end(); ?>
             </div>
           </div>
         </div>
         <!-- Water World-->
         <!-- Resturant Booking-->
         <div class="modal fade" id="resturantModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
              <?php $form = ActiveForm::begin(['action' =>['booking/resturant-booking'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabe2">Resturant Booking</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                   <div class="form-group">
                     <input type="text" name="Booking[name]" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" name="Booking[email]" class="form-control" placeholder="Email">
                   </div>
                   <div class="form-group">
                     <input type="number" name="Booking[phone]" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group data_1" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control" autocomplete="off" placeholder="Date" id="date" autocomplete="off" name="Booking[date]" required>
                      </div>
                   </div>
                   <div class="form-group">
                     <input type="number" id="people14" name="Booking[no_of_units]" class="form-control" min="1" placeholder="No of People" required>
                   </div>
                   <div class="form-group">
                     <input type="number" id="amount5" class="form-control" placeholder="Amount" readonly>
                   </div>
                   <div class="form-group">
                     <input type="text" value="Book Resturant" class="form-control" readonly>
                     <input type="hidden" id="amt5" name="Booking[amount]" value="" class="form-control" readonly>
                     <input type="hidden" id="productid6" name="Booking[product]" value="1" class="form-control">
                   </div>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" title="On Submit, Your Ticket Will Be Booked And You Will Receive An Email For The Same.">Submit
                     </button>
                   </div>
              <?php ActiveForm::end(); ?>
             </div>
           </div>
         </div>
         <!-- Resturant Booking-->
         <!-- Picnic Spot Booking-->
         <div class="modal fade" id="picnicspotbookingModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
             <div class="modal-content">
              <?php $form = ActiveForm::begin(['action' =>['booking/picnicspot-booking'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabe2">Picnic Spot Booking</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                   <div class="form-group">
                     <input type="text" name="Booking[name]" class="form-control" placeholder="Name" required>
                   </div>
                   <div class="form-group">
                     <input type="email" name="Booking[email]" class="form-control" placeholder="Email" >
                   </div>
                   <div class="form-group">
                     <input type="number" name="Booking[phone]" class="form-control" placeholder="Phone" required>
                   </div>
                   <div class="form-group data_1" id="">
                      <div class="input-group date">
                          <span class="input-group-addon"></span>
                          <input type="text" class="form-control picnicdate" autocomplete="off" placeholder="Date" id="date" autocomplete="off" name="Booking[date]" required>
                      </div>
                   </div>
                   <div class="form-group">
                     <input type="number" id="maxspot" name="Booking[no_of_units]" class="form-control" min="1" placeholder="No of Spot" required>
                   </div>
                   <div class="form-group">
                     <input type="number" id="amount6" class="form-control" placeholder="Amount">
                   </div>
                   <div class="form-group">
                     <input type="text" value="Picnic Spot Booking" class="form-control" readonly>
                     <input type="hidden" id="amt6" name="Booking[amount]" value="" class="form-control" readonly>
                     <input type="hidden" id="productid6" name="Booking[product]" value="3" class="form-control">
                   </div>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" id="spotSubmit" title="On Submit, Your Ticket Will Be Booked And You Will Receive An Email For The Same.">Submit
                     </button>
                   </div>
              <?php ActiveForm::end(); ?>
             </div>
           </div>
         </div>
         <!-- Picnic Spot Booking-->
         <!-- Model Ends Here -->
         <!-- Include Razorpay JS library -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

document.getElementById('fived-form').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('<?= \Yii\helpers\Url::to(['booking/fived-booking']) ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {

      console.log('data');
        if(data.success) {
            // Initialize Razorpay checkout
            $('#fiveDModal').modal('hide');
            var options = {
                "key": "rzp_live_JnKcmAb28MNsO6",
                "amount": data.amount * 100, // Amount in paise
                "currency": data.currency,
                "order_id": data.order_id,
                "name": "gohappyvalley",
                "description": "Five D show Ticket",
                "handler": function (response){
                    // Handle successful payment
                    
                    console.log('Payment successful!');
                    console.log(response);
                    // Make AJAX request to update payment status in your server
                    updatePaymentStatus(response.razorpay_payment_id,data.data.id);

                    // Redirect to confirm booking page or do any necessary actions
                },
                "prefill": {
                    // Prefill customer details if available
                    "name": data.data.name,
                    "email": data.data.email,
                    "contact": data.data.phone
                },
                "theme": {
                    "color": "#F37254"
                }
            };
            var razorpay = new Razorpay(options);
            razorpay.on('payment.error', function(resp){
                console.log(resp.error);

                alert(resp.error);
                // Handle payment errors
            });
            razorpay.open();
        } else {
            alert('Failed to add tickets. Please try again later.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle errors
    });
});



document.getElementById('waterworld-form').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('<?= \Yii\helpers\Url::to(['booking/water-world']) ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {

      console.log('data');
        if(data.success) {
            
        $('#waterworldModal').modal('hide');

            // Initialize Razorpay checkout
            var options = {
                "key": "rzp_live_JnKcmAb28MNsO6",
                "amount": data.amount * 100, // Amount in paise
                "currency": data.currency,
                "order_id": data.order_id,
                "name": "gohappyvalley",
                "description": "Waterworld Ticket",
                "handler": function (response){
                    // Handle successful payment
                    
                    console.log('Payment successful!');
                    console.log(response);
                    // Make AJAX request to update payment status in your server
                    updatePaymentStatus(response.razorpay_payment_id,data.data.id);

                    // Redirect to confirm booking page or do any necessary actions
                },
                "prefill": {
                    // Prefill customer details if available
                    "name": data.data.name,
                    "email": data.data.email,
                    "contact": data.data.phone
                },
                "theme": {
                    "color": "#F37254"
                }
            };
            var razorpay = new Razorpay(options);
            razorpay.on('payment.error', function(resp){
                console.log(resp.error);

                alert(resp.error);
                // Handle payment errors
            });
            razorpay.open();
        } else {
            alert('Failed to add tickets. Please try again later.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle errors
    });
});






document.getElementById('booking-form').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('<?= \Yii\helpers\Url::to(['booking/add-tickets']) ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {

      console.log('data');
        if(data.success) {
            // Initialize Razorpay checkout
            $('#ticketModal').modal('hide');
            var options = {
                "key": "rzp_live_JnKcmAb28MNsO6",
                "amount": data.amount * 100, // Amount in paise
                "currency": data.currency,
                "order_id": data.order_id,
                "name": "gohappyvalley",
                "description": "Booking Ticket",
                "handler": function (response){
                    // Handle successful payment
                    
                    console.log('Payment successful!');
                    console.log(response);
                    // Make AJAX request to update payment status in your server
                    updatePaymentStatus(response.razorpay_payment_id,data.data.id);

                    // Redirect to confirm booking page or do any necessary actions
                },
                "prefill": {
                    // Prefill customer details if available
                    "name": data.data.name,
                    "email": data.data.email,
                    "contact": data.data.phone
                },
                "theme": {
                    "color": "#F37254"
                }
            };
            var razorpay = new Razorpay(options);
            razorpay.on('payment.error', function(resp){
                console.log(resp.error);

                alert(resp.error);
                // Handle payment errors
            });
            razorpay.open();
        } else {
            alert('Failed to add tickets. Please try again later.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle errors
    });
});





function updatePaymentStatus(paymentId,bookingId) {
    // Make AJAX request to update payment status
    fetch('<?= \Yii\helpers\Url::to(['booking/update-status']) ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            payment_id: paymentId,
            booking_id:bookingId
        }),
    })
    .then(response => {

        console.log(response);
        if (response.ok) {
            console.log('Payment status updated successfully!');
            // Redirect to confirmation page or perform other actions
        
            window.location.href = '<?= \Yii\helpers\Url::to(['booking/order-success']) ?>' + '?booking_id=' + bookingId;
        } else {
            console.error('Failed to update payment status:', response.statusText);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle errors
    });
}
</script>


         