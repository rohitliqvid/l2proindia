<?php include ('../intface/std_top.php'); 
error_reporting(E_ALL);
ini_set("display_errors", 0);
//Variable to hold the no of records in which the display is splitted
$pageSplit=10;
 $perms=$_SESSION['perms'];
 $catid=$_REQUEST['id'];

$cCategory=trim($_REQUEST['cCategory']);
$cContent=trim($_REQUEST['cContent']);
$cCode=trim($_REQUEST['cCode']);
$cTitle=trim($_REQUEST['cTitle']);
$cDesc=trim($_REQUEST['cDesc']);
$cKey=trim($_REQUEST['cKey']);


$user_rowid=getUserId($userid);

$user_comp_id=getUserCompanyId($user_rowid);


//exit;
?>

<script>
function openFile(docid,winWd,winHt,winRsz,winScl,winDir,winLoc,winMenu,winTool,winSts)
{

var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar='+winTool+',menubar='+winMenu+',resizable='+winRsz+',statusbar='+winSts+',scrollbars='+winScl+',location='+winLoc+',directories='+winDir;
var fpath="view.php?docid="+docid;
//alert(fpath);
var fileWin=window.open(fpath,'fwind',settings);
fileWin.focus();
}
//function to ask user whether he wants to delete the course or not
//Function to confirm if the user wants to delete the selected requests or not

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
function submitSearch()
{
document.searchcourse.submit();
}


function getCourse(rowId,file)
{
document.location.href="../../courses/"+rowId+"/"+file;
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



function getPackage(file)
{
alert("This option is not available to Guests!");
//document.location.href="../../courses/download/"+file;
}
</script>

<?




//$result = mysql_query ("SELECT category_name FROM tbl_category where id='$catid'"); 
//$category_name=mysql_result($result,0,"category_name");

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


//$joinQuery="WHERE 1=1";
$joinTable="";


if($cCategory!="")
{
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



if($cCategory!="" || $cCode!="" || $cTitle!="" || $cDesc!="" || $cKey!="" || $cContent!="")
{
$searchmsg='1';
}
else
{
$searchmsg='0';
}

//select all the courses from the database

/*echo "SELECT * FROM tbl_courses AS A, tbl_company_COURSE AS B WHERE A.id=B.course_id  AND B.company_id='$user_comp_id'".$joinQuery." ORDER BY A.upload_date ASC";
exit;*/



$result = mysql_query ("SELECT DISTINCT A.id,A.name,A.summary,A.width,A.height,A.version FROM tls_scorm AS A, tbl_category_course AS B, tbl_company_category AS C WHERE A.id=B.course_id  AND B.category_id=C.category_id AND C.company_id='$user_comp_id'".$joinQuery." ORDER BY A.name + 0 DESC"); 
$totalnum=mysql_numrows($result);

$resultList = mysql_query ("SELECT DISTINCT A.id,A.name,A.summary,A.width,A.height,A.version FROM tls_scorm AS A, tbl_category_course AS B, tbl_company_category AS C WHERE A.id=B.course_id  AND B.category_id=C.category_id AND C.company_id='$user_comp_id'".$joinQuery." ORDER BY A.name + 0 DESC LIMIT $startRecord,$pageSplit"); 
$num=mysql_numrows($resultList);
$totalPages=ceil($totalnum/$pageSplit);
//mysql_close();



$catResult = mysql_query ("SELECT * FROM tbl_category AS A, tbl_company_category AS B WHERE A.id=B.category_id AND B.company_id='$user_comp_id' ORDER BY category_name ASC"); 
$cattotalnum=mysql_numrows($catResult);

//if courses not found
if (!$num)
{
?>
<section id="content" class="rightside rightContenBg">

<section class="padder topMenuContentList">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-2 col-md-2 col-sm-2 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Course list </strong></span> </div>
		 
		</div>
		
		<div class="col-lg-10 col-sm-10 col-md-10 tablegrid pull-right">
      <div class="row">
	 
    <form name="searchcourse" action="courses.php" method="post">

      
          <div class="pull-right text-right searchbg">
            <div class="search inline"> <span>
    
        <select name="cCategory" id="cCategory" onChange='submitSearch();' class='inputcls input-sm form-control' style='width:200px'>
	<option value="">All categories</option>
	<?
			$m=0;
			while ($m < $cattotalnum) {

			$row = mysql_fetch_assoc($catResult);
			$id = $row['id'];
			$categoryid=mysql_result($catResult,$m,"id");
			$categoryname=mysql_result($catResult,$m,"category_name");
		if($cCategory==$categoryid)
			{
				$isSel='selected';
			}
			else
			{
			$isSel='';
			}
			?>
				<OPTION  value="<?php echo $categoryid; ?>" <?php echo $isSel?>><? echo $categoryname; ?></OPTION>
			<?
			$m++;
			}	
	?>             
	</select>&nbsp;&nbsp;Title:&nbsp;
      <input name="cTitle" class='inputcls input-sm form-control' type="text" id="cTitle" size="15" maxlength="30" value='<?=$cTitle?>'>&nbsp;&nbsp;Description:&nbsp;
      <input name="cDesc" value='<?=$cDesc?>' class='inputcls input-sm form-control' type="text" id="cDesc" size="15" maxlength="30"> 
	
	
              <!--<i class="fa fa-search"></i>-->
              <button type="submit" id='Go' title='Search users matching specified criteria' name="Go" class="btn btn-sm btn-blue searchButton" onclick='submitSearch();' >Search</button>
           </span> <span class="text-right"> <a href="courses.php" class="btn  btn-blue btn-reset">Refresh</a> </span> </div>
          </div>
        </form>
      </div>
    </div>
		
  </div>
  
  
</section>
<section class="">

		<div class="rightHead text-center bgWt">
		   
			<section class="col-md-12 col-sm-12">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-4 col-md-4 padder-v  text-left">
                   
					<div class="clear" style="padding-top: 20px;"></div>
                    <a class="clear" href="#">
                      <span class="h3  m-t-xs"><strong>Total courses</strong></span>
                      <small class="text-muted text-uc count">(<? echo $totalnum ?>)</small>
                    </a>
                  </div>
				    <div class="col-sm-7 col-md-7 padder-v text-right">
                              
</div>
	
	 </section>

</section>




<form name="searchcourse" action="courses.php" method="post">
<!-- <table border="0" width="100%" cellspacing="0" cellpadding="4" class='tblborder'>
<tr height='10'><td colspan='2'></td></tr>
 <tr> 
    <td valign="top" class="Content">&nbsp;&nbsp;Select Category:&nbsp;&nbsp;
	<select name="cCategory" id="cCategory" onChange='submitSearch();' class='inputcls' style='width:200px'>
	<option value="">All categories</option>
	<?
			$m=0;
			while ($m < $cattotalnum) {

			$row = mysql_fetch_assoc($catResult);
			$id = $row['id'];
			$categoryid=mysql_result($catResult,$m,"id");
			$categoryname=mysql_result($catResult,$m,"category_name");
		if($cCategory==$categoryid)
			{
				$isSel='selected';
			}
			else
			{
			$isSel='';
			}
			?>
				<OPTION  value="<?php echo $categoryid; ?>" <?php echo $isSel?>><? echo $categoryname; ?></OPTION>
			<?
			$m++;
			}	
	?>             
	</select>&nbsp;&nbsp;Title:&nbsp;
      <input name="cTitle" class='inputcls' type="text" id="cTitle" size="15" maxlength="30" value='<?=$cTitle?>'>&nbsp;&nbsp;Description:&nbsp;
      <input name="cDesc" value='<?=$cDesc?>' class='inputcls' type="text" id="cDesc" size="15" maxlength="30">
	  </td>
	  <td width='10%' align='left'><input type='button' onclick='submitSearch();' class='submit_button_normal'  style='height:22px' id='Go' title='Search courses matching specified criteria' value='&nbsp;Go&nbsp;'
onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';"></td>
	   </tr>
	<tr height='10'><td colspan='2'></td></tr>
</table>-->
</form>

<form name="deletecourse" action="" method="post">
<section class="scrollable">
	   
	   <section class="panel panel-default panelgridBg">
			  <div class="panel row teacher-student-wrap">
			
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
echo "<h4>No results found! Click the Back link to search again.</h4>";
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
<thead> <tr>
<th class="col-xs-3 text-left" >Course Title</th>
<th class="col-xs-2 text-center" >Launch</th>
<th class="col-xs-3 text-center" >Status</th>
<th  class="col-xs-2 text-center" >Time Spent</th>
<!--<th class="col-xs-2 text-center">Completion Date</th>
<th class="col-xs-2 text-center">Score</th>-->
</tr>
</thead>


<?
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($resultList);
$id = $row['id'];
$docid=mysql_result($resultList,$i,"A.id");

$fileTitle=mysql_result($resultList,$i,"name");
//$versioninfo=mysql_result($resultList,$i,"version_info");
$fileDescription=mysql_result($resultList,$i,"summary");
$sWidth=mysql_result($resultList,$i,"width");
$sHeight=mysql_result($resultList,$i,"height");
$userCourseStatus=getUserCourseStatus($user_rowid,$docid);
$userCourseTime=getUserCourseTime($user_rowid,$docid);
$userCourseScore=getUserCourseScore($user_rowid,$docid);
$userCourseCompletionDate=getUserCompletionDate($user_rowid,$docid);
if($userCourseCompletionDate=="-")
{
	$userCourseCompletionDateFormatted="-";
}
else
{
	$userCourseCompletionDateFormatted=parseDate($userCourseCompletionDate);
}



if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";
//mysql_close();
?>

<tr>
<td class="col-xs-3 text-left">
<!--    <a class="listitems" onFocus='this.blur()' onMouseOver='return showStatus();' href='course_details.php?cid=<?=$docid?>&curPage=<?=$currpage?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>' title="<? echo ucfirst($fileTitle); ?>"><? echo ucfirst(TrimString($fileTitle)); ?></a>-->
     <a class="listitems" ><? echo ucfirst(TrimString($fileTitle)); ?></a>
</td>


<td class="col-xs-2 text-center">
<a  onFocus='this.blur()' onMouseOver='return showStatus();' title='Launch course' href="javascript:launch_content(1,<?=$docid?>,<?=$sWidth?>,<?=$sHeight?>);"><i class="fa fa-search"></i></a></td>

<td class="col-xs-2 text-center"><?=ucfirst($userCourseStatus)?></td>
<td class="col-xs-2 text-center"><?=$userCourseTime?></td>
<!--<td align="center" class="Content"><?=$userCourseCompletionDateFormatted?></td>
<td align="center" class="Content"><?=$userCourseScore?></td>-->

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
<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=0&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="First page">First page</a>
<?
}
?>

<?
if($currpage!=0)
{
?>

&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $currpage-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Previous page">Previous page</a>

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
&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $j-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title=<?=$pagenum?>><?echo $pagenum ?></a>
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

&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $currpage+1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Next page">Next page</a>

<?
}
?>

<?
if($currpage+1<$totalPages)
{
?>

&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<? echo $totalPages-1 ?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" title="Last page">Last page</a>
<?
}	
?>

</td></tr>

</table></div>
                  </div>  </div></div>
			
             
            </div>
        
          <!-- row end here -->
        </section>  </section> 
		</form>
<?php
include ('../intface/footer.php');
?>
