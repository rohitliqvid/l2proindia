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
$pageSplit=10;
$perms=$_SESSION['perms'];
$docid=$_REQUEST['docid'];
$from_page=$_REQUEST['from_page'];

$currpage=trim($_GET['cp']);
$totalPages=trim($_GET['tp']);

$cCategory=trim($_REQUEST['cCategory']);
$cContent=trim($_REQUEST['cContent']);
$cCode=trim($_REQUEST['cCode']);
$cTitle=trim($_REQUEST['cTitle']);
$cDesc=trim($_REQUEST['cDesc']);
$cKey=trim($_REQUEST['cKey']);

?>

<script>
function validatePublish()
{

var found=0;
	if(document.publishdoc.choice.length!=null)
	{

	for (i=0; i<document.publishdoc.choice.length; i++) 
		{ 
			if (document.publishdoc.choice[i].checked) 
			{ 
			found=1;
			break;
			}
		}

		if(found==0)
		{
		alert("Please select companies!");
		return false;
		}
	}
else
{

	if (document.publishdoc.choice.checked) 
	{ 
	found=1;
	//break;
	}
	if(found==0)
	{
	alert("Please select companies!");
	return false;
	}
}
}

checked=false;
function checkedAll (frm1) {
	var aa= document.getElementById('publishdoc');
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


//select all the courses from the database
$result = mysql_query ("SELECT * FROM tbl_category ORDER BY category_name ASC"); 
$num=mysql_numrows($result);
//echo $totalnum;
//exit;
//mysql_close();

//if courses not found
if (!$num)
{
?>

<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Courses > Assign');">

<table width="100%" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<?=$currpage?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" target="_self" title="Go back">Back</a></td></tr>
 </table>

<br>
<table border="0" width="100%" cellspacing="0" cellpadding="4">
<tr><td class="Content">No categories available to assign the course.</td><td width='50%' align='right' class="ContentBold">&nbsp;</td></tr>
<table>

</body>

<?
exit();
}
?>

<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Courses > Assign');">

<form name="publishdoc" onSubmit="" action="publish_submit.php?docid=<?=$docid?>" method="post">

<table width="100%" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<?=$currpage?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" target="_self" title="Go back">Back</a></td></tr>
 </table>


<table border="0" width="100%" cellspacing="0" cellpadding="4">
<tr><td class="Content" >Select the categories to which you want to assign this course and click the Assign button.</td></tr>
<table>
<br>

<table width="100%" class='tblBorder2' cellspacing="0" border='0' cellpadding="4">
<tr class="tblTitle contentWhite">

<th width="5%" align='left'><input type='checkbox' name='checkall' onclick='checkedAll(publishdoc);'></th>

<th width="35%" align="left">Category name</th>
<th width="60%" align="left">Description</th>

</tr>

<?
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($result);
$id = $row['id'];
$catid=mysql_result($result,$i,"id");
$category_name=mysql_result($result,$i,"category_name");
$category_desc=mysql_result($result,$i,"category_desc");
//mysql_close();
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
//echo $tempString;
if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";
?>

<tr class="<?=$bgc?>">

<td valign='top'><? echo "<input type='checkbox' ".$tempString." id='choice' name='choice[]' value='$catid'>" ?></td>

<td align="left" valign='top'class="Content"><a a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href='document_uploaded.php?docid=<?=$docid?>&catid=<?=$catid?>' title="<?=ucfirst($category_name);?>"><? echo TrimString(ucfirst($category_name)); ?></td>
<td align="left" valign='top' class="Content">
	<? 
	if($category_desc!="") 
	{ 
	echo ucfirst($category_desc);
	} 
	else 
	{ 
	echo "&nbsp;";
	} 
	?></td>

</tr>

<?
$i++;
}
echo "</table>";

?>


<br>
<div align="center"><input type='submit' class='submit_button_normal'  id='btnpublishdoc' name='btnpublishdoc' title='Assign to categories' value='&nbsp;Assign&nbsp;' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';"></div>

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