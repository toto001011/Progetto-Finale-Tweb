<?php
# Shows all grades a student has earned. Student must be logged in.
include("db.php");
ensure_logged_in("products.php");
?>

<?php include("top.php"); ?>
<h2>Prodotti in vendita:</h2>

<p id="productsDiv">





</p>


<table id="productstable">
  <tr><th>Nome prodotto</th><th>Categoria</th><th>Prezzo</th><th>Immagine</th></tr>

  
</table>
  


<?php include("bottom.php"); ?>
