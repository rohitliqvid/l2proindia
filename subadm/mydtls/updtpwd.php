<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}

include("../../connect.php"); //Connection to database 
include("../../global/functions.php");
$con=createConnection();
$opwd=trim(strip_htmscript($_POST['opwd'],'other'));
$pwd=trim(strip_htmscript($_POST['pwd'],'other'));
$opwd=md5($opwd);
$pwd=md5($pwd);

$stmt = $con->prepare("SELECT id FROM tbl_users WHERE username=? and password=?");
	$stmt->bind_param("ss",$userid,$opwd);
	$stmt->execute();
	
	 $stmt->bind_result($num);
	$stmt->fetch();
	$stmt->close();	


if ($num)  //if the results of the query are not null
{
$query = "UPDATE tbl_users SET password='$pwd' WHERE username=?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("s", $userid);
	$stmt->execute();
	$stmt->close();
	closeConnection($con);

header("Location:chgmsg.php?done=true");
}
else
{
header("Location:chgmsg.php?done=false");
}
?>

