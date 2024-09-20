<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}
//Variable to hold the no of records in which the display is splitted
$pageSplit=10;
$perms=$_SESSION['perms'];
$catid=$_REQUEST['id'];


?>

<script>
function openFile(docid,winWd,winHt,winRsz,winScl,winDir,winLoc,winMenu,winTool,winSts)
{

var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar='+winTool+',menubar='+winMenu+',resizable='+winRsz+',statusbar='+winSts+'scrollbars='+winScl+',location='+winLoc+',directories='+winDir;

var fpath="view.php?docid="+docid;

var fileWin=window.open(fpath,'fwind',settings);
}
//function to ask user whether he wants to delete the course or not
function confirmDelete()
{

	var found=0;
	if(document.deletecourse.choice.length!=null)
	{

	for (i=0; i<document.deletecourse.choice.length; i++) 
		{ 
			if (document.deletecourse.choice[i].checked) 
			{ 
			found=1;
			break;
			}
		}

		if(found==0)
		{
		alert("Please select course(s) to delete.");
		return false;
		}
	}
else
{

	if (document.deletecourse.choice.checked) 
	{ 
	found=1;
	//break;
	}
	if(found==0)
	{
	alert("Please select course(s) to delete.");
	return false;
	}
}

if(document.deletecourse.choice.length!=null)
{
for (i=0; i<document.deletecourse.choice.length; i++) 
{ 
if (document.deletecourse.choice[i].checked) 
{
if (confirm("Are you sure you want to delete the selected courses?"))
{
return true;
}
else
{
return false;
}
}
}
}
else
{
if (document.deletecourse.choice.checked) 
{
if (confirm("Are you sure you want to delete the selected courses?"))
{
return true;
}
else
{
return false;
}
}
}
}

</script>

<link href="../../styles/styles.css" rel="stylesheet" type="text/css">
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->
<?

include("../../connect.php"); //Connection to database 
include("../../global/functions.php"); 


$result = mysql_query ("SELECT company_name, company_created_by FROM tbl_company where id='$catid'"); 
$category_name=mysql_result($result,0,"company_name");
$category_created_by=mysql_result($result,0,"company_created_by");

//get the status message if a new course has been uploaded
$successMsg=$_GET['msg'];

if (!isset($_GET['currpage'])) 
{
$currpage=0;
}
else
{
$currpage=$_GET['currpage'];
}
$startRecord=($currpage*$pageSplit);

//select all the courses from the database
$result = mysql_query ("SELECT * FROM tbl_company_COURSE as A, tbl_courses as B where A.course_id=B.id and A.company_id='$catid' ORDER BY B.upload_date ASC"); 
$totalnum=mysql_numrows($result);

$resultList = mysql_query ("SELECT * FROM tbl_courses as B, tbl_company_COURSE as A where A.course_id=B.id and A.company_id='$catid' ORDER BY B.upload_date ASC LIMIT $startRecord,$pageSplit"); 
$num=mysql_numrows($resultList);
$totalPages=ceil($totalnum/$pageSplit);
//mysql_close();

//if courses not found
if (!$num)
{
?>

<body topmargin="8">

<table width="100%" height="5%" cellpadding="2" cellspacing="2" bgcolor="#3372b4">
    <tr> 
      <td width="94%" class="instruction">Countries > <?=ucfirst($category_name)?> > Manage Courses</td>
      <td width="6%" class="ContentBold"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1);" target="_self"><font color='white'>Back</font></a></td>
    </tr>
  </table>

<br>
<table border="0" width="100%" bordercolor="#3372b4" cellspacing="0" cellpadding="4">
<tr><td class="ContentBold">Total courses available: <? echo $totalnum ?></td><td width='50%' align='right' class="ContentBold"><a onFocus='this.blur()' onMouseOver='return showStatus();' href='catlist.php'>Back to Countries</a></td></tr>
<table>

</body>

<?
exit();
}
?>

<body topmargin="8">

<form name="deletecourse" onSubmit="return confirmDelete();" action="delete_documents.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>&catid=<?=$catid?>" method="post">

<table width="100%" height="5%" cellpadding="2" cellspacing="2" bgcolor="#3372b4">
    <tr> 
      <td width="94%" class="instruction">Countries > <?=ucfirst($category_name)?> > Manage Courses</td>
      <td width="6%" class="ContentBold"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1);" target="_self"><font color='white'>Back</font></a></td>
    </tr>
  </table>

<p class="ContentBold"><? echo $successMsg ?></p>
<table border="0" width="100%" bordercolor="#3372b4" cellspacing="0" cellpadding="4">
<tr><td class="ContentBold">Total courses available: <? echo $totalnum ?></td><td width='50%' align='right' class="ContentBold"><a onFocus='this.blur()' onMouseOver='return showStatus();' href='catlist.php'>Back to Countries</a></td></tr>
<table>
<br>

<table border="1" width="100%" bordercolor="#3372b4" cellspacing="0" cellpadding="4">
<tr>
<?
if(($perms==1 && $category_created_by==$userid) || $userid=='admin')
	{
?>
<th width="3%" class="ContentBold">Select</th>
<?
	}	
?>
<th width="25%" class="ContentBold">Title</th>
<!--
<th width="15%" class="ContentBold">File Name</th>
-->

<th width="15%" class="ContentBold">Uploaded By</th>
<th width="10%" class="ContentBold">Date Uploaded</th>
<!--
<th width="5%" class="ContentBold">Hits</th>

<th width="5%" class="ContentBold">Versions</th>
-->
<th width="5%" class="ContentBold">View</th>
<!--
<th width="5%" class="ContentBold">Download</th>
-->
</tr>

<?
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($resultList);
$id = $row['id'];
$docid=mysql_result($resultList,$i,"id");
$categoryid=mysql_result($resultList,$i,"company_id");
$fileTitle=mysql_result($resultList,$i,"file_title");
//$versioninfo=mysql_result($resultList,$i,"version_info");
$fileDescription=mysql_result($resultList,$i,"file_description");
$fileName=mysql_result($resultList,$i,"file_name");
$fileSize=mysql_result($resultList,$i,"file_size");
$fileType=mysql_result($resultList,$i,"file_type");

$win_width=mysql_result($resultList,$i,"win_width");
$win_height=mysql_result($resultList,$i,"win_height");
$win_resize=mysql_result($resultList,$i,"win_resize");
$win_scroll=mysql_result($resultList,$i,"win_scroll");
$win_directory=mysql_result($resultList,$i,"win_directory");
$win_location=mysql_result($resultList,$i,"win_location");
$win_menu=mysql_result($resultList,$i,"win_menu");
$win_tool=mysql_result($resultList,$i,"win_tool");
$win_status=mysql_result($resultList,$i,"win_status");

$uploadedBy=mysql_result($resultList,$i,"uploaded_by");
$uploadedBy=getFullName($uploadedBy);
$uploadDate=mysql_result($resultList,$i,"upload_date");
$fileHits=mysql_result($resultList,$i,"file_hits");
$fileKeywords=mysql_result($resultList,$i,"file_keywords");


//mysql_close();
?>

<tr>
<?
if(($perms==1 && $category_created_by==$userid) || $userid=='admin')
	{
?>
<td align="center"><? echo "<input type='checkbox' id='choice' name='choice[]' value='$docid'>" ?></td>
<?
	}	
?>
<td class="Content"><? echo ucfirst(TrimString($fileTitle)); ?></td>
<!--
<td class="Content"><? //echo $fileName; ?></td>
-->

<td align="center" class="Content"><? echo ucfirst($uploadedBy); ?></td>
<td align="center" class="Content"><? echo parseDate($uploadDate); ?></td>
<!--
<td align="center" class="Content"><? echo $fileHits; ?></td>
-->
<!--
<td align="center" class="Content"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="versions.php?docid=<?=$docid?>&file_name=<?=$fileName;?>&id=<?=$catid?>"><img src='../../graphics/version1.gif' border='0'></a></td>
-->

<td align="center" class="Content"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:openFile(<?=$docid?>,<?=$win_width?>,<?=$win_height?>,<?=$win_resize?>,<?=$win_scroll?>,<?=$win_directory?>,<?=$win_location?>,<?=$win_menu?>,<?=$win_tool?>,<?=$win_status?>);"><img src='../../graphics/rpt.gif' border='0'></a></td>
<!--
<td align="center" class="Content"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="download.php?docid=<?=$docid?>&file_name=<?=$fileName;?>&catid=<?=$catid?>&curPage=<?=$currpage?>"><img src='../../graphics/download.png' border='0'></a></td>
-->
</tr>

<?
$i++;
}
echo "</table>";
echo "<br>";
?>

<div align="center" class="contentBold">

<?
if($currpage!=0)
{
?>

<a onFocus='this.blur()' onMouseOver='return showStatus();' href="documents.php?currpage=<? echo $currpage-1 ?>">Back</a>

<?
}
?>

<?
if($totalPages>1)
{
$pagenum;
$temp=ceil(($currpage+1)/5);
$tempstart=5*($temp-1)+1;
$tempend;

if($tempstart+$pageSplit>$totalPages)
{
$tempend=$totalPages;
}
else
{
$tempend=$tempstart+$pageSplit;
}

for($j=$tempstart;$j<=$tempend;$j++)
{
if($j==$currpage+1)
{
$pagenum="<font color='#000099'>".$j."</font>";
}
else
{
$pagenum=$j;
}
?>

<a onFocus='this.blur()' onMouseOver='return showStatus();' href="documents.php?currpage=<? echo $j-1 ?>"><?echo $pagenum ?></a>

<?
}
}
?>


<?
if($currpage+1<$totalPages)
{
?>

<a onFocus='this.blur()' onMouseOver='return showStatus();' href="documents.php?currpage=<? echo $currpage+1 ?>">Next</a>

<?
}
?>

</div>
<br>
<?
if(($perms==1 && $category_created_by==$userid) || $userid=='admin')
	{
?>
<div align="center"><input type='submit' class='submit_button_normal'  id='deleteuser' title='Delete course' value='&nbsp;Un-Assign&nbsp;' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';"></div>
<?
	}	
?>


<?
echo "</form>";
echo "</body>";
?>
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->