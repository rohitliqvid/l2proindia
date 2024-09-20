<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../../");
exit();
}
include("../../connect.php"); //Connection to database 
include("../../global/functions.php"); 

$docid=$_REQUEST['docid'];
if(isset($_REQUEST['launchid']))
{
$launchid=$_REQUEST['launchid'];
$result = mysql_query ("SELECT * FROM tbl_courses_links where id=$launchid"); 
$file_name=mysql_result($result,0,"file_launch");
}
else
{
$result = mysql_query ("SELECT file_hits,file_launch FROM tbl_courses where id=$docid"); 
$filehits=mysql_result($result,0,"file_hits");
$file_name=mysql_result($result,0,"file_launch");
}
//$file_type=mysql_result($result,0,"FILE_CONTENT_TYPE");


//$result = mysql_query ("update tbl_courses set file_hits=$filehits+1 where id=$docid"); 

//mysql_close();

$viewpath="/edge-cms/courses/".$docid."/";

$filename=$viewpath.$file_name;
/*
if(!file_exists($filename))
{
header("Location:../notavailable.php");
exit;
}
*/

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CMS</title>
<script language="javascript" type="text/javascript">
	var file="<?=$filename?>";
	var fileExt=file.split(".");
	if(fileExt[1]=="wmv" || fileExt[1]=="wav" || fileExt[1]=="avi" || fileExt[1]=="mp3")
	{
	document.write("<EMBED SRC="+file+" AUTOSTART=true></EMBED>");
	}
	else
	{
	self.location.href=file;
	}
	
</script>
</head>
<body>

</body>
</html>