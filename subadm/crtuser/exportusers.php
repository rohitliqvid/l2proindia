<?php
include("../../connect.php");
$con=createConnection();
if ($_REQUEST['export_type'] == 'email_for_marketing') {
   // $results = mysql_query ("SELECT id,firstname,lastname,username,userregistered,usertype,dtenrolled,email,sex,mobile,isupdated,squestion,sanswer,dob,doj,department,country,user_city,user_country,user_state,zip_code,city,bank_id,sales_id,sales_code1,sales_code2,sales_code3,unique_code,business_type,business_role,client,user_pic,hash_key,isActive,learn_from,education,education_details,profession,profession_experience,occupation,organization,designation,device_type,device_id,allow_email_for_marketing,allow_email_for_campaign FROM tbl_users where allow_email_for_marketing='true'"); 

   $query5 = "SELECT id,firstname,lastname,username,userregistered,usertype,dtenrolled,email,sex,mobile,isupdated,squestion,sanswer,dob,doj,department,country,user_city,user_country,user_state,zip_code,city,bank_id,sales_id,sales_code1,sales_code2,sales_code3,unique_code,business_type,business_role,client,user_pic,hash_key,isActive,learn_from,education,education_details,profession,profession_experience,occupation,organization,designation,device_type,device_id,allow_email_for_marketing,allow_email_for_campaign FROM tbl_users where allow_email_for_marketing='true'";
	$results = mysqli_query($con,$query5);
	$num=mysqli_num_rows($results);
}


if ($_REQUEST['export_type'] == 'email_for_campaign') {
   // $results = mysql_query ("SELECT id,firstname,lastname,username,userregistered,usertype,dtenrolled,email,sex,mobile,isupdated,squestion,sanswer,dob,doj,department,country,user_city,user_country,user_state,zip_code,city,bank_id,sales_id,sales_code1,sales_code2,sales_code3,unique_code,business_type,business_role,client,user_pic,hash_key,isActive,learn_from,education,education_details,profession,profession_experience,occupation,organization,designation,device_type,device_id,allow_email_for_marketing,allow_email_for_campaign FROM tbl_users where allow_email_for_marketing='false'"); 

   $query5 = "SELECT id,firstname,lastname,username,userregistered,usertype,dtenrolled,email,sex,mobile,isupdated,squestion,sanswer,dob,doj,department,country,user_city,user_country,user_state,zip_code,city,bank_id,sales_id,sales_code1,sales_code2,sales_code3,unique_code,business_type,business_role,client,user_pic,hash_key,isActive,learn_from,education,education_details,profession,profession_experience,occupation,organization,designation,device_type,device_id,allow_email_for_marketing,allow_email_for_campaign FROM tbl_users where allow_email_for_marketing='false'";
	$results = mysqli_query($con,$query5);
	$num=mysqli_num_rows($results);

}

$file_name =  $_REQUEST['export_type'] == 'email_for_marketing' ? 'Subscribers.csv' : 'NonSubscribers.csv';

$export_firlds_heading  = array('id','firstname','lastname','username','userregistered','usertype','dtenrolled','email','sex','mobile','isupdated','squestion','sanswer','dob','doj','department','country','user_city','user_country','user_state','zip_code','city','bank_id','sales_id','sales_code1','sales_code2','sales_code3','unique_code','business_type','business_role','client','user_pic','hash_key','isActive','learn_from','education','education_details','profession','profession_experience','occupation','organization','designation','device_type','device_id','allow_email_for_marketing','allow_email_for_campaign');



function array2csv($array, $labeles)
{
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, $labeles);
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}

function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}

$export_data = array();
while( $row = mysqli_fetch_assoc($results) ) {
    $row['allow_email_for_marketing'] =  $row['allow_email_for_marketing']  =="true" ? 'Yes' :"No";
    $row['allow_email_for_campaign'] =  $row['allow_email_for_campaign']  =="true" ? 'Yes' :"No";  

    
	$export_data[] = $row;
}

download_send_headers($file_name);
closeConnection($con);
echo array2csv($export_data, $export_firlds_heading);
die();

?>