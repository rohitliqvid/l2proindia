<?php include ('../intface/windowHeader.php'); ?>
<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$user_rowid=getUserId($userid);
//$company_id=getUserCompanyId($user_rowid);
$crsid=$_REQUEST['crsid'];
$courseName=getCourseNameFromId($crsid);
$cmbStatus=$_POST['cmbStatus'];
//echo "cmbStatus: ".$cmbStatus;
//$query="SELECT * FROM tbl_users AS A, tbl_company_user AS B WHERE A.userregistered='1' AND A.id=B.user_id AND B.company_id=$company_id order by A.usertype DESC, A.username ASC";
$qPart="";
if(isset($_POST['fname'])){
	$fname=trim($_POST['fname']);
}
else{
	$fname='';
}
if($fname!="")
{
$qPart.=" AND A.firstname LIKE '%$fname%' or A.lastname LIKE '%$fname%' or CONCAT(A.firstname,  ' ',A.lastname ) LIKE  '%$fname%' ";
}

if(isset($_POST['userName'])){
	$userName=trim($_POST['userName']);
}
else{
	$userName='';
}
if($userName!="")
{
$qPart.=" AND A.username LIKE '%$userName%' ";
}


//$query="SELECT * FROM tbl_users AS A WHERE A.userregistered='1' ".$qPart." order by A.usertype DESC, A.username ASC";
//$result = mysql_query ($query); 
//$num=mysql_numrows($result);

$con=createConnection();
$query1 = "SELECT id,username,usertype FROM tbl_users AS A WHERE A.userregistered='1' ".$qPart." order by A.usertype DESC, A.username ASC";
$result = mysqli_query($con,$query1);
$num=mysqli_num_rows($result);
?>

<script language="javascript" src="popcalendar.js"></script>
<script>
function resetSelection()
{
document.getElementById("cmbStatus").value="";
document.frmprofile.submit();
}
</script>
<title>Course Usage Report</title>
<section id="content" class="rightside windowrightContenBg" >
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="windowtopMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg paddingTOPBottom0">
		<div class="col-lg-3 col-md-3 col-sm-3 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Course Usage Report </strong></span> </div>
		 
		</div>
		
		<div class="col-lg-9 col-sm-9 col-md-9 tablegrid">
      <div class="row">
	 
        <form name="searchcourse" action="waiting_documents.php" method="post">

          <div class="col-sm-1"></div>
          <div class="pull-right text-right">
            <div class="search inline">
			 <span><a href='javascript:void(0);' id="btnPrint" class='btn' title='Print this window'><i class="fa fa-print"></i></a></span> 
			  <!--<span><a href='javascript:window.print();' id="btnPrint" class='btn' title='Print this window'><i class="fa fa-print"></i></a></span>-->
			 <span class="text-right"><a href='javascript:self.close();' class='btn ' title='Close this window'><i class="fa fa-times-circle"></i></a> </span> 
			</div>
          </div>
        </form>
      </div>
    </div>
		
  </div>
  
  
</section>
<section class="panel panel-default">
		   <div class="rightHead text-center bgWt">
		   <div class="stepBg">
                <p> <b>Course Name:</b> <?=$courseName?></p>
              </div>
		     <div class="col-md-12 col-sm-12 buildcourse text-center marginBottom20">
			 <form name='frmprofile' id='frmprofile' action='report.php' method='POST'>

<?
//$cresult = mysql_query ("SELECT * FROM tbl_client ORDER BY client_name ASC"); 
//$cnum=mysql_numrows($cresult);

$query2 = "SELECT * FROM tbl_client ORDER BY client_name ASC";
$cresult = mysqli_query($con,$query2);
$cnum=mysqli_num_rows($cresult);
?>

  <form name="searchcourse" action="waiting_documents.php" method="post">

          <div class="col-sm-12 text-right searchbg">
            <div class="search inline">Status:&nbsp;<select id='cmbStatus' name='cmbStatus' class="input-sm form-control  searchbtn">
<option value=''>All</option>
<option value='notattempted' <? if($cmbStatus=='notattempted') { echo 'selected'; } else { echo '';} ?>>Not Attempted</option>
<option value='incomplete' <? if($cmbStatus=='incomplete') { echo 'selected'; } else { echo '';} ?>>Incomplete</option>
<option value='completed' <? if($cmbStatus=='completed') { echo 'selected'; } else { echo '';} ?>>Completed</option>
</select><input type='hidden' id='crsid' name='crsid' value="<?=$crsid?>">
              <!--<i class="fa fa-search"></i>-->
              <button type="submit" id="search" name="search" class="btn btn-sm btn-blue searchButton" onclick='submitSearch();' title='Show login details for this time period'>Search</button>
              </span> <span class="text-right"> <a href="javascript:(0)" class="btn  btn-blue btn-reset" onclick='resetSelection();' >Refresh</a> </span> </div>
          </div>
        </form>
		
</div>
			 </div>
			 
		 </section>


</section>		 
<div id="printTable">			 
	
	<!--Responsive grid table -->

	<?
if($searchmsg=='1')	{
}
else
{
?>	<!--<section class="windowtopMenuContent" style="top: 149px;">
		<section class="panel panel-default  theadHeight">
  
			
			  <div class="panel row teacher-student-wrap theadHeight">
 
               <div class="promo" id="promo">
			  <table class="table m-b-none dataTable table-fixed" style="margin-bottom: 0px;">
                   <thead  class="fixedHeader">   
				   <tr>
<th class="col-xs-3 text-left">Name</th>
<th class="col-xs-2 text-left">Username</th>
<th class="col-xs-3 text-left">Course Status</th>
<th class="col-xs-2 text-left">Time Spent</th>
<th class="col-xs-2 text-left">Completion Date</th>
   
                      </tr>
                    </thead>
					
					</table></div></div>	
					
 </section> 
 </section> 	-->
<?php } ?>	
	

<form name="deletecourse" onSubmit="return confirmDelete();" action="approval.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>&catid=<?=$catid?>&trec=<?=$totalnum?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>&from_page=w" method="post">

		 <div class="scrollable padder courseGroupheight76">&nbsp;</div>
       <section class="scrollable">

			<section class="panel panel-default panelgridBg">
			  <div class="panel row teacher-student-wrap">
			
		
	<!--Responsive grid table -->
                <div class="table-responsive promo courseGroup table-responsiveWindow" >



<table class="table m-b-none dataTable table-fixed" style="margin-bottom: 0px;">
 <thead  class="fixedHeader">   
 <tr>
	<th class="col-xs-3 text-left" align="left">Name</th>
	<th class="col-xs-3 text-left" align="left">Username</th>
	<th class="col-xs-2 text-center" align="center">Course Status</th>
	<th class="col-xs-2 text-center" align="center">Time Spent</th>
	<th class="col-xs-2 text-center" align="center">Completion Date</th>
 </tr>
</thead>
<?
$i=0;$j=0;
while ($i < $num) {

$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$userrowid=$row['id'];
$usertype=$row['usertype'];
$uname=$row['username'];

$userCourseStatus=getUserCourseStatus($userrowid,$crsid);
$userCourseTime=getUserCourseTime($userrowid,$crsid);
$userCourseScore=getUserCourseScore($userrowid,$crsid);

$userCourseCompletionDate=getUserCompletionDate($userrowid,$crsid);

if($userCourseCompletionDate=="-")
{
	$userCourseCompletionDateFormatted="-";
}
else
{
	$userCourseCompletionDateFormatted=parseDate($userCourseCompletionDate);
}

if($usertype=='2')
{
$uRole='Administrator';
}
else
{
$uRole='User';
}
$userfullname=getFullNameFromIDMask($userrowid);



if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";


if($cmbStatus=='notattempted' && $userCourseStatus=='Not Attempted')
{
$visible='';
 $colorClass='style="color:red"' ;  
}
else if($cmbStatus=='incomplete' && ($userCourseStatus=='incomplete' || $userCourseStatus=='failed'))
{
$visible='';
 $colorClass='style="color:red"' ;  
}
else if($cmbStatus=='completed' && ($userCourseStatus=='completed' || $userCourseStatus=='passed'))
{
$visible='';
  
 $colorClass='style="color:green"' ;  
 
}
else
{
$visible='display:none';
 $colorClass='' ;  
}



if($cmbStatus==""){
 $visible='';

	if( $userCourseStatus=='Not Attempted'){
	 $colorClass='style="color:red"' ;  
	}else if($userCourseStatus=='incomplete' || $userCourseStatus=='failed'){
	 $colorClass='style="color:red"' ;  
	}else if($userCourseStatus=='completed' || $userCourseStatus=='passed'){
	 $colorClass='style="color:green"' ;  
	}else{
	 $colorClass='' ;  
	}

}
if($visible!=''){
	$j++;
}
?>
<tr style="<?php echo $visible;?>">
<td class="col-xs-3 text-left" align="left"><? echo ucfirst(TrimString($userfullname)); ?></td>
<td class="col-xs-3 text-left" align="left"><? echo obfuscate_email($uname); ?></td>
<!--<td class="Content" align='center'><? echo $uRole; ?></td>-->
<td class="col-xs-2 text-center" align="center"><span <?php echo $colorClass;?>><? echo ucfirst($userCourseStatus); ?></span></td>
<td class="col-xs-2 text-center" align="center"><? echo formatToNewTime($userCourseTime); ?></td>
<td class="col-xs-2 text-center" align="center"><?=$userCourseCompletionDateFormatted?></td>
<!--<td align='center' class="Content"><? echo $userCourseScore; ?></td>-->
</tr>
<?
$i++;
}


?></table>

<?
//if courses not found
if (!$num)
{
?>
<div  class="noRecordeTable">
<?
//if courses not found


if($searchmsg=='1')
	{
echo "<h4>No results found! Click the Back link to search again.</h4>";
}
else
{
echo "<h4>No records found!</h4>";
}

?>
</div>

<?
//exit();
}
?>


<?
if($num>0 && ($num==$j))
{
echo "<div class='noRecordeTable'><h4>No records found!</h4></div>	";
//exit;
}
?>
</div></div></section>
</form>

</div>
<?php
include ('../intface/footer.php');
?>
<script>
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('#btnPrint').on('click',function(){
 printData();
})
</script>