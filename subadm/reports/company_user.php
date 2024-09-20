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
include("../connect.php"); //Connection to database 
include("../global/functions.php"); 
$user_rowid=getUserId($userid);
//$company_id=getUserCompanyId($user_rowid);
//$crsid=$_REQUEST['crsid'];
//$courseName=getCourseNameFromId($crsid);
$company_id=$_POST['cmbCompany'];
//$crsid=$_POST['cmbCourse'];
$cmbStatus=$_POST['cmbStatus'];
//echo "cmbStatus: ".$cmbStatus;
$qPart="";
if($cmbStatus!="")
{
$qPart=" AND A.userregistered=$cmbStatus ";
}
if($company_id=='all')
{
$query="SELECT * FROM tbl_users as A where username<>'admin' order by A.usertype DESC, A.username ASC";
}
else
{
$query="SELECT * FROM tbl_users AS A, tbl_company_user AS B WHERE A.id=B.user_id AND B.company_id=$company_id ".$qPart." order by A.usertype DESC, A.username ASC";
}
$result = mysql_query ($query); 
$num=mysql_numrows($result);
?>

<html>
<head>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<script language="javascript" src="popcalendar.js"></script>
<script>
function resetSelection()
{
document.getElementById("cmbStatus").value="";
document.getElementById("cmbCompany").value="";
document.frmprofile.submit();
}

function exportCUCSV()
{
    var winWd=200;
    var winHt=200;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var company = document.getElementById('cmbCompany').value;
    var ustatus = document.getElementById('cmbStatus').value;
    
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="company_user_export.php?cmbCompany="+company+"&cmbStatus="+ustatus;
    var logwin=window.open(fpath,'csvwin',settings);
    logwin.focus();
}
</script>
<title>Country Users Report</title>
</head>
<body topmargin="10" leftmargin="10" class='contentBG'>

<table width="700" cellspacing="0" cellpadding='0' border='0'>
<tr  height='25px'><td align='left' colspan='2' class='tblWelcome WelcomeText'>&nbsp;&nbsp;Country Users Report</td></tr>
<tr  height='10px'><td align='left' colspan='2'></td></tr>
<tr  height='25px'><td align='left' class='content'>&nbsp;</td><td class='content' align='right'>
<a href='javascript:exportCUCSV();' class=''>Export to CSV</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href='javascript:window.print();' class='' title='Print this window'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:self.close();' class='' title='Close this window'>Close</a></td></tr>
<tr  height='10px'><td align='left' colspan='2'></td></tr>

<form name='frmprofile' id='frmprofile' action='company_user.php' method='POST'>
<tr><td colspan='2'>
<table border="0" width="100%" cellspacing="0" cellpadding="3" class='tblBorder'>
<tr height='10'><td colspan='3'></td></tr>
<?
$cresult = mysql_query ("SELECT * FROM tbl_company ORDER BY company_name ASC"); 
$cnum=mysql_numrows($cresult);

?>
<tr> <td  class='content' width='550'>Country: <SELECT name="cmbCompany" id='cmbCompany' class='inputcls' rows='2' style="width:150px">
            <option value="">Select country</option> 
			<option value="all" <? if($company_id=='all') { echo 'selected'; } ?>>All countries</option> 
			<?
			$i=0;
			while ($i < $cnum) {

			$row = mysql_fetch_assoc($cresult);
			$id = $row['id'];
			$catid=mysql_result($cresult,$i,"id");
			$catname=mysql_result($cresult,$i,"company_name");
			if($catid==$company_id)
			{
			$selStr1="selected";
			}
			else
			{
			$selStr1="";
			}
			?>
				<OPTION value="<?php echo $catid; ?>" <?=$selStr1?>><? echo $catname; ?></OPTION>
			<?
			$i++;
			}	
			?>             
			  
			 </SELECT>&nbsp;&nbsp;&nbsp;&nbsp;Status:&nbsp;&nbsp;<select id='cmbStatus' name='cmbStatus' class='inputcls' style='width:80px'>
<option value=''>All</option>
<option value='1' <? if($cmbStatus=='1') { echo 'selected'; } else { echo '';} ?>>Active</option>
<option value='0' <? if($cmbStatus=='0') { echo 'selected'; } else { echo '';} ?>>Inactive</option>
</select>

</td><td  class='content' width='140'>
<input type='submit' class='submit_button_normal' style='height:22px' id='show' title='Show login details for this time period' value='&nbsp;Show&nbsp;'
onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">&nbsp;&nbsp;<input type='button' onclick='resetSelection();' class='submit_button_normal' style='height:22px' id='reset' title='Reset the values' value='&nbsp;Reset&nbsp;'
onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">
</td>
<td width='0' align='left'></td>
</tr>
<tr height='10'><td colspan='3'></td></tr>
</table>
</td></tr>

</form>
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

<table width="100%" class='tblBorder' cellspacing="0" border='0' cellpadding="6">

<tr class="tblTitle contentWhite">

<th width='180' align='left'>Name</th>
<th width='150' align='left'>User ID</th>
<th width='70' align='left'>Role</th>
<th width='100' align='left'>Email</th>
<th width='100' align='left'>Status</th>
</tr>
<?
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($result);
$id = $row['id'];
$userrowid=mysql_result($result,$i,"A.id");
$usertype=mysql_result($result,$i,"A.usertype");
$uname=mysql_result($result,$i,"A.username");
$uemail=mysql_result($result,$i,"A.email");
$ustatus=mysql_result($result,$i,"A.userregistered");

if($ustatus=='1')
{
$ustatus="<font color='green'>Active</font>";
}
else
{
$ustatus="<font color='red'>Inactive</font>";
}
//$userCourseStatus=getUserCourseStatus($userrowid,$crsid);
//$userCourseTime=getUserCourseTime($userrowid,$crsid);
//$userCourseScore=getUserCourseScore($userrowid,$crsid);

if($usertype=='2')
{
$uRole='Administrator';
}
else
{
$uRole='Learner';
}
$userfullname=getFullNameFromID($userrowid);



if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";


?>
<tr class="<?=$bgc?>">
<td class="Content"><? echo ucfirst(TrimString($userfullname)); ?></td>
<td class="Content"><? echo $uname; ?></td>
<td class="Content" align='left'><? echo $uRole; ?></td>
<td class="Content" align='left'><? echo $uemail; ?></td>
<td align='left' class="Content"><? echo $ustatus; ?></td>
</tr>
<?
$i++;
}
echo "</table>";

?></td>
        </tr>
		<tr height='25px'><td colspan='2' align='center'>&nbsp;</td></tr>
		<tr  height='25px'><td colspan='2' align='center' class='content'><a href='javascript:window.print();' class='' title='Print this window'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:self.close();' class='' title='Close this window'>Close</a></td></tr>
  </table>
</body>
</html>
