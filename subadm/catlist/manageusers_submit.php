<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
?>

<?
//Get if the Allow or Deny button is clicked
$ulist = $_REQUEST['obj2'];
$catid = $_REQUEST['catid'];

$userlist=explode(',',$ulist);



include("../connect.php"); //Connection to database 


mysql_query("DELETE FROM tbl_company_user WHERE company_id=$catid");
//if the Allow button is clicked

for($i=0;$i<count($userlist);$i++)
{ 
mysql_query("INSERT into tbl_company_user(company_id,user_id) values ($catid,'$userlist[$i]')");
}

mysql_close();


//take the user back to the request list
header("Location: manageusers.php?msg=yes&id=$catid");


?>