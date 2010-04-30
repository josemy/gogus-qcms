<?php
include 'resize.image.class-3.php';

$dir = opendir('./local_img');
 
while ($file = readdir($dir)){
//echo($file."<br />");
if (!is_dir($file) && $file != '.' && $file != '..' && $file != 'thumbs') {
 
// aplicar funcion
		$image = new Resize_Image;
		$image->new_width = 50;
		$image->new_height = 50;
		$image->image_to_resize = "./local_img/".$file; // Full Path to the file
		$image->ratio = true; // Keep Aspect Ratio?
		// Name of the new image (optional) - If it's not set a new will be added automatically
		$file=explode(".",$file);
		$file=$file[0];
		$image->new_image_name = '50_'.$file;
		/* Path where the new image should be saved. If it's not set the script will output the image without saving it */
		$image->save_folder = 'local_img/thumbs/';
		$process = $image->resize();
		if($process['result'] && $image->save_folder)
		{
		echo 'The new image ('.$process['new_file_path'].') has been saved.<br />';
		}
}
}
$dir->close();
?>