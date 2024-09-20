<?php
include ("../../connect.php");
include("phpMailer/mail.php");
$con=createConnection();
//print_r($con);die();
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET")
{
	//username and password sent from Form
	$finalCount = 0; 

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      $userip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $userip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
      $userip=$_SERVER['REMOTE_ADDR'];
    }

	$curdate=date('Y-m-d');
    $myusername=addslashes(trim($_REQUEST['username']));  
	$mypassword=addslashes(trim($_REQUEST['password'])); 
	$md5pass = md5($mypassword);
	$finalCount = getCount($con,$myusername,$md5pass);
	//echo "fcount : ".$finalCount;exit;
	
	
	 
	//$query1="select * from tbl_users where  username=\"" .$myusername."\" and password=\"".$md5pass."\"";
	//$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1); 
	//$thisrow=mysql_fetch_row($result1);

	$stmt = $con->prepare("SELECT id,userregistered,email,usertype,isActive,firstname FROM tbl_users WHERE username=? and password=?");
	$stmt->bind_param("ss",$myusername,$md5pass);
	$stmt->execute();
	
	 $stmt->bind_result($usRowId,$isActive,$user_email_id,$usertype,$isActive1,$firstname);
	$stmt->fetch();
	$stmt->close();	
	if(!empty($usRowId))
	{
//echo $user_email_id;exit;
		/*$isActive = mysql_result($result1,0,"userregistered");
		$usRowId = mysql_result($result1,0,"id");
      	$user_email_id = mysql_result($result1,0,"email");
		$usertype = mysql_result($result1,0,"usertype");
		$isActive1 = mysql_result($result1,0,"isActive");*/
		//echo $isActive;exit;
		if($isActive=="0")
		{
			$_SESSION['LOGIN'] = array();
			$_SESSION['LOGIN']['ERR'] = array();
			$_SESSION['LOGIN']['SUCCESS'] = array();
			$_SESSION['LOGIN']['ERR']['MSG'] = 'Your account is deactivated please contact to admin.';
			$_SESSION['LOGIN']['FIELDS']['email'] = $username;
			header('location: ../../login.php');
			die;

		}
		
		if($isActive1=="0")
		{ 
			$_SESSION['LOGIN'] = array();
			$_SESSION['LOGIN']['ERR'] = array();
			$_SESSION['LOGIN']['SUCCESS'] = array();
			$_SESSION['LOGIN']['ERR']['MSG'] = 'Your account is not yet activated. An email is sent to you from L2ProIndia. You need to follow the instructions in the email to verify and activate your account. In case you have not received mail in your inbox, please check your spam folder.';
			$_SESSION['LOGIN']['FIELDS']['email'] = $username;
			header('location: ../../login.php');
			die;

		}

		/////////////////Dev - Added Code here - change secret///////////
		// if(isset($_POST['g-recaptcha-response']))
        // $captcha=$_POST['g-recaptcha-response'];

		//    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le_W4kkAAAAAHCi-eK18MwZzGUslBa8FSWjfcqT&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
  
		// 	if($response['success'] == false)
		// 	{
		//     $_SESSION['LOGIN'] = array();
		// 	$_SESSION['LOGIN']['ERR'] = array();
		// 	$_SESSION['LOGIN']['SUCCESS'] = array();
		// 	$_SESSION['LOGIN']['ERR']['MSG'] = 'Please select the captcha form.';
		// 	$_SESSION['LOGIN']['FIELDS']['email'] = $username;
		//     header('Location:../../index.php#item1');
		//     die;
		// 	}
			///////////////////////////////////////////////////////////
	}

	//If result matched $myusername and $mypassword, table row must be 1 row
	if($finalCount==1)
	{
		file_put_contents("b.txt",$usertype);
		$_SESSION['login_user']=$myusername;
		$_SESSION['isLogin']="yes";
		if (strtolower($myusername) == 'admin'){
          $login_otp = rand(1000,9999);
			$_SESSION['login_otp'] = $login_otp;
			$_SESSION['login_otp_generate_time'] = time();
			$_SESSION['admin_email_id'] =$user_email_id;
			$_SESSION['admin_id'] =$usRowId;
			
			$mail_message = 'Dear Admin <br><br>'.$login_otp.', this is your OTP for 2 Way Authentication to access admin panel. <br><br> It would be expired in 30 minutes. <br><br> Thank you';
			$mailStatus = sendMailer($user_email_id, ' L2Pro India: OTP Verification mail to Admin', $mail_message);

			header('location: ../../login.php');
			exit();
		exit;
		}
		elseif(strtolower($usertype) == 0){
			
		$_SESSION['startTime']=time();	
		$_SESSION['login_user']=$myusername;
		$_SESSION['isLogin']="yes";
		$_SESSION['sess_fname'] =$firstname;
		$_SESSION['sess_uid'] = strtolower(trim($myusername));
		$_SESSION['perms'] = '1';
		$_SESSION['login_user_type'] = 'student';
		$_SESSION['dashbord_path'] = 'student/intface/index.php';
		//////////////////////////////////Dev////////////
	    $token=md5($myusername.time());
		$_SESSION['token'] = $token;
        /////////////////////////////////////////////////
		////setcookie("loginSession", json_encode($_SESSION),  time()+(3600*24*7), "/", NULL);
		//$_COOKIE['login_user_data'] = $_SESSION;
		
		//mysql_query("INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES ('$myusername', $usRowId, '$userip','$curdate')");

		$query = "INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES (?,?,?,?)";
		$stmt = $con->prepare($query);
		$stmt->bind_param("siss", $myusername, $usRowId,$userip,$curdate);
		$stmt->execute();
	    $stmt->close();
		/////////////Dev-Change from here///////////////////////
		$stmt = $con->prepare("SELECT user_id FROM tbl_web_session where user_id=?");
		$stmt->bind_param("i",$usRowId);
		$stmt->execute();
		$stmt->bind_result($value);
		$stmt->fetch();
		$stmt->close();	

		if(empty($value))
		{
		$query = "INSERT INTO tbl_web_session (user_id, username, token, date_created) VALUES (?,?,?,?)";
		$stmt = $con->prepare($query);
		$stmt->bind_param("isss", $usRowId,$myusername,$token,$curdate);
		$stmt->execute();
	    $stmt->close();
		}
		else
		{
		$query = "update tbl_web_session set token=? where user_id=?";
		$stmt = $con->prepare($query);
		$stmt->bind_param("si", $token,$usRowId);
		$stmt->execute();
	    $stmt->close();
		}

		closeConnection($con);
		/////////////////////////////////////

		header("location: ../../student/intface/index.php");
		exit;
		}

//////////////////////Sub-Admin (Moderator Login)///////////////////////////////////////////////////////////////
		elseif(strtolower($usertype) == 3){
			
		$_SESSION['startTime']=time();	
		$_SESSION['login_user']=$myusername;
		$_SESSION['isLogin']="yes";
		$_SESSION['sess_fname'] =$firstname;
		$_SESSION['sess_uid'] = strtolower(trim($myusername));
		$_SESSION['perms'] = 3;
		$_SESSION['login_user_type'] = 'subadm';
		$_SESSION['dashbord_path'] = 'subadm/intface/index.php';
	
       
		$query = "INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES (?,?,?,?)";
		$stmt = $con->prepare($query);
		$stmt->bind_param("siss", $myusername, $usRowId,$userip,$curdate);
		$stmt->execute();
	    $stmt->close();
		/////////////Dev-Change from here///////////////////////
		$token=md5($myusername.time());
		$_SESSION['token'] = $token;
		//////////////////////////////////Dev////////////
	    

		$stmt = $con->prepare("SELECT user_id FROM tbl_web_session where user_id=?");
		$stmt->bind_param("i",$usRowId);
		$stmt->execute();
		$stmt->bind_result($value);
		$stmt->fetch();
		$stmt->close();	

		if(empty($value))
		{
		$query = "INSERT INTO tbl_web_session (user_id, username, token, date_created) VALUES (?,?,?,?)";
		$stmt = $con->prepare($query);
		$stmt->bind_param("isss", $usRowId,$myusername,$token,$curdate);
		$stmt->execute();
	    $stmt->close();
		}
		else
		{
		$query = "update tbl_web_session set token=? where user_id=?";
		$stmt = $con->prepare($query);
		$stmt->bind_param("si", $token,$usRowId);
		$stmt->execute();
	    $stmt->close();
		}

		closeConnection($con);
		/////////////////////////////////////
		//echo "innn";exit;
		header("location: ../../subadm/intface/index.php");
		exit;
		}
		//////////////////////Sub-Admin (Moderator Login)///////////////////////////////////////////////////////////////
	}
	else 
	{
		$_SESSION['LOGIN'] = array();
		$_SESSION['LOGIN']['ERR'] = array();
		$_SESSION['LOGIN']['SUCCESS'] = array();
		$_SESSION['LOGIN']['ERR']['MSG'] = 'Invalid Credentials';
		$_SESSION['LOGIN']['FIELDS']['email'] = $username;
		header('location: ../../login.php');
		die;
	}

}
else{
	echo "NO";
}


function getCount($con,$myusername , $md5pass){
	
	global $con;
	$stmt = $con->prepare("SELECT id FROM tbl_users WHERE username=? and password=?");
	$stmt->bind_param("ss",$myusername,$md5pass);
	$stmt->execute();
	$stmt->bind_result($id);
	$stmt->fetch();
	$stmt->close();	
	if(!empty($id))
	{
	return 1;
	}
	/*$sql="SELECT id FROM tbl_users WHERE username='$myusername' and password='$md5pass'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$active=$row['active'];
	$count=mysql_num_rows($result);
	return $count;*/
}

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'learnsecretkey';
    $secret_iv = 'learnsecretiv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
?>