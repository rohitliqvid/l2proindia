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
$from_page=$_REQUEST['from_page'];
$cp=trim($_GET['cp']);
$tp=trim($_GET['tp']);
$trec=trim($_GET['trec']);

$cCategory=trim($_REQUEST['cCategory']);
$cContent=trim($_REQUEST['cContent']);
$cCode=trim($_REQUEST['cCode']);
$cTitle=trim($_REQUEST['cTitle']);
$cDesc=trim($_REQUEST['cDesc']);
$cKey=trim($_REQUEST['cKey']);

$deleteCounter=0;

$uploadpath="../../courses/";
include("../connect.php"); //Connection to database 




$curdate=date('y-m-d');

if ($_POST['deletedoc']) 
{
if ($choice<>"")
{
foreach ($choice as $value){ 
$search=$value; 

mysql_query("DELETE FROM tls_scorm where id=$search");
mysql_query("DELETE FROM tls_scorm_sco WHERE scorm=$search");
mysql_query("DELETE FROM tls_scorm_sco_tracking WHERE scoid=$search");
mysql_query("DELETE FROM tbl_courses_links WHERE course_id=$search");
mysql_query("DELETE FROM tbl_company_course WHERE course_id=$search");
mysql_query("DELETE FROM tbl_category_course WHERE course_id=$search");
mysql_query("DELETE FROM tbl_user_course_pref WHERE course_id=$search");
$deleteCounter++;
//@unlink($uploadpath."download/".$search.".zip");
deleteDir($uploadpath.$search);
}
mysql_close();
}

$isLastRecord=($trec-$deleteCounter)%$pageSplit;
if($isLastRecord==0 && $trec>$pageSplit)
{
$cp=$cp-1;
$tp=$tp-1;
}
//take the user back to the request list
if($from_page=='w')
	{
header("Location: waiting_documents.php?currpage=$cp&totalpg=$tp&cCategory=$cCategory&cContent=$cContent&cCode=$cCode&cTitle=$cTitle&cDesc=$cDesc&cKey=$cKey");
	}
	else
	{
	header("Location: published_documents.php?currpage=$cp&totalpg=$tp&cCategory=$cCategory&cContent=$cContent&$cCode=cCode&cTitle=$cTitle&cDesc=$cDesc&cKey=$cKey");
	}
}


## This function deletes every file in the directory
function deleteDir($dir)
{
   if (substr($dir, strlen($dir)-1, 1) != '/')
       $dir .= '/';

   if ($handle = @opendir($dir))
   {
       while ($obj = readdir($handle))
       {
           if ($obj != '.' && $obj != '..')
           {
               if (is_dir($dir.$obj))
               {
                   if (!deleteDir($dir.$obj))
                       return false;
               }
               elseif (is_file($dir.$obj))
               {
                   if (!unlink($dir.$obj))
                       return false;
               }
           }
       }

       closedir($handle);

       if (!@rmdir($dir))
           return false;
       return true;
   }
   return false;
}

?>