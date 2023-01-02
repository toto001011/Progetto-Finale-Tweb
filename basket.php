<?php
# Shows all grades a student has earned. Student must be logged in.
include("db.php");
ensure_logged_in("products.php");
?>

<?php include("top.php"); ?>
<h2>Prodotti nel carrello:</h2>

<table id="basketProductsTable">
  
</table>

<ul id="pay">
        <li> <a href="basket.php"> Acquista </a></li>
</ul>
<?php include("bottom.php"); ?>
