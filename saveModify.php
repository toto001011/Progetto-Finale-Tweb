<?php

include("db.php");
//if (isset($_REQUEST["nome"]) && isset($_REQUEST["password1"])&& isset($_REQUEST["password2"])) {
 
    
    //session_start();
 
    // $_SESSION["email"] = $email;     # start session, remember user info
   
  //  function saveData($dataJson){
        $data = json_decode(file_get_contents('php://input'), true);//accedo al file json con "php://input" e lo decodifico con "json_decode" 
        $nameP=$data["nomeP"];
        $typeP=$data["typeP"];
        $priceP=$data["priceP"];
    // $newImagePath=C:\xampp\htdocs\Progetto-Finale-Tweb\upload\';
        $idP=$data["id"];
        $newImagePath='C:\xampp\htdocs\Progetto-Finale-Tweb\upload\\'.'idP'.$idP.'.jpg';


      /*  $location = $newImage;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);
     
        /* Valid extensions 
        $valid_extensions = array("jpg","jpeg","png");
     
        //$response = 0;
        /* Check file extension */
        /*if(in_array(strtolower($imageFileType), $valid_extensions)) {
           /* Upload file 
           if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
              $response = $location;
           }
        }*/
        $newImage=file_get_contents($newImagePath);
        $newImageEncoded=base64_encode($newImage);
        echo($newImageEncoded."\n\n");


        
       if(check_if_exist_product($idP)){
            update_product($idP,$nameP,$typeP,$priceP,$newImageEncoded);
        }else{
            add_product($idP,$nameP,$typeP,$priceP,$newImageEncoded);
           // add_product("2","nameP","typeP","priceP"," ");
        }
        $_SESSION["flash"]="Modifiche aggiornate";
   // }
        //echo("nome-->".$nameP)
 //   }

   /* function uploadImg($dataJson){
      /*  $data = json_decode(file_get_contents('php://input'), true);//accedo al file json con "php://input" e lo decodifico con "json_decode" 
        $nameP=$data["nomeP"];
        $typeP=$data["typeP"];
        $priceP=$data["priceP"];
        $newImage=$data["newImage"];
        $idP=$data["id"];
        add_product($idP,$nameP,$typeP,$priceP,$newImage);
        $_SESSION["flash"]="Modifiche aggiornate";
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('images/uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : images/uploads/' . $_FILES['file']['name'];
                } else {
                    move_uploaded_file($_FILES['file']['tmp_name'], 'images/uploads/' . $_FILES['file']['name']);
                    echo 'File successfully uploaded : images/uploads/' . $_FILES['file']['name'];
                }
            }
        } else {
            echo 'Please choose a file';
        }
    }*/
    


 /*   if (isset($_POST['funzione']) && isset($_POST['data'])) {
        $data = json_decode($_POST['data'], true);
        switch ($_POST['funzione']) {
          case 'uploadImg':
            uploadImg($data);
            break;
          case 'saveData':
            saveData($data);
            break;
          default:
            echo "Funzione non valida";
            break;
        }
      }
          
    */  





?>
