<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}

$perms=$_SESSION['perms'];

include("../connect.php"); //Connection to database 
include("../global/functions.php"); 

//$catid=$_REQUEST['catid'];
$docid=$_REQUEST['docid'];
$currpage=trim($_GET['cp']);
$totalPages=trim($_GET['tp']);

$result = mysql_query ("SELECT * FROM tbl_courses where id=$docid"); 
$num=mysql_numrows($result);


$myId=mysql_result($result,0,"id");
$filetitle=mysql_result($result,0,"file_title");
$filedescription=mysql_result($result,0,"file_description");
$filename=mysql_result($result,0,"file_name");
$filesize=mysql_result($result,0,"file_size");
$filetype=mysql_result($result,0,"file_type");
$fileId=mysql_result($result,0,"FILE_CODE");

$fileLaunch=mysql_result($result,0,"file_launch");
$win_width=mysql_result($result,0,"win_width");
$win_height=mysql_result($result,0,"win_height");
$win_resize=mysql_result($result,0,"win_resize");
$win_scroll=mysql_result($result,0,"win_scroll");
$win_directory=mysql_result($result,0,"win_directory");
$win_location=mysql_result($result,0,"win_location");
$win_menu=mysql_result($result,0,"win_menu");
$win_tool=mysql_result($result,0,"win_tool");
$win_status=mysql_result($result,0,"win_status");

$filekeys=mysql_result($result,0,"file_keywords");
$uploadedby=mysql_result($result,0,"uploaded_by");
$uploadedby=getFullName($uploadedby);
$uploaddate=mysql_result($result,0,"upload_date");

$lresult = mysql_query ("SELECT * FROM tbl_courses_links WHERE course_id='$docid' order by id ASC"); 
$totalnum=mysql_numrows($lresult);
?>
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<script>
function openFile(docid,launchid,winWd,winHt,winRsz,winScl,winDir,winLoc,winMenu,winTool,winSts)
{

var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar='+winTool+',menubar='+winMenu+',resizable='+winRsz+',statusbar='+winSts+',scrollbars='+winScl+',location='+winLoc+',directories='+winDir;
//alert(settings);
var fpath="view.php?docid="+docid+"&launchid="+launchid;

var fileWin=window.open(fpath,'fwind',settings);
}
</script>
</HEAD>
<!-- -->
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">

<body topmargin="10" leftmargin="10" class='contentBG' onload="setPageTitle('Courses > <?=TrimString(ucfirst($filetitle))?>');">

<table width="100%" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1);" target="_self" title="Go back">Back</a></td></tr>
 </table>


<?
if(!$totalnum)
{
?>
<table width="100%" cellspacing="2" cellpadding="3">
  
	<tr height='40'><td colspan='2' valign='middle' class="content">No launch files specified for this course! Click the Back link to go back to Courses page.</td></tr>
</table>
<?
exit;
}	
?>
 <table width="100%" cellspacing="2" cellpadding="3">
  
	<tr height='40'><td colspan='2' valign='middle' class="content">This course has following launch files. Click on a launch link to launch the course.</td></tr>
	       
    <?
$i=0;
while ($i < $totalnum) {
$row = mysql_fetch_assoc($lresult);
$id = $row['id'];
$launchid=mysql_result($lresult,$i,"id");
$launchfile=mysql_result($lresult,$i,"file_launch");
	?>
	       

		<tr> 
          <td valign='top' width="12%" class="ContentBold">Launch link <?=($i+1)?>: </td>
          <td valign='top' class="content"><a onFocus='this.blur()' title="<?=$launchfile;?>" onMouseOver='return showStatus();' href="javascript:openFile(<?=$docid?>,<?=$launchid?>,<?=$win_width?>,<?=$win_height?>,<?=$win_resize?>,<?=$win_scroll?>,<?=$win_directory?>,<?=$win_location?>,<?=$win_menu?>,<?=$win_tool?>,<?=$win_status?>);"><?=$launchfile?></a></td>

        </tr>
<?
$i++;
		}
		?>
      </table>

	</td>
   </tr>
  </table>

</body>

<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->