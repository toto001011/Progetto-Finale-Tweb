<?php
# The student login form submits to here.
# Upon login, remembers student login name in a PHP session variable.
include("db.php");
if (isset($_REQUEST["email"]) && isset($_REQUEST["password"])) {
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  if (is_admin_password_correct($email, $password) ) {
   
    $_SESSION["admin"] = $email;     # start session, remember user info
   // if(isset($currentPage)) 
       // redirect($currentPage, "Login successful! Welcome back.");
      // else 
        redirect("productsAdmin.php", "Login successful! Welcome back.");
    }
    else {
        redirect("user.php", "Incorrect user name and/or password.");
    }
}


?>
