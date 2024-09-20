<?php
require './util.php';
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
    function BasicObject($token,$decree,$param) {
        $this->token = $token;
        $this->decree = $decree;
        $this->param = $param;
    }

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
        //print "Sending : $str\n";
        $estr = rc4("p1^bil",$str);
        #$estr = $str;
        $response_enc = getCurl("http://dev.englishedge.in/live/service.php",array("obj"=>$estr));
        #print "Enc Recieved : $response_enc\n";
        $response = rc4("p1^bil",$response_enc);
        #$response = $response_enc ;
        //print "Recieved : $response\n";
        #print "Enc Recieved : $response_enc\n";
        $obj = json_decode($response);
        return $obj;
    }
}

class LoginParams {
    function LoginParams($loginid,$password) {
        $this->login = $loginid;
        $this->password = $password;
    }
}
/*
$lgparams= new LoginParams('learner26961','123456');
$bobj = new BasicObject(null,'login',$lgparams);
$res = $bobj->sendToServer();
$token = $res->retVal->token;
print "$token is the token\n";

$classListRequest->topic_ids = array();
array_push($classListRequest->topic_ids, 15938);
array_push($classListRequest->topic_ids, 15938);
$bobj = new BasicObject($token,'lsclass',$classListRequest);
$res2 = $bobj->sendToServer();

//$cobj = new BasicObject($token,'buyclass',8);
//$res2 = $cobj->sendToServer();
//print_r($res2);
*/
?>

