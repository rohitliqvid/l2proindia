<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
include("../../global/functions.php");
include ("../../b2c/pages/helpers/phpMailer/mail.php");
$choice = $_POST['choice'];
$iMonths = $_POST['iMonths'];
echo $userCourseId = trim($_POST['userCourseId']);
$userRowID=getUserId($userCourseId);
$arrCourseNames=array();
$currentUserEmail=getCurrentUserMail($userCourseId);
//echo $currentUserEmail;exit;




$thisTotal = mysql_query ("SELECT course,name from tls_scorm where coursetype='WBT' order by id"); 
$numCourses=mysql_numrows($thisTotal);
$i=0;
while ($i < $numCourses) {
	$course_id=mysql_result($thisTotal,$i,"course");
	$crsName=mysql_result($thisTotal,$i,"name");
	//check if course is already assigned to user or not
	$thisUserCourseCheck = mysql_query ("SELECT * from tbl_b2client where username='$userCourseId' and course_id=$course_id"); 
	$numUserCourseCheck=mysql_numrows($thisUserCourseCheck);
		if(in_array($course_id,$choice))
		{
			if(!$numUserCourseCheck)
			{
			//if not assigned, assign the course to user in b2client
			$bundleCourse=mysql_query("select bundle from tbl_b2client_bundle where bundle_desc='$course_id'");
			$row = mysql_fetch_assoc($bundleCourse);
			//$id = $row['id'];
			$bundle_id=mysql_result($bundleCourse,0,"bundle");

			$curdate = date('Y-m-d');
			$password="password";
			$todayDate = date("Y-m-d");
			$expiryDate = date('Y-m-d', strtotime(date("Y-m-d") . ' + 365 days'));
			$date = date_create();
			$client_id=2;
			$company_id=1;
			$launch_token = md5($client_id . "-" . $userCourseId . "-" . $bundle_id . "-" . $curdate);
			$token = md5($client_id . "-" . $userCourseId . "-" . $course_id . "-" . $curdate);
			
			$assignCourse=mysql_query("INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$userCourseId','$password','$token','$launch_token','SignUp' , '$bundle_id','$course_id','$todayDate','$expiryDate' , '0')");
			array_push($arrCourseNames,$crsName);
			}
			
		}
		else
		{
			
			//if($numUserCourseCheck)
			//{
			//if assigned, unassign the course from user in b2client
			mysql_query("DELETE FROM tbl_b2client where username='$userCourseId' and course_id=$course_id");
			//remove the tracking data for user - course from tls_sco_scorm_tracking
			mysql_query("DELETE FROM tls_scorm_sco_tracking WHERE where userid=$userRowID and scorm_id=$course_id");
			//}
			
		}
	$i++;
}
//////////////////////code to extend expiry date//////////////////////
$arrCourseID=array();
$arrExtension=array();
for($m=0;$m<=count($iMonths);$m++)
{
	$arrIMonths=explode("-",$iMonths[$m]);
	array_push($arrCourseID,trim($arrIMonths[0]));
	array_push($arrExtension,trim($arrIMonths[1]));
}
for($n=0;$n<=count($arrCourseID);$n++)
{
	$thisUserCourseCheck1 = mysql_query ("SELECT * from tbl_b2client where username='$userCourseId' and course_id=$arrCourseID[$n]"); 
	$numUserCourseCheck1=mysql_numrows($thisUserCourseCheck1);
	if($numUserCourseCheck1)
	{
	$expiry_date=mysql_result($thisUserCourseCheck1,0,"expiry_date");
	$expiry_date = strtotime($expiry_date);
	$new_expiry_date = $expiry_date+(2635200 * $arrExtension[$n]);
	$new_expiry_date = date("Y-m-d H:i:s", $new_expiry_date);
	$updateCourse=mysql_query("update tbl_b2client set expiry_date='$new_expiry_date' where username='$userCourseId' and course_id=$arrCourseID[$n]");
	}
}
//////////////////////code to extend expiry date//////////////////////
//echo $currentUserEmail;
//print_r($arrCourseNames);exit;
if(count($arrCourseNames)>0)
{
//Mail code here
$strCourses=implode(",",$arrCourseNames);
$subject = "Course Assigned";
$message = "Dear User, Following course(s) are assigned to you: $strCourses";
$mailStatus = sendMailer($currentUserEmail, $subject, $message);
}

header("Location: userlist.php");
exit;
?>