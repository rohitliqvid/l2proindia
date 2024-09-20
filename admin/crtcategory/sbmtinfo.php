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

$catname=trim(strip_htmscript($_POST['catname'],'mandatory'));
$catdesc=trim(strip_htmscript($_POST['catdesc'],'other'));
$catkey=trim(strip_htmscript($_POST['catkey'],'other'));
$catlimit=trim(strip_htmscript($_POST['catlimit'],'other'));
$explimit=trim(strip_htmscript($_POST['explimit'],'other'));

$uploaded_by=$_SESSION['sess_uid'];

//check for country name
$result2 = mysql_query ("SELECT * FROM tbl_company where company_name ='".$catname."'"); 
$totalnum2=mysql_numrows($result2);

if($totalnum2)
{
header("Location:companyexists.php");
exit;
}


mysql_query("INSERT INTO tbl_company (company_name, company_desc, company_address, company_user_limit, company_user_expiry, company_created_by) VALUES ('$catname','$catdesc','$catkey','$catlimit','$explimit','$uploaded_by')");
//exit;
$id=mysql_insert_id();
header("Location:catcrtd.php?catid=$id");
//close the connection
mysql_close();
?>

