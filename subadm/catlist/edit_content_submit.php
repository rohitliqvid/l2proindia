<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}

ini_set('max_execution_time', 24000);    // Increase 'timeout' time 

include("../connect.php"); //Connection to database 
include("../global/functions.php"); 

$docid=$_REQUEST['docid'];

$currpage=trim($_GET['cp']);
$totalPages=trim($_GET['tp']);

$ty='2';
$err12='false';

$downloadpath="/webroot/edge-cms/admin/web/uploads/";
$uploadpath="/webroot/edge-cms";

$filetype=trim($_REQUEST['file_select']); 

$result2 = mysql_query ("SELECT * FROM tbl_courses where id ='".$docid."'"); 
$totalnum2=mysql_numrows($result2);


	$dir=$uploadpath."/courses/".$docid;
	deleteDir($dir);
	$zipfile=$uploadpath."/courses/download/".$docid.".zip";
	@unlink($zipfile);

	if($filetype=='2')
	{
	$file_content_type='zip';
	}
	else
	{
	
	$file_content_type='file';
	}
//	exit;
	$versioninfo=$versioninfo+1;


	// uploaded file details
		$file=$_REQUEST['ufilename'];
		$file_size=$_REQUEST['ufilesize'];
		$file_id=$_REQUEST['uFileId'];
			
			
	


		if($_REQUEST['upload'])
		{
			$uploaddir=$uploadpath."/courses/";
			$file_name=str_replace(" ","_",$file);
			//$uploadfile = $uploaddir.$file_name;
			$file_ext=split("\.", $file);
			rename($downloadpath.$file, $downloadpath.$file_name);
			$file=$file_name;

			
					if($filetype=='2')
					{
					rename($downloadpath.$file, $uploaddir."download/".$docid.".zip");
					extract_file($docid);
					mysql_query("DELETE FROM tbl_courses_links WHERE course_id=$docid");
					mysql_query("UPDATE tbl_courses SET file_content_type='$file_content_type', file_type='$file_ext[1]', file_name='$file' where id=$docid");
					@unlink($downloadpath.$file);
					rename($uploaddir."download/".$docid.".zip", $uploaddir."download/".$file);
					mysql_query("DELETE FROM tbl_upload_track where id=$file_id");
					header("Location: edit_zip_extract_code.php?courseid=$docid&file=$file");
//					header("Location: edit_content_zip_uploaded.php?from_page=$from_page&docid=$docid");
					exit;
					}
					else
					{
					mysql_query("UPDATE tbl_courses SET file_launch='$file', file_name='$file', file_type='$file_ext[1]', file_content_type='$file_content_type' where id=$docid");
					mkdir($uploaddir.$docid);
					copy($downloadpath.$file, $uploaddir.$docid."/".$file);
					@unlink($downloadpath.$file);
					mysql_query("DELETE FROM tbl_upload_track where id=$file_id");
					header("Location: edit_content_document_uploaded.php?from_page=$from_page&docid=$docid");
					exit;
					}
		
		}	


## This function extracts uploaded zip file
function extract_file($courseId)
{
	$uploadpath="/webroot/edge-cms";
	$dir=$uploadpath."/courses/".$courseId."/";
	include("../global/pclzip.lib.php");
	
	$file=$uploadpath."/courses/download/".$courseId.".zip";
	//echo $file;
	//exit;
	
	$archive = new PclZip($file);
	//extract to a folder called newdir
	if ($archive->extract(PCLZIP_OPT_PATH, $dir) == 0) 
	{
	//failed
	die("Error : ".$archive->errorInfo(true));
	}
	//echo "Successfully extracted files";
	
	/*
	$temp=explode(".",$_FILES['file']['name']);
	$renameFile=$temp[0];
	
	$oldFile="../uploads/".$renameFile;
	$newFile="../uploads/".$courseId;
	rename($oldFile,$newFile);
	
	if ($file!='')
	{
		unlink($file);
	}
	//die;
	*/
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