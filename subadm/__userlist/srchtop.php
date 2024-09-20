<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
else
{
$userid = $_SESSION['sess_uid'];
}

include("../connect.php"); //Connection to database 
//$result = mysql_query ("SELECT * FROM tbl_company ORDER BY company_name ASC"); 
//$totalnum=mysql_numrows($result);

?>

<link href="../styles/styles.css" rel="stylesheet" type="text/css">

<head>

</head>

<body class='contentBG' topmargin="10" leftmargin="10">



</body>