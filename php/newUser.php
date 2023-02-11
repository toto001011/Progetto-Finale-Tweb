<!-- File che definisce l'html della pagina di registrazione-->
<?php include("top.php"); ?>

<?php if (isset($_SESSION["name"])) { ?>
  <h2>User Status</h2>
  <p>You are logged in as <?= $_SESSION["name"] ?>.</p>
  
  <form id="logout" action="logout.php" method="post">
    <input type="submit" value="Log out" >
    <input type="hidden" name="logout" value="true" >
  </form>
<?php } else { ?>
  <h2>Sign in</h2>
  <form id="signIn" action="signIn.php"  method="post" >
    <dl>
      <dt>Name</dt>     <dd><input type="text" name="name" id ="name"  pattern="[a-z]{>3}" required ></dd>
      <dt>Email</dt>     <dd><input type="email" name="email" id ="email"  pattern="[a-z]{>3}" required ></dd>
      <dt>Password</dt> <dd><input type="password" name="password1" id="password1"  pattern="[a-z]{>3}" required ></dd>
      <dt>Conferma password</dt> <dd><input type="password" name="password2" id="password2"  pattern="[a-z]{>3}" required ></dd>
      <dt> </dt>        <dd><input type="submit" value="Sign in"  is="signInbtn"></dd>
    </dl>
  </form>
<?php } ?>

<?php include("bottom.php"); 


?>