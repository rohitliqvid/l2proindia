<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
include("../global/functions.php");

$catid=$_REQUEST['catid'];
$catname=trim(strip_htmscript($_REQUEST['catname'],'mandatory'));
$catdesc=trim(strip_htmscript($_REQUEST['catdesc'],'other'));
$catkey=trim(strip_htmscript($_POST['catkey'],'other'));
$catlimit=trim(strip_htmscript($_POST['catlimit'],'other'));
$explimit=trim(strip_htmscript($_POST['explimit'],'other'));


mysql_query("UPDATE tbl_category SET category_name='$catname', category_desc='$catdesc' where id=$catid");
//exit;
mysql_close();

header("Location:../catlist/categories.php");
//close the connection

?>

