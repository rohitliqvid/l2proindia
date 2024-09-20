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

function sum_the_time($time1, $time2)
{
    $times = array($time1, $time2);
    $seconds = 0;
    foreach ($times as $time) {
        list($hour, $minute, $second) = explode(':', $time);
        $seconds += $hour * 3600;
        $seconds += $minute * 60;
        $seconds += $second;
    }
    $hours = floor($seconds / 3600);
    $seconds -= $hours * 3600;
    $minutes  = floor($seconds / 60);
    $seconds -= $minutes * 60;
    if ($seconds < 9) {
        $seconds = "0" . $seconds;
    }
    if ($minutes < 9) {
        $minutes = "0" . $minutes;
    }
    if ($hours < 9) {
        $hours = "0" . $hours;
    }
    return "{$hours}:{$minutes}:{$seconds}";
}

$userid = $_REQUEST['uid'];
$userfullname = getFullNameFromID($userid);
$result2 = mysqli_query($con,"SELECT * FROM tls_scorm");
$num = mysqli_num_rows($result2);

$output = "";
$output .= "Module, Number of Logins, Time  Spent \n";
$i = 0;
while ($row = $result2->fetch_assoc()){
    

    $course_id = $row['id'];
    $logins_sql =  mysqli_query($con,"SELECT * FROM `tls_scorm_sco_tracking` WHERE `element` LIKE 'cmi.core.lesson_status' AND value = 'completed' AND scormid = $course_id");
    $logins_number = mysqli_num_rows($logins_sql);


    $spend_time_sql =  mysqli_query($con,"SELECT id,value FROM tls_scorm_sco_tracking WHERE element='cmi.core.total_time' AND scormid=$course_id");

    $total_time  = '00:00:00.00';
    if (mysqli_num_rows($spend_time_sql) > 0) {
        while ($spend_time_row = $spend_time_sql->fetch_assoc()) {
            //print_r();
            $total_time = sum_the_time($total_time, $spend_time_row['value']);
        }
    }
    $output .=  $row['name'].",".$logins_number.",".$total_time."\n"; 
    $i++;
}



header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=module_wise_usage_report_export_".date('dmY_Hi').".csv;" );
header("Content-Transfer-Encoding: binary");
echo $output;



