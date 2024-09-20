<?php
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
$perms=$_SESSION['perms'];
$pageSplit=10;

?>

<script>

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
		alert("Please select a country to delete.");
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
	alert("Please select a country to delete.");
	return false;
	}
}

if(document.deletecourse.choice.length!=null)
{
for (i=0; i<document.deletecourse.choice.length; i++) 
{ 
if (document.deletecourse.choice[i].checked) 
{
if (confirm("Are you sure you want to delete the selected countries? Deleting the country will clear all the records for this country."))
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
if (confirm("Are you sure you want to delete the selected countries? Please note that only the empty countries will be deleted."))
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
$result = mysql_query ("SELECT * FROM tbl_company ORDER BY id ASC"); 
$totalnum=mysql_numrows($result);




$resultList = mysql_query ("SELECT * FROM tbl_company ORDER BY id ASC LIMIT $startRecord,$pageSplit"); 
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
    <td class="instruction">Countries</td>
  </tr>
</table>
<table border="0" width="100%" bordercolor="#3372b4" cellspacing="0" cellpadding="4">
<tr><td class="ContentBold">Total Countries: <? echo $totalnum ?></td><td width='20%' align='right' class="ContentBold">

<?

	if($perms=="1")
	{
?>
<a onFocus='this.blur()' onMouseOver='return showStatus();' href='../crtcategory/create.php'>Create New Country</a>
<?
	}
	else
	{
		echo "&nbsp;";
	}
?>

</td></tr>
<table>
</body>

<?
exit();
}
?>

<body topmargin="8">

<form name="deletecourse" onSubmit="return confirmDelete();" action="delete.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>" method="post">

<table width="100%" height="5%" cellpadding="2" cellspacing="2" bgcolor="#3372b4">
  <tr> 
    <td class="instruction">Countries</td>
  </tr>
</table>

<p class="ContentBold"><? echo $successMsg ?></p>
<table border="0" width="100%" bordercolor="#3372b4" cellspacing="0" cellpadding="4">
<tr><td class="ContentBold">Total countries: <? echo $totalnum ?></td><td width='20%' align='right' class="ContentBold">

<?

	if($perms=="1")
	{
?>
<a onFocus='this.blur()' onMouseOver='return showStatus();' href='../crtcategory/create.php'>Create New Country</a>
<?
	}
	else
	{
		echo "&nbsp;";
	}
?>

</td></tr>
<table>
<br>

<table border="1" width="100%" bordercolor="#3372b4" cellspacing="0" cellpadding="4">
<tr>
<?
	if($perms==1)
	{
?>
<th width="5%" class="ContentBold">Select</th>
<?
	}
?>
<th width="34%" class="ContentBold">Country Name</th>
<th width="15%" class="ContentBold">Created By</th>
<th width="7%" class="ContentBold">Users</th>
<th width="12%" class="ContentBold">Manage Users</th>
<th width="7%" class="ContentBold">Courses</th>
<th width="12%" class="ContentBold">Manage Courses</th>

</tr>

<?
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($resultList);
$id = $row['id'];

$catid=mysql_result($resultList,$i,"id");
$catname=mysql_result($resultList,$i,"company_name");
$createdby=mysql_result($resultList,$i,"company_created_by");
$createdbyfull=getFullName($createdby);

$totalUsers = mysql_query ("SELECT * FROM tbl_company_user WHERE company_id='$catid'"); 
$totalUsersNum=mysql_numrows($totalUsers);

$totalCourses = mysql_query ("SELECT * FROM tbl_company_Course WHERE company_id='$catid'"); 
$totalCoursesNum=mysql_numrows($totalCourses);
//mysql_close();
?>

<tr>
<?
	if($createdby==$userid || $userid=='admin')
	{
?>
<td align="center"><? echo "<input type='checkbox' id='choice' name='choice[]' value='$catid'>" ?></td>
<?
	}
else
	{
	if($perms==1)
		{
?>
<td align="center"><? echo "<input type='checkbox' id='choice' disabled name='choice[]' value='$catid'>" ?></td>
<?
		}	
}

?>

<td class="Content"><a onFocus='this.blur()' onMouseOver='return showStatus();' href='../crtcategory/catModify.php?catid=<?=$catid?>'><? echo TrimString(ucfirst($catname)) ?></a></td>


<td align='center' class="Content"><? echo $createdbyfull; ?></td>

<td align='center' class="Content"><?=$totalUsersNum?></td>

<td align="center" class="Content"><a onFocus='this.blur()' onMouseOver='return showStatus();' href='manageusers.php?id=<?=$catid?>'><font color='red' face='Trebuchet MS'>[ Manage Users]</font></a></td>
<td align='center' class="Content"><?=$totalCoursesNum?></td>


<td align="center" class="Content"><a onFocus='this.blur()' onMouseOver='return showStatus();' href='documents.php?id=<?=$catid?>'><font color='red' face='Trebuchet MS'>[ Manage Courses]</font></a></td>




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

<a onFocus='this.blur()' onMouseOver='return showStatus();' href="catlist.php?currpage=<? echo $currpage-1 ?>">Back</a>

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

<a onFocus='this.blur()' onMouseOver='return showStatus();' href="catlist.php?currpage=<? echo $j-1 ?>"><?echo $pagenum ?></a>

<?
}
}
?>


<?
if($currpage+1<$totalPages)
{
?>

<a onFocus='this.blur()' onMouseOver='return showStatus();' href="catlist.php?currpage=<? echo $currpage+1 ?>">Next</a>

<?
}
?>

</div>
<br>
<?
	if($perms==1)
	{
?>
<div align="center"><input type='submit' class='submit_button_normal'  id='deleteuser' title='Delete course' value='&nbsp;Delete&nbsp;' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';"></div>
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