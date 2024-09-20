<?

include("../connect.php"); //Connection to database 

//// Get the user id to check if the user is sysadmin or not
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}

$un=trim($_GET['usern']);
$ut=trim($_GET['usert']);
$cp=trim($_GET['cp']);
$tp=trim($_GET['tp']);
$trec=trim($_GET['trec']);
$deleteCounter=0;

//exit;
////

//if currentpage is equal to the total pages and all the records on the lastpage(totalPages) are deleted
//then subtract one page from the current page
//if($cp+1==$tp)
//{
//$cp=$tp-2;
//}

//get the array for the selected checkboxes
$choice = $_POST['choice'];

if ($choice<>"")
{
foreach ($choice as $value){ 
$search=$value; 

////select the courses for which these users are enrolled and uneroll them
$query1="select id,username from tbl_users where id=$search"; 
$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1); 
$usRowId = mysql_result($result1,"id");
$usid = mysql_result($result1,"username");

//if the System administrator is selected then delete rest except System administrator
if ($userid=='admin')
{
mysql_query("DELETE FROM tbl_users where id=$search and username<>'admin'");
mysql_query("DELETE FROM tbl_company_user WHERE user_id=$search");
mysql_query("DELETE FROM tbl_user_course_pref WHERE user_id=$search");
mysql_query("DELETE FROM tbl_feedback WHERE f_by_id=$search");
mysql_query("DELETE FROM tbl_entry_log WHERE user_id=$search");
mysql_query("DELETE FROM tls_scorm_sco_tracking WHERE userid=$search");
mysql_query("DELETE FROM tbl_sco_completion WHERE userid=$search");
$deleteCounter++;
}
else if($userid<>'admin')
{
mysql_query("DELETE FROM tbl_users where id=$search and usertype<>'1'");
mysql_query("DELETE FROM tbl_company_user WHERE user_id=$search");
mysql_query("DELETE FROM tbl_user_course_pref WHERE user_id=$search");
mysql_query("DELETE FROM tbl_feedback WHERE f_by_id=$search");
mysql_query("DELETE FROM tbl_entry_log WHERE user_id=$search");
mysql_query("DELETE FROM tls_scorm_sco_tracking WHERE userid=$search");
mysql_query("DELETE FROM tbl_sco_completion WHERE userid=$search");
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
//take the user back to the user list after deleting the selected users
header("Location: userlist.php?uname=$un&utype=$ut&currpage=$cp&totalpg=$tp");
?>