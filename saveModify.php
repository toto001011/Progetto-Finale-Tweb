<?php
include("db.php");
//if (isset($_REQUEST["nome"]) && isset($_REQUEST["password1"])&& isset($_REQUEST["password2"])) {
 
    
    //session_start();
 
    // $_SESSION["email"] = $email;     # start session, remember user info
   
    
    $data = json_decode(file_get_contents('php://input'), true);//accedo al file json con "php://input" e lo decodifico con "json_decode" 
    $nameP=$data["nomeP"];
    $typeP=$data["typeP"];
    $priceP=$data["priceP"];
    $newImage=$data["newImage"];
    $idP=$data["id"];
    update_data($idP,$nameP,$typeP,$priceP,$newImage);
    //$data["newImage"]=$newImage;


   


    // if(isset($currentPage)) 
        // redirect($currentPage, "Login successful! Welcome back.");
        // else 
   /*    redirect("index.php", "SignIn successful! Welcome.");
    }else{
        redirect("newUser.php", "The password doesn't match");
    }
   }
   else {
       redirect("user.php", "Incorrect user name and/or password.");
   }*/
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
