<?php include("topAdmin.php"); ?>

<?php if (isset($_SESSION["email"])) { ?>
  
  <form id="logout" action="logout.php" method="post">
    <input type="submit" value="Log out" >
    <input type="hidden" name="logout" value="true" >
  </form>
<?php } else { ?>
  <h2>Log in</h2>
  <form id="login" action="adminlogin.php" method="post">
    <dl>
      <dt>Email</dt>     <dd><input type="text" name="email" ></dd>
      <dt>Password</dt> <dd><input type="password" name="password" ></dd>
      <dt> </dt>        <dd><input type="submit" value="Log in" ></dd>
    </dl>
  </form>
<?php } ?>

<?php include("bottom.php"); ?>
