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
     $('#productstable').append('<tr><div id="draggable" draggable="true" ondragstart="dragStart(event)">'+
                    '<td>'+response[i].name+'</td>'+
                    '<td>'+response[i].type+'</td>'+
                    '<td>'+response[i].price+'€'+'</td>'+
                    '<td id="id_td">  </td>' + 
                    '<td><a href="addToBasket.php" id="idP">'+"Aggiungi al carrello" +'</a></td>'+
                    '+</tr></div>');
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
    // $('#productstable').append('<tr id="prodotto"><td>'+'<input id="nameP" type ="text" value="'+response[i].name+'"> </input>'+'</td>'+'<td>'+'<input id="typeP" type ="text" value="'+response[i].type+'"> </input>'+'</td>'+'<td>'+'<input id="priceP" type ="text" value="'+response[i].price+'"> </input>'+'</td>'+ '<td id="id_td">' +'</td><td>'+'<input type="file" id="newImage"><button id="save_button" name="savebtn" onclick="saveData()" >'+"Salva Modifica" +'</button>' +'</td></tr>');
    $('#productstable').append(
      '<tr id="prodotto">'+
      '<td>'+'<input id="nameP" type ="text" value="'+response[i].name+' "> </input>'+'</td>'+
      '<td>'+'<input id="typeP" type ="text" value=" '+response[i].type+'"> </input>'+'</td>'+
      '<td>'+'<input id="priceP" type ="text" value=" '+response[i].price+'"> </input>'+'</td>'+
       '<td id="id_td">' +'</td><td>'+
       '<td><input type="file" id="newImage"></td>'+
       '<td><button id="upload_img" name="uploadbtn" onclick="upload()"  >'+"Carica Immagine" +'</button></td>'+
       '<td><button id="save_button" name="savebtn" onclick="saveData()" >'+"Salva Modifica" +'</button>' +'</td>'+
       '<td><button id="delete_button" name="deletebtn" onclick="deleteProduct()" >'+"Elimina il Prodotto" +'</button>' +'</td>'+
       
        '</tr>');
        //onclick="uploadImg()"
   

  // $('#productstable').append('<tr>  <td id="id_td">' +'</td>' +'<td>'+response[i].name+'</td>'+'<td>'+response[i].type+'</td>'+'<td>'+response[i].price+'</td>'+  '<td><a href="basket.php">'+"Acquista" +'</a></td>+</tr>');
   $idP= response[i].id;
      idP=response[i].id;

     $('#id_td').attr('id', 'img_id'+$idP);
     $('#prodotto').attr('id','prodotto'+$idP);
     $('#nameP').attr('id','nameP'+$idP);
     $('#typeP').attr('id','typeP'+$idP);
     $('#priceP').attr('id','priceP'+$idP);
     $('#newImage').attr('id','newImage'+$idP);
     $('#save_button').attr('onclick','saveData('+$idP+')');
     $('#save_button').attr('id','save_button'+$idP);
     /*$('#upload_img').attr('onclick','uploadImg('+$idP+')');
     $('#upload_img').attr('id','upload_img'+$idP);
     */
     $('#upload_img').attr('onclick','upload('+$idP+')');
     $('#upload_img').attr('id','upload_img'+$idP);

     $('#delete_button').attr('onclick','deleteProduct('+$idP+')');
     $('#delete_button').attr('id','delete_button'+$idP);
     


     var img=new Image();
     img.src = 'data:image/png;base64,' + response[i].img;

     var imageCell = document.getElementById("img_id"+$idP);
     imageCell.innerHTML = ""; // Clear the cell's contents
     imageCell.appendChild(img); 
        
     //$('#productstable').appendChild(img);
    });
    $('#newProduct').append('<button id="newProduct" name="newPoductbtn" onclick="addNewProducts('+($idP+1)+')" >'+"Aggiungi un nuovo prodotto" +'</button>')

   

},
    error: function(e) {
    //called when there is an error
    $('#newProduct').append('<button id="newProduct" name="newPoductbtn" onclick="addNewProducts('+0+')" >'+"Aggiungi un nuovo prodotto" +'</button>')
    console.log("nessun prodotto ");
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



function upload(idP) {

    var formData = new FormData();
    formData.append('file', $('#newImage'+idP)[0].files[0]);
    formData.append('idP',idP);
    formData.append('function',"upload");

    console.log(formData);



   $.ajax({
      url: 'uploadImg.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        $("#flash").fadeIn(1000);
        var msg=document.getElementById("flash")
        msg.innerHTML="Immagine caricata correttamente";
        $("#flash").fadeOut(4000);
        console.log('Image uploaded successfully!');
        var img=new Image();
          img.src = response;
        
        var imageCell = document.getElementById("img_id"+idP);
        imageCell.innerHTML = " "; // Clear the cell's contents
       imageCell.appendChild(img); 
       // alert(response);
      },
      error: function (error) {
        console.error(error);
        alert("ERROR UPLOADING!");
      }
    });
  //})
}



function saveData(idP){
  
    
  var data={
    nomeP:document.getElementById("nameP"+idP).value,
    typeP:document.getElementById("typeP"+idP).value,
    priceP:document.getElementById("priceP"+idP).value,
    newImage:document.getElementById("newImage"+idP).value,
    id:idP,
    function:"saveData",



  }


  //alert("SAVE BTN CLICCKED -->"+ data["nomeP"]+" "+data["typeP"]+" "+data["priceP"]+data["newImage"]);


  $.ajax({
    type: 'POST',
    url:'saveModify.php',
    contentType: "application/json",
    data:JSON.stringify(data),//"name="+nome +"&password=" + password1 +"&email=" + email  //devo passargli gli oggetti json
    
    success: function(response){
      
      //alert("PHP CODE EXECUTED",response);
      $("#flash").fadeIn(1000);
      var msg=document.getElementById("flash")
      msg.innerHTML="Prodotto modificato correttamente";
      $("#flash").fadeOut(4000);
      

      //location.reload(true);

      //document.getElementById("flash>").innerHTML="Modifiche riuscite";
      
      //location.href = "user.php"
    },
    error: function(e) {
      //called when there is an error
      alert("PHP CODE ERROR");

      console.log(e.message);
      }

  });

  
 


}
function deleteProduct(idP){
  var data={idP:idP,
            function:"delete"
          }
//          alert("delete BTN CLICCKED -->"+ data["idP"]+" "+data["function"]);

  $.ajax({
    type: 'POST',
    url:'saveModify.php',
    contentType: "application/json",
    data:JSON.stringify(data),
    success: function(response){
        
      //alert("PHP CODE EXECUTED",response);
      var prodotto = document.getElementById("prodotto"+idP);
      prodotto.innerHTML = ""; // Clear the cell's contents
      
      $("#flash").fadeIn(1000);
      var msg=document.getElementById("flash")
      msg.innerHTML="Prodotto modificato correttamente";
      $("#flash").fadeOut(4000);
      //location.reload(true);

      //document.getElementById("flash>").innerHTML="Modifiche riuscite";
      
      //location.href = "user.php"
    },
    error: function(e) {
      //called when there is an error
      alert("PHP CODE ERROR");

      console.log(e.message);
      }

  
  })

}

function addNewProducts(idP){

  var data={
      idP:idP,
      function:"addNewProducts",
  }
  $.ajax({
    type: 'POST',
    url:'saveModify.php',
    contentType: "application/json",
    data:JSON.stringify(data),
    success: function(response){
      $idP=response;
      $('#productstable').append(
        '<tr id="prodotto">'+
        '<td>'+'<input id="nameP" type ="text" value="nome"> </input>'+'</td>'+
        '<td>'+'<input id="typeP" type ="text" value="tipo"> </input>'+'</td>'+
        '<td>'+'<input id="priceP" type ="text" value="prezzo"> </input>'+'</td>'+
        '<td id="id_td" value="immagine">' +'</td><td>'+
        '<td><input type="file" id="newImage"></td>'+
        '<td><button id="upload_img" name="uploadbtn" onclick="upload()"  >'+"Carica Immagine" +'</button></td>'+
        '<td><button id="save_button" name="savebtn" onclick="saveData()" >'+"Salva Modifica" +'</button>' +'</td>'+
        '<td><button id="delete_button" name="deletebtn" onclick="deleteProduct()" >'+"Elimina il Prodotto" +'</button>' +'</td>'+
        
         '</tr>');
         
      $('#id_td').attr('id', 'img_id'+$idP);
      $('#prodotto').attr('id','prodotto'+$idP);
      $('#nameP').attr('id','nameP'+$idP);
      $('#typeP').attr('id','typeP'+$idP);
      $('#priceP').attr('id','priceP'+$idP);
      $('#newImage').attr('id','newImage'+$idP);
      $('#save_button').attr('onclick','saveData('+$idP+')');
      $('#save_button').attr('id','savebtn'+$idP);
      $('#upload_img').attr('onclick','upload('+$idP+')');
      $('#upload_img').attr('id','upload_img'+$idP);
    
  /*var data={
    nomeP:document.getElementById("nameP"+idP).value,
    typeP:document.getElementById("typeP"+idP).value,
    priceP:document.getElementById("priceP"+idP).value,
    newImage:document.getElementById("newImage"+idP).value,
    id:idP

    
        
      
    }*/
  },
    error: function(e) {
      //called when there is an error
      alert("PHP CODE ERROR");

      console.log(e.message);
      }

  
  })


  
 
      


  }

  /*funzioni per gestire il drag&drop*/

  function allowDrop(ev) {
    ev.preventDefault();
  }
  
  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
  }
  
  function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
  }

 // alert("SAVE BTN CLICCKED -->"+ data["newImage"]);


 /* $.ajax({
    type: 'POST',
    url:'saveModify.php',
    contentType: "application/json",
    data:{funzione:"addProduct",data:JSON.stringify(data)}//"name="+nome +"&password=" + password1 +"&email=" + email  //devo passargli gli oggetti json
    ,
    success: function(response){
      
      alert("PHP CODE EXECUTED"+ response);
      //location.reload(true);

      //document.getElementById("flash>").innerHTML="Modifiche riuscite";
      
      //location.href = "user.php"
    },
    error: function(e) {
      //called when there is an error
      alert("PHP CODE ERROR");

      console.log(e.message);
      }

  });*/

  





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

