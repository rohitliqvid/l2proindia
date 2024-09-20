<?php

header("Access-Control-Allow-Origin: *");
require "./util.php";
require "./decree.php";
//error_reporting(E_ALL);
//ini_set('display_errors', 1);



/* This PHP accepts the hashed login and password and returns the token for further access.
  Each token is valid only fo 4 hours, after which its has to be issued again */

/* DB Tables
  token_table
  string token
  long user id
  date exipry date
 */

$objRet = new ServiceResponse("NO_ACTION", 0, null);
/* Step 1 => get the json string */
$encrypted = $_REQUEST['obj'];
$decryptedJson = openssl_decrypt($encrypted, 'AES-256-CBC', 'p1^bil');


   
/* Check id it isvalid JSON */
$obj = json_decode($decryptedJson);
$isenc = true;

if ($obj == null) {
    $objRet->setCode("GARBAGE_IN");
} else {
    /* Get the object parameters */
    //error_log("SERVICE CALLED ".$obj->decree."   token ; ".$obj->token);
    $decree = "decree_" . $obj->decree;
    $param = $obj->param;
    $dataArr = array();
    if (isset($obj->unique_code)) {
        $dataArr['unique_code'] = $obj->unique_code;
    }
    if (isset($obj->platform)) {
        $dataArr['platform'] = $obj->platform;
		
    }
    if (isset($obj->appVersion)) {
        $dataArr['appVersion'] = $obj->appVersion;
    }
    if (isset($obj->center_id)) {
        $dataArr['center_id'] = $obj->center_id;
    }


    try {
        //$objRet = $decree($obj->token,$param,$unique_code);
      $objRet = $decree($obj->token, $param, $dataArr);

    } catch (Exception $e) {
        $objRet->setCode("DECREE_NOT_FOUND($decree) $e");
    }
}


//print rc4("p1^bil", json_encode($objRet));
print openssl_encrypt(json_encode($objRet), 'AES-256-CBC', 'p1^bil');
