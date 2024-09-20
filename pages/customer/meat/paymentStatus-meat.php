<? 

if (isset($_POST['source']) == 1){
}else{
header("location: ../customer/discount.php");
exit;
}


$paymentStatus = $_POST['payment_status'];
$orderID = $_POST['payment_status_order_id'];



$result = mysql_query("SELECT * FROM tbl_order where order_id = '$orderID'") or die("1Failed Query of " . mysql_error());
while ($row = mysql_fetch_object($result)) {
    $bundle_id = $row->bundle_id;
	$user_id = $row->username;
	$voucher_code = $row->voucher_code;
}


if ($paymentStatus == 0){
	include ("paymentFailed.php");
}else{

	$courseAssignStatus = assignCourse($user_id , $bundle_id , $orderID);
	if($courseAssignStatus == 0){
	$result_bundle = mysql_query("UPDATE tbl_order set status = 1 where order_id='$orderID'") or die("1Failed Query of " . mysql_error());
	
	if($voucher_code != '' || $voucher_code != null){
	
	$result = mysql_query("SELECT * FROM tbl_b2c_voucher where voucher_code = '$voucher_code'") or die("1Failed Query of " . mysql_error());
	$row = mysql_fetch_object($result);
    $voucher_id = $row->id;
	
	mysql_query("UPDATE tbl_b2c_voucher_course set status = 1 where voucher_id='$voucher_id' and course_id = '$bundle_id'") or die("1Failed Query of " . mysql_error());
	}
	
	include ("paymentSuccess.php");
	}else{
	echo "There was some issues in assigning course. Please contact support. Error = $courseAssignStatus";
	}
}







function assignCourse($user_id , $bundle_id , $orderID){
$client_id = 2;
if ($user_id == '' || $user_id === '' || $user_id == null)
	{
	$err_code = 100;
	
	return $err_code;
	}else{
	$int = preg_match_all("/[^a-zA-Z0-9_\.@-]/i", $user_id);
		
		if ($int == 0)
			{}else{
			$err_code = 100;
			
			return $err_code;
			}
	}


if ($bundle_id == '' || $bundle_id === '' || $bundle_id == null)
	{
	$err_code = 100;
	
	return $err_code;
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
	
	return $err_code;
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
		
		return $err_code;
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
		
		return $err_code;
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
		
		if($i < sizeof($courses) - 1){
		
		}
		mysql_query("INSERT INTO tbl_b2client (client_id, username, password, token, launch_token , order_id, course_id, bundle_id, registration_date, expiry_date ,status) VALUES ('$client_id','$user_id','$existing_password','$token','$launch_token','$orderID','$courses[$i]', '$bundle_id','$todayDate','$expiryDate' , '0')") or die("Failed Query of " . mysql_error());
		}
	
	$err_code = 0;
	
	return $err_code;
	
	}else{
	$err_code = 200;
	error_log("INSERT INTO tbl_b2client (client_id, username, password, token, launch_token , order_id, course_id, bundle_id, registration_date, expiry_date ,status) VALUES ('$client_id','$user_id','$existing_password','$token','$launch_token','$orderID','$courses[$i]', '$bundle_id','$todayDate','$expiryDate' , '0')");
	return $err_code;
	}
}


?>