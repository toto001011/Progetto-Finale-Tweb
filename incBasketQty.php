<?php
# The student login form submits to here.
# Upon login, remembers student login name in a PHP session variable.
include("db.php");
if (isset($_SESSION)){



$nome=$_SESSION["name"];
  $password =$_SESSION["password"]; //$_POST['password'];
$idP=$_POST["idP"];
  // $_SESSION["name"] = $name;     # start session, remember user info

  incBasketQty($nome,$password,$idP);
  //header("Location: basket.php");
  //header("Refresh:0");
   //redirect("basket.php", "h");
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
