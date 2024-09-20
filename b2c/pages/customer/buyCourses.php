<!-- header-->
<?php
include '../../header/dashboardHeader.php';
?>

<? 

session_start();

if(isset($_SESSION['voucher'])){
	$voucherID = $_SESSION['voucher'];
	$query="SELECT * FROM tbl_b2c_voucher_course where voucher_id  = $voucherID and status = 0";
	$result = mysql_query ($query); 
	while($row =mysql_fetch_array($result)){
		$discountedCourses[] = $row['course_id'];
	}
}

$result4 = mysql_query("SELECT * FROM tbl_b2client_bundle where client_id = 2 and price <> 0") or die("1Failed Query of " . mysql_error());
$i=0;
while($row = mysql_fetch_array($result4)){

	if(isset($_SESSION['voucher'])){
	
	$query="SELECT * FROM tbl_b2c_voucher where id  = $voucherID";
	$result = mysql_query ($query);
	$row1 = mysql_fetch_array($result);
	$voucherPercentage = $row1['percentage'];
	$voucherCode = $row1['voucher_code'];
	$_SESSION['voucher_code'] = $voucherCode;
		if (in_array($row['bundle'], $discountedCourses)) {
			$bundle['bundle'][$i] = $row['bundle'];
			$bundle['bundle_detail'][$i] = $row['bundle_detail'];
			$bundle['price'][$i] = round($row['price'] * $voucherPercentage / 100);
			$bundle['bundle_desc'][$i] = $row['bundle_desc'];
			$i++; 
		}
	}else{
		$bundle['bundle'][$i] = $row['bundle'];
		$bundle['bundle_detail'][$i] = $row['bundle_detail'];
		$bundle['price'][$i] = $row['price'];
		$bundle['bundle_desc'][$i] = $row['bundle_desc'];
		$i++; 
	}
}

$userName = $_SESSION['login_user'];
$result4 = mysql_query("SELECT course_id FROM tbl_b2client where username = '$userName'") or die("1Failed Query of " . mysql_error());
$i=0;
while($row = mysql_fetch_array($result4)){
$courseAssigned[$i] = $row['course_id'];
$i++;
}





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
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Courses</strong></span> </div>
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		</div>
  </div>
  
  <section class="panel panel-default  theadHeight">
    
			 
	<div class="panel row teacher-student-wrap theadHeight">
    <div class="promo" id="promo">
      <table class="table m-b-none dataTable panel-group table-fixed table-fixedDashborad " id="accordion">
    <thead  class="fixedHeader">
          <tr>
          
            <th  class="col-xs-4 text-left">Name </th>
            <th class="col-xs-4 text-center">Price </th>
            <th class="col-xs-4 text-center">&nbsp;</th>
			
          </tr>
        </thead></table></div></div></section>
</section>
</section>
	<section class="scrollable padder tableBuyCourse">
<section class="panel panel-default panelgrid">
  <div class="panel row teacher-student-wrap">
    <div class="table-responsive ">
				  <?php if(sizeof($bundle['bundle']) > 0){?>
                  
					
                    <table  class="table m-b-none dataTable panel-group table-fixed table-fixedDashborad " id="accordion">
                     
                      <tbody>
					  <?
					  for($i = 0 ; $i < sizeof($bundle['bundle']) ; ++$i){
					  
					  $bundleCourses = explode(',' , $bundle['bundle_desc'][$i]);
						$courseCount = 0;
					  for ($j = 0 ; $j < sizeof($bundleCourses) ; ++$j){
						if (in_array($bundleCourses[$j] , $courseAssigned)) {
							$courseCount++;
						}
					  }
					  
					  if($courseCount == sizeof($bundleCourses)){
					  
					  $a = $bundle["bundle"][$i];
					  
					  echo "<tr><td  class='col-xs-4 text-left'>".$bundle['bundle_detail'][$i] . "</td><td class='col-xs-4 text-center'>" . $bundle['price'][$i] . "</td><td class='col-xs-4 text-center'>  <a class='btn btn-s-md btn-info btn-rounded' href='../customer/index.php'  style = 'padding:0px;'>Launch</a></td></tr>";
					  
					  }else{
					  $a = $bundle["bundle"][$i];
					  echo "<tr><td class='col-xs-4 text-left'>".$bundle['bundle_detail'][$i] . "</td><td class='col-xs-4 text-center'>" . $bundle['price'][$i] . "</td><td class='col-xs-4 text-center'>  <a class='btn btn-s-md btn-info btn-rounded buy' href='../helpers/makeOrder.php?id=".$a."'  style = 'padding:0px;'>Buy</a></td></tr>";
					  }
					  }
					  ?>
                       
                      </tbody>
                    </table>
					<?php } else{ 
					
					echo "There are no courses available.";
					
					 } ?>
               </div>
			   </div>
  <!-- row end here -->
</section>
	   
					<!-- main panel ends -->
					
<?php
include '../../footer/dashboardFooter.php';
?>
