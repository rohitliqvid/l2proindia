<?
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
$userid = $_SESSION['sess_uid'];
$fname = $_SESSION['sess_fname'];
}
$perms=$_SESSION['perms'];
include("../../connect.php");
include("../../global/functions.php");
$isUpdaetd=isUserUpdated($userid);

?>
<html>

<head>


<SCRIPT language="JavaScript" src="../../global/global.js"></SCRIPT>
<link href="../../styles/styles.css" rel="stylesheet" type="text/css">

</head>

<body class='contentBG' topmargin='10' leftmargin='10' style="width: 400px;">

<?
if($perms=="1")
	{
		$role='Administrator';
	}
	else
	{
		$role='Learner';
	}
?>
<table width="800" align='left' border="0" cellpadding="4">
  <tr> 
    <td class="contentBold">Hi <? echo $fname ?>, </td>
  </tr>

  <tr>
    <td class="content">You are logged in as <?=$role?>.<br><br>To continue, click any of the links in the left panel.<br><br>
</td>
  </tr>
  <?
  if($isUpdaetd=='0')
  {
  ?>
	<tr>
    <td class="content"><font color='red'><b>Important Information:</b> You must update your details in <b>'My Details'</b> section.</font><br><br>
</td>
  </tr>
  <?
  }	  
  ?>
</table>

</body>

</html>
