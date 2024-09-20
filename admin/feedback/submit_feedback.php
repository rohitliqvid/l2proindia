<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}

include("../connect.php"); //Connection to database 
include("../global/functions.php"); 

function mysql_escape_mimic($inp) {

    if(is_array($inp))
    return array_map(__METHOD__, $inp);
    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);

    }
    return $inp;
}

$fromName=getFullName($_SESSION['sess_uid']);
$feedbackCat=trim(mysql_escape_mimic($_POST['feedbackCat']));
$subject=trim(mysql_escape_mimic(strip_htmscript($_POST['subject'],'mandatory')));
$description=trim(mysql_escape_mimic(strip_htmscript($_POST['description'],'mandatory')));
$uploaded_by=getFullName($_SESSION['sess_uid']);
$uploaded_by_id=getUserId($_SESSION['sess_uid']);

$dt=date("Y:m:d");
$f_status='0';

//$uploaded_by=getUserId($uploaded_by);

//mysql_query("INSERT INTO tbl_feedback (f_category,f_subject, f_description, f_by, f_by_id, f_date, f_status) VALUES ('$feedbackCat','$subject','$description','$uploaded_by',$uploaded_by_id,'$dt','$f_status')");
//exit;
//$id=mysql_insert_id();


$query = "INSERT INTO tbl_feedback (f_category,f_subject, f_description, f_by, f_by_id, f_date, f_status) VALUES ('$feedbackCat','$subject','$description','$uploaded_by',$uploaded_by_id,'$dt','$f_status')";
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->close();
closeConnection($con);


header("Location:feedback_submitted.php");
//close the connection
mysql_close();
?>

