<?php 



include("login.php");

        $dbconnstring = 'mysql:dbname=shop;host=localhost:3306';
        $dbuser = 'root';
        $dbpasswd = '';
       $query="SELECT * FROM products";
      $email=$_SESSION["email"];
        // Create connection
        //$conn = mysqli_connect($servername, $username, $password, $database);
        $db = new PDO($dbconnstring, $dbuser, $dbpasswd);

        $query_risult= $db->query("SELECT * FROM carrello join clienti on(idC=clienti.id) JOIN products on (idP=products.id) WHERE clienti.email='$email' ");
        // Check connection
 

      
            while($row = $query_risult->fetch()) {
              $arrayProd[]=array("name"=>$row["name"],"type"=>$row["type"],"price"=>$row["price"],"img"=>base64_encode($row["img"]),"id"=>$row["Id"],"qty"=>$row["qty"]);
            // $arrayProd[]=array('name'=> $row["name"],'type'=> $row["type"],"price"=>$row["price"]);
              
              


             }
              //$res= JSON.stringify($arrayProd);
             echo json_encode($arrayProd);
             //echo json_encode($arrayProd[1]);

             

    
?>



