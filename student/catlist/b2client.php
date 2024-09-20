<?php
//session_start();

include("lib.php");
$token=$_REQUEST['token'];
$result = mysql_query ("SELECT * FROM tbl_b2client where token='$token'");
$expiry_date=mysql_result($result,0,"expiry_date");
$order_id=mysql_result($result,0,"order_id");
$client_id=mysql_result($result,0,"client_id");

$date = date_create();
$todayDate = date_timestamp_get($date);
$currentDate=Date('m-d-Y');
function getCourseNameFromCourseId($uid)
{
$result = mysql_query ("SELECT * FROM tls_scorm where id=$uid"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowId=mysql_result($result,0,"name");
return $rowId;
}

function getUserCourseStatusForUser($user_rowid,$docid)
{
$result = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_rowid and scormid=$docid"); 
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
			$result2 = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.score.raw' and userid=$user_rowid and scormid=$docid"); 
			$num2=mysql_numrows($result2);
			if($num2==0)
			{
			$status='incomplete';
			}
		}
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


if($todayDate > strtotime($expiry_date)){
echo 'Course is expired';
exit;
}else{
$username=mysql_result($result,0,"username");
$user_rowid=getUserIdFromUsername($username);
$course_id=mysql_result($result,0,"course_id");
$courseName=getCourseNameFromCourseId($course_id);
$courseStatus=getUserCourseStatusForUser($user_rowid,$course_id);
$status=mysql_result($result,0,"status");
$result1 = mysql_query ("SELECT * FROM tbl_users where username='$username'"); 
$uid=mysql_result($result1,0,"id");

$_SESSION['sess_uid'] = $username;

$curdate=date('Y-m-d');
$userip=$_SERVER['REMOTE_ADDR'];

if($status == 0){

if ($client_id == 1){
$data = array("order_id" => $order_id, "status_code" => "initiated" , "vendor_code" => "LIQVID");                                                                    
$data_string = json_encode($data);                                                                                   
 
$ch = curl_init('http://stepahead.timesjobs.com/ecm/vendorResponse.html');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   
 
$result = curl_exec($ch);
$data = json_decode($result, true);
$response = $data['responseCode'];

if ($response == 0){
mysql_query("update tbl_b2client set status = 1 where token='$token'");
file_put_contents('CourseStat.txt' , 'DONE' . PHP_EOL , FILE_APPEND);
}else{
file_put_contents('CourseStat.txt' , 'NOT DONE' . PHP_EOL , FILE_APPEND);
}
}else{
mysql_query("update tbl_b2client set status = 1 where token='$token'");
}

}


mysql_query("INSERT INTO tbl_b2client_course_entry_log (username, user_ip, user_entry) VALUES ('$username', '$userip','$curdate')");


$cid=1;
$scoid=$course_id;
$mode='normal';
$scorm=get_scorm_data($scoid);
$scorm_sco=get_scorm_sco_data($scoid);

$scorm_sco_track=get_scorm_sco_track_data($uid,$scoid);
$modestring = '&mode='.$mode;
$scoidstring = '&scoid='.$scoid;
$currentorg = $scorm_sco['organization'];
$currentorgstring = '&currentorg='.$currentorg;
}
?>
<html>
<head>
<script language="JavaScript" type="text/javascript" src="request.js"></script>
<script language="JavaScript" type="text/javascript" src="api.php?id=<?php echo $cid.$scoidstring.$modestring;?>"></script>
<!-- start Mixpanel --><script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f)}})(document,window.mixpanel||[]);
mixpanel.init("e3d384cbf2d7235af845fa4217bb2a82");</script><!-- end Mixpanel -->

</head>	  
<title>Player</title>
<body topmargin='0' leftmargin='0' scroll='auto' onbeforeunload="onExit();">

	<!--To be used for debugging purpose
		<iframe name="api" width="800" height="300" src="api.php?id=<?php echo $cid.$scoidstring.$modestring ?>"></iframe>
			<iframe name="main" scrolling='no' width="<?=$scorm['width']?>" height="<?=$scorm['height']?>" src="loadSCO.php?id=<?php echo $cid.$scoidstring.$modestring ?>"></iframe>-->

<iframe name="main" scrolling='no' width="1024" height="677" src="loadSCO.php?id=<?php echo $cid.$scoidstring.$modestring ?>"></iframe>
<script>




mixpanel.track (
"Course Launch",
{"Course Name":"<?php echo $courseName;?>",
"Course Status":"<?php echo $courseStatus;?>",
"Course ID":"<?php echo $course_id;?>",
"Username":"<?php echo $username;?>",
"Date":"<?php echo $currentDate?>"
}
);

var startTime = new Date().getTime();

function dhm(t){
    var cd = 24 * 60 * 60 * 1000,
        ch = 60 * 60 * 1000,
        d = Math.floor(t / cd),
        h = '0' + Math.floor( (t - d * cd) / ch),
        m = '0' + Math.round( (t - d * cd - h * ch) / 60000);
    return [d, h.substr(-2), m.substr(-2)].join(':');
}

function msToTime(duration) {
	duration=(duration/1000);
    var minutes = Math.floor(duration / 60);
	if(minutes == 0)
	{
	minutes=1;
	}    
	return minutes;
}


function onExit()
{
	var endTime = new Date().getTime();
	var totalTime=endTime-startTime;
	totalTime= msToTime(totalTime);
	mixpanel.track (
	"Course Exit",
	{"Course Name":"<?php echo $courseName;?>",
	 "Username":"<?php echo $username;?>",
	 "Time Spent": totalTime,
	 "Date":"<?php echo $currentDate;?>"
	}
	);
}
</script>
</body>

<script>
/*
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-50000623-1', 'auto');
  ga('send', 'pageview');
  */
</script>
</html>