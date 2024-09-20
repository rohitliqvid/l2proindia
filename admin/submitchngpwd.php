<?
session_start();
$uid=$_SESSION['sess_uid'];
include("connect.php"); 
$newPwd=$_POST['newPwd'];
$status='1';
$newPwd=md5($newPwd);
$query ="update tbl_users set password='$newPwd', flag='$status' where username='$uid'";
$result=mysql_query($query);
header("Location: student/intface/index.php");
exit;
?>
