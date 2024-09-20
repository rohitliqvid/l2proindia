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
include("../global/functions.php"); 
$user_rowid=getUserId($userid);
$company_id=$_REQUEST['cmbCompany'];
$cmbStatus=$_REQUEST['cmbStatus'];
$qPart="";
if($cmbStatus!="")
{
$qPart=" AND A.userregistered=$cmbStatus ";
}
if($company_id=='all')
{
$query="SELECT * FROM tbl_users as A where username<>'admin' order by A.usertype DESC, A.username ASC";
}
else
{
$query="SELECT * FROM tbl_users AS A, tbl_company_user AS B WHERE A.id=B.user_id AND B.company_id=$company_id ".$qPart." order by A.usertype DESC, A.username ASC";
}
$result = mysql_query ($query); 
$num=mysql_numrows($result);
$output = "";
$output .= "Name, User ID, Role, Email, Status \n";
$i=0;
while ($i < $num) {
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$userrowid=mysql_result($result,$i,"A.id");
$usertype=mysql_result($result,$i,"A.usertype");
$uname=mysql_result($result,$i,"A.username");
$uemail=mysql_result($result,$i,"A.email");
$ustatus=mysql_result($result,$i,"A.userregistered");
if($ustatus=='1')
{
$ustatus="Active";
}
else
{
$ustatus="Inactive";
}
if($usertype=='2')
{
$uRole='Administrator';
}
else
{
$uRole='Learner';
}
$userfullname=getFullNameFromID($userrowid);
$output .= ucfirst(TrimString($userfullname)).",".$uname.",".$uRole.",".$uemail.",".$ustatus." \n";
$i++;
}
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=company_user_report_".date('dmY_Hi').".csv;" );
header("Content-Transfer-Encoding: binary");
echo $output;
?>