<?php
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
        redirect("index.php", "Login avvenuto con successo.");
       //echo("Login successful! Welcome back.");
       session_destroy();
    }
    else {
        redirect("user.php", "Email o password incorretti.");
        session_destroy();
    }
}


?>
