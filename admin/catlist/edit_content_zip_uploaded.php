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

$result = mysql_query ("SELECT * FROM tbl_courses where id=$docid"); 
$num=mysql_numrows($result);
$myId=mysql_result($result,0,"id");
$filetitle=mysql_result($result,0,"file_title");

//$result1 = mysql_query ("SELECT category_name FROM tbl_category where id='$catid'"); 
//$category_name=mysql_result($result1,0,"category_name");

$dir = "/webroot/edge-cms/courses/".$docid."/";
?>

<!--Code to prevent the caching of page--><HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<script>
function checkForm()
{

	var found=0;
	if(document.zipsubmit.choice.length!=null)
	{

	for (i=0; i<document.zipsubmit.choice.length; i++) 
		{ 
			if (document.zipsubmit.choice[i].checked) 
			{ 
			found=1;
			break;
			}
		}

		if(found==0)
		{
		alert("Please select at least one launch file for the course!");
		return false;
		}
	}
else
{

	if (document.zipsubmit.choice.checked) 
	{ 
	found=1;
	//break;
	}
	if(found==0)
	{
	alert("Please select at least one launch file for the course!");
	return false;
	}
}

}
</script>
</HEAD>
<!-- -->


<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Courses > <?=TrimString(ucfirst($filetitle))?> > Edit content');">

    <table width="800" cellspacing="0" cellpadding="3">
 <tr height='10px'><td class='contentBold' align='right' valign='middle'></tr>
 </table>
	<div class="content">Please select the launch file(s) for this course!</div>
	<br>
<form name="zipsubmit" onsubmit="return checkForm();" action="edit_content_zip_submitted.php?docid=<?=$docid?>" method="post">
<div id='tree' name='tree' valign='top' style="position:absolute;left:10px;overflow:auto;width:800px;height:300px;border:1px solid #CCCCCC" >
 <table width="100%" cellspacing="2" cellspacing="4">
   
	<?
		$counter=0;
	if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            
		?>
		<tr> 
         <td valign='middle' class="content" >
		 <?
		/*  
		if(filetype($dir . $file)=='dir')
			{
			echo "<img align='absmiddle' src='../graphics/folder.gif'>&nbsp;&nbsp;<b>".$file."</b>";
			}
			else
			{
		*/
		if(filetype($dir . $file)=='file')
			{
			
			$fExt=explode(".", $file);
			$tempIndex=count($fExt)-1;
			$extType=strtolower($fExt[$tempIndex]);
			

			if(in_array($extType, $fileSupport)) 
			{
			$checkState='';
			}
			else
			{
			$checkState='disabled';
			}
			echo "&nbsp;&nbsp;<input type='checkbox' ".$checkState." id='choice' name='choice[]' value='$file'>&nbsp;&nbsp;".$file;
			$counter++;
			}
		/*}*/
		  ?>
		  
		  </td>
        </tr>
			<?
        }
        closedir($dh);
    }
}
	  if($counter==0)
			{
		  echo "<span class='content'>&nbsp;&nbsp;There are no launch files present in this package!</span>";
		  }
	?>
	

  </table>

</div>
<div id='tree' name='tree' valign='top' style="position:absolute;left:0px;top:400px;width:800px;height:10px;" > 
<table width="100%" cellpadding="2" cellspacing="2">
   <tr> 
         <td align='center'>&nbsp;&nbsp;<input type="submit" class='submit_button_normal' onMouseOver="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';" name="upload" title="Submit" value="Submit"></td>
	</tr>
  </table>
</div>
</form>
</body>

<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->