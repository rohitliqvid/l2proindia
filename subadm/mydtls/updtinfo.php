<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location:../../index.php#item1");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}

if(!$_SESSION['token'])
{
header("Location:../../index.php#item1");
exit();
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





$con=createConnection();
$query = "UPDATE tbl_users SET firstname='$fstnm', lastname='$lstnm', mobile='$mobile' WHERE username=?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $userid);
$stmt->execute();
$stmt->close();
closeConnection($con);

//$res=mysql_query("UPDATE tbl_users SET firstname='$fstnm', lastname='$lstnm', mobile='$mobile' WHERE username='$userid'");
//mysql_close();


if($res)  //if the results of the query are not null
{
header("Location:profilemsg.php?done=true");
}
else
{
header("Location:profilemsg.php?done=false");
}
?>

