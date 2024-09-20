<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
?>
<?
include("../connect.php"); //Connection to database 

//get the array for the selected checkboxes (courses)
$choice = $_POST['choice'];
$cp=trim($_GET['cp']);
$tp=trim($_GET['tp']);
$trec=trim($_GET['trec']);
$deleteCounter=0;

if ($choice<>"")
{
foreach ($choice as $value){ 
$search=$value; 

//get the selected courses from the database
$query1="select * from tbl_category_course where category_id=$search"; 
$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1); 
$totalnum=mysql_numrows($result1);
	if($totalnum==0)
	{
	mysql_query("DELETE FROM tbl_category where id=$search");
	mysql_query("DELETE FROM tbl_company_category WHERE category_id=$search");
	$deleteCounter++;
	}
}
mysql_close();
}
$isLastRecord=($trec-$deleteCounter)%$pageSplit;
if($isLastRecord==0 && $trec>$pageSplit)
{
$cp=$cp-1;
$tp=$tp-1;
}
//take the user back to course list after deleting the course(s)
header("Location: categories.php?currpage=$cp&totalpg=$tp");
?>