<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}

include("../../connect.php"); //Connection to database 
include("../../global/functions.php"); 

function mysql_escape_mimic($inp) {

    if(is_array($inp))
    return array_map(__METHOD__, $inp);
    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);

    }
    return $inp;
}


$fstnm=trim(mysql_escape_mimic(strip_htmscript($_POST['fstnm'],'mandatory')));
$lstnm=trim(mysql_escape_mimic(strip_htmscript($_POST['lstnm'],'other')));
$mobile=trim(mysql_escape_mimic(strip_htmscript($_POST['mobile'],'other')));
$occupation=trim(mysql_escape_mimic(strip_htmscript($_POST['occupation'],'other')));
$organization=trim(mysql_escape_mimic(strip_htmscript($_POST['organization'],'other')));
$designation=trim(mysql_escape_mimic(strip_htmscript($_POST['designation'],'other')));

//new modules
$sex=trim(mysql_escape_mimic(strip_htmscript($_POST['sex'],'mandatory')));
$learn_from=trim(mysql_escape_mimic(strip_htmscript($_POST['learn_from'],'mandatory')));
$education=trim(mysql_escape_mimic(strip_htmscript($_POST['education'],'mandatory')));
$education_details=trim(mysql_escape_mimic(strip_htmscript($_POST['education_details'],'mandatory')));
$profession=trim(mysql_escape_mimic(strip_htmscript($_POST['profession'],'mandatory')));
$profession_experience=trim(mysql_escape_mimic(strip_htmscript($_POST['profession_experience'],'mandatory')));
$user_country=trim(mysql_escape_mimic(strip_htmscript($_POST['user_country'],'mandatory')));
$user_state=trim(mysql_escape_mimic(strip_htmscript($_POST['user_state'],'mandatory')));
$user_city=trim(mysql_escape_mimic(strip_htmscript($_POST['user_city'],'mandatory')));
$zip_code=trim(mysql_escape_mimic(strip_htmscript($_POST['zip_code'],'mandatory')));
$allow_email_for_marketing=trim(strip_htmscript($_POST['allow_email_for_marketing'],'mandatory')) ? trim(strip_htmscript($_POST['allow_email_for_marketing'],'mandatory')) :'false';
$allow_email_for_campaign=trim(strip_htmscript($_POST['allow_email_for_campaign'],'mandatory')) ? trim(strip_htmscript($_POST['allow_email_for_campaign'],'mandatory')) : 'false';



/* $result2 = mysql_query ("SELECT * FROM tbl_users where email='".$email."' and username<>'".$userid."'"); 
$totalnum2=mysql_numrows($result2);



if($totalnum2)
{

header("Location:usermailexts.php");
exit;
} */

//update the information
/*mysql_query("UPDATE tbl_users SET firstname='$fstnm', lastname='$lstnm', mobile='$mobile',occupation='$occupation',organization='$organization',designation='$designation',sex='$sex',learn_from='$learn_from',education='$education',education_details='$education_details',profession='$profession',profession_experience='$profession_experience',user_country='$user_country',user_state='$user_state',user_city='$user_city',zip_code='$zip_code',allow_email_for_marketing='$allow_email_for_marketing',allow_email_for_campaign='$allow_email_for_campaign' WHERE username='$userid'");
mysql_close();*/


$con=createConnection();
$query = "UPDATE tbl_users SET firstname='$fstnm', lastname='$lstnm', mobile='$mobile',occupation='$occupation',organization='$organization',designation='$designation',sex='$sex',learn_from='$learn_from',education='$education',education_details='$education_details',profession='$profession',profession_experience='$profession_experience',user_country='$user_country',user_state='$user_state',user_city='$user_city',zip_code='$zip_code',allow_email_for_marketing='$allow_email_for_marketing',allow_email_for_campaign='$allow_email_for_campaign' WHERE username=?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $userid);
$stmt->execute();
$stmt->close();
closeConnection($con);

//take the user back to details page
header("Location:mydtls.php");
?>

