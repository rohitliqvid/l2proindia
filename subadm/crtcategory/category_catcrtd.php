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

$result = mysql_query ("SELECT * FROM tbl_category where id='$catid'"); 
$num=mysql_numrows($result);

$catname=mysql_result($result,0,"category_name");
$catdesc=mysql_result($result,0,"category_desc");


?>
<html>

<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Course categories > Course category created successfully!');">
   <table width="100%" cellspacing="0" cellspacing="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="../catlist/categories.php" target="_self" title="Go back">Back</a></td></tr>
 </table>

 <table width="800" cellspacing="0" class=''>
    <tr>
      <td valign="top">
	<table width="100%" border="0" cellpadding="6" cellspacing="5">
        <tr> 
          <td colspan="2" class="Content">New category created successfully with 
            the following information:</td>
        </tr>
  
          <td width="15%" valign='top' class="ContentBold">Category name:</td>
          <td width="88%" valign='top' class="content"><? echo ucfirst($catname) ?></td>
        </tr>
        <tr> 
          <td class="ContentBold" valign='top'>Description:</td>
          <td class="content" valign='top'><? echo ucfirst($catdesc) ?></td>
        </tr>
     
	
        <tr> 
          <td colspan="2" class="Content">Click the Create new category link to create another category, or click any of the links in the left panel to continue.</td>
        </tr>
        <tr> 
          <td class="ContentBold" colspan='2'><div align="center"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="create_category.php" title='Create new course category'>Create new course category</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="../catlist/categories.php" title='View all course categories'>View all course categories</a></div></td>
        </tr>
   
      </table>
	 </td>
	</tr>
</table>

</body>

</html>