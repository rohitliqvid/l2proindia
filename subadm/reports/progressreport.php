<title>Learner Progress Report</title>
<?php include ('../intface/windowHeaderOuter.php'); ?>
<?php
$user_rowid=getUserId($userid);
//$company_id=getUserCompanyId($user_rowid);
//$crsid=$_REQUEST['crsid'];

// get course 
$crsresult = mysql_query ("SELECT * FROM tls_scorm where coursetype='wbt' ORDER BY id ASC"); 
$crnum=mysql_numrows($crsresult);
$i=0;
$arr_course=array();
while ($i < $crnum) {

$row = mysql_fetch_assoc($crsresult);
$id = $row['id'];
$crssid=mysql_result($crsresult,$i,"id");
$crsname=mysql_result($crsresult,$i,"name");
$arr_course[]=array('id'=>$crssid,'name'=>$crsname);

$i++;
}	
if(isset($_POST['cmbCourse']) && $_POST['cmbCourse']!=""){	
		 
$crsid=$_POST['cmbCourse'];
$cmbStatus=$_POST['cmbStatus'];

}else{
$crsid=$arr_course[0]['id'];
$cmbStatus='';
}
$courseName=getCourseNameFromId($crsid);

//echo "cmbStatus: ".$cmbStatus;
$query="SELECT * FROM tbl_users AS A WHERE A.userregistered='1' AND username<>'admin' order by A.usertype DESC, A.username ASC";

$result = mysql_query ($query); 
$num=mysql_numrows($result);
?>

<script>
function resetSelection()
{
document.getElementById("cmbStatus").value="";
document.getElementById("cmbCourse").value="";
document.frmprofile.submit();
}
function exportLPRCSV()
{
    var winWd=200;
    var winHt=200;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var ustatus = document.getElementById('cmbStatus').value;
    var course = document.getElementById("cmbCourse").value;
    
    var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=yes,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath="progressreport_export.php?cmbStatus="+ustatus+"&cmbCourse="+course;
    var logwin=window.open(fpath,'csvwin',settings);
    logwin.focus();
}
</script>
<section id="content" class="rightside windowrightContenBg">
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="windowtopMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg  paddingTOPBottom0">
		<div class="col-sm-4 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Learner Progress Report </strong></span> </div>
		 
		</div>
		
		<div class="col-sm-7 pull-right">
    
          <div class="pull-right text-right ">
            <div class="search inline">
			 <span><a href='javascript:exportLPRCSV();' class='btn' title='Export to CSV'><i class="fa fa-file-archive-o"></i></a></span> 
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
<section class="panel panel-default">
		   <div class="rightHead text-center bgWt">
		  <!-- <div class="stepBg">
                <p> <b>Course Name:</b> <?=$courseName?></p>
              </div>-->
		     <form name='frmprofile' id='frmprofile' action='progressreport.php' method='POST'>
				
          <div class="col-sm-1"></div>
          <div class="pull-right text-right searchbg">
            <div class="search inline"> <span>
            
        Course: <SELECT name="cmbCourse" id='cmbCourse'  rows='2' class="input-sm form-control  searchbtn">
            
			<?
			foreach($arr_course as $key=>$val){

			$crssid = $val['id'];
			$crsname=$val['name'];
			if($crssid==$crsid)
			{
			$selStr1="selected";
			}
			else
			{
			$selStr1="";
			}
			?>
				<OPTION value="<?php echo $crssid; ?>" <?=$selStr1?>><? echo $crsname; ?></OPTION>
			<?
			}	
			?>             
			  
			 </SELECT>
			 &nbsp;Status:&nbsp;<select id='cmbStatus' name='cmbStatus' class="input-sm form-control  searchbtn">
<option value=''>All</option>
<option value='notattempted' <? if($cmbStatus=='notattempted') { echo 'selected'; } else { echo '';} ?>>Not Attempted</option>
<option value='incomplete' <? if($cmbStatus=='incomplete') { echo 'selected'; } else { echo '';} ?>>Incomplete</option>
<option value='completed' <? if($cmbStatus=='completed') { echo 'selected'; } else { echo '';} ?>>Completed</option>
</select>
<input type='hidden' id='crsid' name='crsid' value="<?=$crsid?>">
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
<th class="col-xs-3 text-left">Username</th>
<th class="col-xs-2 text-center">Course Status</th>
<th class="col-xs-2 text-center">Time Spent</th>
<th class="col-xs-2 text-center">Completion Date</th>
   
                      </tr>
                    </thead>
					
					</table></div></div>	</section>
	</section>	-->
	<? 
}
?>	



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
<th class="col-xs-3 text-left">Name</th>
<th class="col-xs-3 text-left">Username</th>
<th class="col-xs-2 text-left">Course Status</th>
<th class="col-xs-2 text-left">Time Spent</th>
<th class="col-xs-2 text-left">Completion Date</th>
 </tr>
</thead>



<?

$i=0;$j=0;
while ($i < $num) {

$row = mysql_fetch_assoc($result);
$id = $row['id'];
$userrowid=mysql_result($result,$i,"A.id");
$usertype=mysql_result($result,$i,"A.usertype");
$uname=mysql_result($result,$i,"A.username");

$userCourseStatus=getUserCourseStatus($userrowid,$crsid);
$userCourseTime=getUserCourseTime($userrowid,$crsid);
$userCourseScore=getUserCourseScore($userrowid,$crsid);


$userCourseCompletionDate=getUserCompletionDate($userrowid,$crsid);
//echo $userCourseCompletionDate;
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
$uRole='Learner';
}
$userfullname=getFullNameFromID($userrowid);





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



if($cmbStatus=="")
{
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

if($userCourseStatus=='Passed'){
	
 $userCourseStatus='Completed' ;  
}

?>
<tr style="<?php echo $visible;?>">
<td class="col-xs-3 text-left"><? echo ucfirst(TrimString($userfullname)); ?></td>
<td class="col-xs-3 text-left"><? echo TrimString($uname); ?></td>
<td class="col-xs-2 text-left"><span <?php echo $colorClass;?>><? echo ucfirst($userCourseStatus); ?></span></td>
<td class="col-xs-2 text-left"><? if($userCourseTime != ""){ echo formatToNewTime($userCourseTime); }else{ echo "NA"; } ?></td>
<td class="col-xs-2 text-center"><? if($userCourseCompletionDateFormatted != ""){ echo $userCourseCompletionDateFormatted; }else{ echo "NA"; } ?></td>
</tr>
<?
$i++;
}


?>
</table> 
<?
if(!$num)
{
echo "<div class='noRecordeTable'><h4>No records found!</h4></div>	";
//exit;
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