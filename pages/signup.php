<?php
//session_destroy();
session_start();
?>
<?php include_once 'header/header.php'; ?>



   
  <section class="main-votex width100 bannerContainer imgBgHeader" id="wrapper">
 
	<div id="mask">
<!--	start login-->
		<div id="item1" class="item">
		 <section id="contentLogin" class="content container m-t-lg wrapper-md make-center full-width">
		<form id="reg-form" class="login-form" name="reg-form" action="helpers/submitUser.php"  method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="registration_form" value="1">
  <section class="main-votex">
    <section id="content" class="container m-t-lg wrapper-md  make-center full-width loginBg">
      
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section>
        <div class="panel-body loginpanel wrapper-x2">
          <p class="student-title"> Registration </p>
          <p> 
              <?php 
                if($err_msg != ''){
                    echo $err_msg;
                }else if($success_msg != ''){
                    echo $success_msg;
                }else{
                    echo 'Please register with your userid and password. ';
                }
                ?>
				
              </br>
            </br>
			<?php
						if(ISSET($_GET['err_code'])){
						if($_GET['err_code'] == 0){
						
						}
						elseif($_GET['err_code'] == 300){
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><i class="fa fa-check-circle"></i><strong>Oh snap!</strong>&nbsp;&nbsp;&nbsp;Email ID already exists. please try submitting with another email ID. </div>';
				  		}
						else{
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><i class="fa fa-ban-circle"></i><strong>Oh snap!</strong>&nbsp;&nbsp;&nbsp;Change a few things up and try submitting again.</div>';
				  		}
						}
					?>
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
          <input class="form-control input-lg width80" name = 'email' id="email" type="email" placeholder="abc@example.com" data-required= "true" data-type="email" value="<?php echo $email?>"  maxlength="50"/>
		 </div>
		 <div class="clear"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
          <label class="control-label" for="password">Password <span class="required">*</span></label>
          <input class="form-control input-lg width80" name = "password" id="LoginForm_password" placeholder="xxxxxx" type="password" data-required= "true"  data-minlength="[6]" data-maxlength="[15]" maxlength="15" value="<?php echo $password?>"/>
		   </div> 
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
          <label class="control-label" for="cpassword">Confirm Password <span class="required">*</span></label>
          <input class="form-control input-lg width80" name="cpassword" id="LoginForm_password" placeholder="xxxxxx"  data-equalto="#LoginForm_password" data-required= "true" type="password" data-minlength="[6]" data-maxlength="[15]" maxlength="15"  value="<?php echo $password?>"/>
		   </div> 
          
          
      <div class="clear"></div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
          
            <label style="margin-bottom:0px;">  <input type="text" name = "client_id" hidden value = 2>
					      <input type="text" name = "bundle_id" hidden value = 'demo-b2c'>
						  <input type="text" name = "order_id" hidden value = 'SignUp'>
            <input type="checkbox" id="checkbox-1-1" name="checkbox-1-1" class="regular-checkbox">
            <label id="terms-conds-label" for="checkbox-1-1"></label>
           <span class="check"></span> </label>
            <span class="remember">I agree to the  <a href="#" class="text-info" >Terms of Service </a></span>
          
		<div class="text-left">
            <button id="registration" disabled="disabled" class="btn btn-orange form-control input-lg btnDisable width80 marginbtm0" type="submit" name="yt0" value="Registration" />
            Registration   
        </div> <label class="required" ><?php if(isset($_GET['err'])){ echo "Invalid Credntials";} ?></label>
         <div class="text-center"> 
		   
		
         <!-- <a href="forgot-password.php" class="pull-right m-t-xs"><small> Forgot password?</small></a>-->
		   <a href="../index.php" class="pull-left m-t-xs back"><small>Back to Login </small></a>
          </div>  
             
         </div>
        <!-- <div class="line line-dashed"></div> -->
      </div>
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
	  &nbsp;
       
         </div>
        <!-- <div class="line line-dashed"></div> -->
     
      </section>
      </div>
    </section>
  </section>
</form>
<!-- parsley(Validation) -->
   </section>
		</div>
		<!--	end login-->

	 
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
            console.log('dkfjhskdjfhksdhfkshdfhdsk');
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
</script>

  <!-- Bootstrap -->
  <script src="../js/bootstrap.js"></script>
  
  <script src="../js/confirm-bootstrap.js"></script> 
<script src="../js/common.js?<?php echo date('Y-m-d H'); ?>"></script>
<style>



</style>
