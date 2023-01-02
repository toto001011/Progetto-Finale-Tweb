<?php
# Shows all grades a student has earned. Student must be logged in.
include("db.php");
ensure_logged_in("products.php");
?>

<?php include("top.php"); ?>
<h2>Prodotti nel carrello:</h2>

<table id="basketProductsTable">
  <tr><th>Nome prodotto</th><th>Categoria</th><th>Prezzo</th><th>Immagine</th></tr>

  <?php foreach (get_products($_SESSION["name"]) as $row) { ?>
    <tr>
      <td><?= $row["name"] ?></td><td><?= $row["type"] ?></td><td><?= $row["price"] ?>€ </td> <td> <img src="<?=  $row["img"] ?>" > </td>
    </tr>
  <?php } ?>
</table>

<ul id="pay">
        <li> <a href="basket.php"> Acquista </a></li>
</ul>
<?php include("bottom.php"); ?>
