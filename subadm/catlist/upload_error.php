<?php
$err=$_REQUEST['errtype'];
if($err=='1')
{
$errHeading='Invalid Package';
$errMessage='imsmanifest.xml file not found!';
}
?>
<link href="../styles/styles.css" rel="stylesheet" type="text/css"> 
<body class='contentBG'>
	
<p>&nbsp;</p>
<table width="100%"  border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td colspan="2" valign='top' class='ContentBold'>Error: <?php echo $errHeading; ?></td>
  </tr>
  <tr>
    <td colspan='2' valign='top' class='ContentBold'>Description: <span class='content'><?php echo $errMessage; ?></span></td>
  </tr>
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align='center'><a href='upload_form.php' class='contentLink'>Back</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:self.close();' class='contentLink'>Close</a></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>