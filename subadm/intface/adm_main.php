<?
session_start();
if (!isset($_SESSION['sess_fname'])) 
{
//if the session does not exit, then take the user to login page
header("Location:../../index.php#item1");
exit();
}

if(!$_SESSION['token'])
{
header("Location:../../index.php#item1");
exit();
}
?>
<html>

<head>
<title>Edge LMS</title>
<!--Code to prevent the caching of page-->
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<!-- -->
</head>

<frameset rows="92,*" frameborder="NO" border="1" width='800px' framespacing="0" cols="*"> 
  <frame name="HeaderPanel" scrolling="no" noresize src="adm_top.php">
<frameset cols="200,*" frameborder="NO" border="1" framespacing="0" cols="*"> 
  <frame name="leftPanel" scrolling="no"  noresize src="adm_left.php">
  <frame name="ContentPanel" scrolling="auto" noresize src="adm_cont.php">
</frameset>
</frameset>

<noframes> 
<body bgcolor="#FFFFFF" text="#000000">
</body>
</noframes> 
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->
</html>