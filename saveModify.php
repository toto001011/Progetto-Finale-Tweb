<?php

include("db.php");
//if (isset($_REQUEST["nome"]) && isset($_REQUEST["password1"])&& isset($_REQUEST["password2"])) {
 
    
    //session_start();
 
    // $_SESSION["email"] = $email;     # start session, remember user info
   
    //function saveData($dataJson){
        $data = json_decode(file_get_contents('php://input'), true);//accedo al file json con "php://input" e lo decodifico con "json_decode" 
        $nameP=$data["nomeP"];
        $typeP=$data["typeP"];
        $priceP=$data["priceP"];
       $newImage=" ";//$data["newImage"];
        $idP=$data["id"];
        
       if(check_if_exist_product($idP)){
            update_product($idP,$nameP,$typeP,$priceP,$newImage);
        }else{
            add_product($idP,$nameP,$typeP,$priceP,$newImage);
           // add_product("2","nameP","typeP","priceP"," ");
        }
        $_SESSION["flash"]="Modifiche aggiornate"
        //echo("nome-->".$nameP)
 //   }

    /*function addProduct($dataJson){
        $data = json_decode(file_get_contents('php://input'), true);//accedo al file json con "php://input" e lo decodifico con "json_decode" 
        $nameP=$data["nomeP"];
        $typeP=$data["typeP"];
        $priceP=$data["priceP"];
        $newImage=$data["newImage"];
        $idP=$data["id"];
        add_product($idP,$nameP,$typeP,$priceP,$newImage);
        $_SESSION["flash"]="Modifiche aggiornate"


    }
    


    if (isset($_POST['funzione']) && isset($_POST['data'])) {
        $data = json_decode($_POST['data'], true);
        switch ($_POST['funzione']) {
          case 'saveData':
            primaFunzione($data);
            break;
          case 'addProduct':
            secondaFunzione($data);
            break;
          default:
            echo "Funzione non valida";
            break;
        }
      }*/
          
      





?>
