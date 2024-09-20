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

					<center>
					<div class="col-sm-6">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                      Buy Course
                    </header>
					
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
                          <td> <?echo $bundle_price?> 
						  <input type="text" name="Amount" value= "<? echo $bundle_price ?>" hidden>
						  </td>                   
                          
                        </tr>
						
						<tr>
                          <th>Order ID : </th>
                          <td> <?echo $orderID?> 
						  <input type="text" name="Order_Id" value="<?echo $orderID ?>" hidden>
						  </td>                   
                          
                        </tr>
						
						<tr>
						<th></th>
						<th>
						<br>
						<INPUT class="btn btn-s-md btn-primary" TYPE="submit" value="Make Payment">
						</th>
						</tr>
						
                      </thead>
                      <tbody>
					
                       
                      </tbody>
                    </table>
					
					</form>
                  </section>
                </div>
				
				</center>