<?php
//Funzione che carica la foto in "locale" temporaneamente per poi salvarla codificata in base64 nel db 
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
        
        //echo "Image uploaded successfully!";
        //echo "Immagine caricata correttamente";
        //echo($fileDestination);
         $arrayEcho[]=array("msg"=>"Immagine caricata correttamente","src"=>$fileDestination);
         echo json_encode($arrayEcho);
        

      } else {
        $arrayEcho[]=array("msg"=>"Dimensione mmagine troppo grande","src"=>"");
        echo json_encode($arrayEcho);
       
      }
    } else {
      $arrayEcho[]=array("msg"=>"C'e stato un errore durante l'upload dell'immagine","src"=>"");
      echo json_encode($arrayEcho);
    }
  } else {
    $arrayEcho[]=array("msg"=>"File non ammesso:Sono ammessi file con estensione jpg,jpeg e png","src"=>"");
    echo json_encode($arrayEcho);
    
  }
}
?>
