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
include("../global/functions.php"); //Connection to database 
//echo "<pre>";print_r($_POST);exit;
$post_id=$_POST['id'];
//echo "--".$post_id;
$title=strip_htmscript($_POST['title'], 'other');
if(strpos($_POST['description'], "\r\n") !== false){
    $_POST['description']=str_replace("\r\n","<br/>",$_POST['description']);
}
if(strpos($_POST['description'], "'") !== false){
    $_POST['description']=str_replace("'","\'",$_POST['description']);
}
$description= strip_htmscript($_POST['description'], 'other');
$approved=strip_htmscript($_POST['approved'], 'other');
//update the information

//mysql_query("UPDATE tbl_whatsnew_post SET title='$title', description='$description', status='$approved' where id=".$_POST['id']."");
//mysql_close();

	$query = "UPDATE tbl_whatsnew_post SET title='$title', description='$description', status='$approved' where id=?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("i", $post_id);
	$stmt->execute();
	$stmt->close();


$_SESSION['msg']='Post updated successfully.';
//take the user back to details page
header("Location:index.php");
?>