




<?php 




        $dbconnstring = 'mysql:dbname=shop;host=localhost:3306';
        $dbuser = 'root';
        $dbpasswd = '';
       $query="SELECT * FROM products";

        // Create connection
        //$conn = mysqli_connect($servername, $username, $password, $database);
        $db = new PDO($dbconnstring, $dbuser, $dbpasswd);

        $query_risult= $db->query("SELECT * FROM products ");
        // Check connection
 

      
            while($row = $query_risult->fetch()) {
              $arrayProd[]=array("name"=>$row["name"],"type"=>$row["type"],"price"=>$row["price"],"img"=>$row["img"],/*"img"=>base64_encode($row["img"]),*/"id"=>$row["Id"]);
            // $arrayProd[]=array('name'=> $row["name"],'type'=> $row["type"],"price"=>$row["price"]);
              
              


             }
              //$res= JSON.stringify($arrayProd);
             echo json_encode($arrayProd);
             //echo json_encode($arrayProd[1]);

             

    
?>


