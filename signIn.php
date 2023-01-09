<?php
# The student login form submits to here.
# Upon login, remembers student login name in a PHP session variable.
include("db.php");
$nome=$_POST["name1"];//json_decode($_POST['data']);
  $password =$_POST["password"]; //$_POST['password'];
 // redirect("signIn.php", "SignIn successful! Welcome nome->  $nome |-------------|  pass->$password");
 /* if (is_password_correct($name, $password)) {
    if (isset($_SESSION)) {
        if(isset($_SESSION["currentPage"])) 
            $currentPage = $_SESSION["currentPage"];
        else {
            $currentPage = NULL;
            unset($currentPage);
        }
            
        session_destroy();
        //session_regenerate_id(TRUE);
        session_start();
    }
    $_SESSION["name"] = $name;     # start session, remember user info
    if(isset($currentPage)) 
        redirect($currentPage, "Login successful! Welcome back.");
       else 
        redirect("index.php", "Login successful! Welcome back.");
    }
    else {
        redirect("user.php", "Incorrect user name and/or password.");
    }
}*/
    sign_new_user($nome,$password);
   $_SESSION["name"] = $name;     # start session, remember user info
   redirect("user.php", "Signin successful! Welcome .");
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
