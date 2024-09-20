<?php
session_start();
if (!isset($_SESSION['sess_fname'])) 
{
//if the session does not exit, then take the user to login page
header("Location: ../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}
//Variable to hold the no of records in which the display is splitted
$perms=$_SESSION['perms'];
//$pageSplit=5;


include("../connect.php"); //Connection to database 
include("../global/functions.php"); //Connection to database
 
//include("../global/nocacheofpage.php"); 
$userid = $_SESSION['sess_uid'];
validateUser($userid,'3');

//$result = mysql_query ("SELECT firstname, lastname  FROM tbl_users where username='$userid'"); 
//$num=mysql_numrows($result);
//$fnm=mysql_result($result,0,"firstname");
//$lnm=mysql_result($result,0,"lastname");
	$stmt = $con->prepare("SELECT firstname, lastname  FROM tbl_users where username=?");
	$stmt->bind_param("s",$userid);
	$stmt->execute();
	$stmt->bind_result($fnm,$lnm);
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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Qualcomm - Admin</title>
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
<section>
  <section class="hbox stretch" >
  
