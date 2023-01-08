




<?php 




        $dbconnstring = 'mysql:dbname=shop;host=localhost:3306';
        $dbuser = 'root';
        $dbpasswd = '';
       $query="SELECT * FROM products";

        // Create connection
        //$conn = mysqli_connect($servername, $username, $password, $database);
        $db = new PDO($dbconnstring, $dbuser, $dbpasswd);

        $query_risult= $db->query("SELECT * FROM clienti ");
        // Check connection
        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        //$query = "SELECT COUNT(*) FROM movies WHERE rank >= 8.5";

       // $result = $conn->query($query);


       // if ($result->num_rows > 0) {
            // output data of each rows
          
            
            echo $query_risult["nome"];
            
         // }

 

          
   
       // mysqli_close($conn);
    
?>



