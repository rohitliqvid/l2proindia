<title>Activity Log</title>
<?php include ('../intface/windowHeader.php'); ?>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$userid=$_REQUEST['uid'];

$userfullname=getFullNameFromID($userid);

//$result2 = mysql_query ("SELECT * FROM tbl_entry_log WHERE user_id=$userid ORDER BY user_entry DESC"); 
//$num=mysql_numrows($result2);


$query5 = "SELECT * FROM tbl_entry_log WHERE user_id=$userid ORDER BY user_entry DESC";
$result2 = mysqli_query($con,$query5);
$num=mysqli_num_rows($result2);


//mysql_close();
?>
<section id="content" class="rightside windowrightContenBg" >
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="windowtopMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg paddingTOPBottom0">
		<div class="col-sm-4 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Activity log - <?=$userfullname?> </strong></span> </div>
		 
		</div>
		
		<div class="col-sm-7 pull-right">
    
          <div class="pull-right text-right ">
            <div class="search inline">
			 <span><a href='userlog.php' class='btn'  title='Close this window'>Back</a></span> 
			 <span class="text-right"><a href='javascript:self.close();' class='btn ' title='Close this window'><i class="fa fa-times-circle"></i></a> </span> 
			</div>
          
      
      </div>
    </div>
		
  </div>
<div class="col-md-12 col-sm-12 buildcourse text-center" style="padding-top:20px">

 
</div> 
</section>
<section class="panel panel-default text-center">
		   
	
				
				<!--Responsive grid table -->
			 <section class="panel panel-default  theadHeight">
			
			  <div class="panel row teacher-student-wrap theadHeight">
 
               <div class="promo" id="promo">
			  <table class="table m-b-none dataTable table-fixed" style="margin-bottom: 0px;">
                   <thead  class="fixedHeader">   
				   <tr>
<th class="col-xs-4 text-left">User Name</th>
<th class="col-xs-4 text-left">User IP</th>
<th class="col-xs-4 text-left">Login Date</th>

   
                      </tr>
                    </thead>
					
					</table></div></div>	</section>
	</section>	
	
	</section>


	
				
       <section class="scrollable">


			<section class="panel panel-default panelgridBg">
			  <div class="panel row teacher-student-wrap">
			
		
				<!--Responsive grid table -->
                <div class="table-responsive promo courseGroup table-responsiveWindow" style=" padding-top: 80px; ">




<table class="table m-b-none dataTable">

<?
$i=0;
while ($i < $num) {

$row = mysqli_fetch_assoc($result2);
$id = $row['id'];


$userip=$row['user_ip'];
$logindate=$row['user_entry'];



if($i%2==0)
 $bgc="row1";
		else
$bgc="row2";
?>
<?

?>




<tr >

<td class="col-xs-4 text-left"><? echo ucfirst(TrimString($userfullname)); ?></td>
<td class="col-xs-4 text-left"><? echo $userip; ?></td>
<td class="col-xs-4 text-left"><? echo parseDate($logindate); ?></td>
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
