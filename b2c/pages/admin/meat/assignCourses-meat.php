<? 
include ("../../../connect.php");

function getmessage($err){

if($err == 0){
$msg = 'Successfully Added..!!';
}else{
$msg = 'Some Error Occured';
}
return $msg;
}


$result_bundle = mysql_query("SELECT * FROM tbl_b2client_bundle where client_id=2") or die("1Failed Query of " . mysql_error());
$courses[] = '';
$i=0;

while($row = mysql_fetch_array($result_bundle)){
	$courses[$i] =  $row['bundle'];
	$i++;
}

?>


<p class="h4">Courses</p>
					  <br><br>
					 
					<?
						if(ISSET($_GET['err_code'])){
						if($_GET['err_code'] == 0){
						echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><i class="fa fa-ok-sign"></i><strong>Well done!</strong>&nbsp;&nbsp;&nbsp;Bundle Successfully Added</div>';
						}else{
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><i class="fa fa-ban-circle"></i><strong>Oh snap!</strong>&nbsp;&nbsp;&nbsp;Change a few things up and try submitting again.</div>';
				  		}
						}
					?>
				  
					<form data-validate="parsley" action = "../../helpers/buyCourse.php" method = "post">
					<table width = '50%'><tr><td>
					<div class="form-group">
                      <label class="col-sm-2 control-label">Bundle</label></td><td>
                      <div class="col-sm-10">
                        <select name="bundle" class="form-control m-b">
                          
						  <?
						  for($i=0;$i<sizeof($courses);$i++){
						  echo "<option value =$courses[$i]>$courses[$i]</option>";
						  }
						  ?>
                        </select>
                       
                      </div></td>
                    </div></tr>
					<tr><td>
					<div class="form-group">
                           <label class="col-sm-2 control-label">Email</label></td><td>
						  <div class="col-sm-10">
						  <input type="text" name = "email" class="form-control" data-type="email" data-required="true" style = "width:100%">
                          </div>
						  </div></td></tr><tr><td></td><td>
					    <div class="form-group">
						 <div class="col-lg-10">
						<button type="submit" class="btn btn-success btn-s-xs" style = "margin-top:15px">Submit</button>
						</div>
						</div>
						</td></tr>
						<tr><td>
						
						
						
						</td></tr>
						</table>
                        
					  </form>