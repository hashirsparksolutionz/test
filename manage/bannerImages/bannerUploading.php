<?php
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
	
	$imagename = $_FILES['bannerImg']['name'];
	//echo $imagename;
	$special = array('/','!','&','*',' ','-');
	//echo $special;
	$random_digit = rand(00,99);
	$new_file_name = $random_digit.str_replace($special,'',$imagename);
	//echo $new_file_name;
	$source =  $_FILES['bannerImg']['tmp_name'];
	//echo $source;
	$target  = "../images/";
	//echo $target;
	move_uploaded_file($source, $target.$new_file_name);
	$imagepath = $imagename;
	//echo $imagepath;
	$save = "../images/"."thumb_".$new_file_name;
	//echo $save;
	$save1 = "../images/"."thumbnew_".$new_file_name;
	$file = "../images/".$new_file_name;
	//echo $file;
	list($width, $height)  =  getimagesize($file); 
	//$modwidth = 100;
	$modwidth = 772;
	$diff = $width/$modwidth;
	//echo $diff;
	$modheight = $height/$diff;
	$modheight = 306;
	$tn = imagecreatetruecolor($modwidth, $modheight);
	imagealphablending($tn, false);
	imagesavealpha($tn, true);
	$image_jpeg = imagecreatefromjpeg($file); 
	imagealphablending($image_jpeg, true);
	$image_gif = imagecreatefromgif($file);
	imagealphablending($image_gif, true);
	$image_png = imagecreatefrompng($file) ; 
	imagealphablending($image_png, true);
	imagecopyresampled($tn, $image_jpeg, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 
	imagecopyresampled($tn, $image_gif, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 
	imagecopyresampled($tn, $image_png, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);
	imagejpeg($tn, $save, 100);
	imagegif($tn, $save, 100);
	imagepng($tn, $save, 9);
	
	$modswidth = 50;
	$modsheight = 50;
	$tn = imagecreatetruecolor($modswidth, $modsheight);
	imagealphablending($tn, false);
	imagesavealpha($tn, true);
	$image_jpeg = imagecreatefromjpeg($file); 
	imagealphablending($image_jpeg, true);
	$image_gif = imagecreatefromgif($file);
	imagealphablending($image_gif, true);
	$image_png = imagecreatefrompng($file) ; 
	imagealphablending($image_png, true);
	imagecopyresampled($tn, $image_jpeg, 0, 0, 0, 0, $modswidth, $modsheight, $width, $height) ; 
	imagecopyresampled($tn, $image_gif, 0, 0, 0, 0, $modswidth, $modsheight, $width, $height) ; 
	imagecopyresampled($tn, $image_png, 0, 0, 0, 0, $modswidth, $modsheight, $width, $height);
	imagejpeg($tn, $save1, 100);
	imagegif($tn, $save1, 100);
	imagepng($tn, $save1, 9);
	
	mysqli_query($con, "INSERT INTO `bannerImages` (bannerImages) VALUES ('".$new_file_name."')");

 }
?>