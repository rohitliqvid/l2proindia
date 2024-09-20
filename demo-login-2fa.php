<?php 
session_start();
include_once 'header/frontHeader.php'; 

$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
$is_otp_varifid = isset($_SESSION['is_otp_varifid']) ? $_SESSION['is_otp_varifid'] : 0;
?>

<script src='https://www.google.com/recaptcha/api.js'></script>


<div class="top-container" id="home">
        <div class="container">
            <div class="row">
                <div class="top-column-left">
                    <ul class="contact-line">
                        <li><i class="fa fa-envelope"></i> info@yourdomain.com</li>
                        <li><i class="fa fa-phone"></i> (0021)-123-456-789-90</li>
                    </ul>
                </div>
                <div class="top-column-right" style="display:flex;">
                <div style="text-align:right;margin-right:25px;" ><a href="demo-index.php#social">Signin / Signup</a></div>
                    <div class="top-social-network">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Navigation --> 
      <!--	start login-->
      
            <section id="contentLogin" class="content container m-t-lg wrapper-md make-center full-width">
                
                <form id="login-form" class="two-factor" name="login-form" action="login-2fa-verify.php"
                    method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off">


                    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                        <section class="">
                            <div class="dart-headingstyle" style="margin-bottom:0">
                                <h1 class="dart-heading" style="padding:0 18px "> 2 Way Authentication </h1>
                                <p style="padding:0 18px" class="dart-body">We have sent an OTP to you registered email address. Please verify that below here
                                    </br>
                                </p>
                            </div>
                            <div class="panel-body loginDiv">
                                <label class="control-label" for="otp">OTP <span style="color:red;">*</span></label>
                                </br>
                                <div class="form-group" style="display: flex;align-items: center;justify-content: center;">
                                    <input class="form-control" name="otp" id="otp" type="text" data-required="true" value="<?php echo $is_otp_varifid == 1 ? $_SESSION['login_otp']:'' ?>" autocomplete="off" />  
                                    
                                    <span style="right: 18px;position: relative;">
                                        <?php if ($is_otp_varifid == 1) {  ?>
                                            <i class="fa fa-check" aria-hidden="true"></i> 
                                        <?php }else {  ?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        <?php }  ?>
                                    </span>
                                </div>
                                <br>
                                <div class="g-recaptcha" data-sitekey="6LeDnyghAAAAAAF9pj-pO9Kx2bTwHMSZHz8NOl2r">
                                </div>
                                <br>
                                <label class="required" id="lblLoginErr">
                                    <?php echo $error_message?>
                                </label>
                                <div>
                                <button id="log-in" class="btn button-default" type="submit" name="yt0" value="Sign in" style="margin-top:0">Verify</button>
                                </button>
                                <div class="clear"></div>
                                <div style="margin-top:10px;">
                               
                                <a href="demo-index.php#social" class="  m-t-xs fpassword back" style="font-size:16px">
                                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back to Login
                                    </a>
                                </div>
                                
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padd0">
                        <section class="">

                            <div class=" text-center ">
                                <div class="videoDiv">
                                    <video style="width:100%" autoplay muted
                                        controls="controls">
                                        <source src="assets/videos/introduction.m4v" type="video/mp4">
                                        <source src="assets/videos/introduction.m4v" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div class="clear"></div>

                            </div>
                        </section>
                    </div>
                </form>
            </section>
        
    </div>


<?php include_once 'footer/frontFooter.php'; ?>

