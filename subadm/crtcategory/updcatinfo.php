<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
include("../global/functions.php"); //Connection to database 
include("resize_image.php");

$catid=$_REQUEST['catid'];
$catname=trim(strip_htmscript($_REQUEST['catname'],'mandatory'));
$catdesc=trim(strip_htmscript($_REQUEST['catdesc'],'other'));
$catkey=trim(strip_htmscript($_REQUEST['catkey'],'other'));
$catlimit=trim(strip_htmscript($_POST['catlimit'],'other'));
$explimit=trim(strip_htmscript($_POST['explimit'],'other'));


mysql_query("UPDATE tbl_company SET company_name='$catname', company_desc='$catdesc', company_address='$catkey', company_user_limit='$catlimit', company_user_expiry='$explimit' where id=$catid");
//exit;
mysql_close();

header("Location:../catlist/catlist.php");
//close the connection

?>

