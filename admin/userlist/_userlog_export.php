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
include("../../global/functions.php"); 
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

$dateclause=" WHERE user_entry BETWEEN '$fromDate' AND '$toDate' ";
$dateclause1=" AND user_entry BETWEEN '$fromDate' AND '$toDate' ";
}
else
{
$dateclause=" ";
$dateclause1=" ";
}
//echo "SELECT DISTINCT user_id FROM tbl_entry_log ".$dateclause." ORDER BY username ASC";exit;
//echo "SELECT DISTINCT user_id FROM tbl_entry_log ".$dateclause." ORDER BY username ASC";exit;
$result2 = mysql_query ("SELECT DISTINCT user_id FROM tbl_entry_log ".$dateclause." ORDER BY username ASC"); 
$num=mysql_numrows($result2);

$output = "";
$output .= "Name, Total Logins, User IP, Last Login Date \n";
$i=0;
while ($i < $num) {
$row = mysql_fetch_assoc($result2);
$id = $row['id'];

$username=mysql_result($result2,$i,"user_id");

$resultc = mysql_query ("SELECT client_name from tbl_client as a, tbl_users as b where a.id=b.client and b.id=$username");

$user_client=mysql_result($resultc,0,"client_name");
	
$userfullname=getFullNameFromID($username);

$result3 = mysql_query ("SELECT * FROM tbl_entry_log WHERE user_id=$username".$dateclause1); 
$num3=mysql_numrows($result3);

$result4 = mysql_query ("SELECT MAX(id) as id FROM tbl_entry_log where user_id=$username"); 
$num4=mysql_numrows($result4);
$lastid=mysql_result($result4,0,"id");

$result5 = mysql_query ("SELECT user_ip, user_entry FROM tbl_entry_log where id=$lastid"); 
$userip=mysql_result($result5,0,"user_ip");
$logindate=mysql_result($result5,0,"user_entry");
$logindate=parseDate($logindate);

$output .= ucfirst($userfullname).",".$num3.",".$userip.",".$logindate." \n";
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