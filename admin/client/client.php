<?php
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
		alertify.alert("Please select course groups to delete.");
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
	alertify.alert("Please select course groups to delete.");
	return false;
	}
}

if(document.deletecourse.choice.length!=null)
{
for (i=0; i<document.deletecourse.choice.length; i++) 
{ 
if (document.deletecourse.choice[i].checked) 
{
if (confirm("Are you sure you want to delete the selected course groups? Please note that only the course groups without any users assigned to it wiil be deleted."))
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
if (confirm("Are you sure you want to delete the selected course groups? Please note that only the course groups without any users assigned to it wiil be deleted."))
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


window.onload = function(){
	setPageTitle('Countries');
}
</script>
<?php include ('../intface/adm_topOuter.php'); ?>
<?php


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
$joinQuery.=" AND client_name LIKE '%$cTitle%'";
}

if($cDesc!="")
{
$joinQuery.=" AND  client_description LIKE '%$cDesc%'";
}

/*if($cKey!="")
{
$joinQuery.=" AND company_keywords LIKE '%$cKey%'";
}*/

//select all the courses from the database
$result = mysql_query ("SELECT * FROM tbl_client ".$joinQuery." order by id ASC"); 
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
$resultList = mysql_query ("SELECT * FROM tbl_client ".$joinQuery." order by id ASC LIMIT $startRecord,$pageSplit"); 
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
}?>

<!-- mid section -->
		
  <section class="panel panel-default  padder">
        <!-- breadcrumbs -->
        <section>
            <div class="panel-body nobot panelBg"  style="margin-top:20px">
                <div class="col-lg-2 col-sm-2 col-md-2 show-mon" >
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Client </strong></span> </div>
                </div>  
				
             <div class="col-lg-10 col-md-10 col-sm-10" >
				<div class="row">
				 
				 <form name="searchcourse" action="client.php" method="post">

				  
					  <div class="pull-right text-right searchbg">
						<div class="search inline"> <span>
				&nbsp;&nbsp;Search by Client Name:&nbsp;
				  <input name="cTitle" class="input-sm form-control  searchbtn" type="text" id="cTitle" size="22" maxlength="30" value='<?=$cTitle?>' >&nbsp;&nbsp;&nbsp;Description:&nbsp;
				  <input name="cDesc" value='<?=$cDesc?>' class="input-sm form-control  searchbtn"  type="text" id="cDesc" size="22" maxlength="30" >
					   
						  <!--<i class="fa fa-search"></i>-->
						  <button type="submit" id='Go' title='Search users matching specified criteria' name="Go" class="btn btn-sm btn-blue searchButton"   onclick='submitSearch();'>Search</button> </span> <span class="text-right"> <a href="client.php" class="btn  btn-blue btn-reset">Refresh</a> </span> </div>
					  </div>
					</form>
				  </div>
                </div>
                </div>
          
        </section>
  <div style="divider"></div>
  <div style="divider"></div>
   <div class="rightHead  newcourse" style="margin: 20px 0;">
       <div class="stepBg">
                <p>This page lists the details of clients registered with English Edge. To create a new client, click the Create new client link. To view the details of a listed client, click that client name.
                
                </p>
             </div>
			 
             </div>   
  
   <div style="divider"></div>
   <div style="divider"></div>
  		
<form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post" style="margin:0px;">

  <?php if($num){ ?>	
    <section class="panel panel-default  theadHeight">
	
<?php /*?>      <?

if($perms==1)
{
?>
      <div class="text-right deleteDiv">
        <input type='submit'  class='btn'  id='deleteuser' title='Delete user' value='&nbsp;Delete&nbsp;' >
      </div>
      <?
}	
?>	<?php */?>
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
<th class="col-xs-3 text-left" >Client</th>
<th class="col-xs-3 text-center" >Client ID</th>
<th class="col-xs-3 text-left" >Client Email</th>
<th  class="col-xs-3 text-center" >Users</th>
   
                     </tr>
                </thead>
					
				 </table></div></div>
			</section>

<?php } ?>	
        <section class="panel panel-default panelgridBg">
            <div class="panel row teacher-student-wrap">
                <!--Responsive grid table -->
                <div class="">
<? 
if (!$totalUsers) {
    ?>
                        <div  class="noRecordeTable">
    <?
    if ($searchmsg == '1') {
        echo "<h4>No results found! Click the Back link to search again.</h4>";
    } else {
        echo "<h4>Users not found!</h4>";
    }
    ?>
                        </div>
    <?
//exit();
}
?>
                <table class="table m-b-none dataTable">
<tr>
<?
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($resultList);
$id = $row['id'];

$catid=mysql_result($resultList,$i,"id");
$catname=mysql_result($resultList,$i,"client_name");
$client_email=mysql_result($resultList,$i,"client_email");


$noOfLearners=getNoLearnersForClient($catid);



if($explimit=="")
{
$explimit="-";
}



//mysql_close();

if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";
?>

<tr >
<!--
<?
	if($createdby==$userid || $userid=='admin')
	{
?>
<td align="center"><? echo "<input type='checkbox' id='choice' name='choice[]' value='$catid'>" ?></td>
<?
	}
else
	{
	if($perms==1)
		{
?>
<td align="center"><? echo "<input type='checkbox' id='choice' disabled name='choice[]' value='$catid'>" ?></td>
<?
		}	
}

?>
-->
<td class="col-xs-3 text-left"><a a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href='editClient.php?catid=<?=$catid?>' title="<?=ucfirst($catname);?>"><? echo TrimString(ucfirst($catname)) ?></a></td>

<!--
<td align='left' class="Content"><? echo TrimString($createdbyfull); ?></td>
-->
<td class="col-xs-3 text-center"><?=$catid?></td>
<td class="col-xs-3 text-left"><?=$client_email?></td>
<td class="col-xs-3 text-center"><?=$noOfLearners?></td>



</tr>

<?
$i++;
}

?>
</table>
</div>	


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
<a onFocus='this.blur()' onMouseOver='return showStatus();' title="First page" href="client.php?currpage=0&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>">First page</a>
<?
}
?>

<?
if($currpage!=0)
{
?>

&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' title="Previous page" href="client.php?currpage=<? echo $currpage-1 ?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>">Previous page</a>

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
&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' title="<?=$pagenum?>" href="client.php?currpage=<? echo $j-1 ?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>"><?echo $pagenum ?></a>
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

&nbsp;&nbsp;<a onFocus='this.blur()' title="Next page" onMouseOver='return showStatus();' href="client.php?currpage=<? echo $currpage+1 ?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>">Next page</a>

<?
}
?>

<?
if($currpage+1<$totalPages)
{
?>
&nbsp;&nbsp;<a onFocus='this.blur()' title="Last page" onMouseOver='return showStatus();' href="client.php?currpage=<? echo $totalPages-1 ?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>">Last page</a>
<?
}	
?>
</td></tr>
<tr height='5px'><td></td></tr>
<tr><td>
<?
	if($perms==1)
	{
?>
<!--
<div align="center"><input type='submit' class='submit_button_normal'  id='deleteuser' title='Delete' value='&nbsp;Delete&nbsp;' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';"></div>-->
<?
	}
?>
</td></tr></table>
				
                  </div>  
				  </div>
				  </div>
			
              </div>
   </div>
           
            <!-- row end here -->
       </section>
	  
        </form>
  <?php include ('../intface/footer.php');  ?>
<?php
if(strpos($_SERVER['REQUEST_URI'], 'client.php')!== false)  {
?>
<script>
$("#clientActive").addClass('active');
$("#home").removeClass('active');
</script>
<?php
}
?>
  