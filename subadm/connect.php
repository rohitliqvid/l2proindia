<?php
//Enter the Database Name, Database Login ID  and Password here
//$localhost="languagelab555.cpwwa3kju9uo.ap-southeast-1.rds.amazonaws.com";
ini_set('display_errors',0);
ini_set('display_startup_errors', 0);
error_reporting(0);
function createConnection() {
    
	$host = "localhost";
	$dbname = "db_dapp";
    $dbuser =  "root";
    $dbpass  = "7RTH?6@%OOTr\g:82#5Y";

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

$pageSplit=10;

//DEFINE('onlinepath','https://l2proindia/')
?>
