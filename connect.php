<?php
//Enter the Database Name, Database Login ID  and Password here
ini_set( "short_open_tag", 1 );
ini_set('display_errors',0);
ini_set('display_startup_errors', 0);
error_reporting(0);
$localhost="localhost";
$database="db_dapp";
$username="root";
$password="";

//Connection to the database
//mysql_connect($localhost,$username,$password,$database);
//@mysql_select_db($database) or die( "Unable to select database");
$pageSplit=10;


function createConnection() {
    

	$host = "localhost";
	$dbname = "db_dapp";
    $dbuser =  "root";
    $dbpass  = "";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $con=mysqli_connect($host, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_errno()) {
      //  print mysqli_connect_errno()."ERROR IN MYSQL";
		print "Oops. Something has gone wrong. Please try again.";
        return null;
    }
    return $con;
}

function closeConnection($con) {
    mysqli_close($con);
}

DEFINE('onlinepath','http://localhost/l2pro/')
?>
