<?php include('Aes.php')?>
<?php include('adler32.php')?>
<?php

	/*

		This is the sample RedirectURL PHP Page. It can be directly used for integration with CCAvenue if your application is developed in PHP. You need to simply change the variables to match your variables as well as insert routines for handling a successful or unsuccessful transaction.

		return values i.e the parameters below are passed as POST parameters by CCAvenue server 
	*/


	//---------------------------------------------------------------------------------------------------------------------------------//

	error_reporting(0);
	$workingKey='21z93lbsbw9tl42ty1nie63brdrdazag';		//Working Key should be provided here.
	$encResponse=$_POST["encResponse"];			//This is the response sent by the CCAvenue Server


	$rcvdString=decrypt($encResponse,$workingKey);		//AES Decryption used as per the specified working key.
	$AuthDesc="";
	$MerchantId="";
	$OrderId="";
	$Amount=0;
	$Checksum=0;
	$veriChecksum=false;

	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	//******************************    Messages based on Checksum & AuthDesc   **********************************//
	
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==0)	$MerchantId=$information[1];	
		if($i==1)	$OrderId=$information[1];
		if($i==2)	$Amount=$information[1];	
		if($i==3)	$AuthDesc=$information[1];
		if($i==4)	$Checksum=$information[1];	
	}

	$rcvdString=$MerchantId.'|'.$OrderId.'|'.$Amount.'|'.$AuthDesc.'|'.$workingKey;
	$veriChecksum=verifyChecksum(genchecksum($rcvdString), $Checksum);
	
	$paymentStatus = 0;
	
	if($veriChecksum==TRUE && $AuthDesc==="Y")
	{	
		$paymentStatus = 1;
	}
	else if($veriChecksum==TRUE && $AuthDesc==="B")
	{
		$paymentStatus = 2;
	}
	else if($veriChecksum==TRUE && $AuthDesc==="N")
	{
		$paymentStatus = 1;
	}
	else
	{
		$paymentStatus = 0;
	}

?>

<form id = "paymentStatus" action = "../index.php" method = "POST">
<input type = "text" name = "fromGateWay" value = "fromGateWay" hidden>
<input type = "text" name = "payment_status" value = "<?echo $paymentStatus;?>" hidden>
<input type = "text" name = "payment_status_order_id" value = "<?echo $OrderId;?>" hidden>
<input type = "text" name = "source" value = "<?echo 1;?>" hidden>
</form>

<script>
document.getElementById('paymentStatus').submit();
</script>
