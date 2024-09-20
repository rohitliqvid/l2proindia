<?php
//ini_set('max_execution_time', 24000);    // Increase 'timeout' time 
include("connect.php");
$result=mysql_query("select distinct userid from tls_scorm_sco_tracking");
$totalnum=mysql_numrows($result);
$i=0;
while ($i < $totalnum) 
	{
		$userid=mysql_result($result,$i,"userid");
		$result1=mysql_query("select * from tbl_users where id='$userid'");
		$logged=mysql_result($result1,0,"logged");
		if($logged=='no')
			{
				mysql_query("update tbl_users set logged='yes' where id='$userid'");
				echo "executed";
			}
		$i++;
	}
	echo "Done";

?>