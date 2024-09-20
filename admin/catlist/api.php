<?php
include("lib.php");


$cid=$_REQUEST['id'];
$scoid=$_REQUEST['scoid'];
$mode=$_REQUEST['mode'];
$uid=$_REQUEST['uid'];
//echo "UID: -->".$uid;exit;
//$uid=4;

$userid=get_userid($uid);

$scorm_sco=get_scorm_sco_data($scoid);
$scorm_id=$scorm_sco['scorm'];
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
//$mode='review';
$userid=get_userid($uid);
//echo "UID22: -->".$uid;exit;
$stmt = $con->prepare("SELECT username FROM tbl_users where id=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

///$result1 = mysql_query ("SELECT * FROM tbl_users where id=$userid"); 
//$num1=mysql_numrows($result1);
///$username=mysql_result($result1,0,"username");
//echo "USERNAME :::".$username;
file_put_contents("username.txt",$username);


$scorm=get_scorm_data($scoid);
$scorm_sco_track=get_scorm_sco_track_data($userid,$scoid);
$scormid=$scorm['id'];
 
$userdata=array();

if($mode=='normal' && $usertrack=scorm_get_tracks($scoid,$userid))
{
$userdata = $usertrack;
}
else
{
$userdata['status'] = '';
$userdata['score_raw'] = '';
}

    
    $userdata['student_id'] = $username;
	$userdata['student_name'] = $l_name .', '. $f_name;
    $userdata['mode'] = 'normal';
    if (isset($mode)) {
        $userdata['mode'] = $mode;
    }
    if ($userdata['mode'] == 'normal') {
        $userdata['credit'] = 'credit';
    } else {
        $userdata['credit'] = 'no-credit';
    }    
    if ($scorm_sco=get_scorm_sco_data($scoid)) {
        $userdata['datafromlms'] = $scorm_sco['datafromlms'];
        $userdata['masteryscore'] = $scorm_sco['masteryscore'];
        $userdata['maxtimeallowed'] = $scorm_sco['maxtimeallowed'];
        $userdata['timelimitaction'] = $scorm_sco['timelimitaction'];
    } else {
        //error('Sco not found');
		echo "SCO Not Found";
    }
    switch ($scorm['version']) {
        case 'SCORM_1.2':
     		include_once ('datamodels/scorm1_2.js.php');
        break;
        case 'SCORM_1.3':
            include_once ('datamodels/scorm1_3.js.php');
        break;
        case 'AICC':
		include_once ('datamodels/aicc.js.php');
        break;
        default:
            include_once ('datamodels/scorm1_2.js.php');
        break;
    }
?>

var errorCode = "0";

function underscore(str) {
    return str.replace(/\./g,"__");
}
