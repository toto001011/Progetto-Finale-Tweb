<?php
include("db.php");
ensure_logged_in();
?>

<?php include("top.php"); ?>
<h2>Prodotti in vendita:</h2>

<div id="productsDiv">





</div>

<div class="head">
    <div class="head_prod">Nome prodotto</div>
    <div class="head_prod">Categoria</div>
    <div class="head_prod">Prezzo</div>
    <div class="head_prod">Descrizione</div>
    <div class="head_prod">Immagine</div>
  </div>
<div id="productstable"></div>


  


<?php include("bottom.php"); ?>
