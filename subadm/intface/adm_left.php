<?php
session_start();
if (!isset($_SESSION['sess_fname'])) 
{
//if the session does not exit, then take the user to login page
header("Location: ../");
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


<!DOCTYPE html>
<html  class="bgblue" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" style="background-color: #ffffff;">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>English Edge - Admin</title>
<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../styles/animate.css" />
<link rel="stylesheet" type="text/css" href="../styles/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="../styles/font.css" />
<link rel="stylesheet" type="text/css" href="../styles/app.css" />
<link href="../styles/styles.css" rel="stylesheet" type="text/css">
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
<!-- Le fav and touch icons -->

<script src="../js/jquery.min.js"></script>
<script src="../js/parsley/parsley.min.js"></script>
<SCRIPT language="JavaScript" src="../global/global.js"></SCRIPT>

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
imgArray[0]='../graphics/Home_Btn.png';
imgArray[1]='../graphics/MyDetails_Btn.png';
imgArray[2]='../graphics/Users_Btn.png';
imgArray[3]='../graphics/Users_Btn.png';
////imgArray[4]='../graphics/Companies_Btn.png';
////imgArray[5]='../graphics/CourseCategories_Btn.png';
imgArray[4]='../graphics/Courses_Btn.png';
imgArray[5]='../graphics/ReportBug_Feed_Btn.jpg';
imgArray[6]='../graphics/Feedback_Normal.png';
imgArray[7]='../graphics/Logout_Btn.png';




var imgArrayRoll=new Array();
imgArrayRoll[0]='../graphics/Home_Roll_Btn.png';
imgArrayRoll[1]='../graphics/MyDetails_Roll_Btn.png';
imgArrayRoll[2]='../graphics/Users_Roll_Btn.png';
imgArrayRoll[3]='../graphics/Users_Roll_Btn.png';
////imgArrayRoll[4]='../graphics/Companies_Roll_Btn.png';
////imgArrayRoll[5]='../graphics/CourseCategories_Roll_Btn.png';
imgArrayRoll[4]='../graphics/Courses_Roll_Btn.png';
imgArrayRoll[5]='../graphics/ReportBug_Feed_Roll_Btn.jpg';
imgArrayRoll[6]='../graphics/Feedback_RollOver.png';
imgArrayRoll[7]='../graphics/Logout_Roll_Btn.png';

var currentObj='';
var currentTD='';
var totalItems=8;

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


 <!-- .aside -->
    <aside class="bg-dark lter aside-md hidden-print fixed navTop" id="nav">
      <section class="vbox">
        <section class="w-f scrollable">
          <div class="slimScrollDiv">
            <div class="slim-scroll left-block" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
              <!-- nav -->
              <nav class="nav-primary hidden-xs">
               <!-- <div class="client_box media left-block-heading clearfix" style="padding-top:2px;">
                  <p><span class="adminName"><? echo $_SESSION['sess_fname'];?><?php /*?><?php echo TrimString(ucfirst(strtolower(userdetails($login_user)->first_name)),20); ?><?php */?></span></p>
                 
                </div>--> <!--<p><span class="panelName">Admin Panel</span></p> </nav>-->
                <ul class="nav" id="yw0">
                  <li id="home" class="nav"><a href="" onClick="menuClick(this,'adm_cont.php');setPageTitle('Home');setPageIcon('Home_Btn.png','1');"><i class="fa fa-home icon"><b class="bg-danger"></b></i><span>Home</span></a></li>
				  <li id="mydetails" class="nav"><a href="#" onClick="menuClick(this,'../mydtls/mydtls.php');setPageIcon('MyDetails_Btn.png','2');"><i class="fa fa-edit icon"><b class="bg-danger"></b></i><span>My details</span></a></li>
				    <!--<li id="clients" class="nav"><a href="#" onClick="menuClick(this,'../client/client.php');setPageIcon('Users_Btn.png','3');"><i class="fa fa-edit icon"><b class="bg-danger"></b></i><span>Clients</span></a></li> -->
					 <li id="users" class="nav"><a href="#" onClick="menuClick(this,'../userlist/userlist.php');setPageIcon('Users_Btn.png','4');"><i class="fa fa-edit icon"><b class="bg-danger"></b></i><span>Users</span></a></li> 
					  <li id="courses" class="nav"><a href="#" onClick="menuClick(this,'../catlist/waiting_documents.php');setPageIcon('Courses_Btn.png','5');"><i class="fa fa-edit icon"><b class="bg-danger"></b></i><span>Courses</span></a></li>
					   <li id="reports" class="nav"><a href="#" onClick="menuClick(this,'../reports/index.php');setPageIcon('ReportBug_Feed_Btn.jpg','6');"><i class="fa fa-edit icon"><b class="bg-danger"></b></i><span>Reports</span></a></li>
					    <li id="feedback" class="nav"><a href="#"  onClick="menuClick(this,'../feedback/feedback.php');setPageIcon('Feedback_RollOver.png','7');"><i class="fa fa-edit icon"><b class="bg-danger"></b></i><span>Feedback</span></a></li>
						
                  <li class="nav"><a href="#" onClick="call_logout()"><i class="fa fa-times-circle icon"><b class="bg-danger"></b></i><span>Logout</span></a></li>
                </ul>
             
            </div>
            <div class="slimScrollBar"></div>
            <div lass="slimScrollRail"></div>
          </div>
        </section>
      </section>
    </aside>

<!--<body leftmargin='0' topmargin='0' class='leftpanel' onLoad="menuStart();MM_preloadImages('../graphics/Home_Roll_Btn.png','../graphics/MyDetails_Roll_Btn.png','../graphics/Users_Roll_Btn.png','../graphics/Companies_Roll_Btn.png','../graphics/CourseCategories_Roll_Btn.png','../graphics/Courses_Roll_Btn.png','../graphics/Feedback_RollOver.png','../graphics/Logout_Roll_Btn.png');">

<table width="200" border="0" cellpadding="4" cellspacing="0" class="leftpanel">


<tr id='mrow1'  name='mrow1' class="off" title="Home" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onClick="menuClick(this,'adm_cont.php');setPageTitle('Home');setPageIcon('Home_Btn.png','1');">
<td width='34' class='menuTextIcon'><img src='../graphics/Home_Btn.png' border='0' id='mIcon1' name='mIcon1'></td>
<td id='td1' name='td1' class="menuTextOff" onMouseOver="setOverSate(this)" onClick="setState(this)" onMouseOut="setOutSate(this)">Home</td></tr>



<tr id='mrow2'  name='mrow2' class="off" title="My details" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onClick="menuClick(this,'../mydtls/mydtls.php');setPageIcon('MyDetails_Btn.png','2');">
<td width='34' class='menuTextIcon'><img src='../graphics/MyDetails_Btn.png' border='0' id='mIcon2' name='mIcon2'></td><td id='td2' name='td2' class="menuTextOff" onMouseOver="setOverSate(this)" onClick="setState(this)" onMouseOut="setOutSate(this)">My details</td></tr>


<tr id='mrow3'  name='mrow3' class="off" title="Users" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onClick="menuClick(this,'../client/client.php');setPageIcon('Users_Btn.png','3');">
<td width='34' class='menuTextIcon'><img src='../graphics/Users_Btn.png' border='0' id='mIcon3' name='mIcon3'></td><td id='td3' name='td3' class="menuTextOff" onMouseOver="setOverSate(this)" onClick="setState(this)" onMouseOut="setOutSate(this)">Clients</td></tr>


<tr id='mrow4'  name='mrow4' class="off" title="Users" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onClick="menuClick(this,'../userlist/userlist.php');setPageIcon('Users_Btn.png','4');">
<td width='34' class='menuTextIcon'><img src='../graphics/Users_Btn.png' border='0' id='mIcon4' name='mIcon4'></td><td id='td4' name='td4' class="menuTextOff" onMouseOver="setOverSate(this)" onClick="setState(this)" onMouseOut="setOutSate(this)">Users</td></tr>-->

<!--
<tr id='mrow5'  name='mrow5' class="off" title="Countries" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onclick="menuClick(this,'../catlist/catlist.php');setPageIcon('Companies_Btn.png','5');">
<td width='34' class='menuTextIcon'><img src='../graphics/Companies_Btn.png' border='0' id='mIcon5' name='mIcon5'></td><td id='td5' name='td5' class="menuTextOff" onmouseover="setOverSate(this)" onclick="setState(this)" onmouseout="setOutSate(this)">Course groups</td></tr>


<tr id='mrow6'  name='mrow6' class="off" title="Course categories" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onclick="menuClick(this,'../catlist/categories.php');setPageIcon('CourseCategories_Btn.png','6');">
<td width='34' class='menuTextIcon'><img src='../graphics/CourseCategories_Btn.png' border='0' id='mIcon6' name='mIcon6'></td><td id='td6' name='td6' class="menuTextOff" onmouseover="setOverSate(this)" onclick="setState(this)" onmouseout="setOutSate(this)">Course categories</td></tr>
-->

<!--<tr id='mrow5'  name='mrow5' class="off" title="Courses" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onClick="menuClick(this,'../catlist/waiting_documents.php');setPageIcon('Courses_Btn.png','5');">
<td width='34' class='menuTextIcon'><img src='../graphics/Courses_Btn.png' border='0' id='mIcon5' name='mIcon5'></td><td id='td5' name='td5' class="menuTextOff" onMouseOver="setOverSate(this)" onClick="setState(this)" onMouseOut="setOutSate(this)">Courses</td></tr>


<tr id='mrow6' name='mrow6' class="off" title="Reports" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onClick="menuClick(this,'../reports/index.php');setPageIcon('ReportBug_Feed_Btn.jpg','6');">
<td width='34' class='menuTextIcon'><img src='../graphics/ReportBug_Feed_Roll_Btn.jpg' border='0' id='mIcon6' name='mIcon6'></td><td id='td6' name='td6' class="menuTextOff" onMouseOver="setOverSate(this)" onClick="setState(this)" onMouseOut="setOutSate(this)">Reports</td></tr>

<tr id='mrow7'  name='mrow7' class="off" title="Feedback" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onClick="menuClick(this,'../feedback/feedback.php');setPageIcon('Feedback_RollOver.png','7');">
<td width='34' class='menuTextIcon'><img src='../graphics/Feedback_RollOver.png' border='0' id='mIcon7' name='mIcon7'></td><td id='td7' name='td7' class="menuTextOff" onMouseOver="setOverSate(this)" onClick="setState(this)" onMouseOut="setOutSate(this)">Feedback</td></tr>


<tr id='mrow8'  name='mrow8' class="off" title="Logout" onMouseOver="menuOver(this)" onMouseOut="menuOut(this);" onClick="menuClick(this,'');call_logout()">
<td width='34' class='menuTextIcon'><img src='../graphics/Logout_Btn.png' border='0' id='mIcon8' name='mIcon8'></td><td id='td8' name='td8' class="menuTextOff" onMouseOver="setOverSate(this)" onClick="setState(this)" onMouseOut="setOutSate(this)">Logout</td></tr>


<tr height='340px'><td colspan='2' class='MenuBold1'>&nbsp;</td></tr>
</table>-->

</body>

</html>

