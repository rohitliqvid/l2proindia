<?php
session_start();
ini_set('display_errors', false);
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}
//Variable to hold the no of records in which the display is splitted
//$pageSplit=5;
$perms=$_SESSION['perms'];
$catid=$_REQUEST['id'];

function mysql_escape_mimic($inp) {

    if(is_array($inp))
    return array_map(__METHOD__, $inp);
    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);

    }
    return $inp;
}


$cCategory=trim($_REQUEST['cCategory']);
$cContent=trim($_REQUEST['cContent']);
//echo "--> ".$cCategory;
$cCode=trim($_REQUEST['cCode']);
$cTitle=trim(mysql_escape_mimic(htmlspecialchars($_REQUEST['cTitle'])));
$cDesc=trim(mysql_escape_mimic(htmlspecialchars($_REQUEST['cDesc'])));
$cGroup=trim(mysql_escape_mimic(htmlspecialchars($_REQUEST['cGroup'])));
$cKey=trim($_REQUEST['cKey']);
if ($cGroup == "") {
    $cGroup = 'Basic';
}
else if ($cGroup == 'Advance') {
    $cGroupName = "Advanced";
} else if ($cGroup == 'Intermediate') {
    $cGroupName = 'Intermediate';
}
else
{
$cGroupName = '';
}

if($cCategory!="" || $cCode!="" || $cTitle!="" || $cDesc!="" || $cKey!="" || $cContent!="")
{
$searchmsg='1';
}
else
{
$searchmsg='0';
}

?>
<?php include ('../intface/adm_top.php'); ?>


<style>
.nav-tabs > li,nav-tabs > li > a {
    float: left; 
    width: 33.0%; color: #fff;
    margin-bottom: -1px;border-radius: 10px 10px 0 0; background-color: #00558e;
	}
.nav-tabs > li > a,nav-tabs > li > a:hover,nav-tabs > li:hover {  text-align:center;font-size:16px;
  margin-right: 0px;border-radius: 10px 10px 0 0;
    color: #fff;
    cursor: pointer;
    background-color: #00558e;
    border: 1px solid #054b79;
    border-bottom-color: transparent;
}
.nav-tabs > li {
   margin-right: 5px; 
}
.nav-tabs > li.active {
    color: #fff; margin-right: 5px;
    background-color: #ffb901!important;
}
.nav-tabs > li:last-child,.nav-tabs > li.active:last-child{margin-right: 0px;}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #fff!important; margin-right: 0px;
    cursor: pointer;
    background-color: #ffb901!important;
    border: 1px solid #ffb901;
    border-bottom-color: transparent;
}
nav-tabs > li > a:hover {
    border-color: #ffb901 #ffb901 #ffb901;
}
.nav > li > a:hover, .nav > li > a:focus {
    text-decoration: none; color: #fff!important;
    background-color: #00558e!important; border: 1px solid #054b79;
}
.table-responsive45 {
    padding-top: 10px;
    border-top: 1px solid #ddd;
}
.promo .table thead {
   padding-top:10px;
}
.panel-footer {
   
    padding: 10px 0px;
   
}
</style>
<script>

function setEditContentVars(docid)
{
	parent.HeaderPanel.isEdit=true;
	parent.HeaderPanel.docId=docid;
	alert("This functionality is not available!");
	////document.location='../web/japplet.html';

}

function launch_content(cid,scoid,width,height) 
{
//	alert(scoid);
			/////generic code//////	
var w = width;
var h = height;
var winl = (screen.width-w)/2;
var wint = (screen.height-h)/2;
if (winl < 0) winl = 0;
if (wint < 0) wint = 0;
windowprops = "height="+h+",width="+w+",top="+ wint +",left="+ winl +",location=no,"+ "scrollbars=no,menubars=no,toolbars=no,resizable=no,status=no,directories=no";
path="playscorm.php?cid="+cid+"&scoid="+scoid;
	var con_window=window.open(path,"win",windowprops);	
	con_window.focus();
}


function showReport(crsid)
{
var winWd=1024;
var winHt=768;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no';
var fpath="report.php?crsid="+crsid;
var logwin=window.open(fpath,'logwin',settings);
logwin.focus();
}


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
//Function to confirm if the user wants to delete the selected requests or not
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
if (confirm("Are you sure you want to delete selected courses?"))
{
return true;
}
else
{
return false;
}
}
}
}
else
{
if (document.deletecourse.choice.checked) 
{
if (confirm("Are you sure you want to delete selected courses?"))
{
return true;
}
else
{
return false;
}
}
}
}

function submitSearch()
{
document.searchcourse.submit();
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

function courseGroupSubmit(group)
{

document.getElementById('cGroup').value=group;
document.searchcourse.submit();
}

window.onload = function(){
setPageTitle('Courses');}
</script>
<!-- -->
<?

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


$joinQuery="WHERE 1=1";
$joinTable="";


if($cCategory!="")
{
$joinTable=", tbl_category_course AS B ";
$joinQuery.=" AND A.id=B.course_id and B.category_id=$cCategory";

}
else
{
$joinTable="";

}

if($cTitle!="")
{
$joinQuery.=" AND A.name LIKE '%$cTitle%'";
}

if($cDesc!="")
{
$joinQuery.=" AND  A.summary LIKE '%$cDesc%'";
}

if($cGroup!="")
{
$joinQuery.=" AND  A.course_level = '$cGroup'";
}


//select all the courses from the database

$con=createConnection();
$query1 = "SELECT A.id,A.name,A.summary,A.width,A.height,A.version,A.coursetype,A.course_type FROM tls_scorm AS A ".$joinTable.$joinQuery." AND A.course_type='course' ORDER BY A.name + 0 DESC";
$result = mysqli_query($con,$query1);
$totalnum=mysqli_num_rows($result);


$query2 = "SELECT A.id,A.name,A.summary,A.width,A.height,A.version,A.coursetype,A.course_type FROM tls_scorm AS A ".$joinTable.$joinQuery." ORDER BY A.id + 0 ASC LIMIT $startRecord,$pageSplit";
$resultList = mysqli_query($con,$query2);
$num=mysqli_num_rows($resultList);
$totalPages = ceil($totalnum / $pageSplit);



$query3 = "SELECT * FROM tbl_category ORDER BY category_name ASC";
$catResult = mysqli_query($con,$query3);
$cattotalnum=mysqli_num_rows($catResult);

?>

  <section class="panel panel-default  padder">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg" style="margin-top:20px">
		<div class="col-lg-12 col-md-12 col-sm-12 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Courses </strong></span> </div>
		 
		</div>
		 </div>
		<div class="col-lg-12 col-sm-12 col-md-12 "  style="height:60px;margin-top:10px;margin-bottom:0px">	 
        <form name="searchcourse" action="#" method="post">
          <div class="col-sm-1"></div>
          <div class="pull-right text-right searchbg">
            <div class="search inline"> <span>
            Search by Course Title:&nbsp;<input name="cTitle" class="input-sm form-control  searchbtn" placeholder="Search" type="text" id="cTitle" size="15" maxlength="30" value='<?=htmlspecialchars($cTitle)?>'>  &nbsp;Description:&nbsp;<input name="cDesc" value='<?=htmlspecialchars($cDesc)?>' class="input-sm form-control  searchbtn" type="text" id="cDesc" size="15" maxlength="30" ><input name="cGroup" value='<?=htmlspecialchars($cGroup)?>' type="hidden" id="cGroup" size="15" maxlength="30" >
              <!--<i class="fa fa-search"></i>-->
              <button type="submit" id="search" name="search" class="btn btn-sm btn-blue searchButton" onclick='submitSearch();' title='Search courses matching specified criteria'>Search</button>
              </span> <span class="text-right"> <a href="waiting_documents.php" class="btn  btn-blue btn-reset">Refresh</a> </span> </div>
          </div>
        </form>
    </div>
</section>
<!--<section class="">
<img src="../../images/course.jpg" class="img-responsive" style="width:100%;height:260px">
</section>
-->

<section class="">

		<div class="rightHead text-center bgWt" style='min-height:40px'>
		   
			<section class="col-md-12 col-sm-12">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-4 col-md-4 text-left" style="padding-left: 0px;">
                   
					<div class="clear" style="padding-top:0px;"></div>
                    <a class="clear" href="#">
                      <span class="h3  m-t-xs"><strong><?php echo $cGroupName;?> Courses:</strong></span>
                      <small class="text-muted text-uc count"><? echo $totalnum ?></small>
                    </a>
                  </div>
				  <!--<div class="col-sm-7 col-md-7 padder-v text-right">
                                <div class="clear" style="padding-top: 20px;"></div>
                              &nbsp;&nbsp;&nbsp;<a class="btn btn-lg btn-default bdrRadius20"  href='upload_form.php'  title='Add New Course'><i class="fa fa fa-plus"></i>  Add New Course</a> </div>
				 <div class="col-sm-4 col-md-4 padder-v text-right">
                    
					<div class="clear" style="padding-top: 20px;"></div>
                  <a  class="btn btn-lg btn-voilet" id="btnBuildCourse" name="btnBuildCourse" href="#" title="Add New Course"> <i class="build fa fa fa-plus"></i> Add New Course</a> 
                  </div>
                </div>->
              </section>
		  </div>	
	
	<!--Responsive grid table -->
</div>
	
	 </section>

</section>

<form name="deletecourse" onSubmit="return confirmDelete();" action="approval.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>&catid=<?=$catid?>&trec=<?=$totalnum?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>&from_page=w" method="post">

       <section class="scrollable">
	   
	   <section class="panel panel-default panelgridBg">
			  <div class="panel row teacher-student-wrap" style=" margin-top:20px;">
				<ul class="nav nav-tabs">
					<?php
					if($cGroup=='Basic')
					{
					?>
					<li class="active"><a data-toggle="tab" href="#basic" onclick="courseGroupSubmit('Basic');">Basic</a></li>
					<?php
					}
					else
					{
					?>
					<li><a data-toggle="tab" href="#basic" onclick="courseGroupSubmit('Basic');">Basic</a></li>
					<?php
					}
					?>


					<?php
					if($cGroup=='Intermediate')
					{
					?>
					<li class="active"><a data-toggle="tab" href="#intermediate" onclick="courseGroupSubmit('Intermediate');">Intermediate</a></li>
					<?php
					}
					else
					{
					?>
					<li><a data-toggle="tab" href="#intermediate" onclick="courseGroupSubmit('Intermediate');">Intermediate</a></li>
					<?php
					}
					?>

					<?php
					if($cGroup=='Advance')
					{
					?>
					<li class="active"><a data-toggle="tab" href="#advanced" onclick="courseGroupSubmit('Advance');">Advanced</a></li>
					<?php
					}
					else
					{
					?>
					<li><a data-toggle="tab" href="#advanced" onclick="courseGroupSubmit('Advance');">Advanced</a></li>
					<?php
					}
					?>


				  </ul>

				<div class="tab-content" style="    border: 1px solid #0000002b;border-radius:0px;border-top:0px;">
					<div id="basic" class="tab-pane fade in active">
					 <!--Responsive grid table -->
					 <div class="table-responsive promo courseGroup table-responsive45">

						
					<?
					//if courses not found
					if (!$num)
					{
					?>
					<div  class="noRecordeTable">
					<?
					if($searchmsg=='1')
						{
					echo "<h4>No results found! Search again.</h4>";
						}
					else
					{
					echo "<h4>Courses not available!</h4>";
					}
					?>
					</div>

					<?
					//exit();
					}
					?>



					<table class="table m-b-none dataTable">
					<thead  >   
					<tr>
					<th class="col-xs-3 text-left">Course Title</th>
					<th class="col-xs-2 text-center" style='text-align:center'>Course Type</th>
					<th class="col-xs-3 text-center" style='text-align:center'>Package Type</th>
					<th  class="col-xs-2 text-center" style='text-align:center'>Launch</th>
					<th  class="col-xs-2 text-center" style='text-align:center'>Usage Report</th>
					</tr>
					</thead>

					<?
					$i=0;
					while ($i < $num) {

					 $row = mysqli_fetch_assoc($resultList);
					$id = $row['id'];
					$docid=$row['id'];


					$queryPublished = "SELECT * FROM tbl_category ORDER BY category_name ASC";
					$PublishedList = mysqli_query($con,$queryPublished);
					$PublishedListNum=mysqli_num_rows($PublishedList);

					if($PublishedListNum=='0')
					{
					$strStatus="<span class='nreleased'>Not released</span>";
					$linkStatus="Assign";
					}
					else
					{
					$strStatus="<span class='released'>Released</span>";
					$linkStatus="Reassign";
					}


					$fileTitle=$row['name'];
					$fileId=$row['summary'];
					$sWidth=$row['width'];
					$sHeight=$row['height'];
					$avail=$row['coursetype'];
					//$versioninfo=$row['version_info'];
					$fileversion=$row['version'];
					$courseType=$row['course_type'];
					if($courseType=='course'){}
					else{$classColor='style="background-color:#cadab8"';}
					if($fileType=='file' && $fileMimeType=='zip')
						{
						$mypath="../../courses/".$docid."/".$fileLaunch;
						}


					//mysql_close();

					if($i%2==0)
					 $bgc="row1";
							else
					$bgc="row2";
					?>

					<tr <?php echo $classColor; ?>>
					<?
						if($perms==1 || $perms=='user')
						{
					?>
					<!-- <td align="center"><? echo "<input type='checkbox' id='choice' name='choice[]' value='$docid'>" ?></td>-->
					<?
						}	
					?>
					<td class="col-xs-3 text-left"><a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href='course_modify.php?docid=<?=$docid?>&catid=<?=$catid?>&cp=<?=$currpage?>&tp=<?=$totalPages?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>' title="<?=ucfirst($fileTitle); ?>"><? echo TrimString($fileTitle); ?></a></td>

					<td class="col-xs-2 text-center"><?php echo $avail?></td>
					<td class="col-xs-3 text-center"><?=$fileversion;?></td>

					<td class="col-xs-2 text-center">

					<a onFocus='this.blur()' onMouseOver='return showStatus();' title='Launch course' href="javascript:launch_content(1,<?=$docid?>,<?=$sWidth?>,<?=$sHeight?>);"><!--<i class="fa fa-search"></i>--><img src='../../images/start-icon.png' border='0' width='20px' /></a>

							
				<!--	<a title='Launch course' ><i class="fa fa-search"></i></a>-->
					</td>



					<!--<td align="center" class="Content"><a a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href="publish_document.php?docid=<?=$docid?>&cp=<? echo $currpage?>&tp=<? echo $totalPages?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>&from_page=w" title="Assign to categories"><?=$linkStatus?></a></td>-->

					<!--<td class="col-xs-2 text-center"><a href='#' onFocus='this.blur()' a class='listitems' onclick='showReport(<?=$docid?>);' title="View Course Report">View</a></td>-->
					<td class="col-xs-2 text-center"><a href='#' onFocus='this.blur()' a class='listitems' onclick='showReport(<?=$docid?>);' title="View Course Report"><u>View</u></a></td>
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
                 
					<div class="text-center"><table width="100%"  cellspacing="0" cellpadding="3">
<tr height='5px'><td></td></tr>
<tr><td align='center' class='contentBold'>

<?
if($currpage!=0)
{
?>

<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=0&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="First page">First page</a>

<?
}
?>

<?
if($currpage!=0)
{
?>

&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $currpage-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Previous page">Previous page</a>

<?
}
?>

<?
if($totalPages>1)
{
$pagenum;
$temp=ceil(($currpage+1)/5);
$tempstart=5*($temp-1)+1;
$tempend;

if($tempstart+$pageSplit>$totalPages)
{
$tempend=$totalPages;
}
else
{
$tempend=$tempstart+$pageSplit;
}

for($j=$tempstart;$j<=$tempend;$j++)
{
if($j==$currpage+1)
{
$pagenum="<font color='#666666'>".$j."</font>";
?>
&nbsp;&nbsp;<?echo $pagenum ?>
<?
}
else
{
$pagenum=$j;
?>
&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $j-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="<?=$pagenum?>"><?echo $pagenum ?></a>
<?
}
?>

<?
}
}
?>


<?
if($currpage+1<$totalPages)
{
?>

&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $currpage+1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Next page">Next page</a>

<?
}
?>
<?
if($currpage+1<$totalPages)
{
?>
&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $totalPages-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Last page">Last page</a>
<?
}	
?>

</td></tr>
<tr height='5px'><td></td></tr>
<!--
<tr><td align='center'>
<input type='submit' class='submit_button_normal'  id='deletedoc' name='deletedoc' title='Delete selected course(s)' value='&nbsp;Delete&nbsp;' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">

</td></tr>
-->
</table></div>
                  </div>  </div></div>
			
				</div>
				<div id="intermediate" class="tab-pane">
					 <!--Responsive grid table -->
					 <div class="table-responsive promo courseGroup table-responsive45">

						
					<?
					//if courses not found
					if (!$num)
					{
					?>
					<div  class="noRecordeTable">
					<?
					if($searchmsg=='1')
						{
					echo "<h4>No results found! Search again.</h4>";
						}
					else
					{
					echo "<h4>Courses not available!</h4>";
					}
					?>
					</div>

					<?
					//exit();
					}
					?>



					<table class="table m-b-none dataTable">
					<thead  >   
					<tr>
					<th class="col-xs-3 text-left" >Course Title</th>
					<th class="col-xs-2 text-center" >Course Type</th>
					<th class="col-xs-3 text-center" >Package Type</th>
					<th  class="col-xs-2 text-center" >Launch</th>
					<th  class="col-xs-2 text-center" align='center'>Usage Report</th>
					</tr>
					</thead>

					<?
					$i=0;
					while ($i < $num) {

					$row = mysqli_fetch_assoc($resultList);
					$id = $row['id'];
					$docid=$row['A.id'];


					$queryPublished = "SELECT * FROM tbl_category ORDER BY category_name ASC";
					$PublishedList = mysqli_query($con,$queryPublished);
					$PublishedListNum=mysqli_num_rows($PublishedList);
					if($PublishedListNum=='0')
					{
					$strStatus="<span class='nreleased'>Not released</span>";
					$linkStatus="Assign";
					}
					else
					{
					$strStatus="<span class='released'>Released</span>";
					$linkStatus="Reassign";
					}


					$fileTitle=$row['name'];
					$fileId=$row['summary'];
					$sWidth=$row['width'];
					$sHeight=$row['height'];
					$avail=$row['coursetype'];
					//$versioninfo=$row['version_info'];
					$fileversion=$row['version'];
					$courseType=$row['course_type'];
					if($courseType=='course'){}
					else{$classColor='style="background-color:#cadab8"';}
					if($fileType=='file' && $fileMimeType=='zip')
						{
						$mypath="../../courses/".$docid."/".$fileLaunch;
						}


					//mysql_close();

					if($i%2==0)
					 $bgc="row1";
							else
					$bgc="row2";
					?>

					<tr <?php echo $classColor; ?>>
					<?
						if($perms==1 || $perms=='user')
						{
					?>
					<!-- <td align="center"><? echo "<input type='checkbox' id='choice' name='choice[]' value='$docid'>" ?></td>-->
					<?
						}	
					?>
					<td class="col-xs-3 text-left"><a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href='course_modify.php?docid=<?=$docid?>&catid=<?=$catid?>&cp=<?=$currpage?>&tp=<?=$totalPages?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>' title="<?=ucfirst($fileTitle); ?>"><? echo TrimString($fileTitle); ?></a></td>

					<td class="col-xs-2 text-center"><?=$avail?></td>
					<td class="col-xs-3 text-center"><?=$fileversion;?></td>

					<td class="col-xs-2 text-center">

					<a onFocus='this.blur()' onMouseOver='return showStatus();' title='Launch course' href="javascript:launch_content(1,<?=$docid?>,<?=$sWidth?>,<?=$sHeight?>);"><!--<i class="fa fa-search"></i>--><img src='../../images/start-icon.png' border='0' width='20px' /></a>

							
				<!--	<a title='Launch course' ><i class="fa fa-search"></i></a>-->
					</td>



					<!--<td align="center" class="Content"><a a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href="publish_document.php?docid=<?=$docid?>&cp=<? echo $currpage?>&tp=<? echo $totalPages?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>&from_page=w" title="Assign to categories"><?=$linkStatus?></a></td>-->

					<!--<td class="col-xs-2 text-center"><a href='#' onFocus='this.blur()' a class='listitems' onclick='showReport(<?=$docid?>);' title="View Course Report">View</a></td>-->
					<td class="col-xs-2 text-center"><a href='#' onFocus='this.blur()' a class='listitems' onclick='showReport(<?=$docid?>);' title="View Course Report"><u>View</u></a></td>
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
							<tr height='5px'><td></td></tr>
							<tr><td align='center' class='contentBold'>

							<?
							if($currpage!=0)
							{
							?>

							<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=0&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="First page">First page</a>

							<?
							}
							?>

							<?
							if($currpage!=0)
							{
							?>

							&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $currpage-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Previous page">Previous page</a>

							<?
							}
							?>

							<?
							if($totalPages>1)
							{
							$pagenum;
							$temp=ceil(($currpage+1)/5);
							$tempstart=5*($temp-1)+1;
							$tempend;

							if($tempstart+$pageSplit>$totalPages)
							{
							$tempend=$totalPages;
							}
							else
							{
							$tempend=$tempstart+$pageSplit;
							}

							for($j=$tempstart;$j<=$tempend;$j++)
							{
							if($j==$currpage+1)
							{
							$pagenum="<font color='#666666'>".$j."</font>";
							?>
							&nbsp;&nbsp;<?echo $pagenum ?>
							<?
							}
							else
							{
							$pagenum=$j;
							?>
							&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $j-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="<?=$pagenum?>"><?echo $pagenum ?></a>
							<?
							}
							?>

							<?
							}
							}
							?>


							<?
							if($currpage+1<$totalPages)
							{
							?>

							&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $currpage+1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Next page">Next page</a>

							<?
							}
							?>
							<?
							if($currpage+1<$totalPages)
							{
							?>
							&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $totalPages-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Last page">Last page</a>
							<?
							}	
							?>

							</td></tr>
							<tr height='5px'><td></td></tr>
							<!--
							<tr><td align='center'>
							<input type='submit' class='submit_button_normal'  id='deletedoc' name='deletedoc' title='Delete selected course(s)' value='&nbsp;Delete&nbsp;' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">

							</td></tr>
							-->
							</table>
							</div>
                  </div>  
				  </div>
				  </div>
			
				</div>
				<div id="advanced" class="tab-pane">
					 <!--Responsive grid table -->
					 <div class="table-responsive promo courseGroup table-responsive45">

						
					<?
					//if courses not found
					if (!$num)
					{
					?>
					<div  class="noRecordeTable">
					<?
					if($searchmsg=='1')
						{
					echo "<h4>No results found! Search again.</h4>";
						}
					else
					{
					echo "<h4>Courses not available!</h4>";
					}
					?>
					</div>

					<?
					//exit();
					}
					?>



					<table class="table m-b-none dataTable">
					<thead  >   
					<tr>
					<th class="col-xs-3 text-left" >Course Title</th>
					<th class="col-xs-2 text-center" >Course Type</th>
					<th class="col-xs-3 text-center" >Package Type</th>
					<th  class="col-xs-2 text-center" >Launch</th>
					<th  class="col-xs-2 text-center" align='center'>Usage Report</th>
					</tr>
					</thead>

					<?
					$i=0;
					while ($i < $num) {

					$row = mysql_fetch_assoc($resultList);
					$id = $row['id'];
					$docid=$row['id'];


					$queryPublished = "SELECT * FROM tbl_category ORDER BY category_name ASC";
					$PublishedList = mysqli_query($con,$queryPublished);
					$PublishedListNum=mysqli_num_rows($PublishedList);
					if($PublishedListNum=='0')
					{
					$strStatus="<span class='nreleased'>Not released</span>";
					$linkStatus="Assign";
					}
					else
					{
					$strStatus="<span class='released'>Released</span>";
					$linkStatus="Reassign";
					}


					$fileTitle=$row['name'];
					$fileId=$row['summary'];
					$sWidth=$row['width'];
					$sHeight=$row['height'];
					$avail=$row['coursetype'];
					//$versioninfo=$row['version_info'];
					$fileversion=$row['version'];
					$courseType=$row['course_type'];
					if($courseType=='course'){}
					else{$classColor='style="background-color:#cadab8"';}
					
					if($fileType=='file' && $fileMimeType=='zip')
						{
						$mypath="../../courses/".$docid."/".$fileLaunch;
						}


					//mysql_close();

					if($i%2==0)
					 $bgc="row1";
							else
					$bgc="row2";
					?>

					<tr <?php echo $classColor; ?>>
					<?
						if($perms==1 || $perms=='user')
						{
					?>
					<!-- <td align="center"><? echo "<input type='checkbox' id='choice' name='choice[]' value='$docid'>" ?></td>-->
					<?
						}	
					?>
					<td class="col-xs-3 text-left"><a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href='course_modify.php?docid=<?=$docid?>&catid=<?=$catid?>&cp=<?=$currpage?>&tp=<?=$totalPages?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>' title="<?=ucfirst($fileTitle); ?>"><? echo TrimString($fileTitle); ?></a></td>

					<td class="col-xs-2 text-center"><?=$avail?></td>
					<td class="col-xs-3 text-center"><?=$fileversion;?></td>

					<td class="col-xs-2 text-center">

					<a onFocus='this.blur()' onMouseOver='return showStatus();' title='Launch course' href="javascript:launch_content(1,<?=$docid?>,<?=$sWidth?>,<?=$sHeight?>);"><!--<i class="fa fa-search"></i>--><img src='../../images/start-icon.png' border='0' width='20px' /></a>

							
				<!--	<a title='Launch course' ><i class="fa fa-search"></i></a>-->
					</td>



					<!--<td align="center" class="Content"><a a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href="publish_document.php?docid=<?=$docid?>&cp=<? echo $currpage?>&tp=<? echo $totalPages?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>&from_page=w" title="Assign to categories"><?=$linkStatus?></a></td>-->

					<!--<td class="col-xs-2 text-center"><a href='#' onFocus='this.blur()' a class='listitems' onclick='showReport(<?=$docid?>);' title="View Course Report">View</a></td>-->
					<td class="col-xs-2 text-center"><a href='#' onFocus='this.blur()' a class='listitems' onclick='showReport(<?=$docid?>);' title="View Course Report"><u>View</u></a></td>
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
							<tr height='5px'><td></td></tr>
							<tr><td align='center' class='contentBold'>

							<?
							if($currpage!=0)
							{
							?>

							<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=0&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="First page">First page</a>

							<?
							}
							?>

							<?
							if($currpage!=0)
							{
							?>

							&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $currpage-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Previous page">Previous page</a>

							<?
							}
							?>

							<?
							if($totalPages>1)
							{
							$pagenum;
							$temp=ceil(($currpage+1)/5);
							$tempstart=5*($temp-1)+1;
							$tempend;

							if($tempstart+$pageSplit>$totalPages)
							{
							$tempend=$totalPages;
							}
							else
							{
							$tempend=$tempstart+$pageSplit;
							}

							for($j=$tempstart;$j<=$tempend;$j++)
							{
							if($j==$currpage+1)
							{
							$pagenum="<font color='#666666'>".$j."</font>";
							?>
							&nbsp;&nbsp;<?echo $pagenum ?>
							<?
							}
							else
							{
							$pagenum=$j;
							?>
							&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $j-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="<?=$pagenum?>"><?echo $pagenum ?></a>
							<?
							}
							?>

							<?
							}
							}
							?>


							<?
							if($currpage+1<$totalPages)
							{
							?>

							&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $currpage+1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Next page">Next page</a>

							<?
							}
							?>
							<?
							if($currpage+1<$totalPages)
							{
							?>
							&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<? echo $totalPages-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Last page">Last page</a>
							<?
							}	
							?>

							</td></tr>
							<tr height='5px'><td></td></tr>
							<!--
							<tr><td align='center'>
							<input type='submit' class='submit_button_normal'  id='deletedoc' name='deletedoc' title='Delete selected course(s)' value='&nbsp;Delete&nbsp;' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">

							</td></tr>
							-->
							</table>
							</div>
                  </div>  
				  </div>
				  </div>
			
				</div>
				
            
            </div>
     </div>    
          <!-- row end here -->
        </section>  </section> 
		</form>
<?php
include ('../intface/footer.php');
?>
