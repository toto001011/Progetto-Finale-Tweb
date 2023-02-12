<!-- File che definisce l'htm comune a tutte le pagine clienti-->
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


    <div class="navigation">
    <ul id="navigation">
      <li><a href="index.php">Home</a></li>
      <li><a id="productsBtn"  href="products.php">Prodotti</a></li>
      <li><a href="user.php">Log In/Out</a></li>
    </ul>
</div>
    <div id="carrello"  ondragover="allowDrop(event)" ondrop="drop(event)"><a href="basket.php"> CARRELLO </a></div>
    
   
      <div id="flash"> 

    </div>
    <?php
    if (isset($_SESSION["flash"])) {
      ?>
      <div id="msg"> <?= $_SESSION["flash"] ?> </div>
      <?php
      unset($_SESSION["flash"]);
    }
    ?>
