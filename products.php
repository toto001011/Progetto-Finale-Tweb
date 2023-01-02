<?php
# Shows all grades a student has earned. Student must be logged in.
include("db.php");
ensure_logged_in("products.php");
?>

<?php include("top.php"); ?>
<h2>Prodotti in vendita:</h2>

<div id="productsDiv">

</div>

<table id="productstable">
  <tr><th>Nome prodotto</th><th>Categoria</th><th>Prezzo</th><th>Immagine</th></tr>

  <?php foreach (get_products($_SESSION["name"]) as $row) { ?>
    <tr>
      <td><?= $row["name"] ?></td><td><?= $row["type"] ?></td><td><?= $row["price"] ?>€ </td> <td> <img src="<?=  $row["img"] ?>">  <a id="addToCard"> Aggiungi al carrello</a> </td>
    </tr>
  <?php } ?>
</table>
<?php include("bottom.php"); ?>
