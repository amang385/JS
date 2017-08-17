<?php
	if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        // move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
        $uploads_dir = '../upload/video/';

        $_FILES["file"]["name"]; 
        $_FILES["file"]["size"];
        $_FILES["file"]["type"];
        $pname = $_FILES["file"]["name"]; 
        if ($pname != "") {
           $tname=$_FILES["file"]["tmp_name"];

          $name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
          $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

           $increment = 0; 
           $pname = $name . '.' . $extension;
           while(is_file($uploads_dir.'/'.$pname)) {
             $increment++;
             $pname = $name . $increment . '.' . $extension;
           }
           if(move_uploaded_file($tname, $uploads_dir.'/'.$pname)){
           	  echo $pname;
           }
  
        }
    }
?>