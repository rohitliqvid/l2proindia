<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}
//Variable to hold the no of records in which the display is splitted
//$pageSplit=5;
$perms=$_SESSION['perms'];
$catid=$_REQUEST['id'];
$currpage=$_REQUEST['currpage'];


?>

<script>
function openFile(docid,winWd,winHt,winRsz,winScl,winDir,winLoc,winMenu,winTool,winSts)
{

var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar='+winTool+',menubar='+winMenu+',resizable='+winRsz+',statusbar='+winSts+',scrollbars='+winScl+',location='+winLoc+',directories='+winDir;

var fpath="view.php?docid="+docid;

var fileWin=window.open(fpath,'fwind',settings);
fileWin.focus();
}

function openFileZip(docid,launchid,winWd,winHt,winRsz,winScl,winDir,winLoc,winMenu,winTool,winSts)
{

var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar='+winTool+',menubar='+winMenu+',resizable='+winRsz+',statusbar='+winSts+',scrollbars='+winScl+',location='+winLoc+',directories='+winDir;
//alert(settings);
var fpath="view.php?docid="+docid+"&launchid="+launchid;

var fileWin=window.open(fpath,'fwind',settings);
fileWin.focus();
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


checked=false;
function checkedAll (frm1) {
	var aa= document.getElementById('deletecourse');
	 if (checked == false)
          {
           checked = true
          }
        else
          {
          checked = false
          }
	for (var i =0; i < aa.elements.length; i++) 
	{
	 aa.elements[i].checked = checked;
	}
      }

function getCourse(rowId,file)
{
document.location.href="../../courses/"+rowId+"/"+file;
}

function getPackage(file)
{
document.location.href="../../courses/download/"+file;
}
</script>
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->
<?

include("../connect.php"); //Connection to database 
include("../global/functions.php"); 


$result = mysql_query ("SELECT category_name FROM tbl_category where id='$catid'"); 
//echo "SELECT category_name FROM tbl_category where id='$catid'";

$category_name=mysql_result($result,0,"category_name");


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
//echo "SELECT * FROM tbl_category_course as A, tls_scorm as B where A.course_id=B.course and A.category_id='$catid'";
//$resultList = mysql_query ("SELECT * FROM tbl_category_course as A, tls_scorm as B where A.course_id=B.course and A.category_id='$catid'"); 
$resultList = mysql_query ("SELECT * FROM tls_scorm order by name asc"); 
$num=mysql_numrows($resultList);

//$resultList = mysql_query ("SELECT * FROM tbl_category_course as A, tbl_courses as B where A.course_id=b.id and A.category_id='$catid' ORDER BY B.upload_date ASC LIMIT $startRecord,$pageSplit"); 
//$num=mysql_numrows($resultList);
//$totalPages=ceil($totalnum/$pageSplit);
//mysql_close();

//if courses not found
if (!$num)
{
?>

<body topmargin="10" leftmargin="10" class='contentBG' onload="setPageTitle('Course categories > <?=TrimString(ucfirst($category_name));?> > Manage courses');">


 <table width="100%" cellspacing="0" cellspacing="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="categories.php?currpage=<?=$currpage?>" target="_self" title="Go back">Back</a></td></tr>
 </table>




<table border="0" width="100%" cellspacing="0" cellpadding="4">
<tr><td class="ContentBold">Total courses available: <? echo $num ?></td><td width='50%' align='right' class="ContentBold">&nbsp;</td></tr>
<tr><td class='content' colspan='2'>No courses available in this category!</td></tr>
<table>

</body>

<?
exit();
}
?>

<body topmargin="10" leftmargin="10" class='contentBG' onload="setPageTitle('Course categories > <?=TrimString(ucfirst($category_name));?> > Manage courses');">

<form name="deletecourse" action="assign_documents.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>&catid=<?=$catid?>" method="post">

 <table width="100%" cellspacing="0" cellspacing="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="categories.php?currpage=<?=$currpage?>" target="_self" title="Go back">Back</a></td></tr>
 </table>


<table border="0" width="100%" cellspacing="0" cellpadding="4">
<tr><td class="ContentBold">Total courses available: <? echo $num ?></td><td width='50%' align='right' class="ContentBold">&nbsp;</td></tr>
<tr><td class='content' colspan='2'>To assign/unassign a course, select the check box for that course and click the Assign button.</td></tr>
<table>
<br>

<table width="100%" class='tblBorder2' cellspacing="0" cellpadding="4">
<tr class="tblTitle contentWhite">
<?
if(($perms==1 && $category_created_by==$userid) || $userid=='admin')
	{
?>
<th width="30" align='left'><input type='checkbox' name='checkall' onclick='checkedAll(deletecourse);'></th>
<?
	}	
?>

<th width="570" align='left'>Title</th>

</tr>

<?
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($resultList);
$id = $row['id'];
$docid=mysql_result($resultList,$i,"course");

//$categoryid=mysql_result($resultList,$i,"company_id");
$fileTitle=mysql_result($resultList,$i,"name");
$fileId=mysql_result($resultList,$i,"file_code");

$checkResult = mysql_query ("SELECT * FROM tbl_category_course where category_id=$catid and course_id=$docid"); 
$checkNum=mysql_numrows($checkResult);
$tempString="";
if($checkNum)
{
$tempString='checked';
}
else
{
$tempString="";
}


//mysql_close();
?>

<tr>
<?
if(($perms==1 && $category_created_by==$userid) || $userid=='admin')
	{
?>
<td align="left"><? echo "<input type='checkbox' ".$tempString." id='choice' name='choice[]' value='$docid'>" ?></td>
<?
	}	
?>


<td class="Content"><? echo ucfirst(TrimStringCourseTitleBig($fileTitle)); ?></td>


</tr>

<?
$i++;
}
echo "</table>";

?>

<table width="100%"  cellspacing="0" cellpadding="3">

<tr height='5px'><td></td></tr>
<tr><td>
<?
if(($perms==1 && $category_created_by==$userid) || $userid=='admin')
	{
?>
<div align="center"><input type='submit' class='submit_button_normal'  id='deleteuser' title='Assign course' value='&nbsp;Assign&nbsp;' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';"></div>
<?
	}	
?>

</td></tr>
</table>
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