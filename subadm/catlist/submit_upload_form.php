<?php
//echo "here";
/*session_start();
if (!isset($_SESSION['sess_uid'])) 
{
echo "The session is expired. Please re-login!";
exit();
}*/
ini_set('max_execution_time', 2400000);    // Increase 'timeout' time 
include("../connect.php"); //Connection to database 

$uploadpath="../../courses/";
$upload=$_REQUEST['upload'];
$from_page='none.php';
$dt=date("Y:m:d");
		
// uploaded file details
$file=$_FILES['file_n'];
$file_name=$file['name'];
$file_type=$file['type'];
$file_size=$file['size'];
$file_ext=split("\.", $file_name);
			
			if($file_size[0] >'2097152')
				{

					header("Location: upload_form.php?from_page=$from_page&msg='File Size is greater than permitted 300 MB.'");
					exit;
				}
			
		
		if($file_size[0]=='0')
			{
				header("Location: upload_form.php?from_page=$from_page&msg='File Size is 0.'");
				exit;
			}
			
		if($cancle)
			{
				header("Location: upload_form.php?from_page=$from_page");
				exit;
			}
		
			$err12='false';
	

		if($file_size[0]=="0")
		{
			header("Location: upload_form.php?from_page=$from_page&msg=Sorry! File Size Error in File Upload.");
			exit;
		}

		if($_REQUEST['upload'])
		{
			$uploaddir=$uploadpath;
			$uploadfile = $uploaddir.$file_name;
			
			if(move_uploaded_file($_FILES['file_n']['tmp_name'], $uploadfile))
			{
			
					mysql_query("INSERT INTO tbl_upload_track (filename, filesize) VALUES ('$file_name','$file_size')");
				?>
				<script>
					document.location.href='upload.php';
					</script>

				<?
					exit;

			}
			else
			{
			header("Location: upload_form.php?from_page=$from_page&msg= Sorry!! You cannot upload this file!.");
			exit;
			}
		}

?>