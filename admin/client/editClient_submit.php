<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
include("../global/functions.php"); //Connection to database 


$catid=$_REQUEST['catid'];
$cName=trim(strip_htmscript($_REQUEST['cName'],'mandatory'));
$cDesc=trim(strip_htmscript($_REQUEST['cDesc'],'other'));
$cEmail=trim(strip_htmscript($_REQUEST['cEmail'],'other'));
$cPhone=trim(strip_htmscript($_POST['cPhone'],'other'));



mysql_query("UPDATE tbl_client SET client_name='$cName', client_description='$cDesc', client_email='$cEmail', client_phone='$cPhone' where id=$catid");
//exit;
mysql_close();

header("Location: client.php");
//close the connection

?>

