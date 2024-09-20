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
$output = "";
$output .= "Countries, Total Registered, Total Logged In, Anti-Bribery - Mitigating Bribery Risk, , i-Safe, , Group Code of Conduct (GCoC), , Turning Complaints into Compliments (TCiC), , Anti-Money Laundering and Terrorist Financing, , SCB - Operational Risk Management and Assurance Framework, , Reputational Risk, , Investments by US Personal & Investing in US Securities, , Customer Charter, , Living with HIV, , Health Safety and Environment, , Overall Completion %, 5Cs Sales Process,  \n";
$output .= " , #, #, # completed, % completed, # completed, % completed, # completed, % completed, # completed, % completed, # completed, % completed, # completed, % completed, # completed, % completed,  # completed, % completed, # completed, % completed, # completed, % completed, # completed, % completed, % completed, # completed, % completed  \n";
$i=0;
while ($i < $num) {
$array_overall_completion_country=array();
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowid=mysql_result($result,$i,"id");
$company_name=mysql_result($result,$i,"company_name");
$output .= $company_name.",".getTotalRegisteredForCountry($rowid).",".getTotalLoggedInForCountry($rowid).",".getTotalNumberCourseCompleted($rowid,'1').",".getTotalPercentCourseCompleted($rowid,'1')."%,".getTotalNumberCourseCompleted($rowid,'2').",".getTotalPercentCourseCompleted($rowid,'2')."%,".getTotalNumberCourseCompleted($rowid,'4').",".getTotalPercentCourseCompleted($rowid,'4')."%,".getTotalNumberCourseCompleted($rowid,'5').",".getTotalPercentCourseCompleted($rowid,'5')."%,".getTotalNumberCourseCompleted($rowid,'7').",".getTotalPercentCourseCompleted($rowid,'7')."%,".getTotalNumberCourseCompleted($rowid,'8').",".getTotalPercentCourseCompleted($rowid,'8')."%,".getTotalNumberCourseCompleted($rowid,'9').",".getTotalPercentCourseCompleted($rowid,'9')."%,".getTotalNumberCourseCompleted($rowid,'10').",".getTotalPercentCourseCompleted($rowid,'10')."%,".getTotalNumberCourseCompleted($rowid,'11').",".getTotalPercentCourseCompleted($rowid,'11')."%,".getTotalNumberCourseCompleted($rowid,'12').",".getTotalPercentCourseCompleted($rowid,'12')."%,".getTotalNumberCourseCompleted($rowid,'3').",".getTotalPercentCourseCompleted($rowid,'3')."%";
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'1'));
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'2'));
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'4'));
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'5'));
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'7'));
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'8'));
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'9'));
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'10'));
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'11'));
array_push($array_overall_completion_country,getTotalPercentCourseCompleted($rowid,'12'));
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
$output .= $overall."%,".getTotalNumberCourseCompleted($rowid,'6').",".getTotalPercentCourseCompleted($rowid,'6')."% \n";
$i++;
}
$array_overall_completion_all=array();
$output .= "Grand Total, ".getTotalRegistered().",".getTotalLoggedIn().",".getTotalNumberCourseCompletedAll('1').",".getTotalPercentCourseCompletedAll('1')."%,".getTotalNumberCourseCompletedAll('2').",".getTotalPercentCourseCompletedAll('2')."%,".getTotalNumberCourseCompletedAll('4').",".getTotalPercentCourseCompletedAll('4')."%,".getTotalNumberCourseCompletedAll('5').",".getTotalPercentCourseCompletedAll('5')."%,".getTotalNumberCourseCompletedAll('7').",".getTotalPercentCourseCompletedAll('7')."%,".getTotalNumberCourseCompletedAll('8').",".getTotalPercentCourseCompletedAll('8')."%,".getTotalNumberCourseCompletedAll('9').",".getTotalPercentCourseCompletedAll('9')."%,".getTotalNumberCourseCompletedAll('10').",".getTotalPercentCourseCompletedAll('10')."%,".getTotalNumberCourseCompletedAll('11').",".getTotalPercentCourseCompletedAll('11')."%,".getTotalNumberCourseCompletedAll('12').",".getTotalPercentCourseCompletedAll('12')."%,".getTotalNumberCourseCompletedAll('3').",".getTotalPercentCourseCompletedAll('3')."%";
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('1'));
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('2'));
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('4'));
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('5'));
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('7'));
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('8'));
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('9'));
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('10'));
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('11'));
array_push($array_overall_completion_all,getTotalPercentCourseCompletedAll('12'));
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
$output .= $overall_all."%,".getTotalNumberCourseCompletedAll('6').",".getTotalPercentCourseCompletedAll('6');
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=business_report_".date('dmY_Hi').".csv;" );
header("Content-Transfer-Encoding: binary");
echo $output;
?>