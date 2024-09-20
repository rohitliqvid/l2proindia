<title>New Business e-learning Portal</title>
<link href="styles/styles.css" rel="stylesheet" type="text/css">
<?
include("connect.php"); 
include("global/functions.php"); 

$userid=trim($_POST['email']);
$dob=trim($_POST['dob']);
$arrDOB=explode("/",$dob);
$newDOB=$arrDOB[2]."-".$arrDOB[0]."-".$arrDOB[1];


//Get the record from the database with this userid and password.
$query1="select * from tbl_users where username='$userid' and dob='$newDOB'"; 
$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1); 
$thisrow=mysql_fetch_row($result1);

//if the results of the query are not null
if ($thisrow)  
{
$uid=mysql_result($result1,0,"id");
$squestion=mysql_result($result1,0,"squestion");
$sanswer=mysql_result($result1,0,"sanswer");
$questionStr=getSecurityQuestion($squestion);
if($squestion=="")
{
	?>
	<script>
    document.location.href="noq.php";
	</script>
	<?
	exit;
}
?>
<html>
<head>
<title>New Business e-learning Portal - Forgot Password?</title>
<link href="styles/styles.css" rel="stylesheet" type="text/css">
<script>
function ValidateAnswer()
{
if (document.pwdInfo.answer.value=="")
{
alert("Please fill in the Answer!");
document.pwdInfo.answer.value="";
document.pwdInfo.answer.focus();
return false;
}
else
{
return true;
}
}

function pageFocus()
{
document.pwdInfo.answer.focus();
}
</script>

</head>
<body topmargin="0" onLoad="pageFocus();" class='' scroll='no'>

<table width="100%" cellspacing="0">
<tr><td align='center'>
<img src='graphics/banner.jpg' border='0'>
</td></tr>
</table>
<form name="pwdInfo" onSubmit="return ValidateAnswer();" action="gpwd.php" method="post">

  <table width="100%" height="70%" cellspacing="0">
    <tr>
      <td align='center' valign='middle'><table width="453px" height='236px' border="0" cellpadding="5" cellspacing="6" class='pwdbox'>
          <tr> 
            <td colspan="3" class="ContentBold" align='center' style='padding-top:15px;'><font size="2"><u>Forgot Password?</u></font></td>
          </tr>
          <tr> 
            <td colspan="3" class="Content" align='center'>Please enter your answer.</td>
          </tr>
           <tr> 
            <td colspan="3" class="content" align='left' style='padding-left:20px'><b>Security Question:</b> &nbsp;&nbsp;<?=$questionStr?></td>
            
          </tr>
		  <tr> 
            <td colspan="3" class="ContentBold" align='left' style='padding-left:20px'>Your Answer: <span class="mandatory">*</span>&nbsp;&nbsp;&nbsp;&nbsp;<input name="answer" type="text" id="answer" class='inputcls' size="40" maxlength="20" value=""><input type='hidden' value="<?=$uid?>" id='userid' name='userid'></td>
            
          </tr>
		   
         
     
          <tr class="ContentBold"> 
            <td height="60" colspan="3"><div align="center"> 
				<input type='submit' class='submit_button_normal'  id='submituser' title='Submit details' value='Submit'
onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">
              </div></td>
          </tr>
		  
        </table>
		</td>
    </tr>
  </table>

</form>

</body>
</html>
<?
$pwd=randomkeys($length);
mysql_query("UPDATE tbl_users SET password='$pwd' WHERE id='$uid'");

header("Location:pwdmesasge.php");
}
else
{
?>
<script>
alert("Either User ID or Date of Birth is incorrect! Please try again.");
document.location.href="forgotpwd.php";
</script>
<?
exit;
}
?>