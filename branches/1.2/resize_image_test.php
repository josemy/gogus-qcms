<?php
set_time_limit(10000);
error_reporting(E_ALL ^ E_NOTICE);
// Folder where the (original) images are located with trailing slash at the end
$images_dir = '';
// Image to resize
$image = $_GET['image'];
$full=$image;

/* Some validation */
if(!@file_exists($image))
{
//exit('The requested image does not exist.');
}
// Get the new with & height
$new_width = (int)$_GET['new_width'];
$new_height = (int)$_GET['new_height'];
$image=explode("/",$image);
$image=$image[1];
if(file_exists("local_img/thumbs/".$new_width."_".$image)){
$info = GetImageSize($full);
$mime = $info['mime'];
$type = substr(strrchr($mime, '/'), 1);
switch ($type)
{
case 'jpeg':
    $image_create_func = 'ImageCreateFromJPEG';
    $image_save_func = 'ImageJPEG';
	$new_image_ext = 'jpg';
    break;

case 'png':
    $image_create_func = 'ImageCreateFromPNG';
    $image_save_func = 'ImagePNG';
	$new_image_ext = 'png';
    break;

case 'bmp':
    $image_create_func = 'ImageCreateFromBMP';
    $image_save_func = 'ImageBMP';
	$new_image_ext = 'bmp';
    break;

case 'gif':
    $image_create_func = 'ImageCreateFromGIF';
    $image_save_func = 'ImageGIF';
	$new_image_ext = 'gif';
    break;

case 'vnd.wap.wbmp':
    $image_create_func = 'ImageCreateFromWBMP';
    $image_save_func = 'ImageWBMP';
	$new_image_ext = 'bmp';
    break;

case 'xbm':
    $image_create_func = 'ImageCreateFromXBM';
    $image_save_func = 'ImageXBM';
	$new_image_ext = 'xbm';
    break;

default:
	$image_create_func = 'ImageCreateFromJPEG';
    $image_save_func = 'ImageJPEG';
	$new_image_ext = 'jpg';
}
header("Content-Type: ".$mime);
$im=$image_create_func("local_img/thumbs/".$new_width."_".$image);
$img = $image_save_func($im); 

echo($img);
}else{
echo($new_width."_".$image);
}

?>
