<?php include ('../intface/adm_top.php'); ?>

<?php

$perms=$_SESSION['perms'];
//$catid=$_REQUEST['catid'];
$docid=$_REQUEST['docid'];
$currpage=trim($_GET['cp']);
$totalPages=trim($_GET['tp']);
$cCategory=trim($_REQUEST['cCategory']);
$cContent=trim($_REQUEST['cContent']);
$cCode=trim($_REQUEST['cCode']);
$cTitle=trim($_REQUEST['cTitle']);
$cDesc=trim($_REQUEST['cDesc']);
$cKey=trim($_REQUEST['cKey']);



$con=createConnection();
$query1 = "SELECT id,name,summary,width,height FROM tls_scorm where id=$docid";

$result = mysqli_query($con,$query1);
$totalnum=mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);


$myId=$row['id'];
$filetitle=$row['name'];
$filedescription=$row['summary'];
$sWidth=$row['width'];
$sHeight=$row['height'];


?>

<script>
function IsNumeric(strString)
  //  check for valid numeric strings	
   {
   var strValidChars = "0123456789";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (m = 0; m < strString.length && blnResult == true; m++)
      {
      strChar = strString.charAt(m);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
   return blnResult;
 }

 function Trim(s) 
{
  // Remove leading spaces and carriage returns
  while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
  {
    s = s.substring(1,s.length);
  }

  // Remove trailing spaces and carriage returns
  while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
  {
    s = s.substring(0,s.length-1);
  }
  return s;
}

function validateCourse()	
	{ 	
	

	
	if(Trim(document.modifycourse.title.value)=="")
	{
		alertify.alert("Please enter Title!");
		document.modifycourse.title.value='';
		document.modifycourse.title.focus();
		return false;
	}	
	if(Trim(document.modifycourse.sWidth.value)=="")
	{
		alertify.alert("Please enter Launch window width!");
		document.modifycourse.sWidth.value='';
		document.modifycourse.sWidth.focus();
		return false;
	}	
	
	if(Trim(document.modifycourse.sWidth.value)!="" && IsNumeric(document.modifycourse.sWidth.value)==false)
	{
		alertify.alert("Please enter a numeric value for Launch window width!");
		document.modifycourse.sWidth.value='';
		document.modifycourse.sWidth.focus();
		return false;
	}	

	if(Trim(document.modifycourse.sHeight.value)!="" && IsNumeric(document.modifycourse.sHeight.value)==false)
	{
		alertify.alert("Please enter a numeric value for Launch window height!");
		document.modifycourse.sHeight.value='';
		document.modifycourse.sHeight.focus();
		return false;
	}	
	
	if(Trim(document.modifycourse.sHeight.value)=="")
	{
		alertify.alert("Please enter Launch window height!");
		document.modifycourse.sHeight.value='';
		document.modifycourse.sHeight.focus();
		return false;
	}



	
}

var codeExists=0;
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


if(tempTxt == "check_code")
{
//alert(http_request.responseText);
	if(http_request.responseText=="1")
	{
	document.getElementById("isCode").innerHTML="Course ID already exists!";
	codeExists=1;
	}
	else
	{
	document.getElementById("isCode").innerHTML="";
	codeExists=0;
	}
	

}


} 
else {
alertify.alert('There was a problem with the request.');
}
}
}


function checkCode(val)
{

	if (Trim(val)!="")
	{
	var myCId=document.getElementById('filename').value;
	makeRequest('ajaxcoursecodecheck.php?action=chkMyCode&myId='+myCId+'&val='+val,"check_code",val);
	}
	else
	{
	document.getElementById("isCode").innerHTML="";
	}
}
</script>

<!-- -->
<!-- mid section -->
		
<section id="content" class="">
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Edit course </strong></span> </div>
		 
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
			<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php?currpage=<?=$currpage?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a>
			</div>
		
  </div>
   
  
</section>
</section>
    <!-- ####### Show table Grid -->


<form  name="modifycourse" onSubmit="return validateCourse();" action="course_modify_submit.php?cp=<? echo $currpage?>&tp=<? echo $totalPages?>" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">

	<section class="scrollable padder mTop">
            <div class="rightContent newcourse">
              
              <div class="stepBg">
                <p> To change the details of this course, enter the information in the relevant fields, select the required window settings, and then click the Update button. To cancel the details you have entered in the fields and return to the Courses page, click the Cancel button.
                
                </p>
              </div>

  <div class="">
  <input type='hidden' value="<?=$myId?>" id="myId" name="myId">
		<input type='hidden' value="<?=$filename?>" id="filename" name="filename">
  
      <div class="col-sm-8 col-xs-8 text-left">
	   
				 <div class="divider"></div> 
				  <label class="control-label required" for="userId">Course title<span class="required">*</span></label>
               
				<input class='form-control input-lg' maxlength="250" name="title" type="text" value="<?=$filetitle?>" size="30"  data-required="true">
				
					  	<label class="instructionlabel">(Maximum 250 characters)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
				
				    <div class="divider"></div>
					<div class="col-sm-8 col-xs-8 text-left">
				
				 <label class="control-label required" for="userId">  Description</label>
               
				
					
					  		<TEXTAREA name="desc" onKeyDown="textCounter(this.form.desc,this.form.remLen,1000);" onKeyUp="textCounter(this.form.desc,this.form.remLen,1000);" cols="30" rows="4" wrap="VIRTUAL" style="height:80px" class='form-control input-lg textarea'><?=$filedescription?></TEXTAREA>
							<label class="instructionlabel">(Maximum 1,000 characters)<input readonly style='visibility:hidden;border:0px' type=text name='remLen' size=2 maxlength=4 value="1000"></label>
                  <label class="required" id="userIdError"></label>
              
                </div>
				  <div class="divider"></div>
				<div class="col-sm-8 col-xs-8 text-left">
				
				 <label class="control-label required" for="userId"> Course Window size<span class="required">*</span></label>
               
				<div class="divider"></div>
					
					  		<input class='form-control input-sm col-sm-4' maxlength="4" name="sWidth" type="text"  value='<?=$sWidth?>' style="display:inline-block;width:40%">
							 <div style="display:inline-block;width:20%;padding-top:10px;" class=" col-sm-4">width&nbsp;&nbsp;X&nbsp;&nbsp;height</div>
							 <input class='form-control input-sm col-sm-4'  maxlength="4" name="sHeight" type="text"  value='<?=$sHeight?>' style="display:inline-block;width:40%"> 
							<label class="instructionlabel"></label>
                  <label class="required" id='isMail' name='isMail'></label>
              
                </div>
				
     <div class="divider"></div>
	 
	  <div class="divider"></div> 
	 
	 <div class="col-sm-8 col-xs-8 text-left">
	   <!--start save  -->
	   <div class="text-right"><!-- <a  class="btn btn-red confirModal" id="btnBack" href="dashboard.php"  data-confirm-title="Confirmation Message" data-confirm-message="Are you sure you want to leave this page?" > <i class="build fa fa-arrow-circle-left"></i> Back</a>
         -->
				<input type='hidden' name='docid' value='<?=$docid?>'>
			 <input type='button' class='btn btn-red'  id='reset' title='Cancel changes to details and return to Courses page' value='&nbsp;Cancel&nbsp;'  onClick="document.location='waiting_documents.php?currpage=<?=$currpage?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>'">&nbsp;&nbsp;
				<button type="submit"  class=' btn btn-red'  id='submituser' title='Change the details for this course'><i class="build fa fa fa-file-text-o"></i> Update</button><input type='hidden' name='uid' id='uid' value=<?=$uRowId?>>
        </div>
         <!--end save  -->
	</div>
</div>		
		
           </div>
			
      <!--end right  content bar -->
  


  <!--End Midlle container -->


 </form>
<?php
closeConnection($con);
include ('../intface/footer.php');
?>

