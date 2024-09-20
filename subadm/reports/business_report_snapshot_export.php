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
include_once("reports/jpgraph/src/jpgraph.php"); 
include_once("reports/jpgraph/src/jpgraph_pie.php"); 
include_once("reports/jpgraph/src/jpgraph_pie3d.php"); 
//include ("../reports/jpgraph/src/jpgraph_line.php");
//include ("reports/jpgraph/src/jpgraph_utils.inc");
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
$output = "";
$output .= "Baseline Population (in actuals), , , , , , , Baseline Population (in %), , , ,  \n";
$output .= "Countries, Target Population, 0% - 25%, 26% - 50%, 51% - 75%, 76% - 99%, 100%, 0% - 25%, 26% - 50%, 51% - 75%, 76% - 99%, 100%\n";
$i=0;
while ($i < $num) {
$array_overall_completion_country=array();
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowid=mysql_result($result,$i,"id");
$company_name=mysql_result($result,$i,"company_name");
$output .= $company_name.",".getTotalRegisteredForCountry($rowid).",".getTotalActaulsBetween($rowid,'0','25').",".getTotalActaulsBetween($rowid,'26','50').",".getTotalActaulsBetween($rowid,'51','75').",".getTotalActaulsBetween($rowid,'76','99').",".getTotalActaulsBetween($rowid,'100','100').",".getTotalPercentageBetween($rowid,'0','25')."%,".getTotalPercentageBetween($rowid,'26','50')."%,".getTotalPercentageBetween($rowid,'51','75')."%,".getTotalPercentageBetween($rowid,'76','99')."%,".getTotalPercentageBetween($rowid,'100','100')."%\n";
$i++;
}
$array_overall_completion_all=array();
$targetPopulation=getTotalRegistered();
$percent25=getTotalPercentageBetweenAll('0','25');
$percent50=getTotalPercentageBetweenAll('26','50');
$percent75=getTotalPercentageBetweenAll('51','75');
$percent99=getTotalPercentageBetweenAll('76','99');
$percent100=getTotalPercentageBetweenAll('100','100');
$output .= "Grand Total,".$targetPopulation.",".getTotalActaulsBetweenAll('0','25').",".getTotalActaulsBetweenAll('26','50').",".getTotalActaulsBetweenAll('51','75').",".getTotalActaulsBetweenAll('76','99').",".getTotalActaulsBetweenAll('100','100').",".$percent25."%,".$percent50."%,".$percent75."%,".$percent99."%,".$percent100."%\n";
/* JT
array_push($graph_values,$percent25);
array_push($graph_values,$percent50);
array_push($graph_values,$percent75);
array_push($graph_values,$percent99);
array_push($graph_values,$percent100);
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
		$pie1->value->SetFont(FF_ARIAL,FS_BOLD);
		$pie1->value->SetColor('white');
		$pie1->value->Show();

		$graph->Add($pie1);
		$graph->Stroke($graphImgName);
	}
$output .= $graphImgName;
*/
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=business_report_snapshot_".date('dmY_Hi').".csv;" );
header("Content-Transfer-Encoding: binary");
echo $output;
?>