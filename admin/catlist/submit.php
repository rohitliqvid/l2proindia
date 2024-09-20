<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}

ini_set('max_execution_time', 24000);    // Increase 'timeout' time 
//ini_set('memory_limit','-1'); 

$perms=$_SESSION['perms'];


	include("../connect.php"); //Connection to database 
	include("../global/functions.php"); 
	require_once('xml2array.class.php');  // Used to parse manifest
	require_once("scormlib.php");
	require_once("aicclib.php");
	
	$err12='false';

	

	//$catid=$_REQUEST['catid'];
	$uid=$_SESSION['sess_uid'];
	
	$ty='2';

		
	$filetype=trim($_REQUEST['file_select']); 
    $title=trim(strip_htmscript($_REQUEST['title'],'mandatory'));
    $desc=trim(strip_htmscript($_REQUEST['desc'],'other'));
    $upload=$_REQUEST['upd'];
	$width=$_REQUEST['sWidth'];
	$height=$_REQUEST['sHeight'];
	$from_page=$_REQUEST['from_page'];
	$contentType=$_POST['file_select'];
	
    $dt=date("Y:m:d");
		
		

		$file=$_REQUEST['ufilename'];
		$file_size=$_REQUEST['ufilesize'];
		$file_id=$_REQUEST['uFileId'];
		
	
$downloadpath="../../courses/";
$uploadpath="../../courses/";
if($_REQUEST['upload'])
		{
			$uploaddir=$uploadpath;
			$file_name=str_replace(" ","_",$file);
			$file_ext=split("\.", $file);
			rename($downloadpath.$file, $downloadpath.$file_name);
			$file=$file_name;
					
						/*$query = mysql_query("SELECT MAX(id) FROM `tls_scorm`");
						$results = mysql_fetch_array($query);
						$cur_auto_id = $results['MAX(id)'] + 1;
						$scrCourseId=$cur_auto_id;*/

						$r = mysql_query("SHOW TABLE STATUS LIKE 'tls_scorm'");
						$row = mysql_fetch_array($r);
						$Auto_increment = $row['Auto_increment'];
						$scrCourseId=$Auto_increment;
						rename($downloadpath.$file, $uploaddir.$scrCourseId.".zip");
						extract_file($scrCourseId);
						if($contentType=='1')
						{
						scorm_add_instance($scrCourseId,$title,$desc,$file_name,$width,$height);
						}
						else
						{
						$uploadpath1="../../courses/";
						$dir1=$uploadpath1.$scrCourseId;
						scorm_parse_aicc($dir1,$scrCourseId,$title,$desc,$file_name,$width,$height);
						}
						@unlink($uploaddir.$scrCourseId.".zip");
						header("Location: waiting_documents.php");
					
}	


## This function extracts uploaded zip file
function extract_file($courseId)
{
	
	$uploadpath="../../courses/";
	$dir=$uploadpath.$courseId."/";
	include("../global/pclzip.lib.php");
	//mkdir($dir, 0777, true);
	//chmod($uploadpath, 0777);
	//chmod($dir, 0777);
	$file=$uploadpath.$courseId.".zip";
	$archive = new PclZip($file);
	//extract to a folder called newdir
	if ($archive->extract(PCLZIP_OPT_PATH, $dir) == 0) 
	{
	die("Error : ".$archive->errorInfo(true));
	}
}
?>