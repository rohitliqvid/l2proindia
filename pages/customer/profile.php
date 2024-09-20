<?php
ob_start();
include '../../header/dashboardHeader.php';
/*$user_data_from_db['profileImage'] = trim($user_data_from_db['profileImage']);
$profile_img_path = trim($user_data_from_db['profileImage']);
$profile_img_path = empty($profile_img_path) ? '' : '../'.PROFILE_PIC_DIR.'/'. $profile_img_path;
if( isset($_SESSION['upload-profile-pic']) ){
    if( !empty($_SESSION['upload-profile-pic']['err']) ){
        $pop_msg = $_SESSION['upload-profile-pic']['err'];
    }
    
}
if( isset($_SESSION['upload-profile-pic']) ){
    if( !empty($_SESSION['upload-profile-pic']['success']) ){
        $pop_msg = $_SESSION['upload-profile-pic']['success'];
    }
    
}
unset($_SESSION['upload-profile-pic']);
// check profile pic removal
if( isset($_SESSION['PROFILE_PIC_REMOVED']) ){
    if( !empty( $_SESSION['PROFILE_PIC_REMOVED'] ) ){
        $pop_msg = 'Profile pic has been removed.';
    }
    unset($_SESSION['PROFILE_PIC_REMOVED']);
}*/
//ALTER TABLE `tbl_users` ADD `user_pic` VARCHAR( 255 ) NULL AFTER `client` 
$userArr = array();
$result = mysql_query("SELECT * FROM tbl_users WHERE username = '".$_SESSION['login_user']."'") or die("faile user details Query " . mysql_error());
$cnt = mysql_num_rows($result);
if($cnt > 0){
	while($row = mysql_fetch_assoc($result)){
		$userArr[] = $row;
	}
}
//echo "<pre>";print_r($userArr);exit;
if(isset($_POST['Submit'])){
	$user_pic = addslashes(trim($_POST['fileImgNamePro']));
	$firstname = addslashes(trim($_POST['first_name']));
	$lastname = addslashes(trim($_POST['last_name']));
	$mobile = addslashes(trim($_POST['phone']));
	$dob = addslashes(trim($_POST['date_of_birth']));
	$id = $_POST['uid'];
	$oldPassword = $_POST['oldPassword'];
	$newPassword = $_POST['newPassword'];
	$update = "UPDATE tbl_users SET user_pic = '".$user_pic."', firstname = '".$firstname."', lastname = '".$lastname."', mobile = '".$mobile."', dob = '".$dob."' WHERE id = '".$id."'";
	//echo $update;exit;
	$result = mysql_query($update) or die('not updated');
	if($oldPassword != "" && $newPassword != ""){
		if($oldPassword == $newPassword){
			header("Location:profile.php?err=0");
			exit;
		}else{
			$old = md5($oldPassword);
			$query = "SELECT email FROM tbl_users WHERE id = '".$id."' AND password = '".$old."'";
			$result1 = mysql_query($query) or die('check user');
			$cnt1 = mysql_num_rows($result1);
			if($cnt1 > 0){
				$new = md5($newPassword);
				$update1 = "UPDATE tbl_users SET password = '".$new."'  WHERE id = '".$id."'";
				mysql_query($update1) or die('password reset');
				header("Location:profile.php?err=1");
				exit;
			}else{
				header("Location:profile.php?err=2");
				exit;
			}
		}
	}else{
		header("Location:profile.php?err=1");
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
<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="../../images/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
    <!--start right  content bar -->
          <section class="scrollable padder topMenuContentForm">
            <!--start Midlle container -->
			<section class="panel panel-default text-sm doc-buttons"> 
                <div class="panel-body nobot panelBg">
				 <div class="col-lg-5 col-md-5 col-sm-5 show-mon">
				  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong> Profile</strong></span></div>
				</div>
				<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
				</div>
			</div></section>
			</section>
            <!-- ####### Show table Grid -->
			<form id="changePasswordFormForm" name="changePasswordFormForm" action="" method="post" data-validate="parsley" autocomplete="off" enctype="multipart/form-data">
			<section class="scrollable padder">
            <div class="rightContent newcourse">
              
              <div class="stepBg">
                <p> Upadate your profile
                
                </p>
              </div>
			  	 
			  <div class="row-centered">
			  <div class="col-sm-12 col-xs-12 col-centered">
			     <div class="col-sm-8 col-xs-8 col-sm-offset-2"><?php echo $msg; ?></div>
			  </div>
			<div class="col-sm-4 col-xs-6 col-centered "> <div class="divider"></div> <div class="divider"></div> <div class="divider"></div> 
			   <div class="col-sm-12 col-xs-12 col-centered ">
                
				           <div class="profile text-center profileBg"> 
						   <?php //echo "<pre>";print_r($userArr);exit; ?>
						   <?php if($userArr[0]['user_pic'] != ''){ ?>
                                             
                                                   <a class="thumb-md text-center  fileInputs buttonImg pointer" onclick='$("#fileImgProfile").click()'>
												   <img id="viewImgProfile"  class="viewImgProfile imgBorder dataImg" src="profile_pic/<?php echo $userArr[0]['user_pic']; ?>"/>                                                </a> 
												  <input type="file" id="fileImgProfile" name="fileImgProfile" style="display: none;" />
							             <input type="hidden" name="fileImgNamePro" id="fileImgNamePro" value="<?php echo $userArr[0]['user_pic']; ?>"  readonly=""/> 
										   <div class="clear"></div>
                                             <span class="dataImgShow">  <a  href="javascript:void(0)" class="editInputs buttonImg pointer" onclick='$("#fileImgProfile").click()'> <i class="fa fa-edit"></i> Edit</a>
												 | 
                                                 <a href="javascript:void(0)" id="profile-pic-remove" ref="edit"  class="remove pointer"> <i class="fa fa-trash-o"></i> Remove</a> 
											</span>	
											 <span class="defaultImgShow" style="display:none">  <a  href="javascript:void(0)" class="editInputs buttonImg pointer" onclick='$("#fileImgProfile").click()'> <i class="fa fa-upload"></i> Upload</a> </span>	    
                                            <?php }else{ ?>

           
                                                    <a class="thumb-md  fileInputs buttonImg pointer" onclick='$("#fileImgProfile").click()'>
													<img id="viewImgProfile"  class="viewImgProfile "  src="../../images/profile.png" /> </a>
                   <div class="clear"></div>
                                             <span class="defaultImgShow">  <a  href="javascript:void(0)" class="editInputs buttonImg pointer" onclick='$("#fileImgProfile").click()'> <i class="fa fa-upload"></i> Upload</a>
											</span>	  
												  <input type="file" id="fileImgProfile" name="fileImgProfile" style="display: none;" />
							                     <input type="hidden" name="fileImgNamePro" id="fileImgNamePro" value=""  readonly=""/> 
                                            <?php  }?>
						   
                  <label class="required showErr" id="profile_picError"><?php echo $msgpic; ?></label>
				  </div><div class="divider"></div> <div class="clear"></div>
				   <div class="col-sm-12 col-xs-12 col-centered text-center">
				 
				<p class="text-center"> <a href="javascript:void(0)"  onclick="return showHideChangePassword('changePassword.php','shcp','changePasswordFormForm', 'oldPassword', 'newPassword', 'cnfPassword');" class="chpassword pointer"><i class="passwordIcon fa fa-plus"></i> Change Password</a></p>
				  <div class="divider"></div> 
				</div>

                </div>
               </div>
                <div class="col-sm-4 col-xs-6 col-centered vTop">
				 <div class="divider"></div>  <div class="divider"></div>
				 <div class="col-sm-12 col-xs-12 col-centered">
                 <label class="control-label required" for="first_name">  First Name <span class="required">*</span></label>
                  <input class="form-control input-lg" name="first_name" id="first_name" type="text"  data-required="true"  maxlength="50" value="<?php echo $userArr[0]['firstname']; ?>" autocomplete="off"/>
                  <label class="required" id="first_nameError"></label>
				  </div>
				    
                <div class="clear"></div>	
				  <div class="col-sm-12 col-xs-12 col-centered">
				 <label class="control-label required" for="email_id">  Email ID<span class="required">*</span></label>
                  <input class="form-control input-lg" name="email_id" id="email_id" type="text" data-required="true" data-type="email"  value="<?php echo $userArr[0]['email']; ?>"  maxlength="50" disabled="disabled" autocomplete="off"/>
                  <label class="required" id="email_idError"></label>
				      </div>
				   
                <div class="clear"></div>	
				  <div class="col-sm-12 col-xs-12 col-centered">
				  <label class="control-label required" for="date_of_birth">  Date of Birth<span class="required">*</span></label>
                 <div id="divBirthDate" class="input-append date">
				  <input class="form-control input-lg" name="date_of_birth" id="date_of_birth" type="text" data-required="true" readonly="true"  data-date format="yyyy-dd-mm" placeholder="YYYY-DD-MM" value="<?php echo $userArr[0]['dob']; ?>" maxlength="12" autocomplete="off"/>
					 
					  	<span class="calendarBg add-on">
					   <i class="fa fa-calendar"></i>
					  </span></div>
                  <label class="required" id="date_of_birthError"></label>
				  
              </div>
				  </div>
				  <div class="col-sm-4 col-xs-6 col-centered vTop">
               
				
				<div class="col-sm-12 col-xs-12 col-centered">
				
				  <div class="divider"></div>  <div class="divider"></div>
                 <label class="control-label required" for="last_name">  Last Name <span class="required">*</span></label>
                  <input class="form-control input-lg" name="last_name" id="last_name" type="text"  data-required="true"  maxlength="50" autocomplete="off"  value="<?php echo $userArr[0]['lastname']; ?>"/>
                  <label class="required" id="last_nameError"></label>
              
               </div>
				    
                <div class="clear"></div>	
				  <div class="col-sm-12 col-xs-12 col-centered">
				
				
                 <label class="control-label required" for="phone">  Mobile<span class="required">*</span></label>
                  <input class="form-control input-lg" name="phone" id="phone" type="text" data-required="true" data-type="phone" maxlength="12" autocomplete="off"  value="<?php echo $userArr[0]['mobile']; ?>"/>
                  <label class="required" id="phoneError"></label>
              
                </div>
				    
                <div class="clear"></div>	
				  <div class="col-sm-12 col-xs-12 col-centered">
				
                 <!--<label class="control-label required" for="gender">  Gender<span class="required">*</span></label>
				 <select name="gender" id="gender" data-required="true" class="form-control input-lg">
				 	<option value="">Select</option>
				 	<option value="m" <?php if($userArr[0]['first_name'] == 'm'){ ?> selected="selected"<?php } ?>>Male</option>
					<option value="f" <?php if($userArr[0]['first_name'] == 'f'){ ?> selected="selected"<?php } ?>>Female</option>
                 </select>
                  <label class="required" id="genderError"></label>
                </div>--></div>
               </div>
                <div class="clear"></div>
			
				 <div class="divider"></div>  
			 <div id="shcp">
              
   </div>	 <div class="divider"></div>  <div class="divider"></div>
 </div>
			  
</div>		
		
           </div>
			
      <!--end right  content bar -->
   
    <!--start save  -->
      <section class="hbox stretch"> 
      <section class="vbox">
        <section class="marginBottom">
          <div class="text-right"> <a  class="btn btn-red confirModal" id="btnBack" href="index.php"  data-confirm-title="Confirmation Message" data-confirm-message="Are you sure you want to leave this page?" > <i class="build fa fa-arrow-circle-left"></i> Back</a>
            <button type="submit" name="Submit" class="btn btn-red" id="btnSave" onclick="showLoaderOrNot('changePasswordForm');" ondblclick="showLoaderOrNot('changePasswordFormForm');"> <i class="build fa fa fa-file-text-o"></i> Save</button>
          </div>
        </section>
      </section>
      <!--end save  -->
    </section>


  <!--End Midlle container -->

</section>
<input type="hidden" id="cpFlag" value="0" />
<input type="hidden" name="uid" value="<?php echo $userArr[0]['id']; ?>" />
       		</form>
      <!--end right  content bar -->

<?php
include '../../footer/dashboardFooter.php';
?>
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
		$.post(path, {shpass: cpFlag}, function(data){ $("#"+targetDiv).html(data);$("#cpFlag").attr('value','1'); addParsely(formId,old_password,pwd, cpwd);
			      $('.copyPaste').bind("cut copy paste",function(e) {
					  e.preventDefault();
				  });
		});
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