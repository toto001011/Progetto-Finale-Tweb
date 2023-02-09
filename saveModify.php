<?php

//include("db.php");
include("login.php");
//session_start();
  
         $data = json_decode(file_get_contents('php://input'), true);
         if($data["function"]=="visualize_basket"){
            
            //FUNZIONE CHE ESTRAE I PRODOTTI NEL CARRELLO
        $dbconnstring = 'mysql:dbname=shop;host=localhost:3306';
        $dbuser = 'root';
        $dbpasswd = '';
        
          $email=$_SESSION["email"];
        // Create connection
        $db = new PDO($dbconnstring, $dbuser, $dbpasswd);

        $query_risult= $db->query("SELECT * FROM carrello join clienti on(idC=clienti.id) JOIN products on (idP=products.id) WHERE clienti.email='$email' ");
        // Check connection
 
            while($row = $query_risult->fetch()) {
              $arrayProd[]=array("name"=>$row["name"],"type"=>$row["type"],"price"=>$row["price"],"img"=>$row["img"],"id"=>$row["Id"],"qty"=>$row["qty"]);
             }
             echo json_encode($arrayProd);

       }else
       if($data["function"]=="visualize_products"){
            //FUNZIONE CHE ESTRAE I PRODOTTI IN VENDITA
        $dbconnstring = 'mysql:dbname=shop;host=localhost:3306';
        $dbuser = 'root';
        $dbpasswd = '';
       $query="SELECT * FROM products";

        $db = new PDO($dbconnstring, $dbuser, $dbpasswd);

        $query_risult= $db->query("SELECT * FROM products ");
 

            while($row = $query_risult->fetch()) {
              $arrayProd[]=array("name"=>$row["name"],"type"=>$row["type"],"price"=>$row["price"],"img"=>$row["img"],/*"img"=>base64_encode($row["img"]),*/"id"=>$row["Id"]);
             }
             echo json_encode($arrayProd);

       }else
         if($data["function"]=="addNewProducts"){
            //FUNZIONE CHE AGGIUNGE UN NUOVO PRODOTTO IN VENDITA(admin)
            $idP=$data["idP"];
            $lastIndex=get_last_index();
            echo($lastIndex);

             }else 
         
         
                if($data["function"]=="saveData"){
                    //FUNZIONE CHE SALVA LE MODOFICHE SUI PRODOTTI IN VENDITA(admin)
                $nameP=$data["nomeP"];
                $typeP=$data["typeP"];
                $priceP=$data["priceP"];
                $idP=$data["id"];
                $newImagePath='C:\xampp\htdocs\Progetto-Finale-Tweb\upload\\'.'idP'.$idP.'.jpg';

                $newImage=file_get_contents($newImagePath);
                $newImageEncoded=base64_encode($newImage);
                
                //echo($newImageEncoded."\n\n");


                
            if(check_if_exist_product($idP)){
                    update_product($idP,$nameP,$typeP,$priceP,$newImageEncoded);
                }else{
                    add_product($idP,$nameP,$typeP,$priceP,$newImageEncoded);
                }
                unlink($newImagePath);


               /* $lastIndex=get_last_index();
                $arrayIndex=array("index"=>$lastIndex);
                echo(json_encode($arrayIndex));*/
               // $_SESSION["flash"]="Modifiche aggiornate";
        
                    }else 
                if($data["function"]=="delete"){
                    //FUNZIONE CHE ELIMINA UN PRODOTTO DALLA VENTIDA(admin)

                    $idP=$data["idP"];
                
                    delete_product($idP);


                }else
                if($data["function"]=="addToBasket"){
                    //FUNZIONE CHE AGGIUNGE UN PRODOTTO NEL CARRELLO(user)
                    $email=$_SESSION["email"];
                    $password =$_SESSION["password"];
                    $idP=$data["idP"];

                    addToBasket($email,$password,$idP);
                    }else if($data["function"]=="delBasketProduct"){
                        $email=$_SESSION["email"];
                        $idP=$data["idP"];

                        delete_basket_product($email,$idP);

                } else 
                if($data["function"]=="decBasketQty"){
                    //FUNZIONE CHE DECREMENTA LA QUANTITA' DI UN PRODOTTO NEL CARRELLO
                    



                        $email=$_SESSION["email"];
                        $idP=$data["idP"];
                        
                        decBasketQty($email,$idP);
                }else
                 if($data["function"]=="incBasketQty"){
                    //FUNZIONE CHE INCREMENTA LA QUANTITA' DI PRODOTTO DEL CARRELLO
                    
                    $email=$_SESSION["email"];
                    $idP=$data["idP"];

                    incBasketQty($email,$idP);
                }






?>
