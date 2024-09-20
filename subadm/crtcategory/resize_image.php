<?php
function size($uploadedimagewidth,$uploadedimageheight,$requiredwidth,$requiredheight)
{
	if($uploadedimagewidth<=$requiredwidth && $uploadedimageheight<=$requiredheight)
	{
	//do nothing
	}
	else
	{

			//if uploaded images' width is greater than height
			if($uploadedimagewidth > $uploadedimageheight)
			{
				$newWidth=$requiredwidth;
				$newHeight=($uploadedimageheight/$uploadedimagewidth)*$requiredwidth;
				
				if($newHeight>$requiredheight)
				{
				$newHeight1=$requiredheight;
				$newWidth1=($newWidth/$newHeight)*$requiredheight;
				
				$newWidth=$newWidth1;
				$newHeight=$newHeight1;
				}     

			 }

			//if uploaded images' height is greater than width
			 if($uploadedimageheight > $uploadedimagewidth)
			{

				$newHeight=$requiredheight;
				$newWidth=($uploadedimagewidth/$uploadedimageheight)*$requiredheight;
				if($newWidth>$requiredwidth)
				{
					$newWidth1=$requiredWidth;
					$newHeight1=($newHeight/$newWidth)*$requiredwidth;
					
					$newWidth=$newWidth1;
					$newHeight=$newHeight1;
				}     
			 }
		return $newWidth."-".$newHeight;
		}
}

function resize_image($uploadedfile,$filename,$template)
{

// This is the temporary file created by PHP
//$uploadedfile = $_FILES['uploadfile']['tmp_name'];
	$img_type_arr=explode('.',$filename);
	$img_type=$img_type_arr[count($img_type_arr)-1];

// Create an Image from it so we can do the resize
$file_type = strtolower($img_type);
if($file_type == "jpg" || $file_type == "jpeg")
{
	$src = imagecreatefromjpeg($uploadedfile);
}
else if($file_type == "gif")
{
	$src = imagecreatefromgif($uploadedfile);
}
else if($file_type == "png")
{
	$src = imagecreatefrompng($uploadedfile);
}

// Capture the original size of the uploaded image
list($width,$height)=getimagesize($uploadedfile);

// For our purposes, I have resized the image to be
// 600 pixels wide, and maintain the original aspect
// ratio. This prevents the image from being "stretched"
// or "squashed". If you prefer some max width other than
// 600, simply change the $newwidth variable
if($template=='cover_page')
{
$newwidth=158;
$newheight=95;
}

/*$parameters=size($width,$height,$newwidth,$newheight);
//echo $parameters;
//exit;
$temp=explode("-",$parameters);

$newwidth=$temp[0];
$newheight=$temp[1];*/



if($width>=159 && $height>=96)
	{
	$tmp=@imagecreatetruecolor($newwidth,$newheight);
	// this line actually does the image resizing, copying from the original
	// image into the $tmp image
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

	// now write the resized image to disk. I have assumed that you want the
	// resized, uploaded image file to reside in the ./images subdirectory.
	//$filename = "images/". $_FILES['uploadfile']['name'];
	if($file_type == "jpg" || $file_type == "jpeg")
	{
		imagejpeg($tmp,$filename,100);
	}
	else if($file_type == "gif")
	{
		imagegif($tmp,$filename,100);
	}
	else if($file_type == "png")
	{
		imagepng($tmp,$filename);
	}

	//imagedestroy($src);
	imagedestroy($tmp); // NOTE: PHP will clean up the temp file it created when the request
	// has completed.
	}
	else
	{
		$tmp=@imagecreatetruecolor($width,$height);
		imagecopyresampled($tmp,$src,0,0,0,0,$width,$height,$width,$height);
		if($file_type == "jpg" || $file_type == "jpeg")
		{
			imagejpeg($tmp,$filename,100);
		}
		else if($file_type == "gif")
		{
			imagegif($tmp,$filename,100);
		}
		else if($file_type == "png")
		{
			imagepng($tmp,$filename);
		}
		imagedestroy($tmp); // NOTE: PHP will clean up the temp file it created when the request
	}
}
?>