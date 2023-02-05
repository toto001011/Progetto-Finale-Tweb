<?php
# The student login form submits to here.
# Upon login, remembers student login name in a PHP session variable.
include("db.php");

if (isset($_REQUEST["email"]) && isset($_REQUEST["password"])) {
  session_start();
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  if (is_password_correct($email, md5($password))) {
   
    $_SESSION["email"] = $email;     # start session, remember user info
    $_SESSION["password"] = $password;
   // if(isset($currentPage)) 
       // redirect($currentPage, "Login successful! Welcome back.");
      // else 
        redirect("index.php", "Login successful! Welcome back.");
        session_destroy();
    }
    else {
        redirect("user.php", "Incorrect user name and/or password.");
    }
}


?>
