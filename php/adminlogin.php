<?php
/**
 * Pagina di gestione del login dell'utente amministratore
 */
include("db.php");
if (isset($_REQUEST["email"]) && isset($_REQUEST["password"])) {
  session_start();
  $email = $_REQUEST["email"];
  $password = $_REQUEST["password"];
  if (is_admin_password_correct($email, md5($password)) ) {
   
    $_SESSION["admin"] = $email;     
    $_SESSION["email"] = $email;
  
        redirect("indexAdmin.php", "Login avvenuto con successo");
        session_destroy();
    }
    else {
        redirect("admin.php", "Email o password incorretti");
        session_destroy();
    }
}


?>
