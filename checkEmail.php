<?php
include("../connect.php");

if(isset($_POST['email']) && $_POST['email'] != ""){
	$email = addslashes(trim($_POST['email']));
	$result4 = mysql_query("SELECT id FROM tbl_users WHERE email = '$email' LIMIT 1") or die("check email Query of " . mysql_error());
	$idRes = mysql_fetch_assoc($result4);
	$record = $idRes['id'];
	//echo $record;exit;
	if($record != ""){
		echo "YeS";
	}else{
		echo "nO";
	}
}

?>