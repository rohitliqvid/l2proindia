<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}

include("../connect.php"); //Connection to database 
//$result = mysql_query ("SELECT * FROM tbl_company ORDER BY company_name ASC"); 
//$totalnum=mysql_numrows($result);

?>

<link href="../styles/styles.css" rel="stylesheet" type="text/css">

<head>
<script>
//function to clear the input search fields
function clearFields()
{
document.search.uname.value="";
document.search.utype.value="";
parent.listPanel.location.href='userlist.php';
}
</script>
</head>

<body class='contentBG' topmargin="10" leftmargin="10">

<form name="search" action="userlist.php" target="listPanel" method="post">

<table width="100%" cellspacing="0" cellpadding="4" class="tblBorder content" border='0'>
<tr height='10'><td colspan='4'></td></tr>
  <tr> 
    <td width='30%' valign="top">&nbsp;&nbsp;Search by Name:&nbsp;&nbsp;
      <input name="uname" class='inputcls' type="text" id="uname" size="25" maxlength="30"></td>
   
    
    <td width="30%" valign="top" >&nbsp;&nbsp;Search by User ID:&nbsp;&nbsp;
     <input name="utype" class='inputcls' type="text" id="utype" size="25" maxlength="30">
      </td>
 

		
      <td  coslpan='2' align='right' valign="top"><input type='submit' class='submit_button_normal'  style='height:22px' id='Go' title='Search users matching specified criteria' value='&nbsp;Go&nbsp;'
onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">&nbsp;&nbsp;<input type='button' class='submit_button_normal'  id='showall' title='Show all users' value='&nbsp;Show all users&nbsp;'
onmouseover="this.className='submit_button_over';" style='height:22px;width:110px' onclick='clearFields();' onmouseout ="this.className='submit_button_normal';">
      &nbsp;&nbsp; </td>
	  
	</tr>
	<tr height='10'><td colspan='4'></td></tr>
</table>

</form>

</body>