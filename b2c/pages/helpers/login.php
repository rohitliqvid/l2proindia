<?php
include ("../../../connect.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET")
{
// username and password sent from Form
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

//$userip=$_SERVER['REMOTE_ADDR'];
$curdate=date('Y-m-d');
    if(isset($_GET['action']) && $_GET['action']=='direct')
	{
     
	$myusername=encrypt_decrypt('decrypt',addslashes($_REQUEST['username']));
	$mypassword=encrypt_decrypt('decrypt',addslashes($_REQUEST['password'])); 
	$md5pass = md5($mypassword);
	$finalCount = getCount($myusername , $md5pass);
	}
	elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='shop')
	{
     //echo "here";exit;   
	$myusername=addslashes($_REQUEST['username']); 
	$mypassword=addslashes($_REQUEST['password']); 
	$md5pass = $mypassword;
	$finalCount = getCount($myusername , $md5pass);
	}
	else
	{
        
	$myusername=addslashes($_REQUEST['username']); 
	$mypassword=addslashes($_REQUEST['password']); 
	$md5pass = md5($mypassword);
	$finalCount = getCount($myusername , $md5pass);
	}





$query1="select * from tbl_users where username=\"" .$myusername."\" and password=\"".$md5pass."\"";
$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1); 
$thisrow=mysql_fetch_row($result1);
if ($thisrow)  
{
	$isActive = mysql_result($result1,0,"userregistered");
	$usRowId = mysql_result($result1,0,"id");
	//echo $isActive;exit;
	if($isActive=="0")
	{
	header("location: ../../index.php?err_code=101");
	exit;

	}
}
/*
if($finalCount == 0){
$myusername = "drp_" . $myusername;
$finalCount = getCount($myusername , $md5pass);
}
*/



// If result matched $myusername and $mypassword, table row must be 1 row
if($finalCount==1)
{
$_SESSION['login_user']=$myusername;
$_SESSION['isLogin']="yes";
//if ($myusername == 'b2cadmin1@liqvid.com'){
if (strtolower($myusername) == 'admin'){
$_SESSION['sess_fname'] = "Admin";
$_SESSION['sess_uid'] = strtolower(trim($myusername));
$_SESSION['perms'] = '1';
mysql_query("INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES ('$myusername', $usRowId, '$userip','$curdate')");
header("location: ../../../admin/intface/index.php");
exit;
}else{
$ssVal = $_SESSION['signUP'];
if($ssVal === 'signUP'){
//unset($_SESSION['signUP']);
$_SESSION['startTime']=time();
//header("location: ../customer/discount.php");
mysql_query("INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES ('$myusername', $usRowId, '$userip','$curdate')");

header("location: ../customer/index.php");
}else{
$_SESSION['startTime']=time();
mysql_query("INSERT INTO tbl_entry_log (username, user_id, user_ip, user_entry) VALUES ('$myusername', $usRowId, '$userip','$curdate')");
header("location: ../customer/index.php");
}
}
}
else 
{
header("location: ../../index.php?err_code=100");
}
echo $error;
}else{
echo "NO";
}


function getCount($myusername , $md5pass){
	$sql="SELECT id FROM tbl_users WHERE username='$myusername' and password='$md5pass'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$active=$row['active'];
	$count=mysql_num_rows($result);
	return $count;
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