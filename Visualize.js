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
    $('#carrello').css('display', 'inline');

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
     $idP=response[i].id;
     //document.getElementById('productstable').appendChild(img)
     $('#productstable').append(
                    '<div id="'+$idP+'" class="prodotti" draggable="true" ondragstart="drag(event)">'+
                      '<div class="prodotto">'+response[i].name+'</div>'+
                      '<div class="prodotto">'+response[i].type+'</div>'+
                      '<div class="prodotto">'+response[i].price+'€'+'</div>'+
                      '<div id="id_td" value="1class="prodotto">  </div>' + 
                    '<div class="prodotto"><button id="add_to_basket" name="addToBasketbtn" onclick="addToBasket('+$idP+')"  >'+"Aggiungi al carrello" +'</button></div>' +                 
                  '</div>');
//     $('#productstable').append('<tr>  <td id="id_td">' +'</td>' +'<td>'+response[i].name+'</td>'+'<td>'+response[i].type+'</td>'+'<td>'+response[i].price+'</td>'+  '<td><a href="basket.php">'+"Acquista" +'</a></td>+</tr>');
      $idP=response[i].id;
      //$( "#id_td" ).draggable( "destroy" );
      //$( "#id_td" )
     $('#id_td').attr('id', 'id'+$idP);
     $('#img').on('dragstart', function(event) { alert("image dragged") });
     //?compna=",$compname,"
    // $('#idP' ).prop("href", "addToBasket.php?idP="+$idP);
     //$('#idP').attr('id', 'idP'+$idP);
     $('#add_to_basket').attr('id','add_to_basket'+$idP);
     $('#add_to_basket').attr('onclick','addToBasket('+$idP+')');

     var img=new Image();
     img.src = 'data:image/png;base64,' + response[i].img;
     img.id='img_id'+$idP;
     img.draggable="false";

     var imageCell = document.getElementById("id"+$idP);
     imageCell.innerHTML = ""; // Clear the cell's contents
     imageCell.appendChild(img); 
     $('#img_id'+$idP).attr('draggable','false');
     //document.getElementById("id"+$idP).draggable( "option", "disabled", true );
        
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
      $('#header').append(
      '<div class="head">'+
        '<div class="head_prod">Nome prodotto</div>'+
        '<div class="head_prod">Categoria</div>'+
        '<div class="head_prod">Prezzo</div>'+
        '<div class="head_prod">Immagine</div>'+
        '<div class="head_prod">Quantità</div>'+
     '</div>');
      $('#productsDiv').html(response_basket);
      response=JSON.parse(JSON.stringify(response_basket))
    
      var trHTML = '';
      var totBasket=0;
      //$('#empty').innerHTML=" ";
      document.getElementById("empty").innerHTML=" ";
      $.each(response_basket, function (i, item) {

        $idP=response_basket[i].id;      
       //$('#basketProductsTable').append('<tr><td>'+response_basket[i].name+'</td>'+'<td>'+response_basket[i].type+'</td>'+'<td>'+response_basket[i].price+'€ </td>'+ '<td id="id_td">' +'</td><td>'+'<button id="btnDec" type="button" onclick="decBasketQty()"> -' +'</button>'+ " "+response_basket[i].qty+" "+'<button type="button" onclick="incBasketQty()" id="btnInc"> +' +'</button>'+'</td></tr>');
       $('#basketProductsTable').append(
        '<div id="'+$idP+'" class="prodotti" draggable="false" ondragstart="drag(event)">'+
          '<div class="prodotto">'+response_basket[i].name+'</div>'+
          '<div class="prodotto">'+response_basket[i].type+'</div>'+
          '<div class="prodotto" ><a id="price">'+response_basket[i].price+'</a>€</div>'+
          '<div class="prodotto" id="id_td"  "> </div>' + 
          '<div class="prodotto">'+
          '<button type="button" id="btnDec" title="decrementa la quantità" onclick="decBasketQty()"> -' +'</button>'+ 
          '<a id="qty">'+response_basket[i].qty+'</a>'+
          '<button type="button" id="btnInc"  title="incrementa la quantità" onclick="incBasketQty()" "> +' +'</button>'+
          '<button type="button" id="btnDel" title="elimina il prodotto" onclick="delBasketP()" >  X ' +'</button>'+
          '</div>'+
        '</div>');
      
       totBasket=totBasket+response_basket[i].price*response_basket[i].qty;  

       $('#qty').attr('id', 'qty'+$idP);
       $('#price').attr('id', 'price'+$idP);
       

       $('#id_td').attr('id', 'img_id'+$idP);
       
       $('#btnInc' ).attr("onclick", "incBasketQty("+$idP+")");
       $('#btnDec' ).attr("onclick", "decBasketQty("+$idP+")");
       $('#btnDel' ).attr("onclick", "delBasketP("+$idP+")");

       $('#btnInc').attr('id', 'btnInc'+$idP);
       $('#btnDec').attr('id', 'btnDec'+$idP);
       $('#btnDel').attr('id', 'btnDel'+$idP);
       
      // $('#img').attr('src','data:image/png;base64,' + response_basket[i].img);
       


       $('#idP').attr('id', 'idProdotto'+$idP);
       var img=new Image();
      // alert(response_basket[i].img);
       img.src = 'data:image/png;base64,' + response_basket[i].img;
  
       var imageCell = document.getElementById("img_id"+$idP);
       imageCell.innerHTML = ""; // Clear the cell's contents
       imageCell.append(img); 
          
       //$('#productstable').appendChild(img);
      });
      $('#total').append('<a><h3>'+ 'TOTALE: </a>'+' <a id="tot">'+totBasket+'</a>€</h3></a></li>');
      
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



function addToBasket(idP){
  var data={
    idP:idP,
    function:"addToBasket"
  }

  $.ajax({
    type: 'POST',
    url:'saveModify.php',
    contentType: "application/json",
    data:JSON.stringify(data),
    success: function (response) {


      $("#flash").fadeIn(1000);
      var msg=document.getElementById("flash")
      msg.innerHTML="Prodotto aggiunto al carrello";
      $("#flash").fadeOut(4000);
      console.log('Added To Basket successfully!');
    
      
     // alert(response);
    },
    error: function (error) {
      console.error(error);
      alert("ERROR UPLOADING!");
    }
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

  
  /* $.ajax({
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
  
    });*/
    var data={
      idP:idP,
      function:"incBasketQty"
    }
    
     $.ajax({
        type: 'POST',
        url:'saveModify.php',
        contentType: "application/json",
      data:JSON.stringify(data),
      
        success: function(response){
          //location.reload(true);
          var new_qty=document.getElementById("qty"+idP).innerHTML;
         
          new_qty++;
          document.getElementById("qty"+idP).innerHTML=new_qty;
          
  
          var tot=document.getElementById("tot").innerHTML;
          var price=document.getElementById("price"+idP).innerHTML;
          var price_float=parseFloat(price);
          var tot_float=parseFloat(tot);
          //alert("PHP CODE EXECUTED"+ tot+" "+price);
         
          tot_float=tot_float+price_float;
         // alert("PHP CODE EXECUTED"+ new_qty);
        
          document.getElementById("tot").innerHTML=tot_float;
  
         
  
         // alert("PHP CODE EXECUTED"+ response);
  
        },
        error: function(e) {
          //called when there is an error
          alert("PHP CODE ERROR");
  
          console.log(e.message);
          }
    
      });
   
  

  
}

function decBasketQty(idP){

  var data={
    idP:idP,
    function:"decBasketQty"
  }
  
   $.ajax({
      type: 'POST',
      url:'saveModify.php',
      contentType: "application/json",
    data:JSON.stringify(data),
    
      success: function(response){
        //location.reload(true);
        var new_qty=document.getElementById("qty"+idP).innerHTML;
       
        new_qty--;
        document.getElementById("qty"+idP).innerHTML=new_qty;
        

        var tot=document.getElementById("tot").innerHTML;
        var price=document.getElementById("price"+idP).innerHTML;

        tot=tot-price;
      
        document.getElementById("tot").innerHTML=tot;

        if(new_qty==0){
          //document.getElementById(idP).innerHTML="";
          //document.getElementById(idP).remove;
          $('#'+idP).remove();

        }
        //alert("CHILDREN -->"+ $('#basketProductsTable').children().length);
        if ($('#basketProductsTable').children().length === 0) {
          $('#header').remove();
          document.getElementById("empty").innerHTML="Nessun prodotto nel carrello";     
          $('#checkout').css('display','none');
           }
          

        

       // alert("PHP CODE EXECUTED"+ response);

      },
      error: function(e) {
        //called when there is an error
        alert("PHP CODE ERROR");

        console.log(e.message);
        }
  
    });
  

  
}
function delBasketP(idP){
  var data={
    idP:idP,
    function:"delBasketProduct"
  }
  $.ajax({
    type: 'POST',
    url:'saveModify.php',
  
    contentType: "application/json",
    data:JSON.stringify(data),
    
    success: function(response){
      //location.reload(true);
      
      var qty=document.getElementById("qty"+idP).innerHTML;
       
        

        var tot=document.getElementById("tot").innerHTML;
        var price=document.getElementById("price"+idP).innerHTML;
        var tot_float=parseFloat(tot);
        var price_float=parseFloat(price);
        var qty_int=parseInt(qty);



        tot_float=tot_float-(qty_int*price_float);
       // alert(tot_float);
        document.getElementById(idP).remove;
        $('#'+idP).remove();
  
        document.getElementById("tot").innerHTML=tot_float;

        //alert("CHILDREN -->"+ $('#basketProductsTable').children().length);
        if ($('#basketProductsTable').children().length === 0) {
          $('#header').remove();
          document.getElementById("empty").innerHTML="Nessun prodotto nel carrello";     
          $('#checkout').css('display','none');
           }
          
      //alert("PHP CODE EXECUTED"+ response);

    },
    error: function(e) {
      //called when there is an error
      alert("PHP CODE ERROR"+e);

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
    //alert(data);
    addToBasket(data);
    //ev.target.appendChild(document.getElementById(data));
  
  }

  function log(){
    
        $("#msg").fadeIn(1000);
       /* var msg=document.getElementById("flash")
        msg.innerHTML="Utente loggato correttamente";*/
        $("#msg").fadeOut(4000);
        $("#msg").css('display','flex');
       



  }
/*-------------------------------*/


