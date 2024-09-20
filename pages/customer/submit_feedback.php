<?
session_start();
if (!isset($_SESSION['login_user'])) 
{

header("Location: ../");
exit();
}

include("../../../connect.php"); //Connection to database 
include("../../../global/functions.php"); 

$fromName=getFullName($_SESSION['login_user']);

$subject=trim(strip_htmscript($_POST['subject'],'mandatory'));
$description=trim(strip_htmscript($_POST['description'],'mandatory'));
$uploaded_by=getFullName($_SESSION['login_user']);
$uploaded_by_id=getUserId($_SESSION['login_user']);

$dt=date("Y:m:d");
$f_status='0';

//$uploaded_by=getUserId($uploaded_by);
mysql_query("INSERT INTO TBL_FEEDBACK (f_subject, f_description, f_by, f_by_id, f_date, f_status) VALUES ('$subject','$description','$uploaded_by',$uploaded_by_id,'$dt','$f_status')");
//exit;
$id=mysql_insert_id();

header("Location:feedback_submitted.php");
//close the connection
mysql_close();
?>

