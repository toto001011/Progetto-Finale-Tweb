<!-- File che definisce l'html della pagina dei prodotti admin -->

<?php

include("db.php");
ensure_admin();
?>

<?php include("topAdmin.php"); ?>
<h2>Prodotti in vendita:</h2>


<table id="productstable">
  <tr><th>Nome prodotto</th><th>Categoria</th><th>Prezzo</th><th>Descrizione</th><th>Immagine</th></tr>

  
</table>
<div id="newProduct">

</div>


<?php include("bottom.php"); ?>
