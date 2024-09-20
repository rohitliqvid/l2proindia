<?
ini_set('max_execution_time', 24000);    // Increase 'timeout' time 
?>
<body topmargin="10" leftmargin="10" class='contentBG'>
 <table width="784" cellspacing="0" cellpadding='3' class='tblBorder'>
  <tr><td class='content' colspan='3'>Extracting the course files. Please wait...</td></tr> 
</table>
</body>
<?
$courseId=$_REQUEST['courseid'];
$file=$_REQUEST['file'];
$uploadpath="/webroot/edge-cms";
	$dir=$uploadpath."/courses/".$courseId."/";
	include("../global/pclzip.lib.php");
	$file=$uploadpath."/courses/download/".$file;
	$archive = new PclZip($file);
	//extract to a folder called newdir
	if ($archive->extract(PCLZIP_OPT_PATH, $dir) == 0) 
	{
	die("Error : ".$archive->errorInfo(true));
	}
header("Location: edit_content_zip_uploaded.php?from_page=$from_page&docid=$courseId");
?>