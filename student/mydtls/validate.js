//The validate.js file validates the user input fields

function ValidateInfo()
{

if (Trim(document.userInfo.fstnm.value)=="")
{
alert("Please fill in the First name field!");
document.userInfo.fstnm.value="";
document.userInfo.fstnm.focus();
return false;
}
else if (Trim(document.userInfo.lstnm.value)=="")
{
alert("Please fill in the Last name field!");
document.userInfo.lstnm.value="";
document.userInfo.lstnm.focus();
return false;
}
else if (Trim(document.userInfo.email.value)=="")
{
alert("Please fill in the Email field!");
document.userInfo.email.value="";
document.userInfo.email.focus();
return false;
}
else if(Trim(document.userInfo.email.value) !="" && echeck(document.userInfo.email.value) ==false)
{
alert("Email address is not valid!");
document.userInfo.email.focus();
return false;
}
else if(mailExists==1)
{
alert("Email address already exists!");
document.userInfo.email.focus();
return false;
}
else if (document.userInfo.dob.value=="")
{
alert("Please select Date of Birth!");
document.userInfo.dob.focus();
return false;
}
else if (document.userInfo.doj.value=="")
{
alert("Please select Date of Joining!");
document.userInfo.dob.focus();
return false;
}
else if (document.userInfo.udept.value=="")
{
alert("Please select Department!");
document.userInfo.udept.focus();
return false;
}
else if (document.userInfo.ucountry.value=="")
{
alert("Please select Country!");
document.userInfo.ucountry.focus();
return false;
}
else if (document.userInfo.ucity.value=="")
{
alert("Please select City!");
document.userInfo.ucity.focus();
return false;
}
else if(Trim(document.userInfo.uquestion.value)!="" && Trim(document.userInfo.uanswer.value)=="")
{
alert("Please fill in Answer for Security Question!");
document.userInfo.uanswer.focus();
return false;
}
else
{
return true;
}
}

function ValidatePwdInfo()
{
if (Trim(document.pwdInfo.opwd.value)=="")
{
alert("Please fill in the Old password field!");
document.pwdInfo.opwd.value="";
document.pwdInfo.opwd.focus();
return false;
}
if (Trim(document.pwdInfo.pwd.value)=="")
{
alert("Please fill in the New password field!");
document.pwdInfo.pwd.value="";
document.pwdInfo.pwd.focus();
return false;
}
else if (Trim(document.pwdInfo.pwd.value).length<6)
{
alert("Password must be between 6-8 character long!");
document.pwdInfo.pwd.value="";
document.pwdInfo.cpwd.value="";
document.pwdInfo.pwd.focus();
return false;
}
else if (Trim(document.pwdInfo.cpwd.value)=="")
{
alert("Please fill in the Confirm password field!");
document.pwdInfo.cpwd.value="";
document.pwdInfo.cpwd.focus();
return false;
}
else if (Trim(document.pwdInfo.pwd.value)!=Trim(document.pwdInfo.cpwd.value))
{
alert("Passwords don't match!");
document.pwdInfo.pwd.value="";
document.pwdInfo.cpwd.value="";
document.pwdInfo.pwd.focus();
return false;
}
else
{
return true;
}
}

var keyProtected = new keybEdit('abcdefghijklmnopqurstuvwxyz01234567890_ ','Alpha-numeric input only.');
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