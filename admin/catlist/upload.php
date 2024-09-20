<?
header("Last-Modified: " . gmdate("D, d M Y H:i:s") ." GMT");
header("Expires: " . gmdate("D, d M Y H:i:s") ." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("pragma: no-cache");
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
include("../global/nocacheofpage.php"); 
$from_page=$_REQUEST['from_page'];
set_time_limit(4800);
?>
<html>
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<script>

if(parent.HeaderPanel.isEdit==true)
{
document.location='edit_content.php?docid='+parent.HeaderPanel.docId;
}

parent.HeaderPanel.isEdit=false;
parent.HeaderPanel.docId=-1;

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

function ValidateInfo()	
	{ 	
	
	if(Trim(document.docInfo.file_select.value)=="")
	{
		alert("Please select Content type!");
		document.docInfo.file_select.value='';
		document.docInfo.file_select.focus();
		return false;
	}
	/*
	if(Trim(document.docInfo.code.value)=="")
	{
		alert("Please enter Course ID!");
		document.docInfo.code.value='';
		document.docInfo.code.focus();
		return false;
	}

	if(codeExists==1)
	{
		alert("Course ID already exists!");
		//document.docInfo.code.value='';
		document.docInfo.code.focus();
		return false;
	}
*/
	if(Trim(document.docInfo.title.value)=="")
	{
		alert("Please enter Course title!");
		document.docInfo.title.value='';
		document.docInfo.title.focus();
		return false;
	}	

	if(Trim(document.docInfo.ufilename.value)=="")
	{
		alert("Please select a File!");
		document.docInfo.ufilename.value='';
		document.docInfo.ufilename.focus();
		return false;
	}


	if(Trim(document.docInfo.sWidth.value)=="")
	{
		alert("Please enter Launch window width!");
		document.docInfo.sWidth.value='';
		document.docInfo.sWidth.focus();
		return false;
	}	
	
	if(Trim(document.docInfo.sWidth.value)!="" && IsNumeric(document.docInfo.sWidth.value)==false)
	{
		alert("Please enter a numeric value for Launch window width!");
		document.docInfo.sWidth.value='';
		document.docInfo.sWidth.focus();
		return false;
	}	

	if(Trim(document.docInfo.sHeight.value)!="" && IsNumeric(document.docInfo.sHeight.value)==false)
	{
		alert("Please enter a numeric value for Launch window height!");
		document.docInfo.sHeight.value='';
		document.docInfo.sHeight.focus();
		return false;
	}	
	
	if(Trim(document.docInfo.sHeight.value)=="")
	{
		alert("Please enter Launch window height!");
		document.docInfo.sHeight.value='';
		document.docInfo.sHeight.focus();
		return false;
	}
	
		
	/*if(document.docInfo.ufilename.value!="")
	{
		var flag=check_file_type(document.docInfo.ufilename.value,document.docInfo.file_select.value);
		
		//alert (flag);
		if (flag=='false')
		{
			alert("File type mismatch. Please select a valid file type!");
			document.docInfo.file_select.focus();
			return false;
		}
	}*/

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


if(tempTxt == "check_code")
{

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
alert('There was a problem with the request.');
}
}
}


function checkCode(val)
{
	
	if (Trim(val)!="")
	{
	makeRequest('ajaxcoursecodecheck.php?action=chkCode&val='+val,"check_code",val);
	}
	else
	{
	document.getElementById("isCode").innerHTML="";
	}
}

function check_file_type(filename,fileType)
{
	var arr;
	arr=filename.lastIndexOf(".");
	var varExt=filename.substring(arr+1,filename.length);
//	arr=filename.split(".");
//	var varExt=String(arr[1]);
	varExt=varExt.toLowerCase();

	switch(fileType)
	{
		
		case '1':
			if (varExt!='gif' && varExt!='jpeg' && varExt!='swf' && varExt!='jpg' && varExt!='wav' && varExt!='wmv' && varExt!='mp3' && varExt!='avi' && varExt!='mpeg' && varExt!='txt' && varExt!='html' && varExt!='htm' && varExt!='pdf' && varExt!='ppt' && varExt!='pps' && varExt!='doc' && varExt!='rtf' && varExt!='zip')
			{
				return 'false';
			}
			break;
			
					
		case '2':
			if (varExt!='zip')
			{
				return 'false';
			}
			break;
		
	}
	return 'true';
}

</script>


	<script type="text/javascript" language="javascript">
	//////////////////////////////////AJAX//////////////////////////////
	

//////////////////////////////////AJAX//////////////////////////////

function showTypes(num)
{
	if(num=='1')

	{
	document.getElementById('sType').innerHTML="<span class='contentBold'>Supported File Types: </span> .gif, .jpeg, .swf, .jpg, .wav, .wmv, .mp3, .avi, .mpeg, .txt, .html, .htm, .pdf, .ppt, .pps, .doc, .rtf, .zip";
	}
	else if(num=='2')

	{
	document.getElementById('sType').innerHTML="<span class='contentBold'>Supported File Types: </span> .zip";
	}
	else
	{
	document.getElementById('sType').innerHTML="";
	}
}
	
	</script>




</HEAD>

<!-- -->
<link href="../styles/styles.css" rel="stylesheet" type="text/css"> <body topmargin="8">
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>
<?
include("../connect.php"); //Connection to database 
include("../global/functions.php"); 

$result2 = mysql_query ("SELECT id, filename, filesize FROM tbl_upload_track order by id DESC LIMIT 1"); 
$num2=mysql_numrows($result2);

$uFileId=mysql_result($result2,0,"id");
$ufilename=mysql_result($result2,0,"filename");
$ufilesize=mysql_result($result2,0,"filesize");
?>

<body topmargin="10" leftmargin="10" class='contentBG' onload="setPageTitle('Courses > Add a course');">
<!--
<table width="784" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php" target="_self" title="Go back">Back</a></td></tr>
</table>
-->

<div class='content' id='sType' name='sType' style='position:absolute;left:477px;top:78px;width:300px'></div>


  <table width="784" cellspacing="0" cellpadding='0' class=''>
    <tr>
      <td>
	  <form method="post" enctype="multipart/form-data" name="docInfo" action="submit.php?upd=yes&from_page=<?=$from_page?>" onSubmit="return ValidateInfo();">
	  <table width="100%" border="0" cellpadding="3" cellspacing="2">
       		 <tr><td class='content' colspan='3'>Enter the required information in the fields, select the required window settings, and then click the Add button. To delete the information you have entered and return to the Courses page, click the Cancel button.</td></tr> 

		 <tr> 
            <td class="ContentBold" valign='top'>File: </td>
            <td><input type='text' size="30" class='inputcls' style="width:300" readonly id='ufilename' name='ufilename' value='<?=$ufilename?>'><input type='hidden' id='ufilesize' name='ufilesize' value='<?=$ufilesize?>'><input type='hidden' id='uFileId' name='uFileId' value='<?=$uFileId?>'></td>
            <td class="Content" align='left' valign='top'>&nbsp;</td>
          </tr>
		  <tr> 
            <td class="ContentBold" width="20%" valign='top'>Content type: <span class="mandatory">*</span></td>
			<td width="32%"><select name="file_select" onchange='' style='width:300px' class='inputcls'>
						<option selected value="1" >SCORM 1.2 Pacakge</option>
						<option value="2" >AICC Pacakge</option>
				
						
						</select>&nbsp;</td>
            <td width="44%" class="Content">&nbsp;</td>
          </tr>

       <!--
		  <tr>
        
            <td width='20%' class="ContentBold" valign='top'>Course ID: <span class="mandatory">*</span></td>
            <td width='40%'><input maxlength="32" onblur='checkCode(this.value)' name="code" class='inputcls' type="text" value="" size="30" style="width:300"></td>
            <td class="Content">&nbsp;</td>
          </tr>
		  -->
		   <tr height='5'>
        <td class="Content"></td>
            <td colspan='2' id='isCode' name='isCode' class="mandatory" valign='top'></td>
          </tr>

		  <tr>
        
            <td class="ContentBold" valign='top'>Course title: <span class="mandatory">*</span></td>
            <td><input maxlength="250" name="title" class='inputcls' type="text" value="" size="30" style="width:300"></td>
            <td class="Content">&nbsp;</td>
          </tr>

		  

    	  <!--
		   <tr> 
            <td class="ContentBold" valign='top'>Launch File Name: <span id='cTick' name='cTick' class="mandatory">*</span></td>
            <td>
			<input name="launchFile" name="launchFile" type="text" class='inputcls' size="30" maxlength='200' style="width:300"></td>
            <td class="Content">&nbsp;</td>
          </tr>
		  -->

          
		   
		   <tr>
						<td  valign="top" class="ContentBold">Description:</td>
						<td><textarea name="desc" onKeyDown="textCounter(this.form.desc,this.form.remLen,1000);" onKeyUp="textCounter(this.form.desc,this.form.remLen,1000);" cols="30" class='inputcls' rows="4" wrap="VIRTUAL" style="width:300; vertical-align:top"></textarea></td>
						<td class="Content" valign='top'>(Maximum 1,000 characters) <input readonly style='visibility:hidden;border:0px' type=text name='remLen' size=2 maxlength=4 value="1000"></td>
		  </tr>
		   <!--
		   <tr>
        
            <td class="ContentBold" valign='top'>Keywords:</td>
            <td><input maxlength="250" name="keys" class='inputcls' type="text" value="" style="width:300"></td>
            <td class="Content">&nbsp;</td>
          </tr>
          
-->
						 <tr>
        
            <td class="ContentBold" valign='top'>Course Window size:</td>
            <td class='content'><input maxlength="4" name="sWidth" class='inputcls' type="text" style="width:50" value='1024'> width&nbsp;&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;&nbsp;<input maxlength="4" name="sHeight" class='inputcls' type="text" style="width:50" value='768'> height</td>
            <td class="Content">&nbsp;</td>
          </tr>
		  <!--
			 <tr>
        
            <td class="ContentBold" valign='top'>Launch window settings:</td>
            <td class='content'><input type='checkbox' name='sResize' checked>&nbsp;&nbsp;Allow the window to be resized<br><input type='checkbox' name='sScroll' checked>&nbsp;&nbsp;Allow the window to be scrolled<br><input type='checkbox' name='sDirectory'>&nbsp;&nbsp;Show the directory links<br><input type='checkbox' name='sLocation'>&nbsp;&nbsp;Show the location bar
<br><input type='checkbox' name='sMenubar'>&nbsp;&nbsp;Show the menu bar<br><input type='checkbox' name='sToolbar'>&nbsp;&nbsp;Show the toolbar
<br><input type='checkbox' name='sStatusbar'>&nbsp;&nbsp;Show the status bar
<br></td>
            <td class="Content">&nbsp;</td>
          </tr>
						-->
						<tr><td>&nbsp;</td></tr>
						
						<tr>
						<td  valign="middle" align="center" colspan="3" height="20">
						
						<input type="hidden" name="MAX_file_size" value="2097152" />

						
						
						<input type="submit" class='submit_button_normal' onMouseOver="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';" title="Add this course" name="upload" value="Add">&nbsp;&nbsp;						
						<input type="button" class='submit_button_normal' onMouseOver="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';" title="Cancel details and return to Courses page" name="cancle" value="Cancel" onClick="javascript:document.location='waiting_documents.php';">
								
				</td></tr>
         
        </table>
		</form>
	  </td>
    </tr>
 </table>



</body>

<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->

</html>