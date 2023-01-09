<?php
# The student login form submits to here.
# Upon login, remembers student login name in a PHP session variable.
include("db.php");
if (isset($_SESSION)){



$nome=$_SESSION["name"];
  $password =$_SESSION["password"]; //$_POST['password'];
$idP=$_GET["idP"];
  // $_SESSION["name"] = $name;     # start session, remember user info

   addToBasket($nome,$password,$idP);
   redirect("products.php", "Added to Basket");
}else{
        redirect("login.php", "You must log in before you can view this page.");
}
   //echo($name);
 //  $name=json_decode(stripslashes($_POST['data']));
 //cho("nome-> "+$nome+" pass->"+$password);
 //echo($password);

/*
   foreach($data as $d){
     echo $d;
  };
*/

      






?>
