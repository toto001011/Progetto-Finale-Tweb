if (document.location.href.match("products.php")){
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
   // var imageData = atob(response[1].img);
    

    // Set the src attribute of the image object to the decoded data URI
   
   //var img = document.createElement('img');
  
    var trHTML = '';
    $.each(response, function (i, item) {
     // var dataURI = 'data:image/jpeg;base64'+response[i].img;
    
     //document.getElementById('productstable').appendChild(img)
     $('#productstable').append('<tr><td>'+response[i].name+'</td>'+'<td>'+response[i].type+'</td>'+'<td>'+response[i].price+'</td>'+ '<td id="id_td">' +'</td>' + '<td><a href="addToBasket.php" id="idP">'+"Aggiungi al carrello" +'</a></td>+</tr>');
//     $('#productstable').append('<tr>  <td id="id_td">' +'</td>' +'<td>'+response[i].name+'</td>'+'<td>'+response[i].type+'</td>'+'<td>'+response[i].price+'</td>'+  '<td><a href="basket.php">'+"Acquista" +'</a></td>+</tr>');
      $idP=response[i].id;
     $('#id_td').attr('id', 'id'+$idP);
     //?compna=",$compname,"
     $('#idP' ).prop("href", "addToBasket.php?idP="+$idP);
     $('#idP').attr('id', 'idP'+$idP);
     var img=new Image();
     img.src = 'data:image/png;base64,' + response[i].img;

     var imageCell = document.getElementById("id"+$idP);
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
}

if (document.location.href.match("basket.php")){
$(document).ready(function(){
  //  $("#productsBtn").on('click',function(){
    $.ajax({
      url: 'visualize_basket.php',
      type: 'POST',
      data: {},
      dataType: 'json',
      success: function(response_basket) {
  
      //called when successful
      console.log(response_basket);
      $('#basketProductsTable').append("<th>Nome prodotto</th><th>Categoria</th><th>Prezzo</th><th>Immagine</th><th>Quantità</th></tr>")
      $('#productsDiv').html(response_basket);
      response=JSON.parse(JSON.stringify(response_basket))
    
      var trHTML = '';
      var totBasket=0;
      //$('#empty').innerHTML=" ";
      document.getElementById("empty").innerHTML=" ";
      $.each(response_basket, function (i, item) {

        $idP=response_basket[i].id;      
       $('#basketProductsTable').append('<tr><td>'+response_basket[i].name+'</td>'+'<td>'+response_basket[i].type+'</td>'+'<td>'+response_basket[i].price+'€ </td>'+ '<td id="id_td">' +'</td><td>'+'<button id="btnDec" type="button" onclick="decBasketQty()"> -' +'</button>'+ " "+response_basket[i].qty+" "+'<button type="button" onclick="incBasketQty()" id="btnInc"> +' +'</button>'+'</td></tr>');
      
       totBasket=totBasket+response_basket[i].price*response_basket[i].qty;  
       
       $('#id_td').attr('id', 'id'+$idP);
       
       $('#btnInc' ).attr("onclick", "incBasketQty("+$idP+")");
       $('#btnDec' ).attr("onclick", "decBasketQty("+$idP+")");

       $('#btnInc').attr('id', 'btnInc'+$idP);
       $('#btnDec').attr('id', 'btnDec'+$idP);


       $('#idP').attr('id', 'idP'+$idP);
       var img=new Image();
       img.src = 'data:image/png;base64,' + response_basket[i].img;
  
       var imageCell = document.getElementById("id"+$idP);
       imageCell.innerHTML = ""; // Clear the cell's contents
       imageCell.appendChild(img); 
          
       //$('#productstable').appendChild(img);
      });
      $('#checkout').append('<li><a><h3>'+ "TOTALE: "+ totBasket+"€"+'</h3></a></li>');
      
  },
      error: function(e) {
      //called when there is an error
      console.log(e.message);
      }
      });
   // });
  });
}

if (document.location.href.match("productsAdmin.php")){
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
  
    var trHTML = '';
    $.each(response, function (i, item) {
     // var dataURI = 'data:image/jpeg;base64'+response[i].img;
    
     //document.getElementById('productstable').appendChild(img)
     $('#productstable').append('<tr id="prodotto"><td>'+'<input id="nameP" type ="text" value="'+response[i].name+'"> </input>'+'</td>'+'<td>'+'<input id="typeP" type ="text" value="'+response[i].type+'"> </input>'+'</td>'+'<td>'+'<input id="priceP" type ="text" value="'+response[i].price+'"> </input>'+'</td>'+ '<td id="id_td">' +'</td><td>'+'<input type="file" id="newImage"><button type="submit">Salva Modifiche</button>' +'</td></tr>');


     
  
  

//     $('#productstable').append('<tr>  <td id="id_td">' +'</td>' +'<td>'+response[i].name+'</td>'+'<td>'+response[i].type+'</td>'+'<td>'+response[i].price+'</td>'+  '<td><a href="basket.php">'+"Acquista" +'</a></td>+</tr>');
      $idP=response[i].id;
      

     $('#id_td').attr('id', 'img_id'+$idP);
     $('#prodotto').attr('id','id_tr'+$idP);
     $('#nameP').attr('id','nameP'+$idP);
     $('#typeP').attr('id','typeP'+$idP);
     $('#priceP').attr('id','priceP'+$idP);
     $('#newImage').attr('id','newImage'+$idP);
     


     var img=new Image();
     img.src = 'data:image/png;base64,' + response[i].img;

     var imageCell = document.getElementById("img_id"+$idP);
     imageCell.innerHTML = ""; // Clear the cell's contents
     imageCell.appendChild(img); 
        
     //$('#productstable').appendChild(img);
    });
    $('#productstable').append('<tr><td><button id="save_button" name="savebtn" onclick="saveData()" >'+"Salva Modifica" +'</button></td></tr>')
   
},
    error: function(e) {
    //called when there is an error
    console.log(e.message);
    }
    });
 // });
});
}

function check_field(){
  var password1 = document.getElementById("password1").value;
  var password2 = document.getElementById("password2").value;
  var nome = document.getElementById("name").value;
  var email = document.getElementById("email").value;

  if(password1===password2){

    $.ajax({
      type: 'POST',
      url:'signIn.php',
      //contentType: 'text',
      //dataType: 'text',
      data: "name="+nome +"&password=" + password1 +"&email=" + email 
          //name: "nome"
         
      ,
      success: function(response){
        
        //alert("PHP CODE EXECUTED"+ response);
        //location.href = "user.php"
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

function incBasketQty(idP){

  
  //alert("CLICKED");

  
   $.ajax({
      type: 'POST',
      url:'incBasketQty.php',
      //contentType: 'text',
      //dataType: 'text',
      data: "idP="+idP  
          //name: "nome"
         
      ,
      success: function(response){
        location.reload(true);
        //salert("PHP CODE EXECUTED"+ response);

      },
      error: function(e) {
        //called when there is an error
        alert("PHP CODE ERROR");

        console.log(e.message);
        }
  
    });
  

  
}

function decBasketQty(idP){

  

  
   $.ajax({
      type: 'POST',
      url:'decBasketQty.php',
      //contentType: 'text',
      //dataType: 'text',
      data: "idP="+idP  
          //name: "nome"
         
      ,
      success: function(response){
        location.reload(true);

        //alert("PHP CODE EXECUTED"+ response);

      },
      error: function(e) {
        //called when there is an error
        alert("PHP CODE ERROR");

        console.log(e.message);
        }
  
    });
  

  
}


//$(document).ready(function() {
//$("#save_button").click(function(e){
function saveData(){
  
    
    var data={
      nomeP:document.getElementById("nameP1").value,
      typeP:document.getElementById("typeP1").value,
      priceP:document.getElementById("priceP1").value,
      newImage:document.getElementById("newImage1").value,
      id:'1'


    }


    alert("SAVE BTN CLICCKED -->"+ data["nomeP"]);


    $.ajax({
      type: 'POST',
      url:'saveModify.php',
      contentType: "application/json",
      data:JSON.stringify(data)//"name="+nome +"&password=" + password1 +"&email=" + email  //devo passargli gli oggetti json
      ,
      success: function(response){
        
        alert("PHP CODE EXECUTED"+ response);
        //document.getElementById("nameP1").value=response;
        //location.href = "user.php"
      },
      error: function(e) {
        //called when there is an error
        alert("PHP CODE ERROR");

        console.log(e.message);
        }
  
    });

    
   


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

