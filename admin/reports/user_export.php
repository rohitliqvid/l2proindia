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
$user_rowid=getUserId($userid);
$cmbStatus=$_REQUEST['cmbStatus'];
$fname=$_REQUEST['fname'];
$userName=$_REQUEST['userName'];
$qPart="";
if($cmbStatus!="")
{
$qPart=" AND A.userregistered=$cmbStatus ";
}

if($fname!="")
{
$qPart.=" AND A.firstname LIKE '%$fname%' or A.lastname LIKE '%$fname%' or CONCAT(A.firstname,  ' ',A.lastname ) LIKE  '%$fname%' ";
}
if($userName!="")
{
$qPart.=" AND A.username LIKE '%$userName%' ";
}

if (!empty($_REQUEST['from_date'])) {
    $from_date = trim($_REQUEST['from_date']);
    $from_date = date('Y-m-d',strtotime($from_date));
    if (!empty($from_date)) {
        $qPart .= " AND DATE(A.dtenrolled) > '$from_date'";
    }
}
if (!empty($_REQUEST['to_date'])) {
    $to_date = trim($_REQUEST['to_date']);
    $to_date = date('Y-m-d',strtotime($to_date));
    if (!empty($to_date)) {
        $qPart .= " AND DATE(A.dtenrolled) < '$to_date'";
    }
}


$con=createConnection();

$query="SELECT * FROM tbl_users as A where username<>'admin' ".$qPart."order by A.dtenrolled DESC";

$result = mysqli_query ($con,$query); 
$num=mysqli_num_rows($result);
$output = "";
$output .= "Id, Name, Email (Username),Mobile,City,State,Pin Code,Occupation,Organization,Designation,Registration Date, Status \n";
$i=0;
 
while ($row = $result->fetch_assoc()){

$id = $row['id'];
$userrowid=$row['id'];
$usertype=$row['usertype'];
$uname=$row['username'];

$mobile = $row['mobile'];
$user_city = $row['user_city'];
$user_state = $row['user_state'];
$zip_code = $row['zip_code'];





$uoccupation=$row['occupation'];
$organization=$row['organization'];
$udesignation=$row['designation'];
$ustatus=$row['userregistered'];
$dtEnrolled=$row['dtenrolled'];

$uoccupation = str_replace(","," ",$uoccupation);
$organization = str_replace(","," ",$organization);
$udesignation = str_replace(","," ",$udesignation);


$newDT=parseDate($dtEnrolled);
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
//$totalCourseAssigned = getUserCourses($uname);
$output .= $userrowid.",".ucfirst(TrimString($userfullname)).",".$uname.",".$mobile.",".$user_city.",".$user_state.",".$zip_code.","               .$uoccupation.",".$uorganization.",".$udesignation.",".$newDT.",".$ustatus." \n";
$i++;
}




header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=users_report_".date('dmY_Hi').".csv;" );
header("Content-Transfer-Encoding: binary");
echo $output;
?>