<title>Users Report</title>
<?php include ('../intface/windowHeaderOuter.php'); ?>
<?php
$user_rowid=getUserId($userid);
$qPart="";

if(isset($_POST['cmbStatus'])){
	$cmbStatus=$_POST['cmbStatus'];
}
else{
	$cmbStatus='';
}
if($cmbStatus!="")
{
$qPart=" AND A.userregistered=$cmbStatus ";
}

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




$query="SELECT * FROM tbl_users as A where username<>'admin' ".$qPart."order by A.usertype DESC, A.username ASC";
$result = mysql_query ($query); 
$num=mysql_numrows($result);


//Change the date format to dd/mm/yyyy
function dtFormat($date) {
    list($year, $month, $day) = split('[/.-]', $date);
    echo $day . "/" . $month . "/" . $year;
}

?>


<script>
function resetSelection()
{
document.getElementById("cmbStatus").value="";
document.getElementById("fname").value="";
document.getElementById("userName").value="";
document.frmprofile.submit();
}

function exportCUCSV()
{
    var winWd=200;
    var winHt=200;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var ustatus = document.getElementById('cmbStatus').value;
    var fname = document.getElementById('fname').value;
    var userName = document.getElementById('userName').value;
    
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="user_export.php?cmbStatus="+ustatus+"&fname="+fname+"&userName="+userName;
    var logwin=window.open(fpath,'csvwin',settings);
    logwin.focus();
}
</script>
<section id="content" class="rightside windowrightContenBg" >
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="windowtopMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg   paddingTOPBottom0">
		<div class="col-sm-4 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Users Report </strong></span> </div>
		 
		</div>
		
		<div class="col-sm-7 pull-right">
    
          <div class="pull-right text-right ">
            <div class="search inline">
			 <span><a href='javascript:exportCUCSV();' class='btn' title='Export to CSV'><i class="fa fa-file-archive-o"></i></a></span> 
			<!-- <span><a href='javascript:window.print();' class='btn' title='Print this window'><i class="fa fa-print"></i></a></span> -->
			  <span><a href='javascript:void(0);' id="btnPrint" class='btn' title='Print this window'><i class="fa fa-print"></i></a></span> 
			 <span class="text-right"><a href='javascript:self.close();' class='btn ' title='Close this window'><i class="fa fa-times-circle"></i></a> </span> 
			</div>
          
      
      </div>
    </div>
		
  </div>
<div class="col-md-12 col-sm-12 buildcourse text-center" style="padding-top:20px">

 
</div> 
</section>
<section class="panel panel-default text-center">
		   <div class="rightHead text-center bgWt">
		  <!-- <div class="stepBg">
                <p> <b>Course Name:</b> <?=$courseName?></p>
              </div>-->
		     <form name='frmprofile' id='frmprofile' action='user.php' method='POST'>
 <div class="searchbg">
            <div class="search inline"> <span>
           Name:&nbsp;<input type="text" id='fname' name='fname' class="input-sm form-control  searchbtn" value="<?php echo $fname;?>" />&nbsp;Email:&nbsp;<input type="text" id='userName' name='userName' class="input-sm form-control  searchbtn" value="<?php echo $userName;?>" />
			 &nbsp;Status:&nbsp;<select id='cmbStatus' name='cmbStatus' class="input-sm form-control  searchbtn">
<option value=''>All</option>
<option value='1' <? if($cmbStatus=='1') { echo 'selected'; } else { echo '';} ?>>Active</option>
<option value='0' <? if($cmbStatus=='0') { echo 'selected'; } else { echo '';} ?>>Inactive</option>

</select>

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
		<?
		if($searchmsg=='1')	{
		}
		else
		{
		?>	
					<!--Responsive grid table -->
			 <!--<section class="windowtopMenuContent" style="top: 149px;">
			 <section class="panel panel-default  theadHeight">
			
			  <div class="panel row teacher-student-wrap theadHeight">
 
               <div class="promo" id="promo">
			  <table class="table m-b-none dataTable table-fixed" style="margin-bottom: 0px;">
                   <thead  class="fixedHeader">   
				   <tr>
						<th class="col-xs-3 text-left">Name</th>
						<th class="col-xs-3 text-left">Email (Username)</th>
						<th class="col-xs-2 text-left">Reg Date</th>
						<th class="col-xs-2 text-center">Status</th>
						<th class="col-xs-2 text-center">Course assigned</th>
   
                      </tr>
                    </thead>
					
					</table></div></div>


					</section>
	</section>	-->
<?php } ?>
	

<form name="deletecourse" onSubmit="return confirmDelete();" action="approval.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>&catid=<?=$catid?>&trec=<?=$totalnum?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>&from_page=w" method="post">

		<div class=" courseGroupheight76">&nbsp;</div>
       <section class="scrollable">
		<section class="panel panel-default ">
		<div><table border=0 width='100%'><tr><td colspan='2'>&nbsp;</td></tr><tr><td width='5%'><b>Total: </b></td><td><b><?php echo $num;?></b></td></tr><tr><td colspan='2'>&nbsp;</td></tr>
</table>
		</div>
			  <div class="panel row teacher-student-wrap">
			

				<!--Responsive grid table -->
                <div class="table-responsive promo courseGroup table-responsiveWindow">


<table class="table m-b-none dataTable table-fixed" style="margin-bottom: 0px;">
                   <thead  class="fixedHeader">   
				   <tr>
						<th class="col-xs-3 text-left">Name</th>
						<th class="col-xs-3 text-left">Email (Username)</th>
						<th  class="col-xs-1 text-left">Occupation</th>
						<th  class="col-xs-2 text-left">Organization</th>
						<th  class="col-xs-1 text-left">Designation</th>
						<th class="col-xs-1 text-left">Reg Date</th>
						<th class="col-xs-1 text-center">Status</th>
						<!--<th class="col-xs-1 text-center">Course assigned</th>-->
   
                      </tr>
                    </thead>
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
$dtEnrolled=mysql_result($result,$i,"A.dtenrolled");
$newDTArr=explode("-",$dtEnrolled);
$newDT=$newDTArr[2]."-".$newDTArr[1]."-".$newDTArr[0];

$uoccupation=mysql_result($result,$i,"A.occupation");
$uorganization=mysql_result($result,$i,"A.organization");
$udesignation=mysql_result($result,$i,"A.designation");
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

//$totalCourseAssigned = getUserCourses($uname);

if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";


?>
<tr>
<td  class="col-xs-3 text-left"><? echo ucfirst(TrimString($userfullname)); ?></td>
<td  class="col-xs-3 text-left"><? echo TrimString($uname); ?></td>
<td  class="col-xs-1 text-left"><? echo TrimString($uoccupation); ?></td>
<td  class="col-xs-2 text-left"><? echo TrimString($uorganization); ?></td>
<td  class="col-xs-1 text-left"><? echo TrimString($udesignation); ?></td>
<!--<td class="Content" align='left'><? echo $uRole; ?></td>-->
<td class="col-xs-1 text-left"><? echo parseDate($newDT); ?></td>
<td class="col-xs-1 text-center"><? echo $ustatus; ?></td>
<!--<td class="col-xs-1 text-center" align="center"><? echo $totalCourseAssigned; ?></td>-->
</tr>
<?
$i++;
}
?>
</table>  

<?
if(!$num)
{
echo "<div  class='noRecordeTable'><h4>No records found!</h4></div>	";
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