<?php
session_start();
if (!isset($_SESSION['login_user'])) 
{
//if the session does not exit, then take the user to login page (CHECK IN CASE OF FAL)
//header("Location: ../../b2c/index.php");
//exit();
}
include("../../connect.php");
//$userid=$_SESSION['sess_uid'];
if(isset($_SESSION['sess_uid']))
{
$userid=$_SESSION['sess_uid'];
}
else
{
	if(isset($_REQUEST['userid']))
	{
	$userid=$_REQUEST['userid'];
	}
}
//echo "--->".$userid;exit;

$con=createConnection();
$stmt = $con->prepare("SELECT id,username,firstname,lastname FROM tbl_users where username=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$stmt->bind_result($uid,$username,$f_name,$l_name);
$stmt->fetch();
$stmt->close();
	
	
/*$fullname=ucfirst($firstname)." ".ucfirst($lastname);
$result = mysql_query ("SELECT * FROM tbl_users where username='$userid'"); 
$num=mysql_numrows($result);
$uid=mysql_result($result,0,"id");
$username=mysql_result($result,0,"username");
$f_name=mysql_result($result,0,"firstname");
$l_name=mysql_result($result,0,"lastname");*/



////Get User Id
function get_userid($uid)
{
return $uid;

/*return $uid;
//global $db;
$sql="select id from auth_user_md5 where uid='".$uid."'";
$db->query($sql);
$db->next_record();
$userid=$db->f("id");
return $userid;*/
}

///Get Data from scorm table
function get_scorm_data($cid)
{
	global $con;
	$scorm=array();
	$stmt = $con->prepare("select id,course,name,reference,version,maxgrade,grademethod,launch,summary,browsemode,auto,width,height,timemodified from tls_scorm where course=?");
	$stmt->bind_param("s",$cid);
	$stmt->execute();
	$stmt->bind_result($id,$course,$name,$reference,$version,$maxgrade,$grademethod,$launch,$summary,$browsemode,$auto,$width,$height,$timemodified);
	$stmt->fetch();
	$stmt->close();

	if (!empty($id))
	{
			$scorm['id']=$id;
			$scorm['course']=$course;
			$scorm['name']=$name;
			$scorm['reference']=$reference;
			$scorm['version']=$version;
			$scorm['maxgrade']=$maxgrade;
			$scorm['grademethod']=$grademethod;
			$scorm['launch']=$launch;
			$scorm['summary']=$summary;
			$scorm['browsemode']=$browsemode;
			$scorm['auto']=$auto;
			$scorm['width']=$width;
			$scorm['height']=$height;
			$scorm['timemodified']=$timemodified;
			
			return $scorm;
	}

	else
	{
	return false;
	}

	
	/*$sql="select * from tls_scorm where course=".$cid;
	$result = mysql_query($sql);
	$num=mysql_numrows($result);
	$scorm=array();
	if ($num>0)
	{
			$scorm['id']=mysql_result($result,0,"id");
			$scorm['course']=mysql_result($result,0,"course");
			$scorm['name']=mysql_result($result,0,"name");
			$scorm['reference']=mysql_result($result,0,"reference");
			$scorm['version']=mysql_result($result,0,"version");
			$scorm['maxgrade']=mysql_result($result,0,"maxgrade");
			$scorm['grademethod']=mysql_result($result,0,"grademethod");
			$scorm['launch']=mysql_result($result,0,"launch");
			$scorm['summary']=mysql_result($result,0,"summary");
			$scorm['browsemode']=mysql_result($result,0,"browsemode");
			$scorm['auto']=mysql_result($result,0,"auto");
			$scorm['width']=mysql_result($result,0,"width");
			$scorm['height']=mysql_result($result,0,"height");
			$scorm['timemodified']=mysql_result($result,0,"timemodified");
	return $scorm;
	}
	else
	{
	return false;
	}*/
	
}

///Get Data from scorm_sco table
function get_scorm_sco_data($scoid)
{
	global $con;
	$scorm_sco=array();
	$stmt = $con->prepare("select id,scorm,manifest,organization,parent,identifier,launch,parameters,scormtype,title,prerequisites,maxtimeallowed,timelimitaction,datafromlms,masteryscore,next,previous from tls_scorm_sco where scorm=?");
	$stmt->bind_param("s",$scoid);
	$stmt->execute();
	$stmt->bind_result($id,$scorm,$manifest,$organization,$parent,$identifier,$launch,$parameters,$scormtype,$title,$prerequisites,$maxtimeallowed,$timelimitaction,$datafromlms,$masteryscore,$next,$previous);
	$stmt->fetch();
	$stmt->close();

	if (!empty($id))
	{
			$scorm_sco['id']=$id;
			$scorm_sco['scorm']=$scorm;
			$scorm_sco['manifest']=$manifest;
			$scorm_sco['organization']=$organization;
			$scorm_sco['parent']=$parent;
			$scorm_sco['identifier']=$identifier;
			$scorm_sco['launch']=$launch;
			$scorm_sco['parameters']=$parameters;
			$scorm_sco['scormtype']=$scormtype;
			$scorm_sco['title']=$title;
			$scorm_sco['prerequisites']=$prerequisites;
			$scorm_sco['maxtimeallowed']=$maxtimeallowed;
			$scorm_sco['timelimitaction']=$timelimitaction;
			$scorm_sco['datafromlms']=$datafromlms;
			$scorm_sco['masteryscore']=$masteryscore;
			$scorm_sco['next']=$next;
			$scorm_sco['previous']=$previous;
			//file_put_contents("output1.txt", print_r($scorm_sco, true));
			return $scorm_sco;	
	}

	else
	{
	return false;
	}
	
	
	/*$sql="select * from tls_scorm_sco where scorm=".$scoid;
	$result = mysql_query($sql);
	$num=mysql_numrows($result);
	$scorm_sco=array();
	if ($num>0)
	{
			$scorm_sco['id']=mysql_result($result,0,"id");
			$scorm_sco['scorm']=mysql_result($result,0,"scorm");
			$scorm_sco['manifest']=mysql_result($result,0,"manifest");
			$scorm_sco['organization']=mysql_result($result,0,"organization");
			$scorm_sco['parent']=mysql_result($result,0,"parent");
			$scorm_sco['identifier']=mysql_result($result,0,"identifier");
			$scorm_sco['launch']=mysql_result($result,0,"launch");
			$scorm_sco['parameters']=mysql_result($result,0,"parameters");
			$scorm_sco['scormtype']=mysql_result($result,0,"scormtype");
			$scorm_sco['title']=mysql_result($result,0,"title");
			$scorm_sco['prerequisites']=mysql_result($result,0,"prerequisites");
			$scorm_sco['maxtimeallowed']=mysql_result($result,0,"maxtimeallowed");
			$scorm_sco['timelimitaction']=mysql_result($result,0,"timelimitaction");
			$scorm_sco['datafromlms']=mysql_result($result,0,"datafromlms");
			$scorm_sco['masteryscore']=mysql_result($result,0,"masteryscore");
			$scorm_sco['next']=mysql_result($result,0,"next");
			$scorm_sco['previous']=mysql_result($result,0,"previous");
	return $scorm_sco;		
	}
	else
	{
	return false;
	}*/
	
	
}

///Get Data from scorm_sco_tracking table
function get_scorm_sco_track_data($userid,$scoid)
{
	


	global $con;
	$scorm_sco_track=array();
	$stmt = $con->prepare("select id,userid,scormid,scoid,element,value,timemodified from tls_scorm_sco_tracking where userid=? and scoid=?");
	$stmt->bind_param("ii",$userid,$scoid);
	$stmt->execute();
	$stmt->bind_result($id,$userid,$scormid,$scoid,$element,$value,$timemodified);
	$i=0;
	while($stmt->fetch()) { 
		//file_put_contents("count.txt", "test");
			$scorm_sco_track[$i]['id']=$id;
			$scorm_sco_track[$i]['userid']=$userid;
			$scorm_sco_track[$i]['scormid']=$scormid;
			$scorm_sco_track[$i]['scoid']=$scoid;
			$scorm_sco_track[$i]['element']=$element;
			$scorm_sco_track[$i]['value']=$value;
			$scorm_sco_track[$i]['timemodified']=$timemodified;
			
			$i++;
	}
	$stmt->close();
	//file_put_contents("output2.txt", print_r($scorm_sco_track, true));
    return $scorm_sco_track;
	
	////global $db;
	/*$sql="select * from tls_scorm_sco_tracking where userid=".$userid." AND scoid=".$scoid;
	$result = mysql_query($sql);
	$num=mysql_numrows($result);
	$scorm_sco_track=array();
	if ($num>0)
	{

		for ($i=0;$i<$num;$i++)
		{
			$scorm_sco_track[$i]['id']=mysql_result($result,$i,"id");
			$scorm_sco_track[$i]['userid']=mysql_result($result,$i,"userid");
			$scorm_sco_track[$i]['scormid']=mysql_result($result,$i,"scormid");
			$scorm_sco_track[$i]['scoid']=mysql_result($result,$i,"scoid");
			$scorm_sco_track[$i]['element']=mysql_result($result,$i,"element");
			$scorm_sco_track[$i]['value']=mysql_result($result,$i,"value");
			$scorm_sco_track[$i]['timemodified']=mysql_result($result,$i,"timemodified");
		}
	}
	
	return $scorm_sco_track;*/
}

function scorm_get_tracks($scoid,$userid) {
/// Gets all tracks of specified sco and user
//    global $CFG;
		$usertracks=array();
		$tracks = get_scorm_sco_track_data($userid,$scoid);
		
		if(count($tracks)>0)
		{
        $usertrack['userid'] = $userid;
        $usertrack['scoid'] = $scoid;
        $usertrack['score_raw'] = '';
        $usertrack['status'] = '';
        $usertrack['total_time'] = '00:00:00';
        $usertrack['session_time'] = '00:00:00';
        $usertrack['timemodified'] = 0;
        
		for($i=0;$i<count($tracks);$i++)
		{
		$element = $tracks[$i]['element'];
		$usertrack[$element]=$tracks[$i]['value'];
		switch ($element) {
                case 'cmi.core.lesson_status':
                case 'cmi.completition_status':
                    if ($tracks[$i]['value'] == 'not attempted') {
                        $tracks[$i]['value'] = 'notattempted';
                    }
                    $usertrack['status'] = $tracks[$i]['value'];
                break;
                case 'cmi.core.score.raw':
                case 'cmi.score.raw':
                    $usertrack['score_raw'] = $tracks[$i]['value'];
                break;
                case 'cmi.core.session_time':
                case 'cmi.session_time':
                    $usertrack['session_time'] = $tracks[$i]['value'];
                break;
                case 'cmi.core.total_time':
                case 'cmi.total_time':
                    $usertrack['total_time'] = $tracks[$i]['value'];
                break;
            }
			if (isset($tracks[$i]['timemodified']) && ($tracks[$i]['timemodified'] > $usertrack['timemodified'])) {
                $usertrack['timemodified'] = $tracks[$i]['timemodified'];
			}
		}
		//file_put_contents("output3.txt", print_r($usertrack, true));
	return $usertrack;
	}
	else
	{
	return false;
	}
   

}

//$abc=get_scorm_sco_track_element_data(1,1,2,'cmi.core.lesson_status');
//print_r($abc);
//exit;
////get sco specific data

///Get Data from scorm_sco table
function get_scorm_sco_track_element_data($userid,$scormid,$scoid,$element)
{
	global $con;
	$scorm_sco_track_element=array();
	$stmt = $con->prepare("select id,userid,scormid,scoid,element,value,timemodified from tls_scorm_sco_tracking where scoid=? AND userid=? AND element=? AND scormid=?");
	$stmt->bind_param("iisi",$scoid,$userid,$element,$scormid);
	$stmt->execute();
	$stmt->bind_result($id,$userid,$scormid,$scoid,$element,$value,$timemodified);
	$stmt->fetch();
	$stmt->close();

	if (!empty($id))
	{
			$scorm_sco_track_element['id']=$id;
			$scorm_sco_track_element['userid']=$userid;
			$scorm_sco_track_element['scormid']=$scormid;
			$scorm_sco_track_element['scoid']=$scoid;
			$scorm_sco_track_element['element']=$element;
			$scorm_sco_track_element['value']=$value;
			$scorm_sco_track_element['timemodified']=$timemodified;
			//file_put_contents("output4.txt", print_r($scorm_sco_track_element, true)."\n\n",FILE_APPEND);
			return $scorm_sco_track_element;		
	}

	else
	{
	return false;
	}
	
	
	
	/*$sql="select * from tls_scorm_sco_tracking where scoid=".$scoid." AND userid=".$userid." AND element='".$element."' AND scormid=".$scormid;
	$result = mysql_query($sql);
	$num=mysql_numrows($result);
	$scorm_sco_track_element=array();
	if ($num>0)
	{
	
			$scorm_sco_track_element['id']=mysql_result($result,0,"id");
			$scorm_sco_track_element['userid']=mysql_result($result,0,"userid");
			$scorm_sco_track_element['scormid']=mysql_result($result,0,"scormid");
			$scorm_sco_track_element['scoid']=mysql_result($result,0,"scoid");
			$scorm_sco_track_element['element']=mysql_result($result,0,"element");
			$scorm_sco_track_element['value']=mysql_result($result,0,"value");
			$scorm_sco_track_element['timemodified']=mysql_result($result,0,"timemodified");
	return $scorm_sco_track_element;		
	}
	else
	{
	return false;
	}*/
}
////

////insert history data

function getTimeValueInSeconds($total_time)
{
$arr_total_time=explode(".",$total_time);
$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $arr_total_time[0]);
sscanf($arr_total_time[0], "%d:%d:%d", $hours, $minutes, $seconds);
$time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
return $time_seconds; 
}

function convertToHHMMSS($seconds) {
  $t = round($seconds);
  return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
}

function updateTrackingHistory($userid,$obj)
{
global $con;
//file_put_contents('data1.txt',print_r($obj,true));
$scoid=$obj['scoid'];
$lesson_location=$obj['cmi__suspend_data'];
$lesson_status=$obj['cmi__core__lesson_status'];
$session_time=getTimeValueInSeconds($obj['cmi__core__session_time']);
$suspend_data=$obj['cmi__suspend_data'];
$score_data=$obj['cmi__core__score__raw'];
$attempt_date=Date("Y-m-d");



if(empty($lesson_status))
{
	if(empty($suspend_data))
	{
		//set completed and completion time
		//$result2 = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where userid=".$userid." and scormid=".$scoid." and scoid=".$scoid." AND element='cmi.core.lesson_status'"); 
		//$num2=mysql_numrows($result2);
		//$lesson_status=mysql_result($result2,0,"value");

		$stmt = $con->prepare("SELECT value FROM tls_scorm_sco_tracking where userid=? and scormid=? and scoid=? AND element='cmi.core.lesson_status'");
		$stmt->bind_param("iii",$userid,$scoid,$scoid);
		$stmt->execute();
		$stmt->bind_result($value);
		$stmt->fetch();
		$stmt->close();
		$lesson_status=$value;
	}
	else
	{
		$value= substr($suspend_data,0,strlen($suspend_data)-2);
		$arrValue=explode(",",$value);
		if(in_array('0',$arrValue))
		{
			$lesson_status='incomplete';
		}
		else
		{
			$lesson_status='completed';
		}
			
	}
}

if(!empty($score_data))
{
	if($score_data >= 60)
	{
		$lesson_status='completed';
	}
	else
	{
    	$lesson_status='incomplete';
	}
}
else
{
	$score_data=0;
}


$stmt = $con->prepare("SELECT id,username,firstname,lastname,dtenrolled FROM tbl_users where id=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$stmt->bind_result($userid,$uid,$fnm,$lnm,$registration_date);
$stmt->fetch();
$stmt->close();


/*$result = mysql_query ("SELECT * FROM tbl_users where id=$userid"); 
$num=mysql_numrows($result);
$userid=mysql_result($result,0,"id");
$fnm=mysql_result($result,0,"firstname");
$lnm=mysql_result($result,0,"lastname");
$uid=mysql_result($result,0,"username");
$registration_date=mysql_result($result,0,"dtenrolled");*/


$stmt = $con->prepare("SELECT name FROM tls_scorm where id=?");
$stmt->bind_param("s",$scoid);
$stmt->execute();
$stmt->bind_result($courseName);
$stmt->fetch();
$stmt->close();

//$resultcourse = mysql_query ("SELECT * FROM tls_scorm where id='$scoid'"); 
//$numcourse=mysql_numrows($resultcourse);
//$courseName=mysql_result($resultcourse,0,"name");


$stmt = $con->prepare("SELECT name FROM tls_scorm where id=?");
$stmt->bind_param("s",$scoid);
$stmt->execute();
$stmt->bind_result($courseName);
$stmt->fetch();
$stmt->close();

$stmt = $con->prepare("SELECT id FROM rpt_tracking_history where user_id=? and course_id=? and time_spent_secs=$session_time and DATE(last_attempted_date)='$attempt_date'");
$stmt->bind_param("ii",$userid,$scoid);
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();


//$query="SELECT * FROM rpt_tracking_history where user_id='$userid' and course_id='$scoid' and time_spent_secs=$session_time and DATE(last_attempted_date)='$attempt_date'"; 
//$resultcom = mysql_query ($query); 
//$numcom=mysql_numrows($resultcom);
		
if(empty($id))
{

	//$result = mysql_query ("SELECT * FROM tbl_sco_completion where userid='$userid' and scoid='$scoid'"); 
	//$numc=mysql_numrows($result);

	$stmt = $con->prepare("SELECT comp_date FROM tbl_sco_completion where userid=? and scoid=?");
	$stmt->bind_param("ii",$userid,$scoid);
	$stmt->execute();
	$stmt->bind_result($comp_date);
	$stmt->fetch();
	$stmt->close();
	
	if($lesson_status=='completed')
	{
	 
	 if($numc==0)
	  {
	  $comp_date=Date("Y-m-d");
	  }
	  else
	  {
	  $comp_date=$comp_date;
	  }
	}
	else
	{
	$comp_date='';
	}
	
	if($scoid==5 || $scoid==10 || $scoid==5)
    {
		$comp_Type='Assessment';
	}
	else
	{
		$comp_Type='Course';
	}

	
	$query = "insert into rpt_tracking_history(user_id,registration_date,course_id,course_name,comp_type,first_name,last_name,user_name,completion_status,time_spent_secs,score,last_attempted_date,completion_date) values($userid,'$registration_date',$scoid,'$courseName','$comp_type','$fnm','$lnm','$uid','$lesson_status',$session_time,$score_data,'$attempt_date','$comp_date')";
	$stmt = $con->prepare($query);
	$stmt->execute();
	$stmt->close();

	//$sql="insert into rpt_tracking_history(user_id,registration_date,course_id,course_name,comp_type,first_name,last_name,user_name,completion_status,time_spent_secs,score,last_attempted_date,completion_date) values($userid,'$registration_date',$scoid,'$courseName','$comp_type','$fnm','$lnm','$uid','$lesson_status',$session_time,$score_data,'$attempt_date','$comp_date')";
	//file_put_contents('datasql.txt',$sql."\n\n",FILE_APPEND);
	//mysql_query($sql);
}

}



////insert sco track data
function insert_scorm_sco_track_record($trackedData)
{
global $con;
//file_put_contents("tracking.txt",$trackedData['element']."-".$trackedData['value']."\n",FILE_APPEND);
//file_put_contents("a.txt","aaa\n\n",FILE_APPEND);


$query="insert into tls_scorm_sco_tracking (`userid`,`scormid`,`scoid`,`element`,`value`,`timemodified`) VALUES ('".$trackedData['userid']."','".$trackedData['scormid']."','".$trackedData['scoid']."','".$trackedData['element']."','".$trackedData['value']."','".$trackedData['timemodified']."')";
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->close();

//file_put_contents("input.txt",$query."\n\n",FILE_APPEND);

//$sql="insert into tls_scorm_sco_tracking (`userid`,`scormid`,`scoid`,`element`,`value`,`timemodified`) VALUES ('".$trackedData['userid']."','".$trackedData['scormid']."','".$trackedData['scoid']."','".$trackedData['element']."','".$trackedData['value']."','".$trackedData['timemodified']."')";
//mysql_query($sql);


if($trackedData['element']=="cmi.core.lesson_status")
	{
		

		if(strtolower($trackedData['value'])=="completed" || strtolower($trackedData['value'])=="passed" || strtolower($trackedData['value'])=="failed")
		{
			$userid=$trackedData['userid'];
			$scoid=$trackedData['scoid'];
			$compdate=Date("Y-m-d");

		
			$stmt = $con->prepare("SELECT id FROM tbl_sco_completion where userid=? and scoid=?");
			$stmt->bind_param("ii",$userid,$scoid);
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->close();

			//$result = mysql_query ("SELECT * FROM tbl_sco_completion where userid='$userid' and scoid='$scoid'"); 
			//$num=mysql_numrows($result);
			if(empty($id))
			{
				
				//$sql2="insert into tbl_sco_completion (userid,scoid,comp_date) VALUES ('$userid','$scoid','$compdate')";
				//mysql_query($sql2);
				$query="insert into tbl_sco_completion (userid,scoid,comp_date) VALUES (?,?,?)";
				$stmt->bind_param("sss",$userid,$scoid,$compdate);
				$stmt = $con->prepare($query);
				$stmt->execute();
				$stmt->close();
	
			}
			else
			{
				$query="update tbl_sco_completion set comp_date='$compdate' where userid='$userid' and scoid='$scoid'";
				$stmt->bind_param("sss",$compdate,$userid,$scoid);
				$stmt = $con->prepare($query);
				$stmt->execute();
				$stmt->close();
				//$sql2="update tbl_sco_completion set comp_date='$compdate' where userid='$userid' and scoid='$scoid'"; 
				//mysql_query($sql2);
			}
		}
	}


	updateStatus($trackedData['userid'],$trackedData['scormid'],$trackedData['scoid']);
	
	
}
////

////Update sco track data
function update_scorm_sco_track_record($trackedData)
{
global $con;
//file_put_contents("update.txt","update\n\n",FILE_APPEND);
/*if($trackedData['element']=="cmi.core.lesson_status" && strtolower($trackedData['value'])=="passed")
{
$trackedData['value']=="completed";
}*/


if($trackedData['element']=="cmi.core.lesson_status")
{
		$stmt = $con->prepare("SELECT value FROM tls_scorm_sco_tracking where userid=? and scormid=? and scoid=? AND element='cmi.core.lesson_status'");
		$stmt->bind_param("iii",$trackedData[userid],$trackedData[scormid],$trackedData[scoid]);
		$stmt->execute();
		$stmt->bind_result($comp_value);
		$stmt->fetch();
		$stmt->close();

		
		//$result2 = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where userid=".$trackedData[userid]." and scormid=".$trackedData[scormid]." and scoid=".$trackedData[scoid]." AND element='cmi.core.lesson_status'"); 
		//$num2=mysql_numrows($result2);
		
		
		if(!empty($comp_value))
		{
			//$uCompletionValue=mysql_result($result2,0,"value");
			$uCompletionValue=$comp_value;
			if($uCompletionValue=='completed')
			{
				//do nothing
			}
			else
			{

				$query="update tls_scorm_sco_tracking set value='".$trackedData[value]."',timemodified=".$trackedData[timemodified]." where userid=? AND scormid=? AND scoid=? AND element='".$trackedData[element]."'";
				$stmt = $con->prepare($query);
				$stmt->bind_param("sss",$trackedData[userid],$trackedData[scormid],$trackedData[scoid]);
				$stmt->execute();
				$stmt->close();
			//$sql="update tls_scorm_sco_tracking set value='".$trackedData[value]."',timemodified=".$trackedData[timemodified]." where userid=".$trackedData[userid]." AND scormid=".$trackedData[scormid]." AND scoid=".$trackedData[scoid]." AND element='".$trackedData[element]."'";
			//mysql_query($sql);
			}
			
		}
}

else if($trackedData['element']=="cmi.core.score.raw")
{
		//$result2 = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where userid=".$trackedData[userid]." and scormid=".$trackedData[scormid]." and scoid=".$trackedData[scoid]." AND element='cmi.core.score.raw'"); 
		//$num2=mysql_numrows($result2);
		$stmt = $con->prepare("SELECT value FROM tls_scorm_sco_tracking where userid=? and scormid=? and scoid=? AND element='cmi.core.score.raw'");
		$stmt->bind_param("iii",$trackedData[userid],$trackedData[scormid],$trackedData[scoid]);
		$stmt->execute();
		$stmt->bind_result($score_value);
		$stmt->fetch();
		$stmt->close();

		if(!empty($score_value))
		{
			//$scoreValue=mysql_result($result2,0,"value");
			$scoreValue=$score_value;
			//file_put_contents("score.txt",$scoreValue."--".$trackedData[value]);
			if($scoreValue > $trackedData[value])
			{
				//do nothing
			}
			else
			{
				$query="update tls_scorm_sco_tracking set value='".$trackedData[value]."',timemodified=".$trackedData[timemodified]." where userid=? AND scormid=? AND scoid=? AND element='".$trackedData[element]."'";
				$stmt = $con->prepare($query);
				$stmt->bind_param("sss",$trackedData[userid],$trackedData[scormid],$trackedData[scoid]);
				$stmt->execute();
				$stmt->close();
				//$sql="update tls_scorm_sco_tracking set value='".$trackedData[value]."',timemodified=".$trackedData[timemodified]." where userid=".$trackedData[userid]." AND scormid=".$trackedData[scormid]." AND scoid=".$trackedData[scoid]." AND element='".$trackedData[element]."'";
				//mysql_query($sql);
			}
		}
		
}

else
{
	
		$query="update tls_scorm_sco_tracking set value='".$trackedData[value]."',timemodified=".$trackedData[timemodified]." where userid=? AND scormid=? AND scoid=? AND element='".$trackedData[element]."'";
		$stmt = $con->prepare($query);
		$stmt->bind_param("sss",$trackedData[userid],$trackedData[scormid],$trackedData[scoid]);
		$stmt->execute();
		$stmt->close();
	//file_put_contents("tracking.txt",$trackedData[element]."-".$trackedData[value]."\n",FILE_APPEND);
	//$sql="update tls_scorm_sco_tracking set value='".$trackedData[value]."',timemodified=".$trackedData[timemodified]." where userid=".$trackedData[userid]." AND scormid=".$trackedData[scormid]." AND scoid=".$trackedData[scoid]." AND element='".$trackedData[element]."'";
    //mysql_query($sql);


}




if($trackedData['element']=="cmi.core.lesson_status")
	{
		if(strtolower($trackedData['value'])=="completed" || strtolower($trackedData['value'])=="passed")
		{
			$userid=$trackedData['userid'];
			$scoid=$trackedData['scoid'];
			$compdate=Date("Y-m-d");
			
			$stmt = $con->prepare("SELECT id FROM tbl_sco_completion where userid=? and scoid=?");
			$stmt->bind_param("ii",$userid,$scoid);
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->close();
			//$result = mysql_query ("SELECT * FROM tbl_sco_completion where userid='$userid' and scoid='$scoid'"); 
			//$num=mysql_numrows($result);
			if(empty($id))
			{
				
				$query="insert into tbl_sco_completion (userid,scoid,comp_date) VALUES (?,?,?)";
				$stmt->bind_param("sss",$userid,$scoid,$compdate);
				$stmt = $con->prepare($query);
				$stmt->execute();
				$stmt->close();
				//$sql2="insert into tbl_sco_completion (userid,scoid,comp_date) VALUES ('$userid','$scoid','$compdate')";
				//mysql_query($sql2);
			}
			else
			{
				$query="update tbl_sco_completion set comp_date=? where userid=? and scoid=?";
				$stmt->bind_param("sss",$compdate,$userid,$scoid);
				$stmt = $con->prepare($query);
				$stmt->execute();
				$stmt->close();
				//$sql2="update tbl_sco_completion set comp_date='$compdate' where userid='$userid' and scoid='$scoid'"; 
				//mysql_query($sql2);
			}
		}
	}
	updateStatus($trackedData['userid'],$trackedData['scormid'],$trackedData['scoid']);
}

function updateStatus($vuserid,$vscormid,$vscoid)
{
			//$result = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where userid='$vuserid' and scormid='$vscormid' and scoid='$vscoid' AND element='cmi.core.score.raw'"); 
			//$num=mysql_numrows($result);
			global $con;
			$stmt = $con->prepare("SELECT id,value FROM tls_scorm_sco_tracking where userid='$vuserid' and scormid='$vscormid' and scoid='$vscoid' AND element='cmi.core.score.raw'");
			$stmt->bind_param("iii",$vuserid,$vscormid,$vscoid);
			$stmt->execute();
			$stmt->bind_result($id,$value);
			$stmt->fetch();
			$stmt->close();

			if(empty($id))
			{
				$uScoreValue=$value;
				if($uScoreValue >= 80)
				{

					//$sql="update tls_scorm_sco_tracking set value='completed' where userid='$vuserid' AND scormid='$vscormid' AND scoid='$vscoid' AND element='cmi.core.lesson_status'";
					//mysql_query($sql);

					$query="update tls_scorm_sco_tracking set value='completed' where userid=? AND scormid=? AND scoid=? AND element='cmi.core.lesson_status'";
					$stmt->bind_param("iii",$vuserid,$vscormid,$vscoid);
					$stmt = $con->prepare($query);
					$stmt->execute();
					$stmt->close();


					//$result2 = mysql_query ("SELECT * FROM tbl_sco_completion where userid='$vuserid' and scoid='$vscoid'"); 
					//$num2=mysql_numrows($result2);
					$stmt = $con->prepare("SELECT id FROM tbl_sco_completion where userid=? and scoid=?");
					$stmt->bind_param("ss",$vuserid,$vscoid);
					$stmt->execute();
					$stmt->bind_result($id2);
					$stmt->fetch();
					$stmt->close();
					
					$compdate=Date("Y-m-d");
					if(empty($id2))
					{
						
						$query="insert into tbl_sco_completion (userid,scoid,comp_date) VALUES (?,?,?)";
						$stmt->bind_param("iis",$vuserid,$vscoid,$compdate);
						$stmt = $con->prepare($query);
						$stmt->execute();
						$stmt->close();

						//$sql2="insert into tbl_sco_completion (userid,scoid,comp_date) VALUES ('$vuserid','$vscoid','$compdate')";
						//mysql_query($sql2);
					}
					else
					{
						
						$query="update tbl_sco_completion set comp_date=? where userid=? and scoid=?";
						$stmt->bind_param("sii",$compdate,$vuserid,$vscoid);
						$stmt = $con->prepare($query);
						$stmt->execute();
						$stmt->close();

						//$sql2="update tbl_sco_completion set comp_date='$compdate' where userid='$vuserid' and scoid='$vscoid'"; 
						//mysql_query($sql2);
					}
				}
			}
			
}

function scorm_external_link($link) {
// check if a link is external
    $result = false;
    $link = strtolower($link);
    if (substr($link,0,7) == 'http://') {
        $result = true;
    } else if (substr($link,0,8) == 'https://') {
        $result = true;
    } else if (substr($link,0,4) == 'www.') {
        $result = true;
    }
    return $result;
}


/**
 * Add quotes to HTML characters
 *
 * Prints $var with HTML characters (like "<", ">", etc.) properly quoted.
 * This function is very similar to {@link s()}
 *
 * @param string $var the string potentially containing HTML characters
 * @return string
 */
function p($var) {
    echo s($var);
}

/**
 * Add quotes to HTML characters
 *
 * Returns $var with HTML characters (like "<", ">", etc.) properly quoted.
 * This function is very similar to {@link p()}
 *
 * @param string $var the string potentially containing HTML characters
 * @return string
 */
function s($var) {
    if ($var == '0') {  // for integer 0, boolean false, string '0'
        return '0';
    }
    return preg_replace("/&amp;(#\d+);/i", "&$1;", htmlspecialchars(stripslashes_safe($var)));
}

/**
 * Moodle replacement for php stripslashes() function
 *
 * The standard php stripslashes() removes ALL backslashes
 * even from strings - so  C:\temp becomes C:temp - this isn't good.
 * This function should work as a fairly safe replacement
 * to be called on quoted AND unquoted strings (to be sure)
 *
 * @param string the string to remove unsafe slashes from
 * @return string
 */
function stripslashes_safe($string) {

    $string = str_replace("\\'", "'", $string);
    $string = str_replace('\\"', '"', $string);
    $string = str_replace('\\\\', '\\', $string);
    return $string;
}
?>