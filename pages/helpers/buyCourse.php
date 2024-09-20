<?
include ("../../../connect.php");

$user_id = $_POST['email'];
$client_id = 2;
$bundle_id = $_POST['bundle'];


if ($user_id == '' || $user_id === '' || $user_id == null)
	{
	$err_code = 100;
	sendResponse($err_code);
	exit;
	}else{
	$int = preg_match_all("/[^a-zA-Z0-9_\.@-]/i", $user_id);
		
		if ($int == 0)
			{}else{
			$err_code = 100;
			sendResponse($err_code);
			exit;
			}
	}


if ($bundle_id == '' || $bundle_id === '' || $bundle_id == null)
	{
	$err_code = 100;
	sendResponse($err_code);
	exit;
	}
  else
	{
	$result_bundle = mysql_query("SELECT * FROM tbl_b2client_bundle where client_id='$client_id'") or die("1Failed Query of " . mysql_error());
	
	$bundle_exist = 0;
	while($row = mysql_fetch_array($result_bundle)){
	
	if(trim(strtolower($bundle_id)) == strtolower($row['bundle'])){
	$bundle_exist = 1;
	$courses = explode(',' , $row['bundle_desc']);
	}
	}
		
	if ($bundle_exist == 0){
	$err_code = 100;
	sendResponse($err_code);
	exit;
	}
	
	
	$non_int = 0;
	for ($i = 0; $i < sizeof($courses); ++$i)
		{
		$int = preg_replace('/^[0-9]*/', '', $courses[$i]);
		if ($int == '' || $int == null || $int === '')
			{
			if ($courses[$i] == '' || $courses[$i] == null || $courses[$i] === '')
				{
				$non_int = 1;
				}
			}
		  else
			{
			$non_int = 1;
			}
		}

	if ($non_int == 1)
		{
		$err_code = 100;
		sendResponse($err_code);
		exit;
		}
		
	}
	
	$result4 = mysql_query("SELECT * FROM tbl_b2client_admin where client_id='$client_id'") or die("1Failed Query of " . mysql_error());
	$cResult = mysql_fetch_array($result4);
	$company_id = $cResult['company_id'];
	
	
	
for ($i = 0; $i < sizeof($courses); ++$i){
		$result4 = mysql_query("SELECT course_id FROM tbl_category_course where category_id='$company_id'") or die("1Failed Query of " . mysql_error());
		$exist = 0;
		while($row = mysql_fetch_array($result4)){
			if($courses[$i] == $row['course_id']){
				$exist = 1;
			}
		}
		
		if ($exist == 0){
		$err_code = 100;
		sendResponse($err_code);
		exit;
		}
	
	}
	

$todayDate = date("Y-m-d");
$expiryDate = date('Y-m-d', strtotime(date("Y-m-d") . ' + 186 days'));
$date = date_create();
$timeStamp = date_timestamp_get($date);
$result3 = mysql_query("SELECT * FROM tbl_b2client where client_id=$client_id and username='$user_id'") or die("1Failed Query of " . mysql_error());
$numrows = mysql_numrows($result3);



if ($numrows)
	{
	$cResult = mysql_fetch_array($result3);
	$existing_password = $cResult['password'];
	$launch_token = md5($client_id . "-" . $user_id . "-" . $bundle_id . "-" . $timeStamp);
	for ($i = 0; $i < sizeof($courses); ++$i)
		{
		$token = md5($client_id . "-" . $user_id . "-" . $courses[$i] . "-" . $timeStamp);
		$final_url .= $static_url . '?token='.$token;
		if($i < sizeof($courses) - 1){
		$final_url .= ',';
		}
		mysql_query("INSERT INTO tbl_b2client (client_id, username, password, token, launch_token , course_id, registration_date, expiry_date ,status) VALUES ('$client_id','$user_id','$existing_password','$token','$launch_token','$courses[$i]','$todayDate','$expiryDate' , '0')") or die("Failed Query of " . mysql_error());
		}
	
	$err_code = 0;
	sendResponse($err_code);
	exit;
	
	}else{
	$err_code = 200;
	sendResponse($err_code);
	exit;
	}
	
	function sendResponse($err_code)
	{
	header("Location: courses.php?err_code=".$err_code);
	}

?>