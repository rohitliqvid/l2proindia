<?php
session_start();
include("../../connect.php"); //Connection to database 
include("../global/functions.php"); 
include("../global/nocacheofpage.php"); 

if($_REQUEST['action'] == "get_feedback_list")
{
	
	
	$tempId=$_REQUEST['id'];
	$user_id=getUserId($_SESSION['login_user']);
	
	$query3 = "SELECT id,f_subject,f_category,f_description,f_by,f_by_id,f_date,f_status FROM tbl_feedback where f_by_id=".$user_id." ORDER BY f_date DESC";
	$result1 = mysqli_query($con,$query3);
	$totalnum1=mysqli_num_rows($result1);

	if(!$totalnum1)
	{
	echo "<br>&nbsp;&nbsp;No Feedbacks recieved!";
	exit();
	}

?>  
	<section class="scrollable padder">
			
    <table class="table m-b-none dataTable text-left">	

	<tr height='10px'><td valign=top colspan='2' width='100%'></td><tr>

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
	//$F_BY=$row['f_by'];
	$F_BY_ID=$row['f_by_id'];
	$F_BY=getFullNameFromID($F_BY_ID);
	$F_DATE=$row['f_date'];
	$F_STATUS=$row['f_status'];
	$email_by=getEmailFromID($F_BY_ID);

	
	?>

<tr bgcolor="#E5E5E5"><td valign=top width='90%' class='contentBold'><b>Subject:</b> <?=ucfirst($F_SUBJECT)?></td><td class='content' valign=top width='10%' align='right'>&nbsp;&nbsp;&nbsp;<a onFocus='this.blur()' href="javascript:viewHistory(<?=$F_ROW_ID?>)" title="View">View</a>&nbsp;&nbsp;</td><tr>
<tr bgcolor="#F1F1F3"><td valign=top colspan='2' width='100%' class='content'><b>From:</b> <?=$F_BY?>, <?=parseDate($F_DATE)?></td><tr>
<tr bgcolor="#F1F1F3"><td valign=top colspan='2' width='100%' class='content' ><b>Category:</b> <?php echo ucfirst($categoryName);//$email_by;?> <!--&nbsp;&nbsp;&nbsp;<a onFocus='this.blur()' href="mailto:<?php echo $email_by;?>" title="Reply to this feedback"><i class="fa fa-reply"></i></a>--></td><tr>
 <!--<tr bgcolor="#F1F1F3"><td valign=top colspan='2' width='100%' class='content' style="text-transform: lowercase;"><?php echo $email_by;?> &nbsp;&nbsp;&nbsp;<a onFocus='this.blur()' href="javascript:sendReply(<?=$F_ROW_ID?>)" title="Reply this feedback"><i class="fa fa-reply"></i></a></td><tr>-->
<tr><td valign=top colspan='2' width='100%' class='content'><?=ucfirst($F_DESCRIPTION)?></td><tr>
<tr><td valign=top colspan='2' width='100%' class='content'>&nbsp;</td><tr>


<?php
	
$j++;

}
?>
</table>
<?php
	closeConnection($con);
}
?>