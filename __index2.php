<?php
session_start();
//session_destroy();
?>
<?php //include_once 'detect_device/download-app.php'; ?>
<?php include_once 'header/header.php'; ?>


<?php

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

############################## reg #####################################
$reg_fail_msg = '';
$reg_succ_msg = '';
$reg_status = 0;
$reg_term_cond_checked = 0;

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

######################################## forgot password ###############
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
        }elseif ($err_code == 4) {
            $fp_err_msg = 'Please check the the captcha form.';
        }elseif ($err_code == 5) {
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
   
  <section class="main-votex width100 bannerContainer imgBgHeader" id="wrapper">
 
	<div id="mask">
<!--	start login-->
		<div id="item1" class="item">
		 <section id="contentLogin" class="content container m-t-lg wrapper-md make-center full-width">
			 <form id="login-form" class="login-form" name="login-form" action="./pages/helpers/login.php"  method = "post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off" >
			
			 
			  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<section class="loginpanel wrapper-xl loginBg">
				  <div class="loginHeader">
				  <p class="student-title"> Sign in </p>
				  <p> Please Sign in with your username and password.
					</br>
				  </p></div>
				<div class="panel-body loginDiv">
				  	
				  <label class="control-label" for="username">Username <span class="required">*</span></label>
				
				  <input class="form-control input-lg" name = "username" id="username" type="text" data-required= "true" value="" autocomplete="off"  />
				  <label class="control-label" for="password">Password <span class="required">*</span></label>
				  <input class="form-control input-lg " name = "password"  id="password" type="password" data-required= "true" data-minlength="[6]" data-maxlength="[15]" maxlength="15" autocomplete="new-password"/>
				  <label class="required" id="lblLoginErr" >
				  <?php
						if(isset($login_err)) {
							echo $login_err;
						}
                    ?>
					</label>
				
				  <!--<div class="checkbox">
					<label>
					<input type="checkbox" id="checkbox-1-1" name="checkbox-1-1" class="regular-checkbox">
					<label for="checkbox-1-1"></label>
					<span class="remember">Remember password</span>
					</label>
				  </div>-->
				 
						 
				  <div >
					<button id="log-in" class="btn btn-orange form-control input-lg marginbtm0" type="submit" name="yt0" value="Sign in" />Sign in
				   </button>
					<div class="clear"></div>
					  <div class="text-right"> <a href="#item3" class="scrollDivSlide pull-right m-t-xs fpassword back"><small> Forgot password?</small></a></div>
					   
				</div>
				  
					<div class="clear"></div>
					<div class="line-dashed "></div>
								
					<div><p class="firstuser">First-time user, register here.</p></div>
					<div>  <a href="#item2" class="scrollDivSlide btn btn-primary form-control input-lg"><small>Sign up  </small></a></div>
				  
				<!-- <div class="line line-dashed"></div> -->
			  </div>
						
			  </section>
			  </div> 
			   <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">&nbsp;</div>
			   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padd0"> 
				<section class="">
				
			<div class=" text-center ">
		     <div class="videoDiv" >
              <video style="width:500px;border: solid 10px #1b1b1e;" autoplay muted id="videoId" controls="controls">
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
		<!--	end login-->
	<!--		start  Sign up-->
		<div id="item2" class="item">
		 <section id="contentReg" class="content container m-t-lg wrapper-md  make-center full-width ">
      <form id="reg-form" class="login-form" name="reg-form" action="./pages/helpers/submitUser.php"  method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="registration_form" value="1">
	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1 paddLeft0"></div>
       <div class="col-md-10 col-sm-12 col-xs-12 padd0">
                      
        <section>
        <div class="panel-body loginpanel wrapper-x2 loginBg">
          <p class="student-title">  Sign up </p>
          <p> 
         
          </p> 
		   
		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
                        <label class="control-label" for="firstname">First Name <span class="required">*</span></label>
                        <input class="form-control input-lg width80" name='firstname' id="firstname" type="text" placeholder="First Name" data-required= "true" value="<?php echo $firstname?>" maxlength="50" autocomplete="first-name" data-regexp="^[a-zA-Z ]+$" data-regexp-message="First name should contain characters only." />
		  </div> 
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
		  <label class="control-label" for="last_name">Last Name <span class="required">*</span></label>
          <input class="form-control input-lg width80" name = 'lastname' id="last_name" type="text" placeholder="Last Name" data-required= "true" value="<?php echo $lastname?>" maxlength="50" autocomplete="last-name" data-regexp="^[a-zA-Z ]+$" data-regexp-message="Last name should contain characters only."/> 
		  </div>  <div class="clear"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
		  <label class="control-label" for="mobile">Mobile </label>
          <input class="form-control input-lg width80" name='mobile' id="mobile" type="text" placeholder="+91-"   maxlength="10" data-minlength="[10]" data-minlength-message="Phone number must be of 10 digit." data-maxlength="[10]" value="<?php echo $mobile?>" autocomplete="user-mobile" parsley-type="phone" data-type="phone"  data-type-message=""   />	
		   </div> 
		   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
		  <label class="control-label" for="email">Email (Username) <span class="required">*</span></label>
          <input class="form-control input-lg width80" name='email' id="email" type="text" placeholder="abc@example.com" data-required= "true" data-type="email" value="<?php echo $email?>"  maxlength="50" onblur="return checkDuplicateEmail(this.value);" autocomplete="new-email" />
		 </div>
		 <div class="clear"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
          <label class="control-label" for="password">Password <span class="required">*</span></label>
          <input class="form-control input-lg width80" name = "password" id="regpassword" placeholder="" type="password" data-required="true"  maxlength="12" data-regexp="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,12}$" value="<?php //echo $password?>" data-regexp-message="Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character." autocomplete="new-password"/>
		  <label class="instructionlabel">(Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character)</label>
		  
		   </div> 
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
          <label class="control-label" for="cpassword">Confirm Password <span class="required">*</span></label>
          <input class="form-control input-lg width80" name="cpassword" id="cpassword" placeholder=""  data-equalto="#regpassword" data-required= "true" type="password" data-minlength="[6]" data-maxlength="[12]" maxlength="12"  value="<?php //echo $password?>"/>
		   </div> 
          
		  
		  
          
      <div class="clear"></div>
      <div class="clear"></div>
        
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddLeft0">
			<div class="g-recaptcha" data-sitekey="6LcgLKgUAAAAAEmHwk7jnEcsC5yYrV__ErAKdowR"></div>
		 </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddLeft0">
          
            <label style="margin-bottom:0px;">  <input type="text" name = "client_id" hidden value="5">
			<input type="text" name = "bundle_id" hidden value = 'demo-b2c'>
			<input type="text" name = "order_id" hidden value = 'SignUp'>
            <input type="checkbox" id="checkbox-1-1" name="checkbox-1-1" class="regular-checkbox" onclick="checkShow(this.id,'checkbox-2-2');">
            <label id="terms-conds-label" for="checkbox-1-1"></label>
           <span class="check"></span> </label>
            <span class="remember">I agree to the  <a href="javascript:void(0)" onClick="termPopup();"  class="text-info" >Terms of Service </a></span>
			
		</div>	
		  <div class="clear"></div>
		 
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddLeft0">	
            <div class="text-center"> 
		   <label class="required" ><?php echo $reg_msg; ?></label>
			<label class="required" id="userError">  
			<?php
				if ($reg_fail_msg != '') {
					echo '<span class="err">' . $reg_fail_msg . '</span>';
				} else if ($reg_succ_msg != '') {
					echo '<span class="text-success">' . $reg_succ_msg . '</span>';
				}
				?>
			</label>
		
         <!-- <a href="forgot-password.php" class="pull-right m-t-xs"><small> Forgot password?</small></a>-->
		<!--   <a href="#item1" class="scrollDivSlide pull-left m-t-xs back"><small>Back to Login </small></a>-->
          </div>  
		<div class="text-left">
		<input type="hidden"  name="dir_name" value="<?php echo dirname($_SERVER['PHP_SELF']);?>" />
            <button id="registration" disabled="disabled" class="btn btn-orange form-control input-lg btnDisable width80 marginbtm0" type="submit" name="yt0" value="Registration" />
            Sign up   
        </div> 
       
             
         </div>
        <!-- <div class="line line-dashed"></div> -->
     
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddLeft0">
	  &nbsp;
       
         </div> </div>
        <!-- <div class="line line-dashed"></div> -->
   
      </section>
     
       <div class="bgarrowReg"> <a id="login-a" href="#item1" class="scrollDivSlide m-t-xs back">
                                <div class="bgarrowCircle"><i class="fa fa-arrow-left"></i></div></a>
                            <div class="text"><small>Back to Sign in </small></div>
                        </div>
	 </div></form>
	  
    </section>  
			
		</div>
		<!--	end Sign up-->
		
		
		
		<!--	start successful Sign up-->
		<div id="item4" class="item">
		 <section id="contentReg" class="content container m-t-lg wrapper-md  make-center full-width ">
     
    
	  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddLeft0"></div>
       <div class="col-md-6 col-sm-6 col-xs-12 padd0 login-form">
                      
       <section class="loginpanel wrapper-xl loginBg">
        <div class="panel-body loginDiv">
         
          <h4 class="paddTop20 paddBottom20 text-center" style="color:green"> <?php echo $reg_succ_msg;?> </h4> 
		
        <div class="clear"></div>
		<div class="clear text-center paddTop20 paddBottom20">
		
		<a href="#item1" class="scrollDivSlide btn btn-primary form-control input-lg"><small> Sign in  </small></a>
                          
              <br>    <br>          </div>
        </div>
        <!-- <div class="line line-dashed"></div> -->
   
      </section>
     </div>
	  
    </section>  
			
		</div>
		<!--	end successful sign up-->
		
		<!--		start  forget-->
		<div id="item3" class="item">
			<section id="contentForget" class="content container m-t-lg wrapper-md make-center full-width">
			<form id="forget-form" class="login-form" name="forget-form" action="./pages/helpers/forgot-password.php" method="post" data-validate="parsley" autocomplete="off">

      <div class="col-sm-7 col-xs-12 margonTop30 mobileHideShow">
        <section>
          <div class="panel-body ">
            <div class="text-left" style="margin-bottom: 60px;">
             <h1 class="bannerHeading"> </h1>
				<p class="align-just  subPara"> <br>
              <br></p>
             
            <!-- <div class="line line-dashed"></div> -->
			</div>
          </div>
        </section>
      </div>
      <div class="col-sm-5 col-xs-12">
           <section>
          
        <div class="panel-body loginpanel wrapper-xl  loginBg loginDiv">
           <p> 
             
            </p>    
            
          <p class="student-title"> Forgot password</p>
          <p>
		  Enter your email address. Login credentials will be sent on your registered email address.</br>
            </br>
          </p>
		<div>
          <label class="control-label" for="forgot_password">Email <span class="required">*</span>
		  </label>
          <input class="form-control input-lg " name="userEmailId" id="userEmailId" type="email"  data-required= "true" data-type="email"  maxlength="50"/>
		</div>
		 
		 <div>
			<div class="g-recaptcha" data-sitekey="6LcgLKgUAAAAAEmHwk7jnEcsC5yYrV__ErAKdowR"></div>
			<label class="required" id="userloginError">  
		    <?php
				if ($fp_err_msg != '') {
					echo '<span class="err">' . $fp_err_msg . '</span>';
				} else if ($fp_success_msg != '') {
					echo '<span class="text-success"><b>' . $fp_success_msg . '</b></span>';
				}
				?>
		  </label>
		 </div>
		   <div class="clear"></div>
		 <div>
            <button class="btn btn-orange form-control input-lg marginbtm0" type="submit" name="yt0" value="Send" onclick="showOrHideLoader('forget-form');" ondblclick="showOrHideLoader('forget-form');" id="forgot-pwd" />Send</button>  
			</div>
			   
			  <div class="clear"></div>
			<div><p class="firstuser">&nbsp;</p></div>
			<div class="line-dashed "></div>
			<div><p class="firstuser">&nbsp;</p></div>
		<div>  <a href="#item2" class="scrollDivSlide btn btn-primary form-control input-lg "><small>Sign up  </small></a>
		<div class="clear text-center">
		<div class="smallArrowBg">
                            <a href="#item1" class="scrollDivSlide m-t-xs back"> <div class="smallArrowCircle"> <i class="fa fa-arrow-left"></i></div></a>
                            <div class="text"><small>Back to Sign in</small></div>
                        </div></div>
			<!--  <div class="text-right "> <a href="#item1" class="scrollDivSlide pull-left m-t-xs back"><small>Back to Login </small></a></div>-->
        </div>
         </div>
    </section>
	</div>

</form> 
   </section>
	 </div>
	 <!--		end forget-->
	 
	</div>
  </section>
  

<div class="clear"></div>

<?php include_once 'footer/footer.php';?>

<!--<script type="text/javascript" src="js/jquery.scrollTo.js"></script>-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.js"></script>
<script>
$(document).ready(function(){
	
   $(".input-lg").blur(function() {
       // console.log(dInput);
		$("#userError").html('');
		$("#lblLoginErr").html('');
		$("#userloginError").html('');
    });
	$(".input-lg").keypress(function() {
		$("#userError").html('');
		$("#lblLoginErr").html('');
		$("#userloginError").html('');
    });
	$("#registration").click(function() {
		$("#userError").html('');
    });
	$("#log-in").click(function() {
		$("#lblLoginErr").html('');
    });
	$("#forgot-pwd").click(function() {
		$("#userloginError").html('');
    });

});   


function checkDuplicateEmail(curEmail){
	if(curEmail != ""){
		$.post("checkEmail.php", {email: curEmail}, function(data){ if(data == 'YeS'){ 
		$("#email").val("");	alert("Email id already exists."); return false; } });
	}
}
$(window).resize(function () {
		resizePanel();
		resizeimg();
	});
function resizePanel() {
	width = $(window).width();
	height = $(window).height();
	if(width > 991){
		height = height-20;
		mask_width = width * $('.item').length;
		$('#debug').html(width  + ' ' + height + ' ' + mask_width);
		$('#wrapper, .item').css({width: width, height: height});
		$('#mask').css({width: mask_width, height: height});
		$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
		$('#videoId').css('width', '480px');
	 }else{
		  if (window.innerHeight > window.innerWidth) {
			// height = height-20;
			  var docheight = $("#contentLogin").height();
			   console.log("You are now in portrait "+docheight);
			   height = docheight+20;
			  $('#videoId').css('width', '280px');

		  } else {
			  var docheight = $("#contentLogin").height();
			console.log("You are now in landscape"+docheight);
			  height = docheight+40;
			$('#videoId').css('width', '480px');
		  }
		
		mask_width = width * $('.item').length;
		$('#debug').html(width  + ' ' + height + ' ' + mask_width);
		$('#wrapper, .item').css({width: width, height: height});
		$('#mask').css({width: mask_width, height: height});
		$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
		$('#videoId').css('width', '480px');
	 }
		
}
function resizeimg() {

	width = $(window).width();
	
	height = $(window).height();
    var head =$(".header").height;
	if(width > 991){
	   var wrappHeight= height-120;
	   
		//mask_width = width * $('.item').length;
			
		//$('#debug').html(width  + ' ' + height + ' ' + mask_width);
			
		//$('#wrapper, .item').css({width: width, height: height});
		//$('#mask').css({width: mask_width, height: height});
		//$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
		
		$('#wrapper').css({width: width, height: wrappHeight+'px'});
		$('#mask').css({width: width, height: wrappHeight+'px'});
		$('#wrapper').css('min-height', wrappHeight+'px');
		$('#videoId').css('width', '480px');
		
	}else{
      
	    if (window.innerHeight > window.innerWidth) {
			// height = height-120;
			  var docheight = $("#contentLogin").height();
			 console.log("You are now in portrait "+docheight);
			 height = docheight+20;
			  $('#videoId').css('width', +'280px');

		  } else {
			 var docheight = $("#contentLogin").height();
			 console.log("You are now in landscape "+docheight);
			 height = docheight+40;
			$('#videoId').css('width', '480px');
			
		  }
		//mask_width = width * $('.item').length;
			
		//$('#debug').html(width  + ' ' + height + ' ' + mask_width);
			
		//$('#wrapper, .item').css({width: width, height: height});
		//$('#mask').css({width: mask_width, height: height});
		//$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
		
		$('#wrapper').css({width: width, height: wrappHeight+'px'});
		$('#mask').css({width: width, height: wrappHeight+'px'});
		$('#wrapper').css('min-height', wrappHeight+'px');
		$('#videoId').css('width', '480px');
	}
		
}
$(document).ready(function() {

	$('a.scrollDivSlide').click(function () {
		$('#userError').text('');
		$('a.scrollDivSlide').removeClass('selected');
		$(this).addClass('selected');
		
		current = $(this);
		
		$('#wrapper').scrollTo($(this).attr('href'), 800);		
		
		return false;
	});

		resizePanel();
		resizeimg();

});


window.onresize = function (event) {
 		resizePanel();
		resizeimg();

}

<!-- parsley(Validation) -->

    var term_cond_checked = <?php echo json_encode($term_cond_checked);?>;
    var reg_msg = <?php echo json_encode($reg_msg);?>;
     var reg_status = <?php echo json_encode($reg_status);?>;
     
     $(document).ready(function(){
         
        if(reg_msg != '' ){
            $("#reg-popup .msg").text(reg_msg);
            if(reg_status == 1){
                $("#reg-popup .ok").attr('status', 1);
            }else{
                $("#reg-popup .ok").attr('status', 0);
            }
            $("#reg-popup").modal({backdrop: "static"});
        }
         
        $("#reg-popup .ok").click(function(){
            if( $("#reg-popup .ok").attr('status') == 1){
                top.location.href = 'index.php';
            }
        });
        
        
        $("#checkbox-1-1").click(function(){
            if( $(this).is(':checked') ){
                $("#registration").prop('disabled', false);
				$("#registration").removeClass('btnDisable');
            }else{
                $("#registration").prop('disabled', true);
				 $("#registration").addClass('btnDisable');
            }
        });
        
        /* if(checkbox-1-1 == 1 ){
            $("#checkbox-1-1").prop('checked', true);
            $("#registration").prop('disabled', false);
			$("#registration").removeClass('btnDisable');
        }else{
           $("#registration").prop('disabled', true);
		   $("#registration").addClass('btnDisable');
           $("#checkbox-1-1").prop('checked', false);
        } */
        
     });
function termPopup()
{
	$("#termModel").modal({backdrop: "static"});
}

function showOrHideLoader(formId){
	$('#'+formId).parsley('addListener', {
	onFormSubmit: function ( isFormValid ) {
	if(isFormValid == true){
	//showLoader();
	//obj.disabled=true;
	//alert(obj);
	//document.getElementById(obj).disabled=true;
		}else{
		return false;
		}
	}
	});
}	

</script>
