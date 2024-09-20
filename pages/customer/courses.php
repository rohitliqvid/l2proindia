<?php
include '../../header/dashboardHeader.php';
$username = $_SESSION['login_user'];
function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

$bundleList=array();
$courses['name'] = array();

$date = date_create();
$todayDate = $today = date("Y-m-d");


$curdate=date('Y-m-d');
$userip=$_SERVER['REMOTE_ADDR'];

$username = $_SESSION['login_user'];

function getUserIdFromUsername2($uid)
{
$result = mysql_query ("SELECT * FROM tbl_users where username='$uid'"); 
$row = mysql_fetch_assoc($result);
$id = $row['id'];
$rowId=mysql_result($result,0,"ID");
return $rowId;
}

function getUserNameFromUsername2($uid)
{
	$fullname="";
	$result = mysql_query ("SELECT * FROM tbl_users where username='$uid'"); 
	$row = mysql_fetch_assoc($result);
	$id = $row['id'];
	$firstname=mysql_result($result,0,"firstname");
	$lastname=mysql_result($result,0,"lastname");
	if($firstname!="")
	{
	$fullname.=$firstname;
	}
	if($lastname!="")
	{
	$fullname.=" ".$lastname;
	}
	return $fullname;
}

$user_row_id=getUserIdFromUsername2($username);
$user_fullname=getUserNameFromUsername2($username);

$user_fullname=str_replace(" ","_",$user_fullname);


$curDate=date("Y-m-d");

//$user_row_id=getUserIdFromUsername($login_session);

function getUserCourseDate2($user_row_id,$scormID)
{
$result = mysql_query ("SELECT * FROM tls_scorm_sco_tracking where element='cmi.core.lesson_status' and userid=$user_row_id and scormid=$scormID"); 
$num=mysql_numrows($result);
	if($num==0)
	{
		$mdate='';
	}
	else
	{
		$row = mysql_fetch_assoc($result);
		$id = $row['id'];
		$status=mysql_result($result,0,"value");
		if($status=='completed')
		{
		$mdate=mysql_result($result,0,"timemodified");
		}
		else
		{
		$mdate='';
		}

	}
return $mdate;
}



$result4 = mysql_query("SELECT distinct(bundle_id) FROM tbl_b2client where username = '$login_session' and expiry_date > $curDate") or die("1Failed Query of " . mysql_error());
$i=0;
while($row = mysql_fetch_array($result4)){
	$bundleList[$i] = $row['bundle_id'];
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
          
            <th  class="col-xs-4 text-left">Course Name </th>
			<th  class="col-xs-4 text-left">&nbsp;</th>
            <!--<th class="col-xs-4 text-center">Price </th>-->
            <th class="col-xs-4 text-center">&nbsp;</th>
			
          </tr>
        </thead></table></div></div></section>
</section>
</section>
	<section class="scrollable padder tableBuyCourse">
<section class="panel panel-default panelgrid">
  <div class="panel row teacher-student-wrap">
    <div class="table-responsive ">
				  <?php if(sizeof($bundleList) > 0){
				 
				  ?>
                  
					
                    <table  class="table m-b-none dataTable panel-group table-fixed table-fixedDashborad " id="accordion">
                     
                      <tbody>
					  <?php
	
	for($i = 0 ; $i < sizeof($bundleList) ; $i++){
	$result4 = mysql_query("SELECT * FROM tbl_b2client_bundle where bundle = '$bundleList[$i]' and client_id = 2") or die("1Failed Query of " . mysql_error());
		
		$row = mysql_fetch_array($result4);
		$bundleDesc = $row['bundle_desc'];
		$bundleName = $row['bundle_detail'];
		$courses = explode(',' , $bundleDesc);
		for($j=0 ; $j < sizeof($courses) ; ++$j){
			$query = "SELECT * FROM tbl_b2client where course_id = '$courses[$j]' and expiry_date >= '$curDate' and username = '$login_session'";			
			$result4 = mysql_query($query) or die("1Failed Query of " . mysql_error());
			$row = mysql_fetch_array($result4);
			$courseToken = $row['token'];
			$result5 = mysql_query("SELECT name,course, coursetype FROM tls_scorm where course = '$courses[$j]'") or die("1Failed Query of " . mysql_error());
			$cResult = mysql_fetch_array($result5);
			$courseName = $cResult['name'];
			$scormID = $cResult['course'];
			$coursetype = $cResult['coursetype'];
				if($bundleList[$i]!="demo-b2c" && $coursetype=="WBT")
				{
				$user_status=getUserCourseStatusFinal($user_row_id,$scormID);
				?>
				
				<tr><td  class='col-xs-4 text-left'><?php echo $courseName;?></td><td class='col-xs-4 text-center'>&nbsp;</td><td class='col-xs-4 text-center'>  <a class='btn btn-s-md btn-info btn-rounded' href="javascript:launch_content('<?php echo $courseToken;?>')">Launch</a>
				<?php

				if($user_status=="completed")
				{
				$completionDate=getUserCourseDate2($user_row_id,$scormID);
				$courseNameNew=str_replace(" ","_",$courseName);
				echo "&nbsp;&nbsp;<a class='btn btn-s-md btn-info btn-rounded' href = \"javascript:showCertificate('".encrypt_decrypt('encrypt',$user_fullname)."','".encrypt_decrypt('encrypt',$courseNameNew)."','".$completionDate."','".$scormID."');\">Certificate</a></td></tr>";
				}
				else
				{
				echo "&nbsp;&nbsp;<a class='btn btn-s-md btn-info btn-rounded' style='background-color:#DDDDDD;border-color:#DDDDDD;' href = javascript:showCertificate('','','');>Certificate</a></td></tr>";
				}
				?>
				
				
				</td></tr>
				<?	
				}

			}
			
		  }
					  ?>
                       
                      </tbody>
                    </table>
					<?php  }
					else{ 
					
					echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are no courses available.";
					
					 } ?>
               </div>
			   </div>
  <!-- row end here -->
</section>
	   
					<!-- main panel ends -->
					
<?php
include '../../footer/dashboardFooter.php';
?>
<script>

function launch_content(token) 
{
//alert(token);
var width = 1024;
var height = 768;

var w = width;
var h = height;
var winl = (screen.width-w)/2;
var wint = (screen.height-h)/2;
if (winl < 0) winl = 0;
if (wint < 0) wint = 0;
windowprops = "height="+h+",width="+w+",top="+ wint +",left="+ winl +",location=no,"+ "scrollbars=no,menubars=no,toolbars=no,resizable=no,status=no,directories=no";
path="../../../student/catlist/b2client.php?token="+token;
	var con_window=window.open(path,"win",windowprops);	
	con_window.focus();
}

function showCertificate(uname,cname,cdate,scormID)
{
	//alert(uname+"\n"+cname+"\n"+cdate);
	if(cname=="")
	{
	alert("Certificate will be available after course completion!"); 
	return;
	}
	else
	{
		//alert(1);
	var pwin=window.open("../../../pdf/pdf.php?uname="+uname+"&cname="+cname+"&cdate="+cdate+"&scormID="+scormID);
	}
}

</script>

