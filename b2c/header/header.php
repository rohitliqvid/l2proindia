<?php
include ("../connect.php");
?>
<!DOCTYPE html>
<html  class="bgblue" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" style="background-color: #ffffff;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/animate.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/font.css" />
<link rel="stylesheet" type="text/css" href="css/app.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<title>English-Edge SignIn</title>
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
function show(targetId){
$('#'+targetId).slideToggle( "slow" )
}

function launch_content(token) 
{
//alert(token);
var width = 1024;
var height = 768;

var w = width;
var h = height;
var winl = (screen.width-w)/2;
var wint = (screen.height-h)/2;
if (winl < 0) winl = 0;
if (wint < 0) wint = 0;
windowprops = "height="+h+",width="+w+",top="+ wint +",left="+ winl +",location=no,"+ "scrollbars=no,menubars=no,toolbars=no,resizable=no,status=no,directories=no";
path="../../student/catlist/b2demo.php?token="+token;
	var con_window=window.open(path,"win",windowprops);	
	con_window.focus();
}

jQuery(window).load(function() {
 
 jQuery("#preloaderDiv").delay(500).fadeOut();
})
</script>

</head>
<body>
 <div class="blurBg"></div>
<section class="main-votex imgBgHeader">
  <header class="header dk navbar">
    <div class="navbar-header aside-md" style="height : 85px; outline-bottom : #ffffff solid 10;margin-top: 15px; "> 
        <a href="javascript:void(0)" style="cursor: default" class="navbar-brand" data-toggle="fullscreen"><img src="./assets/images/logo.png"></a> </div>
  </header>


    