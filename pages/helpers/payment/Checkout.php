<!--
	This is the sample Checkout Page php script. It can be directly used for integration with CCAvenue if your application is developed in PHP. You need to simply change the variables to match your variables as well as insert routines (if any) for handling a successful or unsuccessful transaction.
-->



<html>
<head>
<title> Checkout</title>
</head>
<body>
<center>
<?php include('adler32.php')?>
<?php include('Aes.php')?>
<?php include('URL.php')?>

<?php 
session_start();
//error_reporting(0);
include ("../../../../connect.php");

$orderID = $_SESSION['orderID']; 

$result = mysql_query("SELECT * FROM tbl_order where order_id = '$orderID'") or die("1Failed Query of " . mysql_error());
while ($row = mysql_fetch_object($result)) {
    $bundle_price = $row->price;
}



$merchant_id='M_viv23360_23360';         // Merchant id(also User_Id) 
$amount=$bundle_price;                  // your script should substitute the amount here in the quotes provided here
$order_id=$orderID;                    //your script should substitute the order description here in the quotes provided here
$url=$redirectURL;                    //your redirect URL where your customer will be redirected after authorisation from CCAvenue
$billing_cust_name=$_POST['billing_cust_name'];
$billing_cust_address=$_POST['billing_cust_address'];
$billing_cust_country=$_POST['billing_cust_country'];
$billing_cust_state=$_POST['billing_cust_state'];
$billing_city=$_POST['billing_city'];
$billing_zip=$_POST['billing_zip'];
$billing_cust_tel=$_POST['billing_cust_tel'];
$billing_cust_email=$_POST['billing_cust_email'];
$delivery_cust_name=$_POST['delivery_cust_name'];
$delivery_cust_address=$_POST['delivery_cust_address'];
$delivery_cust_country=$_POST['delivery_cust_country'];
$delivery_cust_state=$_POST['delivery_cust_state'];
$delivery_city=$_POST['delivery_city'];
$delivery_zip=$_POST['delivery_zip'];
$delivery_cust_tel=$_POST['delivery_cust_tel'];
$delivery_cust_notes=$_POST['delivery_cust_notes'];


$working_key='21z93lbsbw9tl42ty1nie63brdrdazag';	//Put in the 32 bit alphanumeric key in the quotes provided here.


$checksum=getchecksum($merchant_id,$amount,$order_id,$url,$working_key); // Method to generate checksum

$merchant_data= 'Merchant_Id='.$merchant_id.'&Amount='.$amount.'&Order_Id='.$order_id.'&Redirect_Url='.$url.'&billing_cust_name='.$billing_cust_name.'&billing_cust_address='.$billing_cust_address.'&billing_cust_country='.$billing_cust_country.'&billing_cust_state='.$billing_cust_state.'&billing_cust_city='.$billing_city.'&billing_zip_code='.$billing_zip.'&billing_cust_tel='.$billing_cust_tel.'&billing_cust_email='.$billing_cust_email.'&delivery_cust_name='.$delivery_cust_name.'&delivery_cust_address='.$delivery_cust_address.'&delivery_cust_country='.$delivery_cust_country.'&delivery_cust_state='.$delivery_cust_state.'&delivery_cust_city='.$delivery_city.'&delivery_zip_code='.$delivery_zip.'&delivery_cust_tel='.$delivery_cust_tel.'&billing_cust_notes='.$delivery_cust_notes.'&Checksum='.$checksum  ;

echo "HELO";
$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

echo "HE1111LO";
?>

<form method="post" name="redirect" action="https://www.ccavenue.com/shopzone/cc_details.jsp"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=Merchant_Id value=$merchant_id>";

?>
</form>

</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>
