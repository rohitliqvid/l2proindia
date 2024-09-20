<?
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 0);
if (isset($_SESSION['sess_fname'])) 
{
$uid=$_SESSION['sess_uid'];
session_unregister ($sess_fname); 
session_unregister ($sess_uid);
session_destroy (); 
}
include("global/functions.php");
include("connect.php"); //Connection to database 
$curdate=date('Y-m-d');

$result = mysql_query ("SELECT MAX(id) as id FROM tbl_entry_log where username='$uid'"); 
$num=mysql_numrows($result);
$USERID=mysql_result($result,0,"ID");
mysql_query("UPDATE tbl_entry_log SET user_exit_date='$curdate' where username='$uid' AND id=$USERID");
mysql_close();
?>
<html>
<head>
<title>New Business e-learning Portal</title>
</head>
<link href="styles/styles.css" rel="stylesheet" type="text/css">

<body class='contentBG' scroll='no'>
<table width='100%' height='100%'>
<tr><td valign='middle' align='center'>
<table width="70%" border="0" align='center' valign='middle' cellpadding="5" cellspacing="5" class="tblBorder2">
  <tr> 
    <td height="65" align='center' class="content">You have successfully logged out of the New Business e-learning Portal. Click the 'Login' link to log in to the Portal again.</td>
  </tr>
  
  <tr> 
    <td class='contentBold'><div align="center"><a onFocus='this.blur()' href="./" title="Login to Content Management System">Login</a></div></td>
  </tr>
</table>
</td></tr>
</table>
</body>
</html>