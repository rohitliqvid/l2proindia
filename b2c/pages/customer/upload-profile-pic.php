<?php

require_once ('header/auth.php');

$course_id = $_REQUEST['cid'];

$objUser = new User();
$user_id = User::getLoggedInUserID();
$user_data = $objUser->getUserDataFromDB($user_id);

$info = getimagesize($_FILES['profile-pic']['tmp_name']);

$_SESSION['upload-profile-pic'] = array('err' => '', 'success' => '');

if ($info === FALSE) {
    $_SESSION['upload-profile-pic']['err'] = 'Please upload only gif/jpg/png.';
}

if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
    $_SESSION['upload-profile-pic']['err'] = 'Please upload only gif/jpg/png.';
}

$size = $_FILES['profile-pic']['size'] / (1024 * 1024);


if ($size >= PROFILE_PIC_UPLOAD_MAX_SIZE) {
    $_SESSION['upload-profile-pic']['err'] = 'Please upload image having size less than or equal to ' . PROFILE_PIC_UPLOAD_MAX_SIZE . ' MB.';
}


if( !empty($_SESSION['upload-profile-pic']['err']) ){
    header('Location: profile.php?cid='.$course_id);
    die;
}

$uploadedfile = $_FILES['profile-pic']['tmp_name'];


list($width, $height) = getimagesize($uploadedfile);
//maintain ratio 
$newwidth = PROFILE_PIC_WIDTH;
$newheight = ($height / $width) * $newwidth;
$tmp = imagecreatetruecolor($newwidth, $newheight);




if ( $info[2] == IMAGETYPE_JPEG ) {
    $file_basename = $user_id.'_'.time() . '.jpg';
    $filename = dirname(__DIR__) .'/'. PROFILE_PIC_DIR . '/' . $file_basename;
    
    $src = imagecreatefromjpeg($uploadedfile);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagejpeg($tmp, $filename, 100);

} else if ( $info[2] == IMAGETYPE_PNG ) {
    
    $file_basename = $user_id.'_'.time() . '.png';
    $filename = dirname(__DIR__) .'/'. PROFILE_PIC_DIR . '/' . $file_basename;
    
    $src = imagecreatefrompng($uploadedfile);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    //imagepng($tmp, $filename, 100);
     imagejpeg($tmp, $filename, 100);

} else {
    
    $file_basename = $user_id.'_'.time() . '.gif';
    $filename = dirname(__DIR__) .'/'. PROFILE_PIC_DIR . '/' . $file_basename;
    
    $src = imagecreatefromgif($uploadedfile);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagegif($tmp, $filename, 100);
}


imagedestroy($src);
imagedestroy($tmp);

// update in database 
$objUser->updateProfilePic($user_id, $file_basename);

// delete old image 
$filename_to_delete = dirname(__DIR__) .'/'. PROFILE_PIC_DIR . '/' . $user_data['profileImage'];
if(file_exists($filename_to_delete) ){
    unlink($filename_to_delete);
}

$_SESSION['upload-profile-pic']['success'] = 'Profile image has been updated successfully.';

header('Location: index.php?cid='.$course_id);

die;
       

