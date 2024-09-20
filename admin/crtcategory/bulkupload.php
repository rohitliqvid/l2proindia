<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}

include("../connect.php"); //Connection to database 
include("../global/functions.php"); //Connection to database 
$userid = $_SESSION['sess_uid'];
mysql_query("DELETE FROM tbl_comp_bulkstatus");
?>
<html>
<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

<script>
function chk1()
{
		if(stripSpaces(document.frmprofile.userfile.value)=="")
		{
			alert("Please select an input file in .xls format!");
			document.frmprofile.userfile.focus();
			return false;
		}

		if(document.frmprofile.userfile.value!="")
		{
		arr=document.frmprofile.userfile.value.lastIndexOf(".");
		var varExt=document.frmprofile.userfile.value.substring(arr+1,document.frmprofile.userfile.value.length);

		varExt=varExt.toLowerCase();
		//alert (flag);
			if (varExt!='xls')
			{
				alert("File Type mismatch. Please select an .xls file!");
				document.frmprofile.userfile.focus();
				return false;
			}
		}
}

function stripSpaces(theStr) {
  if (!theStr) theStr = "";  //ensure its not null
  theStr = theStr.replace(/^\s*/,""); //strip leading
  theStr = theStr.replace(/\s*$/,""); //strip trailing
  return theStr;
}
</script>
</HEAD>
<!-- -->
<link href="../styles/styles.css" rel="stylesheet" type="text/css"> 


<body class='contentBG' topmargin="10" leftmargin="10">

 <form method="post" action="bulkuploadsubmit.php" onSubmit="return chk1();" id='frmprofile' name='frmprofile'  enctype="multipart/form-data">

   <table width="100%" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold'>Countries > Bulk Upload</td><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()'  href="../catlist/catlist.php" target="_self" title="Go back">Back</a></td></tr>
 </table>
<br><br>

  <table width="100%" cellspacing="0" class='tblBorder2'>
    <tr>
      <td><table width="100%" border="0" cellpadding="3" cellspacing="5">
          <tr class="Content"> 
            <td colspan="3">To create multiple countries, select the input file (xls) and click the Submit button.<br></td>
          </tr>
		   <tr class="ContentBold">
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr> 
            <td class="ContentBold" width="139">Select input file: <span class="mandatory">*</span></td>
            <td width="200"><input type="file" style='width:315px' class="inpucls" name="userfile"></td>
            <td width="419" class="Content" valign='middle'>(Maximum 8 MB)</td>
          </tr>
         
                <tr class="ContentBold">
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr class="ContentBold"> 
            <td colspan="3"><div align="center"> 
               <input type='submit' class='submit_button_normal' id='submituser' title='Submit information' value='&nbsp;Submit&nbsp;'
onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">
              </div></td>
          </tr>
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

