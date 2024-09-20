<?php

ini_set('max_execution_time', 24000);    // Increase 'timeout' time 

	//$downloadpath="/webroot/edge-cms/admin/web/uploads/";
	$uploadpath="/webroot/edge-cms";
					//rename($downloadpath.$file, $uploaddir."download/".$docid.".zip");
					extract_file();



## This function extracts uploaded zip file
function extract_file()
{
	$uploadpath="/webroot/edge-cms";
	$dir=$uploadpath."/orgext/";
	include("pclzip.lib.php");
	
	$file=$uploadpath."/orgfile/ftp.zip";
	
	$archive = new PclZip($file);
	//extract to a folder called newdir
	if ($archive->extract(PCLZIP_OPT_PATH, $dir) == 0) 
	{
		die("Error : ".$archive->errorInfo(true));
	}
	
}
?>