<?php
# Shows all grades a student has earned. Student must be logged in.
include("db.php");
ensure_logged_in("basket.php");
?>

<?php include("top.php"); ?>
<h2>Prodotti nel carrello:</h2>

<div id="header"></div>

<a id="empty"> Nessun Prodotto nel Carrello</a>

<div id="basketProductsTable"></div>

<div id="checkout">
        
 <!-- <tr id="label"><th>Nome prodotto</th><th>Categoria</th><th>Prezzo</th><th>Immagine</th><th>Quantità</th></tr>-->
<div id="total"></div>
       


<div id="pay">

         <a href="basket.php"> Acquista </a>
</div>
</div>

<?php include("bottom.php"); ?>
