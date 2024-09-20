<?php include ('../intface/adm_top.php'); ?>


<script>

window.onload = function(){
	setPageTitle('Users > New user');
}

</script>




<script type="text/javascript" language="javascript">


var mailExists=0;
var http_request = false;
var tempTxt;
var varid;
function makeRequest(url,txt,ids) {
http_request = false;
tempTxt=txt;
varid=ids;
if (window.XMLHttpRequest) { // Mozilla, Safari,...
http_request = new XMLHttpRequest();
if (http_request.overrideMimeType) {
http_request.overrideMimeType('text/xml');
// See note below about this line
}
} else if (window.ActiveXObject) { // IE
try {
http_request = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
http_request = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {}
}
}

if (!http_request) {
alertify.alert('Giving up :( Cannot create an XMLHTTP instance');
return false;
}

http_request.onreadystatechange = alertContents;
http_request.open('GET', url, true);
http_request.send(null);

}

function alertContents() {
if (http_request.readyState == 4) {
if (http_request.status == 200) {


if(tempTxt == "check_list")
{

	if(http_request.responseText=="1")
	{
	document.getElementById("isMail").innerHTML="";
	mailExists=0;
	}
	else
	{
	document.getElementById("isMail").innerHTML="";
	mailExists=0;
	}
	

}


} 
else {
alertify.alert('There was a problem with the request.');
}
}
}


function checkMail(val)
{
	if (Trim(val)!="" &&  echeck(val) !=false)
	{
	makeRequest('combo.php?action=chkMail&val='+val,"check_list",val);
	}
	else
	{
	document.getElementById("isMail").innerHTML="";
	}
}

function enableType()
{
window.location.href = window.location.href;
//document.userInfo.ugroups.disabled=false;
}
</script>


<script>
//function to clear all the input fields (not used)
function clearFields()
{
////Commmented to retain the values when the user returns back to modify the details
//document.userInfo.fnm.value="";
//document.userInfo.lnm.value="";
//document.userInfo.uid.value="";
//document.userInfo.pwd.value="";
//document.userInfo.cpwd.value="";
}

function getValues()
{
/*
var length1=document.userInfo.ugroups.length;

var val1='';

	for(i=0;i<length1;i++)
	{
		if(document.userInfo.ugroups.options[i].selected)
		{
		val1+=document.userInfo.ugroups.options[i].value+",";
		}

	}
	document.getElementById("obj1").value=val1;
*/
}

function checkRole(role)
{
	
}
</script>

<?php

$query4 = "SELECT * FROM tbl_client ORDER BY client_name ASC";
$totalresult = mysqli_query($con,$query4);
$totalnum=mysqli_num_rows($totalresult);

//$result = mysql_query ("SELECT * FROM tbl_client ORDER BY client_name ASC"); 
//$totalnum=mysql_numrows($result);
?>

<!-- mid section -->
		
<section id="content" class="">
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder ">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg" style="margin-top:20px">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>New user </strong></span> </div>
		 
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
			<a onFocus='this.blur()' onMouseOver='return showStatus();' href="../userlist/userlist.php" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a>
			</div>
		
  </div>
  
  
</section>
<br>
<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>
					
			   <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom:20px;clear:both">
                  <div class="alert alert-danger" role="alert">
				<?php echo $_SESSION['msg']; unset($_SESSION['msg']);?>  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
				</div>
                </div>  
				<?php } ?>	
</section> 
    <!-- ####### Show table Grid -->

    <!-- ####### Show table Grid -->

<form  name="userInfo" onSubmit="getValues();return ValidateInfo();" action="sbmtinfo.php" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">

	<section class="scrollable padder mTop">
            <div class="rightContent newcourse">
              
               <div class="stepBg">
                <p> Enter the new user's information in the relevant fields and click the Submit button. To cancel all the details you have entered and type fresh information, click the Reset button. To return to the Users page, click the Back link.
                
                </p>
              </div>

  <div class="row-centered">
  <div class="col-sm-12 col-xs-12">
 
       <div class="divider"></div>
	  <div class="col-sm-6 col-xs-6 text-left">
	   
				 <div class="divider"></div> 
				  <label class="control-label required" for="userId"> First name<span class="required">*</span></label>
               
				<input class='form-control input-lg' name="fnm" type="text" id="fnm"  maxlength="50"  data-required="true"  data-minlength="[2]" data-maxlength="[50]" data-regexp="^[a-zA-Z ]+$" data-regexp-message="First name should contain characters only." autocomplete="first-name" value="<?php echo $_REQUEST['fnm'];?>">
				
					  	<label class="instructionlabel">(Maximum 50 characters)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
				<div class="col-sm-6 col-xs-6 text-left">
	   
				 <div class="divider"></div> 
				  <label class="control-label required" for="userId"> Last name<span class="required">*</span></label>
               
				<input class='form-control input-lg'  name="lnm" type="text" id="lnm"   onKeyPress="javascript:editKeyBoard(this,keybAlphaNumeric)" data-required="true" data-minlength="[2]" maxlength="50" autocomplete="last-name" data-regexp="^[a-zA-Z ]+$" data-regexp-message="Last name should contain characters only." value="<?php echo $_REQUEST['lnm'];?>">
				
					  	<label class="instructionlabel">(Maximum 50 characters; No special or numeric characters)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
				 	 <div class="divider"></div> 
				<div class="col-sm-6 col-xs-6 text-left">
				
				 <label class="control-label required" for="userId"> Email (Username)<span class="required">*</span></label>
               
				
					
					  		<input class='form-control input-lg' type="text" id="cEmail" name="cEmail"   size="40" maxlength="50" data-type="email" data-required="true" autocomplete="user-email" value="<?php echo $_REQUEST['email'];?>">
							<label class="instructionlabel">(Maximum 50 characters)</label>
                 <label class="required" id='isMail' name='isMail'></label>
              
                </div>
				<div class="col-sm-6 col-xs-6 text-left">
				
				 <label class="control-label required" for="userId">  Mobile</label>
               
				<input class='form-control input-lg' type="text" name="cPhone"  id="cPhone" size="40"     value="<?php echo $_REQUEST['phone'];?>" maxlength="10" data-minlength="[10]" data-minlength-message="Phone number must be of 10 digit." data-maxlength="[10]"  autocomplete="user-mobile" parsley-type="phone" data-type="phone"  data-type-message="">
					
							<label class="instructionlabel">(Maximum 10 characters, Numeric value only)</label>
                  <label class="required" id="userIdError"></label>
              
                </div>
 
	  <input type="hidden" name="utype"  value="User" />


				<div class="clear"></div>
	 <div class="col-sm-6 col-xs-6 text-left">
				
				 <label class="control-label required" for="userId">Password<span class="required">*</span></label>
               
				
					
					  		<!--<input class='form-control input-lg' name="pwd" type="password" id="pwd1" maxlength="8" data-minlength="[6]" data-required="true" maxlength="8">-->
							 <input class="form-control input-lg" name="pwd" id="pwd" type="password" data-required="true"  maxlength="12" data-regexp="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,12}$" value="<?php //echo $password?>" data-regexp-message="Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character."	  autocomplete="new-password"/><label class="instructionlabel">(Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character)</label>
                  <label class="required" id="userIdError"></label>
              
                </div>
				<div class="col-sm-6 col-xs-6 text-left">
				
				 <label class="control-label required" for="userId">  Confirm password<span class="required">*</span></label>
           <!--   <input type="password" id="cpwd"    name="cpwd" class='form-control input-lg'  data-minlength="[6]" data-required="true" data-equalto="pwd1" maxlength="8"> -->
					 <input class="form-control input-lg" name="cpwd" id="cpwd"   data-equalto="#pwd" data-required= "true" type="password" data-minlength="[6]" data-maxlength="[12]" maxlength="12"/>
							<label class="instructionlabel"></label>
                  <label class="required" id="userIdError"></label>
              
                </div>
   	 <div class="divider"></div> 
	 	 <div class="divider"></div> 
	 
	   <!--start save  -->
	   <div class="text-right"><!-- <a  class="btn btn-red confirModal" id="btnBack" href="dashboard.php"  data-confirm-title="Confirmation Message" data-confirm-message="Are you sure you want to leave this page?" > <i class="build fa fa-arrow-circle-left"></i> Back</a>
         -->
			<input type="hidden" name="obj1" id="obj1" value="">
			 <input type='button' class='btn btn-red'  id='reset' title='Clear all fields to enter fresh information' onclick='enableType();'  value='&nbsp;&nbsp;Reset&nbsp;&nbsp;'
>&nbsp;&nbsp;<input type="hidden" name="uclient" value="5" />
				<button type="submit"  class=' btn btn-red'  id='submituser' title='Submit bug / feedback details'><i class="build fa fa fa-file-text-o"></i> Save</button>
          </div>
         <!--end save  -->
				<div class="col-sm-4 col-xs-4 col-centered">&nbsp;</div> 
</div>
</div>


</div>		
		
      <!--end right  content bar -->

  
   
  


  <!--End Midlle container -->

 </form>
<?php
include ('../intface/footer.php');
?>

<script type="text/javascript">
function checkDuplicateUserId(curId){
	var action = "checkUserId";
	if(curId != ""){
		$.post("combo.php", {action: action,curId:curId}, function(data){
		 if(data == 'YeS'){ 
			 $("#uid").val(''); 
			 $("#userIdExist").html("User Id already exist.");
			  return false;
			  }
		  else{ $("#userIdExist").html("");}
	  });
	}
}
</script>

     