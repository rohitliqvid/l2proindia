<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
$curCompId=$_REQUEST['cid'];

$result = mysql_query ("SELECT * FROM tbl_company where id='$curCompId'"); 
$num=mysql_numrows($result);
$catname=mysql_result($result,0,"company_name");
$catdesc=mysql_result($result,0,"company_desc");
$catlimit=mysql_result($result,0,"company_user_limit");
?>
<html>

<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Users > New user');">
<table width="100%" cellspacing="0" cellspacing="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="../userlist/default.php" target="_self" title="Go back">Back</a></td></tr>
 </table>
 <table width="800" cellspacing="0" class=''>
    <tr>
      <td valign="top">
	<table width="100%" border="0" cellpadding="6" cellspacing="5">
        <tr> 
          <td colspan="2" class="Content">No more users can be added to company <b>'<?=$catname?>'</b>. Total user limit for this company is <b><?=$catlimit?></b>.</td>
        </tr>
     
        
       
      </table>
	 </td>
	</tr>
</table>

</body>

</html>