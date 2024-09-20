
<title>Bulk Report Staus</title>
<?php include ('../intface/windowHeaderOuter.php'); ?>
<?php /*?>include("../connect.php"); //Connection to database 
include("../global/functions.php"); <?php */?>
<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}




$result2 = mysql_query ("SELECT * FROM tbl_users_bulkstatus ORDER BY id ASC"); 
$num=mysql_numrows($result2);
//mysql_close();
?>

<script>function doSaveAs(myfile){
	if (document.execCommand){
		document.execCommand("SaveAs",true,myfile)
	}
	else {
		alert("Save-feature available only in Internet Exlorer 5.x.")
	}
}</script>


<section id="content" class="rightside windowrightContenBg">

<section class="windowtopMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg  paddingTOPBottom0">
		<div class="col-sm-4 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Bulk Upload Report</strong></span> </div>
		 
		</div>
		
		<div class="col-sm-7 pull-right">
    
          <div class="pull-right text-right ">
            <div class="search inline">
			 <!--<span><a href='javascript:doSaveAs('<?=$filename?>');' class='btn' title='Save this report'><i class="fa fa-file-o"></i></a></span> -->
			 <span><a href='javascript:window.print();' class='btn' title='Print this window'><i class="fa fa-print"></i></a></span> 
			 <span class="text-right"><a href='javascript:self.close();' class='btn ' title='Close this window'><i class="fa fa-times-circle"></i></a> </span> 
			</div>
          
      
      </div>
    </div>
		
  </div>
<div class="col-md-12 col-sm-12 buildcourse text-center" style="padding-top:20px">

 
</div> 
</section>

	<!--Responsive grid table -->
<?php if($num){ ?>	
			
 <section class="panel panel-default  theadHeight">
				<!--Responsive grid table -->
		
			
			  <div class="panel row teacher-student-wrap theadHeight">
 
               <div class="promo" id="promo">
			  <table class="table m-b-none dataTable table-fixed"  style="margin-bottom:0px">
                   <thead  class="fixedHeader">   
				   <tr>

<th class="col-xs-5 text-left" >User ID</th>
<th class="col-xs-6 text-left" >Status</th>

 </tr>
  </thead>
</table></div></div>

  </section> 

<?php } ?>	
	
	
	 </section>

</section>

 <div class="scrollable padder courseGroupheight" style="height:70px;">&nbsp;</div>
<section class="scrollable">

 <section class="panel panel-default panelgridBg">
			  <div class="panel row teacher-student-wrap">
			
		
				<!--Responsive grid table -->
                <div class="table-responsive promo courseGroup table-responsiveWindow" style=" padding-top: 5px;overflow-x:hidden ">
<?
if(!$num)
{
echo "<div  class='noRecordeTable'><h4>No bulk countries created!</h4></div>";
//exit;
}
?>

<table class="table m-b-none dataTable">

<?
$curdate=date('d-m-Y');
$filename="Report-".$curdate."-".time().".html";
$i=0;
while ($i < $num) {

$row = mysql_fetch_assoc($result2);
$id = $row['id'];

$comp_name=mysql_result($result2,$i,"userid");
$status=mysql_result($result2,$i,"status");
$userflag=mysql_result($result2,$i,"flag");


?>





<td class="Content"><?=$comp_name?></td>
<td class="Content" align='left'><?=$status?>
</td>

</tr>

<?
$i++;
}

?>	
  </table>
</div></div></section>
</form>
<?php
include ('../intface/footer.php');
?>
