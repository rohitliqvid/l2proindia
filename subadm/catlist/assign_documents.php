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

$catid=$_REQUEST['catid'];

//print_r($choice);
//exit;
include("../connect.php"); //Connection to database 



//if the Allow button is clicked


if ($choice<>"")
{
	mysql_query("DELETE FROM tbl_category_course WHERE category_id=$catid");
	foreach ($choice as $value)
	{ 
	$search=$value; 

	mysql_query("INSERT into tbl_category_course(category_id,course_id) values ('$catid',$search)");
	}


}
else
{
mysql_query("DELETE FROM tbl_category_course WHERE category_id=$catid");
}
mysql_close();
//take the user back to the request list
header("Location: categories.php");


?>