<?php
 include ('../intface/adm_topOuter.php'); ?>


<script>
function openFile(docid,winWd,winHt,winRsz,winScl,winDir,winLoc,winMenu,winTool,winSts)
{

var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar='+winTool+',menubar='+winMenu+',resizable='+winRsz+',statusbar='+winSts+',scrollbars='+winScl+',location='+winLoc+',directories='+winDir;

var fpath="view.php?docid="+docid;

var fileWin=window.open(fpath,'fwind',settings);
fileWin.focus();
}

function openFileZip(docid,launchid,winWd,winHt,winRsz,winScl,winDir,winLoc,winMenu,winTool,winSts)
{

var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar='+winTool+',menubar='+winMenu+',resizable='+winRsz+',statusbar='+winSts+',scrollbars='+winScl+',location='+winLoc+',directories='+winDir;
//alert(settings);
var fpath="view.php?docid="+docid+"&launchid="+launchid;

var fileWin=window.open(fpath,'fwind',settings);
fileWin.focus();
}
//function to ask user whether he wants to delete the course or not
function confirmDelete()
{

	var found=0;
	if(document.deletecourse.choice.length!=null)
	{

	for (i=0; i<document.deletecourse.choice.length; i++) 
		{ 
			if (document.deletecourse.choice[i].checked) 
			{ 
			found=1;
			break;
			}
		}

		if(found==0)
		{
		alertify.alert("Please select course(s) to delete.");
		return false;
		}
	}
else
{

	if (document.deletecourse.choice.checked) 
	{ 
	found=1;
	//break;
	}
	if(found==0)
	{
	alertify.alert("Please select course(s) to delete.");
	return false;
	}
}

if(document.deletecourse.choice.length!=null)
{
for (i=0; i<document.deletecourse.choice.length; i++) 
{ 
if (document.deletecourse.choice[i].checked) 
{
/*if (confirm("Are you sure you want to delete the selected courses?"))
{
return true;
}
else
{
return false;
}*/
event.preventDefault(); // cancel submit
alertify.confirm("Are you sure you want to delete the selected countries? Please note that only the countries without any users assigned to it wiil be deleted.", function (e) {
				if (e) {
					alertify.success("You've clicked OK");
					document.deletecourse.submit();
					return true;
				} else {
					alertify.error("You've clicked Cancel");
					return false;

				}
			});
}
}
}
else
{
if (document.deletecourse.choice.checked) 
{
/*if (confirm("Are you sure you want to delete the selected courses?"))
{
return true;
}
else
{
return false;
}*/
event.preventDefault(); // cancel submit
alertify.confirm("Are you sure you want to delete the selected countries? Please note that only the countries without any users assigned to it wiil be deleted.", function (e) {
				if (e) {
					alertify.success("You've clicked OK");
					document.deletecourse.submit();
					return true;
				} else {
					alertify.error("You've clicked Cancel");
					return false;

				}
			});
}
}
}


checked=false;
function checkedAll (frm1) {
	var aa= document.getElementById('deletecourse');
	 if (checked == false)
          {
           checked = true
          }
        else
          {
          checked = false
          }
	for (var i =0; i < aa.elements.length; i++) 
	{
	 aa.elements[i].checked = checked;
	}
      }

function getCourse(rowId,file)
{
document.location.href="../../courses/"+rowId+"/"+file;
}

function getPackage(file)
{
document.location.href="../../courses/download/"+file;
}

window.onload = function(){
 setPageTitle('Manage courses');
}

</script>


<!-- -->
<?

/*
$result = mysql_query ("SELECT category_name FROM tbl_category where id='$catid'"); 
//echo "SELECT category_name FROM tbl_category where id='$catid'";

$category_name=mysql_result($result,0,"category_name");

*/
//get the status message if a new course has been uploaded
$successMsg=$_GET['msg'];

if (!isset($_GET['currpage'])) 
{
$currpage=0;
}
else
{
$currpage=$_GET['currpage'];
}
$startRecord=($currpage*$pageSplit);

//echo "SELECT A.course_id FROM tbl_b2client as A, tls_scorm as B where A.course_id=B.course and B.coursetype='WBT' and A.username='$userCourseId'";
$thisTotal = mysql_query ("SELECT A.course_id FROM tbl_b2client as A, tls_scorm as B where A.course_id=B.course and B.coursetype='WBT' and A.username='$userCourseId'"); 
$numCourses=mysql_numrows($thisTotal);
$arrCourseForUser=array();
$k=0;
	while ($k < $numCourses) {
	$row = mysql_fetch_assoc($thisTotal);
	$course_id=mysql_result($thisTotal,$k,"A.course_id");
	array_push($arrCourseForUser,$course_id);
	$k++;
	}
//print_r($arrCourseForUser); 
 
$resultList = mysql_query ("SELECT * FROM tls_scorm where coursetype='WBT' order by id asc"); 
$num=mysql_numrows($resultList);

?>

<!-- mid section -->
		
  <section class="panel panel-default  padder">
        <!-- breadcrumbs -->
        <section>
            <div class="panel-body nobot panelBg"  >
                <div class="col-lg-6 col-md-6 col-sm-6 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Course list </strong></span> </div>
                </div> 
 <div class="col-lg-6 col-md-6 col-sm-6 show-mon">
                    
                </div>  				
				</div>
            
        </section>
   <div class="rightHead text-center ">
        <section class="col-md-12 col-sm-12">
                        <div class="row m-l-none m-r-none bg-light lter">
                            
                            <div class="col-sm-4 col-md-4 padder-v  text-left"> <span class="pull-left m-r-sm  iconPadd"> </span>
                                <div class="clear" style="padding-top: 20px;"></div>
                                <a class="clear" href="#"> <span class="h3  m-t-xs"><strong>Total courses available</strong></span> <small class="text-muted text-uc count">(<? echo $num ?>)</small> </a> </div>
                             <div class="col-sm-4 col-md-4 padder-v  text-left"> <span class="pull-left m-r-sm  iconPadd"> </span>
                                <div class="clear" style="padding-top: 20px;"></div>
                                <a class="clear" href="#"> <span class="h3  m-t-xs"><strong>Course assigned</strong></span> <small class="text-muted text-uc count">(<?php echo $numCourses;?>)</small> </a> </div>
							</div>	 
                    </section>
             </div>   
  
   <div style="clear"></div>


<form name="deletecourse" id="deletecourse" action="usercourse_submit.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>&catid=<?=$catid?>" method="post" style="margin:0px;">



		
	<!--Responsive grid table -->
<?php if($num){ ?>	
				<!--Responsive grid table -->
<section class="panel panel-default  theadHeight" > 
				
	<?
	if(($perms==1) || $userid=='admin')
		{
	?>
	<input type='hidden' value="<?php echo $userCourseId;?>" id='userCourseId' name='userCourseId' />
	<div class="text-right deleteDiv">
	<input type='submit'class='btn' id='deleteuser' title='Assign course' value='&nbsp;Assign&nbsp;' >
	</div>
	<?
		}	
	?>		
	
 <div class="panel row teacher-student-wrap theadHeight">
                            <div class="promo" id="promo">
                                <table class="table m-b-none dataTable table-fixed">
                                    <thead  class="fixedHeader">
                                        <tr>
<?
	
	if($perms==1 || $perms=='user')
	{
?>
<!--<th width="5%"><input type='checkbox' name='checkall' onclick='checkedAll(deletecourse);'></th>-->
<?
	}	
?>
<th class="col-xs-1 text-center" ><?
if(($perms==1 && $category_created_by==$userid) || $userid=='admin')
	{
?>
<input type='checkbox' name='checkall' onclick='checkedAll(deletecourse);'>
<?
	}	
?></th>
<th class="col-xs-4 text-left" >Course Name</th>
<th class="col-xs-2 text-center" >Date Enrolled</th>
<th class="col-xs-2 text-center" >Expiry Date</th>
<th  class="col-xs-3 text-center" >Increase Expiry (Months)</th>

   
                      </tr>
                    </thead>
				</table>
                            </div>
                        </div>
                    </section> 
	
					
<?php } ?>	
	
	<section class="panel panel-default panelgridBg">
            <div class="panel row teacher-student-wrap">
                <!--Responsive grid table -->
                <div class="">

<?

//if courses not found
if (!$num)
{
?>


   <div  class="noRecordeTable">
<h4>Courses: <? echo $num ?></h4>
<h4>No courses available!</h4>
</div>


<?
//exit();
}
?>

  <table class="table m-b-none dataTable">
                 

<?
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($resultList);
$id = $row['id'];
$docid=mysql_result($resultList,$i,"course");
$fileTitle=mysql_result($resultList,$i,"name");
//$fileId=mysql_result($resultList,$i,"file_code");
/*
$checkResult = mysql_query ("SELECT * FROM tbl_category_course where category_id=$catid and course_id=$docid"); 
$checkNum=mysql_numrows($checkResult);
$tempString="";
if($checkNum)
{
$tempString='checked';
}
else
{
$tempString="";
}
*/
if(in_array($docid,$arrCourseForUser))
{
$tempString='checked';
}
else
{
$tempString="";
}

//mysql_close();
?>

<tr>
<?
if(($perms==1) || $userid=='admin')
	{
?>
<td class="col-xs-1 text-center" ><? echo "<input type='checkbox' ".$tempString." id='choice' name='choice[]' value='$docid'>" ?></td>
<?
	}	
?>
<td class="col-xs-4 text-left" ><? echo ucfirst(TrimStringCourseTitleBig($fileTitle)); ?></td>
<td class="col-xs-2 text-center" ><? echo parseDateNatural(getEnrollmentDate($docid,$userCourseId)); ?></td>
<td class="col-xs-2 text-center" ><? echo parseDateNatural(getExpiryDate($docid,$userCourseId)); ?></td>
<td class="col-xs-3 text-center" >
<?php 
if(parseDateNatural(getExpiryDate($docid,$userCourseId))!="NA")
{
?>
<select id='iMonths' name='iMonths[]' style='width:70px;' class='content'>
<option value="">Select</option>
<?php
for($k=1;$k<=12;$k++)
{
	echo "<option value='$docid - $k'>$k</option>";
}
?></select>
<?php
}
else
{
echo "NA";
}
?>
</td>

</tr>


<?
$i++;
}


?>
</table>

</div>
                <div class="panel-footer">
                    <div class="row-centered">
                        <div class="col-sm-12 col-xs-12 col-centered">
                            <div class="text-center">
                                <table width="100%"  cellspacing="0" cellpadding="3">
                                    <tr height='5px'>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td align='center' class='contentBold'>
					 </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <!-- row end here -->
       </section>
	  
        </form>
  <?php include ('../intface/footer.php');
                                            ?>



