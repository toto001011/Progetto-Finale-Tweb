<?php

if (isset($_FILES['file']) ) {
  $idP=$_POST['idP'];
  $file = $_FILES['file'];
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];
  $fileType = $file['type'];
 


  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png','JPEG');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 65536) {
        $fileNameNew ="idP".$idP.".".$fileActualExt;
        $fileDestination = 'upload/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        echo "Image uploaded successfully!";
      } else {
        echo "File size is too big!";
      }
    } else {
      echo "There was an error uploading your file!";
    }
  } else {
    echo "You cannot upload files of this type!";
  }
}
?>
