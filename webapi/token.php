<?php
require "./util.php";

/* This PHP accepts the hashed login and password and returns the token for further access.
   Each token is valid only fo 4 hours, after which its has to be issued again */
 
/* DB Tables
    token_table
         string token 
         long user id
         date exipry date
*/
    $response_code = "NO_ACTION";
    $response_stat = 0;
  /* Step 1 => get the json string */
  $encryptedJson = $_POST['obj'];
  if( $encryptedJson == null)
    $encryptedJson = $_GET['obj'];
  if($encryptedJson == null) {
    $response_code = "OBJ_NOT_FOUND";
    $response_stat = 0;
  } else {
    /* decrypt the json */
    $decryptedJson = rc4("p1^bil",$encyptedJson);
    /* Check id it isvalid JSON */
    $obj = json_decode($decryptedJson);
    if($obj== null) {
        $response_code = "GARBAGE_IN";
        $response_stat = 0;
    } else {
        /* Get the object parameters */
        $decree = $obj->decree;
        $param = $obj->param;
        try {
            $response_code = $decree($param);
            if($response_code == 'SUCESS') {
                $response_stat =1 ;
            }
        } catch(Exception $e) {
            $response_code = 'DECREE_NOT_FOUND';
            $response_stat = 0;
        }
    }
  }



?>
