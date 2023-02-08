<?php
# Shows all grades a student has earned. Student must be logged in.
include("db.php");
ensure_logged_in("products.php");
?>

<?php include("top.php"); ?>
<h2>Prodotti in vendita:</h2>

<p id="productsDiv">





</p>

<div class="head">
    <div class="head_prod">Nome prodotto</div>
    <div class="head_prod">Categoria</div>
    <div class="head_prod">Prezzo</div>
    <div class="head_prod">Immagine</div>
  </div>
<div id="productstable"></div>


  


<?php include("bottom.php"); ?>
