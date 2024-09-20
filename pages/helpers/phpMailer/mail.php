<?php 
require("class.phpmailer.php"); // path to the PHPMailer class
function sendMailer($to, $subject, $message){

	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	// $mail->Mailer = "smtp";
	// $mail->Host = "ssl://smtp.gmail.com";
	// $mail->Port = 465;
	// $mail->SMTPAuth = true; // turn on SMTP authentication
	

	$mail->Mailer = "smtp";
	$mail->Host = "smtp.office365.com";
	$mail->Port = 587;

	$mail->SMTPAuth = true; // turn on SMTP authentication
	


	$mail->Username = "customercare@liqvid.com"; // SMTP username
	$mail->Password = "Rug08167"; // SMTP password
	$mail->SMTPSecure = 'tls';
 
 

	
	/*$mail->Username = "customercare@liqvid.com"; // SMTP username
	$mail->Password = "liqvid@1212"; // SMTP password

	$mail->From = "customercare@liqvid.com";
	$mail->FromName = "English Edge Customer Care";*/

	//$mail->Username = "support@l2proindia.com"; // SMTP username
	//$mail->Password = 'QaL2Support321@2023'; // SMTP passwordl2pro@2023
	//$mail->Password = 'L2PSupport@321$%'; // SMTP password

	//$mail->From = "support@l2proindia.com";
	$mail->From = "customercare@liqvid.com";
	$mail->FromName = "L2ProIndia Support";
	//$mail->Debug = 2;
	

	$mail->Subject = $subject;

	$mail->WordWrap = 200;
	$mail->Body = $message;
	$mail->IsHTML(true);// To send html
	//$to = "devendra.saxena@englishedge.in";
	$mail->AddAddress($to);
	$mail->addBCC('sarika.yadav@liqvid.com');
	$mail->addBCC('devendra.saxena@liqvid.com');
    $mail->addBCC('admin@l2proindia.com');
	//$mail->addBCC('hemangs@qualcomm.com');
	$mail->addBCC('sarojkant.sahoo@liqvid.com');
	$mail->addBCC('Shruti.Malhotra@liqvid.com');
	//$mail->addBCC('krishnan@qualcomm.com');
	
	

		
	if(!$mail->Send()) {
		file_put_contents('status.txt' , 'Mail Not Sent to : ' . $to . 'due to - ' . $mail->ErrorInfo . PHP_EOL , FILE_APPEND);
		return 'failed';
	} else {
		file_put_contents('status.txt' , 'Mail Sent to : ' . $to . PHP_EOL , FILE_APPEND);
		return 'ok';
	}
}




function sendMailContact($to, $subject, $message){
	$to="admin@l2proindia.com";

	////$to="devendra.saxena@liqvid.com";
	$mail = new PHPMailer();
	   $mail->IsSMTP(); // telling the class to use SMTP
       $mail->Mailer = "smtp";
       $mail->Host = "smtp.office365.com";
       $mail->Port = 587;
	   //$mail->Port = 25;
       $mail->SMTPAuth = true; // turn on SMTP authentication
       $mail->Username = "customercare@liqvid.com"; // SMTP username
       $mail->Password = "Maz70797"; // SMTP password
       $mail->SMTPSecure = 'tls';
	
	$mail->From = "customercare@liqvid.com";
	$mail->FromName = "L2Pro India - Contact Us";
	

	$mail->Subject = $subject;

	$mail->WordWrap = 200;
	$mail->Body = $message;
	$mail->IsHTML(true);// To send html
	//$to = "devendra.saxena@englishedge.in";
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		file_put_contents('status.txt' , 'Mail Not Sent to : ' . $to . 'due to - ' . $mail->ErrorInfo . PHP_EOL , FILE_APPEND);
		return 'failed';
	} else {
		file_put_contents('status.txt' , 'Mail Sent to : ' . $to . PHP_EOL , FILE_APPEND);
		return 'ok';
	}
}
	

?>
