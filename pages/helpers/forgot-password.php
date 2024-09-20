<?php 
session_start();
include ("../../connect.php");
 // Connection to database

include ("../../global/functions.php");
include ("phpMailer/mail.php");
// error_reporting(E_ALL);
// ini_set('display_errors',1);

function generate_random_string($name_length=8) {

    //enforce min length 8
    if($len < 8)
        $len = 8;

    //define character libraries - remove ambiguous characters like iIl|1 0oO
    $sets = array();
    $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    $sets[] = '23456789';
    $sets[]  = '~!@#$%^&*(){}[],./?';

    $password = '';
    
    //append a character from each set - gets first 4 characters
    foreach ($sets as $set) {
        $password .= $set[array_rand(str_split($set))];
    }

    //use all characters to fill up to $len
    while(strlen($password) < $len) {
        //get a random set
        $randomSet = $sets[array_rand($sets)];
        
        //add a random char from the random set
        $password .= $randomSet[array_rand(str_split($randomSet))]; 
    }
    
    //shuffle the password string before returning!
    return str_shuffle($password);
}


if(isset($_POST['userEmailId']) && $_POST['userEmailId'] != ""){
	
	//Check for google captcha
	// if(isset($_POST['g-recaptcha-response']))
    //     $captcha=$_POST['g-recaptcha-response'];

    // if(!$captcha){
	// 	$_SESSION['FORGOT_PASSWORD']['ERR'] =4;
	// 	header('Location:../../index.php#item3');
	// 	exit;
    // }

   // $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le_W4kkAAAAAHCi-eK18MwZzGUslBa8FSWjfcqT&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
  
    // if($response['success'] == false)
    // {
	// 	$_SESSION['FORGOT_PASSWORD']['ERR'] =5;
	// 	header('Location:../../index.php#item3');
	// 	exit;
    // }
	
	
	$username = trim($_POST['userEmailId']);
	//$result = mysql_query("SELECT * FROM  tbl_users where email='$username'") or die("1Failed Query of " . mysql_error());
	//$cResult = mysql_fetch_array($result);
	//$id = $cResult['id'];
	//$firstName = ucfirst($cResult['firstname']);
    
	$stmt = $con->prepare("SELECT id,firstname FROM  tbl_users where email=?");
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$stmt->bind_result($id,$firstname);
	$stmt->fetch();
	$stmt->close();	


	if($id){
		$rand = generate_random_string(8);
		$password = md5($rand);
		
		//$query = "UPDATE tbl_users set password = '$password' where id = '$id'";
		//$result = mysql_query($query);

		$query = "UPDATE tbl_users set password = '$password' where id =?";
		$stmt = $con->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->close();

		
		
		$subject = "L2Pro India: Password reset notification";
		$message = "Hi $firstName<br><br>Your new password is: $rand <br><br>L2Pro India Team.";
		$status = sendMailer($username, $subject, $message);
		if($status == 'ok'){
			$_SESSION['FORGOT_PASSWORD']['SUCCESS'] = 1;
			
		}else{
			$_SESSION['FORGOT_PASSWORD']['ERR'] = 2;
		}
		
	}
	else{
		$_SESSION['FORGOT_PASSWORD']['ERR'] = 3;
	}
}else{
	  $_SESSION['FORGOT_PASSWORD']['ERR'] = 1;
}	
header('location:../../forget-password.php');
// header('location:../../index.php#item3');
exit;



?>