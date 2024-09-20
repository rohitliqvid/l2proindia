<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../connect.php");
$qr_code=$_REQUEST['uid'];

if(empty($qr_code))
{
	header("Location: https://l2proafrica.com");
	exit;
}

$con=createConnection();
$stmt = $con->prepare("SELECT user_id,sco_id,level_name,created_date FROM tbl_certificates WHERE qr_code=?");
$stmt->bind_param("s",$qr_code);
$stmt->execute();
$stmt->bind_result($user_id,$sco_id,$level_name,$created_date);
$stmt->fetch();
$stmt->close();	

if(empty($user_id))
{
	echo "Invalid Certificate";
	exit;
}
else {

	$stmt = $con->prepare("SELECT firstname,lastname FROM tbl_users WHERE id=?");
	$stmt->bind_param("s",$user_id);
	$stmt->execute();
	$stmt->bind_result($firstname,$lastname);
	$stmt->fetch();
	$stmt->close();	

	////Get the course name
	$stmt = $con->prepare("SELECT name FROM tls_scorm WHERE id=?");
	$stmt->bind_param("i",$sco_id);
	$stmt->execute();
	$stmt->bind_result($coursename);
	$stmt->fetch();
	$stmt->close();	

	echo "Name: ".$firstname." ".$lastname."<br>";
	echo "Level: ".$level_name."<br>";
	echo "Course: ".$coursename."<br>";
	echo "Date: ". date_format(date_create($created_date), 'jS F Y')."<br>";
	exit;

}
closeConnection($con);
exit;

?>