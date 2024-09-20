
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="e-learning, Intellectual Property, IP, Qualcomm, L2PRO, Patents, Standard Essential Patents, Industrial design, Confidential information, Inventions, Moral rights, Works of authorship, Service marks, Logos, Trademarks, Design rights, Commercial secrets, NDAs, Non-Disclosure Agreement, Start-ups">
    <meta name="language" content="en" />
    <title>L2Pro India</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
        <link href="../assetsnewdesign/css/style.css" rel="stylesheet">
    </head>

    <body>
      <?php 
      session_start();
    $fp_email = '';
$fp_err_msg = '';
$fp_success_msg = '';
if (isset($_SESSION['FORGOT_PASSWORD'])) {

    $page_to_show = 'forgot-password';

    $fp_email = isset($_SESSION['FORGOT_PASSWORD']['FIELDS']['forgot_pasword']) ? $_SESSION['FORGOT_PASSWORD']['FIELDS']['forgot_pasword'] : '';
    $fp_err_msg = '';
    $fp_success_msg = '';
    if (isset($_SESSION['FORGOT_PASSWORD']['ERR'])) {
        $err_code = $_SESSION['FORGOT_PASSWORD']['ERR'];
        if ($err_code == 1) {
            $fp_err_msg = 'Email id is empty.';
        } elseif ($err_code == 2) {
            $fp_err_msg = 'Please ensure you are connected to internet and try again.';
        } elseif ($err_code == 4) {
            $fp_err_msg = 'Please check the the captcha form.';
        } elseif ($err_code == 5) {
            $fp_err_msg = 'You are spammer ! Get the @$%K out';
        } else {
            $fp_err_msg = 'This email id does not exist.';
        }
    }
    if (isset($_SESSION['FORGOT_PASSWORD']['SUCCESS'])) {
        $fp_success_msg = 'Password has been sent to your email address.';
    }

    unset($_SESSION['FORGOT_PASSWORD']);
}
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<section class="_form_05">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="_form-05-box">
              
             
                  <div class="col-sm-10 mx-auto ">
                  <div class="_mn_df">
                    <div class="main-head">
                         <h2 class="_form_05_logo">   <img src="../assetsnewdesign/images/l2pro.png" alt="logo"></h2>
                      <h2>Forget Password</h2>
                    </div>
                    <form id="forgetPass" class="login-form dart-headingstyle" name="forget-form" action="./pages/helpers/forgot-password.php" method="post" data-validate="parsley" autocomplete="off">
                    <div class="form-group">
                      <input type="email" name="userEmailId" id="userEmailId" type="email" data-required="true" data-type="email" maxlength="50" required class="form-control" placeholder="Enter email">
                    </div>
                    <div>
                            <!-- <div class="g-recaptcha" data-sitekey="6Le_W4kkAAAAAK8_sgxkhFrC9wT4O75IoIHZbYy3"></div> -->
                            <label class="required" id="userloginError" style="display:block">
                                <?php
                                if ($fp_err_msg != '') {
                                    echo '<span class="err" style="background-color: #fff;color:red;display: block;width: 100%;padding: 5px 10px;margin-top: 10px;">' . $fp_err_msg . '</span>';
                                } else if ($fp_success_msg != '') {
                                    echo '<span class="text-success" style="background-color: #fff;display: block;width: 100%;padding: 5px 10px;margin-top: 10px;"><b>' . $fp_success_msg . '</b></span>';
                                }
                                ?>
                            </label>
                        </div>
<div class="form-group">Enter your email address. Login credentials will be sent on your registered email address.</div>
                   
                  
                    <div class="form-group">
                      <div class="_btn_04">
                      <button class="btn bg-primary text-white py-3 px-5" style="padding-bottom: 0rem !important;padding-top: 0rem !important;" id="log-in" type="submit">Forget Password</button>
                      </div>
                    </div>
                              </form>
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