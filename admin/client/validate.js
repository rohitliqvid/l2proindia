//The validate.js file validates the input fields


function ValidateClientInfo()
{
	//alert(document.catInfo.catname.value);
	//return;
if (Trim(document.catInfo.cName.value)=="")
{
alert("Please fill in the Client name field!");
document.catInfo.cName.value='';
document.catInfo.cName.focus();
return false;
}
else if (Trim(document.catInfo.cEmail.value)=="")
{
alert("Please fill in the Email field!");
document.catInfo.cEmail.value='';
document.catInfo.cEmail.focus();
return false;
}
else if(Trim(document.catInfo.cEmail.value) !="" && echeck(document.catInfo.cEmail.value)==false)
{
alert("Email address is not valid!");
document.catInfo.cEmail.focus();
return false;
}
else if (Trim(document.catInfo.cPhone.value)=="")
{
alert("Please fill in the Phone field!");
document.catInfo.cPhone.value='';
document.catInfo.cPhone.focus();
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

// function for validating email address

function echeck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		  // alert("Please enter your Valid Email ID")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   //alert("Please enter your Valid Email ID")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		   // alert("Please enter your Valid Email ID")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		   // alert("Please enter your Valid Email ID")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		   // alert("Please enter your Valid Email ID")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    //alert("Please enter your Valid Email ID")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		   // alert("Please enter your Valid Email ID")
		    return false
		 }

 		 return true					
	}
// end of the function