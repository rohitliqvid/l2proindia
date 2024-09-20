<?php 
require_once ('header/auth.php');

$user_id = User::getLoggedInUserID();

if( $_POST['action'] == 'remove-profile-pic' ){
    
    $res = array('status' => 0);
    $objProfile = new profileController();
    $status = $objProfile->deleteProfileImage($user_id);
    
    if($status){
        $res['status'] = 1;
    }
    $_SESSION['PROFILE_PIC_REMOVED'] = 1;
    echo json_encode($res);
    die;
    
}