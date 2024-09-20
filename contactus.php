<?php
ob_start();
@session_start();
 include_once 'header/header.php'; 

$page_to_show = 'login';

/* if(isset($_POST['contact_name']) && $_POST['contact_name'] != "" && isset($_POST['contact_email']) && $_POST['contact_email'] != "" && isset($_POST['contact_subject']) && $_POST['contact_subject'] != ""){

	$name = $_POST['contact_name'];
	$email = $_POST['contact_email'];
	$subject1 = $_POST['contact_subject'];
	$message = $_POST['contact_msg'];
	//echo "<pre>";print_r($_POST);exit;
     try{	
	    require_once('contact_us_mailer.php');
		$name = '';
		$email = '';
		$subject1 = '';
		$message = '';			 
	 	
	   }//catch exception
		  catch(Exception $e) {
		  echo 'Message: ' .$e->getMessage();exit;
		}

} */
$msg='';
$err='';
$succ='';
//echo "<pre>";print_r($_SESSION);exit;
if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
	if($_SESSION['error'] == '1'){
    $msg= '<label class="required showErr error login_msg_err" id="login_msg_err" >Invalid email address or problem in server</label>';
	}
	if($_SESSION['error'] == '2'){
    $msg = '<label class="required showErr error login_msg_err" id="login_msg_err" >Invalid user</label>';
	}
}
if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
	if($_SESSION['success'] == '1'){
    $msg= '<label class="text-success showErr error login_msg_err" id="login_msg_err" >Your query has been sent to successfully.</label>';
	}
	
}
if(isset($_SESSION['success']) && $_SESSION['success'] != ""){
         
		 $succ=$_SESSION['success'];
		unset($_SESSION['success']);
	
}
if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
		$err=$_SESSION['error'];
		unset($_SESSION['error']);
	
}




?> 
 <section class="main-votex width100 bannerContainer imgBgHeader" id="wrapper">
	<div id="mask">
	<!--		start  Sign up-->
		<div id="item2" class="item">
		 <section id="contentReg" class="content container m-t-lg wrapper-md  make-center full-width ">
      <form id="reg-form" class="login-form" name="reg-form" action="contact_us_mailer.php"  method="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off">
 
	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1 paddLeft0"></div>
       <div class="col-md-8 col-sm-8 col-xs-12 padd0">
                      
        <section>
        <div class="panel-body loginpanel wrapper-x2 loginBg">
          <p class="student-title">  Contact Us </p>
          <p> 
         
          </p> 
		   
		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
           <label class="control-label" for="contact_name">Name <span class="required">*</span></label>
            <input class="form-control input-lg" name='contact_name' id="contact_name" type="text" placeholder="Name" data-required= "true" value="<?php echo $name; ?>" maxlength="50" autocomplete="first-name" data-regexp="^[a-zA-Z ]+$" data-regexp-message="Name should contain characters only." />
		  </div> 
          
        
		   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 paddLeft0">
		  <label class="control-label" for="contact_email">Email (Username) <span class="required">*</span></label>
          <input class="form-control input-lg" name='contact_email' id="contact_email" type="text" placeholder="abc@example.com" data-required= "true" data-type="email" value="<?php echo $email; ?>"  maxlength="50" autocomplete="new-email" />
		 </div>
		 <div class="clear"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddLeft0">
          <label class="control-label" for="contact_subject">Subject <span class="required">*</span></label>
          <input class="form-control input-lg" name = "contact_subject" id="contact_subject" placeholder="Subject" type="text" data-required="true"  maxlength="100" value="<?php echo $subject1; ?>" autocomplete="new-subject"/>
		 
		   </div> 
          
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddLeft0">
          <label class="control-label" for="contact_msg">Message </label>
          <textarea  class="form-control input-lg" name="contact_msg" id="contact_msg" value="" maxlength="1000" tabindex="5" autocomplete="off" style="height:80px; resize: none;"><?php echo $message; ?></textarea>
		  </div> 
          
		  
		  
	
		  <div class="clear"></div>
		 
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddLeft0" style="height: 20px;">	
            <div class="text-left"> 
		 
			<label class="required" id="userError">  
			<?php
				if ($err == '1' || $err == '2' ) {
					echo '<span class="err">' . $msg . '</span>';
				} 
				if($succ=='1'){
					echo '<span class="text-success">' . $msg . '</span>';
				}
				?>
			</label>
		
        </div>   
	</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddLeft0">	
		    <button id="contactSubmit" class="btn btn-orange form-control input-lg marginbtm0" type="submit" name="yt0" value="Submit" />
            Submit
        </div> 
       
             
     
        <!-- <div class="line line-dashed"></div> -->
     
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddLeft0">
	  &nbsp;
       
         </div> </div>
        
   
      </section>
     
       <div class="bgarrowReg"> <a id="login-a" href="index.php" class=" m-t-xs back">
                                <div class="bgarrowCircle"><i class="fa fa-arrow-left"></i></div></a>
                            <div class="text"><small>Back to Sign in </small></div>
                        </div>
	 </div></form>
	  
    </section>  
			
		</div>
		<!--	end Sign up-->
		
		
		
		
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
    });
	$(".input-lg").keypress(function() {
		$("#userError").html('');
    });
	$("#contactSubmit").click(function() {
		$("#userError").html('');
    });
	window.setTimeout(function () {
        $("#userError").fadeTo(1000, 0).slideUp(1000, function () {
            $(this).remove();
        });
    }, 5000);

});   


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


		resizePanel();
		resizeimg();

});


window.onresize = function (event) {
 		resizePanel();
		resizeimg();

}

<!-- parsley(Validation) -->


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

