<?php

session_start();
if (!isset($_SESSION['sess_uid'])) {
	header("Location: ../");
	exit();
} else {
	$userid = $_SESSION['sess_uid'];
}
include("../connect.php"); //Connection to database 
include("../../global/functions.php");


$con=createConnection();
$user_rowid = getUserId($userid);
$crsresult = mysqli_query($con,"SELECT * FROM tls_scorm where coursetype='wbt' ORDER BY id ASC");
$crnum = mysqli_num_rows($crsresult);
$i = 0;
$arr_course = array();
$from_date = '';
$to_date = '';


if (!empty($_REQUEST['from_date'])) {
    $from_date = trim($_REQUEST['from_date']);
}

if (empty($_REQUEST['to_date'])) {
    $to_date = trim($_REQUEST['to_date']);
}

 while ($row = $crsresult->fetch_assoc()){
	
	$id = $row['id'];
	$crssid = $row['id'];
	$crsname = $row['name'];
	$arr_course[] = array('id' => $crssid, 'name' => $crsname);
	$i++;
}
if (isset($_POST['cmbCourse']) && $_POST['cmbCourse'] != "") {

	$crsid = $_POST['cmbCourse'];
	$cmbStatus = $_POST['cmbStatus'];
} else {
	$crsid = $arr_course[0]['id'];
	$cmbStatus = '';
}
$courseName = getCourseNameFromId($crsid);

//echo "cmbStatus: ".$cmbStatus;
$query = "SELECT * FROM tbl_users AS A WHERE A.userregistered='1' AND username<>'admin' " . $qPart . " order by A.usertype DESC, A.username ASC";

$result = mysqli_query($con,$query);
$num = mysqli_num_rows($result);


$i = 0;
$j = 0;

$output .= "Name, Username,Course Status,Time Spent, Completion Date \n";

    while ($row = $result->fetch_assoc()){
	
	$user_data  = $row;
	$id = $row['id'];
	$userrowid = $row['id'];
	$usertype = $row['usertype'];
	$uname = $row['username'];

	$userCourseStatus = getUserCourseStatus($userrowid, $crsid);
	$userCourseTime = getUserCourseTime($userrowid, $crsid);
	$userCourseScore = getUserCourseScore($userrowid, $crsid);


	$userCourseCompletionDate = getUserCompletionDate($userrowid, $crsid);
	$userCourseCompletionDate = $userCourseCompletionDate == '-' ? '00-00-0000' : $userCourseCompletionDate;

	if ($usertype == '2') {
		$uRole = 'Administrator';
	} else {
		$uRole = 'Learner';
	}
	$userfullname = getFullNameFromID($userrowid);

	if ($cmbStatus == 'notattempted' && $userCourseStatus == 'Not Attempted') {
		$visible = '';
		$colorClass = 'style="color:red"';
	} else if ($cmbStatus == 'incomplete' && ($userCourseStatus == 'incomplete' || $userCourseStatus == 'failed')) {
		$visible = '';
		$colorClass = 'style="color:red"';
	} else if ($cmbStatus == 'completed' && ($userCourseStatus == 'completed' || $userCourseStatus == 'passed')) {
		$visible = '';
		$colorClass = 'style="color:green"';
	} else {
		$visible = 'display:none';
		$colorClass = '';
	}

	if ($cmbStatus == "") {
		$visible = '';

		if ($userCourseStatus == 'Not Attempted') {
			$colorClass = 'style="color:red"';
		} else if ($userCourseStatus == 'incomplete' || $userCourseStatus == 'failed') {
			$colorClass = 'style="color:red"';
		} else if ($userCourseStatus == 'completed' || $userCourseStatus == 'passed') {

			$colorClass = 'style="color:green"';
		} else {
			$colorClass = '';
		}
	}
	if ($visible != '') {
		$j++;
	}

	if ($userCourseStatus == 'Passed') {

		$userCourseStatus = 'Completed';
	}

	$course_status_field = ucfirst($userCourseStatus);
	$userCourseTime_text = 'NA';
	if ($userCourseTime != "") {
		$userCourseTime_text  = formatToNewTime($userCourseTime);
	}
	
	if ((!empty($from_date) || !empty($to_date)) && ($userCourseStatus != 'completed' || $userCourseCompletionDate == '00-00-0000')) {
		$i++;
		continue;
	}

	if (!empty($from_date) && strtotime($userCourseCompletionDate) < strtotime($from_date)) {
		$i++;
		continue;
	}

	if (!empty($to_date) && strtotime($userCourseCompletionDate) > strtotime($to_date)) {
		$i++;
		continue;
	}

	$output .= ucfirst(TrimString($userfullname)). ",".TrimString($uname). ",".$course_status_field. ",".$userCourseTime_text . ",".$userCourseCompletionDate. " \n";

	$i++;
}
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=learner_progress_report_" . date('dmY_Hi') . ".csv;");
header("Content-Transfer-Encoding: binary");
echo $output;








exit();
session_start();
if (!isset($_SESSION['sess_uid'])) {
	header("Location: ../");
	exit();
} else {
	$userid = $_SESSION['sess_uid'];
}
include("../connect.php"); //Connection to database 
include("../../global/functions.php");
$user_rowid = getUserId($userid);
//$company_id=getUserCompanyId($user_rowid);
//$crsid=$_REQUEST['crsid'];
$crsid = $_REQUEST['cmbCourse'];

$cmbStatus = $_REQUEST['cmbStatus'];
$courseName = getCourseNameFromId($crsid);
//echo "cmbStatus: ".$cmbStatus;

$query = "SELECT * FROM tbl_users AS A WHERE A.userregistered='1' AND username<>'admin' order by A.usertype DESC, A.username ASC";

$result = mysqli_query($con,$query);
$num = mysqli_num_rows($result);
$output = "";
$output .= "Name, Username, Role, Course Status, Time Spent, Completion Date \n";
$i = 0;
while ($row = $result->fetch_assoc()){
	
	$id = $row['id'];
	$userrowid = $row['id'];
	$usertype = $row['usertype'];
	$uname = $row['username'];
	$userCourseStatus = getUserCourseStatus($userrowid, $crsid);
	$userCourseTime = getUserCourseTime($userrowid, $crsid);
	$userCourseScore = getUserCourseScore($userrowid, $crsid);
	$userCourseCompletionDate = getUserCompletionDate($userrowid, $crsid);

	if ($userCourseCompletionDate == "-") {
		$userCourseCompletionDateFormatted = "-";
	} else {
		$userCourseCompletionDateFormatted = parseDate($userCourseCompletionDate);
	}
	if ($usertype == '2') {
		$uRole = 'Administrator';
	} else {
		$uRole = 'Learner';
	}
	$userfullname = getFullNameFromID($userrowid);
	if ($cmbStatus == 'notattempted' && $userCourseStatus == 'Not Attempted') {
		$visible = '1';
	} else if ($cmbStatus == 'incomplete' && ($userCourseStatus == 'incomplete' || $userCourseStatus == 'failed')) {
		$visible = '1';
	} else if ($cmbStatus == 'completed' && ($userCourseStatus == 'completed' || $userCourseStatus == 'passed')) {
		$visible = '1';
	} else {
		$visible = '0';
	}
	if ($cmbStatus == "") {
		$visible = '1';
	}
	if ($visible == 1) {
		$output .= ucfirst(TrimString($userfullname)) . "," . $uname . "," . $uRole . "," . ucfirst($userCourseStatus) . "," . formatToNewTime(str_replace(".", ":", $userCourseTime)) . "," . $userCourseCompletionDateFormatted . " \n";
	}


	$i++;
}
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=learner_progress_report_" . date('dmY_Hi') . ".csv;");
header("Content-Transfer-Encoding: binary");
echo $output;
