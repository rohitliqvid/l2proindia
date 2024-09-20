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
$choice = $_POST['choice'];
$docid=$_REQUEST['docid'];
include("../connect.php"); //Connection to database 
if ($choice<>"")
{
	mysql_query("DELETE FROM tbl_category_course WHERE course_id=$docid");
	foreach ($choice as $value)
	{ 
	$search=$value; 
	mysql_query("INSERT into tbl_category_course(category_id,course_id) values ($search,'$docid')");
	}
}
else
{
mysql_query("DELETE FROM tbl_category_course WHERE course_id=$docid");
}
header("Location: waiting_documents.php");
exit;
?>