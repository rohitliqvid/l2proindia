<?php
/*session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../../");
exit();
}*/

include("../../connect.php"); //Connection to database 
include("../../global/functions.php"); 

//$user_id=getUserId($_SESSION['sess_uid']);
$user_id=$_GET['user_id'];


$query="select count(user_id) from tbl_survey where user_id= $user_id";
$certExists = mysqli_query($con,$query);
$userExists=mysqli_num_rows($certExists);

//$user_exist_qry = mysql_query("select count(user_id) from tbl_survey where user_id= $user_id");
if($userExists >0) {
	//mysql_query("delete from tbl_survey where user_id= $user_id");
	$queryDel="delete from tbl_survey where user_id= $user_id";
	mysqli_query($con,$queryDel);
}
//print_r($user_exist_qry); die;


$dt=date("Y:m:d H:i:s");

if (!empty($_POST) && isset($user_id) ){
	foreach($_POST as $key=>$val){
	$query = "INSERT INTO tbl_survey(user_id,question_no, answer, date_attempted) VALUES ('$user_id','$key','$val','$dt')";
	mysqli_query($con,$query);
}
echo "<h3>Your Survey has been Submitted Successfully.</h3><a href='#' onclick='javascript:top.close();'>Close</a>";
}

$id=mysql_insert_id();


//header("Location:survey_submitted.php");
//close the connection
mysql_close();
?>
<SCRIPT>
setTimeout("self.close()", 5000 ) // after 5 seconds
</SCRIPT>
