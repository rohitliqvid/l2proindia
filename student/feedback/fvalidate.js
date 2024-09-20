//The validate.js file validates the input fields

function ValidateInfo()
{

if (Trim(document.feedform.subject.value)=="")
{
alert("Please fill in the Subject / Section field!");
document.feedform.subject.value='';
document.feedform.subject.focus();
return false;
}
else if (Trim(document.feedform.description.value)=="")
{
alert("Please fill in the Description field!");
document.feedform.description.value='';
document.feedform.description.focus();
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

