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
include("../../global/functions.php"); 
$con=createConnection();

$user_rowid=getUserId($userid);
$txtFrom=$_REQUEST['txtFrom'];
$txtTo=$_REQUEST['txtTo'];
$qPart="";
if($txtFrom!="" && $txtTo!="")
{

$fromArr=explode("-",$txtFrom);
$fromDate=$fromArr[2]."-".$fromArr[1]."-".$fromArr[0];

$toArr=explode("-",$txtTo);
$toDate=$toArr[2]."-".$toArr[1]."-".$toArr[0];

$dateclause=" AND user_entry BETWEEN '$fromDate' AND '$toDate' ";
$dateclause1=" AND user_entry BETWEEN '$fromDate' AND '$toDate' ";
}
else
{
$dateclause=" ";
$dateclause1=" ";
}
//echo "SELECT DISTINCT user_id FROM tbl_entry_log ".$dateclause." ORDER BY username ASC";exit;
//echo "SELECT DISTINCT user_id FROM tbl_entry_log ".$dateclause." ORDER BY username ASC";exit;
//echo "sELECT DISTINCT(user_id) as user_id,username FROM tbl_entry_log ".$dateclause." ORDER BY username ASC";
//die();
$result2 = mysqli_query($con,"SELECT DISTINCT(user_id) as user_id,username FROM tbl_entry_log where user_id!='' ".$dateclause."  ORDER BY username ASC"); 
$num=mysqli_num_rows($result2);

$output = "";
$output .= "Name, Total Logins, Last Login Date \n";
$i=0;
while ($row = $result2->fetch_assoc()){

$id = $row['id'];

$username=$row['user_id'];

//echo "SELECT client_name from tbl_client as a, tbl_users as b where a.id=b.client and b.id=$username";
//die();
$resultc = mysqli_query ("SELECT client_name from tbl_client as a, tbl_users as b where a.id=b.client and b.id=$username");

$row2=mysqli_fetch_array($resultc, MYSQLI_ASSOC);

$user_client=$row2["client_name"];

	
$userfullname=getFullNameFromIDMask($username);

$result3 = mysqli_query ($con,"SELECT * FROM tbl_entry_log WHERE user_id=$username".$dateclause1); 
$num3=mysqli_num_rows($result3);

/*$result4 = mysqli_query ("SELECT MAX(id) as id FROM tbl_entry_log where user_id=$username"); 
$num4=mysqli_num_rows($result4);
$row3=mysqli_fetch_array($result4, MYSQLI_ASSOC);

$lastid=$row3["id"];

$result5 = mysqli_query ($comn,"SELECT user_ip, user_entry FROM tbl_entry_log where id=$lastid");

$row4=mysqli_fetch_array($result5, MYSQLI_ASSOC);


$userip=$row4['user_ip'];
$logindate=$row4['user_entry'];
$logindate=parseDate($logindate);*/

$stmt = $con->prepare("SELECT MAX(id) as id FROM tbl_entry_log where user_id=?");
$stmt->bind_param("s",$username);
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();
$lastid=$id;
//echo "-->".$lastid;
//$result5 = mysql_query ("SELECT user_ip, user_entry FROM tbl_entry_log where id=$lastid"); 
//$userip=mysql_result($result5,0,"user_ip");
//$logindate=mysql_result($result5,0,"user_entry");

$stmt = $con->prepare("SELECT user_ip, user_entry FROM tbl_entry_log where id=?");
$stmt->bind_param("i",$lastid);
$stmt->execute();
$stmt->bind_result($user_ip,$logindate);
$stmt->fetch();
$stmt->close();
$logindate=parseDate($logindate);
$output .= ucfirst($userfullname).",".$num3.",".$logindate." \n";
$i++;
}
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=userlog_report_".date('dmY_Hi').".csv;" );
header("Content-Transfer-Encoding: binary");
echo $output;
?>