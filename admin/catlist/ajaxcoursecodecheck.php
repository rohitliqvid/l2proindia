<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}

include("../connect.php"); //Connection to database 

if($_REQUEST['action'] == "chkCode")
{
	$code=$_REQUEST['val'];
	$codequery="select * from tbl_courses where file_code=\"" .$code."\""; 

	$coderesult = mysql_db_query($database, $codequery) or die("Failed Query of " . $codequery); 
	$codenumrows=mysql_numrows($coderesult);

	if($codenumrows)
	{
	echo "1";
	}
	else
	{
	echo "0";
	}

}


if($_REQUEST['action'] == "chkMyCode")
{
	$code=$_REQUEST['val'];
	$myId=$_REQUEST['myId'];
	$codequery="select * from tbl_courses where file_code=\"" .$code."\" AND file_name<>\"" .$myId."\""; 

	$coderesult = mysql_db_query($database, $codequery) or die("Failed Query of " . $codequery); 
	$codenumrows=mysql_numrows($coderesult);

	if($codenumrows)
	{
	echo "1";
	}
	else
	{
	echo "0";
	}

}
?>
