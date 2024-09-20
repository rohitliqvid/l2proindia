<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../../");
exit();
}

$perms=$_SESSION['perms'];

include("../../connect.php"); //Connection to database 
include("../../global/functions.php"); 


$docid=$_REQUEST['cid'];
$curPage=$_REQUEST['curPage'];

$cCategory=trim($_REQUEST['cCategory']);
$cContent=trim($_REQUEST['cContent']);
$cCode=trim($_REQUEST['cCode']);
$cTitle=trim($_REQUEST['cTitle']);
$cDesc=trim($_REQUEST['cDesc']);
$cKey=trim($_REQUEST['cKey']);

$result = mysql_query ("SELECT * FROM tls_scorm where id=$docid"); 
$num=mysql_numrows($result);


$filetitle=mysql_result($result,0,"name");
$filedescription=mysql_result($result,$i,"summary");
$version=mysql_result($result,0,"version");




//$result1 = mysql_query ("SELECT category_name FROM tbl_company where id='$catid'"); 
//$category_name=mysql_result($result1,0,"category_name");
?>

<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->

<link href="../../styles/styles.css" rel="stylesheet" type="text/css">
<body topmargin="10" leftmargin="10" class='contentBG' onload="setPageTitle('Courses > Course details');">


    <table width="100%" cellspacing="0" cellpadding="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="courses.php?currpage=<?=$curPage?>&cCategory=<?=$cCategory?>&cContent=<?=$cContent?>&cCode=<?=$cCode?>&cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>" target="_self" title="Go back">Back</a></td></tr>
 </table>

 


 <table width="800" cellspacing="0" class=''>
   
	
	<tr>
      <td><table width="100%" border="0" cellpadding="5" cellspacing="5">
        
      
		<tr> 
          <td valign='top' width="13%" class="ContentBold">Course title:</td>
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
          <td valign='top' class="ContentBold">Package Type:</td>
          <td valign='top' class="content"><? echo ucfirst($version) ?></td>

        </tr>
        <!--
		<tr> 
          <td valign='top' class="ContentBold">Added by:</td>
          <td valign='top' class="content"><? echo ucfirst($uploadedby) ?></td>
      
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