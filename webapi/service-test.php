<?php 

header("Access-Control-Allow-Origin: *");
require "./util.php";
require "./decree.php";
error_reporting(E_ALL);

$con = createConnection();

$arr = getAduroStudentDetails($con, 's-272-231');
echo '<pre>';print_r($arr);
die;;

$param  = new stdClass();
$param->login = 's-272-230';
$param->password = '9609359064';
$param->appVersion = '2';
$param->class_name == 'orion';
$arr = decree_login('', $param, array());

echo '<pre>';print_r($arr);
die;


$x = aduroGetChapterJson($con, 'CRS-904',38440);
echo '<pre>';print_r($x);
die;


$objRet = new ServiceResponse("NO_ACTION",0,null);
  
  $str = file_get_contents('php://input');
  $obj = json_decode($str);
  
  echo '<pre>';
  print_r($obj);
  
  if($obj== null) {
        $objRet->setCode("GARBAGE_IN");
    } else {
        /* Get the object parameters */
        error_log("SERVICE CALLED ".$obj->decree."   token ; ".$obj->token);
        $decree = "decree_".$obj->decree;
        $param = $obj->param;
        try {
            $objRet = $decree($obj->token,$param);
        } catch(Exception $e) {
            $objRet->setCode("DECREE_NOT_FOUND($decree) $e");
        }
    }
  
  
  print_r($objRet);
  
  die;
  
  
  
  
  
  /* Step 1 => get the json string */
  $encryptedJson = $_REQUEST['obj'];
  error_log("0. $encryptedJson");
  if(isset($_REQUEST['encType']))
    $encryptionType  = $_REQUEST['encType'];
  
  
  $isenc= false;
  $isBase64 = false;
  if( $encryptedJson === null)
    $encryptedJson = $_REQUEST['obj'];
  
    if(isset($_REQUEST['encType']))
        $encryptionType  = $_REQUEST['encType'];
    
  if($encryptedJson === null) {
    $objRet->setCode("NO_INPUT");
  } else {
    /* decrypt the json */
    if(!isset($encryptionType)) {
        $decryptedJson = rc4("p1^bil",$encryptedJson);
        //error_log("1. $decryptedJson");
    } else {
        $decryptedJson = decrypt($encryptionType,$encryptedJson);
        $obj =  json_decode($decryptedJson);
            $isenc = true;
        //error_log("2. $decryptedJson");
    }
    

    $str = file_get_contents('php://input');
    $obj = json_decode($str);
    var_dump($obj);
    $isenc = true;
    if($obj ==null) {
        //Try Base 64 
    
        $newEnc = str_replace(" ","+",$encryptedJson);
        $b64 = mb_convert_encoding( $newEnc, "UTF-8", "BASE64" ) ;
        //$b64 = base64_decode($encryptedJson);
        //error_log("orig : ".$encryptedJson);
        //error_log("b64  : ".$b64);
        $decryptedJson = rc4("p1^bil",$b64);
        $obj = json_decode($decryptedJson);
        if($obj==null) {
            $decryptedJson = rc4("p1^bil",$decryptedJson);
            //error_log("3. $decryptedJson");
            $obj = json_decode($decryptedJson);
            $isenc = false;
        } else {
            error_log("5. $decryptedJson");
            $isBase64 = true;
        }
    }
    if($obj== null) {
        $objRet->setCode("GARBAGE_IN");
    } else {
        /* Get the object parameters */
        error_log("SERVICE CALLED ".$obj->decree."   token ; ".$obj->token);
        $decree = "decree_".$obj->decree;
        $param = $obj->param;
        try {
            $objRet = $decree($obj->token,$param);
        } catch(Exception $e) {
            $objRet->setCode("DECREE_NOT_FOUND($decree) $e");
        }
    }
  }
  error_log("RETURN : ". json_encode($objRet));
  if($isenc) {
    if(isset($encryptionType)) 
        print encrypt($encryptionType,json_encode($objRet));
    else if($isBase64)  {
        error_log("JSON RET : ".json_encode($objRet));
        error_log("ENC RET  : ". rc4("p1^bil",json_encode($objRet)));
        error_log("BASE64 RET : ".mb_convert_encoding( rc4("p1^bil",json_encode($objRet))  ,"BASE64", "UTF-8"));
        $retVal  =  mb_convert_encoding( rc4("p1^bil",json_encode($objRet))  ,"BASE64", "UTF-8");
        $newRetVal = str_replace("\r","",$retVal);
        $newRetVal = str_replace("\n","",$newRetVal);
        error_log("MASS RET : $newRetVal");
        print "$newRetVal";
    }
    else
        /*print rc4("p1^bil",json_encode($objRet));*/
        //print json_encode($objRet);
        print $objRet;
  } else
    print json_encode($objRet);
  
  
  
  /* Check id it isvalid JSON */
    //$obj = json_decode($decryptedJson);
   /* $str = '{"token" : "ggfd","param": { "first_name": "pawar", "last_name": "kunal", "email_id": "lqtest.1026@liqvid.com", "password": "123456", "mobile": "8585978425","unique_code":"LQ61291C" ,"isCode":"1" , "course_code" : "LIQGRP002"  }, "decree": "register" } ';*/
    
//    $str = '{"token" : "ggfd","param": { "first_name": "pawar", "last_name": "kunal", "email_id": "kunal.pawar.local.99999@liqvid.com", "password": "123456", "mobile": "8585978425" }, "decree": "register" } ';
    
//  $str = '{"token" : "","param": { "login": "kunal.pawar.local@liqvid.com", "password": "1234567", "isCode": "yes", "unique_code": "MXEB464C"}, "decree": "login" } ';
//    
//      //$str = '{"token" : "","param": { "login": "kunal.pawar.local.99999@liqvid.com", "password": "123456"}, "decree": "login" } ';
//  
//  $str = '{
//	"decree": "register",
//	"param": {
//		"course_code": "CRS-744",
//		"email_id": "bagesh.kumar@liqvid.com",
//		"first_name": "Bagesh",
//		"isCode": "1",
//		"last_name": "Sharma",
//		"mobile": "234345456546",
//		"password": "123456",
//		"unique_code": ""
//	}
//}';
//  
//$str = '{
//	"param": {
//		"course_code": "CRS-817"
//	},
//	"decree": "user_course_signup",
//	"token": "a2424565b2ff837a0907e2c7345e1639"
//}
//';
/*
$str = '{
	"param": {
		"edge_id": "30317",
		"otype": "C"
	},
	"decree": "eventlist",
	"token": "a2424565b2ff837a0907e2c7345e1639"
}
';

$str = '{
	"param": {
		"edge_id": "30317"
	},
	"decree": "notievent",
	"token": "a2424565b2ff837a0907e2c7345e1639"
}
';
 


$str = '{
	"param": {
		"class_id": "1"
	},
	"decree": "joinevent",
	"token": "a2424565b2ff837a0907e2c7345e1639"
}
';


  $str = '{
	"param": {
		"class_id": "4"
	},
	"decree": "cancelevent",
	"token": "9da43fd61fbbe0188967c7dc2b7d5d2c"
}
';
*/
  
?>