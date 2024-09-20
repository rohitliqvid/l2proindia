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

include("../../connect.php"); //Connection to database 
include("../../global/functions.php"); 

$cid=$_REQUEST['cid'];
$curPage=$_REQUEST['curPage'];

$cCategory=trim($_REQUEST['cCategory']);
$cContent=trim($_REQUEST['cContent']);
$cCode=trim($_REQUEST['cCode']);
$cTitle=trim($_REQUEST['cTitle']);
$cDesc=trim($_REQUEST['cDesc']);
$cKey=trim($_REQUEST['cKey']);

$cUserId=getUserId($userid);

$result = mysql_query ("SELECT * FROM tbl_user_course_pref WHERE user_id='$cUserId' AND course_id='$cid'"); 
$totalnum=mysql_numrows($result);

if($totalnum)
{
$win_width=mysql_result($result,0,"win_width");
$win_height=mysql_result($result,0,"win_height");
$win_resize=mysql_result($result,0,"win_resize");
$win_scroll=mysql_result($result,0,"win_scroll");
$win_directory=mysql_result($result,0,"win_directory");
$win_location=mysql_result($result,0,"win_location");
$win_menu=mysql_result($result,0,"win_menu");
$win_tool=mysql_result($result,0,"win_tool");
$win_status=mysql_result($result,0,"win_status");
}
else
{
$result1 = mysql_query ("SELECT * FROM tbl_courses where id='$cid'"); 
$totalnum1=mysql_numrows($result1);

$win_width=mysql_result($result1,0,"win_width");
$win_height=mysql_result($result1,0,"win_height");
$win_resize=mysql_result($result1,0,"win_resize");
$win_scroll=mysql_result($result1,0,"win_scroll");
$win_directory=mysql_result($result1,0,"win_directory");
$win_location=mysql_result($result1,0,"win_location");
$win_menu=mysql_result($result1,0,"win_menu");
$win_tool=mysql_result($result1,0,"win_tool");
$win_status=mysql_result($result1,0,"win_status");
}


	if($win_resize=='1')
	{
	$sResize='checked';
	}
	else
	{
	$sResize='';
	}

	
	if($win_scroll=='1')
	{
	$sScroll='checked';
	}
	else
	{
	$sScroll='';
	}

	
	if($win_directory=='1')
	{
	$sDirectory='checked';
	}
	else
	{
	$sDirectory='';
	}

	
	if($win_location=='1')
	{
	$sLocation='checked';
	}
	else
	{
	$sLocation='';
	}

	
	if($win_menu=='1')
	{
	$sMenubar='checked';
	}
	else
	{
	$sMenubar='';
	}


	if($win_tool=='1')
	{
	$sToolbar='checked';
	}
	else
	{
	$sToolbar='';
	}


	if($win_status=='1')
	{
	$sStatusbar='checked';
	}
	else
	{
	$sStatusbar='';
	}

	
?>
<html>
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<script>

function IsNumeric(strString)
  //  check for valid numeric strings	
   {
   var strValidChars = "0123456789";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (m = 0; m < strString.length && blnResult == true; m++)
      {
      strChar = strString.charAt(m);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
   return blnResult;
 }

 function Trim(s) 
{
  // Remove leading spaces and carriage returns
  while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
  {
    s = s.substring(1,s.length);
  }

  // Remove trailing spaces and carriage returns
  while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
  {
    s = s.substring(0,s.length-1);
  }
  return s;
}

function ValidateInfo()	
	{ 	
	
	if(Trim(document.docInfo.sWidth.value)=="")
	{
		alert("Please enter Launch window width!");
		document.docInfo.sWidth.value='';
		document.docInfo.sWidth.focus();
		return false;
	}	
	
	if(Trim(document.docInfo.sWidth.value)!="" && IsNumeric(document.docInfo.sWidth.value)==false)
	{
		alert("Please enter a numeric value for Launch window width!");
		document.docInfo.sWidth.value='';
		document.docInfo.sWidth.focus();
		return false;
	}	

	if(Trim(document.docInfo.sHeight.value)!="" && IsNumeric(document.docInfo.sHeight.value)==false)
	{
		alert("Please enter a numeric value for Launch window height!");
		document.docInfo.sHeight.value='';
		document.docInfo.sHeight.focus();
		return false;
	}	
	
	if(Trim(document.docInfo.sHeight.value)=="")
	{
		alert("Please enter Launch window height!");
		document.docInfo.sHeight.value='';
		document.docInfo.sHeight.focus();
		return false;
	}
	
}

</script>




</HEAD>

<!-- -->
<link href="../../styles/styles.css" rel="stylesheet" type="text/css"> <body topmargin="8">

<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Courses > Change view settings');">

<form method="post" enctype="multipart/form-data" name="docInfo" action="submit.php?upload=yes&from_page=<?=$from_page?>" onSubmit="return ValidateInfo();">
<input type="hidden" name="cid" value="<?=$cid?>">
<input type="hidden" name="cUserId" value="<?=$cUserId?>">

   <table width="800" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<?=$curPage?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" target="_self" title="Go back">Back</a></td></tr>
 </table>



  <table width="800" cellspacing="0" class='tblBorder'>
    <tr>
      <td><table width="100%" border="0" cellpadding="3" cellspacing="2">
    <tr>
						<td colspan='3' class="Content">&nbsp;</td>
          </tr>   		

						 <tr>
        
            <td width='25%' class="ContentBold" valign='top'>Stage size:</td>
            <td class='content'><input maxlength="4" name="sWidth" class='inputcls' type="text" style="width:50" value='<?=$win_width?>'> width&nbsp;&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;&nbsp;<input maxlength="4" name="sHeight" class='inputcls' type="text" style="width:50" value='<?=$win_height?>'> height</td>
            <td class="Content">&nbsp;</td>
          </tr>
		  	 <tr>

            <td class="ContentBold" valign='top'>Launch window settings:</td>
            <td class='content'><input type='checkbox' name='sResize' <?=$sResize?>>&nbsp;&nbsp;Allow the window to be resized<br><input type='checkbox' name='sScroll' <?=$sScroll?>>&nbsp;&nbsp;Allow the window to be scrolled<br><input type='checkbox' name='sDirectory' <?=$sDirectory?>>&nbsp;&nbsp;Show the directory links<br><input type='checkbox' name='sLocation' <?=$sLocation?>>&nbsp;&nbsp;Show the location bar
<br><input type='checkbox' name='sMenubar' <?=$sMenubar?>>&nbsp;&nbsp;Show the menu bar<br><input type='checkbox' name='sToolbar' <?=$sToolbar?>>&nbsp;&nbsp;Show the toolbar
<br><input type='checkbox' name='sStatusbar' <?=$sStatusbar?>>&nbsp;&nbsp;Show the status bar
<br></td>
            <td class="Content">&nbsp;</td>
          </tr>
						<tr>
						<td colspan='3' class="Content">&nbsp;</td>
          </tr>
						<tr>
						<td  valign="middle" align="center" colspan="3" height="20">
						
			
						
												
						<input type="button" class='submit_button_normal' onmouseover="this.className='submit_button_over';" title='Do not change settings – return to Courses page' onmouseout ="this.className='submit_button_normal';" name="cancle" value="Cancel" onClick="javascript:document.location='courses.php?currpage=<?=$curPage?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>';">&nbsp;&nbsp;<input type="submit" class='submit_button_normal' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';" title='Replace old view settings with new' name="update" value="Update">
								
				</td></tr>
         
        </table>
		</td>
    </tr>
 </table>

</form>

</body>

<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->

</html>