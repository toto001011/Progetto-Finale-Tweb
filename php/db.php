<?php

$dbconnstring = 'mysql:dbname=shop;host=localhost:3306';
$dbuser = 'root';
$dbpasswd = '';

if (!isset($_SESSION)) { session_start(); }



/**
 * Verifica che la passord data come input sia esatta per quel determinato user($email)
 * @param $email: definisce l'utente
 * @param $password: definisce la password da verificare 
 * 
 * @return: true se è corretta, false altrimenti
 *  */ 
function is_password_correct($email, $password) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $email = $db->quote($email);
  $rows = $db->query("SELECT password FROM clienti WHERE email = $email ");
  if ($rows) {
    foreach ($rows as $row) {
      $correct_password = $row["password"];
      return $password === $correct_password;
    }
  } else {
    return FALSE;   
  }
}


/**
 * Verifica che la passord data come input sia esatta per l'utente admin e che 
 * l'utente fornito sia effettivamente admin
 * 
 * @param $user: definisce l'utente da verificare 
 * @param $password: definisce la password da verificare 
 * 
 * @return: true se è corretta ed esiste un utende admin chiamato $user, false altrimenti
 *  */ 
function is_admin_password_correct($user, $password){
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($user);
  $rows = $db->query("SELECT password FROM clienti WHERE name= '$user' AND email='$user' AND admin=true ");
  if ($rows) {
    foreach ($rows as $row) {
      $correct_password = $row["password"];
      return $password === $correct_password;
    }
  } else { 
    return FALSE;   
  }
}



/*
if (isset($_POST['get_all_products'])) {
  function get_all_products() {
    global $dbconnstring, $dbuser, $dbpasswd;
    $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
    return $db->query("SELECT * 
                      FROM products
                      ");
  }
}
*/
/**
 *Modifica nel db un determinato prodotto con le nuove informazioni
 * 
 * @param $idP: identifica il prodotto che bisogna aggiornare
 * @param $nameP: nome del prodotto che verrà salvato 
 * @param $typeP tipo del prodotto che verrà salvato 
 * @param $priceP prezzo del prodotto che verrà salvato 
 * @param $newImage immagine del prodotto che verrà salvato 
 * @param $desc   descrizione del prodotto che verrà salvato 
 * 
 * @return: void
 *  */ 
function update_product($idP,$nameP,$typeP,$priceP,$newImage,$desc){
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $idP = $db->quote($idP);
 
  if($newImage!=""){
    $rows = $db->query("UPDATE products SET name='$nameP',type='$typeP', price='$priceP',img='$newImage',description='$desc'  WHERE id=$idP");
  }else{
    $rows = $db->query("UPDATE products SET name='$nameP',type='$typeP', price='$priceP',description='$desc'  WHERE id=$idP");
  }
  
}
/**
 *Controlla che il prodotto esiste già nel db
 * 
 * @param $idP: identifica il prodotto di cui verificare l'esistenza
 * 
 * @return: 1 se esiste, 0 altrimenti
 */

function  check_if_exist_product($idP){

  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
   $idP = $db->quote($idP);
   $query_exist = $db->query("SELECT COUNT(name) FROM products WHERE id=$idP");
  $exist = $query_exist->fetchColumn();  
  if($exist>0){
    return 1;
  }else{
    return 0;
  }
}

/**
 *Aggiunge nel db un nuovo prodotto
 * 
 * @param $idP: identifica il nuovo prodotto(dato in modo progressivo in base all'inserimento)
 * @param $nameP: nome del prodotto che verrà salvato 
 * @param $typeP tipo del prodotto che verrà salvato 
 * @param $priceP prezzo del prodotto che verrà salvato 
 * @param $Image immagine del prodotto che verrà salvato 
 * @param $desc   descrizione del prodotto che verrà salvato 
 * 
 * @return: void
 *  */ 
function add_product($idP,$nameP,$typeP,$priceP,$Image,$desc){
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $idP = $db->quote($idP);

  if(isset($Image)){
    $query = $db->query("INSERT INTO products  values ($idP,'$nameP','$typeP', '$priceP', '$Image' ,'$desc' )");
  }else{
    $rows = $db->query("INSERT INTO products  values ( $idP, '$nameP','$typeP', '$priceP',' ','$desc')");
  }
  
}

/**
 *Elimina il prodotto nel db
 * 
 * @param $idP: identifica il prodotto da eliminare
 * 
 * @return: void
 */
function delete_product($idP){
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $idP = $db->quote($idP);

  $query = $db->query("DELETE FROM products WHERE Id='$idP'");
  
  
}

/**
 *Aggiunge nel db un nuovo cliente(user)
 * 
 * @param $name: Nome del nuovo cliente
 * @param $password: Passqword del nuovo cliente
 * @param $email: Email del cliente che lo indentifica univocamente nel db
 * 
 * @return: void
 *  */ 
function sign_new_user($name,$password,$email) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $name = $db->quote($name);
  $password = $db->quote($password);
  $email = $db->quote($email);
   $db->query("INSERT INTO clienti values('',$email,$name,$password,'false')");
}

/**
 *Controlla che il cliente esiste già nel db
 * 
 * @param $email: identifica il cliente di cui verificare l'esistenza
 * 
 * @return: 1 se esiste, 0 altrimenti
 */
function  check_if_exist($email){

  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
   $email = $db->quote($email);
   $query_exist = $db->query("SELECT COUNT(email) FROM clienti WHERE email=$email");
  $exist = $query_exist->fetchColumn();  
  return $exist;
}



/**
 *Aggiunge nel carrello di un determinato cliente un determinato prodotto 
 *oppure se già presente ne aumenta la quantità
 * 
 * @param $email: identifica il cliente 
 * @param $idP: identifica il prodotto da mettere nel carrello
 * 
 * @return: 1 se esiste, 0 altrimenti
 */
function addToBasket($email,$idP) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $email = $db->quote($email);
  
  $query_idC=$db->query("SELECT id FROM clienti WHERE email=$email ");
  $idC = $query_idC->fetchColumn();  



  $alredyBuy_query=$db->query("SELECT COUNT(idC) FROM carrello WHERE idP=$idP AND idC=$idC ");  
  $alredyBuy = $alredyBuy_query->fetchColumn();  

  
  if($alredyBuy>0){
    $query_act_qty=$db->query("SELECT qty FROM carrello WHERE idP=$idP AND idC=$idC ");
    $act_qty = $query_act_qty->fetchColumn();
    $act_qty=$act_qty+1;
    $db->query("UPDATE carrello SET qty=$act_qty WHERE idC=$idC AND idP=$idP");
  }else{
    $db->query("INSERT INTO carrello VALUES($idC,$idP,1)");
  }
  
}

/**
 *Resituisce l'ultimo id del prodotto presente nel db
 * 
 * @return $lastIndex: identifica l'ultimo id del prodotto esistente nel db
 */

function get_last_index(){
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  
  $lastIndexRaw=$db->query("SELECT MAX(Id) FROM products"); 
  $lastIndex = $lastIndexRaw->fetchColumn();
  return $lastIndex+1;

}

/**
 * Incrementa la quantità di un determinato prodotto nel carrello
 * 
 * @param $email: identifica il cliente 
 * @param $idP: identifica il prodotto del quale incrementare la quntità
 * 
 * @return: void
 */
function incBasketQty($email,$idP) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $email = $db->quote($email);
  
  
  $query_idC=$db->query("SELECT id FROM clienti WHERE email=$email");
  $idC = $query_idC->fetchColumn();

 $query_act_qty=$db->query("SELECT qty FROM carrello WHERE idP=$idP AND idC=$idC");
 $act_qty = $query_act_qty->fetchColumn();
 $act_qty=$act_qty+1;
  $db->query("UPDATE carrello SET qty=$act_qty WHERE idC=$idC AND idP=$idP");
  
   
}

/**
 * Decrementa la quantità di un determinato prodotto nel carrello
 * 
 * @param $email: identifica il cliente 
 * @param $idP: identifica il prodotto del quale decrementare la quntità
 * 
 * @return: void
 */
function decBasketQty($email,$idP) {
  global $dbconnstring, $dbuser, $dbpasswd;
  $db = new PDO($dbconnstring, $dbuser, $dbpasswd);
  $email = $db->quote($email);
  
  $query_idC=$db->query("SELECT id FROM clienti WHERE email=$email");
  $idC = $query_idC->fetchColumn();

 $query_act_qty=$db->query("SELECT qty FROM carrello WHERE idP=$idP AND idC=$idC");
 $act_qty = $query_act_qty->fetchColumn();
 $act_qty=$act_qty-1;
 if($act_qty>0){
  $db->query("UPDATE carrello SET qty=$act_qty WHERE idC=$idC AND idP=$idP");
 }else{
  $db->query("DELETE FROM carrello WHERE  idC=$idC AND idP=$idP");

 }
}

/**
 * Elimina  un determinato prodotto nel carrello
 * 
 * @param $email: identifica il cliente 
 * @param $idP: identifica il prodotto da eliminare
 * 
 * @return: void
 */
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





/**
 * Verifica che prima di visitare una determinata pagina l'utente sia loggato
 * 
 * @return: void
 */
function ensure_logged_in() {
  
  if (!isset($_SESSION["email"])) {
    redirect("user.php", "Devi essere loggato per visitare questa pagina.");
  }
}


/**
 * Verifica che prima di visitare una determinata pagina l'utente sia un amministratore
 * 
 * @return: void
 */function ensure_admin() {
  

  if (!isset($_SESSION["admin"])) {
    redirect("user.php", "Devi essere loggato come amministratore per visitare questa pagina.");
  }
}


/**
 * Reindirizza l'user in una determinata pagina e eventualmente mostra un messaggio per l'utente 
 * 
 * @return: void
 */
function redirect($url, $flash_message = NULL) {
  if ($flash_message) {
    $_SESSION["flash"] = $flash_message;
  }
 
  header("Location: $url");
  die;
}


?>
