<? 

session_start();
include ("../../../connect.php");

 // Connection to database

include ("../../../global/functions.php");
//include ("func.php");

 // Connection to database

	
	$user_id = $_REQUEST['username'];
	$user_id = "drp_$user_id";
	$email = $_REQUEST['email'];
	$client_id = 2;
	$bundle_id = 'demo-b2c';
	$order_id = 'SignUp';
	$firstName = $_REQUEST['firstname'];
	$lastName = '';
	$password = $_REQUEST['password'];
	$mobile = 2222222222;


if ($client_id == '' || $client_id === '' || $client_id == null)
	{
	$err_code = 100;
	sendResponse($err_code);
	exit;
	}
		
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
	
	//All the checks DONE..!!

	
	
	
	
$todayDate = date("Y-m-d");
$expiryDate = date('Y-m-d', strtotime(date("Y-m-d") . ' + 186 days'));
$date = date_create();
$timeStamp = date_timestamp_get($date);

$static_url = $_SERVER['SERVER_NAME'] . '/online/b2c/launch.php';
$final_url = '';
$final_launch_url = '';

	$fnm = $firstName;
	$lnm = $lastName;
	$company_id = $company_id;
	$pwd = $password;
	$email = $email;
	$newDOB = '2014-01-01';
	$newDOJ = date("Y-m-d");
	$udept = 1;
	$ucountry = 100;
	$ucity = 1;
	$bank_id = '';
	$sales_id = '';
	$sales_code1 = '';
	$sales_code2 = '';
	$sales_code3 = '';
	$unique_code = '';
	$business_type = 1;
	$business_role = '';
	$utype = 'User';
	$temp_utype = $utype;
	$selectedCompId = $company_id;
	$result2 = mysql_query("SELECT * FROM tbl_company where id='$selectedCompId'") or die("1Failed Query of " . mysql_error());
	$num2 = mysql_numrows($result2);
	$catlimit = mysql_result($result2, 0, "company_user_limit");
	$result3 = mysql_query("SELECT * FROM tbl_company_user where company_id='$selectedCompId'") or die("1Failed Query of " . mysql_error());
	$totalUsers = mysql_numrows($result3);
	if ($totalUsers >= $catlimit)
		{
		// removed the limit of users in a country/category
		//$err_code = 200;
		//sendResponse($err_code);
		//exit;
		}

	$utype = 0;
	$curdate = date('Y-m-d');
	$query1 = "select * from tbl_users where username=\"" . $user_id . "\"";
	$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1);
	$numrows = mysql_fetch_row($result1);
	$result2 = mysql_query("SELECT * FROM tbl_users where email='" . $email . "'") or die("1Failed Query of " . mysql_error());
	
	$totalnum2 = mysql_numrows($result2);

	// if user name already exists

	

	if ($totalnum2)
		{
		$err_code = 300;
		sendResponse($err_code);
		exit;
		}
	  else
		{
		$password = md5($pwd);
		$utype=0;
		mysql_query("INSERT INTO tbl_users (firstname, lastname, username, password, userregistered, usertype, dtenrolled, email, mobile , dob, doj, department, country, city, bank_id, sales_id, sales_code1, sales_code2, sales_code3, unique_code, business_type, business_role) VALUES ('$fnm','$lnm','$user_id','$password','1','0','$curdate','$email','$mobile','$newDOB','$newDOJ',$udept,$ucountry,$ucity,'$bank_id','$sales_id','$sales_code1','$sales_code2', '$sales_code3','$unique_code','$business_type','$business_role')") or die("2Failed Query of " . mysql_error());
		$lastId = mysql_insert_id();
		$launch_token = md5($client_id . "-" . $user_id . "-" . $bundle_id . "-" . $timeStamp);
		for ($i = 0; $i < sizeof($courses); ++$i)
			{
			$token = md5($client_id . "-" . $user_id . "-" . $courses[$i] . "-" . $timeStamp);
			$final_url .= $static_url . '?token='.$token;
			if($i < sizeof($courses) - 1){
			$final_url .= ',';
			}
			$query = "INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$user_id','$pwd','$token','$launch_token','$order_id' , '$bundle_id','$courses[$i]','$todayDate','$expiryDate' , '0')";
			mysql_query($query) or die("1Failed Query of " . mysql_error());
			}
			
			
			$final_launch_url	= $static_url . '?token='.$launch_token;
				
		if ($utype == 0 || $utype == 2)
			{
			mysql_query("INSERT INTO tbl_company_user (company_id, user_id) VALUES ($company_id,$lastId)") or die("1Failed Query of " . mysql_error());
			}
		}

	$err_code = 0;
	sendResponse($err_code);
	exit;
	

function sendResponse($err_code)
	{
	global $expiryDate;
	global $token;
	global $final_url;
	global $final_launch_url;
	global $pwd;
	global $user_id;
	
	if ($err_code == 0)
		{
		$_SESSION['signUP'] = 'signUP';
		//header("location: login.php?username=$user_id&password=$pwd");
		}
	  else
		{
		//header("location: ../signup.php?err_code=$err_code");
		}
header('content-type: application/json; charset=utf-8');
	$response = stripslashes(json_encode(array(
		'URL' => $final_launch_url,
		'error_code' => $err_code,
		'expiry_date' => $expiryDate
	)));
	
	//echo $response;
	
	}

mysql_close();
?>