<?php
# Shows all grades a student has earned. Student must be logged in.
include("db.php");
ensure_logged_in("teachers.php");
?>

<?php include("top.php"); ?>

<h2>Teachers for <?= $_SESSION["name"] ?>:</h2>

<ul>
  <?php 
  foreach (get_teachers($_SESSION["name"]) as $row) { ?>
    <li> <?= $row["teachername"] ?> </li>
  <?php } ?>
</ul>

<?php include("bottom.php"); ?>
