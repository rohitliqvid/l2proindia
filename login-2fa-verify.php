<?php 
session_start();

include("connect.php");
$con=createConnection();

$_SESSION['is_otp_varifid'] =1;
if (!array_key_exists('login_otp',$_SESSION)) {

    $_SESSION['LOGIN'] = array();
	$_SESSION['LOGIN']['ERR'] = array();
	$_SESSION['LOGIN']['SUCCESS'] = array();
	$_SESSION['LOGIN']['ERR']['MSG'] ='';
    
    header('Location: index.php#item1');
	exit();
}
$login_otp_generate_time  = $_SESSION['login_otp_generate_time'];
$current_time = strtotime(('Y-m-d H:i:s'). ' -30 minutes');

if ($login_otp_generate_time  < $current_time ) {
    $_SESSION['REGISTRATION']['FIELDS'] = '';
	$_SESSION['REGISTRATION']['ERR']['MSG'] = 'OTP is expired. Please try logging in again.';
	header('Location: index.php#item2');
	die;
}

$request = $_REQUEST;
$is_varifid = 1;
if (empty($request['otp'])) {
    $is_varifid =0;
    $_SESSION['is_otp_varifid'] =0;
    $_SESSION['error_message'] = 'OTP field is required.';
    header('location:login-2fa.php');
    exit();
}


if ($request['otp'] != $_SESSION['login_otp'] ) {
    $is_varifid =0;
    $_SESSION['is_otp_varifid'] =0;
    $_SESSION['error_message'] = 'OTP is wrong.';
    header('location:login-2fa.php');
    exit();
}

//Check for google captcha
if (!isset($request['g-recaptcha-response'])){
    $is_varifid =0;
    $_SESSION['request_data'] = $request;
    $_SESSION['error_message'] = 'Please check the the captcha form.';
	header('Location: login-2fa.php');
	exit;
}

$captcha = $_POST['g-recaptcha-response'];
	
$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le_W4kkAAAAAHCi-eK18MwZzGUslBa8FSWjfcqT&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
if ($response['success'] == false) {
    $is_varifid =0;
    $_SESSION['request_data'] = $request;
    $_SESSION['error_message'] = 'Invalid captcha';
	header('Location:login-2fa.php');
	exit;
} 

if ($is_varifid) {
    $admin_id = $_SESSION['admin_id'];
   // $query1="select * from tbl_users where  id=\"" .$admin_id."\"";
//	$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1); 

	$stmt = $con->prepare("SELECT id,username,userregistered,email,usertype,isActive,firstname FROM tbl_users WHERE id=?");
	$stmt->bind_param("i",$admin_id);
	$stmt->execute();
	$stmt->bind_result($usRowId,$username,$isActive,$user_email_id,$usertype,$isActive1,$firstname);
	$stmt->fetch();
	$stmt->close();	
	
    if(!empty($usRowId))
	{
	
   // if (mysql_num_rows($result1) > 0) {
     //   $thisrow=mysql_fetch_assoc($result1);
            $_SESSION['sess_fname'] = "Admin";
			$_SESSION['sess_uid'] = strtolower(trim($username));
			$_SESSION['perms'] = '1';
			$_SESSION['login_user_type'] = 'admin';
			$_SESSION['dashbord_path'] = 'admin/intface/index.php';

            $myusername = $username;
            $usRowId = $thisrow['id'];
			////////////////////
			$usRowId=1;
			//////////////////////
            if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                $userip=$_SERVER['HTTP_CLIENT_IP'];
            }
            elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $userip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            } 
            else{
                $userip=$_SERVER['REMOTE_ADDR'];
            }

            unset($_SESSION["login_otp"]);
            unset($_SESSION["login_otp_generate_time"]);
            unset($_SESSION["admin_email_id"]);
            unset($_SESSION["admin_id"]);
            unset($_SESSION["is_otp_varifid"]);

            $curdate=date('Y-m-d');
            $query = "INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES (?,?,?,?)";
			$stmt = $con->prepare($query);
			$stmt->bind_param("siss", $myusername, $usRowId,$userip,$curdate);
			$stmt->execute();
			$stmt->close();
		    //closeConnection($con);

			  /////////////Dev-Change from here///////////////////////

				 $token=md5($myusername.time());
		    $_SESSION['token'] = $token;
			

		$stmt = $con->prepare("SELECT user_id FROM tbl_web_session where user_id=?");
		$stmt->bind_param("i",$usRowId);
		$stmt->execute();
		$stmt->bind_result($value);
		$stmt->fetch();
		$stmt->close();	

		if(empty($value))
		{
	
		$query2 = "INSERT INTO tbl_web_session (user_id, username, token, date_created) VALUES (?,?,?,?)";
		$stmt = $con->prepare($query2);
		$stmt->bind_param("isss",$usRowId,$myusername,$token,$curdate);
		$stmt->execute();
	    $stmt->close();
	
		}
		else
		{
		$query3 = "update tbl_web_session set token=? where user_id=?";
		$stmt = $con->prepare($query3);
		$stmt->bind_param("si",$token,$usRowId);
		$stmt->execute();
	    $stmt->close();
		}

		closeConnection($con);
		
		/////////////////////////////////////
			header("location:admin/intface/index.php");
    }else{
        $_SESSION['LOGIN'] = array();
	    $_SESSION['LOGIN']['ERR'] = array();
	    $_SESSION['LOGIN']['SUCCESS'] = array();
	    $_SESSION['LOGIN']['ERR']['MSG'] ='';
        header('location: ../../index.php#item1');
    }
}



    





?>