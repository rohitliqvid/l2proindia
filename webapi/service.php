<?php
header("Access-Control-Allow-Origin: *");
require "./util.php";
require "./decree.php";
error_reporting(E_ALL);
/* This PHP accepts the hashed login and password and returns the token for further access.
   Each token is valid only fo 4 hours, after which its has to be issued again */
 
/* DB Tables
    token_table
         string token 
         long user id
         date exipry date
*/
  $objRet = new ServiceResponse("NO_ACTION",0,null);

  /* Step 1 => get the json string */
  $encryptedJson = $_REQUEST['obj'];
  //error_log("0. $encryptedJson");
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
        $decryptedJson = $encryptedJson;
        //error_log("1. $decryptedJson");
    } else {
        $decryptedJson = decrypt($encryptionType,$encryptedJson);
        $obj =  json_decode($decryptedJson);
            $isenc = true;
        //error_log("2. $decryptedJson");
    }
    /* Check id it isvalid JSON */
    $obj = json_decode($decryptedJson);
    $isenc = true;
    if($obj ==null) {
        //Try Base 64 
    
        $newEnc = str_replace(" ","+",$encryptedJson);
        $b64 = mb_convert_encoding($newEnc, "UTF-8", "BASE64" ) ;
        //$b64 = base64_decode($encryptedJson);
        //error_log("orig : ".$encryptedJson);
        //error_log("b64  : ".$b64);
        $decryptedJson =$b64;
        $obj = json_decode($decryptedJson);
        if($obj==null) {
            $decryptedJson =$decryptedJson;
            //error_log("3. $decryptedJson");
            $obj = json_decode($decryptedJson);
            $isenc = false;
        } else {
            //error_log("5. $decryptedJson");
            $isBase64 = true;
        }
    }
    if($obj== null) {
        $objRet->setCode("GARBAGE_IN");
    } else {

        /* Get the object parameters */
        //error_log("SERVICE CALLED ".$obj->decree."   token ; ".$obj->token);
        $decree = "decree_".$obj->decree;
        $param = $obj->param;
		$dataArr = array();
			if(isset($obj->unique_code)){
				$dataArr['unique_code'] = $obj->unique_code;
			}
			if(isset($obj->platform)){
				$dataArr['platform'] = $obj->platform;
			}
			if(isset($obj->appVersion)){
				$dataArr['appVersion'] = $obj->appVersion;
			}	
			if(isset($obj->center_id)){
				$dataArr['center_id'] = $obj->center_id;
			}


        try {
            //$objRet = $decree($obj->token,$param,$unique_code);
			$objRet = $decree($obj->token,$param,$dataArr);
        } catch(Exception $e) {
            $objRet->setCode("DECREE_NOT_FOUND($decree) $e");
        }
    }
  }
  ////error_log("RETURN : ". json_encode($objRet));
  if($isenc) {
    if(isset($encryptionType)) 
        print encrypt($encryptionType,json_encode($objRet));
    else
        print json_encode($objRet);
  } else
    print json_encode($objRet);
?>
