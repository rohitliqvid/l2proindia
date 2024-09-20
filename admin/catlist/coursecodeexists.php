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

<link href="../styles/styles.css" rel="stylesheet" type="text/css">

<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Courses > Add a course');">

  <table width="800" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1);" target="_self" title="Go back">Back</a></td></tr>
 </table>

 <table width="800" cellspacing="0" class='tblBorder'>
    <tr>
      <td valign="top">
	 <table width="100%" border="0" cellpadding="6" cellspacing="5">
        <tr> 
          <td width="176%" colspan="2" class="Content">This Course ID already exits!<br><br>Please enter a different Course ID. Click Back link to return or click any of the links on the left panel to continue.</td>
        </tr>
     
      </table>
	 </td>
	</tr>
</table>

</body>

</html>