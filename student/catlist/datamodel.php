<?php
include("lib.php");
$cid=$_REQUEST['id'];
$sesskey=$_REQUEST['sesskey'];
$scoid=$_REQUEST['scoid'];
$student_id=$_REQUEST['student_id'];


$con=createConnection();

$stmt = $con->prepare("SELECT id FROM tbl_users where username=?");
$stmt->bind_param("s",$student_id);
$stmt->execute();
$stmt->bind_result($userid);
$stmt->fetch();
$stmt->close();

/*$result1 = mysql_query ("SELECT * FROM tbl_users where username='$student_id'"); 
$num1=mysql_numrows($result1);
$userid=mysql_result($result1,0,"id");*/

$updateCount=0;
if(!empty($_REQUEST['cmi__core__session_time']) && $updateCount==0)
{
//file_put_contents('requestdata.txt',$_REQUEST['cmi__core__session_time']."\n",FILE_APPEND);
updateTrackingHistory($userid,$_REQUEST);
$updateCount++;
}
////$userid=get_userid($uid);
////$userid=4;

$scorm_sco=get_scorm_sco_data($scoid);
$scorm_id=$scorm_sco['scorm'];
file_put_contents("scorm_id.txt",$scorm_id);
//$scorm_sco=get_scorm_sco_data($scoid);
//$scorm_sco_track=get_scorm_sco_track_data($userid,$scoid);
$cElement='cmi.core.lesson_status';

$sco_track_completion_data = get_scorm_sco_track_element_data($userid,$scorm_id,$scoid,$cElement);
if($sco_track_completion_data)
{
if($sco_track_completion_data['value']=='incomplete')
{
$mode='normal';
}
else
{
$mode='normal';
}
}
else
{
$mode='normal';
}

/*
$db->query($query);
$db->next_record();
$perms=$db->f("perms");*/
$perms='user';

function confirm_sesskey()
{
if($sesskey==1)
	{
return true;
	}
else
	{
return false;
	}
}

if ($sesskey==1 && $scoid!='') 
	{
       $result = true;
	   foreach ($_REQUEST as $element => $value) 
		   {
           	if (substr($element,0,3) == 'cmi') 
				{
                $element = str_replace('__','.',$element);
                $element = preg_replace('/_(\d+)/',".\$1",$element);
				$sco_track_data = get_scorm_sco_track_element_data($userid,$scorm_id,$scoid,$element);
					if ($sco_track_data)	
					{
                    $sco_track_data['value'] = $value;
					$sco_track_data['timemodified'] = time();
					if($perms!='parent')
					{
					if($mode=='normal')
					{
					$result = update_scorm_sco_track_record($sco_track_data) && $result;
					}
					}
					} 
					else 
					{
					$trackedData=array();
					$trackedData['userid']=$userid;
					$trackedData['scormid']=$scorm_id;
					$trackedData['scoid']=$scoid;
					$trackedData['element']=$element;
					$trackedData['value']=$value;
					$trackedData['timemodified']=time();
					if($perms!='parent')
					{
					if($mode=='normal')
					{
					$result = insert_scorm_sco_track_record($trackedData) && $result;
					}
					}
					}
				}
			}

        if ($result) 
		{
            echo "true\n0";
        } else 
		{
            echo "false\n101";
        }
    }
?>

