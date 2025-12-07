<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $session = Yii::$app->session;
 ?>
		<!-- Main content Start -->
        <div class="main-content">
            <section id="rs-contact" class="rs-contact contact-section gray-color pb-100">
                <!-- About Icon Start -->
                <div id="rs-about-icon" class="rs-about-icon pt-100 pb-80">
                    <div class="container">
                        <div class="icon-section">
                            <div class="single-icon">
                                <div class="icon-part">
                                    <a href="#"><i class="fa fa-phone"></i></a>
                                </div>
                                <div class="icon-text">
                                    <h3 class="icon-title">Call Us</h3>
                                    <a class="icon-info" href="tel:8820102846">8820102846</a><br>
                                    <a class="icon-info" href="tel:7029609594">7029609594</a><br>
                                    <a class="icon-info" href="tel:03216261116">03216261116</a><br>
                                    <a class="icon-info" href="tel:08069640279">08069640279</a>
                                </div>
                            </div>
                            <div class="single-icon">
                                <div class="icon-part">
                                    <a href="#"><i class="fa fa-envelope-o"></i></a>
                                </div>
                                <div class="icon-text">
                                    <h3 class="icon-title">Mail Us</h3>
                                    <a class="icon-info" href="mailto:support@gohappyvalley.com">support@gohappyvalley.com</a>
                                </div>
                            </div>
                            <!--<div class="single-icon">
                                <div class="icon-part">
                                    <a href="#"><i class="fa fa-fax"></i></a>
                                </div>
                                <div class="icon-text">
                                    <h3 class="icon-title">Fax</h3>
                                    <p>+91 92120-06464</p>
                                </div>
                            </div>-->
                            <div class="single-icon margin-0">
                                <div class="icon-part">
                                    <a href="#"><i class="fa fa-map-marker"></i></a>
                                </div>
                                <div class="icon-text after-none">
                                    <h3 class="icon-title">Address</h3>
                                    <p>Bira More, Barasat </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- About Icon End -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-form">
                                <?php if (isset($session['msg']) || $session['msg']!='') {
                                ?>
                                <div class="alert alert-success text-center">Successfully contacted, we will reach to you soon !</div>
                                <?php 
                                $session['msg'] = '';
                                unset($session['msg']);
                                } ?>
                                <div id="form-messages"></div>
                                <?php $form = ActiveForm::begin(['action' =>['contacts/add-contact'],'options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-field">
                                                <input type="text" placeholder="Name" id="name" name="Contacts[name]" required>
                                            </div>                              
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-field">
                                                <input type="email" placeholder="Email" id="email" name="Contacts[email]" required>
                                            </div>                              
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-field">
                                                <input type="text" placeholder="Phone Number" id="phone_number" name="Contacts[phone]" required>
                                            </div>                             
                                        </div>
                                    </div>                        
                                    <div class="form-field">
                                        <textarea placeholder="Your Message Here" rows="7" id="message" name="Contacts[message]" required></textarea>
                                    </div>
                                    <div class="form-field">
                                      <div class="controls">
                                          <div id="recaptcha1"></div>
                                      </div>
                                    </div>
                                    <div class="form-button">
                                        <button type="submit" class="readon">Submit Now</button>
                                    </div>
                                <?php ActiveForm::end(); ?>
                            </div> 
                        </div>            
                    </div>
                </div>
            </section>
            <!-- Contact End -->

            <!-- Map Section Start -->
            <section id="rs-map" class="rs-map">
                <iframe id="googleMap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3678.761833826008!2d88.59096131490037!3d22.77421828507947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x23a7e7a2ea394fc8!2sHappy+Valley+Park!5e0!3m2!1sen!2sin!4v1542858657474" frameborder="0" style="border:0" allowfullscreen></iframe>
            </section>
            <!-- Map Section End -->              
        </div>