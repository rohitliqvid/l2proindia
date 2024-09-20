<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
ini_set('max_execution_time', 24000);    // Increase 'timeout' time 
require ("../global/pclzip.lib.php");
$docid=$_REQUEST['docid'];
$zipfile = new PclZip($docid.'.zip');
 
	$uploadpath="/webroot/edge-cms";
	$dir=$uploadpath."/courses/".$docid."/";

$v_list = $zipfile->create($dir,'',$uploadpath."/courses/");

if ($v_list == 0) {
       die ("Error: " . $zipfile->errorInfo(true));
}
header("Content-type: application/octet-stream");
header("Content-disposition: attachment; filename=$docid.zip");
readfile($docid.'.zip');
@unlink($docid.'.zip');
?>