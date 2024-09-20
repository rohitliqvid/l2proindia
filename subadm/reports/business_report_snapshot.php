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
ini_set('max_execution_time', 24000);    // Increase 'timeout' time 
include("../connect.php"); //Connection to database 
include("../global/functions.php"); 
include_once("reports/jpgraph/src/jpgraph.php"); 
include_once("reports/jpgraph/src/jpgraph_pie.php"); 
include_once("reports/jpgraph/src/jpgraph_pie3d.php"); 
//include ("../reports/jpgraph/src/jpgraph_line.php");
//include ("reports/jpgraph/src/jpgraph_utils.inc");
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 

$graph_values=array();
$graph_labels=array();
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
<script>
function exportBRSCSV()
{
    var winWd=200;
    var winHt=200;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="business_report_snapshot_export.php";
    var logwin=window.open(fpath,'csvwin',settings);
    logwin.focus();
}
</script>
<title>New Business Portal Report - Snapshot</title>
</head>
<body topmargin="10" leftmargin="10" class='contentBG'>

<table width="700" cellspacing="0" cellpadding='0' border='0'>
<tr  height='25px'><td align='left' colspan='2' class='tblWelcome WelcomeText'>&nbsp;&nbsp;New Business Portal Report - Snapshot</td></tr>
<tr  height='10px'><td align='left' colspan='2'></td></tr>
<tr  height='25px'><td align='left' class='content'>&nbsp;</td><td class='content' align='right'>
<a href='javascript:exportBRSCSV();' class='contentLink'>Export to CSV</a>&nbsp;&nbsp;&nbsp;&nbsp;
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

<table width="1350px" class='tblBorder' cellspacing="0" border='1' cellpadding="6">

<tr class="tblTitle contentWhite">

<th colspan='7' align='left'>Baseline Population (in actuals)</th>
<th colspan='5' align='center'>In %</th>

</tr>

<tr class="tblTitle contentWhite">

<th width='200px' align='left'>Countries</th>
<th width='150px' align='center'>Target Population</th>
<th width='100px' align='center'>0% - 25%</th>
<th width='100px' align='center'>26% - 50%</th>
<th width='100px' align='center'>51% - 75%</th>
<th width='100px' align='center'>76% - 99%</th>
<th width='100px' align='center'>100%</th>
<th width='100px' align='center'>0% - 25%</th>
<th width='100px' align='center'>26% - 50%</th>
<th width='100px' align='center'>51% - 75%</th>
<th width='100px' align='center'>76% - 99%</th>
<th width='100px' align='center'>100%</th>
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


<td width='100px' align='center' class='content'><?=getTotalActaulsBetween($rowid,'0','25');?></td>

<td width='100px' align='center' class='content'><?=getTotalActaulsBetween($rowid,'26','50');?></td>


<td width='100px' align='center' class='content'><?=getTotalActaulsBetween($rowid,'51','75');?></td>


<td width='100px' align='center' class='content'><?=getTotalActaulsBetween($rowid,'76','99');?></td>

<td width='100px' align='center' class='content'><?=getTotalActaulsBetween($rowid,'100','100');?></td>


<td width='100px' align='center' class='content'><?=getTotalPercentageBetween($rowid,'0','25');?>%</td>

<td width='100px' align='center' class='content'><?=getTotalPercentageBetween($rowid,'26','50');?>%</td>


<td width='100px' align='center' class='content'><?=getTotalPercentageBetween($rowid,'51','75');?>%</td>

<td width='100px' align='center' class='content'><?=getTotalPercentageBetween($rowid,'76','99');?>%</td>


<td width='100px' align='center' class='content'><?=getTotalPercentageBetween($rowid,'100','100');?>%</td>


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
<?
$targetPopulation=getTotalRegistered();
$percent25=getTotalPercentageBetweenAll('0','25');
$percent50=getTotalPercentageBetweenAll('26','50');
$percent75=getTotalPercentageBetweenAll('51','75');
$percent99=getTotalPercentageBetweenAll('76','99');
$percent100=getTotalPercentageBetweenAll('100','100');

//$percent25="5";
//$percent50="20";
//$percent75="0";
//$percent99="0";
//$percent100="0";
/*
echo "percent25-->".$percent25;
echo "<br>";
echo "percent50-->".$percent50;
echo "<br>";
echo "percent75-->".$percent75;
echo "<br>";
echo "percent99-->".$percent99;
echo "<br>";
echo "percent100-->".$percent100;
echo "<br>";
*/
?>
<td width='150px' align='center' class='contentBold'><?=$targetPopulation?></td>


<td width='100px' align='center' class='contentBold'><?=getTotalActaulsBetweenAll('0','25');?></td>

<td width='100px' align='center' class='contentBold'><?=getTotalActaulsBetweenAll('26','50');?></td>


<td width='100px' align='center' class='contentBold'><?=getTotalActaulsBetweenAll('51','75');?></td>

<td width='100px' align='center' class='contentBold'><?=getTotalActaulsBetweenAll('76','99');?></td>

<td width='100px' align='center' class='contentBold'><?=getTotalActaulsBetweenAll('100','100');?></td>


<td width='100px' align='center' class='contentBold'><?=$percent25?>%</td>


<td width='100px' align='center' class='contentBold'><?=$percent50?>%</td>


<td width='100px' align='center' class='contentBold'><?=$percent75?>%</td>

<td width='100px' align='center' class='contentBold'><?=$percent99?>%</td>

<td width='100px' align='center' class='contentBold'><?=$percent100?>%</td>


</tr>
</table>
		
  </table>
  <?


array_push($graph_values,$percent25);
array_push($graph_values,$percent50);
array_push($graph_values,$percent75);
array_push($graph_values,$percent99);
array_push($graph_values,$percent100);


//array_push($graph_labels,"0%-25%");
//array_push($graph_labels,"Bsdf");
//array_push($graph_labels,"Csdf");
//array_push($graph_labels,"Dsfd");
//array_push($graph_labels,"Esdfsdf");

//echo "HERERRE";
//print_r($graph_values);
?>
    <br>
	  <br>
	  
<table width="100%" class='' cellspacing="0" border='0' cellpadding="6">
<?
//$graph_values=array('40','10','20','20','10');
if(is_array($graph_values))
	{
		foreach($graph_values as $k=>$v)
		{
			
			$subName[] = $k;
			$cnt[] = $v;


		}
	}
	else 
	{	
		$cnt[] = '';
	}

if(max($cnt) > 0)
	{
		
			$width = 550;
			$height = 400;

		$graphTitle = "BMs (Baseline) - ".$targetPopulation;
		$randomNo=rand(100,1000);
		$color   = array('green','yellow','red','skyblue','pink');
		$graphImgName="reports/GraphImages/test_".$randomNo.".gif";
		$graph = new PieGraph($width, $height, '', 0, false);
		$graph->title->Set($graphTitle);
		$graph->title->SetFont(FF_ARIAL,FS_BOLD,16);
		$graph->title->SetColor('white');
		//$graph->SetMargin(40,40,40,40);
		$graph->SetMarginColor('blue');
		//$graph->SetShadow();
		$graph->SetShadow(false);
		$pie1 = new PiePlot3D($cnt);
		$pie1->SetSize(0.42);
		$pie1->SetSliceColors($color);
		//$pie1->SetLabels($graph_labels);
		// $pie1->SetLabelPos(1);
		//$pie1->SetLabelType(PIE_VALUE_ABS);
		$pie1->value->SetFont(FF_ARIAL,FS_BOLD);
		$pie1->value->SetColor('white');
		$pie1->value->Show();


		//$pie1->value->SetFormat('%d'.'');
		$graph->Add($pie1);
		$graph->Stroke($graphImgName);
	
	}
	?>
	
	<tr><td>
<img src='<?=$graphImgName?>'/>
</td></tr>
  </table>

  <br>
<table width="100%" class='' cellspacing="0" border='0' cellpadding="6">
<tr height='25px'><td colspan='2' align='center'>&nbsp;</td></tr>
		<tr  height='25px'><td colspan='2' align='center' class='content'><a href='javascript:window.print();' class='contentLink' title='Print this window'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:self.close();' class='contentLink' title='Close this window'>Close</a></td></tr>
  </table>
</body>
</html>
