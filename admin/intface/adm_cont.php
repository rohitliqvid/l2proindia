<?php
session_start();

if(!$_SESSION['token'])
{
header("Location:../../index.php#item1");
exit();
}

if (!isset($_SESSION['sess_fname'])) 
{
header("Location:../../index.php#item1");
exit();
}
else
{
$fname = $_SESSION['sess_fname'];
}
$perms=$_SESSION['perms'];
include("../global/functions.php");
?>
<html>

<head>

<script>

//function to retrieve the value of user name from the query string. Not being used anymore.
//The value is maintained through session now.
/*function getQueryVariable(variable) {
  var query = top.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if (pair[0] == variable) {
      return pair[1];
    }
  } 
}
var fname=getQueryVariable("unm");*/

</script> 
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">

</head>

<body class='contentBG' topmargin='10' leftmargin='10'>
<?
if($perms=="1")
	{
		$role='Administrator';
	}
	else
	{
		$role='User';
	}
?>


<table width="100%" align='left' border="0" cellpadding="4">
  
  <tr> 
    <td class="contentBold">Hi <? echo $fname ?>, </td>
  </tr>

  <tr>
    <td class="content">You are logged in as Administrator on the English Edge. 
<br><br>
English Edge enables users to organize, control, search and view content.
<br><br>
As Administrator, you can use the Admin Panel interface to manage the content and users of English Edge. 
<br><br>
To continue, click any of the links in the left panel.
<br><br> 
</td>
  </tr>
</table>

</body>

</html>
