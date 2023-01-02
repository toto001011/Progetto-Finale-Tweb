<?php
# Shows all grades a student has earned. Student must be logged in.
include("db.php");
ensure_logged_in("grades.php");
?>

<?php include("top.php"); ?>
<h2>Grades for <?= $_SESSION["name"] ?>:</h2>

<table id="gradestable">
  <tr><th>Course Name</th><th>Grade</th></tr>

  <?php foreach (get_grades($_SESSION["name"]) as $row) { ?>
    <tr>
      <td><?= $row["name"] ?></td><td><?= $row["type"] ?></td><td><?= $row["price"] ?> </td> <td> <img src="<?=  $row["img"] ?>"></td>
    </tr>
  <?php } ?>
</table>
<?php include("bottom.php"); ?>
