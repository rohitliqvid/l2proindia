<?php
session_start();
//session_destroy();
?>
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




   
  <section class="main-votex width100 bannerContainer imgBgHeader" id="wrapper">
 
	<div id="mask">
<!--	start login-->
		<div id="item1" class="item">
		 <section id="contentLogin" class="content container m-t-lg wrapper-md make-center full-width">
			 <form id="login-form" class="login-form" name="login-form" action="./pages/helpers/login.php"  method = "post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off" >
			
			 
			  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<section class="loginpanel wrapper-xl loginBg">
				  <div class="loginHeader">
				  <p class="student-title"> Log In </p>
				  <p> Please login with your username and password.
					</br>
				  </p></div>
				<div class="panel-body loginDiv">
				  	
				  <label class="control-label" for="username">Username <span class="required">*</span></label>
				
				  <input class="form-control input-lg" name = "username" id="username" type="text" data-required= "true" value="<?php echo htmlentities($login_email); ?>" autocomplete="off"  />
				  <label class="control-label" for="password">Password <span class="required">*</span></label>
				  <input class="form-control input-lg " name = "password"  id="password" type="password" data-required= "true" data-minlength="[6]" data-maxlength="[15]" maxlength="15" autocomplete="new-password"/>
				  <label class="required" >
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
					<button id="log-in" class="btn btn-orange form-control input-lg marginbtm0" type="submit" name="yt0" value="Log In" />Log In
				   </button>
					<div class="clear"></div>
					  <div class="text-right"> <a href="#item3" class="scrollDivSlide pull-right m-t-xs fpassword back"><small> Forgot password?</small></a></div>
					   
				</div>
				  
					<div class="clear"></div>
					<div class="line-dashed "></div>
								
					<div><p class="firstuser">First-time user, register here.</p></div>
					<div>  <a href="#item2" class="scrollDivSlide btn btn-primary form-control input-lg"><small>Registration  </small></a></div>
				  
				<!-- <div class="line line-dashed"></div> -->
			  </div>
						
			  </section>
			  </div> 
			   <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 mobileHideShow"> 
				<section class="wrapper-xl">
				  <div class="panel-body ">
					<div class="text-left" style="margin-bottom: 60px;">
					 <h1 class="bannerHeading">&nbsp; </h1>
				  <p class="align-just subPara">&nbsp;</p>
					 
					<!-- <div class="line line-dashed"></div> -->
					</div>
				  </div>
				</section>
			  </div>
			  </form>
   </section>
		</div>
		<!--	end login-->
	<!--		start  Registration-->
		<div id="item2" class="item">
		 <section id="contentReg" class="content container m-t-lg wrapper-md  make-center full-width ">
      <form id="reg-form" class="login-form" name="reg-form" action="./pages/helpers/submitUser.php"  method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="registration_form" value="1">
	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1 paddLeft0"></div>
       <div class="col-md-9 col-sm-12 col-xs-12">
                      
        <section>
        <div class="panel-body loginpanel wrapper-x2 loginBg">
          <p class="student-title">  Registration </p>
          <p> 
         
          </p> 
		   
		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
                        <label class="control-label" for="firstname">First Name <span class="required">*</span></label>
                        <input class="form-control input-lg width80" name='firstname' id="firstname" type="text" placeholder="First Name" data-required= "true" value="<?php echo $firstname?>" maxlength="50" autocomplete="first-name"/>
		  </div> 
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
		  <label class="control-label" for="last_name">Last Name <span class="required">*</span></label>
          <input class="form-control input-lg width80" name = 'lastname' id="last_name" type="text" placeholder="Last Name" data-required= "true" value="<?php echo $lastname?>" maxlength="50" autocomplete="last-name"/> 
		  </div>  <div class="clear"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
		  <label class="control-label" for="mobile">Mobile <span class="required">*</span></label>
          <input class="form-control input-lg width80" name='mobile' id="mobile" type="text" placeholder="+91-" data-required= "true"  maxlength="10" data-type="phone" value="<?php echo $mobile?>" autocomplete="user-mobile" />
		   </div> 
		   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
		  <label class="control-label" for="email">Email <span class="required">*</span></label>
          <input class="form-control input-lg width80" name='email' id="email" type="text" placeholder="abc@example.com" data-required= "true" data-type="email" value="<?php echo $email?>"  maxlength="50" onblur="return checkDuplicateEmail(this.value);" autocomplete="new-email" />
		 </div>
		 <div class="clear"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
          <label class="control-label" for="password">Password <span class="required">*</span></label>
          <input class="form-control input-lg width80" name = "password" id="LoginForm_password" placeholder="" type="password" data-required= "true"  data-minlength="[6]" data-maxlength="[15]" maxlength="15" value="<?php //echo $password?>" autocomplete="new-password"/>
		   </div> 
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
          <label class="control-label" for="cpassword">Confirm Password <span class="required">*</span></label>
          <input class="form-control input-lg width80" name="cpassword" id="LoginForm_password" placeholder=""  data-equalto="#LoginForm_password" data-required= "true" type="password" data-minlength="[6]" data-maxlength="[15]" maxlength="15"  value="<?php //echo $password?>"/>
		   </div> 

    
   
          
      <div class="clear"></div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddLeft0">
          
            <label style="margin-bottom:0px;">  <input type="text" name = "client_id" hidden value="5">
					      <input type="text" name = "bundle_id" hidden value = 'demo-b2c'>
						  <input type="text" name = "order_id" hidden value = 'SignUp'>
            <input type="checkbox" id="checkbox-1-1" name="checkbox-1-1" class="regular-checkbox" onclick="checkShow(this.id,'checkbox-2-2');">
            <label id="terms-conds-label" for="checkbox-1-1"></label>
           <span class="check"></span> </label>
            <span class="remember">I agree to the  <a href="javascript:void(0)" onClick="termPopup();"  class="text-info" >Terms of Service </a></span>
          
		<div class="text-left">
            <button id="registration" disabled="disabled" class="btn btn-orange form-control input-lg btnDisable width80 marginbtm0" type="submit" name="yt0" value="Registration" />
            Registration   
        </div> 
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
             
         </div>
        <!-- <div class="line line-dashed"></div> -->
     
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddLeft0">
	  &nbsp;
       
         </div> </div>
        <!-- <div class="line line-dashed"></div> -->
   
      </section>
     
       <div class="bgarrowReg"> <a id="login-a" href="#item1" class="scrollDivSlide m-t-xs back">
                                <div class="bgarrowCircle"><i class="fa fa-arrow-left"></i></div></a>
                            <div class="text"><small>Back to Login </small></div>
                        </div>
	 </div></form>
	  
    </section>  
			
		</div>
		<!--	end Registration-->
		<!--		start  forget-->
		<div id="item3" class="item">
			<section id="contentForget" class="content container m-t-lg wrapper-md make-center full-width">
			<form id="forget-form" class="login-form" name="forget-form" action="./pages/helpers/forgot-password.php" method="post" data-validate="parsley" autocomplete="off">

      <div class="col-sm-8 col-xs-12 margonTop30 mobileHideShow">
        <section>
          <div class="panel-body ">
            <div class="text-left" style="margin-bottom: 60px;">
             <h1 class="bannerHeading">Lorem Ipsum </h1>
				<p class="align-just  subPara">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.  <br>
              <br></p>
             
            <!-- <div class="line line-dashed"></div> -->
			</div>
          </div>
        </section>
      </div>
      <div class=" col-sm-4 col-xs-12">
           <section>
          
        <div class="panel-body loginpanel wrapper-xl  loginBg loginDiv">
           <p> 
             
            </p>    
            
          <p class="student-title"> Forgot password</p>
          <p>
		  Enter your email address. Login credentials will be sent on your registered email address.</br>
            </br>
          </p>
       
          <label class="control-label" for="forgot_password">Email <span class="required">*</span>
		  </label>
          <input class="form-control input-lg " name="userEmailId" id="userEmailId" type="email"  data-required= "true" data-type="email"  maxlength="50"/>
		  <label class="required" id="userError">  
		  <?php
				if ($fp_err_msg != '') {
					echo '<span class="err">' . $fp_err_msg . '</span>';
				} else if ($fp_success_msg != '') {
					echo '<span class="text-success">' . $fp_success_msg . '</span>';
				}
				?>
		  </label>
          
		<div >
            <button class="btn btn-orange form-control input-lg marginbtm0" type="submit" name="yt0" value="Send" onclick="showOrHideLoader('forget-form');" ondblclick="showOrHideLoader('forget-form');" />Send</button>  </div>
			   
			  <div class="clear"></div>
			<div><p class="firstuser">&nbsp;</p></div>
			<div class="line-dashed "></div>
			<div><p class="firstuser">&nbsp;</p></div>
		<div>  <a href="#item2" class="scrollDivSlide btn btn-primary form-control input-lg "><small>Registration  </small></a>
		<div class="clear text-center">
		<div class="smallArrowBg">
                            <a href="#item1" class="scrollDivSlide m-t-xs back"> <div class="smallArrowCircle"> <i class="fa fa-arrow-left"></i></div></a>
                            <div class="text"><small>Back to Login </small></div>
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
<div class="col-md-12 text-center">
<div class="demoArrowBg"> <a href="#divderMBottom20" class="scrollDivSlide m-t-xs back"> <div class="demoArrowCircle"> <i class="fa fa-angle-down"></i></div></a>
   </div>.                        
                        </div>
<div class="page-block" >
	<div class="border-holder" style="margin:0px auto; padding:0px 20px; width:90%">
	<div class="main-votex col-md-12"><!--<div class="divderMTop40"></div>-->
	<div class="col-md-12 widget-container page-element-type-headline widget-headline text-center">
	
<div class="home-sec">
<div class="sec-hd">
				<h2 class="sec-title">Introduction</h2>
				<!--<div class="triangled_colored_separator">
			<div class="triangle"></div>
		</div>-->
		<p>We are the best we know it!</p>
			</div>

</div><div class="divderMBottom20" id="divderMBottom20"></div><div class="divider"></div><div class="divider"></div><div class="divider"></div>
</div>

<div class="col-md-12" >

			
			<div class="demoVideo text-center ">

		<div class="videoDiv" style="
    width: 615px;
    background: #1b1b1e;
    margin: 0px auto;
       height: 385px;
    top: 35px;
    position: relative;padding-top: 20px;">
		<video controls style="width:610px;">
			  <source src="assets/videos/IntellectualProperty.mp4" type="video/mp4">
			  <source src="images/intro.mp4" type="video/ogg">
			Your browser does not support the video tag.
		</video></div>
	<div class="clear"></div>			

 
  </div>	
</div>	



<div class="clear"></div>


</div>


</div>
</div>

<?php include_once 'footer/footer.php';?>
<script type="text/javascript" src="js/jquery.scrollTo.js"></script>
<script>

function checkDuplicateEmail(curEmail){
	if(curEmail != ""){
		$.post("checkEmail.php", {email: curEmail}, function(data){ if(data == 'YeS'){ 
		$("#email").val("");	alert("Email id already exists."); return false; } });
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

	$(window).resize(function () {
		resizePanel();
		resizeimg();
	});
	
});

function resizePanel() {

	width = $(window).width();
	height = $(window).height();
  
	mask_width = width * $('.item').length;
		
	$('#debug').html(width  + ' ' + height + ' ' + mask_width);
		
	$('#wrapper, .item').css({width: width, height: height});
	$('#mask').css({width: mask_width, height: height});
	$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
	
		
}
function resizeimg() {

	width = $(window).width();
	height = $(window).height();
    var head =$(".header").height;
   var wrappHeight= height-120;
	//mask_width = width * $('.item').length;
		
	//$('#debug').html(width  + ' ' + height + ' ' + mask_width);
		
	//$('#wrapper, .item').css({width: width, height: height});
	//$('#mask').css({width: mask_width, height: height});
	//$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
	$('#wrapper').css({width: width, height: wrappHeight+'px'});
	
	$('#wrapper').css('min-height', wrappHeight+'px');
		
}

resizeimg();
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
</script>
<script>
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
<style>



</style>
