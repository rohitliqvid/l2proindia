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

					<center>
					
					<div class="col-sm-6">
                  <section class="panel panel-default">
				  <?php if(sizeof($bundle['bundle']) > 0){?>
                  
                    <table class="table table-striped m-b-none">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Price</th>                    
                          <th width="70"></th>
                        </tr>
                      </thead>
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
					  
					  echo "<tr><td>".$bundle['bundle_detail'][$i] . "</td><td>" . $bundle['price'][$i] . "</td><td>  <a class='btn btn-s-md btn-info btn-rounded' href='../customer/index.php'  style = 'padding:0px;'>Launch</a></td></tr>";
					  
					  }else{
					  $a = $bundle["bundle"][$i];
					  echo "<tr><td>".$bundle['bundle_detail'][$i] . "</td><td>" . $bundle['price'][$i] . "</td><td>  <a class='btn btn-s-md btn-info btn-rounded' href='../helpers/makeOrder.php?id=".$a."'  style = 'padding:0px;'>Buy</a></td></tr>";
					  }
					  }
					  ?>
                       
                      </tbody>
                    </table>
					<?php } else{ 
					
					echo "There are no courses available.";
					
					 } ?>
                  </section>
                </div>
				</center>
				
				