<?php

$dbconnstring = 'mysql:dbname=shop;host=localhost:3306';
$dbuser = 'root';
$dbpasswd = '';

if (!isset($_SESSION)) { session_start(); }



# Returns TRUE if given password is correct password for this user name.
function is_password_correct($email, $password) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($email);
  $rows = $db->query("SELECT password FROM clienti WHERE email = '$email' ");
  if ($rows) {
    foreach ($rows as $row) {
      $correct_password = $row["password"];
      return $password === $correct_password;
    }
  } else {
    return FALSE;   # user not found
  }
}

# Returns TRUE if given password is correct password for this user name.
function is_admin_password_correct($user, $password){
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($email);
  $rows = $db->query("SELECT password FROM clienti WHERE name= '$user' AND email='$user' AND admin=true ");
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

#Save data modified by admin
function update_product($idP,$nameP,$typeP,$priceP,$newImage){
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  if(isset($newImage)){
    $rows = $db->query("UPDATE products SET name='$nameP',type='$typeP', price='$priceP',img='$newImage'  WHERE id=$idP");
  }else{
    $rows = $db->query("UPDATE products SET name='$nameP',type='$typeP', price='$priceP'  WHERE id=$idP");
  }
  
}

function  check_if_exist_product($idP){

  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
   $idP = $db->quote($idP);
   $query_exist = $db->query("SELECT COUNT(name) FROM products WHERE id=$idP");
  $exist = $query_exist->fetchColumn();  //$idC = $query_idC->fetch(PDO::FETCH_ASSOC);
  //echo($exist);
  if($exist>0){
    return 1;
  }else{
    return 0;
  }
  //return $exist;
}


function add_product($idP,$nameP,$typeP,$priceP,$newImage){
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);

  if(isset($newImage)){
    $query = $db->query("INSERT INTO products  values ($idP,'$nameP','$typeP', '$priceP', '$newImage'  )");
  }else{
    $rows = $db->query("INSERT INTO products  values ( $idP, '$nameP','$typeP', '$priceP',' ')");
  }
  
}
function delete_product($idP){
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);

    $query = $db->query("DELETE FROM products WHERE Id='$idP'");
  
  
}

#Insert a new User 
function sign_new_user($name,$password,$email) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  $password = $db->quote($password);
  $email = $db->quote($email);
   $db->query("INSERT INTO clienti values('',$email,$name,$password,'false')");
}
function  check_if_exist($email){

  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
   $email = $db->quote($email);
   $query_exist = $db->query("SELECT COUNT(email) FROM clienti WHERE email=$email");
  $exist = $query_exist->fetchColumn();  //$idC = $query_idC->fetch(PDO::FETCH_ASSOC);
  return $exist;
}



#Insert a new User 
function addToBasket($email,$password,$idP) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $email = $db->quote($email);
  $password = $db->quote($password);
  
  $query_idC=$db->query("SELECT id FROM clienti WHERE email=$email ");
  $idC = $query_idC->fetchColumn();  //$idC = $query_idC->fetch(PDO::FETCH_ASSOC);



  $alredyBuy_query=$db->query("SELECT COUNT(idC) FROM carrello WHERE idP=$idP AND idC=$idC ");  //$db->query("INSERT INTO carrello VALUES($idC,$idP)");
  $alredyBuy = $alredyBuy_query->fetchColumn();  //SELECT COUNT(idP) FROM carrello WHERE idP=2 and idC=9

  
  if($alredyBuy>0){
    $query_act_qty=$db->query("SELECT qty FROM carrello WHERE idP=$idP AND idC=$idC ");
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

function get_last_index(){
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  
  $lastIndexRaw=$db->query("SELECT MAX(Id) FROM products"); 
  $lastIndex = $lastIndexRaw->fetchColumn();
  return $lastIndex+1;

}

function incBasketQty($email,$idP) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $email = $db->quote($email);
  
  
  $query_idC=$db->query("SELECT id FROM clienti WHERE email=$email");
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


function decBasketQty($email,$idP) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $email = $db->quote($email);
  
  $query_idC=$db->query("SELECT id FROM clienti WHERE email=$email");
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
function delete_basket_product($email, $idP) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  
  $query_idC = "SELECT id FROM clienti WHERE email=:email";
  $statement = $db->prepare($query_idC);
  $statement->execute(array(
    ':email' => $email
  ));
  $idC = $statement->fetchColumn();
  
  $query_del = "DELETE FROM carrello WHERE idC=:idC AND idP=:idP";
  $statement = $db->prepare($query_del);
  $statement->execute(array(
    ':idC' => $idC,
    ':idP' => $idP
  ));
}

 //$idC = $query_idC->fetchColumn();





# Redirects current page to login.php if user is not logged in.
function ensure_logged_in($visitedPage="index.php") {
  
  $_SESSION["currentPage"] = $visitedPage;

  if (!isset($_SESSION["email"])) {
    redirect("user.php", "You must log in before you can view $visitedPage.");
  }
}


# Redirects current page to login.php if user is not logged in.
function ensure_admin($visitedPage="index.php") {
  
  $_SESSION["currentPage"] = $visitedPage;

  if (!isset($_SESSION["admin"])) {
    redirect("user.php", "You must be an admin to view $visitedPage.");
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
  //session_start();
  if ($flash_message) {
    $_SESSION["flash"] = $flash_message;
  }
 // session_close();
  # session_write_close();
  header("Location: $url");
  die;
}
/*
function show($flash_message=NULL){
  $_SESSION["flash"] = $flash_message;
  die;
}*/

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
