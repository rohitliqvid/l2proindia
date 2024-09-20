<?php
    header("Access-Control-Allow-Origin: *");
    $f = $_REQUEST['file'];
    $myfile = fopen($f, "r") or die("Unable to open file!");
    echo fread($myfile,filesize($f));
    fclose($myfile);
?>
