<?
include ("../../../connect.php");
session_start();
$bundleID = $_GET['id'];

if($bundleID == ''){
header("location: ../customer/selectCourse.php?status=err");
exit;
}

$query = "SELECT * FROM tbl_b2client_bundle where client_id = 2 and bundle = '$bundleID'";
$result4 = mysql_query($query) or die("1Failed Query of " . mysql_error());

$validBundleID = 0;
while($row = mysql_fetch_array($result4)){
$validBundleID = 1;
$order_detail = $row['bundle_detail'];
$order_price = $row['price'];
}


$voucher_code = $_SESSION['voucher_code'];
if($voucher_code != '' || $voucher_code != null){

$result = mysql_query("SELECT * FROM tbl_b2c_voucher where voucher_code = '$voucher_code'") or die("1Failed Query of " . mysql_error());
while ($row = mysql_fetch_object($result)) {
    $percentage = $row->percentage;
}
$price = round($order_price * $percentage / 100);
}else{
$price = $order_price;
}


if ($validBundleID == 0){
header("location: ../customer/selectCourse.php?status=err");
exit;
}


$result = mysql_query("SELECT id FROM tbl_order ORDER BY id DESC LIMIT 1");
while ($row = mysql_fetch_object($result)) {
    $lastID = $row->id;
}

$lastID = $lastID + 1;

$order_id = 'ORD' . $lastID;
$userName = $_SESSION['login_user'];


$query = "INSERT INTO tbl_order (order_id, username, voucher_code , bundle_id, price , status ) VALUES ('$order_id','$userName', '$voucher_code' ,'$bundleID', '$price' ,'0')";

mysql_query($query) or die("1Failed Query of " . mysql_error());
unset($_SESSION['voucher_code']);
$_SESSION['orderID'] = $order_id;
?>

<form id = "makeOrder" action = "../customer/showOrderDetails.php" method = "POST">
<input type = "text" name = "order_id" value = "<?echo $order_id;?>" hidden>
</form>

<script>
document.getElementById('makeOrder').submit();
</script>
