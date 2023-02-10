<?php
    if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Salvatore Online Shop</title>
    <link href="products.css" type="text/css" rel="stylesheet">
    <script src="jquery-3.6.1.js"></script>
    <script src="Visualize.js" type="text/javascript"></script>
     <script scr="checkPassword.js" type="text/javascript"></script> 

  </head>


  <body>
 
    <h1>Salvatore Online Shop</h1>
    

    <ul id="navigation">
    <li><a id="indexAdmin"  href="indexAdmin.php">Main Page</a></li>
      <li><a id="productsBtn"  href="productsAdmin.php">Products</a></li>
      <li><a href="admin.php">Log In/Out</a></li>
    </ul>
    
    
      
      <div id="flash" > 
       
       </div>
       <?php
    if (isset($_SESSION["flash"])) {
      # temporary message across page redirects
      ?>
      <div id="msg"> <?= $_SESSION["flash"] ?> </div>
      <?php
      unset($_SESSION["flash"]);
    }
    ?>
      
   
  
