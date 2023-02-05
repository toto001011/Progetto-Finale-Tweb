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
 <!--
    <h1>Salvatore Online Shop</h1>
    <ul id="carrello">
        <li> <a href="basket.php"> CARRELLO </a></li>
    </ul>
-->

    <div class="navigation">
    <ul id="navigation">
      <li><a href="index.php">Main Page</a></li>
      <li><a id="productsBtn"  href="products.php">Products</a></li>
     <!-- <li><a href="teachers.php">Teachers</a></li> -->
      <li><a href="user.php">Log In/Out</a></li>
    </ul>
</div>
    <div id="carrello"  ondragover="allowDrop(event)" ondrop="drop(event)"><a href="basket.php"> CARRELLO </a></div>
    
    <?php
    if (isset($_SESSION["flash"])) {
      # temporary message across page redirects
      ?>
      <div id="flash"> <?= $_SESSION["flash"] ?> </div>
      <?php
      unset($_SESSION["flash"]);
    }
    ?>
