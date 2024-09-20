<!-- header-->
<?php
include '../../header/dashboardHeader.php';
?>
<!-- mid section -->
		
<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="images/saving.gif" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder topMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>  Payment Status</strong></span> </div>
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		</div>
  </div>
  
  
</section>
</section>

	<section class="scrollable padder tableBuyCourse">
<section class="panel panel-default panelgrid">
  <div class="panel row teacher-student-wrap">
					<? include('./meat/paymentStatus-meat.php'); ?>
					   </div>
  <!-- row end here -->
</section>
	   
					<!-- main panel ends -->
					
					
<?php
include '../../footer/dashboardFooter.php';
?>