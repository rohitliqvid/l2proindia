<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../../");
exit();
}

include("../../connect.php"); //Connection to database 



$cp=trim($_GET['cp']);
$tp=trim($_GET['tp']);
$cid=$_REQUEST['cid'];
$cUserId=$_REQUEST['cUserId'];

	$sWidth=trim($_REQUEST['sWidth']);
	$sHeight=trim($_REQUEST['sHeight']);

	$sResize=$_REQUEST['sResize'];
	if($sResize=='on')
	{
	$sResize='1';
	}
	else
	{
	$sResize='0';
	}

	$sScroll=$_REQUEST['sScroll'];
	if($sScroll=='on')
	{
	$sScroll='1';
	}
	else
	{
	$sScroll='0';
	}

	$sDirectory=$_REQUEST['sDirectory'];
	if($sDirectory=='on')
	{
	$sDirectory='1';
	}
	else
	{
	$sDirectory='0';
	}

	$sLocation=$_REQUEST['sLocation'];
	if($sLocation=='on')
	{
	$sLocation='1';
	}
	else
	{
	$sLocation='0';
	}
	
	$sMenubar=$_REQUEST['sMenubar'];
	if($sMenubar=='on')
	{
	$sMenubar='1';
	}
	else
	{
	$sMenubar='0';
	}

	$sToolbar=$_REQUEST['sToolbar'];
	if($sToolbar=='on')
	{
	$sToolbar='1';
	}
	else
	{
	$sToolbar='0';
	}

	$sStatusbar=$_REQUEST['sStatusbar'];
	if($sStatusbar=='on')
	{
	$sStatusbar='1';
	}
	else
	{
	$sStatusbar='0';
	}
	
	
	$result = mysql_query ("SELECT * FROM tbl_user_course_pref WHERE user_id='$cUserId' AND course_id='$cid'"); 
$totalnum=mysql_numrows($result);

if($totalnum)
{

mysql_query("UPDATE tbl_user_course_pref SET win_width='$sWidth',win_height='$sHeight',win_resize='$sResize',win_scroll='$sScroll',win_directory='$sDirectory',win_location='$sLocation',win_menu='$sMenubar',win_tool='$sToolbar',win_status='$sStatusbar' WHERE user_id='$cUserId' AND course_id='$cid'");
}
else
{
mysql_query("INSERT INTO tbl_user_course_pref (user_id,course_id,win_width ,win_height,win_resize,win_scroll,win_directory,win_location,win_menu,win_tool,win_status) VALUES ('$cUserId','$cid','$sWidth','$sHeight','$sResize','$sScroll','$sDirectory','$sLocation','$sMenubar','$sToolbar','$sStatusbar')");
}

header("Location: courses.php");
