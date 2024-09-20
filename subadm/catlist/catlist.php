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
//Variable to hold the no of records in which the display is splitted
$perms=$_SESSION['perms'];
//$pageSplit=5;

?>
<?php include ('../intface/adm_top.php'); ?>

<script>

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
		alertify.alert("Please select countires to delete.");
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
	alertify.alert("Please select countries to delete.");
	return false;
	}
}

if(document.deletecourse.choice.length!=null)
{
for (i=0; i<document.deletecourse.choice.length; i++) 
{ 
if (document.deletecourse.choice[i].checked) 
{
/*if (confirm("Are you sure you want to delete the selected countries? Please note that only the countries without any users assigned to it wiil be deleted."))
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
					alertify.error("You've clicked Cancel");//return false;
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
/*if (
confirm("Are you sure you want to delete the selected countries? Please note that only the countries without any users assigned to it wiil be deleted."))
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


function submitSearch()
{

document.searchcourse.submit();
}

window.onload = function(){
setPageTitle('Countries');
}
</script>


<?



//get the status message if a new course has been uploaded
$successMsg=$_GET['msg'];

$cTitle=trim($_REQUEST['cTitle']);
$cDesc=trim($_REQUEST['cDesc']);
$cKey=trim($_REQUEST['cKey']);

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

if($cTitle!="")
{
$joinQuery.=" AND company_name LIKE '%$cTitle%'";
}

if($cDesc!="")
{
$joinQuery.=" AND  company_desc LIKE '%$cDesc%'";
}

if($cKey!="")
{
$joinQuery.=" AND company_keywords LIKE '%$cKey%'";
}

//select all the courses from the database
$result = mysql_query ("SELECT * FROM tbl_company ".$joinQuery." order by id ASC"); 
$totalnum=mysql_numrows($result);
/*
$imgname=array();
$j=0;
while ($j < $totalnum) {

$row = mysql_fetch_assoc($result);
$rid = $row['id'];
$imgname[$j]=mysql_result($result,$j,"company_name");
$j++;
}
print_r($imgname);
*/
$resultList = mysql_query ("SELECT * FROM tbl_company ".$joinQuery." order by id ASC LIMIT $startRecord,$pageSplit"); 
$num=mysql_numrows($resultList);
$totalPages=ceil($totalnum/$pageSplit);
//mysql_close();

if($cTitle!="" || $cDesc!="" || $cKey!="")
{
$searchmsg='1';
}
else
{
$searchmsg='0';
}
?>
<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder topMenuContentList">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-2 col-md-2 col-sm-2 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Course list </strong></span> </div>
		 
		</div>
		
		<div class="col-lg-10 col-sm-10 col-md-10 tablegrid pull-right">
      <div class="row">
	 
    <form name="searchcourse" action="catlist.php" method="post">

      
          <div class="pull-right text-right searchbg">
            <div class="search inline"> <span>
    
         Search by Country Name:&nbsp;  <input name="cTitle" class="input-sm form-control  searchbtn" placeholder="Search" type="text" id="cTitle" size="22" maxlength="30" value='<?=$cTitle?>'><!--&nbsp;&nbsp;&nbsp;Description:&nbsp;
      <input name="cDesc" value='<?=$cDesc?>' class='inputcls' type="text" id="cDesc" size="22" maxlength="30">-->&nbsp;&nbsp;&nbsp;Keywords:&nbsp;
	  <input name="cKey" class="input-sm form-control  searchbtn" type="text" id="cKey" size="22" value='<?=$cKey?>' maxlength="30"> 
	
	
              <!--<i class="fa fa-search"></i>-->
              <button type="submit" id='Go' title='Search users matching specified criteria' name="Go" class="btn btn-sm btn-blue searchButton" onclick='submitSearch();' >Search</button>
           </span> <span class="text-right"> <a href="catlist.php" class="btn  btn-blue btn-reset">Refresh</a> </span> </div>
          </div>
        </form>
      </div>
    </div>
		
  </div>
  
  
</section>


	<form name="deletecourse" onSubmit="return confirmDelete();" action="delete.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>&trec=<?=$totalnum?>" method="post" style="margin:0px;">

<section class="panel panel-default">

		   <div class="rightHead text-center bgWtLess">
		   <div class="stepBg">
                <p> This page lists the details of countries registered with LMS. To create a new country, click the Create new country link. To view the details of a listed country, click that country’s name. To delete a country from LMS, select the check box for that country and click the Delete button.
                
                </p>
              </div>
		     <!--<div class="col-md-12 col-sm-12 buildcourse text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	

</div>-->
			<section class="panel panel-default col-md-12 col-sm-12">
                <div class="row m-l-none m-r-none bg-light lter">
				  <div class="col-sm-2 col-md-2 padder-v b-light"></div>
                  <div class="col-sm-4 col-md-4 padder-v b-light text-left">
                    <span class="fa-stack fa-2x pull-left m-r-sm  iconPadd">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-check fa-stack-1x text-white"></i>
                    </span>
					<div class="clear" style="padding-top: 20px;"></div>
                    <a class="clear" href="#">
                      <span class="h3  m-t-xs"><strong><? echo $totalnum ?></strong></span>
                      <small class="text-muted text-uc">Total countries</small>
                    </a>
                  </div>
				  <div class="col-sm-4 col-md-4 padder-v  b-l b-light text-right">
                    
					<div class="clear" style="padding-top: 20px;"></div>
                   <a onFocus='this.blur()' onMouseOver='return showStatus();' class="btn btn-lg btn-default" href='../crtcategory/create.php' title='Create new country'><i class="fa fa-files-o"></i> Create new country</a><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href='../crtcategory/bulkupload.php' title='Bulk Upload'>Bulk Upload</a>-->
                  </div>
               
                </div>
              </section>
		  </div>
		
	<!--Responsive grid table -->
<?php if($num){ ?>	
			
 <section class="panel panel-default  theadHeight">
 
 
			<?
	if($perms==1)
	{
?>
	<div class="text-right deleteDiv">
	<input type='submit' class='btn'  id='deleteuser' title='Delete' value='&nbsp;Delete&nbsp;'>
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
	if($perms==1)
	{
?>
<th  class="col-xs-1 text-center"><input type='checkbox' name='checkall' onclick='checkedAll(deletecourse);'>
</th>
<?
	}
?>
<th class="col-xs-2 text-left" >Country</th>
<th class="col-xs-1 text-center" >User limit</th>
<th class="col-xs-2 text-center" >User Expiry (Days)</th>
<th class="col-xs-2 text-center" >Users</th>
<th class="col-xs-2 text-center" >Categories</th>
<th class="col-xs-2 text-center">Manage categories</th>
   
                      </tr>
                    </thead>
					
					</table></div></div>

    </section> 

<?php } ?>	
	
	
	 </section>

</section>
  <div class="scrollable padder userList">&nbsp;</div>
  <section class="scrollable padder">

  <section class="panel panel-default panelgridBg">
    <div class="panel row teacher-student-wrap">
      <!--Responsive grid table -->
      <div class="table-responsive promo courseGroup table-responsiveTopPad80">
<?
//if courses not found
if (!$num)
{
?>

<div  class="noRecordeTable">
<?
if($searchmsg=='1')
	{
echo "<h4>No results found! Click the Back link to search again.<h4>";
	}
else
{
echo "<h4>Countries not available!</h4>";
}
?>
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

$catid=mysql_result($resultList,$i,"id");
$catname=mysql_result($resultList,$i,"company_name");
$catlimit=mysql_result($resultList,$i,"company_user_limit");
$explimit=mysql_result($resultList,$i,"company_user_expiry");
if($explimit=="")
{
$explimit="-";
}
$createdby=mysql_result($resultList,$i,"company_created_by");
$createdbyfull=getFullName($createdby);

$totalUsers = mysql_query ("SELECT * FROM tbl_company_user WHERE company_id='$catid'"); 
$totalUsersNum=mysql_numrows($totalUsers);

$totalCourses = mysql_query ("SELECT * FROM tbl_company_category WHERE company_id='$catid'"); 
$totalCoursesNum=mysql_numrows($totalCourses);
//mysql_close();

if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";
?>

<tr >
<?
	if($createdby==$userid || $userid=='admin')
	{
?>
<td class="col-xs-1 text-center"><? echo "<input type='checkbox' id='choice' name='choice[]' value='$catid'>" ?></td>
<?
	}
else
	{
	if($perms==1)
		{
?>
<td class="col-xs-1 text-center"><? echo "<input type='checkbox' id='choice' disabled name='choice[]' value='$catid'>" ?></td>
<?
		}	
}

?>

<td class="col-xs-2 text-left"><a a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href='../crtcategory/catModify.php?catid=<?=$catid?>' title="<?=ucfirst($catname);?>"><? echo TrimString(ucfirst($catname)) ?></a></td>

<!--
<td align='left' class="Content"><? echo TrimString($createdbyfull); ?></td>
-->
<td class="col-xs-1 text-center"><?=$catlimit?></td>
<td class="col-xs-2 text-center"><?=$explimit?></td>
<td class="col-xs-2 text-center"><?=$totalUsersNum?></td>

<!--
<td align="center" class="Content"><a onFocus='this.blur()' onMouseOver='return showStatus();' href='manageusers.php?id=<?=$catid?>&currpage=<? echo $currpage ?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>' title="Manage users in this company"><font color='#F10033' face='Arial'>[ Manage users ]</font></a></td>
-->
<td class="col-xs-2 text-center"><?=$totalCoursesNum?></td>


<td class="col-xs-2 text-center"><a onFocus='this.blur()' onMouseOver='return showStatus();' href='manage_categories.php?id=<?=$catid?>&currpage=<? echo $currpage ?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>' title="Manage categories in this country"><font color='#4c4c4c' face='Arial'>[ Manage categories ]</font></a></td>




</tr>

<?
$i++;
}


?></table>
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
<a onFocus='this.blur()' onMouseOver='return showStatus();' title="First page" href="catlist.php?currpage=0&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>">First page</a>
<?
}
?>

<?
if($currpage!=0)
{
?>

&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' title="Previous page" href="catlist.php?currpage=<? echo $currpage-1 ?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>">Previous page</a>

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
&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' title="<?=$pagenum?>" href="catlist.php?currpage=<? echo $j-1 ?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>"><?echo $pagenum ?></a>
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

&nbsp;&nbsp;<a onFocus='this.blur()' title="Next page" onMouseOver='return showStatus();' href="catlist.php?currpage=<? echo $currpage+1 ?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>">Next page</a>

<?
}
?>

<?
if($currpage+1<$totalPages)
{
?>
&nbsp;&nbsp;<a onFocus='this.blur()' title="Last page" onMouseOver='return showStatus();' href="catlist.php?currpage=<? echo $totalPages-1 ?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>">Last page</a>
<?
}	
?>
</td></tr>

</table>
				
                  </div>  
				  </div>
				  </div>
			
              </div>
            </div>
          </div>
          <!-- row end here -->
        </section>
</form>
		<?php
include ('../intface/footer.php');
?>


