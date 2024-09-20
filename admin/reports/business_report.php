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
ini_set('max_execution_time', 240000);    // Increase 'timeout' time 
include("../connect.php"); //Connection to database 
include("../global/functions.php"); 
$user_rowid=getUserId($userid);
$courseName=getCourseNameFromId($crsid);
$company_id=$_POST['cmbCompany'];
$crsid=$_POST['cmbCourse'];
$cmbStatus=$_POST['cmbStatus'];
$query="SELECT * FROM tbl_company order by company_name ASC";
$result = mysql_query ($query); 
$num=mysql_numrows($result);
?>

<html>
<head>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<script language="javascript" src="popcalendar.js"></script>
<title>New Portal Business Report</title>
<script>
function exportBRCSV()
{
    var winWd=200;
    var winHt=200;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="business_report_export.php";
    var logwin=window.open(fpath,'csvwin',settings);
    logwin.focus();
}
</script>
</head>
<body topmargin="10" leftmargin="10" class='contentBG'>

<table width="700" cellspacing="0" cellpadding='0' border='0'>
<tr  height='25px'><td align='left' colspan='2' class='tblWelcome WelcomeText'>&nbsp;&nbsp;New Portal Business Report</td></tr>
<tr  height='10px'><td align='left' colspan='2'></td></tr>
<tr  height='25px'><td align='left' class='content'>&nbsp;</td><td class='content' align='right'>
<a href='javascript:exportBRCSV();' class='contentLink'>Export to CSV</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href='javascript:window.print();' class='contentLink' title='Print this window'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:self.close();' class='contentLink' title='Close this window'>Close</a></td></tr>
<tr  height='10px'><td align='left' colspan='2'></td></tr>


<tr  height='25px' colspan='2'><td align='left'>&nbsp;</td></tr>
<?
if(!$num)
{
echo "<tr  height='25px'><td align='left' class='content'>No records found!</td></tr>";
exit;
}
?>
<tr>
<td colspan='2'>

<table width="4250px" class='tblBorder' cellspacing="0" border='1' cellpadding="6">

<tr class="tblTitle contentWhite">

<th width='200px' align='left'>Countries</th>
<th width='150px' align='center'>Total Registered</th>
<th width='150px' align='center'>Total Logged In</th>
<th width='300px' align='center' colspan='2'>Anti-Bribery - Mitigating Bribery Risk</th>
<th width='300px' align='center' colspan='2'>i-Safe</th>
<th width='300px' align='center' colspan='2'>Group Code of Conduct (GCoC)</th>
<th width='300px' align='center' colspan='2'>Turning Complaints into Compliments (TCiC)</th>
<th width='300px' align='center' colspan='2'>Anti-Money Laundering and Terrorist Financing</th>
<th width='300px' align='center' colspan='2'>SCB - Operational Risk Management and Assurance Framework</th>
<th width='300px' align='center' colspan='2'>Reputational Risk</th>
<th width='300px' align='center' colspan='2'>Investments by US Personal & Investing in US Securities</th>
<th width='300px' align='center' colspan='2'>Customer Charter</th>
<th width='300px' align='center' colspan='2'>Living with HIV</th>
<th width='300px' align='center' colspan='2'>Health Safety and Environment</th>
<th width='150px' align='center'>Overall Completion %</th>
<!--<th width='300px' align='center' colspan='2'>5Cs Sales Process</th>-->
</tr>

<tr class="tblTitle contentWhite">

<th width='200px' align='center'>&nbsp;</th>
<th width='150px' align='center'>#</th>
<th width='150px' align='center'>#</th>

<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>

<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>


<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>


<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>

<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>



<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>


<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>


<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>

<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>


<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>


<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>


<th width='150px' align='center'>%completion</th>
<!--
<th width='150px' align='center'># completed</th>
<th width='150px' align='center'>% completion</th>
-->
</tr>

<?
$i=0;

while ($i < $num) {
$array_overall_completion_country=array();
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowid=mysql_result($result,$i,"id");
$company_name=mysql_result($result,$i,"company_name");




if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";



?>
<tr class="<?=$bgc?>">
<td width='200px' class='content' align='left'><?=$company_name?></td>
<td width='150px' align='center' class='content'><?=getTotalRegisteredForCountry($rowid)?></td>
<td width='150px' align='center' class='content'><?=getTotalLoggedInForCountry($rowid)?></td>

<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'1');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'1');?>%</td>
<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'1'));
?>
<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'2');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'2');?>%</td>
<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'2'));
?>

<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'4');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'4');?>%</td>
<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'4'));
?>

<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'5');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'5');?>%</td>
<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'5'));
?>
<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'7');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'7');?>%</td>
<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'7'));
?>

<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'8');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'8');?>%</td>

<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'8'));
?>
<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'9');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'9');?>%</td>
<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'9'));
?>

<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'10');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'10');?>%</td>
<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'10'));
?>
<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'11');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'11');?>%</td>
<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'11'));
?>

<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'12');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'12');?>%</td>
<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'12'));
?>
<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'3');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'3');?>%</td>
<?
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'3'));
$array_sum=array_sum($array_overall_completion_country);
if($array_sum==0)
{
$overall=0;
}
else
{
$overall=round($array_sum/11);
}
?>

<td width='150px' align='center' class='content'><?=$overall?>%</td>
<!--
<td width='150px' align='center' class='content'><?=getTotalNumberCourseCompleted($rowid,'6');?></td>
<td width='150px' align='center' class='content'><?=getTotalPercentCourseCompleted($rowid,'6');?>%</td>
-->
</tr>

<?
$i++;
}


?></td>
        </tr>
<?
$array_overall_completion_all=array();
?>
		<tr bgcolor='#CCCCCC'>
<td width='200px' class='contentBold' align='left'>Grand Total</td>
<td width='150px' align='center' class='contentBold'><?=getTotalRegistered()?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalLoggedIn()?></td>

<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('1');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('1');?>%</td>
<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('1'));
?>
<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('2');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('2');?>%</td>
<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('2'));
?>

<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('4');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('4');?>%</td>

<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('4'));
?>
<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('5');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('5');?>%</td>
<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('5'));
?>
<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('7');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('7');?>%</td>
<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('7'));
?>

<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('8');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('8');?>%</td>
<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('8'));
?>

<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('9');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('9');?>%</td>
<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('9'));
?>

<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('10');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('10');?>%</td>
<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('10'));
?>
<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('11');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('11');?>%</td>

<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('11'));
?>
<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('12');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('12');?>%</td>
<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('12'));
?>
<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('3');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('3');?>%</td>
<?
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('3'));

$array_sum_all=array_sum($array_overall_completion_all);
if($array_sum_all==0)
{
$overall_all=0;
}
else
{
$overall_all=round($array_sum_all/11);
}
?>

<td width='150px' align='center' class='contentBold'><?=$overall_all?>%</td>
<!--
<td width='150px' align='center' class='contentBold'><?=getTotalNumberCourseCompletedAll('6');?></td>
<td width='150px' align='center' class='contentBold'><?=getTotalPercentCourseCompletedAll('6');?>%</td>
-->
</tr>
</table>
		<tr height='25px'><td colspan='2' align='center'>&nbsp;</td></tr>
		<tr  height='25px'><td colspan='2' align='center' class='content'><a href='javascript:window.print();' class='contentLink' title='Print this window'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:self.close();' class='contentLink' title='Close this window'>Close</a></td></tr>
  </table>
</body>
</html>
