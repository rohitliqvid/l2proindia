<?php
session_start();
include ('../intface/windowHeader.php');
include("../../connect.php"); //Connection to database 
include("../global/functions.php"); 
include("../global/nocacheofpage.php"); 

$user_id=getUserId($_SESSION['login_user']);
$feedbabck_id=$_REQUEST['fid'];

	
$query3 = "SELECT id,f_subject,f_category,f_description,f_by,f_by_id,f_date,f_status FROM tbl_feedback where f_by_id=".$user_id." and id=".$feedbabck_id." ORDER BY f_date DESC";
$result1 = mysqli_query($con,$query3);
$totalnum1=mysqli_num_rows($result1);

if(empty($totalnum1))
{
 ?>
 <section class="scrollable padder">
	<table class="table m-b-none dataTable text-left" width='100px'>
	<tr height='10px'><td valign=top colspan='2' width='100%'>Invalid record!</td></tr>
	</table>
<?
}

?>  
<title>My Feedbacks</title>
	<section class="scrollable padder">
	<table class="table m-b-none dataTable text-left" width='100px'>
	
<?
	$j=0;
	while ($j < $totalnum1) {

	$row = mysqli_fetch_assoc($result1);
	$id = $row['id'];
	$F_ROW_ID=$row['id'];
	$F_SUBJECT=$row['f_subject'];
	$F_CATEGORY=$row['f_category'];
	$categoryName=getCategoryName($F_CATEGORY);
	$F_DESCRIPTION=$row['f_description'];
	///$F_BY=$row['f_by'];
	
	$F_BY_ID=$row['f_by_id'];
	$F_BY=getFullNameFromID($F_BY_ID);
	$F_DATE=$row['f_date'];
	$F_STATUS=$row['f_status'];
	$email_by=getEmailFromID($F_BY_ID);
	?>
	<tr bgcolor="#E5E5E5"><td valign=top width='90%' class='contentBold'><b>Subject:</b> <?=ucfirst($F_SUBJECT)?></td><td class='content' valign=top width='10%' align='right'>&nbsp;</td></tr>
	<tr bgcolor="#F1F1F3"><td valign=top colspan='2' width='100%' class='content'><b>From:</b> <?=$F_BY?>, <?=parseDate($F_DATE)?></td></tr>
	<tr bgcolor="#F1F1F3"><td valign=top colspan='2' width='100%' class='content' ><b>Category:</b> <?php echo ucfirst($categoryName);?></td></tr>
	<tr><td valign=top colspan='2' width='100%' class='content'><?=ucfirst($F_DESCRIPTION)?></td></tr>
	<tr><td valign=top colspan='2' width='100%' class='content'>&nbsp;</td></tr>
	<?
	$j++;
	}
	?>
	</table>
	<!--/////////////////////////////////History/////////////////////////////////-->
<?php

$query4 = "SELECT id,feedback_id,res_description,res_to_id,res_by_id,res_date FROM feedback_history where feedback_id=".$feedbabck_id." ORDER BY res_date ASC";
$result4 = mysqli_query($con,$query4);
$totalnum4=mysqli_num_rows($result4);

if(empty($totalnum4))
{
 ?>
 <section class="scrollable padder">
	<table class="table m-b-none dataTable text-left" width='100px'>
	<tr height='10px'><td valign=top colspan='2' width='100%'>No Responses!</td></tr>
	</table>
<?
}

?>  

	<section class="scrollable padder">
	<table class="table m-b-none dataTable text-left" width='100px'>
	
<?
	$k=0;
	while ($k < $totalnum4) {

	$row = mysqli_fetch_assoc($result4);
	$res_id = $row['id'];
	$RES_ID=$row['feedback_id'];
	$RES_DESCRIPTION=$row['res_description'];
	$RES_TO=$row['res_to_id'];
	$RES_BY=$row['res_by_id'];
	$RES_DATE=$row['res_date'];


	
	$RES_BY_NAME=getFullNameFromID($RES_BY);
	?>
	
	<tr bgcolor="#F1F1F3"><td valign=top colspan='2' width='100%' class='content'><b>From:</b> <?=$RES_BY_NAME?>, <?=parseDate($RES_DATE)?></td></tr>
	
	<tr><td valign=top colspan='2' width='100%' class='content'><?=ucfirst($RES_DESCRIPTION)?></td></tr>
	<tr><td valign=top colspan='2' width='100%' class='content'>&nbsp;</td></tr>
	<?
	$k++;
	}
	?>
	</table>
	</section>
<!--/////////////////////////////////Response/////////////////////////////////-->
	<form name='frmResponse' id='frmResponse' method='POST' action='respnoseSubmit.php' onsubmit="return validateResponse();">
	<section class="scrollable padder">
	<table class="table m-b-none dataTable text-left" width='100px'>
	<tr><td valign=top colspan='2' width='100%' class='content'><strong>Your response:</strong></td></tr>
	<tr><td valign=top colspan='2' width='100%' class='content'><script src="../global/jquery-1.7.2.min.js"></script>
<textarea id="field" name="field" onkeyup="countChar(this)" style='width:100%;height:100px;'></textarea><br>Characters Remaining: <div style='align:right;width:400px;' id="charNum">500</div></textarea>
<input type='hidden' id='feed_id' name='feed_id' value='<?php echo $feedbabck_id;?>'>
<input type='hidden' id='feed_from' name='feed_from' value='<?php echo $F_BY_ID;?>'>
</td></tr>
<tr><td valign=top colspan='2' width='100%' class='content' align='center'><input class='btn btn-red' type='button' onclick="javascript:window.close();" name='btnCancel' value='Close'>&nbsp;&nbsp;<input class='btn btn-red' type='submit' name='btnSubmit' value='Submit'></td></tr>
	</table>
	</section>
	</form>
	

<script>
function validateResponse()
{
	
	var obj1 = document.getElementById('field');
;
         if(trimTextarea(obj1.value) == '') 
         {      
              alert("Please enter the response!");
              obj1.focus();
              return false;       
         }


}

function trimTextarea(str) 
{ 
    return str.replace(/^\s+|\s+$/g,''); 
}

function countChar(val) {
  var len = val.value.length;
  if (len >= 500) {
    val.value = val.value.substring(0, 500);
  } else {
    $('#charNum').text(500 - len);
  }
};
</script>