<?

$bundleList=array();
$courses['name'] = array();

$date = date_create();
$todayDate = $today = date("Y-m-d");


$curdate=date('Y-m-d');
$userip=$_SERVER['REMOTE_ADDR'];

$username = $_SESSION['login_user'];

function getUserIdFromUsername($uid)
{
$result = mysql_query ("SELECT * FROM tbl_users where username='$uid'"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowId=mysql_result($result,0,"ID");
return $rowId;
}
$user_row_id=getUserIdFromUsername($username);
function getUserCourseStatusFinal($user_row_id,$scormID)
{
$result = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_row_id and scormid=$scormID"); 
$num=mysql_numrows($result);
	if($num==0)
	{
		$status='Not Attempted';
	}
	else
	{
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
		$status=mysql_result($result,0,"value");
		if($status=='failed')
		{
			$result2 = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.score.raw' and userid=$user_row_id and scormid=$scormID"); 
			$num2=mysql_numrows($result2);
			if($num2==0)
			{
			$status='incomplete';
			}
		}
	}
return $status;
}



//echo $user_row_id;
mysql_query("INSERT INTO tbl_b2client_entry_log (username, user_ip, user_entry) VALUES ('$username', '$userip','$curdate')");

			

$result4 = mysql_query("SELECT distinct(bundle_id) FROM tbl_b2client where username = '$login_session' and expiry_date > CURRENT_DATE") or die("1Failed Query of " . mysql_error());
		$i=0;
		
		while($row = mysql_fetch_array($result4)){
			$bundleList[$i] = $row['bundle_id'];
			$i++;
			}
			
?>

<p class="h4">Courses</p>
					  <br><br>
 
	<?
for($i = 0 ; $i < sizeof($bundleList) ; $i++){


$result4 = mysql_query("SELECT * FROM tbl_b2client_bundle where bundle = '$bundleList[$i]' and client_id = 2") or die("1Failed Query of " . mysql_error());
		
		$row = mysql_fetch_array($result4);
		$bundleDesc = $row['bundle_desc'];
		$bundleName = $row['bundle_detail'];
		
		$courses = explode(',' , $bundleDesc);
		?>
		<section class="panel panel-default pos-rlt clearfix">
                    <header class="panel-heading">
                      <ul class="nav nav-pills pull-right">
                        <li>
                          <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                        </li>
                      </ul>
                      <? echo $bundleName; ?>
                    </header>
					 <div class="panel-body clearfix">
					
		<table class="table table-striped m-b-none">
		
		<tbody>
		<?
		if($bundleList[$i] == 'demo-b2c' && $username != 'hdfcdemo@liqvid.com'){
		echo "<tr><td>IELTS Edge - Demo</td>";
		echo "<td><a class='btn btn-s-md btn-info btn-rounded video-link video-target' data-video-id='y-ROSArO2Io_o'>Click Here</a>";
		echo "&nbsp;&nbsp;&nbsp;<a class='btn btn-info btn-rounded' style = 'width:50px;' target = '_blank' href = 'http://englishedge.in/product-catalog'>Buy</a></td></tr>";
		 }
		
		for($j=0 ; $j < sizeof($courses) ; ++$j){
			
			$query = "SELECT * FROM tbl_b2client where course_id = '$courses[$j]' and expiry_date >= '$todayDate' and username = '$login_session'";			
			$result4 = mysql_query($query) or die("1Failed Query of " . mysql_error());
				
				$row = mysql_fetch_array($result4);
				$courseToken = $row['token'];
				
				$result5 = mysql_query("SELECT name,course FROM tls_scorm where course = '$courses[$j]'") or die("1Failed Query of " . mysql_error());
				$cResult = mysql_fetch_array($result5);
				$courseName = $cResult['name'];
				$scormID = $cResult['course'];
				
		echo "<tr><td>" . $courseName . "</td>";


		if($bundleList[$i] == 'demo-b2c'){
			echo "<td><a class='btn btn-s-md btn-info btn-rounded' href = javascript:launch_content('" .$courseToken ."')>Click Here</a>";
			echo "&nbsp;&nbsp;&nbsp;<a class='btn btn-info btn-rounded' style = 'width:50px;' target = '_blank' href = 'http://englishedge.in/product-catalog'>Buy</a></td></tr>";
		}else{
			
			echo "<td><a class='btn btn-s-md btn-info btn-rounded' href = javascript:launch_content('" .$courseToken ."')>Click Here</a></td></tr>";
			//echo "SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_row_id and scormid=$scormID";
			//$user_status=getUserCourseStatusFinal($user_row_id,$scormID);
			//echo $user_status;
		}
}		

		
		if($bundleList[$i] == 'demo-b2c' && $username != 'hdfcdemo@liqvid.com'){
		echo "<tr><td> Scholar Demo </td>";
		echo "<td><a class='btn btn-s-md btn-info btn-rounded' href = 'http://dev.englishedge.in/demo_courses/scholar.html' target = '_blank'>Click Here</a>";
		echo "&nbsp;&nbsp;&nbsp;<a class='btn btn-info btn-rounded' style = 'width:50px;' target = '_blank' href = 'http://englishedge.in/product-catalog'>Buy</a></td></tr>";
		}
		?>
		
		
</tbody></table>
</div>
</section>

<?
}

?>



  <script>

function launch_content(token) 
{

var width = 1024;
var height = 768;

var w = width;
var h = height;
var winl = (screen.width-w)/2;
var wint = (screen.height-h)/2;
if (winl < 0) winl = 0;
if (wint < 0) wint = 0;
windowprops = "height="+h+",width="+w+",top="+ wint +",left="+ winl +",location=no,"+ "scrollbars=no,menubars=no,toolbars=no,resizable=no,status=no,directories=no";
path="/student/catlist/b2client.php?token="+token;
	var con_window=window.open(path,"win",windowprops);	
	con_window.focus();
}

</script>
