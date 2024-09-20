<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
?>
<?
$catid=$_REQUEST['catid'];
$uploadpath="/webroot/edge-cms/courses/";
include("../connect.php"); //Connection to database 

//get the array for the selected checkboxes (courses)
$choice = $_POST['choice'];

if ($choice<>"")
{
foreach ($choice as $value){ 
$search=$value; 

mysql_query("DELETE FROM tbl_courses where id=$search");
mysql_query("DELETE FROM tbl_company_COURSE WHERE course_id=$search");
mysql_query("DELETE FROM tbl_user_course_pref WHERE course_id=$search");

@unlink($uploadpath."download/".$search.".zip");
deleteDir($uploadpath.$search);

}
mysql_close();
}

//take the user back to course list after deleting the course(s)
header("Location: documents.php?currpage=$cp&totalpg=$tp&id=$catid");

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