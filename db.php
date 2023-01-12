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

if (isset($_POST['get_all_products'])) {
  # Returns all grades for the given student, as an associative array.
  function get_all_products() {
    global $dbconnstring, $dbuser, $dbpasswd;
    $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
    return $db->query("SELECT * 
                      FROM products
                      ");
  }
}
#Insert a new User 
function sign_new_user($name,$password,$email) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  $password = $db->quote($password);
  $email = $db->quote($email);
   $db->query("INSERT INTO clienti values('',$email,$name,$password)
                     ");
}

#Insert a new User 
function addToBasket($name,$password,$idP) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  $password = $db->quote($password);
  
  $query_idC=$db->query("SELECT id FROM clienti WHERE name=$name");
  $idC = $query_idC->fetchColumn();  //$idC = $query_idC->fetch(PDO::FETCH_ASSOC);



  $alredyBuy_query=$db->query("SELECT COUNT(idC) FROM carrello WHERE idP=$idP AND idC=$idC");  //$db->query("INSERT INTO carrello VALUES($idC,$idP)");
  $alredyBuy = $alredyBuy_query->fetchColumn();  //SELECT COUNT(idP) FROM carrello WHERE idP=2 and idC=9

  
  if($alredyBuy>0){
    $query_act_qty=$db->query("SELECT qty FROM carrello WHERE idP=$idP AND idC=$idC");
    $act_qty = $query_act_qty->fetchColumn();
    $act_qty=$act_qty+1;
    $db->query("UPDATE carrello SET qty=$act_qty WHERE idC=$idC AND idP=$idP");
  }else{
    $db->query("INSERT INTO carrello VALUES($idC,$idP,1)");
  }
   /*/$db->query("SELECT * FROM carrello
              WHERE idC in (SELECT id FROM clienti WHERE name=$name)
                    ");*/
}

#Insert a new User 
function incBasketQty($name,$password,$idP) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  $password = $db->quote($password);
  
  $query_idC=$db->query("SELECT id FROM clienti WHERE name=$name");
  //$idC = $query_idC->fetch(PDO::FETCH_ASSOC);
  $idC = $query_idC->fetchColumn();

 $query_act_qty=$db->query("SELECT qty FROM carrello WHERE idP=$idP AND idC=$idC");
 $act_qty = $query_act_qty->fetchColumn();
 $act_qty=$act_qty+1;
  //$db->query("INSERT INTO carrello VALUES($idC,$idP)");
  $db->query("UPDATE carrello SET qty=$act_qty WHERE idC=$idC AND idP=$idP");
  
   /*/$db->query("SELECT * FROM carrello
              WHERE idC in (SELECT id FROM clienti WHERE name=$name)
                    ");*/
}

#Insert a new User 
function decBasketQty($name,$password,$idP) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  $password = $db->quote($password);
  
  $query_idC=$db->query("SELECT id FROM clienti WHERE name=$name");
  //$idC = $query_idC->fetch(PDO::FETCH_ASSOC);
  $idC = $query_idC->fetchColumn();

 $query_act_qty=$db->query("SELECT qty FROM carrello WHERE idP=$idP AND idC=$idC");
 $act_qty = $query_act_qty->fetchColumn();
 $act_qty=$act_qty-1;
 if($act_qty>0){
  //$db->query("INSERT INTO carrello VALUES($idC,$idP)");
  $db->query("UPDATE carrello SET qty=$act_qty WHERE idC=$idC AND idP=$idP");
 }else{
  $db->query("DELETE FROM carrello WHERE  idC=$idC AND idP=$idP");

 }
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
  $query_idC=$db->query("SELECT id FROM clienti WHERE name=$name");
  //$idC = $query_idC->fetch(PDO::FETCH_ASSOC);
  $idC = $query_idC->fetchColumn();
  return $db->query("SELECT * 
                     FROM products
                     WHERE idC=$idC");
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

function showProd(){
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  

  if ($result->num_rows > 0) {
    // output data of each rows
  
    while($row = $result->fetch_assoc()) {
       $arrayProd=array($row["name"],$row["type"],$row["price"],$row["img"]);

        $prod=json_encode($arrayProd);
        echo $prod;

     //s  print( $row["name"]." ".$row["type"]." ".$row["price"]." ".$row["img"]."\n");
    }
    
    
  }
}
?>
