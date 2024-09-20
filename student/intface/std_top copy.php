<?php
$timeout = 4320;

//Set the maxlifetime of the session
ini_set( "session.gc_maxlifetime", $timeout );

//Set the cookie lifetime of the session
ini_set( "session.cookie_lifetime", $timeout );

session_start();
$s_name = session_name();

//Check the session exists or not
if(isset( $_COOKIE[ $s_name ] )) {
    setcookie( $s_name, $_COOKIE[ $s_name ], time() + $timeout, '/' );

    //echo "Session is created for $s_name.<br/>";
} else {
    header("Location:../../index.php#item1");
	exit;
}

include("../../connect.php"); //Connection to database 
require_once("../../global/functions.php"); //get global function
//if(!$_SESSION['token'])
//{
//header("Location:../../index.php#item1");
//exit();
//}

if (array_key_exists('loginSession',$_COOKIE)) {
    $loginSession =  json_decode($_COOKIE['loginSession']);
    if ($loginSession  && !empty($loginSession)) {
        $_SESSION  = (array) $loginSession;
    }
}

if (!isset($_SESSION['sess_fname'])) 
{
//if the session does not exit, then take the user to login page
header("Location: ../../");
exit();
}else{
  $userid = $_SESSION['sess_uid'];
  $fname = $_SESSION['sess_fname'];
  
}
////validateUserToken($userid,$_SESSION['token']);
$userDtl = getLoggedInUser();
  $perms=$_SESSION['perms'];
if($perms=="1")
	{
		$role='Administrator';
	}
	else
	{
		$role='Learner';
	}

$isUpdaetd=isUserUpdated($userid);
  
////$coursesResult = mysql_query ("SELECT * FROM tls_scorm WHERE coursetype = 'WBT'"); 
////$totalCourses=mysql_numrows($coursesResult);

/* $result = mysql_query ("SELECT firstname, lastname  FROM tbl_users where username='$userid'"); 
$num=mysql_numrows($result);
$fnm=mysql_result($result,0,"firstname");
$lnm=mysql_result($result,0,"lastname"); */



?>
<script>
var isEdit=false;
var docId=-1;

var helpWin=new Array();
helpWin[1]='../help/Help-Home.htm';
helpWin[2]='../help/Help-MyDetails.htm';
helpWin[3]='../help/Help-Users.htm';
helpWin[4]='../help/Help-Companies.htm';
helpWin[5]='../help/Help-CourseCategories.htm';
helpWin[6]='../help/Help-Course.htm';
helpWin[7]='../help/Help-Feedback.htm';

function openLoginHelp()
{
alert("This feature is currently under construction!");
}
</script>

<!DOCTYPE html>
<html  class="bgblue" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>L2Pro India - Learner</title>
<link rel="shortcut icon" type="image/x-icon" href="../../images/Qulacomm.ico" />
<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../../assets/css/animate.css" />
<link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="../../assets/css/font.css" />
<link rel="stylesheet" type="text/css" href="../../assets/css/app.css" />
<link href="../../assets/css/styles.css" rel="stylesheet" type="text/css">
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
<!-- Le fav and touch icons -->

<script src="../../assets/js/jquery.min.js"></script>

	 <!-- Bootstrap -->
  <script src="../../assets/js/bootstrap.js"></script>
  <!--JsAlert --> 
  <script src="../../assets/js/jsAlert/alertify.min.js"></script>
 
 <link rel="stylesheet" href="../../assets/js/jsAlert/alertify.core.css" />
<!--<link rel="stylesheet" href="js/jsAlert/alertify.default.css" id="toggleCSS" />-->
<link rel="stylesheet" href="../../assets/js/jsAlert/alertify.bootstrap.css" />
    <!-- App -->
 <script src="../../assets/js/app.js"></script>
  <script src="../../assets/js/app.plugin.js"></script>
   <script src="../../assets/js/libs/modernizr.js"></script>
    <!-- slim scroll -->
  <script src="../../assets/js/slimscroll/jquery.slimscroll.min.js"></script>
 

  <!-- parsley(Validation) -->
  <script src="../../assets/js/parsley/parsley.min.js"></script>
  <script src="../../assets/js/parsley/parsley.extend.js"></script>
  <!--chart-->

<!-- date Picker --> 
<script src="../../assets/js/datepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="../../assets/js/datepicker/bootstrap-datepicker.css">

  <script src="../../assets/js/common.js?<?php echo date('Y-m-d H'); ?>"></script>
  <SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<script>$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top-200
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
	
	$("#mobileMenuBtn").click(function(){
		$("#mobileMenu").slideToggle();
		
		
	})
	
});

/*document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'complete') {
      setTimeout(function(){
          document.getElementById('interactive');
         document.getElementById('loaderDiv').style.visibility="hidden";
      },1000);
  }
}*/


jQuery(window).load(function() {
 
 jQuery("#preloaderDiv").delay(100).fadeOut();
})


<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->


var imgArray=new Array();
imgArray[0]='../../graphics/Home_Btn.png';
imgArray[1]='../../graphics/MyDetails_Btn.png';
imgArray[2]='../../graphics/Courses_Btn.png';
imgArray[3]='../../graphics/Feedback_Normal.png';
imgArray[4]='../../graphics/Logout_Btn.png';

var imgArrayRoll=new Array();
imgArrayRoll[0]='../../graphics/Home_Roll_Btn.png';
imgArrayRoll[1]='../../graphics/MyDetails_Roll_Btn.png';
imgArrayRoll[2]='../../graphics/Courses_Roll_Btn.png';
imgArrayRoll[3]='../../graphics/Feedback_RollOver.png';
imgArrayRoll[4]='../../graphics/Logout_Roll_Btn.png';

var currentObj='';
var currentTD='';
var totalItems=5;

function menuClick(obj,link)
{
var templast='mrow'+totalItems;
if(obj.id!=templast)
	{
for(i=1;i<=totalItems;i++)
{
	var tempRow=eval("document.getElementById('mrow"+i+"')");
	tempRow.className='menuOff';

	var tempRow=eval("document.getElementById('mIcon"+i+"')");
	tempRow.src=imgArray[i-1];
}

	obj.className='menuClicked'
	currentObj=obj.id

	var tempNo=obj.id.substring(4,obj.id.length);
	var tempImgId=eval('mIcon'+tempNo);
	tempImgId.src=imgArrayRoll[tempNo-1];
	}

	if(link!='')
	{
	parent.ContentPanel.location=link;
	}
}

function menuOver(obj)
{
	obj.style.cursor='hand';
	//alert("obj.id"+obj.id+"currentObj"+currentObj);
	if(obj.id!=currentObj)
	{
	obj.className='menuOn';
	var tempNo=obj.id.substring(4,obj.id.length);
	var tempImgId=eval('mIcon'+tempNo);
	tempImgId.src=imgArrayRoll[tempNo-1];
	
	}
}

function menuOut(obj)
{
	if(obj.id!=currentObj)
	{
	obj.className='menuOff';
	var tempNo=obj.id.substring(4,obj.id.length);
	var tempImgId=eval('mIcon'+tempNo);
	tempImgId.src=imgArray[tempNo-1];
	}
}

function menuStart()
{

document.getElementById("mrow1").className='menuClicked';
currentObj='mrow1';
document.getElementById("mIcon1").src=imgArrayRoll[0];
}

function setState(obj)
{
//if(obj.id!=currentObj)
//	{
	for(i=1;i<=totalItems;i++)
{
	var tempTD=eval("document.getElementById('td"+i+"')");
	tempTD.className='menuTextOff';
}
obj.className='menuTextClicked';
//	}
currentTD=obj.id;
}

function setOverSate(obj)
{
	obj.className='menuTextOn';
}

function setOutSate(obj)
{
//alert("currentObj : "+currentTD);
	if(obj.id!=currentTD)
	{
obj.className='menuTextOff';
	}
}


</script>
  </head>
<body>
<div id="preloaderDiv" class="preloadBg">
    <div id="overlayBlur"></div>
    <div class="preloadDiv"> <img src="../../assets/images/default.svg" class="loadImg text-center"/>
        <div class="loadText">Please wait<span>.</span><span>.</span><span>.</span>
        </div>
    </div>
</div>

<section class="vbox main-votex">
 <header class="header dk navbar">
    <div class="navbar-header"> 
	 <!--<a href="javascript:void(0)" style="cursor: default" class="navbar-brand logImg" data-toggle="fullscreen"><img src="../../assets/images/logo.jpg" class="logo1"><img src="../../assets/images/NLU-logo.jpg" class="logo2"><img src="../../assets/images/CIIPC-Logo.jpg" class="logo3"><img src="../../assets/images/cipam-logo.png	" class="logo4"></a>  -->  

	 <a href="javascript:void(0)" style="cursor: default" class="navbar-brand logImg" data-toggle="fullscreen"><img src="../../assets/images/logonew.png" class="logo1"></a>
    
	   <!-- <a href="javascript:void(0)" style="cursor: default" class="navbar-brand logImg" data-toggle="fullscreen"><img src="../../assets/images/logo.jpg" class="logo1"></a>--> </div>
	
    <ul class="callout nav navbar-nav navbar-right m-n hidden-xs nav-user">
				
      <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span class="thumb-sm avatar pull-left"> 
			<?php if($userDtl['user_pic'] != ""){ ?>
			Welcome <?=ucfirst($fnm)?> <?=ucfirst($lnm)?>! <img src="profile_pic/<?php echo $userDtl['user_pic']; ?>" />
			<?php }else{ ?>
			<img  src="../../assets/images/avatar_default.jpg"> 
			<?php } ?>
	  
	  </span> <span><? echo $_SESSION['sess_fname'];?><?php /*?><?php echo TrimString(ucfirst(strtolower(userdetails($userId)->first_name)),20); ?><?php */?> <b class="caret"></b></span> </a>
        <ul class="dropdown-menu animated fadeInRight">
          <span class="arrow top"></span>
           <!--<li> <a href="changePassword.php">Change Password</a> </li>-->
		    <!-- <li> <a href="../mydtls/mydtls.php">Profile</a> </li>
          <li class="divider"></li>-->
          <li> <a href="#" onClick="call_logout()">Logout</a> </li>
        </ul>
      </li>
    </ul>
  </header>
</section>
<section>
  <section class="hbox stretch">
  
 <aside class="bg-dark lter  hidden-print navTop" id="nav">
      <section class="vbox">
        <section class="w-f scrollable">
          <div class="slimScrollDiv">
            <div class="slim-scroll " data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
              <!-- nav -->
			   <a id="mobileMenuBtn" class="btn btn-link mobileMenuBtn visible-xs "> <i class="fa fa-bars"></i> </a>
			     <nav class="nav-primary mobileMenu" id="mobileMenu" >
				 <ul class="nav" id="yw0">
					<li id="user" class="mobileuser"><span class="thumb-sm avatar pull-left"> 
					<?php if($userDtl['user_pic'] != ""){ ?>
					Welcome <?=ucfirst($fnm)?> <?=ucfirst($lnm)?>! <img src="profile_pic/<?php echo $userDtl['user_pic']; ?>" />
					<?php }else{ ?>
					<img  src="../../assets/images/avatar_default.jpg"> 
					<?php } ?> </span> <span><?php echo $_SESSION['login_user'];?></li>
                  <li id="home"   class="nav home_menu"><a href="../intface/index.php"><span>Home</span></a></li>
					 <li id="myDatailActive" class="nav my_details_menu"><a href="../mydtls/mydtls.php"><span>My Profile</span></a></li> 
					  <li id="coursesActive" class="nav courses_menu"><a href="../catlist/courses.php"><span>Courses</span></a></li>
					   
					    <li id="feedbackActive" class="nav feedback_menu"><a href="../feedback/feedback.php"><span>Feedback</span></a></li>
						
                  <li class="nav"><a href="#" onClick="call_logout()"><span>Logout</span></a></li>
                </ul>
				 </nav>
              <nav class="nav-primary hidden-xs">
             
                <ul class="nav" id="yw0">
				 
                  <li id="home" class="active nav home_menu"><a href="../intface/index.php"><i class="fa fa-home icon"><b class="bg-danger"></b></i><span>Home</span></a></li>
		
				   <!-- <li id="clientActive" class="nav"><a href="#"><i class="fa fa-user icon"><b class="bg-danger"></b></i><span>Clients</span></a></li> -->
					 <li id="myDatailActive" class="nav my_details_menu"><a href="../mydtls/mydtls.php"><i class="fa fa-users icon"><b class="bg-danger"></b></i><span>My Profile</span></a></li> 
					  <li id="coursesActive" class="nav courses_menu"><a href="../catlist/courses.php"><i class="fa fa-edit icon"><b class="bg-danger"></b></i><span>Courses</span></a></li>
					   
					    <li id="feedbackActive" class="nav feedback_menu"><a href="../feedback/feedback.php"><i class="fa fa-question-circle icon"><b class="bg-danger"></b></i><span>Feedback</span></a></li>
						
                  <li class="nav"><a href="#" onClick="call_logout()"><i class="fa fa-times-circle icon"><b class="bg-danger"></b></i><span>Logout</span></a></li>
                </ul>
             
            </div>
            <div class="slimScrollBar"></div>
            <div lass="slimScrollRail"></div>
          </div>
        </section>
      </section>
    </aside> 
<section id="content" class="rightside rightContenBg">

  <div class="scrollable courseCountBg">  
			  <span class="font-bold padder attemptedSessionDiv" >
				

				<!--<span class="attemptedSession strong" id="attemptedSession"><?php echo $totalCourses;?></span>
                <span class="h5">Course</span> -->
				
				
				</span></div>
