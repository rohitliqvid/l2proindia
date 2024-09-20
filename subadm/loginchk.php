<?php
session_start();
include("connect.php"); 
include("global/functions.php");

$uid=trim($_POST['uid']);
$pwd=trim($_POST['pwd']);
$pwd=md5($pwd);

$query1="select * from tbl_users where username=\"" .$uid."\" and password=\"".$pwd."\"";
//echo $query1;
//exit;
$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1); 
$thisrow=mysql_fetch_row($result1);
if ($thisrow)  
{

	$query2="select * from tbl_users where username=\"" .$uid."\" and password=\"".$pwd."\""; 
	$result2 = mysql_db_query($database, $query2) or die("Failed Query of " . $query2); 
	$userid = mysql_result($result2,0,"id");
	$fstname = mysql_result($result2,0,"firstname");
	$utype = mysql_result($result2,0,"usertype");
	$usertype = mysql_result($result2,0,"usertype");
	$uregistered = mysql_result($result2,0,"userregistered");
	$dtenrolled  = mysql_result($result2,0,"dtenrolled");
	$flag = mysql_result($result2,0,"flag");
	$logged = mysql_result($result2,0,"logged");
	
	if($logged=='no')
		{
			mysql_query("update tbl_users set logged='yes' where id='$userid'");
		}
	

	if($utype=='0')
	{
		$dateDiff=getDateDiff($dtenrolled);
		$userCompanyId=getUserCompanyId($userid);
		$companyExpiry=getCompanyExpiry($userCompanyId);
		if($dateDiff>=$companyExpiry)
		{
		//	echo "here";
	
		//exit;
		
		//echo "update tbl_users set userregistered='0' where id=$userid";
		mysql_query("update tbl_users set userregistered='0' where id=$userid");
		header("Location: notregst.php");
		exit;
		}
	}


	$_SESSION['sess_fname'] = $fstname;
	$_SESSION['sess_uid'] = strtolower(trim($uid));
	
	$_SESSION['perms'] = $usertype;

	if ($utype=='1' && $uregistered=='1')
	{
	//echo "here";exit;
	$curdate=date('Y-m-d');
	$userip=$_SERVER['REMOTE_ADDR'];
	$query2="select id from tbl_users where username='$uid'"; 
	$result2 = mysql_db_query($database, $query2) or die("Failed Query of " . $query2); 
	$usRowId = mysql_result($result2,0,"ID");
	mysql_query("INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES ('$uid', $usRowId, '$userip','$curdate')");
	header("Location: intface/index.php");
	exit;
	}

	if ($utype=='2' && $uregistered=='1')
	{
	$curdate=date('Y-m-d');
	$userip=$_SERVER['REMOTE_ADDR'];
	$query2="select id from tbl_users where username='$uid'"; 
	$result2 = mysql_db_query($database, $query2) or die("Failed Query of " . $query2); 
	$usRowId = mysql_result($result2,0,"ID");
	mysql_query("INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES ('$uid', $usRowId, '$userip','$curdate')");
	header("Location: compadm/intface/index.php");
	exit;
	}

	if ($utype=='0' && $uregistered=='1' && $flag=='0')
	{
	$curdate=date('Y-m-d');
	$userip=$_SERVER['REMOTE_ADDR'];
	$query2="select id from tbl_users where username='$uid'"; 
	
	$result2 = mysql_db_query($database, $query2) or die("Failed Query of " . $query2); 
	$usRowId = mysql_result($result2,0,"ID");
	mysql_query("INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES ('$uid', $usRowId, '$userip','$curdate')");
	header("Location: chngpswd.php");
	exit;
	}

	if ($utype=='0' && $uregistered=='1' && $flag=='1')
	{
	$curdate=date('Y-m-d');
	$userip=$_SERVER['REMOTE_ADDR'];
	$query2="select id from tbl_users where username='$uid'"; 
	
	$result2 = mysql_db_query($database, $query2) or die("Failed Query of " . $query2); 
	$usRowId = mysql_result($result2,0,"ID");
	mysql_query("INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES ('$uid', $usRowId, '$userip','$curdate')");
	header("Location: student/intface/index.php");
	exit;
	}
}
else
{
session_unregister ($sess_fname); 
session_unregister ($sess_uid);
session_unregister ($perms);
session_destroy (); 
header("Location: index.php");
exit;
}
?>