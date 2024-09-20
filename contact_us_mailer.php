<?php
ob_start();
@session_start();

	if(isset($_SERVER['HTTPS'])) {
		$http='https://';
	}
	else{ $http='http://';}
	$dirmName= dirname($_SERVER['PHP_SELF']);
	$dirmName=explode('/',$dirmName);
	if($dirmName[1]!=""){
		$dirmName='/'.$dirmName[1];
	}
	else{$dirmName='';} 
	//$globalLink=$http.$_SERVER['HTTP_HOST'].$dirmName;
	$globalLink=$http.$_SERVER['HTTP_HOST'];
	//echo $globalLink;exit;
	$imagePath=$globalLink.'/assets/images/'; 
	 $logo="<img style='width:80px;height: 40px;max-width:100%;margin-right:10px' src='".$imagePath."logo.jpg' alt='' border='0'/><img style='width:80px;height: 40px;max-width:100%;margin-right:10px' src='".$imagePath."NLU-logo.jpg' alt='' border='0'/><img style='width:80px;height: 40px;max-width:100%;margin-right:10px' src='".$imagePath."CIIPC-Logo.jpg' alt='' border='0'/><img style='width:80px;height: 40px;max-width:100%;margin-right:10px' src='".$imagePath."cipam-logo.png'  alt='' border='0'/>";
	$ProductName='L2Pro India';
	$filepath= 'pages/helpers/phpMailer/mail.php'; 
	
   include_once($filepath);
  
   if(isset($_POST['contact_name']) && $_POST['contact_name'] != "" && isset($_POST['contact_email']) && $_POST['contact_email'] != "" && isset($_POST['contact_subject']) && $_POST['contact_subject'] != ""){

	$name = $_POST['contact_name'];
	$email = $_POST['contact_email'];
	$subject1 = $_POST['contact_subject'];
	$message = $_POST['contact_msg'];
	//echo "<pre>";print_r($_POST);exit;
     try{
		//echo $filepath;
		 $subject = "$ProductName - Contact Us";
		$str="<table style='' cellspacing='0' cellpadding='0' width='100%' bgcolor='#fff'><tbody><tr style='background-color:#fff;height:30px' ><td style='background-color:#3252cd;padding:5px 5px 0px 5px;height:30px' valign='middle'><div style='text-align: left;height: 40px; background: #fff;width: auto;display: inline-block;'>$logo</div><span style='position:relative;top:-20px;color:#fff;display:inline-block;padding:5px 5px 2px 5px;font-size:10px;'>&nbsp;</span></td></tr><tr><td style='text-align:left; vertical-align:middle'><div style='padding:40px 10px 20px 10px;'><p><span style='font-size:18px;'>Name : </span><span style='font-size:18px;font-weight:bold;padding-left:5px'>$name </span></p><p><span style='font-size:18px;'>Email : </span><span style='font-size:18px;font-weight:bold;padding-left:5px'>$email </span></p><p><span style='font-size:18px;'>Subject : </span><span style='font-size:18px;font-weight:bold;padding-left:5px'>$subject1 </span></p><p><span style='font-size:18px;'>Message : </span><span style='font-size:18px;font-weight:bold;padding-left:5px'>$message </span></p>	 
		 </div><div style='padding:30px 10px 10px 10px;'></div><div style='padding:0px 10px 10px 10px;border-bottom:solid thin #ccc;'></div></td></tr></tbody></table>";
	 //echo "-->".$email;exit;
		$mail = sendMailContact($email, $subject, $str);
	  // echo $mail;exit;	
			
		   // send email
		if($mail == "ok"){
			$_SESSION['success']=1;
			header("location:contactus.php");
			exit; 
		}elseif($mail == "failed"){
			 $_SESSION['error']=1;
			header("location:contactus.php");
			exit; 
		}elseif($mail == "inValidE"){
			
			$_SESSION['error']=2;
			header("location:contactus.php");
			exit; 
		}  
	
      }//catch exception
		  catch(Exception $e) {
		  echo 'Message: ' .$e->getMessage();exit;
		}
  }
?>