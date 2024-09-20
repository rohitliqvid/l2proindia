function showStatus() {

	window.status="Qualcomm - Learner" ;
    return true ;
}


function call_logout()
{
	if(confirm("Are you sure that you want to exit from LMS?"))
	{
		top.location="../../pages/helpers/logout.php";
	}
}


function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else 
countfield.value = maxlimit - field.value.length;
}

function setPageTitle(title)
{
//parent.HeaderPanel.cTitle.innerHTML=title;
//parent.HeaderPanel.cIcon.src='../../graphics/home_on.gif';
}

function setPageIcon(img,helpnum)
{
//parent.HeaderPanel.cIcon.src='../../graphics/'+img;
//parent.HeaderPanel.cHelp.innerHTML="<img src='../../graphics/help.gif' style='cursor:hand' onclick='openHelp(\""+helpnum+"\")' title='View help' border='0'>";
}


function openHelp(num)
{
var winWd,winHt,winSc;

if(num=="1")
{
winWd=740;
winSc='yes';
}
else
{
winWd=720;
winSc='no';
}

winHt=500;
var winLeft = (screen.width - winWd) / 2;
var winTop = (screen.height - winHt) / 2;
var settings='left='+winLeft+',top='+winTop+',width='+winWd+',height='+winHt+',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars='+winSc+',location=no,directories=no';
var fpath=parent.HeaderPanel.helpWin[num];

var fileWin=window.open(fpath,'fhelp',settings);
fileWin.focus();
}

window.status="Qualcomm - Learner" ;