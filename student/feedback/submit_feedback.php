<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../../");
exit();
}

include("../../connect.php"); //Connection to database 
include("../../global/functions.php"); 
$con=createConnection();

$fromName=getFullName($_SESSION['sess_uid']);

$feedbackCat=trim($_POST['feedbackCat']);
$subject=trim(strip_htmscript($_POST['subject'],'mandatory'));
$description=trim(strip_htmscript($_POST['description'],'mandatory'));
$uploaded_by=getFullName($_SESSION['sess_uid']);
$uploaded_by_id=getUserId($_SESSION['sess_uid']);

$dt=date("Y:m:d");
$f_status='0';


	$query = "INSERT INTO tbl_feedback(f_category,F_SUBJECT, F_DESCRIPTION, F_BY, F_BY_ID, F_DATE, F_STATUS) VALUES (?,?,?,?,?,?,?)";
		$stmt = $con->prepare($query);
		$stmt->bind_param("isssiss", $feedbackCat, $subject,$description,$uploaded_by,$uploaded_by_id,$dt,$f_status);
		$stmt->execute();
	    $stmt->close();
		closeConnection($con);


header("Location:feedback_submitted.php");

?>

