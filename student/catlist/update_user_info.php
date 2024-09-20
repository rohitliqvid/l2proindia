<?php
session_start();
if (!isset($_SESSION['sess_uid'])) {
    header("Location: ../../");
    exit();
}


include("../../connect.php"); //Connection to database 



if (isset($_POST)) {
    $education  =  $_POST['education'];
    $gender =  $_POST['gender'];
    $user_country  =  $_POST['user_country'];
    $user_state  =  $_POST['user_state'];
    $user_city  =  $_POST['user_city'];
    $zip_code  =  $_POST['zip_code'];
    $organization  =  $_POST['organization'];
    $profession  =  $_POST['profession'];
    $education_details  =  $_POST['education_details'];
    $profession_experience  =  $_POST['profession_experience'];
    $user_id  =  $_POST['user_id'];
    $learn_from  =  $_POST['learn_from'];

  //  mysql_query("UPDATE tbl_users SET sex='$gender', education='$education', user_country='$user_country', user_state='$user_state',user_city='$user_city',zip_code='$zip_code',organization='$organization',profession='$profession',education_details='$education_details',profession_experience='$profession_experience',learn_from='$learn_from' where id ='$user_id'");

$con=createConnection();
$query = "UPDATE tbl_users SET sex='$gender', education='$education', user_country='$user_country', user_state='$user_state',user_city='$user_city',zip_code='$zip_code',organization='$organization',profession='$profession',education_details='$education_details',profession_experience='$profession_experience',learn_from='$learn_from' where id = '$user_id'";
file_put_contents('query_update.txt',$query);
$stmt = $con->prepare($query);
//$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();
//closeConnection($con);


    echo json_encode(array('success' => 1));
} else {
    echo json_encode(array('success' => 0));
}
