<?php 
session_start();
include ("../../../connect.php");

 // Connection to database

include ("../../../global/functions.php");
include ("phpMailer/mail.php");

if(isset($_POST['userEmailId']) && $_POST['userEmailId'] != ""){
	$username = $_POST['userEmailId'];
	//echo $username;exit;
	//echo "SELECT * FROM  tbl_users where username='$username'";exit;
	$result = mysql_query("SELECT * FROM  tbl_users where username='$username'") or die("1Failed Query of " . mysql_error());
	$cResult = mysql_fetch_array($result);
	
	$id = $cResult['id'];
	if($id){
		$rand = generate_random_string(8);
		$password = md5($rand);
		$query = "UPDATE tbl_users set password = '$password' where id = '$id'";
		$result = mysql_query($query);
		$subject = "Password changed";
		$message = "Hi,\n\nYour new password is: $rand \n\nThanks";
		$status = sendMailer($username, $subject, $message);
		if($status == 'ok'){
			//echo 'password changed';
			header('location:../../index.php?err=ok#item3');
			exit;
		}else{
			header('location:../../index.php?err=se#item3');
			exit;
		}
		
	}else{
		header('location:../../index.php?err=iu#item3');
		exit;
	}
}else{
	header('location:../../index.php?err=sw#item3');
	exit;
}	

function generate_random_string($name_length) {        
	$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';         
	return strtolower(substr(str_shuffle($alpha_numeric), 0, $name_length)); 
}

?>