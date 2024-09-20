<?php
session_start();
require_once "./header/frontHeader.php";
$reg_fail_msg = '';
$reg_succ_msg = '';
$reg_status = 0;
$reg_term_cond_checked = 0;
$reg_msg = '';
// for registration page only 
$firstname = isset($_SESSION['REGISTRATION']['FIELDS']['firstname']) ? $_SESSION['REGISTRATION']['FIELDS']['firstname'] : '';
$lastname = isset($_SESSION['REGISTRATION']['FIELDS']['lastname']) ? $_SESSION['REGISTRATION']['FIELDS']['lastname'] : '';
$email = isset($_SESSION['REGISTRATION']['FIELDS']['email']) ? $_SESSION['REGISTRATION']['FIELDS']['email'] : '';
$mobile = isset($_SESSION['REGISTRATION']['FIELDS']['mobile']) ? $_SESSION['REGISTRATION']['FIELDS']['mobile'] : '';
$reg_password = isset($_SESSION['REGISTRATION']['FIELDS']['reg_password']) ? $_SESSION['REGISTRATION']['FIELDS']['reg_password'] : '';


if (isset($_SESSION['REGISTRATION'])) {

    $page_to_show = 'registration';

    if (isset($_SESSION['REGISTRATION']['ERR']['MSG'])) {
        $reg_fail_msg = trim($_SESSION['REGISTRATION']['ERR']['MSG']);
        $reg_status = 0;
        $reg_term_cond_checked = 1;
    }

    if (isset($_SESSION['REGISTRATION']['SUCCESS']['MSG'])) {
        $reg_succ_msg = $_SESSION['REGISTRATION']['SUCCESS']['MSG'];
        $reg_status = 1;
    }

    unset($_SESSION['REGISTRATION']);
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

        <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </head>

    <body style="overflow-y: auto;">
     
<section class="_form_05">
      <div class="container">
        <div class="row">
          <div class="mt-4 mb-4">
            <div class="_form-05-box">
              <div class="row">
             
                <div class="col-md-10 mx-auto ">
                  <div class="">
                    <div class="main-head">
                        <h2 class="_form_05_logo">   <img src="../assetsnewdesign/images/l2pro.png" alt="logo"></h2>
                      <h2>Register</h2>
                    </div>
                    <form class="dart-headingstyle" id="reg-form" class="login-form" name="reg-form" action="./pages/helpers/submitUser.php" method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off">
                    <div class="row">
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                        <input class="form-control" required name='firstname' id="firstname" type="text" placeholder="First Name" data-required="true" value="<?php echo $firstname ?>" maxlength="50" autocomplete="first-name" data-regexp="^[a-zA-Z ]+$" data-regexp-message="First name should contain characters only.">
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                        <input  class="form-control" required name='lastname' id="last_name" type="text" placeholder="Last Name" data-required="true" value="<?php echo $lastname ?>" maxlength="50" autocomplete="last-name" data-regexp="^[a-zA-Z ]+$" data-regexp-message="Last name should contain characters only.">
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                <input class="form-control" required name='mobile' id="mobile" type="text" placeholder="+91-" required maxlength="10" data-minlength="[10]" data-minlength-message="Phone number must be of 10 digit." data-maxlength="[10]" value="<?php echo $mobile ?>" autocomplete="user-mobile" parsley-type="phone" data-type="phone" data-type-message="">
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                <input class="form-control" required name='email' id="email" type="text" placeholder="abc@example.com" data-required="true" data-type="email" value="<?php echo $email ?>" maxlength="50" onblur="checkDuplicateEmail(this.value);" autocomplete="new-email">
                                </div>
                            </div>
                           <div class="col-sm-6  ">
                                    <div class="form-group">
                                    <input class="form-control" required name="password" id="regpassword" placeholder="Enter Password" type="password" data-required="true" maxlength="12" data-regexp="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,12}$" value="" data-regexp-message="Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character." autocomplete="new-password">
                                    </div>
                            </div>
                            <div class="col-sm-6  ">
                                    <div class="form-group">
                                    <input type="password" class="form-control" required name="cpassword" id="cpassword" placeholder="Confirm Password" data-equalto="#regpassword" data-required="true" type="password" data-minlength="[6]" data-maxlength="[12]" maxlength="12" value="<?php //echo $password
                                                                                                                                                                                                                                                        ?>">
                                    </div>
                            </div>
 <div class="col-sm-12  ">
                   <!-- <div class="checkbox form-group" style="justify-content: space-between;"> -->
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" onclick="showBtn();" required id="checkbox-1-1" name="checkbox-1-1">
                        <label class="form-check-label" for="">
                        <!-- I agree to all <span style="font-weight:bold; text-decoration:underline" data-toggle="modal" data-target="#termAndCondition">Terms of Conditions </span>and <span style="font-weight:bold; text-decoration:underline" data-toggle="modal" data-target="#privacyPolicy">Privacy Policy. </span> -->
                        I agree to all <a href="tnc.php" style="font-weight:bold; text-decoration:underline" >Terms of Conditions </a>and <a href="privacy_policy.php" style="font-weight:bold; text-decoration:underline" >Privacy Policy </a>.
                        </label>
                      </div>
                   
                    <!-- </div> -->
                    <!-- <div class="checkbox form-group" style="justify-content: space-between;"> -->
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkbox-1-2" name="checkbox-1-2">
                        <label class="form-check-label" for="">
                        your profile page.
                        </label>
                      </div>
                      
                    <!-- </div> -->
                </div>
                <a href="login.php">Have an Account?</a>
                <label style="margin-bottom:0px;"> <input type="text" name="client_id" hidden value="5">
                            <input type="text" name="bundle_id" hidden value='demo-b2c'>
                            <input type="text" name="order_id" hidden value='SignUp'>
                        </label>
                        <label class="required" id="userError" style=" font-weight:bold;display:block;">
                            <?php
                            if ($reg_fail_msg != '') {
                                echo '<span class="err" style="background-color:#fff;color:red; display;block;padding:10px 20px;">' . $reg_fail_msg . '</span>';
                            }
                            ?>
                        </label>
                        <input type="hidden" name="dir_name" value="<?php echo dirname($_SERVER['PHP_SELF']); ?>" />
                    <div class="col-sm-12 ">
                    <div class="form-group">
                      <div class="_btn_04">
                      <button class="btn bg-primary text-white py-3 px-5" style="width:100%;padding: 0px 0px !important;" type="button" id="registration" disabled="true"  style="padding-bottom: 0rem !important;padding-top: 0rem !important;" id="registration" data-toggle="modal" data-target="#registerModal">Submit</button>
                      <!-- <button type="button" id="registration" disabled="true" class="btn button-default" style="margin-top:0" data-toggle="modal" data-target="#registerModal">Submit</button> -->
                        <!-- <a href="#">Register</a> -->
                      </div>
                    </div>
                </div>

                
</form>
                  </div>
              </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
      
                        <!-- Modal -->
                        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Registration</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        You are signing up with your email <span id="reg_user_email"></span>. Please confirm if this is correct one,. Once submitted you cannot change it further.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" style="color:white;" class="btn button-default" data-dismiss="modal">Please Change</button>
                                        <button type="submit" style="color:white;" id="confirmProceed" class="btn button-default">Please Proceed</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--modal  ends here-->
                        <!-- Modal -->
                        <div class="modal fade" id="termAndCondition" tabindex="-1" role="dialog" aria-labelledby="termAndCondition" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span style="color:black !important;">I agree to all Terms of Conditions and Privacy Policy.</span>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        YOUR AGREEMENT By using this Site, you agree to be bound by, and to comply with, these Terms and Conditions. If you do not agree to these Terms and Conditions, please do not use this site. <span color="#3252CD">PLEASE NOTE:</span> We reserve the right, at our sole discretion, to change, modify or otherwise alter these Terms and Conditions at any time. Unless otherwise indicated, amendments will become effective immediately. Please review these Terms and Conditions periodically. Your continued use of the Site following the posting of changes and/or modifications will constitute your acceptance of the revised Terms and Conditions and the reasonableness of these standards for notice of changes. For your information, this page was last updated as of the date at the top of these terms and conditions. 2. PRIVACY Please review our Privacy Policy, which also governs your visit to this Site, to understand our practices. 3. LINKED SITES This Site may contain links to other independent third-party Web sites ('Linked Sites'). These Linked Sites are provided solely as a convenience to our visitors. Such Linked Sites are not under our control, and we are not responsible for and does not endorse the content of such Linked Sites, including any information or materials contained on such Linked Sites. You will need to make your own independent judgment regarding your interaction with these Linked Sites. 4. FORWARD LOOKING STATEMENTS All materials reproduced on this site speak as of the original date of publication or filing. The fact that a document is available on this site does not mean that the information contained in such document has not been modified or superseded by events or by a subsequent document or filing. We have no duty or policy to update any information or statements contained on this site and, therefore, such information or statements should not be relied upon as being current as of the date you access this site.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn button-default" data-dismiss="modal"><i class="fa fa-times-circle" style="color:#fff" aria-hidden="true"></i> Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--modal  ends here-->
                        <div class="modal fade" id="privacyPolicy" tabindex="-1" role="dialog" aria-labelledby="privacyPolicy" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Privacy Policy</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        YOUR AGREEMENT By using this Site, you agree to be bound by, and to comply with, these Terms and Conditions. If you do not agree to these Terms and Conditions, please do not use this site. <span color="#3252CD">PLEASE NOTE:</span> We reserve the right, at our sole discretion, to change, modify or otherwise alter these Terms and Conditions at any time. Unless otherwise indicated, amendments will become effective immediately. Please review these Terms and Conditions periodically. Your continued use of the Site following the posting of changes and/or modifications will constitute your acceptance of the revised Terms and Conditions and the reasonableness of these standards for notice of changes. For your information, this page was last updated as of the date at the top of these terms and conditions. 2. PRIVACY Please review our Privacy Policy, which also governs your visit to this Site, to understand our practices. 3. LINKED SITES This Site may contain links to other independent third-party Web sites ('Linked Sites'). These Linked Sites are provided solely as a convenience to our visitors. Such Linked Sites are not under our control, and we are not responsible for and does not endorse the content of such Linked Sites, including any information or materials contained on such Linked Sites. You will need to make your own independent judgment regarding your interaction with these Linked Sites. 4. FORWARD LOOKING STATEMENTS All materials reproduced on this site speak as of the original date of publication or filing. The fact that a document is available on this site does not mean that the information contained in such document has not been modified or superseded by events or by a subsequent document or filing. We have no duty or policy to update any information or statements contained on this site and, therefore, such information or statements should not be relied upon as being current as of the date you access this site.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn button-default" data-dismiss="modal"><i class="fa fa-times-circle" style="color:#fff" aria-hidden="true"></i> Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--modal  ends here-->

      
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assetsnewdesign/js/wow.min.js"></script>
        <script src="../assetsnewdesign/js/easing.min.js"></script>
        <script src="../assetsnewdesign/js/waypoints.min.js"></script>
        <script src="../assetsnewdesign/js/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="../assetsnewdesign/js/main.js"></script>
        <script>
             let regBtn = false;

function showBtn() {

    if (regBtn === false) {
        regBtn = !regBtn;
        document.getElementById('registration').removeAttribute('disabled');
    } else {
        regBtn = !regBtn;
        document.getElementById('registration').setAttribute('disabled', 'true');

    }
}
$('#confirmProceed').click(function() {
                $('#reg-form').submit(); // Submit the form
            });
        </script>
    </body>

</html>