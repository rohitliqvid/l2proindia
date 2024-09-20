<?php
//$pageSplit=5;
$timeout = 2400;

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

include("../connect.php"); //Connection to database 
include("../../global/functions.php"); //Connection to database
 
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}
//Variable to hold the no of records in which the display is splitted
//$pageSplit=5;
$perms=$_SESSION['perms'];
//$catid=$_REQUEST['id'];
//$currpage=$_REQUEST['currpage'];
//$userCourseId=trim($_REQUEST['uid']);

//include("../global/nocacheofpage.php"); 

////validateUser($userid,'3');

$stmt = $con->prepare("SELECT firstname,lastname FROM tbl_users where username=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$stmt->bind_result($fnm,$lnm);
$stmt->fetch();
$stmt->close();
//$fullname=ucfirst($firstname)." ".ucfirst($lastname);


$stmt = $con->prepare("SELECT count(id) as totalclients FROM tbl_client");
$stmt->execute();
$stmt->bind_result($totalclients);
$stmt->fetch();
$stmt->close();


//$clientsResult = mysql_query ("SELECT * FROM tbl_client"); 
//$totalclients=mysql_numrows($clientsResult);

//$usersResult = mysql_query ("SELECT * FROM tbl_users"); 
//$totalUsers=mysql_numrows($usersResult);

//$coursesResult = mysql_query ("SELECT * FROM tls_scorm WHERE coursetype = 'WBT'"); 
//$totalCourses=mysql_numrows($coursesResult);

$stmt = $con->prepare("SELECT count(id) as totalUsers FROM tbl_users");
$stmt->execute();
$stmt->bind_result($totalUsers);
$stmt->fetch();
$stmt->close();

$stmt = $con->prepare("SELECT count(id) as totalCourses FROM tls_scorm WHERE coursetype = 'WBT'");
$stmt->execute();
$stmt->bind_result($totalCourses);
$stmt->fetch();
$stmt->close();

?>

<?
if($perms=="1")
	{
		$role='Administrator';
	}
	else
	{
		$role='User';
	}
?>
<!DOCTYPE html>
<html  class="bgblue" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="../../images/Qulacomm.ico" />
<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../../assets/css/animate.css" />
<link rel="stylesheet" type="text/css" href="../../assets/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="../../assets/css/font.css" />
<link rel="stylesheet" type="text/css" href="../../assets/css/app.css" />
<link href="../../assets/css/styles.css" rel="stylesheet" type="text/css">
 <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
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
	
       <script type="text/javascript">		
	   
	  
	  $(function () {
			  $("#divBirthDate").datepicker({ 
					autoclose: true, 
					todayHighlight: true,
					format: 'yyyy-mm-dd'
				});
			  //}).datepicker('update', new Date()); //// current date auto show
			
			
            $('#divToDate').datepicker({ 
			autoclose: true, 
					todayHighlight: true,
					format: 'dd-mm-yyyy'
					});
					$('#divFromDate').datepicker({ 
			autoclose: true, 
					todayHighlight: true,
					format: 'dd-mm-yyyy'
					})	
        });
		</script>
	<!-- date Picker --> 
	

	

		


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

</script>
  
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

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
       	 <a href="javascript:void(0)" style="cursor: default" class="navbar-brand logImg" data-toggle="fullscreen"><img src="../../assets/images/logo.jpg" class="logo1"><img src="../../assets/images/adams-logo.png" class="logo2"><!--<img src="../../assets/images/CIIPC-Logo.jpg" class="logo3"><img src="../../assets/images/cipam-logo.png	" class="logo4">--></a>
        <!--<a href="javascript:void(0)" style="cursor: default" class="navbar-brand logImg" data-toggle="fullscreen"><img src="../../assets/images/logo.jpg" class="logo1"></a> --> </div>
	
    <ul class="callout nav navbar-nav navbar-right m-n hidden-xs nav-user">
				
      <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <span class="thumb-sm avatar pull-left"> 
			
			
			
	  
	  </span> <span><?php echo $_SESSION['sess_fname'];?><?php /*?><?php echo TrimString(ucfirst(strtolower(userdetails($fnm)),20); ?><?php */?> <b class="caret"></b></span> </a>
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
            <div class="slim-scroll left-block" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
              <!-- nav -->
              <nav class="nav-primary hidden-xs">
             <?php //echo "<pre>"; print_r($_SESSION);
             
             if($_SESSION['sess_uid']=='shruti.malhotra@liqvid.com') { ?>
                  <ul class="nav" id="yw0">
                  <li id="coursesActive" class="nav"><a href="../catlist/waiting_documents.php"><i class="fa fa-edit icon"><b class="bg-danger"></b></i><span>Courses</span></a></li>
					        <li class="nav"><a href="#" onClick="call_logout()"><i class="fa fa-times-circle icon"><b class="bg-danger"></b></i><span>Logout</span></a></li>
                </ul>
             <?php }else{?>
              <ul class="nav" id="yw0">
                  <li id="home" class="nav"><a href="../intface/index.php"><i class="fa fa-home icon"><b class="bg-danger"></b></i><span>Home</span></a></li>
				  <li id="myDatailActive" class="nav my_details_menu"><a href="../mydtls/mydtls.php"><i class="fa fa-users icon"><b class="bg-danger"></b></i><span>My Profile</span></a></li> 
		
				   <!--<li id="clientActive" class="nav"><a href="../client/client.php"><i class="fa fa-user icon"><b class="bg-danger"></b></i><span>Clients</span></a></li>
					 <li id="usersActive" class="nav"><a href="../userlist/userlist.php"><i class="fa fa-users icon"><b class="bg-danger"></b></i><span>Users</span></a></li> -->
					  <li id="coursesActive" class="nav"><a href="../catlist/waiting_documents.php"><i class="fa fa-edit icon"><b class="bg-danger"></b></i><span>Courses</span></a></li>
					   <li id="reportsActive" class="nav"><a href="../reports/index.php"><i class="fa fa-file-o icon"><b class="bg-danger"></b></i><span>Reports</span></a></li>
					    <li id="feedbackActive" class="nav"><a href="../feedback/feedback.php"><i class="fa fa-question-circle icon"><b class="bg-danger"></b></i><span>Feedback</span></a></li>
					    <li id="whatsnew_post" class="nav"><a href="../whatsnew/index.php"><i class="fa fa-newspaper-o icon"><b class="bg-danger"></b></i><span>News Post</span></a></li>
						
                  <li class="nav"><a href="#" onClick="call_logout()"><i class="fa fa-times-circle icon"><b class="bg-danger"></b></i><span>Logout</span></a></li>
                </ul>
            <?php }?>
                
             
            </div>
            <div class="slimScrollBar"></div>
            <div lass="slimScrollRail"></div>
          </div>
        </section>
      </section>
    </aside> 
<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="images/saving.gif" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
  <div class="scrollable" style="background: #12853F;height:80px">  
			  <span class="font-bold padder" style="color:#fff;">
				
				<span style="font-size:40px;padding-left:10px;" class="strong" id="attemptedSession"><?php echo $totalUsers;?></span>
                <span class="h5">Total Users</span>
				<span style="font-size:40px;padding-left:10px;" class="strong" id="attemptedSession"><?php echo $totalCourses;?></span>
                <span class="h5">Total Courses</span>
				<!--<span style="font-size:40px;padding-left:10px;" class="strong" id="attemptedSession"><?php echo $totalSessions;?></span>
                <span class="h5">Total Chapters</span>-->
				
				</span></div>



  
