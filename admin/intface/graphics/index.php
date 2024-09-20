<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../../../");
exit();
}
?>