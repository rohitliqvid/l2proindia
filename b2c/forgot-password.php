<?php include_once 'header/header.php'; ?>

   
<form id="login-form" class="login-form" name="login-form" action="forgot-password.php" method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off">
<section class="main-votex width100 bannerContainer">
    <section id="content" class=" m-t-lg wrapper-md make-center full-width">
      <div class="col-sm-8 col-xs-12 margonTop30">
        <section>
          <div class="panel-body ">
            <div class="text-left" style="margin-bottom: 60px;">
             <h1 class="bannerHeading">Enhance your career opportunities</h1>
          <p class="align-just">English Edge is the best way to turbo-charge your professional growth. Its purpose oriented approach curates the right kind of courses meant only for you. Our goal-oriented teaching is focussed, practical and specific. <br>
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
              <?php 
                if($err_msg != ''){
                    echo $err_msg;
                }else if($success_msg != ''){
                    echo $success_msg;
                }
                ?>
				  <?php
		if(ISSET($_GET['err_code'])){
		if($_GET['err_code'] == 0){}else{
		echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">�</button><i class="fa fa-ban-circle"></i><strong>Oh snap!</strong>&nbsp;&nbsp;&nbsp;Change username/password and try submitting again.</div>';
		}
		}
		?>
            </p>    
            
          <p class="student-title"> Reset your password</p>
          <p>Enter your email address. Login credentials will be sent on your registered email address.</br>
            </br>
          </p>
       
          <label class="control-label" for="forgot_password">Email <span class="required">*</span></label>
          <input class="form-control input-lg " name="forgotpassword" id="forgotpassword" type="email"  data-required= "true" data-type="email"  maxlength="50"/>
		  <label class="required" ><?php if(isset($_GET['err'])){ echo "Invalid Credntials";} ?></label>
          
		<div >
            <button class="btn btn-orange form-control input-lg marginbtm0" type="submit" name="yt0" value="Send" />Send</button>  </div>
			   
			  <div class="clear"></div>
			<div><p class="firstuser">&nbsp;</p></div><div class="line-dashed "></div><div><p class="firstuser">&nbsp;</p></div>
		<div>  <a href="signup.php" class="btn btn-primary form-control input-lg "><small>Registration  </small></a></div>
		<div class="clear"></div>
			  <div class="text-right "> <a href="index.php" class="pull-left m-t-xs back"><small>Back to Login </small></a></div>
        </div> 
          
         </div>
    </section>
	
	
  </section>
  
  
</form>
</section>

<?php include_once 'footer/footer.php';?>
