<?php
session_start();
//session_destroy();
?>
<?php include_once 'header/header.php'; ?>



   
  <section class="main-votex width100 bannerContainer" id="wrapper">
 
	<div id="mask">
<!--	start login-->
		<div id="item1" class="item">
		 <section id="contentLogin" class="content container m-t-lg wrapper-md make-center full-width">
			 <form id="login-form" class="login-form" name="login-form" action="./pages/helpers/login.php"  method = "post" data-validate="parsley" enctype="multipart/form-data" >
			
			  <div class="col-md-8 col-sm-8 col-xs-12 margonTop30">
				<section>
				  <div class="panel-body ">
					<div class="text-left" style="margin-bottom: 60px;">
					 <h1 class="bannerHeading">Enhance your career<br/> opportunities</h1>
				  <p class="align-just subPara">EnglishEdge is the best way to turbo-charge your professional growth. Its purpose oriented approach curates the right kind of courses meant only for you. Our goal-oriented teaching is focussed, practical and specific. </p>
					 
					<!-- <div class="line line-dashed"></div> -->
					</div>
				  </div>
				</section>
			  </div>
			  <div class="col-md-4 col-sm-4 col-xs-12">
				<section>
				  
				<div class="panel-body loginpanel wrapper-xl loginBg">
				  <p class="student-title"> Log In </p>
				  <p> Please login with your username and password.
					</br>
				  </p>
				  <?php $loginmsg = ""; 
				  		if(isset($_GET['err_code']) && $_GET['err_code'] == 101){ 
								$loginmsg = "Your account is deactivated please contact to admin"; 
						}elseif($_GET['err_code'] == 100){
							$loginmsg = "Invalid Credntials"; 
						}
						
					?>		
				  <label class="control-label" for="username">Username <span class="required">*</span></label>
				  <input class="form-control input-lg" name = "username" id="username" type="text" data-required= "true" />
				  <label class="control-label" for="password">Password <span class="required">*</span></label>
				  <input class="form-control input-lg " name = "password"  id="password" type="password" data-required= "true"/>
				  <label class="required" ><?php echo $loginmsg; ?></label>
				
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
			  </form>
   </section>
		</div>
		<!--	end login-->
	<!--		start  Registration-->
		<div id="item2" class="item">
		 <section id="contentReg" class="content container m-t-lg wrapper-md  make-center full-width ">
      <form id="reg-form" class="login-form" name="reg-form" action="./pages/helpers/submitUser.php"  method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="registration_form" value="1">
	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 paddLeft0"></div>
                    <div class="col-md-7 col-sm-7 col-xs-7">
                        <div class="bgarrowReg"> <a id="login-a" href="#item1" class="scrollDivSlide m-t-xs back">
                                <div class="bgarrowCircle"><i class="fa fa-arrow-left"></i></div></a>
                            <div class="text"><small>Back to Login </small></div>
                        </div>
        <section>
        <div class="panel-body loginpanel wrapper-x2 loginBg">
          <p class="student-title"> Registration </p>
          <p> 
         
          </p> 
		   
		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
                        <label class="control-label" for="firstname">First Name <span class="required">*</span></label>
                        <input class="form-control input-lg width80" name = 'firstname' id="firstname" type="text" placeholder="First Name" data-required= "true" value="<?php echo $first_name?>" maxlength="50"/>
		  </div> 
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
		  <label class="control-label" for="last_name">Last Name <span class="required">*</span></label>
          <input class="form-control input-lg width80" name = 'lastname' id="last_name" type="text" placeholder="Last Name" data-required= "true" value="<?php echo $last_name?>" maxlength="50"/> 
		  </div>  <div class="clear"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
		  <label class="control-label" for="mobile">Mobile <span class="required">*</span></label>
          <input class="form-control input-lg width80" name = 'mobile' id="mobile" type="text" placeholder="+91-" data-required= "true"  maxlength="10" data-type="phone" value="<?php echo $mobile?>" />
		   </div> 
		   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
		  <label class="control-label" for="email">Email <span class="required">*</span></label>
          <input class="form-control input-lg width80" name = 'email' id="email" type="text" placeholder="abc@example.com" data-required= "true" data-type="email" value="<?php echo $email?>"  maxlength="50" onblur="return checkDuplicateEmail(this.value);" />
		 </div>
		 <div class="clear"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
          <label class="control-label" for="password">Password <span class="required">*</span></label>
          <input class="form-control input-lg width80" name = "password" id="LoginForm_password" placeholder="" type="password" data-required= "true"  data-minlength="[6]" data-maxlength="[15]" maxlength="15" value="<?php //echo $password?>"  />
		   </div> 
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
          <label class="control-label" for="cpassword">Confirm Password <span class="required">*</span></label>
          <input class="form-control input-lg width80" name="cpassword" id="LoginForm_password" placeholder=""  data-equalto="#LoginForm_password" data-required= "true" type="password" data-minlength="[6]" data-maxlength="[15]" maxlength="15"  value="<?php //echo $password?>"/>
		   </div> 
          
          
      <div class="clear"></div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
          
            <label style="margin-bottom:0px;">  <input type="text" name = "client_id" hidden value = 2>
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
		   <label class="required" ><?php if(isset($_GET['err'])){ echo "Invalid Credntials";} ?></label>
		
         <!-- <a href="forgot-password.php" class="pull-right m-t-xs"><small> Forgot password?</small></a>-->
		<!--   <a href="#item1" class="scrollDivSlide pull-left m-t-xs back"><small>Back to Login </small></a>-->
          </div>  
             
         </div>
        <!-- <div class="line line-dashed"></div> -->
     
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
	  &nbsp;
       
         </div> </div>
        <!-- <div class="line line-dashed"></div> -->
   
      </section>
      </div></form>
	  
    </section>  
			
		</div>
		<!--	end Registration-->
		<!--		start  forget-->
		<div id="item3" class="item">
			<section id="contentForget" class="content container m-t-lg wrapper-md make-center full-width">
			<form id="forget-form" class="login-form" name="forget-form" action="./pages/helpers/forgot-password.php" method="post" data-validate="parsley" autocomplete="off">

      <div class="col-sm-8 col-xs-12 margonTop30">
        <section>
          <div class="panel-body ">
            <div class="text-left" style="margin-bottom: 60px;">
             <h1 class="bannerHeading">Enhance your career <br/>opportunities</h1>
          <p class="align-just  subPara">English Edge is the best way to turbo-charge your professional growth. Its purpose oriented approach curates the right kind of courses meant only for you. Our goal-oriented teaching is focussed, practical and specific. <br>
              <br></p>
             
            <!-- <div class="line line-dashed"></div> -->
			</div>
          </div>
        </section>
      </div>
      <div class=" col-sm-4 col-xs-12">
           <section>
          
        <div class="panel-body loginpanel wrapper-xl  loginBg">
           <p> 
             
            </p>    
            
          <p class="student-title"> Reset your password</p>
          <p>
		  Enter your email address. Login credentials will be sent on your registered email address.</br>
            </br>
          </p>
       
          <label class="control-label" for="forgot_password">Email <span class="required">*</span>
		  </label>
          <input class="form-control input-lg " name="userEmailId" id="userEmailId" type="email"  data-required= "true" data-type="email"  maxlength="50"/>
		  <label class="required" id="userError"><?php if(isset($_GET['err'])){
		  	if($_GET['err'] == 'ok'){
				$msg = "password sent to your email id";
			}elseif($_GET['err'] == 'se'){
				$msg = "Server is busy. Please try again.";
			}elseif($_GET['err'] == 'iu'){
				$msg = "Invalid email id";
			}else{
				$msg = "Something wrong";
			}
		   echo $msg;
		   
		   } ?>
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
  
  

</section>

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

		$('a.scrollDivSlide').removeClass('selected');
		$(this).addClass('selected');
		
		current = $(this);
		
		$('#wrapper').scrollTo($(this).attr('href'), 800);		
		
		return false;
	});

	$(window).resize(function () {
		resizePanel();
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

</script>

<!-- parsley(Validation) -->
<script>
    var term_cond_checked = <?php echo json_encode($term_cond_checked);?>;
    var reg_msg = <?php echo json_encode($reg_msg);?>;
     var reg_status = <?php echo json_encode($reg_status);?>;
     
     $(document).ready(function(){
         
        if( reg_msg != '' ){
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
        
        if(checkbox-1-1 == 1 ){
            $("#checkbox-1-1").prop('checked', true);
            $("#registration").prop('disabled', false);
			$("#registration").removeClass('btnDisable');
        }else{
           $("#registration").prop('disabled', true);
		   $("#registration").addClass('btnDisable');
           $("#checkbox-1-1").prop('checked', false);
        }
        
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
