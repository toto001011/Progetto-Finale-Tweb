<?php
    if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Salvatore Online Shop</title>
    <link href="products.css" type="text/css" rel="stylesheet">
  </head>

  <body>
    <h1>Salvatore Online Shop</h1>

    <ul id="navigation">
      <li><a href="index.php">Main Page</a></li>
      <li><a href="products.php">Products</a></li>
     <!-- <li><a href="teachers.php">Teachers</a></li> -->
      <li><a href="user.php">Log In/Out</a></li>
    </ul>
    
    <?php
    if (isset($_SESSION["flash"])) {
      # temporary message across page redirects
      ?>
      <div id="flash"> <?= $_SESSION["flash"] ?> </div>
      <?php
      unset($_SESSION["flash"]);
    }
    ?>
