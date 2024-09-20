<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}

$perms=$_SESSION['perms'];

include("../connect.php"); //Connection to database 
include("../global/functions.php"); 

$catid=$_REQUEST['catid'];
$docid=$_REQUEST['docid'];

$result1 = mysql_query ("SELECT company_name, company_created_by FROM tbl_company where id='$catid'"); 
$category_name=mysql_result($result1,0,"company_name");


$result = mysql_query ("SELECT * FROM tbl_courses where id=$docid"); 
$num=mysql_numrows($result);


$filetitle=mysql_result($result,0,"file_title");
$filedescription=mysql_result($result,0,"file_description");
$filename=mysql_result($result,0,"file_name");
$filesize=mysql_result($result,0,"file_size");
$filetype=mysql_result($result,0,"FILE_TYPE");
$filekeys=mysql_result($result,0,"file_keywords");
$uploadedby=mysql_result($result,0,"uploaded_by");
$uploadedby=getFullName($uploadedby);
$uploaddate=mysql_result($result,0,"upload_date");



//$result1 = mysql_query ("SELECT category_name FROM tbl_company where id='$catid'"); 
//$category_name=mysql_result($result1,0,"category_name");
?>

<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->

<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<body topmargin="8">

<table width="100%" height="5%" cellpadding="2" cellspacing="2" class='tblTitle'>
    <tr> 
      <td width="94%" class="instruction">Companies > <? echo ucfirst($category_name) ?> > Courses > Course details</td>
      <td width="6%" class="ContentBold"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1);" target="_self" title="Go back"><font color='white'>Back</font></a></td>
    </tr>
  </table>
  
 


 <table width="100%" border="1" cellspacing="0" class='tblBorder'>
   
	
	<tr>
      <td><table width="100%" border="0" cellpadding="5" cellspacing="5">
        
        <tr> 
          <td valign='top' width="13%" class="ContentBold">File title:</td>
          <td valign='top' class="content"><? echo ucfirst($filetitle) ?></td>

        </tr>
<!--
		 <tr> 
          <td valign='top' width="13%" class="ContentBold">Version:</td>
          <td valign='top' class="content"><? echo $versioninfo.".0" ?></td>

        </tr>
		-->
        <tr> 
          <td valign='top' class="ContentBold">Description:</td>
          <td valign='top' class="content"><? echo ucfirst($filedescription) ?></td>

        </tr>
		 <tr> 
          <td valign='top' class="ContentBold">Keywords:</td>
          <td valign='top' class="content"><? echo ucfirst($filekeys) ?></td>

        </tr>
        <tr> 
          <td valign='top' class="ContentBold">File name:</td>
          <td valign='top' class="content"><? echo ucfirst($filename) ?></td>
       
        </tr>
		 <tr> 
          <td valign='top' class="ContentBold">File type:</td>
          <td valign='top' class="content"><? echo getDocumentType($filetype) ?></td>
       
        </tr>
        <tr> 
          <td valign='top' class="ContentBold">Size:</td>
          <td valign='top' class="content"><? echo ucfirst($filesize)." bytes"  ?></td>
      
        </tr>
		<tr> 
          <td valign='top' class="ContentBold">Added by:</td>
          <td valign='top' class="content"><? echo ucfirst($uploadedby) ?></td>
      
        </tr>
		<tr> 
          <td valign='top' class="ContentBold">Date added:</td>
          <td valign='top' class="content"><? echo parseDate($uploaddate) ?></td>
      
        </tr>
               <tr> 
          <td colspan="2" class="ContentBold">&nbsp;</td>
        </tr>
        <tr> 
          <td class="ContentBold" colspan='2'><div align="center"><a onFocus='this.blur()' onMouseOver='return showStatus();' href='download.php?docid=<?=$docid?>&file_name=<?=$filename;?>&curPage=<?=$currpage?>' title="Download this course">Download this course</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  

		  
		<a onFocus='this.blur()' onMouseOver='return showStatus();' href='javascript:history.go(-1)' title="View all courses">View all courses</a>
		   
		  </div></td>

        </tr>
      </table>
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