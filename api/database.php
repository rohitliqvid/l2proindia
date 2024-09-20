<?php 

function getConnection() {
    $dbhost="localhost";
    $dbname="l2pro_stg";
    $dbuser="root";
    $dbpass="";
    
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>