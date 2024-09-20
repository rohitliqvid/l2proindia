<?php
function getTimeWithInterval($interval)
{
    $date = new DateTime();
    $dateInterval = new DateInterval($interval);
    $date->add($dateInterval);
    
    return $date->format('Y-m-d H:i:s');
}

/*function mb_chr($char) {
        return mb_convert_encoding('&#'.intval($char).';', 'UTF-8', 'HTML-ENTITIES');
}*/

/**function mb_ord($char) {
        $result = unpack('N', mb_convert_encoding($char, 'UCS-4BE', 'UTF-8'));

        if (is_array($result) === true) {
                return $result[1];
        }
        return ord($char);
}**/

function rc4($key, $str) {
    if (extension_loaded('mbstring') === true) {
        mb_language('Neutral');
        mb_internal_encoding('UTF-8');
        mb_detect_order(array('UTF-8', 'ISO-8859-15', 'ISO-8859-1', 'ASCII'));
    }
    
    $s = array();
    for ($i = 0; $i < 256; $i++) {
        $s[$i] = $i;
    }
    $j = 0;
    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $s[$i] + mb_ord(mb_substr($key, $i % mb_strlen($key), 1))) % 256;
        $x = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $x;
    }
    $i = 0;
    $j = 0;
    $res = '';
    for ($y = 0; $y < mb_strlen($str); $y++) {
    $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;
        $x = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $x;
    
        $res .= mb_chr(mb_ord(mb_substr($str, $y, 1)) ^ $s[($s[$i] + $s[$j]) % 256]);
    }
    return $res;
}

function decrypt($encryptionType,$str) {
    if("$encryptionType" == "2") {
        $cmd  = "java -jar ./caped.jar -d -l ".escapeshellarg($str);
        $retval =`$cmd`;
       return $retval;
    }
}

function encrypt($encryptionType,$str) {
    if("$encryptionType" == "2") {
        $cmd  = "java -jar ./caped.jar -e -l ".escapeshellarg($str);
        $retval =`$cmd`;
       return $retval;
    }
}
class ServiceResponse {
    function ServiceResponse($code,$val,$rtval) {
        $this->retCode= $code;
        $this->retStat = $val;
        $this->retVal = $rtval;
    }
    function setCode($code) { $this->retCode = $code; }
    function setStat($code) { $this->retStat = $code; }
    function setVal($code) { $this->retVal = $code; }
}

class ClassDetails {
    function ClassDetails($class_id) {
        $this->event_id = (string)$class_id;
    }
	function setProviderId($provider_id) {
        $this->provider_id = $provider_id;
    }
    function setTitle($title) {
        $this->event_title = $title;
    }
    function setDescription($desc) {
        $this->event_description = $desc;
    }
    function setTeacherName($tname) {
        $this->teacher_name = $tname;
    }
	 function setTeacherImage($iname) {
        $this->teacher_image = $iname;
    }
	function setStartDate($sdate) {
        $this->start_date = $sdate;
    }
    function setStartTime($stime) {
        $this->start_time = $stime;
    }
    function setDuration($dur) {
        $this->event_duration = (string)$dur;
    }
    function setBooked($stat) {
        $this->is_booked = $stat;
    }
	function setCourseId($crs) {
        $this->course_id = (string)$crs;
    }
	function setTopicId($topic) {
        $this->topic_id = (string)$topic;
    }
	function setChapterId($chap) {
        $this->chapter_id = (string)$chap;
    }
	function setActivityId($acv) {
        $this->activity_id = (string)$acv;
    }
    function setMaxSeats($mxs) {
        $this->max_seat = (string)$mxs;
    }
    function setAvailSeats($avs) {
        $this->avail_seat = (string)$avs;
    }
	function setBookingAvailable($isAvl) {
        $this->is_booking_available = $isAvl;
    }
	function setIsRecorded($isRec) {
        $this->is_recorded = $isRec;
    }
    function setRecordingUrl($url) {
        $this->recording_url = (string)$url;
    }
	function setURL($url) {
        $this->event_url = (string)$url;
    }
	//setURL($bookurl);
}
/*
class ClassDetailsNotifications {
    function ClassDetailsNotifications($class_id) {
        $this->event_id = (string)$class_id;
    }
	function setProviderId($provider_id) {
        $this->provider_id = $provider_id;
    }
    function setTitle($title) {
        $this->event_title = $title;
    }
    function setDescription($desc) {
        $this->event_description = $desc;
    }
    function setTeacherName($tname) {
        $this->teacher_name = $tname;
    }
	 function setTeacherImage($iname) {
        $this->teacher_image = $iname;
    }
	function setStartDate($sdate) {
        $this->start_date = $sdate;
    }
    function setStartTime($stime) {
        $this->start_time = $stime;
    }
    function setDuration($dur) {
        $this->event_duration = (string)$dur;
    }
    function setBooked($stat) {
        $this->is_booked = $stat;
    }
	function setCourseId($crs) {
        $this->course_id = (string)$crs;
    }
	function setTopicId($topic) {
        $this->topic_id = (string)$topic;
    }
	function setChapterId($chap) {
        $this->chapter_id = (string)$chap;
    }
	function setActivityId($acv) {
        $this->activity_id = (string)$acv;
    }
    function setMaxSeats($mxs) {
        $this->max_seat = (string)$mxs;
    }
    function setAvailSeats($avs) {
        $this->avail_seat = (string)$avs;
    }
	function setBookingAvailable($isAvl) {
        $this->is_booking_available = $isAvl;
    }
	function setIsRecorded($isRec) {
        $this->is_recorded = $isRec;
    }
    function setRecordingUrl($url) {
        $this->recording_url = (string)$url;
    }
	function setURL($url) {
        $this->event_url = (string)$url;
    }
	//setURL($bookurl);
}
*/


class ClassListResponseParam {
    function appendToList($cl) {
        if($this->classList ==null)
            $this->classList = array();
        array_push($this->classList, $cl);
    }
}

class AveragIrObject {
    function getModuleId() { return $this->moduleId; }
    function getAverageIr() { return $this->averageIr; }
}

class FetchTrackingObject {
    function getModuleId() { return $this->edge_id; }
    function getStartDateMs() { return $this->start_date_ms; }
    function getEndDateMs() { return $this->end_date_ms;}
}
    
class LiveClassObject {
//	echo "-->".$this->user_state;exit;
    function getUserState() { return $this->user_state; }
    function getClasses() { return $this->classes; }
    function getRecordingUrl() { return $this->recording_url;} 
}
function getCurl($url, $dataArray) {
        $fields_string = '';
        foreach($dataArray as $key=>$value){
            $fields_string[]=$key.'='.urlencode($value);
        }
        $urlStringData = $url.'?'.implode('&',$fields_string);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10); # timeout after 10 seconds, you can increase it
        curl_setopt($ch, CURLOPT_URL, $urlStringData ); #set the url and get string together

        $return = curl_exec($ch);
        curl_close($ch);

        return $return;
    }

class BasicObject {
    function BasicObject($token,$decree,$param, $is_verbose=0) {
        $this->token = $token;
        $this->decree = $decree;
        $this->param = $param;
        $this->is_verbose = $is_verbose;
	$this->url = "http://mobile.englishedge.in/emp/live/service.php";
        //error_log($this->is_verbose . "is verbose");
    }
    function setUrl($u) { $this->url = $u; }


    function toJSON() {
        return json_encode($this);
    }

    function printOnly() {
        $str = $this->toJSON();
        $estr = rc4("p1^bil",$str);
        print "$str\n\n\n";
        print "$estr";
    }
    function sendToServer() {
        $str = $this->toJSON();
        if($this->is_verbose);
        print "Sending : $str\n";
        $estr = rc4("p1^bil",$str);
        #$estr = $str;
        $response_enc = getCurl($this->url,array("obj"=>$estr));
        #print "Enc Recieved : $response_enc\n";
        $response = rc4("p1^bil",$response_enc);
        #$response = $response_enc ;
        if($this->is_verbose);
        print "Recieved : $response\n";
        #print "Enc Recieved : $response_enc\n";
        $obj = json_decode($response);
        return $obj;
    }
}
?>