<!-- header-->
<?php
include '../../header/dashboardHeader.php';
?>
<? 

if (isset($_GET['status']) == 'err'){
echo "Sorry We Couldn't Process your Order. Please try again.";
exit;
}

$orderID = $_POST['order_id'];
$result = mysql_query("SELECT * FROM tbl_order where order_id = '$orderID'") or die("1Failed Query of " . mysql_error());
while ($row = mysql_fetch_object($result)) {
    $bundleID = $row->bundle_id;
	$bundle_price = $row->price;
}



$query = "SELECT * FROM tbl_b2client_bundle where client_id = 2 and bundle = '$bundleID'";
$result = mysql_query($query) or die("1Failed Query of " . mysql_error());
while ($row = mysql_fetch_object($result)) {
    $bundle_detail = $row->bundle_detail;
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
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>  Buy Course</strong></span> </div>
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		
		</div>
  </div>
  
  
</section>
</section>

	<section class="scrollable padder tableBuyCourse">
<section class="panel panel-default panelgrid">
  <div class="panel row teacher-student-wrap">
    <div class="table-responsive orderDetails text-center">
					<!-- main panel starts -->
					
					<form method="post" action="../helpers/payment/Checkout.php">
					<input type="text" name="Redirect_Url" value="http://localhost/online_test/b2c/pages/helpers/payment/redirecturl.php" hidden>
					
                    <table class="table table-striped m-b-none">
                      <thead>
                        <tr>
                          <th>Course Name : </th>
                          <td> <? echo $bundle_detail?> </td>                   
                        </tr>
						
						 <tr>
                          <th>Price : </th>
                          <td> <? echo $bundle_price ?> 
						  <input type="text" name="Amount" value= "<? echo $bundle_price ?>" hidden>						  </td>                   
                        </tr>
						
						<tr>
                          <th>Order ID : </th>
                          <td> <? echo $orderID ?> 
						  <input type="text" name="Order_Id" value="<?echo $orderID ?>" hidden>						  </td>                   
                        </tr>
						
						<tr>
						<td colspan="2" class="text-center">
						<br>
						<INPUT class="btn btn-s-md btn-primary makepayment" TYPE="submit" value="Make Payment">		<br>	<br>				</td>
						</tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
					
					</form>
			   </div>
			   </div>
  <!-- row end here -->
</section>
	   
					<!-- main panel ends -->
					
					
<?php
include '../../footer/dashboardFooter.php';
?>
