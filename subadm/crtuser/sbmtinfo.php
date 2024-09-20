<?php include ('../intface/adm_top.php'); ?>

<?php
//include("../connect.php"); //Connection to database 
//include("../global/functions.php"); //Connection to database 
/*error_reporting(E_ALL);
ini_set('display_errors','1'); */
include ("../../b2c/pages/helpers/phpMailer/mail.php");

function mysql_escape_mimic($inp) {

    if(is_array($inp))
    return array_map(__METHOD__, $inp);
    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);

    }
    return $inp;
}

$fnm=trim(mysql_escape_mimic(strip_htmscript($_POST['fnm'],'mandatory')));
$lnm=trim(mysql_escape_mimic(strip_htmscript($_POST['lnm'],'other')));
$uid=strtolower(trim(mysql_escape_mimic(strip_htmscript($_POST['cEmail'],'mandatory'))));
$pwd=strtolower(trim(mysql_escape_mimic(strip_htmscript($_POST['pwd'],'other'))));
$email=strtolower(trim(mysql_escape_mimic(strip_htmscript($_POST['cEmail'],'other'))));
$phone=strtolower(trim(mysql_escape_mimic(strip_htmscript($_POST['cPhone'],'other'))));
$uclient=$_POST['uclient'];
$utype=$_POST['utype'];
$temp_utype=$utype;
if ($utype=="Company Administrator")
{
$utype=2;
}else
{
$utype=0;
}
$curdate=date('y-m-d');

$con=createConnection();


$query1 = "select * from tbl_users where username=\"" .$uid."\"";
$result1 = mysqli_query($con,$query1);
$numrows=mysqli_num_rows($result1);

//$query1="select * from tbl_users where username=\"" .$uid."\""; 
//$result1 = mysql_query($query1) or die("Failed Query of " . $query1); 
//$numrows=mysql_numrows($result1);

$query2 = "SELECT * FROM tbl_users where email='".$email."'";
$result2 = mysqli_query($con,$query2);
$totalnum2=mysqli_num_rows($result2);


//$result2 = mysql_query ("SELECT * FROM tbl_users where email='".$email."'"); 
//$totalnum2=mysql_numrows($result2);

if($numrows)
{
	$_SESSION['msg']='Email already exists.';
	echo '<script>  window.location="userinfo.php"</script>';
	//header('location:userexts.php');
	exit;
}
if($totalnum2)
{
	$_SESSION['msg']='Email already exists.';
echo '<script>  window.location="userinfo.php"</script>';
//header('location:usermailexts.php');
exit;
}
//else create the user with this user name
else
{
	
	$msg='';
	$msg=empty($fnm)?'First name required.':$msg;
	$msg=empty($lnm)?'Last name required.':$msg;
	$msg=empty($uid)?'Email required.':$msg;
	$msg=empty($pwd)?'Password required.':$msg;
	if($phone!=""){
		if(preg_match('/^[0-9]{10}+$/', $phone)) {
		
		}else{
			$msg='Phone number should be a valid phone.';
		}
	
	}
	$containsLetter  = preg_match('/[a-zA-Z]/', $pwd);
	$containsDigit   = preg_match('/\d/',$pwd);
	$containsSpecial = preg_match('/[^a-zA-Z\d]/',$pwd);
	if(!$containsLetter || !$containsDigit || !$containsSpecial || strlen($pwd) < 6) {
		$msg='Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character.';
	}	
	if($msg==''){
	
	
	
$key=md5($email);	
$pwd=md5($pwd);

$query = "INSERT INTO tbl_users (firstname, lastname, username, password, userregistered, usertype, dtenrolled, email, mobile, country, city, business_type, client,hash_key) VALUES ('$fnm','$lnm','$uid','$pwd','1','$utype','$curdate','$email','$phone',100,1,'1','$uclient','$key')";
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->close();
$lastId = $con->insert_id;
//echo "-->".$lastId;exit;

//mysql_query("INSERT INTO tbl_users (firstname, lastname, username, password, userregistered, usertype, dtenrolled, email, mobile, country, city, business_type, client,hash_key) VALUES ('$fnm','$lnm','$uid','$pwd','1','$utype','$curdate','$email','$phone',100,1,'1','$uclient','$key')");
//$lastId=mysql_insert_id();

if($utype==0 || $utype==2)
	{
		
	
		$query = "INSERT INTO tbl_company_user (company_id, user_id) VALUES (1,$lastId)";
		//$stmt->bind_param("i",$lastId);
		$stmt = $con->prepare($query);
		$stmt->execute();
		$stmt->close();
		//mysql_query("INSERT INTO tbl_company_user (company_id, user_id) VALUES (1,$lastId)");
		
	}


//Assign course to user 21-5-2019

$query5 = "SELECT course,name FROM tls_scorm where coursetype='WBT' order by id asc";
$resultList = mysqli_query($con,$query5);
$num=mysqli_num_rows($resultList);


//$resultList = mysql_query ("SELECT * FROM tls_scorm where coursetype='WBT' order by id asc"); 
//$num=mysql_numrows($resultList);
$i=0;
$userCourseId=$uid;
$arrCourseNames=array();
while($i<$num) {
	$row = mysqli_fetch_assoc($resultList);
	$course_id=$row['course'];
	$crsName=$row['name'];

	//if not assigned, assign the course to user in b2client
	//$bundleCourse=mysql_query("select bundle from tbl_b2client_bundle where bundle_desc='$course_id'");
	//$row = mysql_fetch_assoc($bundleCourse);
	//$id = $row['id'];
	//$bundle_id=mysql_result($bundleCourse,0,"bundle");

	$query6 = "select bundle from tbl_b2client_bundle where bundle_desc='$course_id'";
	$bundleCourse = mysqli_query($con,$query6);
	$num2=mysqli_num_rows($bundleCourse);
	$row2 = mysqli_fetch_assoc($bundleCourse);
	$bundle_id = $row2['bundle'];


	$curdate = date('Y-m-d');
	$password="password";
	$todayDate = date("Y-m-d");
	$expiryDate = date('Y-m-d', strtotime(date("Y-m-d") . ' + 90 days'));
	$date = date_create();
	$client_id=5;
	$company_id=1;
	$launch_token = md5($client_id . "-" . $userCourseId . "-" . $bundle_id . "-" . $curdate);
	$token = md5($client_id . "-" . $userCourseId . "-" . $course_id . "-" . $curdate);

	//$assignCourse=mysql_query("INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$userCourseId','$password','$token','$launch_token','SignUp' , '$bundle_id','$course_id','$todayDate','$expiryDate' , '0')");

	$query7 = "INSERT INTO tbl_b2client (client_id, username, password, token, launch_token, order_id , bundle_id ,  course_id, registration_date, expiry_date , status ) VALUES ('$client_id','$userCourseId','$password','$token','$launch_token','SignUp' , '$bundle_id','$course_id','$todayDate','$expiryDate' , '0')";
	$stmt = $con->prepare($query7);
	$stmt->execute();
	$stmt->close();

	array_push($arrCourseNames,$crsName);
	$i++; 
}

if(count($arrCourseNames)>0)
{
//Mail code here
/* $strCourses=implode(",",$arrCourseNames);
$subject = "Course Assigned";
$message = "Dear User, Following course(s) are assigned to you: $strCourses";
$mailStatus = sendMailer($email, $subject, $message); */
} 

//Send mail to user

//Send activation mail

if(isset($_SERVER['HTTPS'])) {
	$http='https://';
}
else{ $http='http://';}
$activationlink=$http.$_SERVER['HTTP_HOST'].'/activation.php?key='.$key;
$fnm=ucfirst($fnm);	
$subject = "L2Pro India: Verification mail to complete registration";
$message = "Hi $fnm <br><br>Thank you for showing interest in L2Pro India Program. This is an initiative to spread awareness on how to protect Intellectual Property Right!<br><br>Please confirm that $email is your email address by clicking on the below link.<br><br><a href=".$activationlink." > Click here to verify Email </a><br><br>If you have not registered, please ignore the email.<br><br>L2Pro India Team.";
$mailStatus = sendMailer($email, $subject, $message);



$_SESSION['msg']='New user created successfully.';
echo '<script>  window.location="../userlist/userlist.php"</script>';
	//header('location:userexts.php');
	exit;
//include("usercrtd.php");

	}
else{
$_SESSION['msg']=$msg;
echo '<script>  window.location="userinfo.php?fnm='.$fnm.'&lnm='.$lnm.'&email='.$email.'&phone='.$phone.'"</script>';	
	
}
}

//close the connection
closeConnection($con);
?>
<?php
include ('../intface/footer.php');
?>

