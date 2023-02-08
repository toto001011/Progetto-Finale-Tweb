<?php

include("db.php");

  
         $data = json_decode(file_get_contents('php://input'), true);
       
         if($data["function"]=="addNewProducts"){
            $idP=$data["idP"];
            $lastIndex=get_last_index();
            echo($lastIndex);

             }else 
         
         
        if($data["function"]=="saveData"){
         $nameP=$data["nomeP"];
        $typeP=$data["typeP"];
        $priceP=$data["priceP"];
        $idP=$data["id"];
        $newImagePath='C:\xampp\htdocs\Progetto-Finale-Tweb\upload\\'.'idP'.$idP.'.jpg';

        $newImage=file_get_contents($newImagePath);
        $newImageEncoded=base64_encode($newImage);
        
        echo($newImageEncoded."\n\n");


        
       if(check_if_exist_product($idP)){
            update_product($idP,$nameP,$typeP,$priceP,$newImageEncoded);
        }else{
            add_product($idP,$nameP,$typeP,$priceP,$newImageEncoded);
           // add_product("2","nameP","typeP","priceP"," ");
        }
        unlink($newImagePath);
        $_SESSION["flash"]="Modifiche aggiornate";
        
        }else 
    if($data["function"]=="delete"){

        $idP=$data["idP"];
       
        delete_product($idP);


    }else
    if($data["function"]=="addToBasket"){
        $email=$_SESSION["email"];
        $password =$_SESSION["password"];
        $idP=$data["idP"];
  // $_SESSION["name"] = $name;     # start session, remember user info

  //incBasketQty($nome,$password,$idP);
  addToBasket($email,$password,$idP);
    }if($data["function"]=="delBasketProduct"){
        $email=$_SESSION["email"];
        $idP=$data["idP"];

        delete_basket_product($email,$idP);

    } else if($data["function"]=="decBasketQty"){

       // if (isset($_SESSION)){



            $email=$_SESSION["email"];
              //$password =$_SESSION["password"]; //$_POST['password'];
            $idP=$data["idP"];
              // $_SESSION["name"] = $name;     # start session, remember user info
            
              decBasketQty($email,$idP);
               //redirect("basket.php", "v");
       // }
    }else if($data["function"]=="incBasketQty"){
        
        $email=$_SESSION["email"];
        $idP=$data["idP"];

        incBasketQty($email,$idP);
    }






?>
