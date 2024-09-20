<?php
/* This file carries all decree handlers 
   Only the decrees in this file should be honored 
   All decree functions should be declared as decree_<decree_name>
*/
require_once  __DIR__."/configure.php";
require_once  __DIR__."/aduro_connect.php";

## DECREE : token
## Category 
##       Authentication
## Input param
##       login  : user login
##       password : use password 
## Output Obj
##       token
function decree_token($token, $param, $extraParam = array()) {
    /* To get a login token - valid for 4 hours */
    $login = $param->login;
    $password = $param->password;
    file_put_contents("token.txt","test");
  //  error_log(json_encode($param));
    /* Check the Database for validity */
    $con = createConnection();
    if($con == null)
       return 0;
    $ssid = aduroGetToken($con,$login,$password);
    closeConnection($con);
    $sr = new ServiceResponse("SUCCESS",1,$ssid);
   // error_log(json_encode($sr));
    return $sr;
}

## DECREE : login
## Category 
##       Authentication
## Input param
##       login  : user login
##       password : use password 
## Output Obj
##       token : the tokem for this session
##       name  : name of the user
function decree_login($token, $param, $extraParams = array()) {
	$alert_msg_arr = aduroAlertMessage();
    /* To get a login token - valid for 4 hours */
	//error_log("Param is while login --------------------- ".json_encode($param));
    $login = $param->login;
    $password = $param->password;
      
    /* Check the Database for validity */
    $con = createConnection();
    if($con == null)
       return 0;
	//////////////////////////////////////////////////// for central licensing //////////////////////////////////////////   
		$password=md5($password);
		$ssid = aduroDoLogin($con,$login,$password);
	
		if(!isset($ssid) || $ssid == null)
		{
			$sr = new ServiceResponse("LOGIN_FAILED",0,null);
			$sr->setCode("LOGIN_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['LOGIN_FAILED'];
		}elseif($ssid->isActive=="0")
		{
			$sr = new ServiceResponse("LOGIN_FAILED",0,null);
			$sr->setCode("LOGIN_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['LOGIN_ACTIVATION'];
		}
		else 
		 {
			$sr = new ServiceResponse("SUCCESS",1,$ssid);
			$sr->retVal->msg = "Logged in successfully";
			$sr->setCode("SUCCESS");
			$sr->setStat(1);
			$sr->setVal($ssid);
		 }
			
	closeConnection($con);
    return $sr;
}


## DECREE : register
## Category 
##       Authentication
## Input param
##       login  : user login
##       password : use password 
## Output Obj
##       token : the tokem for this session
##       name  : name of the user
function decree_register($token,$param, $extraParams = array()) {

	$alert_msg_arr = aduroAlertMessage();
	//error_log("Param is while register --------------------- ".json_encode($param));
	$email_id = trim($param->email_id);
    $last_name = trim($param->last_name);
    $first_name = trim($param->first_name);
    $mobile = trim($param->mobile);
    $password = trim($param->password);
    $cpassword = trim($param->cpassword);

	if($first_name==""){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_FIRSTNAME'];
			return $sr;
	}
	if($first_name!=""){
		if(!preg_match('/^[a-zA-Z ]*$/',$first_name)){
			$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['FIRSTNAME_ALPHA'];
			return $sr;
		}
		
	}
	if($last_name==""){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_LASTNAME'];
			return $sr;
	}
	
	if($last_name!=""){
		if(!preg_match('/^[a-zA-Z ]*$/',$last_name)){
			$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['LASTNAME_ALPHA'];
			return $sr;
		}
		
	}
	
	if($email_id==""){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_EMAIL'];
			return $sr;
	}
	if($mobile!=""){
		
		if(!preg_match('/^[0-9]{10}+$/', $mobile)) {
			
			$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['PHONE_VALID'];
			return $sr;
				
		}
	}
	if($password==""){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_PASSWORD'];
		    return $sr;
	}
	
	if($password!=""){
		$containsLetter  = preg_match('/[a-zA-Z]/', $password);
		$containsDigit   = preg_match('/\d/',$password);
		$containsSpecial = preg_match('/[^a-zA-Z\d]/',$password);
		if(!$containsLetter || !$containsDigit || !$containsSpecial || strlen($password) < 6 || strlen($password) > 12) {
			$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['PASSWORD_VALID'];
		    return $sr;
		}
	}
	if($cpassword==""){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_CPASSWORD'];
			return $sr;
	}
	if($password!=$cpassword){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['PASSWORD_SAME'];
			return $sr;
	}
	
      
    /* Check the Database for validity */
    $con = createConnection();
    if($con == null)
       return 0;
	//////////////////////////////////////////////////// Check Email  //////////////////////////////////////////   
	
		$uid = aduroCheckEmail($con,$email_id);
		if($uid==true){
			$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['EMAIL_EXIST'];
		}
		else{
	
			$details = new stdClass();
			$details->email_id = trim($param->email_id);
			$details->last_name = trim($param->last_name);
			$details->first_name = trim($param->first_name);
			$details->mobile = trim($param->mobile);
			$details->password =md5(trim($param->password));
			$details->occupation = trim($param->occupation);
			$details->organization = trim($param->organization);
			$details->designation = trim($param->designation);
			$details->device_type = trim($param->device_type);
			$details->device_id = trim($param->device_id);
		
			$ssid = aduroDoRegister($con,$details);
			if(!isset($ssid) || $ssid == null)
			{
				$sr = new ServiceResponse("REGISTER__FAILED",1,null);
				$sr->setCode("REGISTER__FAILED");
				$sr->setStat(0);
				$sr->retVal = new stdClass();
				$sr->retVal->msg = $alert_msg_arr['REGISTER__FAILED'];
			}
			else 
			 {
				
				$sr = new ServiceResponse("SUCCESS",0,$null);
				$sr->setCode("SUCCESS");
				$sr->setStat(1);
				$sr->setVal($ssid);
				$sr->retVal = new stdClass();
				$sr->retVal->msg = $alert_msg_arr['EMAIL_ACTIVATION'];
				
			}
		}	
	closeConnection($con);
    return $sr;
}


function decree_register_v2($token,$param, $extraParams = array()) {

	$alert_msg_arr = aduroAlertMessage();

	$first_name = trim($param->first_name);
	$last_name = trim($param->last_name);
	$email_id = trim($param->email_id);
	$password = trim($param->password);
    $cpassword = trim($param->cpassword);
    $mobile = trim($param->mobile);
    

	if($first_name==""){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_FIRSTNAME'];
			return $sr;
	}
	if($first_name!=""){
		if(!preg_match('/^[a-zA-Z ]*$/',$first_name)){
			$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['FIRSTNAME_ALPHA'];
			return $sr;
		}
		
	}
	if($last_name==""){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_LASTNAME'];
			return $sr;
	}
	if($last_name!=""){
		if(!preg_match('/^[a-zA-Z ]*$/',$last_name)){
			$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['LASTNAME_ALPHA'];
			return $sr;
		}
		
	}
	if($email_id==""){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_EMAIL'];
			return $sr;
	}
	if($mobile!=""){
		
		if(!preg_match('/^[0-9]{10}+$/', $mobile)) {
			
			$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['PHONE_VALID'];
			return $sr;
				
		}
	}
	if($password==""){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_PASSWORD'];
		    return $sr;
	}
	if($password!=""){
		$containsLetter  = preg_match('/[a-zA-Z]/', $password);
		$containsDigit   = preg_match('/\d/',$password);
		$containsSpecial = preg_match('/[^a-zA-Z\d]/',$password);
		if(!$containsLetter || !$containsDigit || !$containsSpecial || strlen($password) < 6 || strlen($password) > 12) {
			$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['PASSWORD_VALID'];
		    return $sr;
		}
	}
	if($cpassword==""){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_CPASSWORD'];
			return $sr;
	}
	if($password!=$cpassword){
		$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['PASSWORD_SAME'];
			return $sr;
	}
	
      
    /* Check the Database for validity */
    $con = createConnection();
    if($con == null)
       return 0;
	//////////////////////////////////////////////////// Check Email  //////////////////////////////////////////   
	
		$uid = aduroCheckEmail($con,$email_id);
		if($uid==true){
			$sr = new ServiceResponse("REGISTRATION_FAILED",1,null);
			$sr->setCode("REGISTRATION_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['EMAIL_EXIST'];
		}
		else{
			
			$details = new stdClass();
			$details->first_name = trim($param->first_name);
			$details->last_name = trim($param->last_name);
			$details->email_id = trim($param->email_id);
			$details->mobile = trim($param->mobile);
			$details->password =md5(trim($param->password));
			$details->username = trim($param->email_id);
			$details->sex = trim($param->sex);
			$details->education = trim($param->education);
			$details->profession = trim($param->profession);
			$details->learn_from = trim($param->learn_from);
			$details->allow_email_for_marketing = trim($param->email_marketing);
			$details->allow_email_for_campaign = trim($param->email_campaign);
			$details->organization = trim($param->organization);
			$details->designation = trim($param->designation);
			$details->device_type = trim($param->device_type);
          
          	$details->social_login_type = trim($param->social_login_type);
			$details->social_login_id = trim($param->social_login_id);
          
			$details->device_id = trim($param->device_id);
		
			$ssid = aduroDoRegister($con,$details);
			if(!isset($ssid) || $ssid == null)
			{
				$sr = new ServiceResponse("REGISTER__FAILED",1,null);
				$sr->setCode("REGISTER__FAILED");
				$sr->setStat(0);
				$sr->retVal = new stdClass();
				$sr->retVal->msg = $alert_msg_arr['REGISTER__FAILED'];
			}
			else 
			 {
				
				$sr = new ServiceResponse("SUCCESS",0,$null);
				$sr->setCode("SUCCESS");
				$sr->setStat(1);
				$sr->setVal($ssid);
				$sr->retVal = new stdClass();
				$sr->retVal->msg = $alert_msg_arr['EMAIL_ACTIVATION'];
				
			}
		}	
	closeConnection($con);
    return $sr;
}



## DECREE : getLoginIDFromToken
## Returns the uid of the token issuer in case of success and -1 if fails.
## Category 
##       Authentication
## Input param
##     token 
## Output param
##     uid
function decree_getLoginIDFromToken($token) {
    $con = createConnection();
	
	$user_id = tokenValidate($con,$token); 
	$loginid = aduroGetLoginIDFromUserID($con,$user_id);

	closeConnection($con);
	
	if ($loginid == null || $loginid == "" || $loginid == " ")
		$loginid = -1;
	
	return $loginid;
}




## DECREE : frgtpass
## Forgot Password Service - given the user name it will send the password to the registered emailid
## Category
##      Authentication
## Input param 
##      login_id : varchar
## Output Object
##      msg : message to display to the user
function decree_frgtpass($token, $param, $extraParams = array()) {
    $con = createConnection();
   // $sr = aduroResetAndSendPassword($con,$param->login_id,$param->class_name);
    $sr = aduroDoResetAndSendPassword($con,$param->email_id);
    closeConnection($con);
    return $sr;
}


## DECREE : chngpass
## Change Password Service - Give the old password, new password and confirm new password your password will be change to new
## Category
##      Authentication
## Input param 
##      login_id : varchar
## Output Object
##      msg : message to display to the user
function decree_chngpass($token,$param, $extraParams = array()){
    $con = createConnection();
	$alert_msg_arr = aduroAlertMessage();
   //$sr = aduroResetAndSendPassword($con,$param->login_id,$param->class_name);
   $email_id=trim($param->email_id);
   $old_password=trim($param->old_password);
   $new_password=trim($param->new_password);
   $new_cpassword=trim($param->new_cpassword);
   if($email_id==""){
		$sr = new ServiceResponse("PASSWORDCHANGE_FAILED",1,null);
			$sr->setCode("PASSWORDCHANGE_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_EMAIL'];
			return $sr;
	}
	if($old_password==""){
		$sr = new ServiceResponse("PASSWORDCHANGE_FAILED",1,null);
		$sr->setCode("PASSWORDCHANGE_FAILED");
		$sr->setStat(0);
		$sr->retVal = new stdClass();
		$sr->retVal->msg = $alert_msg_arr['REQUIRED_OLDPASSWORD'];
		return $sr;
	}
	if($new_password==""){
		$sr = new ServiceResponse("PASSWORDCHANGE_FAILED",1,null);
		$sr->setCode("PASSWORDCHANGE_FAILED");
		$sr->setStat(0);
		$sr->retVal = new stdClass();
		$sr->retVal->msg = $alert_msg_arr['REQUIRED_NEWPASSWORD'];
		return $sr;
	}
	if(strlen($new_password)<6){
		$sr = new ServiceResponse("PASSWORDCHANGE_FAILED",1,null);
		$sr->setCode("PASSWORDCHANGE_FAILED");
		$sr->setStat(0);
		$sr->retVal = new stdClass();
		$sr->retVal->msg = $alert_msg_arr['PASSWORD_MINLENGTH'];
		return $sr;
	}
	if($new_cpassword==""){
		$sr = new ServiceResponse("PASSWORDCHANGE_FAILED",1,null);
			$sr->setCode("PASSWORDCHANGE_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['REQUIRED_CPASSWORD'];
			return $sr;
	}
	if($new_password!=$new_cpassword){
		$sr = new ServiceResponse("PASSWORDCHANGE_FAILED",1,null);
			$sr->setCode("PASSWORDCHANGE_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = $alert_msg_arr['PASSWORD_SAME'];
			return $sr;
	}
    $sr = aduroDoChangePassword($con,$email_id,$old_password,$new_password);
    closeConnection($con);
    return $sr;
}




## DECREE : getUidFromToken
## Returns the uid of the token issuer in case of success and -1 if fails.
## Category 
##       Authentication
## Input param
##     token 
## Output param
##     uid
##     
function decree_getUidFromToken($token) {
    $con = createConnection();
    $user_id = tokenValidate($con,$token); 
    
    return $user_id;
}



function decree_refreshtoken($token, $param, $extraParams = array()){
    $con = createConnection();
    //$user_id = tokenValidate($con,$token);
    $sr = new ServiceResponse("NO_ACTION",0,null);
	//////error_log('refreshtoken=============================='.json_encode($param));
	//$user_id = 130757;
	$login = $param->login;
    $password = $param->password;
	$deviceId = $param->deviceId;
    $platform = $param->platform;
	$client = $param->client;
	/*$res = array();
	if(isset($param->package_codes) && count($param->package_codes) > 0){
		$package_codes = implode(',',$param->package_codes);
		$request = curl_init('http://courses.englishedge.in/englishedge-admin/service.php');
		curl_setopt($request, CURLOPT_POST, true);
		curl_setopt($request,CURLOPT_POSTFIELDS,array('action' => 'getCurrentPackageDtl', 'package_codes' => $package_codes));
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($request);
		curl_close($request);
		$res = json_decode($res);
	
	}*/
	
    if($login != "") {
        //$sr  = aduroRefreshToken($con, $login, $res, $deviceId, $platform);
		$sr  = aduroRefreshToken($con, $login, $deviceId, $platform, $client);
   } else {
        $sr->setCode("TOKEN_EXPIRED");
        $sr->setStat(0);
   }
    closeConnection($con);
    return $sr;
}

function decree_user_device_token($token, $param, $extraParams = array()){
    $con = createConnection();
    $user_id = tokenValidate($con,$token);
    $sr = new ServiceResponse("NO_ACTION",0,null);
	
	$platform = $param->platform;
	$deviceId = $param->deviceId;
	$product_codes = implode(',',$param->product_codes);
	$token_value = $param->token_value;
	//error_log('decree_user_device_token=============================='.json_encode($param));
	//error_log('product_codes=============================='.$product_codes);
	//$user_id = 130757;
    if($user_id >=0) {
		global $serviceURL;
		//$request = curl_init('http://courses.englishedge.in/englishedge-admin/service.php');
		$request = curl_init($serviceURL);
		curl_setopt($request, CURLOPT_POST, true);
		curl_setopt($request,CURLOPT_POSTFIELDS,array('action' => 'userDeviceToken', 'platform' => $platform, 'deviceId' => $deviceId, 'product_codes' => $product_codes, 'token_value' => $token_value, 'user_id' => $user_id));
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($request);
		curl_close($request);
		$res = json_decode($res);
		$sr = new ServiceResponse("SUCCESS",0,null);
		$retVal->token_res = $res;
		$sr->setval($retVal);
        
   } else {
        $sr->setCode("TOKEN_EXPIRED");
        $sr->setStat(0);
   }
    closeConnection($con);
    return $sr;
}


function decree_courseDetails($token) {
    $con = createConnection();
	$user_id = tokenValidate($con,$token); 
	$courseDetails = getCourseDetails($con);
	file_put_contents("getCourseDetails.txt",$user_id);
	if( !empty($courseDetails) )
	{
			$sr = new ServiceResponse("SUCCESS",1,$user_id);
			$sr->retVal->msg = "";
			$sr->setCode("SUCCESS");
			$sr->setStat(1);
			$sr->setVal($courseDetails);
	}
	else
	{
		$sr = new ServiceResponse("FAILED",1,$user_id);
			$sr->retVal->msg = "";
			$sr->setCode("FAILED");
			$sr->setStat(0);
			//$sr->setVal($ssid);
	}
	closeConnection($con);
	return $sr;
}

function decree_getStudentProgress($token) {
    $con = createConnection();
	$user_id = tokenValidate($con,$token);
//	file_put_contents("dev1.txt",$user_id);
	$progressDetails = getStudentProgress($con,$user_id);

	
	if( !empty($progressDetails) )
	{
			$sr = new ServiceResponse("SUCCESS",1,$user_id);
			$sr->retVal->msg = "";
			$sr->retVal->is_download_status =  $progressDetails['is_download_status'];
			$sr->setCode("SUCCESS");
			$sr->setStat(1);
			$sr->setVal($progressDetails['darr']);
	}
	else
	{
		$sr = new ServiceResponse("FAILED",1,$user_id);
			$sr->retVal->msg = "";
			$sr->setCode("FAILED");
			$sr->setStat(0);
			//$sr->setVal($ssid);
	}
	closeConnection($con);
	return $sr;
}


function decree_track($token, $param, $extraParams = array()) {
    $con = createConnection();
    $user_id = tokenValidate($con,$token);
    $sr = new ServiceResponse("NO_ACTION",0,null);
	
    if($user_id >=0) {
        //file_put_contents("test2.txt",$param->course_id);
            foreach($param as $obj) {	
				if($obj->course_id != ""){
					//file_put_contents("test1.txt","in decree");
					$objRet  = trackUserData($con,$user_id,$obj->course_id,$obj->bookmark,$obj->visited_status, $obj->timespent, $obj->coursestatus,$obj->score);

				}
				else
				{
					//error_log("please check end time = $obj->end_date_ms and edge_id = $obj->edge_id");
					//$sr = new ServiceResponse("NO_ACTION",0,null);
				}
			}	
			$sr->setVal($objRet);
			$sr->setCode("SUCCESS");
			$sr->setStat(1);

    } 
	else 
	{
		$sr->setCode("TOKEN_EXPIRED");
        $sr->setStat(0);
    }
    closeConnection($con);
    return $sr;
}

function decree_certificate($token, $param, $extraParams = array() ) {
	
    $con = createConnection();
	$user_id = tokenValidate($con,$token);
    $sr = new ServiceResponse("NO_ACTION",0,null);
    if($user_id >=0) {
		
        $sr = aduroGetCertificate($con, $user_id, $param, $extraParams ); 
        
   } else {
        $sr->setCode("TOKEN_EXPIRED");
        $sr->setStat(0);
   }
	
    closeConnection($con);
    return $sr;
}

function decree_contactUs($token, $param, $extraParams = array() ) {
	
    $con = createConnection();
	//$user_id = tokenValidate($con,$token);
    //$sr = new ServiceResponse("NO_ACTION",0,null);
    //if($user_id >=0) {
		$user_id=0;
        $sr = aduroContactUs($con, $user_id, $param, $extraParams ); 
        
  // } else {
   //     $sr->setCode("TOKEN_EXPIRED");
  //      $sr->setStat(0);
  // }
	
    closeConnection($con);
    return $sr;
}

function decree_certificate_fields($token, $param, $extraParams = array() ) {

	$con = createConnection();
	$data = aduroGetUserMinditoryFilds($con,  $param);
	$sr = new ServiceResponse("SUCCESS",1,$user_id);
	$sr->retVal->msg = "";
	$sr->setCode("SUCCESS");
	$sr->setStat(1);
	$sr->setVal($data);
	closeConnection($con);
	return $sr;
}

function decree_update_certificate_fields($token, $param, $extraParams = array() ) {

	$con = createConnection();
	$data = aduroUpdateCertificateFilds($con,  $param);
	$sr = new ServiceResponse("SUCCESS",1,$user_id);
	$sr->retVal->msg = "Updated";
	$sr->setCode("SUCCESS");
	$sr->setStat(1);
	closeConnection($con);
	return $sr;
}

function decree_get_user_profile($token, $param, $extraParams = array() ) {

	$con = createConnection();
	$data = aduroGetUserProfile($con,  $param);
	$sr = new ServiceResponse("SUCCESS",1,$user_id);
	$sr->retVal->msg = "";
	$sr->setCode("SUCCESS");
	$sr->setStat(1);
	$sr->setVal($data);
	closeConnection($con);
	return $sr;
}

function decree_update_user_profile($token, $param, $extraParams = array() ) {

	$con = createConnection();
	$data = aduroUpdateUserProfile($con,  $param);
	$sr = new ServiceResponse("SUCCESS",1,$user_id);
	$sr->retVal->msg = "Updated";
	$sr->setCode("SUCCESS");
	$sr->setStat(1);
	closeConnection($con);
	return $sr;
}

function decree_social_login($token, $param, $extraParams = array() ) {

	$con = createConnection();

	$social_login_type = trim($param->social_login_type);
    $social_login_id = trim($param->social_login_id);
	$email = trim($param->email);
    $social_input_field = 'google_id';

	if ( $social_login_type == 'facebook') {
        $social_input_field = 'facebook_id';
    }
    if ( $social_login_type == 'linkedin') {
        $social_input_field = 'linkedin_id';
    }
    if ( $social_login_type == 'twitter') {
        $social_input_field = 'twitter_id';
    }
	
	if(empty($email)){
		$social_exist_user = $con->prepare("SELECT * FROM tbl_users WHERE social_login_type=? and  $social_input_field =?"); 
		$social_exist_user->bind_param("ss",$social_login_type,$social_login_id);
		$social_exist_user->execute();
		$social_exist_user_result = $social_exist_user->get_result(); // get the mysqli result
		$social_exist_user_data = $social_exist_user_result->fetch_assoc();
		
		if (is_array($social_exist_user_data) && count($social_exist_user_data) > 0) {
			
			if ($social_exist_user_data['social_login_with_other_email'] == 1 && $social_exist_user_data['isActive'] == '0') {
				$sr = new ServiceResponse("SOCIAL_LOGIN_FAILED",1,null);
				$sr->setCode("EMAIL_NOT_VERIFIED");
				$sr->setStat(0);
				$sr->retVal = new stdClass();
				$sr->retVal->msg = "Your Email is not verified. Kindly verify the same using the link sent on your registered Email Address.";
				return $sr;
			}else{
				$sr = new ServiceResponse("SUCCESS",1,$social_exist_user_data['id']);
				$sr->retVal->msg = "Logged in successfully";
				$sr->setCode("SUCCESS");
				$sr->setStat(1);
				$sr->setVal(getSocialLoginData($social_exist_user_data['id']));
				return $sr;
			}			
		}else{
			$sr = new ServiceResponse("SOCIAL_LOGIN_FAILED",1,null);
			$sr->setCode("SOCIAL_LOGIN_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = "Email field is required.";
			return $sr;
		}
	}

	//$exist_user =  mysql_query("SELECT * FROM tbl_users where email='$email'");
	$exist_user_by_email = $con->prepare("SELECT * FROM tbl_users WHERE email=?"); 
	$exist_user_by_email->bind_param("s",$email);
	$exist_user_by_email->execute();
	$exist_user_by_email_result = $exist_user_by_email->get_result(); // get the mysqli result
	$exist_user_data = $exist_user_by_email_result->fetch_assoc();
		
	if (is_array($exist_user_data) && count($exist_user_data) > 0) {
		$user_id = $exist_user_data['id'];
		if ($exist_user_data['is_social_login'] == 1) {
			if ($exist_user_data['social_login_type'] = $social_login_type) {
				$sr = new ServiceResponse("SUCCESS",1,$user_id);
				$sr->retVal->msg = "Logged in successfully";
				$sr->setCode("SUCCESS");
				$sr->setStat(1);
				$sr->setVal(getSocialLoginData($exist_user_data['id']));
				return $sr;
			}else{
				$update_user = $con->prepare("UPDATE tbl_users SET social_login_type=?, $social_input_field=? WHERE id=?");
				$update_user->bind_param('ssi',$social_login_type,$social_login_id,$user_id);
				$update_user->execute();
					
				$sr = new ServiceResponse("SUCCESS",1,$user_id);
				$sr->retVal->msg = "Logged in successfully";
				$sr->setCode("SUCCESS");
				$sr->setStat(1);
				$sr->setVal(getSocialLoginData($exist_user_data['id']));
				return $sr;
			}
		}else{
			$update_user = $con->prepare("UPDATE tbl_users SET social_login_type=?, $social_input_field=? WHERE id=?");
			$update_user->bind_param('ssi',$social_login_type,$social_login_id,$user_id);
			$update_user->execute();
					
			$sr = new ServiceResponse("SUCCESS",1,$user_id);
			$sr->retVal->msg = "Logged in successfully";
			$sr->setCode("SUCCESS");
			$sr->setStat(1);
			$sr->setVal(getSocialLoginData($exist_user_data['id']));
			return $sr;
		}
	}else{

		$firstname = isset( $param->firstname)  ? $param->firstname :'';
    	$lastname = isset($param->lastname)  ? $param->lastname :'';
    	$password =  md5($email);
    	$sex = isset($param->gender) ? $param->gender:NULL;
		$device_type	 = isset($param->device_type) ? $param->device_type:NULL;
		$device_id = isset($param->device_id) ? $param->device_id:NULL;
    		
		$create_user = $con->prepare("INSERT INTO tbl_users (firstname,lastname,username,password,userregistered,usertype,email,social_login_type,device_id,$social_input_field) 	VALUES(?,?,?,?,1,1,?,?,?,?)");
		$create_user->bind_param('ssssssss',$firstname,$lastname,$email,$password,$email,$social_login_type,$device_id,$social_login_id);
		$create_user->execute();
		$lastId = $create_user->insert_id;
		if ($lastId) {
			$last_insert_user = $con->prepare("SELECT * FROM tbl_users WHERE id=?"); 
			$last_insert_user->bind_param("i",$lastId);
			$last_insert_user->execute();
			$last_insert_user_result = $last_insert_user->get_result(); // get the mysqli result
			$last_insert_user_data = $last_insert_user_result->fetch_assoc();

			$sr = new ServiceResponse("SUCCESS",1,$lastId);
			$sr->retVal->msg = "Logged in successfully";
			$sr->setCode("SUCCESS");
			$sr->setStat(1);
			$sr->setVal($lastId);
			$sr->setVal(getSocialLoginData($lastId));
			return $sr;
		}else{
			$sr = new ServiceResponse("LOGIN_FAILED",0,null);
			$sr->setCode("LOGIN_FAILED");
			$sr->setStat(0);
			$sr->retVal = new stdClass();
			$sr->retVal->msg = 'LOGIN FAILED';
			return $sr;
		}

	}
}


function getSocialLoginData($user_id)
{
	$con = createConnection();
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
	
	
	
  
  
  $user_info_query = "SELECT * FROM tbl_users WHERE id=?"; 
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


	$obj->token = $ssid;
	$obj->user_id = $user_id;
	$obj->username = $user_query_response['username'];
	$obj->fname = $user_query_response['firstname'];
	$obj->lname = $user_query_response['lastname'];
	$obj->user_pic = $user_query_response['user_pic'];
	$obj->isActive = $user_query_response['isActive'];
	$obj->download_status = $download_status;
	return $obj;	
}


?>