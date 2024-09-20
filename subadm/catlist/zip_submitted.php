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

//$catid=$_REQUEST['catid'];
$docid=$_REQUEST['docid'];
$from_page=$_REQUEST['from_page'];


$choice = $_POST['choice'];
	if ($choice<>"")
	{
		foreach ($choice as $value)
		{ 
		mysql_query("INSERT INTO tbl_courses_links(course_id,file_launch) VALUES('$docid','$value')");
		}
	}

header("Location: document_uploaded.php?docid=$docid");
?>