<?php
ini_set('post_max_size', '300M');
ini_set('upload_max_filesize', '300M');
ini_set('max_execution_time', 20000000); 
$name = $_REQUEST['name'];
$fileName = $_FILES[$name]['name'];
$target_dir = "profile_pic/";
$status = uploadFiles($target_dir,$fileName,$name);
echo json_encode($status);

function uploadFiles($target_dir,$fileName,$inputBoxName){
	$msg = "";
	$target_file = $target_dir . basename($fileName);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$pi = pathinfo($fileName);
	$fileTxt = substr($pi['filename'],0,30);
	$fileExt = $pi['extension'];
	$fileName = $fileTxt."-".time().".".$fileExt;
	$target_file = $target_dir . basename($fileName);
	
	// Check file size
	if ($_FILES[$inputBoxName]["size"] > 20971520) {
		$msg = "large";
		$uploadOk = 0;
		return array('msg' => $msg, 'uploadOk' => $uploadOk, 'fileName' => '');	
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 1) {
		if (move_uploaded_file($_FILES[$inputBoxName]["tmp_name"], $target_file)) {
			$msg = $msg."The file ". basename( $fileName). " has been uploaded.";
			
			$file = $target_file;
			$ftype = 'application/octet-stream';
			$finfo = @new finfo(FILEINFO_MIME);
			$fres = @$finfo->file($file);
			if (is_string($fres) && !empty($fres)) {
			  $ftype = $fres;
			}
			//echo $fileExt."===";
			$app = explode(';',$ftype);
			//echo $app[0];exit;
			if($fileExt == 'jpeg' && $app[0] == 'image/jpeg'){
				return array('msg' => $msg, 'uploadOk' => $uploadOk, 'fileName' => $fileName);					
			}elseif($fileExt == 'jpg' && $app[0] ==  'image/jpeg'){
				return array('msg' => $msg, 'uploadOk' => $uploadOk, 'fileName' => $fileName);					
			}elseif($fileExt == 'png' && $app[0] ==  'image/png'){
				return array('msg' => $msg, 'uploadOk' => $uploadOk, 'fileName' => $fileName);					
			}elseif($fileExt == 'mp3' && $app[0] ==  'audio/mpeg3' || $app[0] == 'audio/mpeg' || $app[0] == 'application/octet-stream' || $app[0] == 'audio/mp3' || $app[0] == 'audio/x-wav'){			
				return array('msg' => $msg, 'uploadOk' => $uploadOk, 'fileName' => $fileName);							
			}elseif($fileExt == 'mp4' && $app[0] ==  'video/mp4'){
				return array('msg' => $msg, 'uploadOk' => $uploadOk, 'fileName' => $fileName);						
			}else{		
				$uploadOk = 0;
				$msg = "invalid";
				return array('msg' => $msg, 'uploadOk' => $uploadOk, 'fileName' => '');	
			}	
		} else {
			$uploadOk = 0;
			$msg = "error";
			return array('msg' => $msg, 'uploadOk' => $uploadOk, 'fileName' => '');	
		}
	}	

}
?>