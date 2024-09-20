<?php include('../intface/adm_top.php'); ?>

<?php

function mysql_escape_mimic($inp) {

    if(is_array($inp))
    return array_map(__METHOD__, $inp);
    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);

    }
    return $inp;
}

	$title = trim(strip_htmscript(mysql_escape_mimic($_POST['title'], 'mandatory')));
	$descripiton=str_replace("\r\n","<br/>",$_POST['description']);
	$descripiton=trim(strip_htmscript(mysql_escape_mimic($descripiton, 'other')));
	$status = strtolower(trim(strip_htmscript(mysql_escape_mimic($_POST['status'], 'mandatory'))));

	$curdate = date('y-m-d');
	$msg = '';
	$msg = empty($title) ? 'First name required.' : $msg;
	$msg = empty($descripiton) ? 'Last name required.' : $msg;
	$msg = empty($status) ? 'status required.' : $msg;

	if ($msg == '') {

		//mysql_query("INSERT INTO tbl_whatsnew_post (title, description, status, date) VALUES ('$title','$descripiton','$status','$curdate')");

		$query = "INSERT INTO tbl_whatsnew_post (title, description, status, date) VALUES ('$title','$descripiton','$status','$curdate')";
		$stmt = $con->prepare($query);
		$stmt->execute();
		$stmt->close();

		
		$_SESSION['msg'] = 'New Post created successfully.';
		echo '<script>  window.location="index.php"</script>';

		exit;
	} else {
		$_SESSION['msg'] = $msg;
		echo '<script>  window.location="insertPost.php?title=' . $title . '&description=' . $_POST['description'] . '&status=' . $status . '"</script>';
	}


	//close the connection
	mysql_close();


?>
<?php
include('../intface/footer.php');
?>