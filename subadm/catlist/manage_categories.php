<title>Manage category</title>
<?php include ('../intface/adm_top.php'); ?>
<?
//Variable to hold the no of records in which the display is splitted
$pageSplit=10;
$perms=$_SESSION['perms'];
$catid=$_REQUEST['id'];

$cTitle=trim($_REQUEST['cTitle']);
$cDesc=trim($_REQUEST['cDesc']);
$cKey=trim($_REQUEST['cKey']);
$currpage=$_REQUEST['currpage'];


?>

<script>
function openFile(docid,winWd,winHt,winRsz,winScl,winDir,winLoc,winMenu,winTool,winSts)
{

var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar='+winTool+',menubar='+winMenu+',resizable='+winRsz+',statusbar='+winSts+'scrollbars='+winScl+',location='+winLoc+',directories='+winDir;

var fpath="view.php?docid="+docid;

var fileWin=window.open(fpath,'fwind',settings);
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
		alert("Please select course(s) to delete.");
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
	alert("Please select course(s) to delete.");
	return false;
	}
}

if(document.deletecourse.choice.length!=null)
{
for (i=0; i<document.deletecourse.choice.length; i++) 
{ 
if (document.deletecourse.choice[i].checked) 
{
if (confirm("Are you sure you want to delete the selected courses?"))
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
if (confirm("Are you sure you want to delete the selected courses?"))
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
	  
window.onload = function(){
	setPageTitle('Companies > <?=TrimStringMedium(ucfirst($category_name))?>');
}

</script>

<!-- -->
<?

$result = mysql_query ("SELECT company_name, company_created_by FROM tbl_company where id='$catid'"); 
$category_name=mysql_result($result,0,"company_name");
$category_created_by=mysql_result($result,0,"company_created_by");

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

//select all the courses from the database
$resultList = mysql_query ("SELECT * FROM tbl_category ORDER BY category_name ASC"); 

$totalnum=mysql_numrows($resultList);
//mysql_close();
?>
<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder topMenuContentList">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-sm-4 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Manage category </strong></span> </div>
		 
		</div>
		
		<div class="col-sm-7 pull-right">
    
          <div class="pull-right text-right ">
            <div class="search inline">
			 <span><a href='catlist.php?cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>&currpage=<? echo $currpage ?>' target="_self" title="Go back" class='btn'>Back</a></span> 
			  
			</div>
          
      
      </div>
    </div>
		
  </div>
 
</section>
<section class="panel panel-default">

		   <div class="rightHead text-center bgWt">
		   <div class="stepBg">
                <p> To assign categories to this company, select the check box next to each category you want to assign, and then click the Assign button.
                
                </p>
              </div>
		   
			<section class="panel panel-default col-md-12 col-sm-12">
                <div class="row m-l-none m-r-none bg-light lter">
				  <div class="col-sm-4 col-md-4 padder-v b-light"></div>
                  <div class="col-sm-8 col-md-8 padder-v b-light text-left">
                    <span class="fa-stack fa-2x pull-left m-r-sm  iconPadd">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-check fa-stack-1x text-white"></i>
                    </span>
					<div class="clear" style="padding-top: 20px;"></div>
                    <a class="clear" href="#">
                      <span class="h3  m-t-xs"><strong><? echo $totalnum ?></strong></span>
                      <small class="text-muted text-uc">Total categories available</small>
                    </a>
                  </div>
                </div>
              </section>
		  </div>	
	
	<!--Responsive grid table -->
<?php if($num){ ?>	
			
 <section class="panel panel-default  theadHeight">
				<!--Responsive grid table -->
		
				<?
if(($perms==1 && $category_created_by==$userid) || $userid=='admin')
	{
?>
 <div class="text-right deleteDiv">
 <input type='submit'  class='btn'   id='deleteuser' title='Assign categories' value='&nbsp;Assign&nbsp;' ></div>
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
<th class="col-xs-5 text-left" >Category</th>
<th class="col-xs-6 text-left" >Description</th>

 </tr>
  </thead>
</table></div></div>

  </section> 

<?php } ?>	
	
	
	 </section>

</section>

<form name="deletecourse" action="assign_categories.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>&catid=<?=$catid?>" method="post">
	
 <div class="scrollable padder userList">&nbsp;</div>
  <section class="scrollable padder">

  <section class="panel panel-default panelgridBg">
    <div class="panel row teacher-student-wrap">
      <!--Responsive grid table -->
      <div class="table-responsive promo courseGroup table-responsiveTopPad40">
	
<?
//if courses not found
if (!$totalnum)
{

echo "<div  class='noRecordeTable'><h4>No records found!</h4></div>	";

//exit();
}
?>



<table class="table m-b-none dataTable">


<?
$i=0;
while ($i < $totalnum) {

$row = mysql_fetch_assoc($resultList);
$id = $row['id'];

$categoryid=mysql_result($resultList,$i,"id");
$categoryname=mysql_result($resultList,$i,"category_name");
$categorydesc=mysql_result($resultList,$i,"category_desc");

$checkResult = mysql_query ("SELECT * FROM tbl_company_category where company_id=$catid and category_id=$categoryid"); 
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

if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";
//mysql_close();
?>

<tr >
<?
if(($perms==1 && $category_created_by==$userid) || $userid=='admin')
	{
?>
<td class="col-xs-1 text-center"><? echo "<input type='checkbox' ".$tempString." id='choice' name='choice[]' value='$categoryid'>" ?></td>
<?
	}	
?>
<td class="col-xs-5 text-left"><? echo ucfirst(TrimString($categoryname)); ?></td>
<td class="col-xs-6 text-left"><? 
if($categorydesc!='')
echo ucfirst($categorydesc); 
else
echo "&nbsp;";

?></td>

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
					<table width="100%" cellspacing="0">
 <tr ><td align='center'></td></tr></table>

			

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
