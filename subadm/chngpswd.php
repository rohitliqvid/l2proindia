<html>

<link href="styles/styles.css" rel="stylesheet" type="text/css">



<link href="cal/themes/fancyblue.css" rel="stylesheet" type="text/css">
<style type="text/css">@import url(calendar-win2k-1.css);</style>	
<script type="text/javascript" src="cal/src/utils.js"></script>
<script type="text/javascript" src="cal/src/calendar.js"></script>
<script type="text/javascript" src="cal/lang/calendar-en.js"></script>
<script type="text/javascript" src="cal/src/calendar-setup.js"></script>

<script>
function ValidateChngPwd()
{
var paswd=document.pwdInfo.newPwd.value; 
var cpaswd=document.pwdInfo.cnfPwd.value; 
if (document.pwdInfo.newPwd.value=="")
{
alert("Please fill in the New Password field!");
document.pwdInfo.newPwd.focus();
return false;
}

if(paswd.length<6)
	{
	alert("Password can not be less then 6 characters.");
	document.pwdInfo.newPwd.focus();
	return false;
	}
if (document.pwdInfo.cnfPwd.value=="")
{
alert("Please fill in the Confirm Password field!");
document.pwdInfo.cnfPwd.focus();
return false;
}
if (paswd !=cpaswd)
{
alert("Your passwords do not match. Please try again!");
document.pwdInfo.cnfPwd.focus();
return false;
}

return true;
}

function goBack()
{
document.location.href="index.php";
}

function pageFocus()
{
document.pwdInfo.newPwd.focus();
}
</script>

<!--Code to prevent the caching of page-->
<HEAD>
<title>New Business e-learning Portal - Change Password?</title>
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
<form name="pwdInfo" onSubmit="return ValidateChngPwd();" action="submitchngpwd.php" method="post">

<table width="100%" height="70%" cellspacing="0" border='0'>
<tr>
<td align='center' valign='middle'>
<table width="453px" height='236px' border="0" cellpadding="5" cellspacing="6" class='pwdbox'>
<tr> 
<td colspan="3" class="ContentBold" align='center' style='padding-top:15px;'><font size="2"><u>Change Password?</u></font></td>
</tr>
<tr> 
 <td colspan="3" class="Content" align='center'>Please enter your New Password and click the Submit button.</td>
</tr>
 <tr> 
<td colspan="3" class="ContentBold" align='left' style='padding-left:20px'>New Password: <span class="mandatory">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="newPwd" class='inputcls' type="password" id="newPwd" size="40" maxlength="32"></td>
</tr>
<tr> 
<td colspan="3" class="ContentBold" align='left' style='padding-left:20px'>Confirm Password: <span class="mandatory">*</span>&nbsp;&nbsp;&nbsp;&nbsp;<input name="cnfPwd" type="password" id="cnfPwd" class='inputcls' size="40" maxlength="32" value=""></td>
</tr>
		   
         
     
<tr class="ContentBold"> 
<td height="60" colspan="3"><div align="center"> 
<!--<input type='button' class='submit_button_normal'  id='submituser' title='Go back' onclick='javascript:goBack();' value='Back'
onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">&nbsp;&nbsp;-->
<input type='submit' class='submit_button_normal'  id='submituser' title='Submit details' value='Submit' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">
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