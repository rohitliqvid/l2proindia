<?php 
ob_start();
include ('../intface/adm_top.php'); ?>

<?
if(!$_SESSION['token'])
{
header("Location:../../index.php#item1");
exit();
}


$con=createConnection();
$stmt = $con->prepare("SELECT firstname,lastname,usertype,dtenrolled,email,mobile,sex,learn_from,education,profession,education_details,profession_experience,user_country,user_state,user_city,zip_code,allow_email_for_marketing,allow_email_for_campaign,occupation,organization,designation FROM tbl_users WHERE username=?");
$stmt->bind_param("s",$userid);
$stmt->execute();
$stmt->bind_result($fnm,$lnm,$utype,$dt,$email,$mobile,$sex,$learn_from,$education,$profession,$education_details,$profession_experience,$user_country,$user_state,$user_city,$zip_code,$allow_email_for_marketing,$allow_email_for_campaign,$occupation,$organization,$designation);
$stmt->fetch();
$stmt->close();	
closeConnection($con);
$isUpdaetd=0;

/*$result = mysql_query ("SELECT * FROM tbl_users where username='$userid'"); 
$num=mysql_numrows($result);

$fnm=mysql_result($result,0,"firstname");
$lnm=mysql_result($result,0,"lastname");
$uid=mysql_result($result,0,"username");
$utype=mysql_result($result,0,"usertype");
$dt=mysql_result($result,0,"dtenrolled");
$email=mysql_result($result,0,"email");
$dob=mysql_result($result,0,"dob");
$doj=mysql_result($result,0,"doj");
$department=mysql_result($result,0,"department");
$country=mysql_result($result,0,"country");
$city=mysql_result($result,0,"city");
$udept=getDepartmentName($department);
$ucountry=getCountryName($country);
$ucity=getCityName($city);

$bank_id=mysql_result($result,0,"bank_id");
$sales_id=mysql_result($result,0,"sales_id");
$sales_code1=mysql_result($result,0,"sales_code1");
$sales_code2=mysql_result($result,0,"sales_code2");
$sales_code3=mysql_result($result,0,"sales_code3");
$unique_code=mysql_result($result,0,"unique_code");
$business_type=mysql_result($result,0,"business_type");
$business_role=mysql_result($result,0,"business_role");
$business_type_name=getBusinessType($business_type);
$mobile = mysql_result($result,0,"mobile");
$user_pic = mysql_result($result,0,"user_pic");*/



if(isset($_POST['Submit'])){
	$user_pic = addslashes(trim($_POST['fileImgNamePro']));
	$firstname = addslashes(trim($_POST['first_name']));
	$lastname = addslashes(trim($_POST['last_name']));
	$mobile = addslashes(trim($_POST['phone']));
	$dob = addslashes(trim($_POST['date_of_birth']));
	$id = $_POST['uid'];
	$oldPassword = $_POST['oldPassword'];
	$newPassword = $_POST['newPassword'];
	$update = "UPDATE tbl_users SET user_pic = '".$user_pic."', firstname = '".$firstname."', lastname = '".$lastname."', mobile = '".$mobile."', dob = '".$dob."' WHERE username = '".$id."'";
	//echo $update;exit;
	$result = mysql_query($update) or die('not updated');
	if($oldPassword != "" && $newPassword != ""){
		if($oldPassword == $newPassword){
			header("Location:mydtls.php?err=0");
			exit;
		}else{
			$old = md5($oldPassword);
			$query = "SELECT email FROM tbl_users WHERE username = '".$id."' AND password = '".$old."'";
			$result1 = mysql_query($query) or die('check user');
			$cnt1 = mysql_num_rows($result1);
			if($cnt1 > 0){
				$new = md5($newPassword);
				$update1 = "UPDATE tbl_users SET password = '".$new."'  WHERE username = '".$id."'";
				mysql_query($update1) or die('password reset');
				header("Location:mydtls.php?err=1");
				exit;
			}else{
				header("Location:mydtls.php?err=2");
				exit;
			}
		}
	}else{
		header("Location:mydtls.php?err=1");
		exit;
	}	
}
$msg = "";
if(isset($_GET['err']) && $_GET['err'] != ""){
	if($_GET['err'] == 1){
		$msg = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-check-circle"></i> <strong>Success!</strong> &nbsp;&nbsp;&nbsp;Profile Updated successfully</div>';
	}elseif($_GET['err'] == 0){
		$msg = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-ban-circle"></i> <strong>Oh snap!</strong> &nbsp;&nbsp;&nbsp;Old password and new password are same</div>';
	}elseif($_GET['err'] == 2){
		$msg = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-ban-circle"></i> <strong>Oh snap!</strong> &nbsp;&nbsp;&nbsp;Wrong password.</div>';
	}
}


?>

<!-- mid section -->
		
<!-- main panel ends -->
<section class="scrollable">
		  <section class="panel panel-default padder contentTop" >		 
		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 show-mon">
            <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>My Profile</strong></span> </div>
          </div> <div class="col-lg-6  col-md-6 col-sm-6  col-xs-8 padd0"> <?
		  if($isUpdaetd=='0')
		  {
		  ?>
		  <a  onFocus='this.blur()' onMouseOver='return showStatus();' href="modify.php" title="Modify your  profile"  class="pull-right btn btn-lg btn-default bdrRadius20 marginLeft5">Modify 
              Profile</a>
			  
			  <?
		  }	  
			  ?>
			  <a onFocus='this.blur()' onMouseOver='return showStatus();' href="chgpwd.php" title="Change your password"  class="pull-right btn btn-lg btn-default bdrRadius20 marginLeft5">Change 
              Password</a>
			  
			  </div>
			  <div class="clear"> </div>
       <div class="col-lg-12 col-md-12 col-sm-12 text-left paddTop10"> <p>The following information pertaining to you is currently stored in the Learning Management System:	
	  </p></div> <div class="paddTop10 divider"></div>
  </section>
<div class="clear"> </div>
<section class="panel panel-default panelgridBg padder">
<div class="col-md-12 col-sm-12 paddTop10">
		

   <table class="table-responsive">
        
        <tr> 
          <td  class="col-sm-2 ContentBold">First name:</td>
          <td class="col-sm-9"><? echo $fnm ?></td>
         
        </tr>
        <tr> 
          <td class="col-sm-2 ContentBold">Last name:</td>
          <td class="col-sm-9"><? echo $lnm ?></td>
          
        </tr>
		<tr> 
          <td class="col-sm-2 ContentBold">Email:</td>
          <td class="col-sm-9"><? echo TrimStringLarge($email) ?></td>
         
        </tr>
		
		<tr> 
          <td class="col-sm-2 ContentBold">Mobile:</td>
          <td class="col-sm-9"><? echo TrimStringLarge($mobile) ?></td>
         
        </tr>
       
	</table>
	<div class="clear paddTop10" > </div>
</div>
</section>
					
					
<?php
include ('../intface/footer.php');
?>

<!--Code to prevent the caching of page-->
<script>
/*profile*/

function emptyErr(){
	$(".showErr").html('');
}

function addParsely(formId,old_password,pwd, cpwd){
	$('#'+formId).parsley('addItem', '#'+old_password);
	$('#'+formId).parsley('addItem', '#'+pwd);
	$('#'+formId).parsley('addItem', '#'+cpwd);
}

function removeParsely(formId,old_password,pwd, cpwd){
	$('#'+formId).parsley('destroy');
	$('#'+formId).parsley();
	$('#'+formId).parsley('removeItem',  '#'+old_password);
	$('#'+formId).parsley('removeItem', '#'+pwd);
	$('#'+formId).parsley('removeItem', '#'+cpwd);
	
}
function showHideChangePassword(path,targetDiv,formId,old_password,pwd, cpwd){	
	$('#'+formId).parsley();
	var cpFlag = $("#cpFlag").val();
	if(cpFlag == 0){
		$.post(path, {shpass: cpFlag}, function(data){ $("#"+targetDiv).html(data);$("#cpFlag").attr('value','1'); addParsely(formId,old_password,pwd, cpwd);});
	}else{	
		removeParsely(formId,old_password,pwd, cpwd);			
		$("#"+targetDiv).html('');
		$("#cpFlag").attr('value','0');		
	}
}
$(".chpassword").click(function(){
	$(".passwordIcon").toggleClass('fa-plus fa-minus')
		});

$(document).ready(function(){
	
	$("#profile-pic-remove").click(function(){
	//alert("dsfdr")
	   var filevalue = $("#fileImgNamePro").val('');
	   $("#viewImgProfile").attr("src","../../images/profile.png");
	   $("#viewImgProfile").removeClass("imgBorder");
	   $(".defaultImgShow").show();
	   $(".dataImgShow").hide();
	  
	
		});
 })

function byId(e){return document.getElementById(e);}
window.addEventListener('load', onProfileLoaded, false);

function onProfileLoaded(){   
//alert('1');
	byId('fileImgProfile').addEventListener('change', onChosenImgProfile, false);	
	var img = document.getElementById('viewImgProfile');
	var attr = img.getAttribute('src');	

}

function onChosenImgProfile(evt){  
   
	//alert(this.files[0]);
    var fileType = this.files[0].type;
	var fileName = this.files[0].name;
	var fileSize = this.files[0].size;
    if (fileType.indexOf('image') != -1 && fileSize < 5242880){
		//alert(this.files[0])
		var fd = new FormData();
        fd.append("fileImgProfile", document.getElementById('fileImgProfile').files[0]);
        var xhr = new XMLHttpRequest();
		//xhr.upload.addEventListener("progress", uploadProgress, false);
		xhr.addEventListener("load", uploadCompleteImgPro, false);
		showLoader();
		//$(".progressBg").show();
		xhr.open("POST", "uploadProfilePic.php?name=fileImgProfile");
		xhr.send(fd);
	}else{
		//$(".progressBg").hide();
		hideLoader();
		var img = document.getElementById('viewImgProfile');
		if(fileType.indexOf('image') == -1){
			alertify.alert('Please upload an valid image');
		}else{
			alertify.alert("Please upload upto 5mb");
		}
		var attr = img.getAttribute('src');
		return false;
		alert(attr)
		
	}
  
}


function uploadCompleteImgPro(evt) { 
		hideLoader();
		var jsonObj = JSON.parse(evt.target.responseText);
		var uploadedFile = jsonObj.fileName;
		var uploadFailed = jsonObj.msg;
		if(uploadFailed == "large"){
			//hideQuizLoader();
			//$(".progressBg").hide();
			//$("#fileImgName").attr("value","");
			alertify.alert("Please upload upto 5mb");
			return false;
		}
		
		if(uploadFailed == "invalid"){
			alertify.alert("You have uploaded invalid file");
			return false;
		}
		
		$("#fileImgNamePro").attr("value",uploadedFile); 
		 $("#viewImgProfile").attr("src",'profile_pic/'+uploadedFile);
		//alertify.alert("Image uploaded successfully");
		
}

function showLoaderOrNot(formId){
        $('#'+formId).parsley('addListener', {
            onFormSubmit: function ( isFormValid ) {
                if(isFormValid == true){
					showLoader();
					//obj.disabled=true;
					//alert(obj);
					//document.getElementById(obj).disabled=true;
				}else{
					return false;
				}
            }
        });
}
function showLoader(){
	$("#loaderDiv").show();
}

function hideLoader(){
	$("#loaderDiv").hide();
}
</script>
 <script>
 document.title = 'Profile';
 </script>  