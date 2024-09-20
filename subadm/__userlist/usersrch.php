<?php
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
echo "The session is expired. Please re-login!";
exit();
}
?>

<?php
//function to retrieve the user type (administrator or student)
function getUserType()
{
	global $utype;
	if ($utype=="Administrator")
	{
	$utype=2;
	}
	else if ($utype=="User")
	{
	$utype=0;
	}
}

if ($uname=="" && $utype=="")
{

$query4 = "SELECT id,firstname,lastname,username,usertype,userregistered,client,DTENROLLED FROM tbl_users";
$totalresult = mysqli_query($con,$query4);
$totalnum=mysqli_num_rows($totalresult);


//$totalresult = mysql_query ("SELECT * FROM tbl_users"); 
//$totalnum=mysql_numrows($totalresult);

$query5 = "SELECT id,firstname,lastname,username,usertype,userregistered,client,DTENROLLED FROM tbl_users ORDER BY usertype DESC, username ASC LIMIT $startRecord,$pageSplit";
$result = mysqli_query($con,$query5);
$num=mysqli_num_rows($result);
	
//$result = mysql_query ("SELECT * FROM tbl_users ORDER BY usertype DESC, username ASC LIMIT $startRecord,$pageSplit"); 
//$num=mysql_numrows($result);

}

if ($uname=="" && $utype!="")
{
getUserType();

$query6 = "select id,firstname,lastname,username,usertype,userregistered,client,DTENROLLED from tbl_users where username LIKE '%$utype%'";
$totalresult = mysqli_query($con,$query6);
$totalnum=mysqli_num_rows($totalresult);

//$totalresult = mysql_query ("select * from tbl_users where username LIKE '%$utype%'"); 
//$totalnum=mysql_numrows($totalresult);

$query7 = "select id,firstname,lastname,username,usertype,userregistered,client,DTENROLLED from tbl_users where username LIKE '%$utype%' ORDER BY usertype DESC, username ASC LIMIT $startRecord,$pageSplit";
$result = mysqli_query($con,$query7);
$num=mysqli_num_rows($result);

//$result = mysql_query ("select * from tbl_users where username LIKE '%$utype%' ORDER BY usertype DESC, username ASC LIMIT $startRecord,$pageSplit"); 
//$num=mysql_numrows($result);

}

if ($uname!="" && $utype=="")
{
getUserType();


$query8 = "select id,firstname,lastname,username,usertype,userregistered,client,DTENROLLED from tbl_users where firstname LIKE '%$uname%' or lastname LIKE '%$uname%' or CONCAT(firstname,  ' ',lastname ) LIKE  '%$uname%'";
$totalresult = mysqli_query($con,$query8);
$totalnum=mysqli_num_rows($totalresult);

//$totalresult = mysql_query ("select * from tbl_users where firstname LIKE '%$uname%' or lastname LIKE '%$uname%' or CONCAT(firstname,  ' ',lastname ) LIKE  '%$uname%'"); 
//$totalnum=mysql_numrows($totalresult);


$query9 = "select id,firstname,lastname,username,usertype,userregistered,client,DTENROLLED from tbl_users where (firstname LIKE '%$uname%' or lastname LIKE '%$uname%'  or CONCAT(firstname,  ' ',lastname ) LIKE  '%$uname%') ORDER BY usertype DESC, username ASC LIMIT $startRecord,$pageSplit";
//echo $query9;
$result = mysqli_query($con,$query9);
$num=mysqli_num_rows($result);

//$result = mysql_query ("select * from tbl_users where (firstname LIKE '%$uname%' or lastname LIKE '%$uname%'  or CONCAT(firstname,  ' ',lastname ) LIKE  '%$uname%') ORDER BY usertype DESC, username ASC //LIMIT $startRecord,$pageSplit"); 
//$num=mysql_numrows($result);

}

if ($uname!="" && $utype!="")
{
getUserType();

$query10 = "select id,firstname,lastname,username,usertype,userregistered,client,DTENROLLED from tbl_users where (firstname LIKE '%$uname %' or lastname LIKE '%$uname%'  or CONCAT(firstname,  ' ',lastname ) LIKE  '%$uname%') and username LIKE '%$utype%'";
$totalresult = mysqli_query($con,$query10);
$totalnum=mysqli_num_rows($totalresult);

//$totalresult = mysql_query ("select * from tbl_users where (firstname LIKE '%$uname %' or lastname LIKE '%$uname%'  or CONCAT(firstname,  ' ',lastname ) LIKE  '%$uname%') and username LIKE '%$utype%'"); 
//$totalnum=mysql_numrows($totalresult);

$query11 = "select id,firstname,lastname,username,usertype,userregistered,client,DTENROLLED from tbl_users where (firstname LIKE '%$uname%' or lastname LIKE '%$uname%' or CONCAT(firstname,  ' ',lastname ) LIKE  '%$uname%') and username LIKE '%$utype%' ORDER BY usertype DESC, username ASC LIMIT $startRecord,$pageSplit";
$result = mysqli_query($con,$query11);
$num=mysqli_num_rows($result);

//$result = mysql_query ("select * from tbl_users where (firstname LIKE '%$uname%' or lastname LIKE '%$uname%' or CONCAT(firstname,  ' ',lastname ) LIKE  '%$uname%') and username LIKE '%$utype%' ORDER BY usertype DESC, username ASC LIMIT $startRecord,$pageSplit"); 
//$num=mysql_numrows($result);

}
?>