<?php
//File che gestisce l'accesso
include("db.php");

if (isset($_REQUEST["email"]) && isset($_REQUEST["password"])) {
  session_start();
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  
  if( (strrpos($email, "@")===false) || (strrpos($email, ".") === false)){
    redirect("user.php", "Inserire una email valida");
  }
  if (is_password_correct($email, md5($password))) {
   
    $_SESSION["email"] = $email;     # start session, remember user info
    $_SESSION["password"] = $password;
  
        redirect("index.php", "Login avvenuto con successo.");
       session_destroy();
    }
    else {
        redirect("user.php", "Email o password incorretti.");
        session_destroy();
    }
}


?>
