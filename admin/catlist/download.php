<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
$serveradd=$_SERVER["HTTP_HOST"];
$currPage=$_REQUEST['curPage'];
$file_name=$_REQUEST['file_name'];
$docid=$_REQUEST['docid'];
$file_type=$_REQUEST['file_type'];
if($file_type=='zip')
{
$uploadpath="/webroot/edge-cms/courses/download/";
$downloadPath="http://".$serveradd."/edge-cms/courses/download/";
$file_name=$docid.".zip";
}
else
{
$uploadpath="/webroot/edge-cms/courses/".$docid."/";
$downloadPath="http://".$serveradd."/edge-cms/courses/".$docid."/";
}
$result = mysql_query ("SELECT file_hits FROM tbl_courses where id=$docid"); 
$filehits=mysql_result($result,0,"file_hits");
$result = mysql_query ("update tbl_courses set file_hits=$filehits+1 where id=$docid"); 
if(file_exists($uploadpath.$file_name))
{
	$openPath=$downloadPath.$file_name;
	if(!$fp=fopen($openPath,'rb'))
	{
		echo "Error Reading File";
		exit;
	}else {
		header("Content-disposition: attachment; filename=$file_name");
		header("Content-type: application/octet-stream");
		header("Pragma: no-cache");
		header("Expires: 0");
		fpassthru($fp);
		fclose($fp);
	}
		exit;
}
else
{
	?>
	<script>
	alert("Course not found at specified location!");
	document.location="waiting_documents.php?id=<?=$catid?>&currpage=<?=$currPage?>";
	</script>
	<?
	exit;
}
?>