<?php
/* PHP to connect to ADURO DB */
   /* Connection parmeters */
error_reporting(E_PARSE);
ini_set('display_errors',0);
include ("../pages/helpers/phpMailer/mail.php");
function createConnection() {
    // local -con
	/* $dbname = "db_dapp";
    $dbuser =  "root";
    $dbpass  = ""; */

	// production con
	$dbname = "db_dapp";
    $dbuser =  "root";
    $dbpass  = "7RTH?6@%OOTr\g:82#5Y";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    //$con=mysqli_connect("languagelab555.cpwwa3kju9uo.ap-southeast-1.rds.amazonaws.com",$dbuser, $dbpass, $dbname); 
	$con=mysqli_connect("localhost",$dbuser, $dbpass, $dbname);    
    if (mysqli_connect_errno()) {
        print mysqli_connect_errno()."ERROR IN MYSQL";
        return null;
    }
    return $con;
}

function closeConnection($con) {
    mysqli_close($con);

}


function aduroGetToken($con,$login,$password) {
    $stmt = $con->prepare("SELECT username from tbl_users where username=? and password=?");
    if($stmt) {
        $stmt->bind_param("ss",$login,$password);
        if($stmt->execute()) {
                $stmt->bind_result($user_id);
                $stmt->fetch();
                $stmt->close();
                /* check if a valid code already exists */
                $fetechstmt = $con->prepare("select session_id from api_session where user_id=? and valid_upto > NOW()");
                $fetechstmt->bind_param("i",$user_id);
                $fetechstmt->bind_result($ssid);
                $fetechstmt->execute();
                $fetechstmt->fetch();
                if(!isset($ssid) || $ssid===null || $ssid ==="") {
                    $part1 = md5($user_id);
                    $part2 = uniqid();
                    $entireKey = $part1.$part2;
                    $ssid = md5($entireKey);
                }
                $fetechstmt->close();
                /* Create the session in the session table */
                /* first insert or update existing user sessions for this user */
                $updatest = $con->prepare("insert INTO api_session(user_id,session_id,valid_upto) values(?,?,DATE_ADD(NOW(), INTERVAL +4 HOUR)) ON DUPLICATE KEY UPDATE session_id=?,valid_upto=DATE_ADD(NOW(), INTERVAL +4 HOUR)") or die ('some issue here '.$con->error);
                $xcv = $updatest->bind_param("iss",$user_id,$ssid,$ssid);
                $updatest->execute();
                return $ssid;
        }
    }
    return null;
}

function aduroDoLogin($con,$login,$password){
		
		$alert_msg_arr = aduroAlertMessage();
		file_put_contents("login.txt",$login."--".$password);
	
		$stmt = $con->prepare("SELECT id,username,firstname,lastname,user_pic,isActive from tbl_users where username='".$login."' and password='".$password."'");
		$stmt->bind_result($user_id,$username,$firstname,$lastname,$user_pic,$isActive);
		$stmt->execute();
        $stmt->fetch();
        $stmt->close();
		if(isset($user_id) && !empty($user_id))
		{
	   
			if($isActive=="0")
			{
				$obj = new stdClass();
				$obj->isActive = $isActive;
				
				return $obj;
				
			}else{
	   
				/* check if a valid code already exists */
				$fetechstmt = $con->prepare("select session_id from api_session where user_id=? and valid_upto > NOW()");
				$fetechstmt->bind_param("i",$user_id);
				$fetechstmt->bind_result($ssid);
				$fetechstmt->execute();
				$fetechstmt->fetch();
				if(!isset($ssid) || $ssid===null || $ssid ==="") {
					$part1 = md5($username);
					$part2 = uniqid();
					$entireKey = $part1.$part2;
					$ssid = md5($entireKey);
				}
				$fetechstmt->close();
				//error_log("select token===============================".$ssid);
				/* Create the session in the session table */
				/* first insert or update existing user sessions for this user */
				$updatest = $con->prepare("insert INTO api_session(user_id,session_id,valid_upto) values(?,?,DATE_ADD(NOW(), INTERVAL +4 HOUR)) ON DUPLICATE KEY UPDATE session_id=?,valid_upto=DATE_ADD(NOW(), INTERVAL +4 HOUR)") or die ('some issue here '.$con->error);
				$xcv = $updatest->bind_param("iss",$user_id,$ssid,$ssid);
				$updatest->execute();	
				$obj = new stdClass();
				$obj->token = $ssid;
				$obj->user_id = $user_id;
				$obj->username = $username;
				$obj->fname = $firstname;
				$obj->lname = $lastname;
				$obj->user_pic = $user_pic;
				$obj->isActive = $isActive;
              
              
              $user_info_query = "SELECT id, education,user_country,user_state,user_city,zip_code,organization,profession,education_details,profession_experience FROM tbl_users WHERE id=?"; 
				$user_info = $con->prepare($user_info_query); 
				$user_info->bind_param("s", $user_id);
				$user_info->execute();
				$result = $user_info->get_result(); // get the mysqli result
				$user_query_response = $result->fetch_assoc();

				$download_status = 1;

				if (empty($user_query_response['education']) || empty($user_query_response['user_country'])  || empty($user_query_response['user_state']) || empty($user_query_response['user_city']) || 						empty($user_query_response['zip_code']) || empty($user_query_response['profession'])) {
					$download_status = 0;
				}
				if (!empty($user_query_response['education'])  && empty($user_query_response['education_details'])) {
					$download_status = 0;
				}

				if (!empty($user_query_response['profession'])  && empty($user_query_response['profession_experience'])) {
					$download_status = 0;
				}
				$obj->download_status = $download_status;
				
				return $obj;	
			}
			}
			
   
    return null;
}

function aduroDoRegister($con,$details){
		
	
		$alert_msg_arr = aduroAlertMessage();
		
		$email_id = $details->email_id;
		$last_name = $details->last_name;
		$first_name = $details->first_name;
		$mobile = $details->mobile;
		$password = $details->password;
		$occupation = $details->occupation;
		$organization = $details->organization;
		$designation = $details->designation;
		$device_type = $details->device_type;
		$device_id = $details->device_id;

		$sex = $details->sex ? $details->sex : NULL;
		$education = $details->education ? $details->education :NULL;
		$profession = $details->profession ? $details->profession : NULL;
		$learn_from = $details->learn_from ?$details->learn_from : NULL;
		$allow_email_for_marketing = $details->allow_email_for_marketing ? $details->allow_email_for_marketing :'false';
		$allow_email_for_campaign = $details->allow_email_for_campaign ? $details->allow_email_for_campaign : 'false';

		$key=md5($email_id);
  	
  		$social_login_type = $details->social_login_type  ? $details->social_login_type :NULL;
		$social_input_field = 'google_id';
		$social_login_id =  $details->social_login_id  ? $details->social_login_id :NULL;

		
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

			$social_login_type = !empty($social_login_type) ? $social_login_type: NULL;
			$social_login_id = !empty($social_login_type) ? $social_login_id : NULL;

			$updatest = $con->prepare("insert INTO tbl_users(firstname,lastname,username,password, userregistered,usertype,dtenrolled,email, mobile, country, city, business_type,client,hash_key,occupation,organization,designation,device_type,device_id,sex,education,profession,learn_from,allow_email_for_marketing,allow_email_for_campaign,social_login_type,$social_input_field,social_login_with_other_email) values(?,?,?,?,1,0,NOW(),?,?,100,1,1,5,?,?,?,?,?,?,?,?,?,?,?,?,?,?,1)") or die ('some issue here '.$con->error);
			
			$updatest->bind_param("sssssissssssssssssss",$first_name,$last_name,$email_id,$password,$email_id,$mobile,$key,$occupation,$organization,$designation,$device_type,$device_id,$sex,$education,$profession,$learn_from,$allow_email_for_marketing,$allow_email_for_campaign,$social_login_type,$social_login_id);
		}else{
			$updatest = $con->prepare("insert INTO tbl_users(firstname,lastname,username,password, userregistered,usertype,dtenrolled,email, mobile, country, city, business_type,client,hash_key,occupation,organization,designation,device_type,device_id,sex,education,profession,learn_from,allow_email_for_marketing,allow_email_for_campaign) values(?,?,?,?,1,0,NOW(),?,?,100,1,1,5,?,?,?,?,?,?,?,?,?,?,?,?)") or die ('some issue here '.$con->error);
			
			$updatest->bind_param("sssssissssssssssss",$first_name,$last_name,$email_id,$password,$email_id,$mobile,$key,$occupation,$organization,$designation,$device_type,$device_id,$sex,$education,$profession,$learn_from,$allow_email_for_marketing,$allow_email_for_campaign);
		}

		
		
		if($updatest->execute()){
			$lastId=$updatest->insert_id;

			mysqli_query($con,"INSERT INTO tbl_company_user (company_id, user_id) VALUES (1,$lastId)");
			$resultList = mysqli_query($con,"SELECT * FROM tls_scorm where coursetype='WBT' order by id asc"); 
			$num=mysqli_num_rows($resultList);
			$i=0;
			$userCourseId=$email_id;
			$arrCourseNames=array();
			
			while($row1=mysqli_fetch_assoc($resultList)) { 
				$course_id=$row1['course'];
				$crsName=$row1['name'];

				//if not assigned, assign the course to user in b2client
				$bundleCourse=mysqli_query($con,"select bundle from tbl_b2client_bundle where bundle_desc='$course_id'");
				$row = mysqli_fetch_assoc($bundleCourse);
				//$id = $row['id'];
				$bundle_id=$row['bundle'];

				$curdate = date('Y-m-d');
				$password="password";
				$todayDate = date("Y-m-d");
				$expiryDate = date('Y-m-d', strtotime(date("Y-m-d") . ' + 90 days'));
				$date = date_create();
				$client_id=5;
				$company_id=1;
				$launch_token = md5($client_id . "-" . $userCourseId . "-" . $bundle_id . "-" . $curdate);
				$token = md5($client_id . "-" . $userCourseId . "-" . $course_id . "-" . $curdate);

				$assignCourse=mysqli_query($con,"INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$userCourseId','$password','$token','$launch_token','SignUp' , '$bundle_id','$course_id','$todayDate','$expiryDate' , '0')");
				array_push($arrCourseNames,$crsName);
				$i++; 
			}

			if(count($arrCourseNames)>0)
				{
				//Mail code here
				//$strCourses=implode(",",$arrCourseNames);
				//$subject = "Course Assigned";
				//$message = "Dear User, Following course(s) are assigned to you: $strCourses";
				//$mailStatus = sendMailer($email_id, $subject, $message);
				} 
			
			//Activation mail
			if(isset($_SERVER['HTTPS'])) {
				$http='https://';
			}
			else{ $http='http://';}
			$activationlink=$http.$_SERVER['HTTP_HOST'].'/activation.php?key='.$key;
			$first_name=ucfirst($first_name);	
			$subject = "L2Pro India: Verification mail to complete registration";
			$message = "Hi $first_name <br><br>Thank you for showing interest in L2Pro India Program. This is an initiative to spread awareness on how to protect Intellectual Property Right!<br><br>Please confirm that $email_id is your email address by clicking on the below link.<br><br><a href=".$activationlink." > Click here to verify Email</a><br><br>If you have not registered, please ignore the email.<br><br>L2Pro India Team.";
			$mailStatus = sendMailer($email_id, $subject, $message);

			if(!isset($ssid) || $ssid===null || $ssid ==="") {
				$part1 = md5($email_id);
				$part2 = uniqid();
				$entireKey = $part1.$part2;
				$ssid = md5($entireKey);
			}
				
			/* $updatest = $con->prepare("insert INTO api_session(user_id,session_id,valid_upto) values(?,?,DATE_ADD(NOW(), INTERVAL +4 HOUR)) ON DUPLICATE KEY UPDATE session_id=?,valid_upto=DATE_ADD(NOW(), INTERVAL +4 HOUR)") or die ('some issue here '.$con->error);
			$xcv = $updatest->bind_param("iss",$lastId,$ssid,$ssid);
			$updatest->execute();	 */
			
			$obj = new stdClass();
			$obj->token = $ssid;
			$obj->user_id = $lastId;
			$obj->username = $email_id;
			$obj->email = $email_id;
			$obj->fname = $first_name;
			$obj->lname = $last_name;
			$obj->user_pic = '';

			return $obj;
		}
				
    return null;
}


function aduroDoResetAndSendPassword($con,$login_id){
	$username = trim($login_id);
	$result = mysqli_query($con,"SELECT * FROM  tbl_users where email='$username'") or die("1Failed Query of " . mysqli_error($con));
	$cResult = mysqli_fetch_array($result);
	$id = $cResult['id'];
	$firstName = ucfirst($cResult['firstname']);
	if($id){
		$rand = generate_random_string(8);
		$password = md5($rand);
		$query = "UPDATE tbl_users set password = '$password' where id = '$id'";
		$result = mysqli_query($con,$query);
		$subject = "L2Pro India: Password reset notification";
		$message = "Hi $firstName<br><br>Your new password is: $rand <br><br>L2Pro India Team.";
		
		$status = sendMailer($username, $subject, $message);
		if($status == 'ok'){
			$sr = new ServiceResponse("SUCCESS",1,null);
            $sr->retVal->msg = "Password has been sent to $username";
            return $sr;
        } else {
            $sr = new ServiceResponse("FAILURE",0,null);
            $sr->retVal->msg = "Password could not be sent as your email id is not valid";
            return $sr;
        }
    }

    $sr = new ServiceResponse("NFOUND",0,null);
    $sr->retVal->msg = "Password could not be sent as there is no user record with this email";
    return $sr;					
}


function aduroDoChangePassword($con,$email_id,$old_password,$password){
	$old_password = md5($old_password);
	$password = md5($password);
	$stmt = $con->prepare("SELECT id,password from tbl_users where username='".$email_id."'");
	$stmt->bind_result($user_id,$oldpassword);
	$stmt->execute();
	$stmt->fetch();
	$stmt->close();
	if(isset($user_id) && !empty($user_id))
	{
		
		if($old_password!=$oldpassword){
			$sr = new ServiceResponse("FAILURE",0,null);
            $sr->retVal->msg = "Old Password doesn't match";
            return $sr;
		}
		
		$query = "UPDATE tbl_users set password = '$password' where id = '$user_id'";
		$result = mysqli_query($con,$query);
		if($result){
			$sr = new ServiceResponse("SUCCESS",1,null);
            $sr->retVal->msg = "Your password has been changed successfully";
            return $sr;
        }else{
            $sr = new ServiceResponse("FAILURE",0,null);
            $sr->retVal->msg = "Password could not be changed";
            return $sr;
        }
    }
    $sr = new ServiceResponse("NFOUND",0,null);
    $sr->retVal->msg = "Password could not be changed as there is no user record with this email";
    return $sr;					
}




function tokenValidate($con,$token) {
    /* Check if the token exists */
    $stmt = $con->prepare("SELECT user_id from api_session where session_id=? and valid_upto > NOW()");
    if($stmt) {
        $stmt->bind_param("s",$token);
        if($stmt->execute()) {
            $stmt->bind_result($user_id);
            if($stmt->fetch()) {
                $stmt->close();
                $updatest = $con->prepare("update api_session set valid_upto=DATE_ADD(NOW(), INTERVAL + 4 HOUR) where session_id=?");
                $updatest->bind_param("s",$token);
                $updatest->execute();
                $updatest->close();
                return $user_id;
            }
            $stmt->close();
        } 
    }
    return -1;
}




function aduroIsTrue($str){
    
    if($str === true || $str === TRUE || $str === 1 ){
        return true;
    }
    
    $str = trim(strtolower($str));
    
    if( $str === 'yes' || $str === '1' || $str === 'true' ){
        return true;
    }
    
    return false;
}


function aduroAlertMessage(){
    $arr = array(
        'LOGIN_FAILED' => 'Invalid username or password.',
        'LOGIN_FAILED_FOR_UNIQUE_CODE' => 'You need to register again.',
        'REGISTER_INVALID_COURSE_CODE' => 'You entered an invalid Content Pack.',
        'REGISTER_INVALID_UNIQUE_CODE' => 'You entered an invalid Content Pack.',
        'REGISTER_UNIQUE_CODE_ALREADY_REGISTERED' => 'This Content Pack is already used by another user.',
		'REGISTER_UNIQUE_CODE_REACHED_MAX_DEVICE' =>  'Device limit exceeded for this Content Pack.',
		'EDGE_ID_MISSING' => 'Edge ID Missing.',
        'REGISTER_SUCCESS' =>  'You have successfully registered',
		'INVALID_PLATFORM' => 'You are not authorized to access Content Pack on this device.',
		'LICENSE_EXPIRED' => 'Content Pack has expired. ',
		'LOGIN_UNIQUE_CODE_REACHED_MAX_DEVICE' => 'Device limit exceeded for this Content Pack.',
		'INVALID_UNIQUE_CODE' => 'Invalid Content Pack.',
		'REGISTER_UNIQUE_CODE_ALREADY_REGISTERED_USER' => 'You have already registered with same credentials.',
        'NOT_ASSOCIATED_WITH_KEY' => 'You need to be registered with respective key.',
		'IS_BLOCK' =>  'Content Pack deactivated. Please contact administrator.',    
		'PACKAGE_CODE_USED' => 'Content Pack already used.',
		'REGISTER_INVALID_PACKAGE_CODE' =>  'Invalid Content Pack.', 
		'REGISTER_PACKAGE_CODE_ALREADY_REGISTERED_USER' =>  'You have already registered with same credentials.',
		'PACKAGE_EXPIRED' => 'Content Pack expired.',
		'REGISTER_UNIQUE_CODE_JSON_ERROR' => 'There is some network problem. Please try again later.',
		'REGISTER__FAILED' => 'Not registered. Please try again.',
		'EMAIL_EXIST' => 'Email already registered.',
		'REQUIRED_FIRSTNAME' =>'First name required.',
		'REQUIRED_LASTNAME' =>'Last name required.',
		'REQUIRED_PHONE' => 'Phone number required.',
		'REQUIRED_PASSWORD' => 'Password required.',
		'REQUIRED_CPASSWORD' => 'Confirm password required.',
		'PASSWORD_SAME' => 'Password and confirm password must be same.',
		'REQUIRED_OLDPASSWORD' => 'Old password required.',
		'REQUIRED_NEWPASSWORD' => 'New password required.',
		'REQUIRED_NEWCPASSWORD' => 'Confirm password required.',
		'PASSWORD_MINLENGTH' => 'New password is minimum 6 character long.',
	    'PASSWORDCHANGE_FAILED' => 'Password has not been changed',
	    'FIRSTNAME_ALPHA' => 'First name should contain characters only.',
	    'LASTNAME_ALPHA' => 'Last name should contain characters only.',
	    'PHONE_VALID' => 'Phone number should be a valid phone.',
	    'PASSWORD_VALID' => 'Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character.',
		'EMAIL_ACTIVATION' => 'You have registered successfully.

An email is sent to you from L2ProIndia. You need to follow the instructions in the email to verify and activate your account. In case you have not received mail in your inbox, please check your spam folder.',
		'LOGIN_ACTIVATION' => 'Your account is not yet activated.  

An email is sent to you from L2ProIndia. You need to follow the instructions in the email to verify and activate your account. In case you have not received mail in your inbox, please check your spam folder.'
		
        );
    
    return $arr;
}





//Check email already register
function aduroCheckEmail($con,$email_id){ 
		$fetechstmt = $con->prepare("select id from tbl_users where email=?");
		$fetechstmt->bind_param("s",$email_id);
		$fetechstmt->bind_result($uid);
		$fetechstmt->execute();
		$fetechstmt->fetch();
		if(isset($uid) && !empty($uid)) {
			return true;
		}
		else{
			return false;
		}
			
}
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


//not being used by mobile app
function getCourseDetails($con){
    
    $darr = array();
    $sql = "select id, name, download_path,c_version,course_level from tls_scorm order by id";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id, $name, $download_path,$c_version,$course_level);
    
	while($stmt->fetch()) {
			$obj = new stdclass();
			$obj->id = $id;
			$obj->name = $name;
			$obj->launch_url = "https://l2proindia.com/student/catlist/playscorm.php?cid=".$id."&scoid=".$id;
			$obj->download_path = $download_path;
			$obj->course_version = $c_version;
			$obj->course_level = $course_level;

			array_push($darr,$obj);
		}
    $stmt->close();
    return $darr;
}
////////////////////

function getStudentProgress($con,$user_id){
    
    $darr = array();


    $sql = "select id, name,download_path,c_version,course_level,course_type from tls_scorm order by id";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id, $name, $download_path, $c_version,$course_level,$course_type);
    
	while($stmt->fetch()) {
			$obj = new stdclass();
			$obj->id = $id;
			$obj->name = $name;
			// $obj->launch_url = "https://l2proindia.com/student/catlist/playscorm.php?cid=".$id."&scoid=".$id;
			$obj->launch_url = "https://l2proindia.com/student/catlist/playscorm.php?cid=".$id."&scoid=".$id;
			$obj->download_path = $download_path;
			$obj->course_version = $c_version;
			$obj->course_type = $course_type;
			
			$userBookmark=getUserBookmark($user_id,$id);
			$userBookmark=str_replace('^','-',$userBookmark);
			$obj->bookmark=$userBookmark;

			$userVisitedStatus=getUserVisitedStatus($user_id,$id);
			$obj->visited_status=$userVisitedStatus;

			$userTime=getUserCourseTime($user_id,$id);
			$obj->timespent=$userTime;

			$userStatus=getUserCourseStatus($user_id,$id);
			$obj->coursestatus=$userStatus;
			
			$userScore=getUserCourseScore($user_id,$id);
			$obj->score=$userScore;

			$obj->course_level = $course_level;

			$social_exist_user_data  = [];
      		/* $user_certificate = $con->prepare("SELECT * FROM certificates WHERE user_id=? and  sco_id =? and  level_name =? "); 
			$user_certificate->bind_param("iis",$user_id,$id,$course_level);
			$user_certificate->execute();
			$user_certificate_result = $user_certificate->get_result(); // get the mysqli result
			$social_exist_user_data = $user_certificate_result->fetch_assoc(); */

			$obj->certificate_url = '';
			if (is_array($social_exist_user_data) && count($social_exist_user_data)) {
				$obj->certificate_url = $social_exist_user_data['cert_path'];
			}

			array_push($darr,$obj);
		}
    $stmt->close();

	$user_info_query = "SELECT id, education,user_country,user_state,user_city,zip_code,organization,profession,education_details,profession_experience FROM tbl_users WHERE id=?"; 
		$user_info = $con->prepare($user_info_query); 
		$user_info->bind_param("s", $user_id);
		$user_info->execute();
		$result = $user_info->get_result(); // get the mysqli result
		$user_query_response = $result->fetch_assoc();

		$download_status = 1;

		if (empty($user_query_response['education']) || empty($user_query_response['user_country'])  || empty($user_query_response['user_state']) || empty($user_query_response['user_city']) || empty($user_query_response['zip_code']) || empty($user_query_response['organization']) || empty($user_query_response['profession'])) {
			$download_status = 0;
		}
		if (!empty($user_query_response['education'])  && empty($user_query_response['education_details'])) {
			$download_status = 0;
		}

		if (!empty($user_query_response['profession'])  && empty($user_query_response['profession_experience'])) {
			$download_status = 0;
		}
		
  		$data['darr'] = $darr;
		$data['is_download_status'] = $download_status;
    	return $data;
}

function getUserCourseTime($user_rowid,$docid)
{
	$con1 = createConnection();
	$query=mysqli_query($con1,"select id,value from tls_scorm_sco_tracking where element='cmi.core.total_time' and userid=$user_rowid and scormid=$docid");
	$row = mysqli_fetch_assoc($query);
	$value=$row['value'];
	if(empty($value))
	{
		$query=mysqli_query($con1,"select id,value from tls_scorm_sco_tracking where element='cmi.core.session_time' and userid=$user_rowid and scormid=$docid");
		$row = mysqli_fetch_assoc($query);
		$value=$row['value'];
		if(empty($value))
		{
		$userTime='00:00:00';
		}
		else
		{
		$userTime=substr($value,0,8);
		}
	}
	else
	{
	$userTime=$value;
	}
	return $userTime;

}



function getUserCourseScore($user_rowid,$docid)
{

	$con1 = createConnection();
	$query=mysqli_query($con1,"select id,value from tls_scorm_sco_tracking where element='cmi.core.score.raw' and userid=$user_rowid and scormid=$docid");
	$row = mysqli_fetch_assoc($query);
	$value=$row['value'];
	if(empty($value))
	{
		$userScore=0;
	}
	else
	{
		$userScore=$value;
	}
    return $userScore;
}

function getUserCourseStatus($user_rowid,$docid)
{

	$con2 = createConnection();
	$query=mysqli_query($con2,"select id,value from tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_rowid and scormid=$docid");
	$row = mysqli_fetch_assoc($query);
	$value=$row['value'];
	if(empty($value))
	{
		$userStatus='Not Attempted';
	}
	else
	{
		$userStatus=$value;
	}
	/*else
	{
		 if($value=='failed')
		 {
			 $query2=mysqli_query($con2,"select id,value from tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_rowid and scormid=$docid");
			 $row = mysqli_fetch_assoc($query2);
			 $value=$row['value'];
			 if(empty($value))
			 {
				 $userStatus='incomplete';
			 }
		 }
	}*/
	return $userStatus;

}

function getUserBookmark($user_rowid,$docid)
{

	$con1 = createConnection();
	$query=mysqli_query($con1,"select id,value from tls_scorm_sco_tracking where element='cmi.core.lesson_location' and userid=$user_rowid and scormid=$docid");
	$row = mysqli_fetch_assoc($query);
	$value=$row['value'];
	if(empty($value))
	{
		$userLocation='';
	}
	else
	{
		$userLocation=$value;
	}
    return $userLocation;
}

function getUserVisitedStatus($user_rowid,$docid)
{

	$con1 = createConnection();
	$query=mysqli_query($con1,"select id,value from tls_scorm_sco_tracking where element='cmi.suspend_data' and userid=$user_rowid and scormid=$docid");
	$row = mysqli_fetch_assoc($query);
	$value=$row['value'];
	if(empty($value))
	{
		$userVisitedStatus='';
	}
	else
	{
		$userVisitedStatus=$value;
	}
    return $userVisitedStatus;
}




function trackUserData($con,$user_id,$course_id,$bookmark,$visited_status, $timespent,$coursestatus, $score) {


file_put_contents('trackeddata.txt','userid='.$user_id.'-course_id='.$course_id.'-bookmark='.$bookmark.'-visited_status='.$visited_status.'-timespent='.$timespent.'-coursestatus='.$coursestatus.'-score='.$score."\n", FILE_APPEND);
//file_put_contents('track.txt','trackcall===='.$location, FILE_APPEND);
    	
	/*$query = "select userid from tls_scorm_sco_tracking where userid=? and scormid=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii",$user_id,$courseid);
    $stmt->bind_result($user_id, $courseid); 
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();*/

	$element='cmi.core.lesson_status';
	//file_put_contents("QUERY.TXT","select value from tls_scorm_sco_tracking where userid=$user_id and scormid=$courseid and element='cmi.core.lesson_status'");
	$query = "select value from tls_scorm_sco_tracking where userid=? and scormid=? and element=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iis",$user_id,$course_id,$element);
    $stmt->execute();
	$stmt->bind_result($value); 
    $stmt->fetch();
    $stmt->close();
	if(!isset($value))
	{
		
               
		$element='cmi.core.lesson_status';
		$currentTime=time();
		$insertQ = $con->prepare("insert into tls_scorm_sco_tracking(userid,scormid,scoid,element,value,timemodified) values(?,?,?,?,?,?)");
        $insertQ->bind_param("iiisss",$user_id,$course_id,$course_id,$element,$coursestatus,$currentTime);
        $insertQ->execute();
        $insertQ->close();
				
	}
	else
	{		
		$element='cmi.core.lesson_status';
		$updatest = $con->prepare("update tls_scorm_sco_tracking set value=? where userid=? and scormid=? and element=? limit 1");
        $updatest->bind_param("siis",$coursestatus,$user_id,$course_id,$element);
        $updatest->execute();
        $updatest->close();
			
	}


	$element='cmi.core.lesson_location';
	$query = "select value from tls_scorm_sco_tracking where userid=? and scormid=? and element=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iis",$user_id,$course_id,$element);
    $stmt->execute();
	$stmt->bind_result($value); 
    $stmt->fetch();
    $stmt->close();
	if(!isset($value))
	{
		
               
		$element='cmi.core.lesson_location';
		$currentTime=time();
		$insertQ = $con->prepare("insert into tls_scorm_sco_tracking(userid,scormid,scoid,element,value,timemodified) values(?,?,?,?,?,?)");
        $insertQ->bind_param("iiisss",$user_id,$course_id,$course_id,$element,$bookmark,$currentTime);
        $insertQ->execute();
        $insertQ->close();
				
	}
	else
	{		
		$element='cmi.core.lesson_location';
		$updatest = $con->prepare("update tls_scorm_sco_tracking set value=? where userid=? and scormid=? and element=? limit 1");
        $updatest->bind_param("siis",$bookmark,$user_id,$course_id,$element);
        $updatest->execute();
        $updatest->close();
			
	}

	$element='cmi.core.score.raw';
	$query = "select value from tls_scorm_sco_tracking where userid=? and scormid=? and element=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iis",$user_id,$course_id,$element);
    $stmt->execute();
	$stmt->bind_result($value); 
    $stmt->fetch();
    $stmt->close();
	if(!isset($score))
	{
	$score=0;
	}
	if(!isset($value))
	{
		
               
		$element='cmi.core.score.raw';
		$currentTime=time();
		$insertQ = $con->prepare("insert into tls_scorm_sco_tracking(userid,scormid,scoid,element,value,timemodified) values(?,?,?,?,?,?)");
        $insertQ->bind_param("iiisss",$user_id,$course_id,$course_id,$element,$score,$currentTime);
        $insertQ->execute();
        $insertQ->close();
				
	}
	else
	{		
		$element='cmi.core.score.raw';
		$updatest = $con->prepare("update tls_scorm_sco_tracking set value=? where userid=? and scormid=? and element=? limit 1");
        $updatest->bind_param("siis",$score,$user_id,$course_id,$element);
        $updatest->execute();
        $updatest->close();
			
	}


	$element='cmi.suspend_data';
	$query = "select value from tls_scorm_sco_tracking where userid=? and scormid=? and element=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iis",$user_id,$course_id,$element);
    $stmt->execute();
	$stmt->bind_result($value); 
    $stmt->fetch();
    $stmt->close();
	
	if(!isset($value))
	{
		
               
		$element='cmi.suspend_data';
		$currentTime=time();
		$insertQ = $con->prepare("insert into tls_scorm_sco_tracking(userid,scormid,scoid,element,value,timemodified) values(?,?,?,?,?,?)");
        $insertQ->bind_param("iiisss",$user_id,$course_id,$course_id,$element,$visited_status,$currentTime);
        $insertQ->execute();
        $insertQ->close();
				
	}
	else
	{		
		$element='cmi.suspend_data';
		$updatest = $con->prepare("update tls_scorm_sco_tracking set value=? where userid=? and scormid=? and element=? limit 1");
        $updatest->bind_param("siis",$visited_status,$user_id,$course_id,$element);
        $updatest->execute();
        $updatest->close();
			
	}

	$element='cmi.core.session_time';
	$query = "select value from tls_scorm_sco_tracking where userid=? and scormid=? and element=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iis",$user_id,$course_id,$element);
    $stmt->execute();
	$stmt->bind_result($value); 
    $stmt->fetch();
    $stmt->close();
	

$uSec = $timespent % 1000;
$timespent = floor($timespent / 1000);

$seconds = $timespent % 60;
$timespent = floor($timespent / 60);

$minutes = $timespent % 60;
$timespent = floor($timespent / 60);  

$hours = $timespent % 60;
$timespent = floor($timespent / 60); 

$session_time="";

if((int)$hours < 10)
{
$hours="0".$hours;
}
if((int)$minutes < 10)
{
$minutes="0".$minutes;
}
if((int)$seconds < 10)
{
$seconds="0".$seconds;
}
$timespent=$hours.":".$minutes.":".$seconds;

	if(!isset($value))
	{
		
               
		$element='cmi.core.session_time';
		$currentTime=time();
		$insertQ = $con->prepare("insert into tls_scorm_sco_tracking(userid,scormid,scoid,element,value,timemodified) values(?,?,?,?,?,?)");
        $insertQ->bind_param("iiisss",$user_id,$course_id,$course_id,$element,$timespent,$currentTime);
        $insertQ->execute();
        $insertQ->close();
				
	}
	else
	{		
		$element='cmi.core.session_time';
		$updatest = $con->prepare("update tls_scorm_sco_tracking set value=? where userid=? and scormid=? and element=? limit 1");
        $updatest->bind_param("siis",$timespent,$user_id,$course_id,$element);
        $updatest->execute();
        $updatest->close();
			
	}

	

	/* 
	
	$query = "INSERT INTO user_session_tracking(user_id,session_id,session_type,center_id,user_role_id,ideal_seconds,actual_seconds,track_datettime,batch_id,course_code,platform,unique_code,location) values(?,?,?,?,2,500,?,?,?,?,?,?,?)";
	$stmt1 = $con->prepare($query);
	$stmt1->bind_param("iisiisissss",$user_id,$edge_id,$sessionType,$center_id,$second_spent,$dateTime,$batch_id,$course_code,$platform,$unique_code,$location);
	//file_put_contents('track.txt','insert===='.$location, FILE_APPEND);
	$stmt1->execute();
	$stmt1->close();
	}

    if ($con->error) {
        $retObj->status="FAILURE";
        $retObj->reason=$con->error;
    } else {
        $retObj->status="SUCCESS";
    }*/
	
}



function aduroRefreshToken($con, $loginid, $deviceId, $platform,$location){
	
		$stmt = $con->prepare("SELECT id FROM tbl_users WHERE loginid = ?");
		$stmt->bind_param("s",$loginid);
		$stmt->execute();
		$stmt->bind_result($user_id);
		$stmt->fetch();
		$stmt->close();
		
		//////////////     calculate  duration_in_days    ///////////////////////////////////
		$infoArr = array();
		$curDate = date('Y-m-d');
		
		$fetechstmt = $con->prepare("select session_id from api_session where user_id=? and valid_upto > NOW()");
		$fetechstmt->bind_param("i",$user_id);
		$fetechstmt->bind_result($ssid);
		$fetechstmt->execute();
		$fetechstmt->fetch();
		if(!isset($ssid) || $ssid===null || $ssid ==="") {
			$part1 = md5($user_id);
			$part2 = uniqid();
			$entireKey = $part1.$part2;
			$ssid = md5($entireKey);
		}
		$fetechstmt->close();
		
		
		$stmt = $con->prepare("SELECT firstname, last_name, loginid from tbl_users where user_id='".$user_id."'");
		$stmt->bind_result($fname,$lname, $loginid);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		
		//////error_log("ssid--------------------- ".$ssid);
		$updatest = $con->prepare("insert INTO api_session(user_id,session_id,valid_upto,app_version) values(?,?,DATE_ADD(NOW(), INTERVAL +4 HOUR),?) ON DUPLICATE KEY UPDATE session_id=?,valid_upto=DATE_ADD(NOW(), INTERVAL +4 HOUR)") or die ('some issue here '.$con->error);
		$xcv = $updatest->bind_param("isis",$user_id,$ssid,$param->appVersion,$ssid);
		$updatest->execute();
		$updatest->close();
		
		/*//$stmt = $con->prepare("SELECT a.system_name FROM asset a JOIN user u ON u.profile_pic = a.asset_id WHERE u.user_id = ".$user_id);
		$stmt->execute();
		$stmt->bind_result($system_name);
		$stmt->fetch();
		$stmt->close();	
		
*/


		$sr = new ServiceResponse("SUCCESS",0,null);
		$retVal->token = $ssid;
		//$retVal->profile_pic = $system_name;
		//$retVal->packageInfo = $infoArr;
		$retVal->name = $fname." ";
		if(isset($lname))
			$retVal->name .= $lname;
		$retVal->user_id = $user_id;
		$sr->setval($retVal);
		//////error_log("ssid--------------------- ".json_encode($sr));
        return $sr;
}

function aduroGetCertificate($con, $user_id, $param, $extraParams = array() ){
	
	if( empty($user_id) ){

		$sr = new ServiceResponse("FAILURE",0,null );
		$sr->retVal = new stdClass();
		return $sr;
	}
	
    $stmt = $con->prepare("SELECT level_name, cert_path, date(created_date) as cert_date, created_date as cert_timestamp FROM tbl_certificates WHERE user_id = ? ORDER by level ASC ");
    $stmt->bind_param('i', $user_id);
	$stmt->execute();
	$stmt->bind_result($level_name, $path, $date, $timestamp);
    $carr = array();
    while( $stmt->fetch()){
        
        $cert_obj = new stdClass();
		$cert_obj->level_name = $level_name;
        $cert_obj->path = $path;
        $cert_obj->date = $date;
        $cert_obj->timestamp = $timestamp;
        $carr[] = $cert_obj;
        
    }
	$stmt->close();
	return $carr;
	
 
}

function aduroContactUs($con, $user_id, $param, $extraParams = array() ){
	
	/*if( empty($user_id) ){

		$sr = new ServiceResponse("FAILURE",0,null );
		$sr->retVal = new stdClass();
		return $sr;
	}*/
	
    $name=$param->name;
	$email=$param->email;
	$subject=$param->subject;
	$message=$param->message;
	$insertC = $con->prepare("insert into tbl_contact_us(user_name,email,subject,message,date_created) values(?,?,?,?,NOW())");
    $insertC->bind_param("ssss",$name,$email,$subject,$message);
    $insertC->execute();
    $insertC->close();
	$mailStatus = sendMailContact($email, $subject, $message);

	$sr = new ServiceResponse("SUCCESS",1,null);
    $sr->retVal->msg = "Email has been sent!";
    return $sr;

}

function aduroGetUserMinditoryFilds($con, $param)
{
	$user_id =  $param->user_id;
	$sql = "SELECT id, firstname,lastname,sex,education,user_country,user_state,user_city,zip_code,organization,profession,education_details,profession_experience,learn_from FROM tbl_users WHERE id=?"; // SQL with 		   parameters
	$stmt = $con->prepare($sql); 
	$stmt->bind_param("s", $user_id);
	$stmt->execute();
	$result = $stmt->get_result(); // get the mysqli result
	$user = $result->fetch_assoc();

	$user_query_response = $user; 
	$download_status = 1;
	
	if ( empty($user_query_response['sex']) || empty($user_query_response['education']) || empty($user_query_response['user_country']) || empty($user_query_response['user_state']) || empty($user_query_response['user_city']) || 	empty($user_query_response['zip_code']) || empty($user_query_response['profession'])) {
		$download_status = 0;
	}
	if (!empty($user_query_response['education']) && empty($user_query_response['education_details'])) {
		$download_status = 0;
	}

	if (!empty($user_query_response['profession']) && $user_query_response['profession'] != 'Student') {
		if ( empty($user_query_response['profession_experience']) || empty($user_query_response['organization'])) {
			$download_status = 0;
		}
	}
	$user['download_status'] = $download_status;
	return $user;
	
}
function aduroUpdateCertificateFilds($con, $param)
{	
	$update_user_fildes = $con->prepare('UPDATE tbl_users SET sex=?,education=?, education_details=?,organization=?,profession=?, profession_experience=?, user_country=?, user_state=?, user_city=?, zip_code=? WHERE id=?');
	$update_user_fildes->bind_param('sssssssssss',$param->gender,$param->education,$param->education_details,$param->organization,$param->profession,$param->profession_experience,$param->user_country,$param->user_state,$param->user_city,$param->zip_code,$param->id);
	$update_user_fildes->execute();

	return 1;
}

function aduroGetUserProfile($con, $param)
{
	$user_id =  $param->user_id;
		$sql = "SELECT id,firstname,lastname,mobile,occupation,organization,designation,sex,learn_from,education,education_details,profession,profession_experience,user_country,user_state,user_city,zip_code,allow_email_for_marketing,allow_email_for_campaign FROM tbl_users WHERE id=?"; // SQL with parameters
		$stmt = $con->prepare($sql); 
		$stmt->bind_param("s", $user_id);
		$stmt->execute();
		$result = $stmt->get_result(); // get the mysqli result
		$user = $result->fetch_assoc();
		return $user;
}

function aduroUpdateUserProfile($con, $param)
{
	$update_user_fildes = $con->prepare('UPDATE tbl_users SET firstname=?,lastname=?,mobile=?,occupation=?,organization=?,designation=?,sex=?,learn_from=?,education=?,education_details=?,profession=?,profession_experience=?,user_country=?,user_state=?,user_city=?,zip_code=?,allow_email_for_marketing=?,allow_email_for_campaign=? WHERE id=?');
	$update_user_fildes->bind_param('sisssssssssssssssss',$param->firstname,$param->lastname,$param->mobile,$param->occupation,$param->organization,$param->designation,$param->sex,$param->learn_from,$param->education,$param->education_details,$param->profession,$param->profession_experience,$param->user_country,$param->user_state,$param->user_city,$param->zip_code,$param->allow_email_for_marketing,$param->allow_email_for_campaign,$param->id);
	$update_user_fildes->execute();

	return 1;
}
