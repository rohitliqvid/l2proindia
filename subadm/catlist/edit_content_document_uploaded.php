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

//$catid=$_REQUEST['catid'];
$docid=$_REQUEST['docid'];
$from_page=$_REQUEST['from_page'];

if(isset($_REQUEST['iszip']))
{
$choice = $_POST['choice'];
	if ($choice<>"")
	{
		foreach ($choice as $value)
		{ 
		mysql_query("INSERT INTO tbl_courses_links(course_id,file_launch) VALUES('$docid','$value')");
		}
	}

}



$result = mysql_query ("SELECT * FROM tbl_courses where id=$docid"); 
$num=mysql_numrows($result);


$filetitle=mysql_result($result,0,"file_title");
$filedescription=mysql_result($result,0,"file_description");
$filename=mysql_result($result,0,"file_name");
$filesize=mysql_result($result,0,"file_size");
$filetype=mysql_result($result,0,"file_type");
$coursecode=mysql_result($result,0,"file_code");

$fileLaunch=mysql_result($result,0,"file_launch");
$win_width=mysql_result($result,0,"win_width");
$win_height=mysql_result($result,0,"win_height");
$win_resize=mysql_result($result,0,"win_resize");
$win_scroll=mysql_result($result,0,"win_scroll");
$win_directory=mysql_result($result,0,"win_directory");
$win_location=mysql_result($result,0,"win_location");
$win_menu=mysql_result($result,0,"win_menu");
$win_tool=mysql_result($result,0,"win_tool");
$win_status=mysql_result($result,0,"win_status");

$filekeys=mysql_result($result,0,"file_keywords");
$uploadedby=mysql_result($result,0,"uploaded_by");
$uploadedby=getFullName($uploadedby);
$uploaddate=mysql_result($result,0,"upload_date");



//$result1 = mysql_query ("SELECT category_name FROM tbl_category where id='$catid'"); 
//$category_name=mysql_result($result1,0,"category_name");
?>

<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->

<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Courses > Course details');">

<table width="784" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php" target="_self" title="Go back">Back</a></td></tr>
 </table>




 <table width="784" cellspacing="0" class='tblBorder'>
   
	
	<tr>
      <td><table width="100%" border="0" cellpadding="5" cellspacing="5">
        
		<tr><td class="content" colspan='2'>The course content is updated!</td></tr>
        <tr> 
          <td valign='top' width="13%" class="ContentBold">Course ID:</td>
          <td valign='top' class="content"><? echo TrimString($coursecode) ?></td>

        </tr>
		<tr> 
          <td valign='top' width="13%" class="ContentBold">Course title:</td>
          <td valign='top' class="content"><? echo TrimStringLarge(ucfirst($filetitle)) ?></td>

        </tr>
<!--
		 <tr> 
          <td valign='top' width="13%" class="ContentBold">Version:</td>
          <td valign='top' class="content"><? echo $versioninfo.".0" ?></td>

        </tr>
		-->
        <tr> 
          <td valign='top' class="ContentBold">Description:</td>
          <td valign='top' class="content">
		  <? 
		  if($filedescription!='')
		  {
		  echo ucfirst($filedescription);
		  }
		  else
		  {
		  echo "Description not available.";
		  }
		  
		  ?></td>

        </tr>
		 <tr> 
          <td valign='top' class="ContentBold">Keywords:</td>
          <td valign='top' class="content">
		  <? 
		  if($filekeys!='')
		  {
		  echo ucfirst($filekeys);
		  }
		  else
		  {
		  echo "None";
		  }
		  
		  ?></td>

        </tr>
        <!--
		<tr> 
          <td valign='top' class="ContentBold">File Name:</td>
          <td valign='top' class="content"><? echo ucfirst($filename) ?></td>
       
        </tr>
		-->
		<!--
		 <tr> 
          <td valign='top' class="ContentBold">Launch File:</td>
          <td valign='top' class="content"><? echo $fileLaunch ?></td>
       
        </tr>
		-->
        <tr> 
          <td valign='top' class="ContentBold">Stage size:</td>
          <td valign='top' class="content"><? echo $win_width." X ".$win_height ?></td>
      
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
          <td class="ContentBold" colspan='2'><div align="center"><a onFocus='this.blur()' onMouseOver='return showStatus();' href='waiting_documents.php' title="View all courses">View all courses</a>&nbsp;&nbsp;&nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href='publish_document.php?docid=<?=$docid?>' title="Assign to categories">Assign to categories</a>
		  
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