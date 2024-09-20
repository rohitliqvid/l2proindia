<?php
    session_start();
	require_once('../../connect.php');

    require_once('locallib.php');

    $command = $_REQUEST['command'];
    $sessionid = $_REQUEST['session_id'];
    $aiccdata = $_REQUEST['aicc_data'];
	$mystr=explode("^",$sessionid);
	$uid=$mystr[1];
	$scoid=$mystr[2];
	$userid=$mystr[1];
	$userfullname=getFullName($uid);


$masteryScore=get_masteryScore($scoid);

function get_masteryScore($scoid)
{
$sql="select masteryscore from tls_scorm_sco where id=".$scoid;
$record = mysql_query ($sql); 
$masteryscore=mysql_result($record,0,"masteryscore");
return $masteryscore;
}

function get_user_row_id($uid)
{
$sql="select id from tbl_users where username='".$uid."'";
$record = mysql_query ($sql); 
$userid=mysql_result($record,0,"id");
return $userid;
}

function getFullName($uid)
{
$result = mysql_query ("SELECT * FROM tbl_users where id='$uid'"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$fnm=mysql_result($result,0,"firstname");
$lnm=mysql_result($result,0,"lastname");
$fullname=ucfirst($fnm)." ".ucfirst($lnm);
return $fullname;
}

function get_record($table, $field1, $value1, $field2='', $value2='', $field3='', $value3='', $fields='*') {

    $select = where_clause($field1, $value1, $field2, $value2, $field3, $value3);
    $query = 'SELECT '.$fields.' FROM '. $table .' '. $select;
	$record = mysql_query ($query); 
    return $record;
}

function where_clause($field1='', $value1='', $field2='', $value2='', $field3='', $value3='') {
    if ($field1) {
        $select = is_null($value1) ? "WHERE $field1 IS NULL" : "WHERE $field1 = '$value1'";
        if ($field2) {
            $select .= is_null($value2) ? " AND $field2 IS NULL" : " AND $field2 = '$value2'";
            if ($field3) {
                $select .= is_null($value3) ? " AND $field3 IS NULL" : " AND $field3 = '$value3'";
            }
        }
    } else {
        $select = '';
    }
    return $select;
}

function get_records_select($table, $select='', $sort='', $fields='*', $limitfrom='', $limitnum='') {
    //$rs = get_recordset_select($table, $select, $sort, $fields, $limitfrom, $limitnum);
	if ($select) {
        $select = ' WHERE '. $select;
    }

    if ($sort) {
        $sort = ' ORDER BY '. $sort;
    }
	$query = 'SELECT '.$fields.' FROM '. $table .' '. $select. $sort;
	//echo "QUERY ::: ".$query;

	$rs = mysql_query ($query); 
	$num=mysql_numrows($rs);
	if($num)
	{
    return recordset_to_array($rs);
	}
}

function rs_EOF($rs) {
    if (!$rs) {
        //debugging('Incorrect $rs used!', DEBUG_DEVELOPER);
        return true;
    }
    return $rs->EOF;
}

function recordset_to_array($rs) {
    global $CFG;

   // $debugging = debugging('', DEBUG_DEVELOPER);
//echo "RS :".$rs."<br>";
    if ($rs && !rs_EOF($rs)) {
        $objects = array();
    /// First of all, we are going to get the name of the first column
    /// to introduce it back after transforming the recordset to assoc array
    /// See http://docs.moodle.org/en/XMLDB_Problems, fetch mode problem.
        $firstcolumn = $rs->FetchField(0);
		
    /// Get the whole associative array
        if ($records = $rs->GetAssoc(true)) {
            foreach ($records as $key => $record) {
            /// Really DIRTY HACK for Oracle, but it's the only way to make it work
            /// until we got all those NOT NULL DEFAULT '' out from Moodle
                if ($CFG->dbfamily == 'oracle') {
                    array_walk($record, 'onespace2empty');
                }
            /// End of DIRTY HACK
                $record[$firstcolumn->name] = $key;/// Re-add the assoc field
                if ($debugging && array_key_exists($key, $objects)) {
                    //debugging("Did you remember to make the first column something unique in your call to get_records? Duplicate value '$key' found in column '".$firstcolumn->name."'.", DEBUG_DEVELOPER);
                }
                $objects[$key] = (object) $record; /// To object
            }
            return $objects;
    /// Fallback in case we only have 1 field in the recordset. MDL-5877
        } else if ($rs->_numOfFields == 1 && $records = $rs->GetRows()) {
            foreach ($records as $key => $record) {
            /// Really DIRTY HACK for Oracle, but it's the only way to make it work
            /// until we got all those NOT NULL DEFAULT '' out from Moodle
                if ($CFG->dbfamily == 'oracle') {
                    array_walk($record, 'onespace2empty');
                }
            /// End of DIRTY HACK
                if ($debugging && array_key_exists($record[$firstcolumn->name], $objects)) {
                   // debugging("Did you remember to make the first column something unique in your call to get_records? Duplicate value '".$record[$firstcolumn->name]."' found in column '".$firstcolumn->name."'.", DEBUG_DEVELOPER);
                }
                $objects[$record[$firstcolumn->name]] = (object) $record; /// The key is the first column value (like Assoc)
            }
            return $objects;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function scorm_add_time($a, $b) {
    $aes = explode(':',$a);
    $bes = explode(':',$b);
    $aseconds = explode('.',$aes[2]);
    $bseconds = explode('.',$bes[2]);
    $change = 0;

    $acents = 0;  //Cents
    if (count($aseconds) > 1) {
        $acents = $aseconds[1];
    }
    $bcents = 0;
    if (count($bseconds) > 1) {
        $bcents = $bseconds[1];
    }
    $cents = $acents + $bcents;
    $change = floor($cents / 100);
    $cents = $cents - ($change * 100);
    if (floor($cents) < 10) {
        $cents = '0'. $cents;
    }

    $secs = $aseconds[0] + $bseconds[0] + $change;  //Seconds
    $change = floor($secs / 60);
    $secs = $secs - ($change * 60);
    if (floor($secs) < 10) {
        $secs = '0'. $secs;
    }

    $mins = $aes[1] + $bes[1] + $change;   //Minutes
    $change = floor($mins / 60);
    $mins = $mins - ($change * 60);
    if ($mins < 10) {
        $mins = '0' .  $mins;
    }

    $hours = $aes[0] + $bes[0] + $change;  //Hours
    if ($hours < 10) {
        $hours = '0' . $hours;
    }

    if ($cents != '0') {
        return $hours . ":" . $mins . ":" . $secs . '.' . $cents;
    } else {
        return $hours . ":" . $mins . ":" . $secs;
    }
}


   // require_login();
      if (!empty($command)) {
        $command = strtolower($command);
       
        if (isset($scoid)) {
            $scoid = $scoid;
        } else {
            //error('Invalid script call');
        }
		$scoid=$scoid;
        $mode = 'normal';
        if (isset($userdata['mode'])) {
            $mode = $userdata['mode'];
        }
        
	    if (isset($_SESSION['crsStatus'])) {
			$status = $_SESSION['crsStatus'];
        }
		else
		  {
			$status = 'Running';
		}
			//echo "ON LOAD STATUS : ".$status."<br>";
            $attempt = 1;
      

        /*if ($sco = scorm_get_sco($scoid, SCO_ONLY)) {
            if (!$scorm = get_record('scorm','id',$sco->scorm)) {
                error('Invalid script call');
            }
        } else {
            error('Invalid script call');
        }*/

        if ($scorm = get_record('tls_scorm','id',$scoid)) {
            switch ($command) {
                case 'getparam':
					
                    if ($status == 'Not Initialized') {
                        $SESSION->scorm_status = 'Running';
                        $status = 'Running';
                    }
                    if ($status != 'Running') {
                        echo "error = 101\nerror_text = Terminated\n";
                    } else {
                        if ($usertrack=scorm_get_tracks($scoid,$userid,$attempt)) {
                            $userdata = $usertrack;
                        } else {
                            $userdata->status = '';
                            $userdata->score_raw = '';
                        }
                        $userdata->student_id = $uid;
                        $userdata->student_name = $userfullname;
                        $userdata->mode = $mode;
                        if ($userdata->mode == 'normal') {
                            $userdata->credit = 'credit';
                        } else {
                            $userdata->credit = 'no-credit';
                        } 
                
                        if ($sco = scorm_get_sco($scoid)) {
                            $userdata->course_id = $sco->identifier;
                            $userdata->datafromlms = isset($sco->datafromlms)?$sco->datafromlms:'';
                            $userdata->masteryscore = isset($sco->masteryscore)?$sco->masteryscore:'';
                            $userdata->maxtimeallowed = isset($sco->maxtimeallowed)?$sco->maxtimeallowed:'';
                            $userdata->timelimitaction = isset($sco->timelimitaction)?$sco->timelimitaction:'';
                               
                            echo "error = 0\nerror_text = Successful\naicc_data=\n";
                            echo "[Core]\n";
                            echo 'Student_ID = '.$uid."\n";
                            echo 'Student_Name = '.$userfullname."\n";
                            if (isset($userdata->{'cmi.core.lesson_location'})) {
                                echo 'Lesson_Location = '.$userdata->{'cmi.core.lesson_location'}."\n";
                            } else {
                                echo 'Lesson_Location = '."\n";
                            }
                            echo 'Credit = '.$userdata->credit."\n";
                            if (isset($userdata->status)) {
                                if ($userdata->status == '') {
                                    $userdata->entry = ', ab-initio';
                                } else {
                                    if (isset($userdata->{'cmi.core.exit'}) && ($userdata->{'cmi.core.exit'} == 'suspend')) {
                                        $userdata->entry = ', resume';
                                    } else {
                                        $userdata->entry = '';
                                    }
                                }
                            }
                            if (isset($userdata->{'cmi.core.lesson_status'})) {
                                echo 'Lesson_Status = '.$userdata->{'cmi.core.lesson_status'}.$userdata->entry."\n";
                                $SESSION->scorm_lessonstatus = $userdata->{'cmi.core.lesson_status'};
                            } else {
                                echo 'Lesson_Status = not attempted'.$userdata->entry."\n";
                                $SESSION->scorm_lessonstatus = 'not attempted';
                            }
                            if (isset($userdata->{'cmi.core.score.raw'})) {
                                $max = '';
                                $min = '';
                                if (isset($userdata->{'cmi.core.score.max'}) && !empty($userdata->{'cmi.core.score.max'})) {
                                    $max = ', '.$userdata->{'cmi.core.score.max'};
                                    if (isset($userdata->{'cmi.core.score.min'}) && !empty($userdata->{'cmi.core.score.min'})) {
                                        $min = ', '.$userdata->{'cmi.core.score.min'};
                                    }
                                }
                                echo 'Score = '.$userdata->{'cmi.core.score.raw'}.$max.$min."\n";
                            } else {
                                echo 'Score = '."\n";
                            }
                            if (isset($userdata->{'cmi.core.total_time'})) {
                                echo 'Time = '.$userdata->{'cmi.core.total_time'}."\n";
                            } else {
                                echo 'Time = '.'00:00:00'."\n";
                            }
                            echo 'Lesson_Mode = '.$userdata->mode."\n";
                            if (isset($userdata->{'cmi.suspend_data'})) {
                                echo "[Core_Lesson]\n".$userdata->{'cmi.suspend_data'}."\n";
                            } else {
                                echo "[Core_Lesson]\n"."\n";
                            }
                            echo "[Core_Vendor]\n".$userdata->datafromlms."\n";
                            echo "[Evaluation]\nCourse_ID = {".$userdata->course_id."}\n";
                            echo "[Student_Data]\n";
                            echo 'Mastery_Score = '.$userdata->masteryscore."\n";
                            echo 'Max_Time_Allowed = '.$userdata->maxtimeallowed."\n";
                            echo 'Time_Limit_Action = '.$userdata->timelimitaction."\n";
							$_SESSION['crsStatus']='Running';
							} else {
                            echo 'Sco not found';
                        }
                    }
                break;
                case 'putparam':
                    if ($status == 'Running') {
                        
						/*if (! $cm = get_coursemodule_from_instance("scorm", $scorm->id, $scorm->course)) {
                            echo "error = 1\nerror_text = Unknown\n"; // No one must see this error message if not hacked
                        }*/
                       // if (!empty($aiccdata) && has_capability('mod/scorm:savetrack', get_context_instance(CONTEXT_MODULE, $cm->id))) {
						   // echo "$aiccdata : ".$aiccdata;
							if (!empty($aiccdata)) {
                            $initlessonstatus = 'not attempted';
                            $lessonstatus = 'not attempted';
                            if (isset($SESSION->scorm_lessonstatus)) {
                                $initlessonstatus = $SESSION->scorm_lessonstatus;
                            }
                            $score = '';
                            $datamodel['lesson_location'] = 'cmi.core.lesson_location';
                            $datamodel['lesson_status'] = 'cmi.core.lesson_status';
                            $datamodel['score'] = 'cmi.core.score.raw';
                            $datamodel['time'] = 'cmi.core.session_time';
                            $datamodel['[core_lesson]'] = 'cmi.suspend_data';
                            $datamodel['[comments]'] = 'cmi.comments';
                            $datarows = explode("\n",$aiccdata);
                            reset($datarows);
                            while ((list(,$datarow) = each($datarows)) !== false) {
                                if (($equal = strpos($datarow, '=')) !== false) {
                                    $element = strtolower(trim(substr($datarow,0,$equal)));
                                    $value = trim(substr($datarow,$equal+1));
                                    if (isset($datamodel[$element])) {
                                        $element = $datamodel[$element];
                                        switch ($element) {
                                            case 'cmi.core.lesson_location':
                                                $id = scorm_insert_track($userid, $scoid, $scoid, $element, $value);
                                            break;
                                            case 'cmi.core.lesson_status':
                                                $statuses = array(
                                                           'passed' => 'passed',
                                                           'completed' => 'completed',
                                                           'failed' => 'failed',
                                                           'incomplete' => 'incomplete',
                                                           'browsed' => 'browsed',
                                                           'not attempted' => 'not attempted',
                                                           'p' => 'passed',
                                                           'c' => 'completed',
                                                           'f' => 'failed',
                                                           'i' => 'incomplete',
                                                           'b' => 'browsed',
                                                           'n' => 'not attempted'
                                                           );
                                                $exites = array(
                                                           'logout' => 'logout',
                                                           'time-out' => 'time-out',
                                                           'suspend' => 'suspend',
                                                           'l' => 'logout',
                                                           't' => 'time-out',
                                                           's' => 'suspend',
                                                           );
                                                $values = explode(',',$value);
                                                $value = '';
                                                if (count($values) > 1) {
                                                    $value = trim(strtolower($values[1]));
                                                    if (isset($exites[$value])) {
                                                        $value = $exites[$value];
                                                    }
                                                }
                                                if (empty($value) || isset($exites[$value])) {
                                                    $subelement = 'cmi.core.exit';
                                                    $id = scorm_insert_track($userid, $scoid, $scoid, $element, $value);
                                                }
                                                $value = trim(strtolower($values[0]));
                                                if (isset($statuses[$value]) && ($mode == 'normal')) {
                                                    $value = $statuses[$value];
                                                    $id = scorm_insert_track($userid, $scoid, $scoid, $element, $value);
                                                }
                                                $lessonstatus = $value;
                                            break;
                                            case 'cmi.core.score.raw':
                                                 $values = explode(',',$value);
                                                 if ((count($values) > 1) && ($values[1] >= $values[0]) && is_numeric($values[1])) {
                                                     $subelement = 'cmi.core.score.max';
                                                     $value = trim($values[1]);
                                                     $id = scorm_insert_track($userid, $scoid, $scoid, $subelement, $value);
                                                     if ((count($values) == 3) && ($values[2] <= $values[0]) && is_numeric($values[2])) {
                                                         $subelement = 'cmi.core.score.min';
                                                         $value = trim($values[2]);
                                                         $id = scorm_insert_track($userid, $scoid, $scoid, $subelement, $value);
                                                     }
                                                 }
                                              
                                                 $value = '';
                                                 if (is_numeric($values[0])) {
                                                     $value = trim($values[0]);
                                                     $id = scorm_insert_track($userid, $scoid, $scoid, $element, $value);
                                                 }
                                                 $score = $value;
                                            break;
                                            case 'cmi.core.session_time':
                                                 $SESSION->scorm_session_time = $value;
												 $id = scorm_insert_track($userid, $scoid, $scoid, $element, $value);
												  $query = "SELECT * from tls_scorm_sco_tracking where userid=$userid AND scormid=$scoid AND scoid=$scoid AND element='cmi.core.total_time'";
												   $resultSet = mysql_query ($query); 
												   $num=mysql_numrows($resultSet);

													if ($num) {
														// Add session_time to total_time
														$currentValue=mysql_result($resultSet,0,"value");
														$value = scorm_add_time($currentValue, $SESSION->scorm_session_time);
													   // $track->value = $value;
													   // $track->timemodified = time();
													  
														$curTime=time();
														//update_record('scorm_scoes_track',$track);
														$query = "update tls_scorm_sco_tracking set value='$value',timemodified='$curTime' where userid=$userid AND scormid=$scoid AND scoid=$scoid AND element='cmi.core.total_time'";
														 $resultSet = mysql_query ($query); 
														//$id = $track->id;


													} else {
														//$track = new object();
														$track->userid = $userid;
														$track->scormid = $scoid;
														$track->scoid = $scoid;
														$track->element = 'cmi.core.total_time';
														$track->value = $SESSION->scorm_session_time;
														$curValue=$SESSION->scorm_session_time;
														$track->timemodified = time();
														$id = scorm_insert_track($userid, $scoid, $scoid, 'cmi.core.total_time', $curValue);
														//$id = insert_record('scorm_scoes_track',$track);
													}
                                            break;
                                        }
                                    }
                                } else {
                                    if (isset($datamodel[strtolower(trim($datarow))])) {
                                        $element = $datamodel[strtolower(trim($datarow))];
                                        $value = '';
                                        while ((($datarow = current($datarows)) !== false) && (substr($datarow,0,1) != '[')) {
                                            $value .= $datarow;
                                            next($datarows);
                                        }
                                        $id = scorm_insert_track($userid, $scoid, $scoid, $element, $value);
                                    }
                                }                               
                            }
                            if (($mode == 'browse') && ($initlessonstatus == 'not attempted')){
                                $lessonstatus = 'browsed';
                                $id = scorm_insert_track($userid, $scoid, $scoid, 'cmi.core.lesson_status', 'browsed');
                            }
                            if ($mode == 'normal') {
								if ($lessonstatus == 'completed') {
                                    //if (!empty($masteryScore) && !empty($score) && ($score >= $masteryScore)) {
                                        $lessonstatus = 'passed';
                                    } else {
                                        $lessonstatus = 'failed';
                                    }
									
                                    $id = scorm_insert_track($userid, $scoid, $scoid, 'cmi.core.lesson_status', $lessonstatus);
									$compdate=Date("Y-m-d");
									$result = mysql_query ("SELECT * FROM tbl_sco_completion where userid='$userid' and scoid='$scoid'"); 
									$num=mysql_numrows($result);
									if($num==0)
									{
										
										$sql2="insert into tbl_sco_completion (userid,scoid,comp_date) VALUES ('$userid','$scoid','$compdate')";
										mysql_query($sql2);
									}
									else
									{
										$sql2="update tbl_sco_completion set comp_date='$compdate' where userid='$userid' and scoid='$scoid'"; 
										mysql_query($sql2);
									}
                                
								//}
                            }                  
                        }
                        echo "error = 0\nerror_text = Successful\n";
                    } else if ($status == 'Terminated') {
                        echo "error = 1\nerror_text = Terminated\n";
                    } else {
                        echo "error = 1\nerror_text = Not Initialized\n";
                    }
                break;
                case 'putcomments':
                    if ($status == 'Running') {
                        echo "error = 0\nerror_text = Successful\n";
                    } else if ($status == 'Terminated') {
                        echo "error = 1\nerror_text = Terminated\n";
                    } else {
                        echo "error = 1\nerror_text = Not Initialized\n";
                    }
                break;
                case 'putinteractions':
                    if ($status == 'Running') {
                        echo "error = 0\nerror_text = Successful\n";
                    } else if ($status == 'Terminated') {
                        echo "error = 1\nerror_text = Terminated\n";
                    } else {
                        echo "error = 1\nerror_text = Not Initialized\n";
                    }
                break;
                case 'putobjectives':
                    if ($status == 'Running') {
                        echo "error = 0\nerror_text = Successful\n";
                    } else if ($status == 'Terminated') {
                        echo "error = 1\nerror_text = Terminated\n";
                    } else {
                        echo "error = 1\nerror_text = Not Initialized\n";
                    }
                break;
                case 'putpath':
                    if ($status == 'Running') {
                        echo "error = 0\nerror_text = Successful\n";
                    } else if ($status == 'Terminated') {
                        echo "error = 1\nerror_text = Terminated\n";
                    } else {
                        echo "error = 1\nerror_text = Not Initialized\n";
                    }
                break;
                case 'putperformance':
                    if ($status == 'Running') {
                        echo "error = 0\nerror_text = Successful\n";
                    } else if ($status == 'Terminated') {
                        echo "error = 1\nerror_text = Terminated\n";
                    } else {
                        echo "error = 1\nerror_text = Not Initialized\n";
                    }
                break;
                case 'exitau':
					
                    if ($status == 'Running') {
					
                        if (isset($SESSION->scorm_session_time) && ($SESSION->scorm_session_time != '')) {
						   $query = "SELECT * from tls_scorm_sco_tracking where userid=$userid AND scormid=$scoid AND scoid=$scoid AND element='cmi.core.total_time'";
						   $resultSet = mysql_query ($query); 
						   $num=mysql_numrows($resultSet);

							if ($num) {
                                // Add session_time to total_time
								$currentValue=mysql_result($resultSet,0,"value");
                                $value = scorm_add_time($currentValue, $SESSION->scorm_session_time);
                               // $track->value = $value;
                               // $track->timemodified = time();
							  
								$curTime=time();
                                //update_record('scorm_scoes_track',$track);
								$query = "update tls_scorm_sco_tracking set value='$value',timemodified='$curTime' where userid=$userid AND scormid=$scoid AND scoid=$scoid AND element='cmi.core.total_time'";
								 $resultSet = mysql_query ($query); 
                                //$id = $track->id;


                            } else {
                                $track = new object();
                                $track->userid = $userid;
                                $track->scormid = $scoid;
                                $track->scoid = $scoid;
                                $track->element = 'cmi.core.total_time';
                                $track->value = $SESSION->scorm_session_time;
								$curValue=$SESSION->scorm_session_time;
                                $track->timemodified = time();
                                $id = scorm_insert_track($userid, $scoid, $scoid, 'cmi.core.total_time', $curValue);
								//$id = insert_record('scorm_scoes_track',$track);
                            }
                           ///// scorm_update_grades($scorm, $USER->id);
                        }
                        
                        $SESSION->scorm_status = 'Terminated';
                        $SESSION->scorm_session_time = '';
                        echo "error = 0\nerror_text = Successful\n";
                    } else if ($status == 'Terminated') {
                        echo "error = 1\nerror_text = Terminated\n";
                    } else {
                        echo "error = 1\nerror_text = Not Initialized\n";
                    }
                break;
                default:
                    echo "error = 1\nerror_text = Invalid Command\n";
                break;
            }
        }
    } else {
        if (empty($command)) {
            echo "error = 1\nerror_text = Invalid Command\n";
        } else {
            echo "error = 3\nerror_text = Invalid Session ID\n";
        }
    }
?>
