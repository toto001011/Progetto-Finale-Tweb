<?php
include("db.php");
if (isset($_REQUEST["email"]) && isset($_REQUEST["password1"])&& isset($_REQUEST["password2"])) {
  $email = $_REQUEST["email"];
  $password1 = $_REQUEST["password1"];
  $password2 = $_REQUEST["password2"];
  $nome=$_REQUEST["name"];

  if(check_if_exist($email)==TRUE){
    redirect("user.php", "You already have an accounnt, please login");
  }
  

  if($password1===$password2){
    sign_new_user($nome,$password1,$email);
    // $_SESSION["email"] = $email;     # start session, remember user info
    $_SESSION["email"] = $email;     # start session, remember user info
    // if(isset($currentPage)) 
        // redirect($currentPage, "Login successful! Welcome back.");
        // else 
       redirect("index.php", "SignIn successful! Welcome.");
    }else{
        redirect("newUser.php", "The password doesn't match");
    }
   }
   else {
       redirect("user.php", "Incorrect user name and/or password.");
   }
       //redirect("user.php", "Login successful! Welcome back.");
    

    
    
    
    


/*








 $password =$_POST["password"]; //$_POST['password'];
  $email =$_POST["email"]; //$_POST['password'];
 // redirect("signIn.php", "SignIn successful! Welcome nome->  $nome |-------------|  pass->$password");
 
    if(strrpos("$email","@")==FALSE  ){
     
     //redirect("newUser.php", "Email not correct");
     
    }else{
        //if(check_if_exist($email)<=0){
       // sign_new_user($nome,$password,$email);
       
        //redirect("products.php", "Signin successful! Welcome .");
       // }else{
            
       //     redirect("login.php", "You have already an account, please login.");

       // }
       //echo("PHP CODE=> $email,$password");
    }
    redirect("user.php", "Signin successful! please logIn Welcome .");
    











*/





?>
