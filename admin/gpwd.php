<?
session_start();
include("connect.php"); 
include("global/functions.php"); 
$answer=trim($_POST['answer']);
$userid=trim($_POST['userid']);

if(!isset($_POST['userid']))
{
header("Location: index.php");
exit;
}


$length=8;
function randomkeys($length)
{
  $pattern = "23456789abcdefghijmnpqrstuvwxyz";
  for($i=0;$i<$length;$i++)
  {
   if(isset($key))
     $key .= $pattern{rand(0,strlen($pattern)-1)};
   else
     $key = $pattern{rand(0,strlen($pattern)-1)};
  }
  return $key;
}


$query1="select * from tbl_users where id=$userid"; 
$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1); 
$thisrow=mysql_fetch_row($result1);
if($thisrow)
{
	$sanswer=mysql_result($result1,0,"sanswer");
	if(strtolower($answer)==strtolower($sanswer))
	{
		$pwd=randomkeys($length);
		$newpwd=md5($pwd);
		mysql_query("UPDATE tbl_users SET password='$newpwd' WHERE id=$userid");
		$_SESSION['pd'] = $pwd;
		header("Location: pwdgen.php");
		exit;
	}
	else
	{
	?>
	<script>
	alert("The answer provided is not correct! Please try again.");
	document.location.href="forgotpwd.php";
	</script>
	<?
	}
}
else
{
?>
<script>
alert("The answer provided is not correct!");
document.location.href="index.php";
</script>
<?
exit;
}
?>