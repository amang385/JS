<?php
	$uploads_dir = '../upload/thumbs/';
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);

	//saving
	$file = explode('.', $_POST['name']);
	$fileName = $file[0].'.png';
	$increment = 0;
	while(is_file($uploads_dir.'/'.$fileName)) {
			 $fileName = $file[0].'.png';
             $increment++;
             $fileName = $increment.$fileName;
           }
           if (file_put_contents($uploads_dir .$fileName, $fileData)) {
           		echo $fileName;
           }
?>