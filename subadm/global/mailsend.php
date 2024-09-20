<?
sendMail("1","1","1");
function sendMail($to,$subject,$messageContent)
{
	
	//$from="Administrator";		
	//$from="liqvid@liqvid.com";
	/*
	$curdate=date('y-m-d');
	$to="mehdi.may@hp.com";
	$subject="Welcome to CMS";
	$messageContent="Hello Dinia Vargas-Pacheco!<br><br>Welcome to the CMS learning content management system. Your account has been created. You can now login to CMS with the following logon details:<br><br>User ID: dvargaspache<br><br>Password: 322111<br><br>CMS: http://www.CMS.com/edge-cms/<br>You may change your password by selecting My Details, then click on Change Password<br>If you forget your password, select Forgot Password from the logon screen<br><br>Please note that the course content on CMS is property of Hewlett-Packard . As an HP subcontractor, your company has signed a non-disclosure agreement protecting HP Intellectual Property rights.  You must strictly comply with the content of your company�s non-disclosure agreement with HP.<br><br>Please contact us at LearningNet@hp.com if you have any questions or feedback to report.<br><br>Regards<br><br>HP CETD Operations";
	$from="admin@CMS.com";
	//$saveMessage=replace_newline($messageContent);
	$boundary = uniqid('np');

	$headers = "MIME-Version: 1.0\r\n";
	$headers .= 'From: CMS <'.$from.'>' . "\r\n";
	$headers .= "Content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";
	$headers .= "X-Priority: 1";
   
	$message .= "\r\n\r\n--" . $boundary . "\r\n";
	$message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";
	$message .= strip_htmscript($messageContent,'other');

	$message .= "\r\n\r\n--" . $boundary . "\r\n";
	$message .= "Content-type: text/html;charset=utf-8\r\n\r\n";
	$message .= $messageContent;
	$message .= "\r\n\r\n--" . $boundary . "--";	
	mail($to,$subject,$message,$headers);
	echo "Mail Sent!";
	*/
}


function sendMailToAdmin($subject,$messageContent)
{
	/*
	//$to=getAminMail();
	$curdate=date('y-m-d');
	$from="admin@CMS.com";
	$to="learningnet@hp.com";	
	//$to="devendra.saxena@liqvid.com";	

	
	//$saveMessage=replace_newline($messageContent);

	
	$boundary = uniqid('np');

	$headers = "MIME-Version: 1.0\r\n";
	$headers .= 'From: CMS <'.$from.'>' . "\r\n";
	$headers .= "Content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";
	$headers .= "X-Priority: 1";
   
	$message .= "\r\n\r\n--" . $boundary . "\r\n";
	$message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";
	$message .= strip_htmscript($messageContent,'other');

	$message .= "\r\n\r\n--" . $boundary . "\r\n";
	$message .= "Content-type: text/html;charset=utf-8\r\n\r\n";
	$message .= $messageContent;
	$message .= "\r\n\r\n--" . $boundary . "--";	
	mail($to,$subject,$message,$headers);
	*/
	
}

function strip_htmscript($var,$type)
{
$var=filter_text($var);
if($type=='mandatory' && $var=='')
	{
$var='';
	}
return $var;
}

function filter_text($text)
{
$text=preg_replace("'<script[^>]*>.*</script>'siU", "", $text);
return $text;
}
////function to send mails////
?>
