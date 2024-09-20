<?
session_start();
if (!isset($_SESSION['sess_fname'])) 
{
//if the session does not exit, then take the user to login page
header("Location: ../../");
exit();
}
?>
<?
function EndSession()
{
//session_destroy();
}

$perms=$_SESSION['perms'];
include("../../global/functions.php");
?>


<html> 
<SCRIPT language="JavaScript" src="../../global/global.js"></SCRIPT>
<link href="../../styles/styles.css" rel="stylesheet" type="text/css">

<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>


<script>

var imgArray=new Array();
imgArray[0]='../../graphics/Home_Btn.png';
imgArray[1]='../../graphics/MyDetails_Btn.png';
imgArray[2]='../../graphics/Courses_Btn.png';
imgArray[3]='../../graphics/Feedback_Normal.png';
imgArray[4]='../../graphics/Logout_Btn.png';

var imgArrayRoll=new Array();
imgArrayRoll[0]='../../graphics/Home_Roll_Btn.png';
imgArrayRoll[1]='../../graphics/MyDetails_Roll_Btn.png';
imgArrayRoll[2]='../../graphics/Courses_Roll_Btn.png';
imgArrayRoll[3]='../../graphics/Feedback_RollOver.png';
imgArrayRoll[4]='../../graphics/Logout_Roll_Btn.png';

var currentObj='';
var currentTD='';
var totalItems=5;

function menuClick(obj,link)
{
var templast='mrow'+totalItems;
if(obj.id!=templast)
	{
for(i=1;i<=totalItems;i++)
{
	var tempRow=eval("document.getElementById('mrow"+i+"')");
	tempRow.className='menuOff';

	var tempRow=eval("document.getElementById('mIcon"+i+"')");
	tempRow.src=imgArray[i-1];
}

	obj.className='menuClicked'
	currentObj=obj.id

	var tempNo=obj.id.substring(4,obj.id.length);
	var tempImgId=eval('mIcon'+tempNo);
	tempImgId.src=imgArrayRoll[tempNo-1];
	}

	if(link!='')
	{
	parent.ContentPanel.location=link;
	}
}

function menuOver(obj)
{
	obj.style.cursor='hand';
	//alert("obj.id"+obj.id+"currentObj"+currentObj);
	if(obj.id!=currentObj)
	{
	obj.className='menuOn';
	var tempNo=obj.id.substring(4,obj.id.length);
	var tempImgId=eval('mIcon'+tempNo);
	tempImgId.src=imgArrayRoll[tempNo-1];
	
	}
}

function menuOut(obj)
{
	if(obj.id!=currentObj)
	{
	obj.className='menuOff';
	var tempNo=obj.id.substring(4,obj.id.length);
	var tempImgId=eval('mIcon'+tempNo);
	tempImgId.src=imgArray[tempNo-1];
	}
}

function menuStart()
{

document.getElementById("mrow1").className='menuClicked';
currentObj='mrow1';
document.getElementById("mIcon1").src=imgArrayRoll[0];
}

function setState(obj)
{
//if(obj.id!=currentObj)
//	{
	for(i=1;i<=totalItems;i++)
{
	var tempTD=eval("document.getElementById('td"+i+"')");
	tempTD.className='menuTextOff';
}
obj.className='menuTextClicked';
//	}
currentTD=obj.id;
}

function setOverSate(obj)
{
	obj.className='menuTextOn';
}

function setOutSate(obj)
{
//alert("currentObj : "+currentTD);
	if(obj.id!=currentTD)
	{
obj.className='menuTextOff';
	}
}
</script>


<body leftmargin='0' topmargin='0' class='leftpanel' onload="menuStart();MM_preloadImages('../../graphics/Home_Roll_Btn.png','../../graphics/MyDetails_Roll_Btn.png','../../graphics/Courses_Roll_Btn.png','../../graphics/feedback_on.png','../../graphics/Logout_Roll_Btn.png');">



<table width="150" border="0" cellspacing="2" cellpadding="0">


<tr id='mrow1'  name='mrow1' class="off" title="Home" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onclick="menuClick(this,'std_cont.php');setPageTitle('Home');setPageIcon('Home_Btn.png','1');">
<td width='34' class='menuTextIcon'><img src="../../graphics/home_off.gif" name="Image2" width="156" height="37" border="0" id="Image2" /></td><td id='td1' name='td1' class="menuTextOff" onmouseover="setOverSate(this)" onclick="setState(this)" onmouseout="setOutSate(this)"></td>
</tr>

<tr id='mrow2'  name='mrow2' class="off" title="My details" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onclick="menuClick(this,'../mydtls/mydtls.php');setPageIcon('my_details_on.png','2');">
<td width='34' class='menuTextIcon'><img src="../../graphics/my_details_off.gif" name="Image3" width="156" height="37" border="0" id="Image3" /></td><td id='td2' name='td2' class="menuTextOff" onmouseover="setOverSate(this)" onclick="setState(this)" onmouseout="setOutSate(this)"></td>
</tr>

<tr id='mrow3'  name='mrow3' class="off" title="Courses" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onclick="menuClick(this,'../catlist/courses.php');setPageIcon('Courses_Btn.png','3');">
<td width='34' class='menuTextIcon'><img src="../../graphics/courses_off.gif" name="Image4" width="156" height="37" border="0" id="Image4" /></td><td id='td3' name='td3' class="menuTextOff" onmouseover="setOverSate(this)" onclick="setState(this)" onmouseout="setOutSate(this)"></td>
</tr>

<tr id='mrow4'  name='mrow4' class="off" title="Feedback" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onclick="menuClick(this,'../feedback/feedback.php');setPageIcon('Feedback_RollOver.png','4');">
<td width='34' class='menuTextIcon'><img src="../../graphics/feedback_off.gif" name="Image5" width="156" height="37" border="0" id="Image5" /></td><td id='td4' name='td4' class="menuTextOff" onmouseover="setOverSate(this)" onclick="setState(this)" onmouseout="setOutSate(this)"></td>
</tr>

<tr id='mrow5'  name='mrow5' class="off" title="Logout" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onclick="menuClick(this,'');call_logout()">
<td width='34' class='menuTextIcon'><img src="../../graphics/logout_off.gif" name="Image6" width="156" height="37" border="0" id="Image6" /><td id='td5' name='td5' class="menuTextOff" onmouseover="setOverSate(this)" onclick="setState(this)" onmouseout="setOutSate(this)"></td>
</tr>

<tr height='490px'><td colspan='2' class='MenuBold1'>&nbsp;</td></tr>
</table>
</body>

</html>

