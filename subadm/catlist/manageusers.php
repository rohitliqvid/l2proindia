<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
$catid=$_REQUEST['id'];
$perms=$_SESSION['perms'];

$cTitle=trim($_REQUEST['cTitle']);
$cDesc=trim($_REQUEST['cDesc']);
$cKey=trim($_REQUEST['cKey']);
$currpage=$_REQUEST['currpage'];
?>
<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>

<?
include("../connect.php"); //Connection to database 
include("../global/functions.php"); 

$result = mysql_query ("SELECT * FROM tbl_company where id='$catid'"); 
$num=mysql_numrows($result);
$catname=mysql_result($result,0,"company_name");


$result1 = mysql_query ("SELECT DISTINCT user_id FROM tbl_company_user"); 
$num1=mysql_numrows($result1);

$u_id=array();

$i=0;
while ($i < $num1) {
$row = mysql_fetch_assoc($result1);
$id = $row['id'];
$u_id[]=mysql_result($result1,$i,"user_id");
$i++;
}

$us_id=implode(',',$u_id);
//echo $us_id;
if($us_id=="")
{
$us_id=0;
}
$query2="SELECT * FROM tbl_users WHERE ID NOT IN (".$us_id.") and usertype!='1' ORDER BY firstname ASC";
$result2 = mysql_query ($query2);
$num2=mysql_numrows($result2);


$query3="SELECT * FROM tbl_users AS A, tbl_company_user AS B WHERE A.id=B.user_id and A.usertype!='1' and B.company_id='$catid' ORDER BY A.firstname ASC";
$result3 = mysql_query ($query3);
$num3=mysql_numrows($result3);

?>

<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

<script>


var NS4 = (navigator.appName == "Netscape" && parseInt(navigator.appVersion) < 5);

function addOption(theSel, theText, theValue)
{
  var newOpt = new Option(theText, theValue);
  var selLength = theSel.length;
  theSel.options[selLength] = newOpt;
}

function deleteOption(theSel, theIndex)
{ 
  var selLength = theSel.length;
  if(selLength>0)
  {
    theSel.options[theIndex] = null;
  }
}
var isMoved='0';
function moveOptions(theSelFrom, theSelTo)
{


  var selLength = theSelFrom.length;
  var selectedText = new Array();
  var selectedValues = new Array();
  var selectedCount = 0;
  
  var i;
  
  // Find the selected Options in reverse order
  // and delete them from the 'from' Select.
  for(i=selLength-1; i>=0; i--)
  {
    if(theSelFrom.options[i].selected)
    {
      selectedText[selectedCount] = theSelFrom.options[i].text;
      selectedValues[selectedCount] = theSelFrom.options[i].value;
      deleteOption(theSelFrom, i);
      selectedCount++;
    }
  }
  
  // Add the selected text/values in reverse order.
  // This will add the Options to the 'to' Select
  // in the same order as they were in the 'from' Select.
  for(i=selectedCount-1; i>=0; i--)
  {
    addOption(theSelTo, selectedText[i], selectedValues[i]);
	  isMoved='1';
  }
  
  if(NS4) history.go(0);
}


function getValues()
{


var length2=document.frm.sublist2.length;

var val2='';

for(i=0;i<length2;i++)
{
	val2 +=document.frm.sublist2.options[i].value+",";
}
document.frm.obj2.value=val2;
}

function checkMove()
{
	if(isMoved=='0')
	{
	return false;
	}
}
</script>
</HEAD>
<!-- -->

<body class='contentBG' topmargin="10" leftmargin="10" onload="setPageTitle('Companies > <?=TrimStringMedium(ucfirst($catname))?>');">

<form name="frm" method="post" onSubmit="return checkMove();" action="manageusers_submit.php" >
  
     <table width="100%" cellspacing="0" cellspacing="3">
 <tr height='23px'><td class='contentBold' align='right' valign='middle'><a onFocus='this.blur()' onMouseOver='return showStatus();' href="catlist.php?cTitle=<?=$cTitle?>&cDesc=<?=$cDesc?>&cKey=<?=$cKey?>&currpage=<? echo $currpage ?>" target="_self" title="Go back">Back</a></td></tr>
 </table>



 <table width="800" cellspacing="0" class=''>

	<tr><td>
	<table width="100%" border="0" cellspacing="0" cellpadding='3'>
	
	<tr><td class='content' colspan='3'>To move a user from one list to the other, click on the user name and then click the relevant arrow button. After you have moved all the users to their correct list, click Submit to save the changes.</td></tr>

	<tr><td align='center' colspan='3'>
	<?
	if(isset($_REQUEST['msg']))
	echo "<span class='mandatory'><font color='#F10033'>Users enrolled/unenrolled successfully!</font></span>";
	?>
	&nbsp;
	</td></tr>
	<tr><td align='center' class='contentBold'>CMS users</td><td align='center'>&nbsp;</td><td align='center' class='contentBold'>Users in company '<?=TrimStringSmall(ucfirst($catname))?>'</td></tr>
	<tr><td align='center'><SELECT name="sublist1" id="sublist1" class='inputcls' rows='2' multiple style="width:250px;height:250px;">
              <?
				if ($num2)
			{
							
			$j=0;
			while ($j < $num2) {

			$row = mysql_fetch_assoc($result2);
			$id = $row['id'];
			$uid=mysql_result($result2,$j,"id");
			$fname=mysql_result($result2,$j,"firstname");
			$lname=mysql_result($result2,$j,"lastname");
			?>
				<OPTION value="<?php echo $uid; ?>"><? echo ucfirst($fname)." ".ucfirst($lname); ?></OPTION>
			<?
			$j++;
			}	
			}
			?>             
			  
			 </SELECT></td><td width='10%' valign='middle' align='center'><input type="button" class='submit_button_normal' name="B1" value="&gt;&gt;" 
onClick="moveOptions(this.form.sublist1, this.form.sublist2);" onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">
    <br>
    <br>
    </span>    
      <input type="button" class='submit_button_normal' name="B2" value="&lt;&lt;" onClick="moveOptions(this.form.sublist2, this.form.sublist1);" onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';"></td><td align='center'><SELECT name="sublist2" id="sublist2" class='inputcls' rows='2' multiple style="width:250px;height:250px;">
              <?
				if ($num3)
			{
							
			$k=0;
			while ($k < $num3) {

			$row = mysql_fetch_assoc($result2);
			$id = $row['id'];
			$uid=mysql_result($result3,$k,"id");
			$fname=mysql_result($result3,$k,"firstname");
			$lname=mysql_result($result3,$k,"lastname");
			?>
				<OPTION value="<?php echo $uid; ?>"><? echo ucfirst($fname)." ".ucfirst($lname); ?></OPTION>
			<?
			$k++;
			}	
			}
			?>             
			  
			 </SELECT></td></tr>
			 <tr><td align='center' colspan='3'>&nbsp;</td></tr>
			 <tr><td align='center' colspan='3'><input type="submit" title='Save changes to users of this company' class='submit_button_normal' name="submit" value="Submit" onclick='getValues();'  onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';" >
			 <!--
			 &nbsp;&nbsp;<input type="button" class='submit_button_normal' name="cancel" value="Cancel" onclick='javascript:history.go(-1);' onmouseover="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';">
			 -->
			 <input type='hidden' name='obj2' id='obj2' value=''><input type='hidden' name='catid' id='catid' value='<?=$catid?>'></td></tr>
      </table>
</td></tr>
	  </table>
	</td>
   </tr>
  </table>
</form>
</body>




<!--Code to prevent the caching of page-->
<HEAD>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
<!-- -->