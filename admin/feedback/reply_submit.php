<title>L2Pro India - Reply</title>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<?
//Connection to database 
include("../global/functions.php"); 
include("../connect.php"); //Connection to database 

function mysql_escape_mimic($inp) {

    if(is_array($inp))
    return array_map(__METHOD__, $inp);
    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);

    }
    return $inp;
}



function filter_text1($param)
{
$param=trim($param);

//$find= array("<br>","&nbsp;");
$find= array('"');
$rep= array("'");
$value=str_replace($find, $rep, $param);
return $value;
}

//Retrieve the values of userid and password which the user entered on the login page
$email=trim($_REQUEST['to_id']);
$subject=trim(strip_htmscript(mysql_escape_mimic($_REQUEST['subject'], 'other')));
$message=trim(strip_htmscript(mysql_escape_mimic($_REQUEST['desc'], 'other')));


//echo str_replace('"',"'",$message)."\n";
//echo htmlentities($message,ENT_QUOTES);
$message = preg_replace( "/^\n*/m", "<br>", $message );
$message=filter_text1($message);
/*echo $email;
echo "<br>";
echo $subject;
echo "<br>---";
echo $message;
echo "<br>---";*/

///////////////////////Code for mail///////////////////////////////

$message="<font face='Trebuchet MS' size='3' color='#000000'>Hello!<br><br>".$message."<br><br>Regards<br><b>L2Pro India</b></font>";
////////Commented for now////////////////////
////sendMail($email,$subject,$message);
//////////////////////////////////////////////////////////////
?>
<body class='contentBG' scroll='no'>
 <table width="100%" height='100' cellspacing="0" cellpadding='0' class='tblBorder'>
<tr><td>
 <table width="100%" border="0" cellspacing="0" cellpadding='3'>
		   <tr> 
            <td align='center' class="Content">Your reply is sent at <?=$email?> . Click the Close link to close this window.</td>
          </tr>
		<tr><td colspan="3">&nbsp;</td></tr>
		  <tr> 
            <td colspan="3" align='center' class="ContentBold"><a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:self.close();" target="_self" title="Close this window">Close</a></td>
          </tr>
		 
		 </table>
	</td></tr></table>
	</body>
