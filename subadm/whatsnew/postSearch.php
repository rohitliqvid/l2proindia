<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
echo "The session is expired. Please re-login!";
exit();
} 

$query3 = "SELECT * FROM tbl_whatsnew_post";
$totalresult = mysqli_query($con,$query3);
$totalnum=mysqli_num_rows($totalresult);

//$totalresult = mysql_query ("SELECT * FROM tbl_whatsnew_post"); 
//$totalnum=mysql_numrows($totalresult);


$query4 = "SELECT id,title,date,status FROM tbl_whatsnew_post ORDER BY id DESC LIMIT $startRecord,$pageSplit";
$result = mysqli_query($con,$query4);
$num=mysqli_num_rows($result);

//$result = mysql_query ("SELECT id,title,date,status FROM tbl_whatsnew_post ORDER BY id DESC LIMIT $startRecord,$pageSplit"); 
//$num=mysql_numrows($result);
?>