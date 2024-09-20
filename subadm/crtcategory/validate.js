//The validate.js file validates the input fields


function ValidateInfo()
{
	//alert(document.catInfo.catname.value);
	//return;
if (Trim(document.catInfo.catname.value)=="")
{
alert("Please fill in the Country name field!");
document.catInfo.catname.value='';
document.catInfo.catname.focus();
return false;
}
else if (Trim(document.catInfo.catlimit.value)=="")
{
alert("Please fill in the User limit field!");
document.catInfo.catlimit.value='';
document.catInfo.catlimit.focus();
return false;
}
else if (Trim(document.catInfo.catlimit.value)!="" && IsNumeric(Trim(document.catInfo.catlimit.value))==false)
{
alert("User limit field accepts numeric value only!");
document.catInfo.catlimit.value='';
document.catInfo.catlimit.focus();
return false;
}
else if (Trim(document.catInfo.explimit.value)=="")
{
alert("Please fill in the User expiry field!");
document.catInfo.explimit.value='';
document.catInfo.explimit.focus();
return false;
}
else if (Trim(document.catInfo.explimit.value)!="" && IsNumeric(Trim(document.catInfo.explimit.value))==false)
{
alert("User expiry field accepts numeric value only!");
document.catInfo.explimit.value='';
document.catInfo.explimit.focus();
return false;
}
else
{
return true;
}
}


function ValidateInfoEdit()
{
	//alert(document.catInfo.catname.value);
	//return;
if (Trim(document.catInfo.catname.value)=="")
{
alert("Please fill in the Country name field!");
document.catInfo.catname.value='';
document.catInfo.catname.focus();
return false;
}
else if (Trim(document.catInfo.catlimit.value)=="")
{
alert("Please fill in the User limit field!");
document.catInfo.catlimit.value='';
document.catInfo.catlimit.focus();
return false;
}
else if (Trim(document.catInfo.catlimit.value)!="" && IsNumeric(Trim(document.catInfo.catlimit.value))==false)
{
alert("User limit field accepts numeric value only!");
document.catInfo.catlimit.value='';
document.catInfo.catlimit.focus();
return false;
}
else if (Trim(document.catInfo.catlimit.value)!="" && ( parseInt(Trim(document.catInfo.catlimit.value)) < parseInt(Trim(document.catInfo.curLimit.value)) ))
{
alert("User limit can not be less than the current user limit!\nCurrent User Limit is: "+document.catInfo.curLimit.value);
//document.catInfo.catlimit.value='';
document.catInfo.catlimit.focus();
return false;
}
else if (Trim(document.catInfo.explimit.value)=="")
{
alert("Please fill in the User expiry field!");
document.catInfo.explimit.value='';
document.catInfo.explimit.focus();
return false;
}
else if (Trim(document.catInfo.explimit.value)!="" && IsNumeric(Trim(document.catInfo.explimit.value))==false)
{
alert("User expiry field accepts numeric value only!");
document.catInfo.explimit.value='';
document.catInfo.explimit.focus();
return false;
}
else
{
return true;
}
}

function IsNumeric(strString)
   //  check for valid numeric strings	
   {
   var strValidChars = "0123456789";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
   return blnResult;
   }

function ValidateCategoryInfo()
{
	//alert(document.catInfo.catname.value);
	//return;
if (Trim(document.categoryInfo.catname.value)=="")
{
alert("Please fill in the Category name field!");
document.categoryInfo.catname.value='';
document.categoryInfo.catname.focus();
return false;
}
else
{
return true;
}
}

var keyProtected = new keybEdit('abcdefghijklmnopqurstuvwxyz01234567890_','Alpha-numeric input only.');
var keybAlphaNumeric = new keybEdit('abcdefghijklmnopqurstuvwxyz. ','Charater input only.');

function keybEdit(strValid, strMsg) {
	//	Variables
	var reWork = new RegExp('[a-z]','gi');		//	Regular expression\

	//	Properties
	if(reWork.test(strValid))
		this.valid = strValid.toLowerCase() + strValid.toUpperCase();
	else
		this.valid = strValid;

	if((strMsg == null) || (typeof(strMsg) == 'undefined'))
		this.message = '';
	else
		this.message = strMsg;

	//	Methods
	this.getValid = keybEditGetValid;
	this.getMessage = keybEditGetMessage;
	
	function keybEditGetValid() {

		return this.valid.toString();
	}
	
	function keybEditGetMessage() {
		
		return this.message;
	}
}

void function editKeyBoard(objForm, objKeyb) {
	strWork = objKeyb.getValid();
	strMsg = '';							// Error message
	blnValidChar = false;					// Valid character flag

	// Part 1: Validate input
	if(!blnValidChar)
		for(i=0;i < strWork.length;i++)
			if(window.event.keyCode == strWork.charCodeAt(i)) {
				blnValidChar = true;

				break;
			}

	// Part 2: Build error message
	if(!blnValidChar) {
		if(objKeyb.getMessage().toString().length != 0)
			//alert('Error: ' + objKeyb.getMessage());

		window.event.returnValue = false;		// Clear invalid character
		objForm.focus();						// Set focus
	}
}


function Trim(s) 
{
  // Remove leading spaces and carriage returns
  
  while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
  {
    s = s.substring(1,s.length);
  }

  // Remove trailing spaces and carriage returns

  while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
  {
    s = s.substring(0,s.length-1);
  }
  return s;
}

