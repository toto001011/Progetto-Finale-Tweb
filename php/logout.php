<?php
//File che gestisce la disconnesione
require_once("db.php");

if (!isset($_SESSION)) {
  session_start();
  if (isset($_SESSION["email"])) {
    unset($_SESSION["email"]);
  }
  if (isset($_SESSION["password"])) {
    unset($_SESSION["password"]);
  }
  if (isset($_SESSION["admin"])) {
    unset($_SESSION["admin"]);
  }
}

session_destroy();

session_start();
redirect("index.php", "Disconnessione avvenuto con successo.");
session_destroy();

?>
