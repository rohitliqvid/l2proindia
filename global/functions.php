<?php
//error_reporting(E_ALL);
ini_set("display_errors", 0);
$fileSupport = array('gif','jpeg','swf','jpg','wav','wmv','mp3','avi','mpeg','txt','html','htm','pdf','ppt','pps','doc','rtf','zip');

define("dir_name", "dapp");
$con=createConnection();

function getUserCourseStatus($user_rowid,$docid)
{

	global $con;
	$value='';
	$stmt = $con->prepare("SELECT value FROM tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_rowid and scormid=$docid");
	$sql="SELECT value FROM tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_rowid and scormid=$docid";
	file_put_contents('sql.txt',$sql."\n",FILE_APPEND);
	//$stmt->bind_param("ii",$user_rowid,$docid);
	$stmt->execute();
	$stmt->bind_result($value);
	$stmt->fetch();
	$stmt->close();	

	if(empty($value))
	{
	$value='Not Attempted';
	}
	else
	{
	$value=$value;
		
	
	}

	return $value;
}


function getUserCourseTime($user_rowid,$docid)
{
	
	
	global $con;
	$stmt = $con->prepare("SELECT value FROM tls_scorm_sco_tracking where element='cmi.core.total_time' and userid=? and scormid=?");
	$stmt->bind_param("ii",$user_rowid,$docid);
	$stmt->execute();
	$stmt->bind_result($value);
	$stmt->fetch();
	$stmt->close();	
	
	if(empty($value))
	{
		$stmt = $con->prepare("SELECT value FROM tls_scorm_sco_tracking where element='cmi.core.session_time' and userid=? and scormid=?");
		$stmt->bind_param("ii",$user_rowid,$docid);
		$stmt->execute();
		$stmt->bind_result($value_session_time);
		$stmt->fetch();
		$stmt->close();	
		if(empty($value_session_time))
		{
			$status='00:00:00:00';
		}
		else
		{
			$status=$value_session_time;
		}
	}
	else
	{
		$status=$value;
	}

	/*$result = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.total_time' and userid=$user_rowid and scormid=$docid"); 
	$num=mysql_numrows($result);
	if($num==0)
	{
		$result2 = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.session_time' and userid=$user_rowid and scormid=$docid"); 
		$num2=mysql_numrows($result2);
		if($num2==0)
		{
		$status='00:00:00:00';
		}
		else
		{
		$row = mysql_fetch_assoc($result2);
		$id = $row['id'];
		$status=mysql_result($result2,0,"value");
		}
		
		
	}
	else
	{
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
		$status=mysql_result($result,0,"value");
	}*/
	return $status;
}



function validateUser($userid,$role)
{
	global $con;

	$stmt = $con->prepare("SELECT usertype FROM tbl_users where username=?");
	$stmt->bind_param("s",$userid);
	$stmt->execute();
	$stmt->bind_result($utype);
	$stmt->fetch();
	$stmt->close();	


	if($utype!=$role)
	{
	header("Location:../../index.php#item1");
	exit;
	}
}

function validateUserToken($userid,$s_token)
{
	global $con;

	$stmt = $con->prepare("SELECT token FROM tbl_web_session where username=?");
	$stmt->bind_param("s",$userid);
	$stmt->execute();
	$stmt->bind_result($token);
	$stmt->fetch();
	$stmt->close();	


	if($token!=$s_token)
	{
	header("Location:../../index.php#item1");
	exit;
	}
}



function getUserCompletionDate($user_rowid,$docid)
{


	global $con;
	$cdate='';
	$stmt = $con->prepare("SELECT comp_date FROM tbl_sco_completion where userid=? and scoid=?");
	$stmt->bind_param("ss",$user_rowid,$docid);
	$stmt->execute();
	$stmt->bind_result($comp_date);
	$stmt->fetch();
	$stmt->close();	
	if(empty($comp_date))
	{
		$status='-';
	}
	else
	{
	  $status=$comp_date;
	}
	return $status;
}

function getUserCourseScore($user_rowid,$docid)
{

	global $con;
	$stmt = $con->prepare("SELECT value FROM tls_scorm_sco_tracking where element='cmi.core.score.raw' and userid=? and scormid=?");
	$stmt->bind_param("ii",$user_rowid,$docid);
	$stmt->execute();
	$stmt->bind_result($value);
	$stmt->fetch();
	$stmt->close();	
	if(empty($value))
	{
		$status='-';
	}
	else
	{
	  $status=$value."%";
	}

return $status;
}


/*function getCourseNameFromId($uid)
{
$result = mysql_query ("SELECT * FROM tls_scorm where id=$uid"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowId=mysql_result($result,0,"name");
return $rowId;
}*/

function getCourseNameFromId($uid)
{
     
        global $con;
	$stmt = $con->prepare("SELECT name FROM tls_scorm where id=?");
	$stmt->bind_param("i",$uid);
	$stmt->execute();
	$stmt->bind_result($name);
	$stmt->fetch();
	$stmt->close();
       
	return $name;


}

function getUserId($uid)
{
	global $con;
	$stmt = $con->prepare("SELECT id FROM tbl_users where username=?");
	$stmt->bind_param("s",$uid);
	$stmt->execute();
	$stmt->bind_result($id);
	$stmt->fetch();
	$stmt->close();
	return $id;
}

function getDepartmentName($id)
{
$result = mysql_query ("SELECT * FROM tbl_departments where id=$id"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowId=mysql_result($result,0,"department");
return $rowId;
}

function getCountryName($id)
{
$result = mysql_query ("SELECT * FROM tbl_country where id=$id"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowId=mysql_result($result,0,"country");
return $rowId;
}

function getCityName($id)
{
$result = mysql_query ("SELECT * FROM tbl_city where id=$id"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowId=mysql_result($result,0,"city");
return $rowId;
}
function getBusinessType($id)
{
$result = mysql_query ("SELECT * FROM tbl_business_type where id=$id"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowId=mysql_result($result,0,"business_type");
return $rowId;
}

function getSecurityQuestion($id)
{
$result = mysql_query ("SELECT * FROM tbl_security_question where id=$id"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowId=mysql_result($result,0,"question");
return $rowId;
}

function isUserUpdated($uid)
{
	global $con;
	$stmt = $con->prepare("SELECT isupdated FROM tbl_users WHERE username=?");
	$stmt->bind_param("s",$uid);
	$stmt->execute();
	$stmt->bind_result($isupdated);
	$stmt->fetch();
	$stmt->close();	
	return $isupdated;
}


function getCompanyName($uid)
{
$result = mysql_query ("SELECT * FROM tbl_company where id=$uid"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$companyName=mysql_result($result,0,"company_name");
return $companyName;
}

function getUserCompanyId($uid)
{
	
	global $con;
	$stmt = $con->prepare("SELECT company_id FROM tbl_company_user where user_id='$uid'");
	//$stmt->bind_param("i",$uid);
	$stmt->execute();
	$stmt->bind_result($company_id);
	$stmt->fetch();
	$stmt->close();	
	if(!empty($company_id))
	{
	return $company_id;
	}

}

function getCompanyExpiry($uid)
{
$cResult = mysql_query ("SELECT * FROM tbl_company where id=$uid"); 
$num=mysql_numrows($cResult);
if($num)
	{
$row = mysql_fetch_assoc($cResult);
$id = $row['id'];
$companyid=mysql_result($cResult,0,"company_user_expiry");
return $companyid;
	}
}



function getCurrentUserMail($uid)
{
$result = mysql_query ("SELECT EMAIL FROM tbl_users where username='$uid'"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$email=mysql_result($result,0,"EMAIL");
return $email;
}

function getAminMail()
{
$result = mysql_query ("SELECT email FROM tbl_users where username='admin'"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$email=mysql_result($result,0,"email");
return $email;
}

function getFullNameFromID($uid)
{
	global $con;
	$stmt = $con->prepare("SELECT firstname,lastname FROM tbl_users where id=?");
	$stmt->bind_param("s",$uid);
	$stmt->execute();
	$stmt->bind_result($firstname,$lastname);
	$stmt->fetch();
	$stmt->close();
	$fullname=ucfirst($firstname)." ".ucfirst($lastname);
	return $fullname;

}

function getFullNameFromIDMask($uid)
{
	global $con;
	$stmt = $con->prepare("SELECT firstname FROM tbl_users where id=?");
	$stmt->bind_param("s",$uid);
	$stmt->execute();
	$stmt->bind_result($firstname);
	$stmt->fetch();
	$stmt->close();
	$fullname=ucfirst($firstname);
	return $fullname;

}

function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}

function getFullName($uid)
{
	global $con;
	$stmt = $con->prepare("SELECT firstname,lastname FROM tbl_users where username=?");
	$stmt->bind_param("s",$uid);
	$stmt->execute();
	$stmt->bind_result($firstname,$lastname);
	$stmt->fetch();
	$stmt->close();
	$fullname=ucfirst($firstname)." ".ucfirst($lastname);
	return $fullname;

}
///////////////////////////////////////////////////REPORT FUNCTIONS////////////////////////////////

function getTotalRegistered()
{
$thisTotal = mysql_query ("SELECT COUNT(*) FROM tbl_users as A, tbl_company_user as B where A.id=B.user_id and A.usertype<>1"); 
$trow = mysql_result($thisTotal, 0, 0);
return $trow;
}



function getTotalRegisteredForCountry($countryid)
{
$thisTotal = mysql_query ("SELECT COUNT(*) FROM tbl_users as A, tbl_company_user as B where A.id=B.user_id and B.company_id=$countryid and A.usertype<>1"); 
$trow = mysql_result($thisTotal, 0, 0);
return $trow;
}

function getTotalLoggedIn()
{
$thisTotal = mysql_query ("SELECT A.user_id FROM tbl_company_user as A, tbl_entry_log as B where A.user_id=B.user_id"); 
$num=mysql_numrows($thisTotal);
$loggedin="";
$i=0;
	while ($i < $num) {
	$row = mysql_fetch_assoc($thisTotal);
	if($loggedin=="")
	{
	$loggedin=mysql_result($thisTotal,$i,"A.user_id");
	}
	else
	{
	$loggedin=$loggedin.",".mysql_result($thisTotal,$i,"A.user_id");
	}
	$i++;
	}
if($loggedin=="")
{
$count=0;
}
else
{
$arrLoggedIn=array_unique(explode(",",$loggedin));
$count=count($arrLoggedIn);
}
return $count;

}


function getTotalLoggedInForCountry($countryid)
{
$thisTotal = mysql_query ("SELECT A.user_id FROM tbl_company_user as A, tbl_entry_log as B where A.user_id=B.user_id and A.company_id=$countryid"); 
$num=mysql_numrows($thisTotal);
$loggedin="";
$i=0;
	while ($i < $num) {
	$row = mysql_fetch_assoc($thisTotal);
	if($loggedin=="")
	{
	$loggedin=mysql_result($thisTotal,$i,"A.user_id");
	}
	else
	{
	$loggedin=$loggedin.",".mysql_result($thisTotal,$i,"A.user_id");
	}
	$i++;
	}
if($loggedin=="")
{
$count=0;
}
else
{
$arrLoggedIn=array_unique(explode(",",$loggedin));
$count=count($arrLoggedIn);
}
return $count;

}



function getTotalNumberCourseCompletedAll($courseid)
{
$thisTotal = mysql_query ("SELECT DISTINCT C.userid FROM tbl_company_user as A, tbl_entry_log as B, tls_scorm_sco_tracking as C where A.user_id=B.user_id and A.user_id=C.userid and C.element='cmi.core.lesson_status' and C.value='passed' and C.scormid=$courseid"); 
$num=mysql_numrows($thisTotal);
$loggedin="";
$i=0;
	while ($i < $num) {
	$row = mysql_fetch_assoc($thisTotal);
	if($loggedin=="")
	{
	$loggedin=mysql_result($thisTotal,$i,"C.userid");
	}
	else
	{
	$loggedin=$loggedin.",".mysql_result($thisTotal,$i,"C.userid");
	}
	$i++;
	}
if($loggedin=="")
{
$count=0;
}
else
{
$arrLoggedIn=array_unique(explode(",",$loggedin));
$count=count($arrLoggedIn);
}
return $count;
}



function getTotalNumberCourseCompleted($countryid,$courseid)
{
$thisTotal = mysql_query ("SELECT DISTINCT C.userid FROM tbl_company_user as A, tbl_entry_log as B, tls_scorm_sco_tracking as C where A.user_id=B.user_id and A.company_id=$countryid and A.user_id=C.userid and C.element='cmi.core.lesson_status' and C.value='passed' and C.scormid=$courseid"); 
$num=mysql_numrows($thisTotal);
$loggedin="";
$i=0;
	while ($i < $num) {
	$row = mysql_fetch_assoc($thisTotal);
	if($loggedin=="")
	{
	$loggedin=mysql_result($thisTotal,$i,"C.userid");
	}
	else
	{
	$loggedin=$loggedin.",".mysql_result($thisTotal,$i,"C.userid");
	}
	$i++;
	}
if($loggedin=="")
{
$count=0;
}
else
{
$arrLoggedIn=array_unique(explode(",",$loggedin));
$count=count($arrLoggedIn);
}
return $count;
}


function getTotalPercentCourseCompletedAll($courseid)
{
$totalPercent=round(getTotalNumberCourseCompletedAll($courseid)/getTotalLoggedIn()*100);
return $totalPercent;
}

function getTotalPercentCourseCompleted($countryid,$courseid)
{
$totalPercent=round(getTotalNumberCourseCompleted($countryid,$courseid)/getTotalLoggedInForCountry($countryid)*100);
return $totalPercent;
}


function getCurriculumScore($currentUserId)
{
	$curriculamArray = array('1','2','3','4','5','7','8','9','10','11','12');
	$totalScore=0;
	for($i=0;$i<count($curriculamArray);$i++)
	{
		$currentScormId=$curriculamArray[$i];
		$thisTotal = mysql_query ("SELECT * from tls_scorm_sco_tracking where userid=$currentUserId and element='cmi.core.score.raw' and scormid=$currentScormId"); 
		$num=mysql_numrows($thisTotal);
		if($num)
		{
			/*if($currentUserId==17)
			{
			echo $currentScormId."-->>".mysql_result($thisTotal,0,"value")."<br>";
			}*/
		$totalScore=$totalScore+mysql_result($thisTotal,0,"value");
		}
	}
	$finalScore=round($totalScore/count($curriculamArray));
	return $finalScore;
}

function getTotalActaulsBetween($countryid,$low,$high)
{
$thisTotal = mysql_query ("SELECT * FROM tbl_users as A, tbl_company_user as B where A.id=B.user_id and B.company_id=$countryid and A.usertype<>1"); 
$num=mysql_numrows($thisTotal);
$actualsCount=0;
$i=0;
	while ($i < $num) {
	$row = mysql_fetch_assoc($thisTotal);
	$currentUserId=mysql_result($thisTotal,$i,"B.user_id");
	$curriculamScore=getCurriculumScore($currentUserId);
	//echo $currentUserId."=".$curriculamScore."<br>";
	if($curriculamScore>=$low && $curriculamScore<=$high)
	{
	$actualsCount++;
	}
	$i++;
	}
	return $actualsCount;
}

function getTotalActaulsBetweenAll($low,$high)
{
$thisTotal = mysql_query ("SELECT * FROM tbl_users as A, tbl_company_user as B where A.id=B.user_id and A.usertype<>1"); 
$num=mysql_numrows($thisTotal);
$actualsCount=0;
$i=0;
	while ($i < $num) {
	$row = mysql_fetch_assoc($thisTotal);
	$currentUserId=mysql_result($thisTotal,$i,"B.user_id");
	$curriculamScore=getCurriculumScore($currentUserId);
	//echo $currentUserId."=".$curriculamScore."<br>";
	if($curriculamScore>=$low && $curriculamScore<=$high)
	{
	$actualsCount++;
	}
	$i++;
	}
	return $actualsCount;
}

function getTotalPercentageBetween($countryid,$low,$high)
{
$totalPercent=round(getTotalActaulsBetween($countryid,$low,$high)/getTotalRegisteredForCountry($countryid)*100);
return $totalPercent;
}


function getTotalPercentageBetweenAll($low,$high)
{
$totalPercent=round(getTotalActaulsBetweenAll($low,$high)/getTotalRegistered()*100);
return $totalPercent;
}
///////////////////////////////////////////////////REPORT FUNCTIONS////////////////////////////////
function TrimStringExtraSmall($tempStr)
{
$tempStrLen=strlen($tempStr);
if($tempStrLen>10)
{
$tempStr=substr($tempStr,0,10);
return $tempStr."...";
}
else
{
return trim($tempStr);
}
}

function TrimStringSmall($tempStr)
{
$tempStrLen=strlen($tempStr);
if($tempStrLen>25)
{
$tempStr=substr($tempStr,0,25);
return $tempStr."...";
}
else
{
return trim($tempStr);
}
}

function TrimString($tempStr)
{
$tempStrLen=strlen($tempStr);
if($tempStrLen>50)
{
$tempStr=substr($tempStr,0,40);
return $tempStr."...";
}
else
{
return trim($tempStr);
}
}


function TrimStringCourseTitle($tempStr)
{
$tempStrLen=strlen($tempStr);
if($tempStrLen>20)
{
$tempStr=substr($tempStr,0,20);
return $tempStr."...";
}
else
{
return trim($tempStr);
}
}


function TrimStringCourseTitleBig($tempStr)
{
$tempStrLen=strlen($tempStr);
if($tempStrLen>55)
{
$tempStr=substr($tempStr,0,55);
return $tempStr."...";
}
else
{
return trim($tempStr);
}
}

function TrimStringMedium($tempStr)
{
$tempStrLen=strlen($tempStr);
if($tempStrLen>75)
{
$tempStr=substr($tempStr,0,75);
return $tempStr."...";
}
else
{
return trim($tempStr);
}
}

function TrimStringLarge($tempStr)
{
$tempStrLen=strlen($tempStr);
if($tempStrLen>100)
{
$tempStr=substr($tempStr,0,100);
return $tempStr."...";
}
else
{
return trim($tempStr);
}
}



function getDocumentType($ext)
{
	$ext=strtolower($ext);
$doctype='';
if($ext=='txt')
{
$doctype="Plain Text Document";
}
if($ext=='ppt')
{
$doctype="Power Point Presentation";
}
if($ext=='pps')
{
$doctype="Power Point Slideshow";
}
if($ext=='doc')
{
$doctype="MS Word Document";
}
if($ext=='pdf')
{
$doctype="Acrobat Reader PDF Document";
}
if($ext=='pdf')
{
$doctype="Acrobat Reader PDF Document";
}
if($ext=='xls')
{
$doctype="MS Excel Workbook";
}
if($ext=='exe')
{
$doctype="Application";
}
if($ext=='zip')
{
$doctype="ZIP Archive";
}
if($ext=='htm' || $ext=='html')
{
$doctype="HTML Document";
}
if($ext=='rtf')
{
$doctype="Rich Text Format Word Document";
}
if($ext=='swf')
{
$doctype="Flash Animation";
}
if($ext=='gif' || $ext=='jpg' || $ext=='jpeg')
{
$doctype="Graphic File (".$ext.")";
}
if($ext=='wav' || $ext=='mid' || $ext=='mp3' || $ext=='ra')
{
$doctype="Audio File (".$ext.")";
}
if($ext=='avi' || $ext=='mov' || $ext=='mpeg' || $ext=='mpg' || $ext=='rm' || $ext=='rv')
{
$doctype="Video File (".$ext.")";
}

return $doctype;
}


function parseDate( $dSent ) {
$recvdDate=$dSent;
$months = array
('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 

'September', 'October', 'November', 'December');
$days = array
('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
  $Sdate = getdate(strtotime($dSent));
  $Tdate = getdate(time());
  $mon = $Sdate['mon']-1; $mday = $Sdate['mday']; $year = $Sdate['year'];
 // $Cdate = "$months[$mon] $mday, $year";
$Cdate = "$mday - ".substr($months[$mon],0,3)." - $year";
 $hours = $Sdate['hours']; $minutes = $Sdate['minutes']; $seconds = $Sdate['seconds'];
  if ($hours < 10) { $hours = "0$hours"; }
  if ($minutes < 10) { $minutes = "0$minutes"; }
  if ($seconds < 10) { $seconds = "0$seconds"; }
  $Ctime = "$hours:$minutes:$seconds";
  $Cyday = $Tdate['yday'] - $Sdate['yday'];
  if ($Sdate['year'] == $Tdate['year']) {
    $Cyday = $Tdate['yday'] - $Sdate['yday'];

    $Cwday = $Tdate['wday'] - $Sdate['wday'];
    /*if ($Cyday == 0) { $date = "Today"; }
    else if ($Cyday == 1) { $date = "Yesterday"; }
	else if ($Cyday == -1) { $date = "Tomorrow"; }*/
   // else { 
	$temp=explode(" ",$recvdDate);
    $tempNew=explode("-",$temp[0]);                       
	$dateView=$tempNew[2]."-".$tempNew[1]."-".$tempNew[0];
	
	if($tempNew[0]==date('Y'))
		{
		$Cdate = "$mday ".$months[$mon]." $year";
	$date = $Cdate; 
		}
		else
		{
		$Cdate = "$mday ".$months[$mon]." $year";
		$date = $Cdate;
		}
 //}
  } else { 
	  
  $temp=explode(" ",$recvdDate);
                         
	$tempNew=explode("-",$temp[0]);
                           
	$dateView=$tempNew[2]."-".$tempNew[1]."-".$tempNew[0];

	  if($tempNew[0]==date('Y'))
		{
		$Cdate = "$mday ".$months[$mon]." $year";
	$date = $Cdate; 
		}
		else
		{
		$Cdate = "$mday ".$months[$mon]." $year";
		$date = $Cdate;
		}
	  
	  }
  //return $date; 
	
	$dSent1=date('d-m-Y',strtotime($dSent));
  return $dSent1;
}

function strip_htmscript($var,$type)
{
$var=htmlspecialchars($var);
$var=strip_tags($var);
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


function replace_newline($param)
{
$find= array("<br>","<font face='Trebuchet MS' size='3' color='#000000'>","<b>","</b>","</font>","<ul>","</ul>","<li>","</li>","<a href='http://www.CMS.com/edge-cms/' target='_blank'>","</a>","<a href='mailto:learningnet@hp.com' target='_blank'>");
$rep= array("\r\n","","","","","\r\n","\r\n","\r\n","\r\n","","","");
$value=str_replace($find, $rep, $param);
return $value;
}


function sendMail($to,$subject,$messageContent)
{
	
	//$from="Administrator";		
	//$from="liqvid@liqvid.com";
	
	/*
	$curdate=date('y-m-d');
	$from="admin@CMS.com";
	$saveMessage=replace_newline($messageContent);

	mysql_query("INSERT INTO tbl_mail_track (MAIL_TO, MAIL_SUBJECT, MAIL_MESSAGE, MAIL_FROM, MAIL_DATE) VALUES ('$to','$subject','$saveMessage','$from','$curdate')");

	$lastMailId=mysql_insert_id();

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
	if(@mail($to,$subject,$message,$headers))
	{
	mysql_query("UPDATE tbl_mail_track SET MAIL_STATUS ='1' WHERE ID=$lastMailId");
	}
	//echo "Mail Sent!";
	*/
}

function sendMailToAdmin($subject,$messageContent)
{
	
	//$to=getAminMail();
	/*
	$curdate=date('y-m-d');
	$from="admin@CMS.com";
	$to="learningnet@hp.com";	
	//$to="devendra.saxena@liqvid.com";	

	
	$saveMessage=replace_newline($messageContent);

	mysql_query("INSERT INTO tbl_mail_track (MAIL_TO, MAIL_SUBJECT, MAIL_MESSAGE, MAIL_FROM, MAIL_DATE) VALUES ('$to','$subject','$saveMessage','$from','$curdate')");
	$lastMailId=mysql_insert_id();

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
	if(@mail($to,$subject,$message,$headers))
	{
	mysql_query("UPDATE tbl_mail_track SET MAIL_STATUS ='1' WHERE ID=$lastMailId");
	}
	*/
}

function getDateDiff($whichDate)
{
$curdate=date("Y-m-d");
$date_diff = round( abs(strtotime($curdate)-strtotime($whichDate)) / 86400, 0 );
return $date_diff;
}

///////////////////Functions for LEARN////////////////////////

function getTotalCourses()
{
$thisTotal = mysql_query ("SELECT COUNT(*) FROM tls_scorm where coursetype<>'Demo'"); 
$trow = mysql_result($thisTotal, 0, 0);
return $trow;

}

function getTotalCoursesForUser($uname)
{
//echo "SELECT * from tbl_b2client as A, tls_scorm as B where username='$uname' and A.course_id=B.course and B.coursetype='WBT'";
$thisTotal = mysql_query ("SELECT * from tbl_b2client as A, tls_scorm as B where username='$uname' and A.course_id=B.course and B.coursetype='WBT'"); 
$num=mysql_numrows($thisTotal);
if(!$num)
{
$num=0;
}
return $num;

}

function getTotalChaptersForUser($uname)
{
$totalChapters=0;
$thisTotal = mysql_query ("SELECT * from tbl_b2client as A, tls_scorm as B where username='$uname' and A.course_id=B.course and B.coursetype='WBT'"); 
$num=mysql_numrows($thisTotal);
$i=0;
while ($i < $num) {
	$crs_id=mysql_result($thisTotal,$i,"A.course_id");
	$result = mysql_query ("select * from tls_scorm where course=$crs_id"); 
	$cnum=mysql_numrows($result);
	$chcont=mysql_result($result,0,"chapters");
	$totalChapters=$totalChapters+$chcont;

	
	$i++;
	}


return $totalChapters;

}

function getUserCourseStatusFinal($user_row_id,$scormID)
{
$result = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_row_id and scormid=$scormID"); 
$num=mysql_numrows($result);
	if($num==0)
	{
		$status='Not Attempted';
	}
	else
	{
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
		$status=mysql_result($result,0,"value");
		if($status=='failed')
		{
			$result2 = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.score.raw' and userid=$user_row_id and scormid=$scormID"); 
			$num2=mysql_numrows($result2);
			if($num2==0)
			{
			$status='incomplete';
			}
		}
	}
return $status;
}

function getUserCourseLastVisited($user_row_id,$scormID)
{
$result = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_row_id and scormid=$scormID"); 
$num=mysql_numrows($result);
	if($num==0)
	{
		$status='NA';
	}
	else
	{
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
		$status=mysql_result($result,0,"timemodified");
	}
return $status;
}

function getUserTimeSpent($user_row_id,$scormID)
{
$result = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.total_time' and userid=$user_row_id and scormid=$scormID"); 
$num=mysql_numrows($result);
	if($num==0)
	{
		$status='00:00:00';
	}
	else
	{
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
		$status=mysql_result($result,0,"value");
	}
return $status;
}

function getUserIdFromUsername($uid)
{
$result = mysql_query ("SELECT * FROM tbl_users where username='$uid'"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowId=mysql_result($result,0,"ID");
return $rowId;
}

function formatToNewTime($str_time) {
	//$milliseconds=strtotime($milliseconds) - strtotime('TODAY');
	$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
	sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
	$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
    $milliseconds = $time_seconds*1000;
    $seconds = floor($milliseconds / 1000);
    $minutes = floor($seconds / 60);
    $hours = floor($minutes / 60);
    $milliseconds = $milliseconds % 1000;
    $seconds = $seconds % 60;
    $minutes = $minutes % 60;

    $format = '%u hrs %02u mins';
    $time = sprintf($format, $hours, $minutes);
    return rtrim($time, '0');
}

function formatToSeconds($str_time) {
	$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
	sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
	$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
	return $time_seconds;
}

function formatToMinutes($str_time) {
	$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
	sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
	$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
	return $time_seconds/60;
}

function getUserCompletion($login_session,$bundleList)
{
$totalDuration=0;
$userTime=0;
$user_row_id=getUserIdFromUsername($login_session);
for($i = 0 ; $i < sizeof($bundleList) ; $i++){
	$result4 = mysql_query("SELECT * FROM tbl_b2client_bundle where bundle = '$bundleList[$i]' and client_id = 2") or die("1Failed Query of " . mysql_error());
		$row = mysql_fetch_array($result4);
		$bundleDesc = $row['bundle_desc'];
		$courses = explode(',' , $bundleDesc);
		for($j=0 ; $j < sizeof($courses) ; ++$j){
			$result5 = mysql_query("SELECT course_duration FROM tls_sco_info as A, tls_scorm as B where A.course_id=B.course and A.course_id = '$courses[$j]' and B.coursetype='WBT'") or die("1Failed Query of " . mysql_error());
			$num=mysql_numrows($result5);
			if($num)
			{
			$cResult = mysql_fetch_array($result5);
			$course_duration = $cResult['course_duration'];
			$totalDuration=$totalDuration + formatToSeconds($course_duration);
				//Get User's time
				$resultTrack = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.total_time' and userid=$user_row_id and scormid=$courses[$j]"); 
				$numTrack=mysql_numrows($resultTrack);
				if($numTrack)
				{
					$row = mysql_fetch_assoc($resultTrack);
					$id = $row['id'];
					$utime=mysql_result($resultTrack,0,"value");
					$userTime=$userTime  + formatToSeconds($utime);
				}
				///////////

			}
		}
	}
	$percent = $userTime/$totalDuration;
	$percent_friendly = number_format( $percent * 100, 0 ) . '%';
	if($percent_friendly > 100)
	{
	$percent_friendly="100%";
	}
	return $percent_friendly;
}

function getUserCompletionForBadge($login_session,$bundleList)
{
$uTrackData="";
$chapters=array();
$trackArr=array();
$trackArrRefined=array();
$totalChapters=0;

$user_row_id=getUserIdFromUsername($login_session);
for($i = 0 ; $i < sizeof($bundleList) ; $i++){
	$result4 = mysql_query("SELECT * FROM tbl_b2client_bundle where bundle = '$bundleList[$i]' and client_id = 2") or die("1Failed Query of " . mysql_error());
		$row = mysql_fetch_array($result4);
		$bundleDesc = $row['bundle_desc'];
		$courses = explode(',' , $bundleDesc);
		for($j=0 ; $j < sizeof($courses) ; ++$j){
			
				$result5 = mysql_query("SELECT chapters from tls_scorm where course = '$courses[$j]' and coursetype='WBT'") or die("1Failed Query of " . mysql_error());
				$numCh=mysql_numrows($result5);
				if($numCh)
				{
				$cResult = mysql_fetch_array($result5);
				$no_chapters = $cResult['chapters'];
				array_push($chapters,$no_chapters);
				$totalChapters=$totalChapters+$no_chapters;
				}


				$resultTrack = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.suspend_data' and userid=$user_row_id and scormid=$courses[$j]"); 
				$numTrack=mysql_numrows($resultTrack);
				if($numTrack)
				{
					$row = mysql_fetch_assoc($resultTrack);
					$id = $row['id'];
					$utrack=mysql_result($resultTrack,0,"value");
					$utrackR=explode(":",$utrack);
					//return $utrackR;exit;
					$output = array_slice($utrackR, 0, $no_chapters);
					$outputStr=implode(",",$output);
					//$uTrackData.="^^".$utrack;
					array_push($trackArr,$outputStr);
					

					//$userTime=$userTime  + formatToSeconds($utime);
				}
				///////////

			
		}
	}

	$finalString=implode(",",$trackArr);
	
	$finalArr=explode(",",$finalString);
	$totalScoreRequired=$totalChapters*2;
	$totalScore=array_sum($finalArr);
	$percent=round(($totalScore/$totalScoreRequired)*100);
	return $percent;
}

function getUserCourseDate($user_row_id,$scormID)
{
$result = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_row_id and scormid=$scormID"); 
$num=mysql_numrows($result);
	if($num==0)
	{
		$mdate='';
	}
	else
	{
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
		$status=mysql_result($result,0,"value");
		if($status=='completed')
		{
		$mdate=mysql_result($result,0,"timemodified");
		}
		else
		{
		$mdate='';
		}

	}
return $mdate;
}

function getClientNameFromID($cid)
{
	global $con;
	$stmt = $con->prepare("SELECT client_name FROM tbl_client where id=?");
	$stmt->bind_param("i",$cid);
	$stmt->execute();
	$stmt->bind_result($client_name);
	$stmt->fetch();
	$stmt->close();	

//$result = mysql_query ("SELECT * FROM tbl_client where id=$cid"); 
//$row = mysql_fetch_assoc($result);
//$id = $row['id'];
//$clientName=mysql_result($result,0,"client_name");
return $client_name;
}

function getNoLearnersForClient($cid)
{
$thisTotal = mysql_query ("SELECT COUNT(*) FROM tbl_users where client=$cid and usertype<>1"); 
$trow = mysql_result($thisTotal, 0, 0);
return $trow;
}

function getUserCourses($uid)
{

	global $con;
	$query1 = "SELECT COUNT(*) FROM tbl_b2client as A, tls_scorm as B where A.username='$uid' and A.course_id=B.course and B.coursetype='WBT'";
	$clientsResult = mysqli_query($con,$query1);
	$trow=mysqli_num_rows($clientsResult);
	//$thisTotal = mysql_query ("SELECT COUNT(*) FROM tbl_b2client as A, tls_scorm as B where A.username='$uid' and A.course_id=B.course and B.coursetype='WBT'"); 
	//$trow = mysql_result($thisTotal, 0, 0);
	return $trow;
}

function getEnrollmentDate($docid,$userCourseId)
{
$result = mysql_query ("SELECT registration_date FROM tbl_b2client where course_id=$docid and username='$userCourseId'"); 
$num=mysql_numrows($result);
	if($num==0)
	{
		$eDate='NA';
	}
	else
	{
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
		$eDate=mysql_result($result,0,"registration_date");
	}
return $eDate;
}

function getExpiryDate($docid,$userCourseId)
{
$result = mysql_query ("SELECT expiry_date FROM tbl_b2client where course_id=$docid and username='$userCourseId'"); 
$num=mysql_numrows($result);
	if($num==0)
	{
		$eDate='NA';
	}
	else
	{
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
		$eDate=mysql_result($result,0,"expiry_date");
	}
return $eDate;
}

function parseDateNatural($iDate)
{
	if($iDate!="" && $iDate!="NA")
	{
	$arrDate=explode("-",$iDate);
	$newDate=$arrDate[2]."-".$arrDate[1]."-".$arrDate[0];
	return $newDate;
	}
	else
	{
	return $iDate;
	}
}
///////////////////////////////////////////////////////////////

function getLoggedInUser(){
	

	/*$query = "SELECT * FROM tbl_users WHERE username = '".$_SESSION['login_user']."'";
	$result = mysql_query($query);
	$cnt = mysql_num_rows($result);
	$userArr = array();
	if($cnt > 0){
		$userArr = mysql_fetch_assoc($result);

	}
    echo "<pre>";print_r($userArr);exit;			
	return $userArr;*/

	global $con;
	$stmt = $con->prepare("SELECT id FROM tbl_users WHERE username=?");
	$stmt->bind_param("s",$myusername);
	$stmt->execute();
	$stmt->bind_result($id);
	$stmt->fetch();
	$stmt->close();	
	//closeConnection($con);
	if(!empty($id))
	{
	return 1;
	}

}
?>