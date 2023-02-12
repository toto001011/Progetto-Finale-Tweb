<!-- File che definisce l'htm comune a tutte le pagine admin-->

<?php
    if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Salvatore Online Shop</title>
    <link href="../css/shop.css" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../favicon/favicon.ico">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/Visualize.js" type="text/javascript"></script>
  </head>


  <body>
 
    <h1>Salvatore Online Shop</h1>
    

    <ul id="navigation">
    <li><a id="indexAdmin"  href="indexAdmin.php">Home</a></li>
      <li><a id="productsBtn"  href="productsAdmin.php">Prodotti</a></li>
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
      
   
  
