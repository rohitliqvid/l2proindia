<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
$catid=$_REQUEST['catid'];
include("../connect.php"); //Connection to database
include("../global/functions.php"); //Connection to database 

$result = mysql_query ("SELECT * FROM tbl_category where id='$catid'"); 
$num=mysql_numrows($result);

$catname=mysql_result($result,0,"category_name");

$catdesc=mysql_result($result,0,"category_desc");


?>
<html>
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->
<link href="../styles/styles.css" rel="stylesheet" type="text/css"> <body topmargin="8">
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<SCRIPT language="JavaScript" src="validate.js"></SCRIPT>
<script>
//function to clear all the input fields (not used)
function clearFields()
{
//
}

</script>



<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Course categories > <?=TrimStringMedium(ucfirst($catname))?>');">

<form name="categoryInfo" onSubmit="return ValidateCategoryInfo();" action="category_updcatinfo.php?catid=<?=$catid?>" method="post">


 <table width="100%" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1);" target="_self" title="Go back">Back</a></td></tr>
 </table>


  <table width="800" cellspacing="0" class=''>
    <tr>
      <td><table width="100%" border="0" cellpadding="3" cellspacing="5">
          <tr class="Content"> 
            <td colspan="3">Enter the information in the relevant text fields and click the Update button.</td>
          </tr>
          <tr> 
            <td class="ContentBold" width="22%" valign='top'>Category name: <span class="mandatory">*</span></td>
            <td width="34%"><input class='inputcls' name="catname" type="text" value='<?=ucfirst($catname)?>' id="catname" size="40" maxlength="250"></td>
            <td width="44%" class="Content" valign='top'>(Maximum 250 characters)</td>
          </tr>
          <tr> 
            <td class="ContentBold" valign='top'>Description:</td>
            <td>
			<TEXTAREA onKeyDown="textCounter(this.form.catdesc,this.form.remLen,1000);" onKeyUp="textCounter(this.form.catdesc,this.form.remLen,1000);" NAME="catdesc" class='inputcls' id="catdesc" COLS=42 ROWS=6><?=ucfirst($catdesc)?></TEXTAREA></td>
          <td class="Content" valign='top'>(Maximum 1,000 characters)</td>
          </tr>
          
          
          <tr class="ContentBold">
              <td colspan="3"><input readonly style='visibility:hidden;border:0px' type=text name=remLen size=2 maxlength=4 value="1000"></td>
          </tr>
          <tr class="ContentBold"> 
            <td colspan="3"><div align="center"> 
                <input type='button' class='submit_button_normal'  title='Cancel changes to category details and return to categories page' value='&nbsp;Cancel&nbsp;'
onmouseover="this.className='submit_button_over';" onClick="javascript:history.go(-1);" onmouseout ="this.className='submit_button_normal';">&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' class='submit_button_normal'  id='submituser' title='Replace old details of this category with new' value='&nbsp;Update&nbsp;'
onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">
              </div></td>
          </tr>
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