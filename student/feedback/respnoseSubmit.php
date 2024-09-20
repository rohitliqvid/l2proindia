<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../../");
exit();
}

include("../../connect.php"); //Connection to database 
include("../global/functions.php"); 
$con=createConnection();


$parentFeedbackId=trim($_POST['feed_id']);
$responseFrom=trim($_POST['feed_from']);


$response=trim($_POST['field']);

$response_by_id=getUserId($_SESSION['sess_uid']);
$dt=date("Y:m:d");



	$query = "INSERT INTO feedback_history(feedback_id,res_description,res_to_id,res_by_id,res_date) VALUES (?,?,?,?,NOW())";
	
		$stmt = $con->prepare($query);
		$stmt->bind_param("isii", $parentFeedbackId, $response,$responseFrom,$response_by_id);
		$stmt->execute();
	    $stmt->close();
		//closeConnection($con);

?>
<script>
alert("Feedback submitted!");
window.close();
</script>

<?
//header("Location:feedback_history.php?fid=".$parentFeedbackId);

?>

