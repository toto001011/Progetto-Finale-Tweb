<?php

include("db.php");

   
         $data = json_decode(file_get_contents('php://input'), true);
            
   
   
        $idP=$data["idP"];
       
        delete_product($idP)


    
   


    


  
          
      










?>
