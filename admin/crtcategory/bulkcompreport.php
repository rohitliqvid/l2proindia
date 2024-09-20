<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../connect.php"); //Connection to database 
include("../global/functions.php"); 


$result2 = mysql_query ("SELECT * FROM tbl_comp_bulkstatus ORDER BY id ASC"); 
$num=mysql_numrows($result2);
//mysql_close();
?>
<html>
<head>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<script>
function doSaveAs(myfile){
	if (document.execCommand){
		document.execCommand("SaveAs",true,myfile)
	}
	else {
		alert("Save-feature available only in Internet Exlorer 5.x.")
	}
}
</script>

<title>Bulk Upload Report</title>
</head>
<body topmargin="10" leftmargin="10" class='contentBG'>

<table width="700" cellspacing="0" cellpadding='0' border='0'>
<tr  height='25px'><td align='left' class='tblWelcome WelcomeText'>&nbsp;&nbsp;Bulk Upload Report</td></tr>
<tr  height='15px'><td align='left'></td></tr>

<tr  height='25px'><td align='left'>&nbsp;</td></tr>
<?
if(!$num)
{
echo "<tr  height='25px'><td align='left' class='content'>No bulk countries created!</td></tr>";
exit;
}
?>
<tr>
<td>

<table width="100%" class='tblBorder2' cellspacing="0" border='0' cellpadding="3">

<tr class="tblTitle contentWhite">

<th width='30%' align='left'>Country Name</th>
<th width='70%' align='left'>Status</th>
</tr>
<?
$curdate=date('d-m-Y');
$filename="Report-".$curdate."-".time().".html";
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($result2);
$id = $row['id'];

$comp_name=mysql_result($result2,$i,"company_name");
$status=mysql_result($result2,$i,"status");
$userflag=mysql_result($result2,$i,"flag");


if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";


if ($userflag=='0')
$fontcolor="green";
else
$fontcolor="red";
?>



<tr class="<?=$bgc?>">

<td class="Content"><?=$comp_name?></td>
<td class="Content" align='left'><?=$status?></td>

</tr>
<?
$i++;
}
echo "</table>";

?></td>
        </tr>
		<tr height='25px'><td colspan='2' align='center'>&nbsp;</td></tr>
		<tr  height='25px'><td colspan='2' align='center' class='content'><a href="javascript:doSaveAs('<?=$filename?>');" class='contentLink' onFocus='this.blur()' title='Save this report'>Save this report</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:window.print();' class='contentLink' onFocus='this.blur()' title='Print this window'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:self.close();' class='contentLink' onFocus='this.blur()' title='Close this window'>Close</a></td></tr>
  </table>
</body>
</html>
