<?php
session_start();
unset($_SESSION['voucher']);
header("location: ../customer/buyCourses.php");

?>