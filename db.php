<?php

$dbconnstring = 'mysql:dbname=shop;host=localhost:3306';
$dbuser = 'root';
$dbpasswd = '';

if (!isset($_SESSION)) { session_start(); }

# Returns TRUE if given password is correct password for this user name.
function is_password_correct($name, $password) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  $rows = $db->query("SELECT password FROM clienti WHERE name = $name");
  if ($rows) {
    foreach ($rows as $row) {
      $correct_password = $row["password"];
      return $password === $correct_password;
    }
  } else {
    return FALSE;   # user not found
  }
}

# Returns all grades for the given student, as an associative array.
function get_products($name) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  return $db->query("SELECT * 
                     FROM products
                     ");
}


# Redirects current page to login.php if user is not logged in.
function ensure_logged_in($visitedPage="index.php") {
  
  $_SESSION["currentPage"] = $visitedPage;

  if (!isset($_SESSION["name"])) {
    redirect("user.php", "You must log in before you can view $visitedPage.");
  }
}

# Write in db the articles added in the basket.
function push_addedToBasket($name) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  return $db->query("SELECT * 
                     FROM products
                     ");
}

# Redirects current page to the given URL and optionally sets flash message.
function redirect($url, $flash_message = NULL) {
  if ($flash_message) {
    $_SESSION["flash"] = $flash_message;
  }
  # session_write_close();
  header("Location: $url");
  die;
}
?>
