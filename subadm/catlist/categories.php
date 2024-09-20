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
$perms=$_SESSION['perms'];
//$pageSplit=5;

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
		alert("Please select companies to delete.");
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
	alert("Please select companies to delete.");
	return false;
	}
}

if(document.deletecourse.choice.length!=null)
{
for (i=0; i<document.deletecourse.choice.length; i++) 
{ 
if (document.deletecourse.choice[i].checked) 
{
if (confirm("Are you sure you want to delete the selected categories? Please note that only the empty categories wiil be deleted."))
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
if (confirm("Are you sure you want to delete the selected categories? Please note that only the empty categories wiil be deleted."))
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

//get the status message if a new course has been uploaded
$successMsg=$_GET['msg'];

$cTitle=trim($_REQUEST['cTitle']);
$cDesc=trim($_REQUEST['cDesc']);
$cKey=trim($_REQUEST['cKey']);

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
$result = mysql_query ("SELECT * FROM tbl_category order by id ASC"); 
$totalnum=mysql_numrows($result);

$resultList = mysql_query ("SELECT * FROM tbl_category order by id ASC LIMIT $startRecord,$pageSplit"); 
$num=mysql_numrows($resultList);
$totalPages=ceil($totalnum/$pageSplit);
//mysql_close();

//if courses not found
if (!$num)
{
?>

<body topmargin="10" leftmargin="10" class='contentBG' onload="setPageTitle('Course categories');">


<table border="0" width="100%" cellspacing="0" cellpadding="4">
<tr><td class="ContentBold">Total course categories: <? echo $totalnum ?></td><td width='30%' align='right' class="ContentBold">

<?

	if($perms=="1")
	{
?>
<a onFocus='this.blur()' onMouseOver='return showStatus();' href='../crtcategory/create_category.php' title="Create new course category">Create new course category</a>
<?
	}
	else
	{
		echo "&nbsp;";
	}
?>

</td></tr>
<tr><td class="Content">Course categories not available!</td></tr>
</table>
</body>

<?
exit();
}
?>

<body topmargin="10" leftmargin="10" class='contentBG' onload="setPageTitle('Course categories');">


<form name="deletecourse" onSubmit="return confirmDelete();" action="delete_category.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>&trec=<?=$totalnum?>" method="post">
<table border="0" width="100%" cellspacing="0" cellpadding="4">
<tr><td class="ContentBold">Total course categories: <? echo $totalnum ?></td><td width='30%' align='right' class="ContentBold">

<?

	if($perms=="1")
	{
?>
<a onFocus='this.blur()' onMouseOver='return showStatus();' href='../crtcategory/create_category.php' title="Create new course category">Create new course category</a>
<?
	}
	else
	{
		echo "&nbsp;";
	}
?>

</td></tr>
<tr><td class='content' colspan='2'>This page lists the categories of courses available in LMS. To delete a category, select the check box next to that category and click the Delete button. To change the details of courses in a category, click the Manage courses link for that category. To create a new course category, click the Create new course category link.</td></tr>
</table>
<br>

<table width="100%" class='tblBorder2' cellspacing="0" border='0' cellpadding="4">
<tr class="tblTitle contentWhite">
<?
	if($perms==1)
	{
?>
<th width="5%"><input type='checkbox' name='checkall' onclick='checkedAll(deletecourse);'></th>
<?
	}
?>
<th width='50%' align='left'>Course category name</th>
<th width="15%" align='center'>Courses</th>
<th width="30%" align='center'>Manage courses</th>
</tr>

<?
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($resultList);
$id = $row['id'];

$catid=mysql_result($resultList,$i,"id");
$catname=mysql_result($resultList,$i,"category_name");


$totalCourses = mysql_query ("SELECT * FROM tbl_category_course WHERE category_id='$catid'"); 
$totalCoursesNum=mysql_numrows($totalCourses);
//mysql_close();

if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";
?>

<tr class="<?=$bgc?>">
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

<td class="Content"><a a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href='../crtcategory/category_catModify.php?catid=<?=$catid?>' title="<?=ucfirst($catname);?>"><? echo TrimStringMedium(ucfirst($catname)) ?></a></td>


<td align='center' class="Content"><?=$totalCoursesNum?></td>
<td align="center" class="Content"><a onFocus='this.blur()' onMouseOver='return showStatus();' href='documents.php?currpage=<?=$currpage?>&id=<?=$catid?>' title="Manage courses"><font color='#4c4c4c' face='Arial'>[ Manage courses ]</font></a></td>

</tr>

<?
$i++;
}
echo "</table>";

?>

<table width="100%"  cellspacing="0" cellpadding="3">
<tr height='5px'><td></td></tr>
<tr><td align='center' class='contentBold'>

<?
if($currpage!=0)
{
?>
<a onFocus='this.blur()' onMouseOver='return showStatus();' href="categories.php?currpage=0" title="First page">First page</a>

<?
}
?>

<?
if($currpage!=0)
{
?>

&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="categories.php?currpage=<? echo $currpage-1 ?>" title="Previous page">Previous page</a>

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
$pagenum="<font color='#666666'>".$j."</font>";
?>
&nbsp;&nbsp;<?echo $pagenum ?>
<?
}
else
{
$pagenum=$j;
?>
&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="categories.php?currpage=<? echo $j-1 ?>" title="<?=$pagenum?>"><?echo $pagenum ?></a>
<?
}
?>



<?
}
}
?>


<?
if($currpage+1<$totalPages)
{
?>

&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="categories.php?currpage=<? echo $currpage+1 ?>" title="Next page">Next page</a>

<?
}
?>

<?
if($currpage+1<$totalPages)
{
?>

&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="categories.php?currpage=<? echo $totalPages-1 ?>" title="Last page">Last page</a>
<?
}	
?>


</td></tr>
<tr height='5px'><td></td></tr>
<tr><td>
<?
	if($perms==1)
	{
?>
<div align="center"><input type='submit' class='submit_button_normal'  id='deleteuser' title='Delete category' value='&nbsp;Delete&nbsp;' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';"></div>
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