<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../global/functions.php");
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
////Commmented to retain the values when the user returns back to modify the details
//document.userInfo.fnm.value="";
//document.userInfo.lnm.value="";
//document.userInfo.uid.value="";
//document.userInfo.pwd.value="";
//document.userInfo.cpwd.value="";
}


</script>



<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Course categories > Create new course category');">

<form name="categoryInfo" onSubmit="return ValidateCategoryInfo();" action="category_sbmtinfo.php" method="post">

  <table width="100%" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1);" target="_self" title="Go back">Back</a></td></tr>
 </table>



  <table width="800" cellspacing="0" class=''>
    <tr>
      <td><table width="100%" border="0" cellpadding="3" cellspacing="5">
          <tr class="Content"> 
            <td colspan="3">Enter the information in the relevant fields and click the Create button. To clear all fields and enter fresh details, click the Reset button.</td>
          </tr>
          <tr> 
            <td class="ContentBold" width="22%" valign='top'>Category name: <span class="mandatory">*</span></td>
            <td width="34%"><input class='inputcls' name="catname" type="text" id="catname" size="40" maxlength="250"></td>
            <td width="44%" class="Content" valign='top'>(Maximum 250 characters)</td>
          </tr>
          <tr> 
            <td class="ContentBold" valign='top'>Description:</td>
            <td>
			<TEXTAREA onKeyDown="textCounter(this.form.catdesc,this.form.remLen,1000);" onKeyUp="textCounter(this.form.catdesc,this.form.remLen,1000);" NAME="catdesc" class='inputcls' id="catdesc" COLS=42 ROWS=6></TEXTAREA></td>
           <td class="Content" valign='top'>(Maximum 1,000 characters)</td>
          </tr>
          
              
          <tr class="ContentBold">
            <td colspan="3"><input readonly style='visibility:hidden;border:0px' type=text name=remLen size=2 maxlength=4 value="1000"></td>
          </tr>
          <tr class="ContentBold"> 
            <td colspan="3"><div align="center"> 
                <input type='reset' class='submit_button_normal'  id='reset' title='Clear all fields to enter fresh information' value='&nbsp;&nbsp;Reset&nbsp;&nbsp;'
onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">&nbsp;&nbsp;
				<input type='submit' class='submit_button_normal'  id='submituser' title='Create new category' value='&nbsp;Create&nbsp;'
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