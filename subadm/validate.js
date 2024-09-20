function ValidatePwd()
{
if (Trim(document.pwdInfo.email.value)=="")
{
alert("Please fill in the User ID field!");
document.pwdInfo.email.value="";
document.pwdInfo.email.focus();
return false;
}
else if (Trim(document.pwdInfo.dob.value)=="")
{
alert("Please fill in the Date of Birth field!");
document.pwdInfo.dob.value="";
document.pwdInfo.dob.focus();
return false;
}
else
{
return true;
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