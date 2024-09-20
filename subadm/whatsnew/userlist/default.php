<?
session_start();
if (!isset($_SESSION['sess_fname'])) 
{
header("Location: ../");
exit();
}
include("../global/functions.php"); 
?>

<html>

<head>
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<title>User list</title>
</head>

<frameset rows="72,*" frameborder="NO" border="1" framespacing="0" cols="*"  onload="setPageTitle('Users');"> 
    <frame name="searchPanel" scrolling="no" noresize src="srchtop.php">
  <frame name="listPanel" scrolling="no" noresize src="userlist.php">
</frameset>
</frameset>

<noframes> 
<body bgcolor="#FFFFFF" text="#000000">
</body>
</noframes> 

</html>