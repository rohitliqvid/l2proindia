<!DOCTYPE html>
<html  class="bgblue" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" style="background-color: #ffffff;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../css/animate.css" />
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="../css/font.css" />
<link rel="stylesheet" type="text/css" href="../css/app.css" />
<link rel="stylesheet" type="text/css" href="../css/common.css" />
<title>English-Edge SignIn</title>
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
<!-- Le fav and touch icons -->

<script src="../js/jquery.min.js"></script>
<script src="../js/parsley/parsley.min.js"></script>

</head>
<body>
<section class="main-votex">
  <header class="header dk navbar">
    <div class="navbar-header aside-md" style="height : 85px; outline-bottom : #ffffff solid 10;margin-top: 15px; "> 
        <a href="javascript:void(0)" style="cursor: default" class="navbar-brand" data-toggle="fullscreen"><img src="../assets/images/logo.png"></a> </div>
  </header>
</section>

   
<form id="login-form" class="login-form" name="login-form" action="forgot-password.php" method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off">
  <section class="main-votex">
    <section id="content" class="container m-t-lg wrapper-md  make-center full-width loginBg">
      <div class="loginaside-xxl border-right-gray col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section>
          <div class="panel-body ">
            <div class="text-left" style="margin-bottom: 60px;">
              <h3 class="m-b-none">Mobile Edge</h3>
              <h5 class="m-b-none" >Create <span>. </span> Authoring <span>. </span> Publish</h5>
            </div>
            <p class="align-just"> Authors leverage the  LIQVID platform to engage with the learner directly <br>
              <br>
              The dashboard and analytics stack is a state of the art tool to user as well as report site, user performance. <br>
            </p>
            <!-- <div class="line line-dashed"></div> -->
          </div>
        </section>
      </div>
      <div class="loginaside-xxl col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section>
        <div class="panel-body loginpanel wrapper-xl ">
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
		echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><i class="fa fa-ban-circle"></i><strong>Oh snap!</strong>&nbsp;&nbsp;&nbsp;Change username/password and try submitting again.</div>';
		}
		}
		?>
            </p>    
            
          <p class="student-title"> Reset your password</p>
          <p>Enter your email address. Login credentials will be sent on your registered email address.</br>
            </br>
          </p>
       
          <label class="control-label" for="forgot_password">Email <span class="required">*</span></label>
          <input class="form-control input-lg width80" name="forgotpassword" id="forgotpassword" type="email"  data-required= "true" data-type="email"  maxlength="50"/>
		  <label class="required" ><?php if(isset($_GET['err'])){ echo "Invalid Credntials";} ?></label>
          
		<div >
            <button class="btn btn-orange form-control input-lg width80 marginbtm0" type="submit" name="yt0" value="Send" />Send</button>  </div>
			   
			  <div class="clear"></div>
			<div><p class="firstuser">&nbsp;</p></div><div class="line-dashed width80"></div><div><p class="firstuser">&nbsp;</p></div>
		<div>  <a href="signup.php" class="btn btn-primary form-control input-lg width80"><small>Registration  </small></a></div>
		<div class="clear"></div>
			  <div class="text-right width80"> <a href="../index.php" class="pull-left m-t-xs back"><small>Back to Login </small></a></div>
        </div> 
          
         
        <!-- <div class="line line-dashed"></div> -->
      </div>
      </section>
      </div>
    </section>
  </section>
</form>

 <!-- Bootstrap -->
  <script src="../js/bootstrap.js"></script>
  
  <script src="../js/confirm-bootstrap.js"></script> 
<script src="../js/common.js?<?php echo date('Y-m-d H'); ?>"></script>

</body></html>