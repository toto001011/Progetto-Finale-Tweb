<?php
# Shows all grades a student has earned. Student must be logged in.
include("db.php");
ensure_logged_in("basket.php");
?>

<?php include("top.php"); ?>
<h2>Prodotti nel carrello:</h2>

<table id="basketProductsTable">
  <a id="empty"> Nessun Prodotto nel Carrello</a>
 <!-- <tr id="label"><th>Nome prodotto</th><th>Categoria</th><th>Prezzo</th><th>Immagine</th><th>Quantità</th></tr>-->

</table>
<ul id="checkout">
        
       
</ul>

<ul id="pay">

        <li> <a href="basket.php"> Acquista </a></li>
</ul>

<?php include("bottom.php"); ?>
