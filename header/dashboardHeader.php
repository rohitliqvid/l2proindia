<?php
session_start();
//$user_fname=$_SESSION['sess_fname'];
$user_email=$_SESSION['login_user'];
include ("../../../connect.php");
include ("../../../global/functions.php");
include('../helpers/lock.php');
$currentDate=Date('m-d-Y');
//echo $currentDate;
$totalCourses=getTotalCoursesForUser($_SESSION['login_user']);
$totalSessions=$totalCourses*57;
$totalSessions=getTotalChaptersForUser($_SESSION['login_user']);
//echo $totalCourses;
$userDtl = getLoggedInUser();
?>
<!-- mid section -->
<?php
if($_SESSION['isLogin'])
{
?>
<script>
mixpanel.track(
	"Login",
	{"Username": "<?php echo $user_email;?>",
	"Date": "<?php echo $currentDate;?>"
	}

);
</script>

<?php
unset($_SESSION['isLogin']);
}
?>
<!DOCTYPE html>
<html class="js no-touch no-android no-chrome firefox no-iemobile no-ie no-ie10 no-ie11 no-ios" style="" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/vnd.microsoft.icon" />
<title>Dashboard</title>
<meta name="language" content="en">
<link rel="stylesheet" type="text/css" href="../../css/dashboard/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../css/animate.css">
<link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../css/font.css">
<link rel="stylesheet" type="text/css" href="../../css/dashboard/app.css">
<link rel="stylesheet" type="text/css" href="../../css/dashboard/style.css">
<link rel="stylesheet" type="text/css" href="../../css/loader.css">
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<!-- Le styles -->

<script src="../../js/jquery.min.js"></script>
<!-- Bootstrap -->
		
		 <!-- Bootstrap -->
  <script src="../../js/bootstrap.js"></script>
   <!--JsAlert --> 
  <script src="../../js/jsAlert/alertify.min.js"></script>
 
 <link rel="stylesheet" href="../../js/jsAlert/alertify.core.css" />
<!--<link rel="stylesheet" href="js/jsAlert/alertify.default.css" id="toggleCSS" />-->
<link rel="stylesheet" href="../../js/jsAlert/alertify.bootstrap.css" />

    <!-- App -->
 <script src="../../js/app.js"></script>
  <script src="../../js/app.plugin.js"></script>
   <script src="../../js/libs/modernizr.js"></script>
    <!-- slim scroll -->
  <script src="../../js/slimscroll/jquery.slimscroll.min.js"></script>
 

  <!-- parsley(Validation) -->
  <script src="../../js/parsley/parsley.min.js"></script>
  <script src="../../js/parsley/parsley.extend.js"></script>
  <!--chart-->

<!-- date Picker --> 
	 <script src="../../js/datepicker/bootstrap-datepicker.js"></script>
	   <link rel="stylesheet" href="../../js/datepicker/bootstrap-datepicker.css">
	
       <script type="text/javascript">		
	   
	  
	  $(function () {
			  $("#divBirthDate").datepicker({ 
					autoclose: true, 
					todayHighlight: true,
					format: 'yyyy-mm-dd'
				})	
			  //}).datepicker('update', new Date()); //// current date auto show
			});
		</script>
	
	

		


  <script src="../../js/common.js?<?php echo date('Y-m-d H'); ?>"></script>
<script>$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top-200
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});
</script>

<script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f)}})(document,window.mixpanel||[]);
mixpanel.init("e3d384cbf2d7235af845fa4217bb2a82");</script><!-- end Mixpanel -->
</head>
<body>
<section class="vbox main-votex">
  <header class="bg-dark header dk navbar navbar-fixed-top-xs fixed">
    <div class="navbar-header bg-dark aside-md" style="height : 85px; bg-color : #444444;border-bottom: 1px solid #c3c3c3; outline-bottom : #ffffff solid 10; "> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html"> <i class="fa fa-bars"></i> </a> <a  class="navbar-brand"> <img src="../../assets/images/logo.png"> </a>
     <!-- <p class="navbar-tagline">Analytics &amp; Reporting Dashboard</p>-->
    </div>
	<span class="font-bold padder" style="color:#fff;">
				<span style="font-size:40px;" class="strong" id="totalSession"><?php echo $totalCourses;?></span>
                <span class="h5">Total Courses</span>
				<span style="font-size:40px;padding-left:10px;" class="strong" id="attemptedSession"><?php echo $totalSessions;?></span>
                <span class="h5">Total Chapters</span>
				
				</span>
    <ul class="callout nav navbar-nav navbar-right m-n hidden-xs nav-user">
				
      <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span class="thumb-sm avatar pull-left"> 
			<?php if($userDtl['user_pic'] != ""){ ?>
			<img src="profile_pic/<?php echo $userDtl['user_pic']; ?>" />
			<?php }else{ ?>
			<img  src="../../images/avatar_default.jpg"> 
			<?php } ?>
	  
	  </span> <span style="color:#ffffff;"><?php echo $_SESSION['login_user'];?><?php /*?><?php echo TrimString(ucfirst(strtolower(userdetails($userId)->first_name)),20); ?><?php */?> <b class="caret"></b></span> </a>
        <ul class="dropdown-menu animated fadeInRight">
          <span class="arrow top"></span>
           <!--<li> <a href="changePassword.php">Change Password</a> </li>-->
		   <li> <a href="../customer/profile.php">Profile</a> </li>
          <li class="divider"></li>
          <li> <a href="../helpers/logout.php">Logout</a> </li>
        </ul>
      </li>
    </ul>
  </header>
</section>
<section>
  <section class="hbox stretch">

    <!-- .aside -->
    <aside class="bg-dark lter aside-md hidden-print fixed navTop" id="nav">
      <section class="vbox">
        <section class="w-f scrollable">
          <div class="slimScrollDiv">
            <div class="slim-scroll left-block" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
              <!-- nav -->
              <nav class="nav-primary hidden-xs">
               <!-- <div class="client_box media left-block-heading clearfix" style="padding-top:2px;">
                  <p><span class="adminName"><? echo $_SESSION['login_user'];?><?php /*?><?php echo TrimString(ucfirst(strtolower(userdetails($login_user)->first_name)),20); ?><?php */?></span></p>
                 
                </div>--> <!--<p><span class="panelName">Admin Panel</span></p>-->
                <ul class="nav" id="yw0">
                  <li id="home" class="nav"><a href="index.php"><i class="fa fa-home icon"><b class="bg-danger"></b></i><span>Home</span></a></li>
				  <li id="custCourse" class="nav"><a href="courses.php"><i class="fa fa-edit icon"><b class="bg-danger"></b></i><span>Courses</span></a></li>
				  <li id="fb" class="nav"><a href="feedback.php"><i class="fa fa-question-circle icon"><b class="bg-danger"></b></i><span>Feedback</span></a></li>
                  <li class="nav"><a href="../helpers/logout.php"><i class="fa fa-times-circle icon"><b class="bg-danger"></b></i><span>Logout</span></a></li>
                </ul>
              </nav>
            </div>
            <div class="slimScrollBar"></div>
            <div lass="slimScrollRail"></div>
          </div>
        </section>
      </section>
    </aside>
	
	
	