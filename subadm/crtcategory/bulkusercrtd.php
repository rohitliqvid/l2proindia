<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
include("../global/functions.php"); //Connection to database 
?>
<html>
<script>
function showReport()
{
var winWd=750;
var winHt=550;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no';
var fpath="bulkcompreport.php";
var logwin=window.open(fpath,'bulkrpt',settings);
logwin.focus();
}
</script>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">

<body class='contentBG' topmargin="10" leftmargin="10">
<table width="100%" cellspacing="0" cellspacing="3">
 <tr height='23px'><td class='contentBold'>Countries > Bulk Upload</td><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="../catlist/catlist.php" target="_self" title="Go back">Back</a></td></tr>
 </table>
 <br><br>
 <table width="100%" cellspacing="0" class='tblBorder2'>
    <tr>
      <td valign="top">


	<table width="100%" border="0" cellpadding="6" cellspacing="5">
        
	<tr> 
          <td colspan="2" class="Content">Countries created successfully! Click on View Report link to view the list of countries created.</td>
        </tr>
     
        <tr> 
          <td colspan="2" class="ContentBold"><div align="center"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:showReport();" title="View Report">View Report</a></div></td>
        </tr>
       
      </table>

	 </td>
	</tr>
</table>

</body>

</html>