<?php include ('../intface/adm_top.php'); ?>
<SCRIPT language="JavaScript" src="validate.js"></SCRIPT>
<script>
//function to clear the input fields
function clearFields()
{
//document.userInfo.fstnm.value="";
//document.userInfo.lstnm.value="";
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
alert('Giving up :( Cannot create an XMLHTTP instance');
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
alert('There was a problem with the request.');
}
}
}


function checkMail(val)
{
	if (Trim(val)!="" &&  echeck(val) !=false)
	{
	makeRequest('../../admin/crtuser/combo.php?action=chkMyMail&val='+val,"check_list",val);
	}
	else
	{
	document.getElementById("isMail").innerHTML="";
	}
}

</script>

<?
session_start();
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
/* $uid=mysql_result($result,0,"username");
$utype=mysql_result($result,0,"usertype");
$dt=mysql_result($result,0,"dtenrolled");
$squestion=mysql_result($result,0,"squestion");
$sanswer=mysql_result($result,0,"sanswer");
$dob=mysql_result($result,0,"dob");
$doj=mysql_result($result,0,"doj");
$department=mysql_result($result,0,"department");
$country=mysql_result($result,0,"country");
$city=mysql_result($result,0,"city"); */

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


?>
<section class="scrollable">
		  <section class="panel panel-default padder contentTop" >	 
		  <div class="col-lg-6 col-md-6 col-sm-6 show-mon">
            <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Edit Profile</strong></span> </div>
          </div> <div class="col-lg-6 col-md-6 col-sm-6 text-right"> 
		  
		  <a onFocus='this.blur()' onMouseOver='return showStatus();' href="mydtls.php" target="_self" class="btn btn-lg btn-default bdrRadius20 marginLeft5" title="Go back">Back</a>
			  
		
			  </div><div class="clear"></div>  
       <div class="col-lg-12 col-md-12 col-sm-12 paddTop10"> <p>Type your new details in the relevant fields and click the Update button. Click the Back link to return to the My Profile page.
	  </p></div><div class="paddTop10 divider"></div>
  </section><div class="clear"></div>  

 <section class="panel panel-default padder paddTop10" style="overflow:hidden">


<form name="userInfo" data-validate="parsley" action="updtinfo.php" method="post">

<div class="form-group col-sm-6 vTop">
  <label>First Name <span class="mandatory">*</span> <small>(Maximum 30 characters; No special 
              or numeric characters)</small></label>
  <input name="fstnm"  type="text" value=<?=$fnm?> id="fstnm" size="40" maxlength="30"  data-required="true" data-regexp="^[a-zA-Z ]+$" data-regexp-message="First name should contain characters only." class="form-control parsley-validated"  autocomplete="off"/>                       
</div>
<div class="form-group col-sm-6 vTop">
  <label>Last Name <span class="mandatory">*</span> <small>(Maximum 30 characters; No special 
              or numeric characters)</small></label>
			 
  <input type="text" name="lstnm" id="lstnm"  value="<?=$lnm?>" size="40" maxlength = "30"  data-required= "true" data-regexp="^[a-zA-Z ]+$" data-regexp-message="Last name should contain characters only." class="form-control parsley-validated" autocomplete="off">                        
</div>
<div class="divider"></div>  
			<div class="clear"></div>
<div class="form-group  col-sm-6 vTop">
  <label>Email ID <span class="mandatory">*</span> <small>(No spaces; Valid email address)</small></label>
  <input type="hidden" id="isMail" name='isMail' value="<?=$email  ?>"/>

  <input type="text" name="email" id="email" value="<?=$email ?>" data-required="true" data-type="email" size="40"   maxlength = "200" class="form-control parsley-validated"  onblur='checkMail(this.value)' autocomplete="off" disabled>
</div>

<div class="form-group  col-sm-6 vTop">
  <label>Mobile <span class="mandatory">*</span> <small>(No spaces; Number only)</small></label>

  <input type="text" name="mobile" id="mobile" value="<?=$mobile ?>"  size="10" min="10"  maxlength = "10" class="form-control parsley-validated"   autocomplete="off" parsley-type="phone" data-type="phone"  data-type-message="" >
</div>
    
 <div class="form-group  col-sm-6 vTop">
 
			<div class="divider"></div>  
			<div class="clear"></div>
			<div class="text-right">
			 <button type="submit"  class=' btn btn-red'  id='submituser' title='Replace my old details with new'><i class="build fa fa fa-file-text-o"></i> Update</button>
			</div> 
			<div class="divider"></div>    
			<div class="clear"></div>
           </div> 
 </section>  </section> 
		
<?php
include ('../intface/footer.php');
?>

<script>
 Zapatec.Calendar.setup(
    {
      inputField  : "dob",       // ID of the input field
      ifFormat    : "%m/%d/%Y",    // the date format
      button      : "trigger1"       // ID of the button
    }
  );

   Zapatec.Calendar.setup(
    {
      inputField  : "doj",       // ID of the input field
      ifFormat    : "%m/%d/%Y",    // the date format
      button      : "trigger2"       // ID of the button
    }
  );
  </script>
