<? 

header('location:../index.php');
exit;

include("global/functions.php");
?>

<html>
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></HEAD>
<!-- -->
<title>L2Pro India</title>
<style type="text/css">
body
{
	background-attachment: fixed;
	background-image: url('');
	background-repeat: no-repeat;
	background-position: left top;
}
.style1 {color: #000099}
</style>

<link href="styles/styles.css" rel="stylesheet" type="text/css">

<script>
//function to clear the login/password input fields

/*if(document.location!="http://www.CMS.com/edge-cms/")
{
document.location.href="http://www.CMS.com/edge-cms/";
}*/

if(top.location!=document.location.href)
{
top.location=document.location.href;
}

function clearFields()
{
document.login.uid.value="";
document.login.pwd.value="";
}

function setFocus()
{
document.login.uid.focus();
}

function showAlert()
{
alert("This feature is currently not available!");
}
function openLoginHelp()
{
/*var winWd,winHt,winSc;
winWd=720;

winHt=500;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars='+winSc+',location=no,directories=no';
var fpath='admin/help/Help-Login.htm';

var fileWin=window.open(fpath,'fhelp',settings);
*/
alert("This feature is currently under construction!");
}
</script>

<body scroll='no' onLoad="javascript:clearFields();setFocus();" topmargin='2'>
<table width="1022" height="100%" align='center' border='0' valign='middle'>
<tr>
<td align='center' width='334px'>&nbsp;</td>
<td align='right' style='padding-top:190px' valign='top' width='352px'> 
<form name="login" action="loginchk.php" method="post">
<table width="100%" align='center' border='0' valign='top' height='161px' class=''>
	<tr><td  height="10" colspan='5'></td></tr>
	<tr> 
      <td  height="30" class="ContentBold" width='30px'>&nbsp;</td>
      <td  class="ContentBold" width='80px'>User ID:</td>
      <td  colspan="3"><input type="text" class='inputclslogin' name="uid"></td>
	
    </tr>
    <tr> 
      <td height="30" class="ContentBold">&nbsp;</td>
      <td height="30" class="ContentBold">Password:</td>
      <td colspan="3"><input type="password" class='inputclslogin' maxlength='32' name="pwd"></td>
     
    </tr>
	<tr> 
      <td colspan='2' height="30" class="ContentBold">&nbsp;</td>
      <td colspan='3' class="ContentBold" style='padding-left:16px;padding-top:5px;'><INPUT TYPE="image" SRC="graphics/login.png" BORDER="0" ALT="Login to Content Management System"></td>
    </tr>

		<tr> 
      <td colspan='5' height="30" align='center' class="ContentBold"><a onFocus='this.blur()' href="forgotpwd.php" target="_self" title="Forgot Password and/or User ID?" class='loginitems'><!--Forgot Password and/or User ID?</a>&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp<a onFocus='this.blur()' href="javascript:openLoginHelp();" target="_self" title="Help" class='loginitems'>Help</a>--></td>
      
    </tr>

	 
  </table>
  </form>
  </td>
<td align='right' valign='top' width='334px' style='padding-top:210px' >
<table width='260px' align='right' border='0' valign='top' height='164px'>
<tr><td height='30px' class='contentItaWhite'>&nbsp;</td></tr>
<tr><td class='contentItaWhite' valign='top' style='padding-left:0px;padding-top:4px;padding-right:24px;'></td></tr>
</table>

</td>
</tr>

<tr height='20px'><td class='contentGray'>&nbsp;</td><td>&nbsp;</td><td align='right' class='contentGray'><a href='#' onclick='showAlert();' class='loginitems'>&nbsp;</a></td></tr>
 </table>
 


</body>
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->
</html>
