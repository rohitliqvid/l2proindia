<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
include("../global/functions.php"); //Connection to database 


$cName=trim(strip_htmscript($_POST['cName'],'mandatory'));
$cEmail=trim(strip_htmscript($_POST['cEmail'],'other'));
$cPhone=trim(strip_htmscript($_POST['cPhone'],'other'));
$cDesc=trim(strip_htmscript($_POST['cDesc'],'other'));


$curdate=date("Y-m-d");

//check for country name
$result2 = mysql_query ("SELECT * FROM tbl_client where client_name ='".$cName."'"); 
$totalnum2=mysql_numrows($result2);

if($totalnum2)
{
header("Location:clientexists.php");
exit;
}


mysql_query("INSERT INTO tbl_client (client_name, client_email, client_phone, client_description, date_created) VALUES ('$cName','$cEmail','$cPhone','$cDesc','$curdate')");
//exit;
$id=mysql_insert_id();
header("Location:client.php?catid=$id");
//close the connection
mysql_close();
?>

