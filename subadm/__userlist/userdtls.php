<?php include ('../intface/adm_top.php'); ?>

<SCRIPT language="JavaScript" src="validate.js"></SCRIPT>
<script>

window.onload = function(){
 setPageTitle('Users > <?=ucfirst($fnm).' '.ucfirst($lnm);?>');
}

</script>


<?php
$uRowId=$_REQUEST['uid'];
//echo "-->".$uRowId;



$con=createConnection();
$stmt = $con->prepare("SELECT id,firstname,lastname,usertype,dtenrolled,email,mobile,sex,learn_from,education,profession,education_details,profession_experience,user_country,user_state,user_city,zip_code,allow_email_for_marketing,allow_email_for_campaign,occupation,organization,designation,client FROM tbl_users where id=?");
$stmt->bind_param("i",$uRowId);
$stmt->execute();
$stmt->bind_result($id,$firstname,$lastname,$utype,$dt,$email,$mobile,$sex,$learn_from,$education,$profession,$education_details,$profession_experience,$user_country,$user_state,$user_city,$zip_code,$allow_email_for_marketing,$allow_email_for_campaign,$occupation,$organization,$designation,$client);
$stmt->fetch();
$stmt->close();	
closeConnection($con);


//$result = mysql_query ("SELECT * FROM tbl_users where id=$uRowId"); 
//$num=mysql_numrows($result);

$userid=$id;
$fnm=$firstname;

$lnm=$lastname;
$uid=$username;

//$pwd=$password;

$utype=$usertype;
$dt=$dtenrolled;
$email=$email;
$mobile=$mobile;
$userStatus=$userregistered;


$client=$client;

function showDate($val)
{
$showVal=explode('-',$val);
$newShowVal=$showVal[1]."/".$showVal[2]."/".$showVal[0];
if($showVal[2]=='')
{
$newShowVal='';
}
return $newShowVal;
}

if ($utype==1)
{
$utype="Administrator";
}
else if ($utype==2)
{
$utype="Admin";
}
else
{
$utype="Learner";
}


/*$cListQuery="SELECT * FROM tbl_company AS A, tbl_company_user AS B WHERE A.id=B.company_id and B.user_id='$uRowId' ORDER BY A.company_name ASC";
$cList = mysql_query ($cListQuery);
$cListNum=mysql_numrows($cList);
$arrCList=array();
if ($cListNum)
			{
							
				$j=0;
				while ($j < $cListNum) 
				{
				$row = mysql_fetch_assoc($cList);
				$id = $row['id'];
				$arrCList[]=ucfirst(mysql_result($cList,$j,"A.id"));
				$j++;
				}	
			}
$strCList=implode(', ',$arrCList);*/
//echo $strCList;
?>

<!--Code to prevent the caching of page-->

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
	document.getElementById("isMail").innerHTML="Email address already exists!";
	mailExists=1;
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
		var usrid=document.getElementById('usid').value;
	makeRequest('../crtuser/combo.php?action=chkUserMail&usid='+usrid+'&val='+val,"check_list",val);
	}
	else
	{
	document.getElementById("isMail").innerHTML="";
	}
}

</script>
<section id="content" class="">
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Edit user </strong></span> </div>
		 
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
			<a onFocus='this.blur()' onMouseOver='return showStatus();' href="userlist.php" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a>
			</div>
		
  </div>
  
  
</section>
<br>
<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>
					
			   <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom:20px;clear:both">
                  <div class="alert alert-success" role="alert">
				<?php echo $_SESSION['msg']; unset($_SESSION['msg']);?>  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
				</div>
                </div>  
				<?php } ?>	
</section>
    <!-- ####### Show table Grid -->

 

<form  name="userInfo" onSubmit="return ValidateInfo();" action="updusertinfo.php" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">

	<section class="scrollable padder  mTop">
            <div class="rightContent newcourse">
              
              <div class="stepBg">
                <p> Type the new details for this user in the relevant fields and click the Update button. To return to the Users page, click the Back link. To cancel all the details you have entered and return to the Users page, click the Cancel button.
                
                </p>
              </div>

  <div class="row-centered">
  <div class="col-sm-12 col-xs-12">
        <div class="divider"></div>
  
      <div class="col-sm-6 col-xs-6 text-left">
	   
				 <div class="divider"></div> 
				  <label class="control-label required" for="userId"> First name<span class="required">*</span></label>
               
				<input class='form-control input-lg' name="fnm" type="text" id="fnm"  maxlength="50"  data-required="true"  data-minlength="[2]" data-maxlength="[50]" data-regexp="^[a-zA-Z ]+$" data-regexp-message="First name should contain characters only." autocomplete="first-name"  value="<?php echo ucfirst($fnm)?>">
				
					  	<label class="instructionlabel">(Maximum 50 characters; No special or numeric characters)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
				<div class="col-sm-6 col-xs-6 text-left">
	   
				 <div class="divider"></div> 
				  <label class="control-label required" for="userId"> Last name<span class="required">*</span></label>
               
				<input class='form-control input-lg'  name="lnm" type="text" id="lnm" data-required="true" data-minlength="[2]" maxlength="50" autocomplete="last-name" data-regexp="^[a-zA-Z ]+$" data-regexp-message="Last name should contain characters only."  value='<?php echo ucfirst($lnm)?>' >
				
					  	<label class="instructionlabel">(Maximum 50 characters; No special or numeric characters)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
				    <div class="divider"></div>
				<div class="col-sm-6 col-xs-6 text-left">
				
				 <label class="control-label required" for="userId"> Email (Username)<span class="required">*</span></label>
               
				
					
					  		<!--<input class='form-control input-lg' onblur='checkMail(this.value)' type="text" id="cEmail" name="cEmail"   size="40" maxlength="200" data-type="email" data-required="true" value='<?=$email?>'>-->
							<input class='form-control input-lg' type="text" id="cEmail" name="cEmail"   size="40" maxlength="200" data-type="email" data-required="true" value='<?=$email?>' readonly>
							<label class="instructionlabel">(No spaces, Valid email address)</label>
                  <label class="required" id='isMail' name='isMail'></label>
              
                </div>
				<div class="col-sm-6 col-xs-6 text-left">
				
				 <label class="control-label required" for="userId">  Mobile</label>
               
				<input class='form-control input-lg' type="text" name="phone"  id="phone" size="40" maxlength="10" data-minlength="[10]" data-minlength-message="Phone number must be of 10 digit." data-maxlength="[10]"  autocomplete="user-mobile" parsley-type="phone" data-type="phone"  data-type-message=""  value="<?php echo $mobile?>">
					
							<label class="instructionlabel">(Must be 10 characters, Numeric value only)</label>
                  <label class="required" id="userIdError"></label>
              
                </div>
     <div class="divider"></div>
	 <div class="col-sm-6 col-xs-6 text-left">
				
				 <label class="control-label required" for="userId">Reset Password</label>
               
				
					 <input class="form-control input-lg" name="pwd" id="pwd" type="password"   maxlength="12" data-regexp="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,12}$" value="<?php //echo $password?>" data-regexp-message="Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character." autocomplete="new-password"/>
			<!--	<input class='form-control input-lg' name="pwd" type="password" id="pwd" size="40" maxlength="8" data-type="password" > -->
					<label class="instructionlabel">(Password should be between 6 to 12 characters, at least 1 letter, 1 number and 1 special character)</label>
                    <label class="required" id="userIdError"></label>
              
                </div>
				<div class="col-sm-6 col-xs-6 text-left">
				
				 <label class="control-label required" for="userId"> Status</label>
            
				<select id='uStatus' name='uStatus' class='form-control input-lg'  >
				<option value='1' <? if($userStatus=='1') { echo 'selected'; } else { echo ''; } ?>>Active</option>
				<option value='0' <? if($userStatus=='0') { echo 'selected'; } else { echo ''; } ?>>Inactive</option>
				</select>	
							<label class="instructionlabel"></label>
                  <label class="required" id="userIdError"></label>
              
                </div>
     <div class="divider"></div>
	 
				
				
				<div class="divider"></div> 
	 	 <div class="divider"></div> 
	 
	   <!--start save  -->
	   <div class="text-right"><!-- <a  class="btn btn-red confirModal" id="btnBack" href="dashboard.php"  data-confirm-title="Confirmation Message" data-confirm-message="Are you sure you want to leave this page?" > <i class="build fa fa-arrow-circle-left"></i> Back</a>
         -->
		<input type="hidden" name="obj1" id="obj1" value="">
			<input type="hidden" name="uclient" value="5" />
			 <input type='button' class='btn btn-red'  id='reset' title='Cancel changes to user details and return to Users page' value='&nbsp;Cancel&nbsp;' onClick="javascript:history.go(-1);" >&nbsp;&nbsp;
				<button type="submit"  class=' btn btn-red'  id='submituser' title='Replace old details with new'><i class="build fa fa fa-file-text-o"></i> Update</button><input type='hidden' name='uid' id='uid' value=<?=$uRowId?>><input type='hidden' name='usernameid' id='usernameid' value=<?=$uid?>>
          </div>
         <!--end save  -->
				<div class="col-sm-12 col-xs-12 col-centered">&nbsp;</div> 
</div>
</div>


</div>		
		
           </section>
			
      <!--end right  content bar -->
   
    <!--start save  -->
     
  <!--End Midlle container -->


 </form>
<?php
include ('../intface/footer.php');
?>

