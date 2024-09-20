<?php
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
include("../global/functions.php"); //Connection to database 
//echo "<pre>";print_r($_POST);exit;

function mysql_escape_mimic($inp) {

    if(is_array($inp))
    return array_map(__METHOD__, $inp);
    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);

    }
    return $inp;
}

$fstnm=trim(mysql_escape_mimic(strip_htmscript($_POST['fnm'],'other')));

$lstnm=trim(mysql_escape_mimic(strip_htmscript($_POST['lnm'],'other')));
$pwd=trim($_POST['pwd']);
$email=trim(mysql_escape_mimic(strip_htmscript($_POST['cEmail'],'other')));
$uStatus=trim($_POST['uStatus']);
$phone=trim(mysql_escape_mimic(strip_htmscript($_POST['phone'],'other')));
$usernameid=trim(mysql_escape_mimic(strip_htmscript($_POST['usernameid'],'other')));
$client=$_POST['uclient'];

$utype=trim($_POST['utype']);
$userid=$_REQUEST['usid'];
$usid==$_REQUEST['usid'];
$uid=trim($_REQUEST['uid']);


$con=createConnection();
$stmt = $con->prepare("SELECT userregistered,dtenrolled FROM tbl_users where email=? and id<>?");
$stmt->bind_param("si",$email,$_REQUEST['uid']);
$stmt->execute();
$stmt->bind_result($userPrevStatus,$dtenrolled);
$stmt->fetch();
$stmt->close();	

//$result2 = mysql_query ("SELECT * FROM tbl_users where email='".$email."' and id<>'".$_REQUEST['uid']."'"); 
//$totalnum2=mysql_numrows($result2);
//$userPrevStatus=mysql_result($result2,0,"userregistered");
//$dtenrolled=mysql_result($result2,0,"dtenrolled");


if($uStatus=='1')
{
$dtenrolled=date("Y-m-d");
}
else
{
$dtenrolled=$dtenrolled;
}

if($dtenrolled=="")
{
$dtenrolled=date("Y-m-d");
}

if($totalnum2)
{
/*header("Location:usermailexts.php");
exit;*/
}
//update the information

$query = "UPDATE tbl_users SET firstname='$fstnm', lastname='$lstnm', email='$email', userregistered='$uStatus', mobile='$phone', client='$client' where id=?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $_REQUEST['uid']);
$stmt->execute();
$stmt->close();

//mysql_query("UPDATE tbl_users SET firstname='$fstnm', lastname='$lstnm', email='$email', userregistered='$uStatus', mobile='$phone', client='$client' where id='".$_REQUEST['uid']."'");

if($pwd!="")
{
		$pwd=md5($pwd);

		$query2 = "UPDATE tbl_users SET password='$pwd' where id=?";
		$stmt = $con->prepare($query2);
		$stmt->bind_param("s", $_REQUEST['uid']);
		$stmt->execute();
		$stmt->close();

		//mysql_query("UPDATE tbl_users SET password='$pwd' where id='".$_REQUEST['uid']."'");
}


     /*  $query3 = "UPDATE tbl_company_user set company_id=1 where user_id id=?";
		$stmt = $con->prepare($query3);
		$stmt->bind_param("s", $_REQUEST['uid']);
		$stmt->execute();
		$stmt->close();*/
closeConnection($con);
//mysql_query("UPDATE tbl_company_user set company_id=1 where user_id='".$_REQUEST['uid']."'");
//mysql_close();

$_SESSION['msg']='User updated successfully.';
//take the user back to details page
header("Location:userdtls.php?uid=".$uid);
?>

