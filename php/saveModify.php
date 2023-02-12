<?php
//File php che contiene parte delle funzioni che vengono usate dal javascript
include("login.php");
            /**
             * File php che contiene parte delle funzioni che vengono usate dal javascript
             * Tutte le "funzioni" hanno come @param un file json simile al seguente
             * var data{
             *  idP="1" //id del prodotto 
             * //altre informazioni 
             * }
             * 
             */
         $data = json_decode(file_get_contents('php://input'), true);
         if($data["function"]=="visualize_basket"){
           /*
             Porzione che visualizza i prodotti del carrello
            @return una array di file json {
                name:"nome Prodotto",
                type:"tipo Prodotto",
                price:"Prezzo Prodotto",
                img:"immagine",
                id:"id",
                qty:"quantità"
            }

            
            */
        
        $dbconnstring = 'mysql:dbname=shop;host=localhost:3306';
        $dbuser = 'root';
        $dbpasswd = '';
        
        $email=$_SESSION["email"];
        $db = new PDO($dbconnstring, $dbuser, $dbpasswd);

        $query_risult= $db->query("SELECT * FROM carrello join clienti on(idC=clienti.id) JOIN products on (idP=products.id) WHERE clienti.email='$email' ");
 
            while($row = $query_risult->fetch()) {
              $arrayProd[]=array("name"=>$row["name"],"type"=>$row["type"],"price"=>$row["price"],"img"=>$row["img"],"id"=>$row["Id"],"qty"=>$row["qty"]);
             }
             echo json_encode($arrayProd);

       }else
       if($data["function"]=="visualize_products"){
/*
             Porzione che visualizza i prodotti in vendita
            @return una array di file json {
                name:"nome Prodotto",
                type:"tipo Prodotto",
                price:"Prezzo Prodotto",
                img:"immagine",
                desc:"descrizione",
                id:"id"
            }

            
            */        $dbconnstring = 'mysql:dbname=shop;host=localhost:3306';
        $dbuser = 'root';
        $dbpasswd = '';
       $query="SELECT * FROM products";

        $db = new PDO($dbconnstring, $dbuser, $dbpasswd);

        $query_risult= $db->query("SELECT * FROM products ");
 

            while($row = $query_risult->fetch()) {
              $arrayProd[]=array("name"=>$row["name"],"type"=>$row["type"],"price"=>$row["price"],"img"=>$row["img"],"desc"=>$row["description"],"id"=>$row["Id"]);
             }
             echo json_encode($arrayProd);

       }else
         if($data["function"]=="addNewProducts"){
            
            /* PORZIONE CHE AGGIUNGE UN NUOVO PRODOTTO IN VENDITA(admin)
                @param data
                
                data={
                    nomeP:"nome prodotto",
                    typeP:"tipo prodotto",
                    priceP:"prezzo prodotto",
                    id:"id prodotto",
                    desc:"descrizione prodotto",
                    function:"addNewProducts"
                }

             
             */
            $idP=$data["idP"];
            $lastIndex=get_last_index();
            echo($lastIndex);

             }else

         
         
                if($data["function"]=="saveData"){
                    /*PORZIONE CHE SALVA LE MODOFICHE SUI PRODOTTI IN VENDITA(admin)
                @param data
                
                data={
                    nomeP:"nome prodotto",
                    typeP:"tipo prodotto",
                    priceP:"prezzo prodotto",
                    id:"id prodotto",
                    desc:"descrizione prodotto",
                    function:"saveData"
                }
                 
             
             */
                $nameP=$data["nomeP"];
                $typeP=$data["typeP"];
                $priceP=$data["priceP"];
                $priceP=floatval($priceP);
                $idP=$data["id"];
                $newImagePath='C:\xampp\htdocs\Progetto-Finale-Tweb\upload\\'.'idP'.$idP.'.jpg';
                $desc=$data["desc"];
                $response=array("priceType"=>true,"descLen"=>true);

                if(file_exists($newImagePath)==1){
                    $newImage=file_get_contents($newImagePath);
                    $newImageEncoded=base64_encode($newImage);
                }else{
                    $newImageEncoded="";
                }
               
                $response["priceType"]=$priceP;
                if(strlen($desc)>500){
                   $response["descLen"]=false;

                }


                
            if(check_if_exist_product($idP)){
                    update_product($idP,$nameP,$typeP,$priceP,$newImageEncoded,$desc);
                }else{
                    add_product($idP,$nameP,$typeP,$priceP,$newImageEncoded,$desc);
                }
                if(file_exists($newImagePath)==1)
                unlink($newImagePath);


                    }else 
                if($data["function"]=="delete"){
                    
                    /*PORZIONE CHE ELIMINA UN PRODOTTO DALLA VENTIDA(admin)
                        @param data
                        data{
                            function:"delete",
                            idP:"id Prodotto"
                        }
                    */

                    $idP=$data["idP"];
                
                    delete_product($idP);


                }else
                if($data["function"]=="addToBasket"){
                    

                     
                    /*PORZIONE CHE AGGIUNGE UN PRODOTTO NEL CARRELLO(user)
                        @param data
                        data{
                            function:"addToBasket",
                            idP:"id Prodotto"
                        }
                    */

                    $email=$_SESSION["email"];
                    $password =$_SESSION["password"];
                    $idP=$data["idP"];

                    addToBasket($email,$idP);
                    }else if($data["function"]=="delBasketProduct"){
                        $email=$_SESSION["email"];
                        $idP=$data["idP"];

                        delete_basket_product($email,$idP);

                } else 
                if($data["function"]=="decBasketQty"){
                    
                     /*PORZIONE CHE DECREMENTA LA QUANTITA' DI UN PRODOTTO NEL CARRELLO
                        @param data
                        data{
                            function:"decBasketQty",
                            idP:"id Prodotto"
                        }
                    */



                        $email=$_SESSION["email"];
                        $idP=$data["idP"];
                        
                        decBasketQty($email,$idP);
                }else
                 if($data["function"]=="incBasketQty"){
                    
                    /*PORZIONE CHE INCREMENTA LA QUANTITA' DI PRODOTTO DEL CARRELLO
                        @param data
                        data{
                            function:"incBasketQty",
                            idP:"id Prodotto"
                        }
                    */

                    
                    $email=$_SESSION["email"];
                    $idP=$data["idP"];

                    incBasketQty($email,$idP);
                }






?>
