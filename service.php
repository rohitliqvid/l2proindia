<?php
include ("../connect.php");
$userv=encrypt_decrypt("decrypt",addslashes($_POST['userv'])); 
$pserv=encrypt_decrypt("decrypt",addslashes($_POST['pserv'])); 

$temp=$userv."-".$pserv;
file_put_contents("dev.txt",$temp);
$pserv=md5($pserv);
$query1="select * from tbl_users where username=\"" .$userv."\" and password=\"".$pserv."\"";
$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1); 
$thisrow=mysql_fetch_row($result1);
if ($thisrow)  
{
	echo "S";exit;
}
else
{
	echo "F";exit;
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