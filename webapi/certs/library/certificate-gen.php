<?php 
error_reporting(1);
ini_set("display_errors", 1);

ini_set('max_execution_time', 20000000);


require_once 'certClass.php';
require_once 'emp-controller.php';
require_once 'certificate.php';

$cuid=$_REQUEST['uid'];
$cfname=$_REQUEST['fname'];
$clname=$_REQUEST['lname'];
$clevel=$_REQUEST['level'];

$certObj = getUserCertificateOnCourse($cuid, $clevel, $cfname, $clname);
//$certObj = getUserCertificateOnCourse(3768, 4, 'Charchit', '');
echo '<pre>';print_r($certObj);
die;
// make dummy id 0 to run for all users 
//$_dummy_user_id = 732;
$_dummy_user_id = 0;
$dummy_chapter_completed_count = 35;



$_TOTAL_CHAPS = 120;

$con = createConnection();
$objCert = new cert($con);


$course_arr = array();
$chap_comp_arr = array();

$stmt = $objCert->_con->prepare("SELECT course_id, code, title from course where is_active =1 "); 
$stmt->bind_result($course_id, $code, $title);
$stmt->execute();

while ($stmt->fetch()) {
    
    if( $course_id == 1) continue;
    $course_arr[$course_id] = array('code' => $code);
    
}    
$stmt->close();


if( empty($_dummy_user_id) ){
    
    foreach( $course_arr as $course_id => $arr){
    
        $course_struct = getCourseStruct($con, $course_id);

        foreach($course_struct['topics'] as $tarr_loop){
            foreach($tarr_loop['chapters'] as $chap_edge_id => $carr_loop){

                foreach($carr_loop['components'] as $comp_loop){
                    if( $comp_loop['type'] == 'concept' || $comp_loop['type'] == 'vocab' || $comp_loop['type'] == 'quiz' || $comp_loop['type'] == 'roleplay'){
                        $chap_comp_arr[$chap_edge_id][$comp_loop['type']] = $comp_loop['id'];
                    }

                }

            }
        }

    }
    
    
    
}




$user_cert_data = $objCert->getDataForCert($_dummy_user_id);
//echo '<pre>';print_r($user_cert_data);
foreach($user_cert_data as $user_id => $chap_comps){
    $chap_completed_count = 0;
    foreach($chap_comps as $chap_id => $comp_completed_arr){
        $total_comp_in_chapter = count($chap_comp_arr[$chap_id]) + 1;
        $comp_completed_count = count($comp_completed_arr);
        if( $comp_completed_count >= $total_comp_in_chapter ){
            $chap_completed_count++;
        }
    }
    
    if( $_dummy_user_id > 0 ){
        $chap_completed_count = $dummy_chapter_completed_count;
    }
    
    $chap_comp_per = floor( ($chap_completed_count * 100) / $_TOTAL_CHAPS );
    
    $level_arr = array();
    if( $chap_completed_count >= 30 ){
        $level_arr[] = 1;
    }
    if( $chap_completed_count >=60 ){
        $level_arr[] = 2;
    }
    if( $chap_completed_count >=90 ){
        $level_arr[] = 3;
    }
    if( $chap_completed_count >=120 ){
        $level_arr[] = 4;
    }
    
    
    
    
    
    
    // delete certificates 
    $objCert->deleteCertificates($user_id);
    
	$objCert->insertUserPercentage($user_id, $chap_comp_per);
    $objCert->insertUserChapterCount($user_id, $chap_completed_count);

    // get user level done 
    $user_levels_already = $objCert->getUserLevels($user_id);
    
    foreach($level_arr as $level){
        if( !in_array($level, $user_levels_already) ){
            
            $user_info = $objCert->getUserInfo($user_id);
            
            $certObj = getUserCertificateOnCourse($user_info['loginid'], $level, $user_info['fname'],  $user_info['lname'] );
            
            $cert_arr = array('user_id' => $user_id, 'level' => $level, 'cert_path' => $certObj->webRedirectionLink);
            $objCert->insertUserLevel($cert_arr);
        }
    }
    
}

//echo '<pre>';print_r($chap_comp_arr);

echo 'Done';