<?php
# The student login form submits to here.
# Upon login, remembers student login name in a PHP session variable.
include("db.php");
if (isset($_SESSION)){



$nome="Salvatore";//$_SESSION["name"];
  $password ="salva";//$_SESSION["password"]; //$_POST['password'];
$idP=1;//$_POST["idP"];
  // $_SESSION["name"] = $name;     # start session, remember user info

  incBasketQty($nome,$password,$idP);
   //redirect("basket.php", "");
   echo("PHP EXECUTED");
}else{
       // redirect("login.php", "You must log in before you can view this page.");
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
