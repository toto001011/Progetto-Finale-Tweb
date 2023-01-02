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
function get_grades($name) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  return $db->query("SELECT * 
                     FROM products
                     ");
}

# Returns all teachers the given student has had, as an associative array.
function get_teachers($name) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  return $db->query("SELECT DISTINCT t.name AS teachername
                     FROM grades g
                     JOIN students s ON g.student_id = s.id
                     JOIN courses c  ON c.id = g.course_id
                     JOIN teachers t ON t.id = c.teacher_id
                     WHERE s.name = $name");
}

# Redirects current page to login.php if user is not logged in.
function ensure_logged_in($visitedPage="index.php") {
  
  $_SESSION["currentPage"] = $visitedPage;

  if (!isset($_SESSION["name"])) {
    redirect("user.php", "You must log in before you can view $visitedPage.");
  }
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
