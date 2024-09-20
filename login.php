
<?php
session_start();
require_once "./header/frontHeader.php";
$page_to_show = 'login';
################################### LOGIN #########################
$login_err = '';
$login_email = '';
if (isset($_SESSION['LOGIN'])) {
    $page_to_show = 'login';


    if (empty($_SESSION['LOGIN']['ERR']['MSG'])) {
        $login_err = 'Invalid credentials.';
    } else {
        $login_err = $_SESSION['LOGIN']['ERR']['MSG'];
    }
    $login_email = $_SESSION['LOGIN']['FIELDS']['email'];
    unset($_SESSION['LOGIN']);
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="e-learning, Intellectual Property, IP, Qualcomm, L2PRO, Patents, Standard Essential Patents, Industrial design, Confidential information, Inventions, Moral rights, Works of authorship, Service marks, Logos, Trademarks, Design rights, Commercial secrets, NDAs, Non-Disclosure Agreement, Start-ups">
    <meta name="language" content="en" />
    <title>L2Pro India</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
        <link href="../assetsnewdesign/css/style.css" rel="stylesheet">
        
        <style>
            a {
  pointer-events: auto; /* Ensure links are clickable */
}
        </style>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body>
     
<section class="_form_05">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="_form-05-box">
              <div class="row">
                <div class="col-sm-5 _lk_nb">
                  <div class="form-05-box-a">
                    <div class="_form_05_logo">
                      <h2>   <img src="../assetsnewdesign/images/l2pro.png" alt="logo"></h1></h2>
                      <p>Login using social media to get quick access</p>
                    </div>
                    <div class="_form_05_socialmedia">
                      <ol>
                        <li><a href="facebook-login.php?login_type=facebook" style="color:white;"><i class="bi bi-facebook"></i>Sign With Facebook</a></li>
                        <!-- <li><a href="#"><i class="bi bi-twitter"></i></a>Sign With Twitter</li> -->
                        <li><a href="social-login.php?login_type=google" style="color:white;"><i class="bi bi-google"></i>Sign With Google</a></li>
                      </ol>
                    </div>
                  </div>
                </div>
                <div class="col-sm-7 _nb-pl">
                  <div class="_mn_df">
                    <div class="main-head">
                      <h2>Login to your account</h2>
                    </div>
                    
                    <form class="dart-headingstyle" action="./pages/helpers/login.php" method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off" id="signinfrm">
                    <div class="form-group">
                      <input required class="form-control" name="username" id="username" type="text" data-required="true" value="" autocomplete="off" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                      <input type="password" name="password" class="form-control" id="password" type="password" data-required="true" data-minlength="[6]" data-maxlength="[15]" maxlength="15" autocomplete="new-password" placeholder="Password">
                    </div>
                    <?php //echo $login_err ?>
                    <!--/////////////////Dev - Added Code here - change secret///////////-->
							<!-- <div class="g-recaptcha" style='padding-bottom:10px;' data-sitekey="6Le_W4kkAAAAAK8_sgxkhFrC9wT4O75IoIHZbYy3"></div> -->
							<!----------------------------->
                    <!-- <div class="">
                     
                      <a href="forget-password.php">Forgot Password</a>
                    </div> -->

                    <div class="form-group">
                      <div class="_btn_04">
                        <!-- <a href="#">Login</a> -->
                        <button class="btn bg-primary text-white py-3 px-5" style="padding-bottom: 0rem !important;padding-top: 0rem !important;" id="log-in" type="submit">Login</button>
                      </div>
                    </div>
                    <div class="checkbox form-group">
                      <!-- <div class="form-check">
                      Don't have an account?
                      </div> -->
                      <a href="register.php">Sign up</a>
                      <a href="forget-password.php">Forgot Password</a>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
      

      
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assetsnewdesign/js/wow.min.js"></script>
        <script src="../assetsnewdesign/js/easing.min.js"></script>
        <script src="../assetsnewdesign/js/waypoints.min.js"></script>
        <script src="../assetsnewdesign/js/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="../assetsnewdesign/js/main.js"></script>
    </body>

</html>