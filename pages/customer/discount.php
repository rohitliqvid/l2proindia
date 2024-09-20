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
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>  Discount</strong></span> </div>
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		</div>
  </div>
  
  
</section>
</section>

	<section class="scrollable padder tableBuyCourse">
<section class="panel panel-default panelgrid">
  <div class="panel row teacher-student-wrap">
					<? include('./meat/discount-meat.php'); ?>
					   </div>
  <!-- row end here -->
</section>
	   
					<!-- main panel ends -->
					
					
<?php
include '../../footer/dashboardFooter.php';
?>


   <?php
	if(isset($_SESSION['signUP']))
	{
	$userFullName=$_SESSION['userFullName'];
	$userPhone=$_SESSION['userPhone'];
	$userEmail=$_SESSION['userEmail'];
	?>
	<script>
	mixpanel.track (
		"Sign Up",
		{"User Name":"<?php echo $userFullName;?>",
		"User Email":"<?php echo $userEmail;?>",
		"User Phone":"<?php echo $userPhone;?>",
		"Date": "<?php echo $currentDate;?>"

	}
		);

	</script>
	<?php
	unset($_SESSION['signUP']);
	}
   ?>
