
$(document).ready(function(){
//  $("#productsBtn").on('click',function(){
  $.ajax({
    url: 'visualize_products.php',
    type: 'POST',
    data: {},
    dataType: 'json',
    success: function(response) {

    //called when successful
    console.log(response);
    $('#productsDiv').html(response);
    response=JSON.parse(JSON.stringify(response))
   
   // response = $.parseJSON(response);

          // Decode the base64-encoded image
    var imageData = atob(response[1].img);
    

    // Set the src attribute of the image object to the decoded data URI
   
   //var img = document.createElement('img');
  
    var trHTML = '';
    $.each(response, function (i, item) {
     // var dataURI = 'data:image/jpeg;base64'+response[i].img;
    
     //document.getElementById('productstable').appendChild(img)
     $('#productstable').append('<tr><td>'+response[i].name+'</td>'+'<td>'+response[i].type+'</td>'+'<td>'+response[i].price+'</td>'+ '<td id="id_td">' +'</td>' + '<td><a href="basket.php">'+"Aggiungi al carrello" +'</a></td>+</tr>');
//     $('#productstable').append('<tr>  <td id="id_td">' +'</td>' +'<td>'+response[i].name+'</td>'+'<td>'+response[i].type+'</td>'+'<td>'+response[i].price+'</td>'+  '<td><a href="basket.php">'+"Acquista" +'</a></td>+</tr>');

     $('#id_td').attr('id', 'id'+i);

     var img=new Image();
     img.src = 'data:image/png;base64,' + response[i].img;

     var imageCell = document.getElementById("id"+i);
     imageCell.innerHTML = ""; // Clear the cell's contents
     imageCell.appendChild(img); 
        
     //$('#productstable').appendChild(img);
    });
   
},
    error: function(e) {
    //called when there is an error
    console.log(e.message);
    }
    });
 // });
});


function check_password(){
  var password1 = document.getElementById("password1").value;
  var password2 = document.getElementById("password2").value;
  var nome = document.getElementById("name").value;

  if(password1===password2){
    //addToDb();
   /* $.post('signIn.php',{name:'nome'}, function(data) {
      // Handle the response from the PHP script

      alert("PHP CODE EXECUTED")
    });
    var obj = {};
    obj["name"] = "nome";


    var jsonString = JSON.stringify(nome);
*/
    $.ajax({
      type: 'POST',
      url:'signIn.php',
      //contentType: 'text',
      //dataType: 'text',
      data: "name1="+nome +"&password=" + password1   
          //name: "nome"
         
      ,
      success: function(response){
        alert("PHP CODE EXECUTED"+ response);

      },
      error: function(e) {
        //called when there is an error
        alert("PHP CODE ERROR");

        console.log(e.message);
        }
  
    });

    alert("PASSWORD UGUALI "+nome+" "+password1+" "+password2);
   
   
  }else{
    alert("PASSWORD DIVERSE"+password1+password2);
  }


}


/*
function addToDb(){
  $.ajax({
    url: 'SignIn.php',
    type: 'POST',
    data: {name:document.getElementById("password1").value,password:document.getElementById("password1").value},
   
    success: function(response) {

    //called when successful
    alert("DATA PASSED TO PHP");
    },
    error: function(e) {
    //called when there is an error
    console.log(e.message);
    }
    });
}
*/

