<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
include("../global/functions.php");

$catname=trim(strip_htmscript($_POST['catname'],'mandatory'));
$catdesc=trim(strip_htmscript($_POST['catdesc'],'other'));


//check for country name
$result2 = mysql_query ("SELECT * FROM tbl_category where category_name ='".$catname."'"); 
$totalnum2=mysql_numrows($result2);

if($totalnum2)
{
header("Location:categoryexists.php");
exit;
}
//////////////////

mysql_query("INSERT INTO tbl_category (category_name, category_desc) VALUES ('$catname','$catdesc')");
//exit;
$id=mysql_insert_id();
header("Location:category_catcrtd.php?catid=$id");
//close the connection
mysql_close();
?>

