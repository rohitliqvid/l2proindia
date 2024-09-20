<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
$catid=$_REQUEST['catid'];
?>


<?
include("../connect.php"); //Connection to database 
include("../global/functions.php"); 

$result = mysql_query ("SELECT * FROM tbl_company where id='$catid'"); 
$num=mysql_numrows($result);

$catname=mysql_result($result,0,"company_name");
$catdesc=mysql_result($result,0,"company_desc");
$catlimit=mysql_result($result,0,"company_user_limit");
$explimit=mysql_result($result,0,"company_user_expiry");
$catcreatedby=mysql_result($result,0,"company_created_by");
$catcreatedby=getFullName($catcreatedby);
$catkey=mysql_result($result,0,"company_address");

?>
<html>
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">

<body topmargin="10" leftmargin="10" class='contentBG' onload="setPageTitle('Countries > Country created successfully!');">


   <table width="100%" cellspacing="0" cellspacing="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="../catlist/catlist.php" target="_self" title="Go back">Back</a></td></tr>
 </table>


 <table width="800" cellspacing="0" class=''>
    <tr>
      <td valign="top">
	<table width="100%" border="0" cellpadding="6" cellspacing="5">
        <tr> 
          <td colspan="2" class="Content">New country created successfully with 
            the following information:</td>
        </tr>
     
        <tr> 
          <td width="25%" valign='top' class="ContentBold">Country name:</td>
          <td width="75%" valign='top' class="content"><? echo ucfirst($catname) ?></td>
        </tr>
        <tr> 
          <td class="ContentBold" valign='top'>Description:</td>
          <td class="content" valign='top'><? echo ucfirst($catdesc) ?></td>
        </tr>
     
		  <tr> 
          <td class="ContentBold" valign='top'>Keywords:</td>
          <td class="content" valign='top'><? echo ucfirst($catkey) ?></td>
        </tr>

		<tr> 
          <td class="ContentBold" valign='top'>User limit:</td>
          <td class="content" valign='top'><? echo $catlimit ?></td>
        </tr>
		<tr> 
          <td class="ContentBold" valign='top'>User expiry (in Days):</td>
          <td class="content" valign='top'><? echo $explimit ?></td>
        </tr>
    
        <tr> 
          <td colspan="2" class="Content">Click the Create new country link to create another country, or click any of the links in the left panel to continue.</td>
        </tr>
        <tr> 
          <td class="ContentBold" colspan='2'><div align="center"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="create.php" title="Create new country">Create new country</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="../catlist/catlist.php" title="View all countries">View all countries</a></div></td>
        </tr>
      
      </table>
	 </td>
	</tr>
</table>

</body>

</html>