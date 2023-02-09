
function check_password(password1,password2){
  var password1 = document.getElementById("password1").value;
  var password2 = document.getElementById("password2").value;

  if(password1===password2){
    alert("PASSWORD UGUALI"+password1+password2);
   
   
  }else{
    alert("PASSWORD DIVERSE"+password1+password2);
  }


}
/*
$(document).ready(function(){
   $("#signInbtn").on('click',function(){
    var password1 = document.getElementById("password1").value;
  var password2 = document.getElementById("password2").value;

  if(password1===password2){
    alert("PASSWORD UGUALI"+password1+password2);
   
   
  }else{
    alert("PASSWORD DIVERSE"+password1+password2);
  }

      })
    })

*/
