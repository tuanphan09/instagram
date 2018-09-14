<?php

	$file = $_FILES['file'];
	$name = "img/".$file['name'];

	if(preg_match('/(.jpg|.jpeg|.png)$/', $name)){
		list($width, $height) = getimagesize($file['tmp_name']);
		$size = $file['size']/(1024*1024); // MB
		if($size >= 1){
			if($size >= 4) $x = 2;
			else $x = 1.5;

			$new_width = $width/$x;
			$new_height = $height/$x;

			$src = imagecreatefromstring(file_get_contents($file['tmp_name']));
	        $dst = imagecreatetruecolor( $new_width, $new_height );
	        imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	        imagedestroy( $src );
	        preg_match("/.[a-zA-Z]{3,4}$/", $name, $tail);
	        if($tail[0] == 'png'){
	        	imagepng( $dst, $file['tmp_name']); 
	        } else {
	        	imagejpeg( $dst, $file['tmp_name']); 
	        }
	        imagedestroy( $dst );
		} 
		
		if(move_uploaded_file($_FILES['file']['tmp_name'], '../public/'.$name))
			die($name);
	}
	die('');
?>