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

include("../connect.php"); //Connection to database 
include("../global/functions.php"); 

$docid=$_REQUEST['docid'];

$currpage=trim($_GET['cp']);
$totalPages=trim($_GET['tp']);

$result = mysql_query ("SELECT * FROM tbl_courses where id=$docid"); 
$num=mysql_numrows($result);
$myId=mysql_result($result,0,"id");
$filetitle=mysql_result($result,0,"file_title");

//echo $filetitle;

//set_time_limit(4800);
?>
<html>
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<script>

parent.HeaderPanel.isEdit=false;
parent.HeaderPanel.docId=-1;

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
	

	if(Trim(document.docInfo.ufilename.value)=="")
	{
		alert("Please select a File!");
		document.docInfo.ufilename.value='';
		document.docInfo.ufilename.focus();
		return false;
	}

		
	if(document.docInfo.ufilename.value!="")
	{
		var flag=check_file_type(document.docInfo.ufilename.value,document.docInfo.file_select.value);
		
		//alert (flag);
		if (flag=='false')
		{
			alert("File type mismatch. Please select a valid file type!");
			document.docInfo.ufilename.focus();
			return false;
		}
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
<?


$result2 = mysql_query ("SELECT id, filename, filesize FROM tbl_upload_track order by id DESC LIMIT 1"); 
$num2=mysql_numrows($result2);

$uFileId=mysql_result($result2,0,"id");
$ufilename=mysql_result($result2,0,"filename");
$ufilesize=mysql_result($result2,0,"filesize");
//$result = mysql_query ("SELECT category_name FROM tbl_category where id='$catid'"); 
//$category_name=mysql_result($result,0,"category_name");
?>

<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Courses > <?=TrimString(ucfirst($filetitle))?> > Edit content');">
<form method="post" enctype="multipart/form-data" name="docInfo" action="edit_content_submit.php?docid=<?=$docid?>&from_page=<?=$from_page?>" onSubmit="return ValidateInfo();">

<!--
<table width="800" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php" target="_self" title="Go back">Back</a></td></tr>
 </table>
 -->


<div class='content' id='sType' name='sType' style='position:absolute;left:490px;top:105px;width:300px'></div>
  <table width="800" cellspacing="0" class='tblBorder'>
    <tr>
      <td><table width="100%" border="0" cellpadding="5" cellspacing="2">
    <tr><td class='content' colspan='3'>To edit the content of this course, select the content type, and then click the Submit button. To cancel the changes you have made and return to the Course page, click the Cancel button.</td></tr>   		
<tr height='10px'><td colspan='3'></td></tr>
		  
		  
		  <tr> 
            <td class="ContentBold" valign='top'>File: </td>
            <td>
			<input type='text' size="30" class='inputcls' style="width:300" readonly id='ufilename' name='ufilename' value='<?=$ufilename?>'><input type='hidden' id='ufilesize' name='ufilesize' value='<?=$ufilesize?>'><input type='hidden' id='uFileId' name='uFileId' value='<?=$uFileId?>'></td>
            <td class="Content" align='left'>&nbsp;</td>
          </tr>

		  <tr> 
            <td class="ContentBold" width="22%" valign='top'>Content type: <span class="mandatory">*</span></td>
			<td width="34%"><select name="file_select" onchange='showTypes(this.value)' style='width:300px' class='inputcls'>
						<option value="">Select content type</option>
						<option value="1" >Document</option>
						<option value="2">Package</option>
						
						</select></td>
            <td width="44%" class="Content">&nbsp;</td>
          </tr>
<tr height='10px'><td colspan='3'></td></tr>
      

		  

	
						<tr><td colspan='3'>&nbsp;</td></tr>
						<tr>
						<td  valign="middle" align="center" colspan="3" height="20">
						

						
						
												
						<input type="button" class='submit_button_normal' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';" title="Cancel changes to content and return to Courses page" name="cancle" value="Cancel" onClick="document.location='waiting_documents.php'">&nbsp;&nbsp;<input type="submit" class='submit_button_normal' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';" title="Edit the content for this course" name="upload" value="Submit">
								
				</td></tr>
				
         
        </table>
		</td>
    </tr>
 </table>

</form>

</body>

<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->

</html>