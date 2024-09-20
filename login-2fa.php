<?php 
session_start();
include_once 'header/header.php'; 

$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
$is_otp_varifid = isset($_SESSION['is_otp_varifid']) ? $_SESSION['is_otp_varifid'] : 0;
?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<section class="main-votex width100 bannerContainer imgBgHeader" id="wrapper">

    <div id="mask">
        <!--	start login-->
        <div id="item1" class="item">
            <section id="contentLogin" class="content container m-t-lg wrapper-md make-center full-width">
                <form id="login-form" class="login-form" name="login-form" action="login-2fa-verify.php"
                    method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off">


                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                        <section class="loginpanel wrapper-xl loginBg">
                            <div class="loginHeader">
                                <p class="student-title"> 2 Way Authentication </p>
                                <p>We have sent an OTP to you registered email address. Please verify that below here
                                    </br>
                                </p>
                            </div>
                            <div class="panel-body loginDiv">
                                <label class="control-label" for="otp">OTP<span class="required">*</span></label>
                                </br>
                                <div style="display: flex;align-items: center;justify-content: center;">
                                    <input class="form-control input-lg" name="otp" id="otp" type="text" data-required="true" value="<?php echo $is_otp_varifid == 1 ? $_SESSION['login_otp']:'' ?>" autocomplete="off" />  
                                    
                                    <span style="right: 18px;position: relative;">
                                        <?php if ($is_otp_varifid == 1) {  ?>
                                            <i class="fa fa-check" aria-hidden="true"></i> 
                                        <?php }else {  ?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        <?php }  ?>
                                    </span>
                                </div>
                                <br>
                                <div class="g-recaptcha" data-sitekey="6Le_W4kkAAAAAK8_sgxkhFrC9wT4O75IoIHZbYy3">
                                </div>
                                <br>
                                <label class="required" id="lblLoginErr">
                                    <?php echo $error_message?>
                                </label>
                                <div>
                                <button id="log-in" class="btn btn-orange form-control input-lg marginbtm0"
                                        type="submit" name="yt0" value="Sign in" />Verify
                                </button>
                                <div class="clear"></div>
                                <div class="text-center">
                                <br>
                                <a href="index.php#item1" class="scrollDivSlide  m-t-xs fpassword back" style="top:-2px">
                                        <small> Back to Login</small> 
                                    </a>
                                </div>
                                <!-- <br>
                                <a href="index.php#item2" class="btn btn-orange form-control input-lg marginbtm0">Back to signup</a>
                                <br> -->
                            </div>
                        </section>

                        <br> 
                        <br>   
                        <br> 
                        <br>
                        <br>   
                        <br> 
                        <br>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padd0">
                        <section class="">

                            <div class=" text-center ">
                                <div class="videoDiv">
                                    <video style="width:500px;border: solid 10px #1b1b1e;" autoplay muted id="videoId"
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
    </div>
</section>
<div class="clear"></div>
<?php include_once 'footer/footer.php'; ?>

