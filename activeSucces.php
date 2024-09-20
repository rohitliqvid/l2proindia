<?php
@session_start();
$msg=$_SESSION['msg'];
$err=$_SESSION['err'];


if(!isset($_SESSION['msg']) || $_SESSION['msg']==''){
	header('location:index.php');exit;
}


unset($_SESSION['msg']);
unset($_SESSION['err']);
//include ("connect.php");
?>
<?php //echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);?>
<?php //echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>

<!DOCTYPE html>
<html  class="bgblue" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" style="background-color: #ffffff;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/animate.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/font.css" />
<link rel="stylesheet" type="text/css" href="css/app.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<title>L2Pro India</title>
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
<!-- Le fav and touch icons -->

<script src="js/jquery.min.js"></script>
<script src="js/parsley/parsley.min.js"></script>
 <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>

  <script src="js/confirm-bootstrap.js"></script> 
<script src="js/common.js?<?php echo date('Y-m-d H'); ?>"></script>

<script>

</script>

</head>
<body>

<section class="main-votex">
  <header class="header dk navbar">
    <div class="navbar-header"> 
        <a href="javascript:void(0)" style="cursor: default" class="navbar-brand logImg" data-toggle="fullscreen"><img src="./assets/images/logo.jpg" class="logo1"><img src="./assets/images/NLU-logo.jpg" class="logo2"><img src="./assets/images/CIIPC-Logo.jpg" class="logo2">
		<img src="./assets/images/cipam-logo.png	" class="logo2"></a>
	</div>
  </header>
  


    
   
  <section class="main-votex width100 bannerContainer imgBgHeader" id="wrapper">
	<div id="mask">
		<!--	start successful Sign up-->
		<div id="item4" class="item">
		 <section id="contentReg" class="content container m-t-lg wrapper-md  make-center full-width ">
     
    
	  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 paddLeft0"></div>
       <div class="col-md-6 col-sm-6 col-xs-12 padd0 login-form">
                      
       <section class="loginpanel wrapper-xl loginBg">
        <div class="panel-body loginDiv">
          <div class="clear paddTop20 paddBottom20"></div>
          <h4 class="paddTop20 paddBottom20 text-center" style="color:green"> <?php echo $msg;?> </h4> 
		 <div class="clear paddTop20 paddBottom20"></div>
        <div class="clear paddTop20 paddBottom20"></div>
		<div class="clear text-center paddTop20 paddBottom20">
		
		<?php $useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){?>
	
	<h4 style="text-align:center">Go to the App</h4>
<?php }
else{?>

	<a href="index.php" class="btn btn-primary form-control input-lg"><small> Sign in  </small></a>
<?php } ?>                  
              <br>    <br>          </div>
        </div>
        <!-- <div class="line line-dashed"></div> -->
   
      </section>
     </div>
	  
    </section>  
			
		</div>
		<!--	end successful sign up-->

	</div>
  </section>
  

<div class="clear"></div>

<?php include_once 'footer/footer.php';?>
<script type="text/javascript" src="js/jquery.scrollTo.js"></script>

<script>


$(window).resize(function () {
		resizePanel();
		resizeimg();
	});
function resizePanel() {
	width = $(window).width();
	height = $(window).height()
	if(width > 991){
		height = height-20;
		mask_width = width * $('.item').length;
		$('#debug').html(width  + ' ' + height + ' ' + mask_width);
		$('#wrapper, .item').css({width: width, height: height});
		$('#mask').css({width: mask_width, height: height});
		$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
	 }else{
		  if (window.innerHeight > window.innerWidth) {
			console.log("You are now in portrait");
			 height = height-20;

		  } else {
			console.log("You are now in landscape");
			 height = height+160;
			
		  }
		
		mask_width = width * $('.item').length;
		$('#debug').html(width  + ' ' + height + ' ' + mask_width);
		$('#wrapper, .item').css({width: width, height: height});
		$('#mask').css({width: mask_width, height: height});
		$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
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
	}else{
      
	    if (window.innerHeight > window.innerWidth) {
			console.log("You are now in portrait");
			 var wrappHeight= height-120;

		  } else {
			console.log("You are now in landscape");
			 var wrappHeight= height+120;
			
		  }
		//mask_width = width * $('.item').length;
			
		//$('#debug').html(width  + ' ' + height + ' ' + mask_width);
			
		//$('#wrapper, .item').css({width: width, height: height});
		//$('#mask').css({width: mask_width, height: height});
		//$('#wrapper').scrollTo($('a.selected').attr('href'), 0);
		
		$('#wrapper').css({width: width, height: wrappHeight+'px'});
		$('#mask').css({width: width, height: wrappHeight+'px'});
		$('#wrapper').css('min-height', wrappHeight+'px');
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


</script>
