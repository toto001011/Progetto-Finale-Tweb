<?php
# This page shows a login form for the student to log out of the system.
require_once("db.php");
if (!isset($_SESSION)) {
  session_start();
  if (isset($_SESSION["email"])) {
    unset($_SESSION["email"]);
  }
  if (isset($_SESSION["password"])) {
    unset($_SESSION["password"]);
  }
}

session_destroy();
session_start();
redirect("index.php", "Logout successful.");
session_destroy();

?>
