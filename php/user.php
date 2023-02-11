<!-- File che definisce della pagina di login dei clienti-->

<?php include("top.php"); ?>

<?php if (isset($_SESSION["email"])) { ?>
  <h2>User Status</h2>
  <p>You are logged in as <?= $_SESSION["email"] ?>.</p>

  
  
  <form id="logout" action="logout.php" method="post">
    <input type="submit" value="Log out" >
    <input type="hidden" name="logout" value="true" >
  </form>
<?php } else { ?>
  <h2>Log in</h2>
  <form id="login" action="login.php" method="post">
    <dl>
      <dt>Email</dt>     <dd><input type="email" name="email" ></dd>
      <dt>Password</dt> <dd><input type="password" name="password" ></dd>
      <dt> </dt>        <dd><button type="submit"  >Log in</button></dd>
    </dl>
  </form>
  <a href="newUser.php"> Non ancora registrato?</a><br>
  <a href="admin.php"> Sei il proprietario?</a>
<?php } 
  ?>

<?php include("bottom.php"); ?>
