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

$con=createConnection();

if($_REQUEST['action'] == "chkMail")
{
	
	
	$query4 = "SELECT * FROM tbl_users where email='".$_REQUEST['val']."'";
	$totalresult = mysqli_query($con,$query4);
	$totalnum1=mysqli_num_rows($totalresult);

	
	//$result1 = mysql_query ("SELECT * FROM tbl_users where email='".$_REQUEST['val']."'"); 
	//$totalnum1=mysql_numrows($result1);

	if($totalnum1)
	{
	echo "1";
	}
	else
	{
	echo "0";
	}

}

if($_REQUEST['action'] == "chkMyMail")
{
	
	
	$query4 = "SELECT * FROM tbl_users where email='".$_REQUEST['val']."' and username<>'".$userid."'";
	$totalresult = mysqli_query($con,$query4);
	$totalnum1=mysqli_num_rows($totalresult);

	//$result1 = mysql_query ("SELECT * FROM tbl_users where email='".$_REQUEST['val']."' and username<>'".$userid."'"); 
	//$totalnum1=mysql_numrows($result1);

	if($totalnum1)
	{
	echo "1";
	}
	else
	{
	echo "0";
	}

}

if($_REQUEST['action'] == "chkUserMail")
{
	
	
	$query4 = "SELECT * FROM tbl_users where email='".$_REQUEST['val']."' and username<>'".$_REQUEST['usid']."'";
	$totalresult = mysqli_query($con,$query4);
	$totalnum1=mysqli_num_rows($totalresult);

	//$result1 = mysql_query ("SELECT * FROM tbl_users where email='".$_REQUEST['val']."' and username<>'".$_REQUEST['usid']."'"); 
	//$totalnum1=mysql_numrows($result1);

	if($totalnum1)
	{
	echo "1";
	}
	else
	{
	echo "0";
	}

}

if($_REQUEST['action'] == "checkUserId")
{
	
	$query4 = "SELECT * FROM tbl_users where username = '".trim($_REQUEST['curId'])."'";
	$totalresult = mysqli_query($con,$query4);
	$totalnum1=mysqli_num_rows($totalresult);
	//$result1 = mysql_query ("SELECT * FROM tbl_users where username = '".trim($_REQUEST['curId'])."'"); 
	//$totalnum1=mysql_numrows($result1);

	if($totalnum1)
	{
	echo "YeS";
	}
	else
	{
	echo "nO";
	}

}
closeConnection($con);		
?>
