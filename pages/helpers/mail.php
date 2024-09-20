<?php 
require("./class.phpmailer.php"); // path to the PHPMailer class
function sendMailer($to, $subject, $message){
		
		
		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Mailer = "smtp";
		$mail->Host = "smtp.sendgrid.net";
		$mail->Port = 465;
		$mail->SMTPAuth = true; // turn on SMTP authentication
		//$mail->Username = "customercare@englishedge.in"; // SMTP username
		//$mail->Password = "liqvid@123"; // SMTP password

		//$mail->From = "customercare@liqvid.com";
		//$mail->FromName = "English Edge Customer Care";
		
		$mail->Username = "apikey"; // SMTP username
		$mail->Password = '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'; // SMTP password

		$mail->From = "syashisrocking123@gmail.com";
		$mail->FromName = "L2ProIndia Support";

		$mail->Subject = $subject;

		$mail->WordWrap = 200;
		$mail->Body = $message;
		$mail->IsHTML(true);// To send html
		//$to = "devendra.saxena@englishedge.in";
		$mail->AddAddress($to);
		if(!$mail->Send()) {

			file_put_contents('status.txt' , 'Mail Not Sent to : ' . $to . 'due to - ' . $mail->ErrorInfo . PHP_EOL , FILE_APPEND);

			return $mail->ErrorInfo;
		} else {
			file_put_contents('status.txt' , 'Mail Sent to : ' . $to . PHP_EOL , FILE_APPEND);
			return 'ok';
		}
}

/* function sendMailer($to, $subject, $message){
		
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Mailer = "smtp";
	$mail->Host = "smtp.sendgrid.net";
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true; // turn on SMTP authentication
	
	//$mail->Username = "customercare@englishedge.in"; // SMTP username
	//$mail->Password = "liqvid@123"; // SMTP password

	//$mail->From = "customercare@liqvid.com";
	//$mail->FromName = "English Edge Customer Care";
	
	$mail->Username = "apikey"; // SMTP username
	$mail->Password = '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'; // SMTP password

	$mail->From = "yashisrocking123@gmail.com";
	$mail->FromName = "L2ProIndia Support";

	$mail->Subject = $subject;

	$mail->WordWrap = 200;
	$mail->Body = $message;
	$mail->IsHTML(true);// To send html
	//$to = "devendra.saxena@englishedge.in";
	$mail->AddAddress($to);
	if(!$mail->Send()) {

		file_put_contents('status.txt' , 'Mail Not Sent to : ' . $to . 'due to - ' . $mail->ErrorInfo . PHP_EOL , FILE_APPEND);

		return $mail->ErrorInfo;
	} else {
		file_put_contents('status.txt' , 'Mail Sent to : ' . $to . PHP_EOL , FILE_APPEND);
		return 'ok';
	}
} */

function sendMailContact($to, $subject, $message){
	
		//$toemail="admin@l2proindia.com";
		$toemail="admin@l2proindia.com";
		//$toemail="devendra.saxena@liqvid.com";
		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Mailer = "smtp";
		$mail->Host = "ssl://smtp.gmail.com";
		$mail->Port = 465;
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->Username = "customercare@liqvid.com"; // SMTP username
		$mail->Password = "liqvid@123"; // SMTP password
		$mail->From = "customercare@liqvid.com";
		$mail->FromName = "L2Pro India - Contact Us";

		$mail->Subject = $subject;

		$mail->WordWrap = 200;
		$mail->Body = $message;
		$mail->IsHTML(true);
		$mail->addBCC('devendra.saxena@liqvid.com');
		$mail->AddAddress($toemail);
		if(!$mail->Send()) {
			//file_put_contents('status.txt' , 'Mail Not Sent to : ' . $to . 'due to - ' . $mail->ErrorInfo . PHP_EOL , FILE_APPEND);
			return 'failed';
		} else {
			//file_put_contents('status.txt' , 'Mail Sent to : ' . $to . PHP_EOL , FILE_APPEND);
			return 'ok';
		}
}	
	

?>