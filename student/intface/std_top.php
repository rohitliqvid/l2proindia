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

  </head>
<body>


<section class="vbox main-votex">

</section>
<section>
  <section class="hbox stretch">
  

<section id="content" class="rightside rightContenBg">

  
			  <span class="font-bold padder attemptedSessionDiv" >
				

				<!--<span class="attemptedSession strong" id="attemptedSession"><?php echo $totalCourses;?></span>
                <span class="h5">Course</span> -->
				
				
				</span></div>
