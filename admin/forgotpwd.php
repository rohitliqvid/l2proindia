<html>

<link href="styles/styles.css" rel="stylesheet" type="text/css">

<SCRIPT language="JavaScript" src="validate.js"></SCRIPT>

<link href="cal/themes/fancyblue.css" rel="stylesheet" type="text/css">
<style type="text/css">@import url(calendar-win2k-1.css);</style>	
<script type="text/javascript" src="cal/src/utils.js"></script>
<script type="text/javascript" src="cal/src/calendar.js"></script>
<script type="text/javascript" src="cal/lang/calendar-en.js"></script>
<script type="text/javascript" src="cal/src/calendar-setup.js"></script>

<script>
//function to clear the user input fiels (not used)
function clearFields()
{
//document.userInfo.fnm.value="";
//document.userInfo.lnm.value="";
//document.userInfo.uid.value="";
//document.userInfo.pwd.value="";
//document.userInfo.cpwd.value="";
}

function goBack()
{
document.location.href="index.php";
}

function pageFocus()
{
document.pwdInfo.email.focus();
}
</script>

<!--Code to prevent the caching of page-->
<HEAD>
<title>New Business e-learning Portal - Forgot Password?</title>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->

<body topmargin="0" onLoad="javascript:pageFocus();" class='' scroll='no'>

<table width="100%" cellspacing="0">
<tr><td align='center'>
<img src='graphics/banner.jpg' border='0'>
</td></tr>
</table>
<form name="pwdInfo" onSubmit="return ValidatePwd();" action="submitpwd.php" method="post">

  <table width="100%" height="70%" cellspacing="0">
    <tr>
      <td align='center' valign='middle'><table width="453px" height='236px' border="0" cellpadding="5" cellspacing="6" class='pwdbox'>
          <tr> 
            <td colspan="3" class="ContentBold" align='center' style='padding-top:15px;'><font size="2"><u>Forgot Password?</u></font></td>
          </tr>
          <tr> 
            <td colspan="3" class="Content" align='center'>Please enter your User ID and Date of Birth and click the Submit button.</td>
          </tr>
           <tr> 
            <td colspan="3" class="ContentBold" align='left' style='padding-left:20px'>User ID: <span class="mandatory">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="email" class='inputcls' type="text" id="email" size="40" maxlength="200"></td>
            
          </tr>
		  <tr> 
            <td colspan="3" class="ContentBold" align='left' style='padding-left:20px'>Date of Birth: <span class="mandatory">*</span>&nbsp;&nbsp;<input name="dob" type="text" id="dob" class='inputcls' size="34" maxlength="20" onfocus="this.blur();" value=""> <img src='cal/cal.gif' name="trigger1" align="absmiddle" id='trigger1'></td>
            
          </tr>
		   
         
     
          <tr class="ContentBold"> 
            <td height="60" colspan="3"><div align="center"> 
				<input type='button' class='submit_button_normal'  id='submituser' title='Go back' onclick='javascript:goBack();' value='Back'
onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">&nbsp;&nbsp;<input type='submit' class='submit_button_normal'  id='submituser' title='Submit details' value='Submit'
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
<script>
 Zapatec.Calendar.setup(
    {
      inputField  : "dob",       // ID of the input field
      ifFormat    : "%m/%d/%Y",    // the date format
      button      : "trigger1"       // ID of the button
    }
  );
  </script>