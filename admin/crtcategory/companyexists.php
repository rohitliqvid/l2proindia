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
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">

<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Countries > Create new country');">

 <table width="100%" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1);" target="_self" title="Go back">Back</a></td></tr>
 </table>

 <table width="800" cellspacing="0" class=''>
    <tr>
      <td valign="top">
	 <table width="100%" border="0" cellpadding="6" cellspacing="5">
        <tr> 
          <td width="176%" colspan="2" class="Content">This Country name already exits!<br><br>Please enter a different Country name.
            Click Back link to return or click any of the links on the left panel to continue.</td>
        </tr>
    
      </table>
	 </td>
	</tr>
</table>

</body>

</html>