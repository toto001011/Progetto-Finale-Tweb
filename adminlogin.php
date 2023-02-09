<?php
# The student login form submits to here.
# Upon login, remembers student login name in a PHP session variable.
include("db.php");
if (isset($_REQUEST["email"]) && isset($_REQUEST["password"])) {
  session_start();
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  if (is_admin_password_correct($email, md5($password)) ) {
   
    $_SESSION["admin"] = $email;     # start session, remember user info
    $_SESSION["email"] = $email;
   // if(isset($currentPage)) 
       // redirect($currentPage, "Login successful! Welcome back.");
      // else 
        redirect("productsAdmin.php", "Login avvenuto con successo");
        session_destroy();
    }
    else {
        redirect("admin.php", "Email o password incorretti");
        session_destroy();
    }
}


?>
