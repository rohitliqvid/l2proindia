<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
?>
<html>

<link href="../styles/styles.css" rel="stylesheet" type="text/css">

<body topmargin="9">

 <table width="100%" cellspacing="0" class='tblBorder'>
    <tr>
      <td valign="top">
	 <table width="100%" border="0" cellpadding="6" cellspacing="5">
        <tr> 
          <td width="176%" colspan="2" class="ContentBold">User ID already exits!<br>Plese select another User ID.
            Click Back link to return or click any of the links on the left panel to continue.</td>
        </tr>
        <tr> 
          <td height="31" colspan="2" class="ContentBold"><div align="center"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1)">Back</a></div></td>
        </tr>
        <tr>
          <td height="259" colspan="2" class="ContentBold">&nbsp;</td>
        </tr>
      </table>
	 </td>
	</tr>
</table>

</body>

</html>