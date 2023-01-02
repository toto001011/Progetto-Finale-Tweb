




<?php 


        $servername = "localhost";
        $database = "shop";
        $username = "root";
        $password = "";
       // $query="SELECT * FROM products";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        //$query = "SELECT COUNT(*) FROM movies WHERE rank >= 8.5";

        $result = $conn->query("SELECT * FROM products");


        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
               print( $row["name"]." ".$row["type"]." ".$row["price"]." ".$row["img"]."\n");
            }
            ?><br><?php
            //echo json_encode($row);
            
          }

 

          
   
        mysqli_close($conn);
    
?>



