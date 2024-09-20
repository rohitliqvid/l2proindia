<?php 
require("class.phpmailer.php"); // path to the PHPMailer class
	function sendMailer($to, $subject, $message){
		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Mailer = "smtp";
		$mail->Host = "ssl://smtp.gmail.com";
		$mail->Port = 465;
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->Username = "customercare@liqvid.com"; // SMTP username
		$mail->Password = "liqvid@123"; // SMTP password
	
		$mail->From = "customercare@liqvid.com";
		$mail->FromName = "English Edge Customer Care";
		
	
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
function sendMailContact($to, $subject, $message){
	
		//$toemail="admin@l2proindia.com";
		//$subject = "L2Pro - Contact Us";
		$str="<table style='' cellspacing='0' cellpadding='0' width='100%' bgcolor='#fff'><tbody><tr style='background-color:#fff;height:30px' ><td style='background-color:#3252cd;padding:5px 5px 0px 5px;height:30px' valign='middle'><div style='text-align: left;height: 40px; background: #fff;width: auto;display: inline-block;'>$logo</div><span style='position:relative;top:-20px;color:#fff;display:inline-block;padding:5px 5px 2px 5px;font-size:10px;'>&nbsp;</span></td></tr><tr><td style='text-align:left; vertical-align:middle'><div style='padding:40px 10px 20px 10px;'><p><span style='font-size:18px;'>Name : </span><span style='font-size:18px;font-weight:bold;padding-left:5px'>$name </span></p><p><span style='font-size:18px;'>Email : </span><span style='font-size:18px;font-weight:bold;padding-left:5px'>$email </span></p><p><span style='font-size:18px;'>Subject : </span><span style='font-size:18px;font-weight:bold;padding-left:5px'>$subject </span></p><p><span style='font-size:18px;'>Message : </span><span style='font-size:18px;font-weight:bold;padding-left:5px'>$message </span></p>	 
		 </div><div style='padding:30px 10px 10px 10px;'></div><div style='padding:0px 10px 10px 10px;border-bottom:solid thin #ccc;'></div></td></tr></tbody></table>";

		$toemail="admin@l2proindia.com";
		//$toemail="devendra.saxena@liqvid.com";
		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Mailer = "smtp";
		$mail->Host = "ssl://smtp.gmail.com";
		$mail->Port = 465;
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->Username = "customercare@liqvid.com"; // SMTP username
		$mail->Password = "password"; // SMTP password
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