<?php /*?><?php 
require_once ('header/auth.php');
include_once ("header/header_inner.php");

?><?php */ ?>
<!--start header -->
<!-- T&C Modal -->
<!--End header -->
<div class="term modal fade" id="termModel" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-course-title"> Terms and Condition</h4>
            </div>
            <div class="modal-body">
                <section class="scrollable ">



                    <!--start Midlle container -->
                    <div class="col-md-12 col-sm-12 chComponentBg">
                        <div class="customContainer">



                            <div class="col-md-12 col-sm-12">
                                <div class="overviewBg">
                                    <p> YOUR AGREEMENT
                                        By using this Site, you agree to be bound by, and to comply with, these Terms
                                        and Conditions. If you do not agree to these Terms and Conditions, please do not
                                        use this site.

                                        PLEASE NOTE: We reserve the right, at our sole discretion, to change, modify or
                                        otherwise alter these Terms and Conditions at any time. Unless otherwise
                                        indicated, amendments will become effective immediately. Please review these
                                        Terms and Conditions periodically. Your continued use of the Site following the
                                        posting of changes and/or modifications will constitute your acceptance of the
                                        revised Terms and Conditions and the reasonableness of these standards for
                                        notice of changes. For your information, this page was last updated as of the
                                        date at the top of these terms and conditions.
                                        2. PRIVACY
                                        Please review our Privacy Policy, which also governs your visit to this Site, to
                                        understand our practices.

                                        3. LINKED SITES
                                        This Site may contain links to other independent third-party Web sites ('Linked
                                        Sites'). These Linked Sites are provided solely as a convenience to our
                                        visitors. Such Linked Sites are not under our control, and we are not
                                        responsible for and does not endorse the content of such Linked Sites, including
                                        any information or materials contained on such Linked Sites. You will need to
                                        make your own independent judgment regarding your interaction with these Linked
                                        Sites.

                                        4. FORWARD LOOKING STATEMENTS
                                        All materials reproduced on this site speak as of the original date of
                                        publication or filing. The fact that a document is available on this site does
                                        not mean that the information contained in such document has not been modified
                                        or superseded by events or by a subsequent document or filing. We have no duty
                                        or policy to update any information or statements contained on this site and,
                                        therefore, such information or statements should not be relied upon as being
                                        current as of the date you access this site. </p>
                                    <div class="clear"></div>

                                    <p>
                                    </p>
                                    <p><label style="margin-bottom:0px;">
                                            <input type="text" name="client_id" hidden value=2>
                                            <input type="text" name="bundle_id" hidden value='demo-b2c'>
                                            <input type="text" name="order_id" hidden value='SignUp'>
                                            <input type="checkbox" id="checkbox-2-2" name="checkbox-2-2"
                                                class="regular-checkbox" onclick="checkShow(this.id,'checkbox-1-1');">
                                            <label id="terms-conds-label" for="checkbox-1-1"></label>
                                            <span class="check"></span> </label>
                                        <span class="remember">I agree to the Terms of Service</span>
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- ####### end  Midlle container-->

                </section>
            </div>

        </div>
    </div>
</div>

<!-- Privacy Policy.   -->

<div class="term modal fade" id="PrivacyPolicyModel" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-course-title"> Privacy Policy</h4>
            </div>
            <div class="modal-body">
                <section class="scrollable ">



                    <!--start Midlle container -->
                    <div class="col-md-12 col-sm-12 chComponentBg">
                        <div class="customContainer">
                            <div class="col-md-12 col-sm-12">
                                <div class="overviewBg">
                                    <p> </p>
                                    <div class="clear"></div>
                                    <h2>Waiting for content </h2>
                                    <p>
                                    </p>
                                    <!-- <p><label style="margin-bottom:0px;">
                                            <input type="text" name="client_id" hidden value=2>
                                            <input type="text" name="bundle_id" hidden value='demo-b2c'>
                                            <input type="text" name="order_id" hidden value='SignUp'>
                                            <input type="checkbox" id="checkbox-2-2" name="checkbox-2-2" class="regular-checkbox" onclick="checkShow(this.id,'checkbox-1-1');">
                                            <label id="terms-conds-label" for="checkbox-1-1"></label>
                                            <span class="check"></span> </label>
                                        <span class="remember">I agree to the Terms of Service</span>
                                    </p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ####### end  Midlle container-->
                </section>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="signupemailconfermationmodal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="top:-130px">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <section class="loginpanel wrapper-xl loginBg" style="padding:10px">
                <div class="panel-body loginDiv">
                    <h4 class="paddTop20 paddBottom20 text-center" style="color:green">
                        You are signing up with your email <b><span id="form_email"></span></b>.
                        Please confirm if this is correct one,. Once submitted you cannot change it further. </h4>
                    <div class="clear"></div>



                    <div class="clear text-center paddTop20 paddBottom20">

                    <button type="button" class="btn btn-primary" id="please_change">Please Change </button>
                <button type="button" class="btn btn-success" id="please_proceed"> Please Proceed</button>

                        <!-- <a href="#item1" class="scrollDivSlide btn btn-primary form-control input-lg"><small>
                                Sign in
                            </small></a> -->
                    </div>
                </div>
                <!-- <div class="line line-dashed"></div> -->

            </section>

            <!-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Email Address</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    You are signing up with your email <b><span id="form_email"></span></b>.
                    Please confirm if this is correct one,. Once submitted you cannot change it further.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="please_change">Please Change </button>
                <button type="button" class="btn btn-primary" id="please_proceed"> Please Proceed</button>
            </div>
        </div> -->
        </div>
    </div>

    <script>
    $(document).on('change', '#regpassword', function(e) {
        var val = $(this).val();
        if (!val) {
            $('#password_error').text('This value is required.');
            $('#password_error').css('color', 'red');
            return;
        } else if (!val.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/)) {
            $('#password_error').text(
                '(Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character)'
            );
            $('#password_error').css('color', 'red');
            return;
        } else {
            $('#password_error').text('');
        }
    });

    $(document).on('change', '#cpassword', function(e) {
        var val = $(this).val();
        var password = $('#regpassword').val();
        if (!val) {
            $('#cpassword_error').text('This value is required.');
            $('#cpassword_error').css('color', 'red');
            return;
        } else if (val != password) {
            $('#cpassword_error').text('This value should be the same.');
            $('#cpassword_error').css('color', 'red');
            return;
        } else if (!val.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/)) {
            $('#cpassword_error').text(
                '(Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character)'
            );
            $('#cpassword_error').css('color', 'red');
            return;
        } else {
            $('#cpassword_error').text('');
        }
    });


    function checkShow(sourceid, targetId) {
        var id = document.getElementById(sourceid);

        if (id.checked) {
            $("#" + targetId).prop('checked', true);

            $("#registration").prop('disabled', false);
            $("#registration").removeClass('btnDisable');
        } else {
            $("#" + targetId).prop('checked', false);

            $("#registration").prop('disabled', true);
            $("#registration").addClass('btnDisable');
        }

    }

    function termPopup(modal_id) {
        $(modal_id).modal({
            backdrop: "static"
        });
    }

    $(document).on('click', '#registration', function() {
        $('#form_email').text($('#email').val());
        $('#signupemailconfermationmodal').modal('show');
        $("#userError").html('');
        $('#password_error').text('');
        $('#cpassword_error').text('');
    });

    $(document).on('click', '#please_change', function() {
        $('#signupemailconfermationmodal').modal('hide');
        $("#email").focus();
        $("#userError").html('');

    });

    $(document).on('click', '#please_proceed', function() {
        $('#signupemailconfermationmodal').modal('hide');
        $('#reg-form').submit();
        $("#userError").html('');
    });
    </script>