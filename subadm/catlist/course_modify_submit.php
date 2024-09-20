<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}

$perms=$_SESSION['perms'];

include("../connect.php"); //Connection to database 
include("../global/functions.php"); 
		
	$docid=$_REQUEST['docid'];
    
	$cp=trim($_GET['cp']);
	$tp=trim($_GET['tp']);

	$title=trim(strip_htmscript($_REQUEST['title'],'mandatory'));
	$filename=$_REQUEST['filename'];

	
    $desc=trim(strip_htmscript($_REQUEST['desc'],'other'));
	$sWidth=$_REQUEST['sWidth'];
	$sHeight=$_REQUEST['sHeight'];
	

$con=createConnection();	

$query = "UPDATE tls_scorm SET name='$title', summary='$desc', width='$sWidth', height='$sHeight' where id=?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $docid);
$stmt->execute();
$stmt->close();
closeConnection($con);

header("Location: waiting_documents.php?currpage=$cp&totalpg=$tp");
?>