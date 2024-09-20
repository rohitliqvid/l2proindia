<?php
error_reporting(E_ALL);
ini_set('display_erors', 1);
session_start();

//Connection to database
include("../../connect.php");
include("../../global/functions.php"); 

//include("../../global/functions.php");
include("phpMailer/mail.php");

$user_id = trim(strip_htmscript($_POST['email'],'other'));
$email = trim(strip_htmscript($_POST['email'],'other'));
$sex =    isset($_POST['sex'])  ? trim($_POST['sex']) ? trim($_POST['sex']) : "" :"";
$sex = !empty($sex) ? "'$sex'" : "NULL";
$client_id = trim(strip_htmscript($_POST['client_id'],'other'));
$bundle_id = trim(strip_htmscript($_POST['bundle_id'],'other'));
$order_id = trim(strip_htmscript($_POST['order_id'],'other'));
$firstName = trim(strip_htmscript($_POST['firstname'],'other'));
$lastName = trim(strip_htmscript($_POST['lastname'],'other'));
$password = trim(strip_htmscript($_POST['password'],'other'));
$mobile = trim(strip_htmscript($_POST['mobile'],'other'));
$learn_from = trim(strip_htmscript($_POST['learn_from'],'other'));
$education = trim(strip_htmscript($_POST['education'],'other'));
$profession = trim(strip_htmscript($_POST['profession'],'other'));
$occupation = trim(strip_htmscript($_POST['occupation'],'other'));
$organization = trim(strip_htmscript($_POST['organization'],'other'));
$designation = trim(strip_htmscript($_POST['designation'],'other'));
$allow_email_for_marketing = trim($_POST['allow_email_for_marketing']) ? trim($_POST['allow_email_for_marketing']) : 'false';
$allow_email_for_campaign = trim($_POST['allow_email_for_campaign']) ?  trim($_POST['allow_email_for_campaign']) :'false';
$dir_name = trim($_POST['dir_name']);
$utype = 'User';
$temp_utype = $utype;
$userFullName = "";
$userPhone = "";
$static_url = $_SERVER['SERVER_NAME'] . '/online/b2c/index.php';
$final_url = '';
$final_launch_url = '';

//Check for google captcha
//  if (isset($_POST['g-recaptcha-response']))
//  	$captcha = $_POST['g-recaptcha-response'];

//  if (!$captcha) {
//  	$_SESSION['REGISTRATION']['FIELDS'] = $_POST;
//  	$_SESSION['REGISTRATION']['ERR']['MSG'] = 'Please check the the captcha form.';
//  	header('Location:../../index.php#item2');
//  	exit;
//  }

//  $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le_W4kkAAAAAHCi-eK18MwZzGUslBa8FSWjfcqT&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
//  if ($response['success'] == false) {
//  	$_SESSION['REGISTRATION']['FIELDS'] = $_POST;
//  	$_SESSION['REGISTRATION']['ERR']['MSG'] = 'You are spammer! You can not proceeed.';
//  	header('Location:../../index.php#item2');
//  	exit;
//  }

if ($client_id == '' || $client_id === '' || $client_id == null) {
	$_SESSION['REGISTRATION']['FIELDS'] = $_POST;
	$_SESSION['REGISTRATION']['ERR']['MSG'] = 'Client id is required';
	header('Location:../../index.php#item2');
	die;
}

if ($user_id == '' || $user_id === '' || $user_id == null) {
	$_SESSION['REGISTRATION']['FIELDS'] = $_POST;
	$_SESSION['REGISTRATION']['ERR']['MSG'] = 'Email is required';
	header('Location:../../index.php#item2');
	die;
} else {
	$int = preg_match_all("/[^a-zA-Z0-9_\.@-+]/i", $user_id);

	if ($int == 0) {
	} else {
		$_SESSION['REGISTRATION']['FIELDS'] = $_POST;
		$_SESSION['REGISTRATION']['ERR']['MSG'] = 'Invalid email';
		header('Location:../../index.php#item2');
		die;
	}
}

if ($bundle_id == '' || $bundle_id === '' || $bundle_id == null) {
	$_SESSION['REGISTRATION']['FIELDS'] = $_POST;
	$_SESSION['REGISTRATION']['ERR']['MSG'] = 'Bundle id is required';
	header('Location:../../index.php#item2');
	die;
}


$utype = 0;

$curdate = date('y-m-d');

//$result2 = mysql_query("SELECT * FROM tbl_users where email='" . $email . "'");
//$totalnum2 = mysql_numrows($result2);
$con=createConnection();
$query4 = "SELECT * FROM tbl_users where email='" . $email . "'";
$result2 = mysqli_query($con,$query4);
$totalnum2=mysqli_num_rows($result2);
//echo "-->".$totalnum2;exit;

//if email already exists
if ($totalnum2) {
	
	$_SESSION['REGISTRATION']['FIELDS'] = $_POST;
	$_SESSION['REGISTRATION']['ERR']['MSG'] = 'Email already registered';
	header('Location:../../index.php#item2');
	die;
}
//else create the user with this user name
else {
	$msg = '';
	$msg = empty($firstName) ? 'First name required.' : $msg;
	$msg = empty($lastName) ? 'Last name required.' : $msg;
	$msg = empty($user_id) ? 'Email required.' : $msg;
	$msg = empty($password) ? 'Password required.' : $msg;
	if ($mobile != "") {
		if (preg_match('/^[0-9]{10}+$/', $mobile)) {
		} else {
			$msg = 'Phone number should be a valid phone.';
		}
	}
	$containsLetter  = preg_match('/[a-zA-Z]/', $password);
	$containsDigit   = preg_match('/\d/', $password);
	$containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);
	if (!$containsLetter || !$containsDigit || !$containsSpecial || strlen($password) < 6) {
		$msg = 'Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character.';
	}
	if ($msg == '') {
		$pwd = md5($password);
		$key = md5($email);
		$client_ip = $_SERVER['REMOTE_ADDR'];

		$social_login_type =  isset($_POST['social_login_type'])  ? $_POST['social_login_type'] :'';
		$social_input_field = 'google_id';
		$social_login_id =  isset($_POST['social_login_id'])  ? $_POST['social_login_id'] :'';
      	
     	if (!empty($social_login_type) && $social_login_type !='') {
        	
        	if ( $social_login_type == 'google') {
				$social_input_field = 'google_id';
			}
			if ( $social_login_type == 'facebook') {
				$social_input_field = 'facebook_id';
			}
			if ( $social_login_type == 'linkedin') {
				$social_input_field = 'linkedin_id';
			}
			if ( $social_login_type == 'twitter') {
				$social_input_field = 'twitter_id';
			}

			$social_login_type = !empty($social_login_type) ? "'$social_login_type'" : "NULL";
			
			$social_login_id = !empty($social_login_type) ? "'$social_login_id'" : "NULL";
        
			//$res = mysql_query("INSERT INTO tbl_users (firstname, lastname, username, password,  userregistered, usertype,email, sex, mobile, education, learn_from, profession, allow_email_for_marketing, allow_email_for_campaign, hash_key,social_login_type,$social_input_field) VALUES ('$firstName','$lastName','$user_id','$pwd','1','$utype','$email',$sex,'$mobile','$education','$learn_from','$profession','$allow_email_for_marketing','$allow_email_for_campaign','$key',$social_login_type,$social_login_id)");
$utype=0;
$curdate = date('Y-m-d');
			$query = "INSERT INTO tbl_users (firstname, lastname, username, password,  userregistered, usertype, dtenrolled,email, sex, mobile, education, learn_from, profession, allow_email_for_marketing, allow_email_for_campaign, hash_key,social_login_type,$social_input_field) VALUES ('$firstName','$lastName','$user_id','$pwd','1','0','$curdate','$email',$sex,'$mobile','$education','$learn_from','$profession','$allow_email_for_marketing','$allow_email_for_campaign','$key',$social_login_type,$social_login_id)";
			$stmt = $con->prepare($query);
			$stmt->execute();
			$stmt->close();
			$lastId = $con->insert_id;
        
        
		}else{
        $utype=0;
        	$query = "INSERT INTO tbl_users (firstname, lastname, username, password,  userregistered, usertype, dtenrolled,email, sex, mobile, education, learn_from, profession, allow_email_for_marketing, allow_email_for_campaign, hash_key) VALUES ('$firstName','$lastName','$user_id','$pwd','1','0','$curdate','$email',$sex,'$mobile','$education','$learn_from','$profession','$allow_email_for_marketing','$allow_email_for_campaign','$key')";
			$stmt = $con->prepare($query);
			$stmt->execute();
			$stmt->close();
			$lastId = $con->insert_id;
			
			//$res = mysql_query("INSERT INTO tbl_users (firstname, lastname, username, password,  userregistered, usertype,email, sex, mobile, education, learn_from, profession, allow_email_for_marketing, allow_email_for_campaign, hash_key) VALUES ('$firstName','$lastName','$user_id','$pwd','1','$utype','$email',$sex,'$mobile','$education','$learn_from','$profession','$allow_email_for_marketing','$allow_email_for_campaign','$key')");
		}
        
		
		
		if (!empty($lastId)) {
			if ($utype == 0 || $utype == 2) {

				//mysql_query("INSERT INTO tbl_company_user (company_id, user_id) VALUES (1,$lastId)");

				$query = "INSERT INTO tbl_company_user (company_id, user_id) VALUES (1,$lastId)";
				//echo $utype."-".$query;exit;
				//$stmt->bind_param("i",$lastId);
				$stmt = $con->prepare($query);
				$stmt->execute();
				$stmt->close();
	
			}
			//Assign course to user 21-5-2019
			///$resultList = mysql_query("SELECT * FROM tls_scorm where coursetype='WBT' order by id asc");
			//$num = mysql_numrows($resultList);

			$query5 = "SELECT course,name FROM tls_scorm where coursetype='WBT' order by id asc";
			$resultList = mysqli_query($con,$query5);
			$num=mysqli_num_rows($resultList);

			$i = 0;
			$userCourseId = $user_id;
			$arrCourseNames = array();
			while ($i < $num) {
				$row = mysqli_fetch_assoc($resultList);
				$course_id=$row['course'];
				$crsName=$row['name'];

				//if not assigned, assign the course to user in b2client
					$query6 = "select bundle from tbl_b2client_bundle where bundle_desc='$course_id'";
					$bundleCourse = mysqli_query($con,$query6);
					$num2=mysqli_num_rows($bundleCourse);
					$row2 = mysqli_fetch_assoc($bundleCourse);
					$bundle_id = $row2['bundle'];

				$curdate = date('Y-m-d');
				$password = "password";
				$todayDate = date("Y-m-d");
				$expiryDate = date('Y-m-d', strtotime(date("Y-m-d") . ' + 90 days'));
				$date = date_create();
				$client_id = 5;
				$company_id = 1;
				$launch_token = md5($client_id . "-" . $userCourseId . "-" . $bundle_id . "-" . $curdate);
				$token = md5($client_id . "-" . $userCourseId . "-" . $course_id . "-" . $curdate);
				$final_launch_url	= $static_url . '?token=' . $launch_token;
				$final_url .= $static_url . '?token=' . $token;
				//$assignCourse = mysql_query("INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$userCourseId','$password','$token','$launch_token','SignUp' , '$bundle_id','$course_id','$todayDate','$expiryDate' , '0')");
				
				$query7 = "INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$userCourseId','$password','$token','$launch_token','SignUp' , '$bundle_id','$course_id','$todayDate','$expiryDate' , '0')";
				$stmt = $con->prepare($query7);
				$stmt->execute();
				$stmt->close();
				
				array_push($arrCourseNames, $crsName);

				$i++;
			}


			//Send activation mail
			if (isset($_SERVER['HTTPS'])) {
				$http = 'https://';
			} else {
				$http = 'http://';
			}

			$activationlink = $http . $_SERVER['HTTP_HOST'] . '/activation.php?key=' . $key;
			$firstName = ucfirst($firstName);
			$subject = "L2Pro India: Verification mail to complete registration";
			$message = "Hi $firstName <br><br>Thank you for showing interest in L2Pro India Program. This is an initiative to spread awareness on how to protect Intellectual Property Right!<br><br>Please confirm that $email is your email address by clicking on the below link.<br><br><a href=" . $activationlink . " > Click here to verify Email </a><br><br>If you have not registered, please ignore the email.<br><br>L2Pro India Team.";
			$mailStatus = sendMailer($email, $subject, $message);

			if (count($arrCourseNames) > 0) {
				//Mail code here
				/* $strCourses=implode(",",$arrCourseNames);
				$subject = "Course Assigned";
				$message = "Dear User, Following course(s) are assigned to you: $strCourses";
				$mailStatus = sendMailer($email, $subject, $message); */
			}



			$_SESSION['REGISTRATION']['FIELDS'] = $_POST;
			$_SESSION['REGISTRATION']['SUCCESS']['MSG'] = 'You have registered successfully.

			An email is sent to you from L2ProIndia. You need to follow the instructions in the email to verify and activate your account. In case you have not received mail in your inbox, please check your spam folder.';
			header('Location:../../index.php#item4');
    
			die;
		} else {
			$_SESSION['REGISTRATION']['FIELDS'] = $_POST;
			$_SESSION['REGISTRATION']['ERR']['MSG'] = 'Not registered please try again.';
			header('Location:../../index.php#item2');
			die;
		}
	} else {
		$_SESSION['REGISTRATION']['FIELDS'] = $_POST;
		$_SESSION['REGISTRATION']['ERR']['MSG'] = $msg;
		header('Location:../../index.php#item2');
		die;
	}
}

//closeConnection($con);