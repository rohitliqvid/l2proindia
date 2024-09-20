 
<? 
include ("../connect.php");
include('lock.php');

$static_url = $_SERVER['SERVER_NAME'] . '/online/student/catlist/b2client.php?token=';
$courses['name'] = array();

$date = date_create();
$todayDate = date_timestamp_get($date);


$curdate=date('Y-m-d');
$userip=$_SERVER['REMOTE_ADDR'];


$result4 = mysql_query("SELECT * FROM tbl_b2client where username = '$login_session'") or die("1Failed Query of " . mysql_error());
		$i=0;
		$flag = 0;
		while($row = mysql_fetch_array($result4)){
		
			if ($flag == 0){
			$username = $row['username'];
			mysql_query("INSERT INTO tbl_b2client_entry_log (username, user_ip, user_entry) VALUES ('$username', '$userip','$curdate')");
			$flag++;
			}
			
			$courses['token'][$i] = $row['token'];
				
			if($todayDate > strtotime($row['expiry_date'])){
			$courses['expiry'][$i] = 0;
			}else{
			$courses['expiry'][$i] = 1;
			}
			$cid = $row['course_id']; 
					
			$result5 = mysql_query("SELECT name FROM tls_scorm where course = '$cid'") or die("1Failed Query of " . mysql_error());
			$cResult = mysql_fetch_array($result5);
			$courses['name'][$i] = $cResult['name'];
			$i++;
			
		}
		
?>
<html>
<link rel="stylesheet" href="./assets/table.css" type="text/css" />
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tbody><tr>
    <td height="70" align="left" bgcolor="#FFFFFF" style="background-image: url(./assets/top2.jpg);background-repeat: repeat-x;"><img src="./assets/top.jpg" border="0"></td>
</tr>
<tr height="1px"><td colspan="3" bgcolor="#000000"></td></tr>
<tr height="1px" bgcolor="#FFFFFF"><td colspan="3"></td></tr>
<tr height="1px" bgcolor="#FFFFFF"><td colspan="3"></td></tr>
<tr height="20px"><td align="right" valign="top" class="tblWelcome WelcomeText" style="padding-right:10px;padding-left:3px" colspan="3">Welcome!&nbsp;&nbsp; |  &nbsp;&nbsp;<?echo date("F j, Y");?>&nbsp;&nbsp;  | <a href = "logout.php">Logout</a><!-- |  &nbsp;&nbsp;<a onFocus='this.blur()' href="javascript:openLoginHelp();" target="_self" title="Help" class='listitems'>HELP</a--> &nbsp;&nbsp;</td><td></td></tr>
<tr height="1px"><td bgcolor="#000000" colspan="3"></td></tr>

</tbody></table>
<br><br>
<?
if(sizeof($courses['name']) < 1){
echo "<h1 align = center>Invalid Link<h1>";
}else{
?>
<table class="bordered" align = "center">
    <thead>
	<tr>
        <th>Courses</th>
        <th>Link</th>
    </tr>
    </thead>
	<tbody>
	<?
for($i = 0 ; $i < sizeof($courses['name']) ; $i++){
echo "<tr><td>" . $courses['name'][$i] . "</td>";

if ($courses['expiry'][$i] == 1){
echo "<td><a href = javascript:launch_content('" .$courses['token'][$i] ."')>Click Here</a></td></tr>";
}else{
echo "<td>Course Expired</td></tr>";
}
}
}
?>
</tbody></table>
</body>

<script>

function launch_content(token) 
{

var width = 1024;
var height = 768;

var w = width;
var h = height;
var winl = (screen.width-w)/2;
var wint = (screen.height-h)/2;
if (winl < 0) winl = 0;
if (wint < 0) wint = 0;
windowprops = "height="+h+",width="+w+",top="+ wint +",left="+ winl +",location=no,"+ "scrollbars=no,menubars=no,toolbars=no,resizable=no,status=no,directories=no";
path="../student/catlist/b2client.php?token="+token;
	var con_window=window.open(path,"win",windowprops);	
	con_window.focus();
}

</script>



</html>

