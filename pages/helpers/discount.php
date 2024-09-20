<?php
include ("../../../connect.php");
session_start();

$voucher = trim($_POST['discountVoucher']);
$logUser = $_SESSION['login_user'];

$query = "SELECT * FROM tbl_b2c_voucher where voucher_code = '$voucher'";
$result = mysql_query($query) or die("1Failed Query of " . mysql_error());
$num_rows = mysql_num_rows($result);
$row = mysql_fetch_array($result);
$voucherID = $row['id'];



if($num_rows > 0){
	$username = $row['username'];
	if($username == "" || $username == null){
		$query = "UPDATE tbl_b2c_voucher set username = '$logUser' where voucher_code = '$voucher'";
		$result = mysql_query($query);
		if($result){
			$valid = true;
		}else{
			$valid = false;
		}
	}else{
			if($logUser == $username){
					$valid = true;
				}else{
					$valid = false;
				}
		}
}else{
	$valid = false;
}

if($valid){
	$_SESSION['voucher'] = $voucherID;
	header("location: ../customer/buyCourses.php");
}else{
	header("location: ../customer/discount.php?err=1");
}


?>
