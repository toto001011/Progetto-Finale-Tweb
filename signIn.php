<?php
include("db.php");
if (isset($_REQUEST["email"]) && isset($_REQUEST["password1"])&& isset($_REQUEST["password2"])) {
  $email = $_REQUEST["email"];
  $password1 = $_REQUEST["password1"];
  $password2 = $_REQUEST["password2"];
  $nome=$_REQUEST["name"];

  if(check_if_exist($email)==TRUE){
    redirect("user.php", "Hai già un account, perfavore accedi");
  }


  

  if($password1===$password2 ){
    if( (strrpos($email, "@")===false) || (strrpos($email, ".") === false)){
      redirect("newUser.php", "Inserire una email valida");
    }
    sign_new_user($nome,md5($password1),$email);
    session_start();
    $_SESSION["email"] = $email;     # start session, remember user info
    
       redirect("index.php", "Accesso avvenuto con successo, Benvenuto.");
       session_destroy();
    }else{
        redirect("newUser.php", "Le password non corrispondono!");
        session_destroy();
    }
   }
  
    

    
    
    
    


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
