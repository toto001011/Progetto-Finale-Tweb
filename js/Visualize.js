/**
 * In questo file sono contenute tutte le funzioni JavaScript
 * 
 */

/**
 * Funzione che visualizza al cliente i prodotti in vendita
 */
if (document.location.href.match("products.php")){
$(document).ready(function(){
  var data={
    function:"visualize_products"
  }
  $.ajax({
    url: 'saveModify.php',
    type: 'POST',
    data: JSON.stringify(data),
    contentType: "application/json",
    dataType: 'json',
    success: function(response) {

    $('#carrello').css('display', 'inline');
   
    console.log(response);
    $('#productsDiv').html(response);
    response=JSON.parse(JSON.stringify(response))
   
  
    var trHTML = '';
    $.each(response, function (i, item) {
     $idP=response[i].id;
     $('#productstable').append(
                    '<div id="'+$idP+'" class="prodotti" draggable="true" ondragstart="drag(event)">'+
                      '<div class="prodotto">'+response[i].name+'</div>'+
                      '<div class="prodotto">'+response[i].type+'</div>'+
                      '<div class="prodotto">'+response[i].price+'€'+'</div>'+
                      '<div clas="prodotto">'+
                          '<textarea readonly  class="desc" id="desc" name="description"  >' +response[i].desc+ '</textarea>'+
                          '<button id="showDesc" name="ShowDescriptionProduct" onclick="showDesc('+$idP+')">Mosta Descrizione</button>'+
                      '</div>'+
                      '<div id="id_td" value="1class="prodotto">  </div>' + 
                    '<div class="prodotto"><button id="add_to_basket" name="addToBasketbtn" onclick="addToBasket('+$idP+')"  >'+"Aggiungi al carrello" +'</button></div>' +                 
                  '</div>');
      $idP=response[i].id;
     $('#id_td').attr('id', 'id'+$idP);
     $('#img').on('dragstart', function(event) { alert("image dragged") });
     $('#add_to_basket').attr('id','add_to_basket'+$idP);
     $('#add_to_basket').attr('onclick','addToBasket('+$idP+')');

     $('#showDesc').attr('id','showDesc'+$idP);
     $('#desc').attr('id','desc'+$idP);

     var img=new Image();
     img.src = 'data:image/png;base64,' + response[i].img;
     img.id='img_id'+$idP;
     img.draggable="false";

     var imageCell = document.getElementById("id"+$idP);
     imageCell.innerHTML = ""; 
     imageCell.appendChild(img); 
     $('#img_id'+$idP).attr('draggable','false');
     $('#desc'+$idP).css('overflow-y','scroll');

    
    });
   
},
    error: function(e) {
    //called when there is an error
    console.log(e.message);
    }
    });
});
}

/**
 * Funzione che visualizza il carrello di un determinato cliente
 */
if (document.location.href.match("basket.php")){
 
$(document).ready(function(){
  $('#footer').css('margin-top','33%');
    var data={
      function:"visualize_basket"
    }
    $.ajax({
      url: 'saveModify.php',
      type: 'POST',
      data: JSON.stringify(data),
      contentType: "application/json",
      dataType: 'json',
      success: function(response_basket) {
  
      //called when successful
      console.log(response_basket);

      $('#header').append(
      '<div class="head_basket">'+
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
      document.getElementById("empty").innerHTML=" ";
      $('#checkout').css('display','block');
      $.each(response_basket, function (i, item) {

        $idP=response_basket[i].id;      
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
         
       $('#idP').attr('id', 'idProdotto'+$idP);
       var img=new Image();
       img.src = 'data:image/png;base64,' + response_basket[i].img;
  
       var imageCell = document.getElementById("img_id"+$idP);
       imageCell.innerHTML = ""; // Clear the cell's contents
       imageCell.append(img); 
          
      });
      $('#total').append('<a><h3>'+ 'TOTALE: </a>'+' <a id="tot">'+totBasket+'</a>€</h3></a></li>');
      $('#footer').css('margin-top','1%');
      
    
      
  },
      error: function(e) {
      //called when there is an error
      console.log(e.message);
      }
      });
  });
}

/**
 * Funzione che visualizza all'amministratore i prodotti in vendita 
 * attualmente e permette di apportarne delle modifiche
 */
if (document.location.href.match("productsAdmin.php")){
 
$(document).ready(function(){

  
  var data={
    function:"visualize_products"
  }
  $.ajax({
    url: 'saveModify.php',
    type: 'POST',
    data: JSON.stringify(data),
    contentType: "application/json",
    dataType: 'json',
    success: function(response) {

    //called when successful
    console.log(response);
    $('#productsDiv').html(response);
    response=JSON.parse(JSON.stringify(response))
  
    var trHTML = '';
    $.each(response, function (i, item) {
    
    $('#productstable').append(
      '<tr id="prodotto">'+
      '<td>'+'<input id="nameP" type ="text" value="'+response[i].name+' "> </input>'+'</td>'+
      '<td>'+
      '<select  name="type" id="typeP"  value="'+response[i].type+'">'+
        '<option id="op2"value="Telefonia" >Telefonia</option>'+
        '<option id="op1" value="Elettronica" >Elettronica</option>'+
        '<option id="op3" value="Informatica">Informatica</option>'+
        '<option id="op4" value="Altro">Altro</option>'+
      '</select>'+            
      '<td>'+'<input id="priceP" type ="number" value="'+response[i].price+'"> </input>'+'</td>'+
      '<td>'+
      '<textarea class="textBox" id="descP" name="productDescription" rows="3" cols="50" maxlength="500">'+response[i].desc+'</textarea>'+
      '<button id="resetSize" name="reretSizeDescriptionProduct" onclick="resetSizeDesc('+response[i].id+')">Reset size</button>'+
      '</td>'+
       '<td id="id_td">' +'</td><td>'+
       '<td>'+
        '<input type="file" id="newImage"><br>'+
        '<button id="upload_img" name="uploadbtn" onclick="upload()"  >'+"Carica Immagine" +'</button>'+
       '</td>'+
       '<td><button id="save_button" name="savebtn" onclick="saveData()" >'+"Salva Modifica" +'</button>' +'</td>'+
       '<td><button id="delete_button" name="deletebtn" onclick="deleteProduct()" >'+"Elimina il Prodotto" +'</button>' +'</td>'+
       '</tr>');

   $idP= response[i].id;
      idP=response[i].id;

     $('#id_td').attr('id', 'img_id'+$idP);
     $('#descP').attr('id', 'descP'+$idP);
     $('#resetSize').attr('id', 'resize'+$idP);

     $('#prodotto').attr('id','prodotto'+$idP);
     $('#nameP').attr('id','nameP'+$idP);
     $('#typeP').attr('id','typeP'+$idP);
     $('#priceP').attr('id','priceP'+$idP);
     $('#newImage').attr('id','newImage'+$idP);
     $('#save_button').attr('onclick','saveData('+$idP+')');
     $('#save_button').attr('id','save_button'+$idP);
    
     $('#upload_img').attr('onclick','upload('+$idP+')');
     $('#upload_img').attr('id','upload_img'+$idP);

     $('#delete_button').attr('onclick','deleteProduct('+$idP+')');
     $('#delete_button').attr('id','delete_button'+$idP);
     switch(response[i].type){
        case "Elettronica":$('#typeP'+$idP).val('Elettronica');
        break;
        case "Telefonia":$('#typeP'+$idP).val('Telefonia');
        break;
        case "Informatica":$('#typeP'+$idP).val('Informatica');
        break;
        case "Altro":$('#typeP'+$idP).val('Altro');
        break;
        
        

     }


     var img=new Image();
     img.src = 'data:image/png;base64,' + response[i].img;

     var imageCell = document.getElementById("img_id"+$idP);
     imageCell.innerHTML = ""; // Clear the cell's contents
     imageCell.appendChild(img); 
        
    });
    $('#newProduct').append('<button id="newProduct" name="newPoductbtn" onclick="addNewProducts('+($idP+1)+')" >'+"Aggiungi un nuovo prodotto" +'</button>')
    
   

},
    error: function(e) {
    //called when there is an error
    $('#newProduct').append('<button id="newProduct" name="newPoductbtn" onclick="addNewProducts('+0+')" >'+"Aggiungi un nuovo prodotto" +'</button>')
    console.log("nessun prodotto ");
    }
    });
    

});
}

/**
 * Funzione che, per estetica, modifica i margini dell'elemento footer
 */
if (document.location.href.match("indexAdmin.php")||document.location.href.match("index.php")){
 
  $(document).ready(function(){

    $('#footer').css('margin-top','33%');
  
  })  
}


/**
 * Funzione che aumenta e/o diminuisce la dimensione della textarea 
 * nella quale viene visualizzata dal cliente la descrizione 
 * 
 * @param:idP identifica il prodotto del quale mostrare la descrizione 
 */
var open=false;
function showDesc(idP){
    $(document).ready(function(){
      open=!open;
      if(open==true){
        $("#desc"+idP).animate({height: "210px"});
        
        document.getElementById("showDesc"+idP).innerHTML="Nascondi Descrizione";
        

      }else{
        $("#desc"+idP).animate({height: "0px"});
        document.getElementById("showDesc"+idP).innerHTML="Mostra Descrizione";

      }
      })

 }

 /**
  * Funzione che reimposta la visualizzazione da parte dell'amministratore
  *  del campo descrizione alle dimensioni di default
  * 
  * @param:idP identifica il prodotto del quale reimpostare il campo descrizione
  */

 function resetSizeDesc(idP){
  $("#descP"+idP).animate({width: "70%",height: "81px"});
  
  
 }
  /**
   * Funzione che manda una richiesta di aggiunta, da parte di un cliente, di un prodotto nel carrello
   * 
   * @param:idP identifica il prodotto da aggiungere nel carrello 
   */
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
      
    
      
    },
    error: function (error) {
      console.error(error);
    }
  });
}


/*
function check_field(){
  var password1 = document.getElementById("password1").value;
  var password2 = document.getElementById("password2").value;
  var nome = document.getElementById("name").value;
  var email = document.getElementById("email").value;

  if(password1===password2){

    $.ajax({
      type: 'POST',
      url:'signIn.php',
      data: "name="+nome +"&password=" + password1 +"&email=" + email          
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
*/

/**
 * Funzione che incrementa la quantità da acquistare 
 * 
 * @param:idP identifica il prodotto da incrementare
 */
function incBasketQty(idP){


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


/**
 * Funzione che decrementa la quantità da acquistare 
 * 
 * @param:idP identifica il prodotto da decrementare
 */
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
          $('#checkout').css('display','none');
          document.getElementById("empty").innerHTML="Nessun prodotto nel carrello";
          $('#footer').css('margin-top','33%');
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


/**
 * Funzione che elimina il prodotto nel carrello 
 * 
 * @param:idP identifica il prodotto da eliminare
 */
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
          $('#checkout').css('display','none');
          document.getElementById("empty").innerHTML="Nessun prodotto nel carrello";  
          $('#footer').css('margin-top','33%');
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

/**
 * Funzione che  manda una richiesta per caricare la foto di un prodotto sul server 
 * 
 * @param:idP identifica il prodotto del quale caricare la foto
 */
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
      dataType: 'json',
      success: function (response) {
        response=JSON.parse(JSON.stringify(response));
        $("#flash").fadeIn(1000);
        var msg=document.getElementById("flash");
        msg.innerHTML=response[0].msg;
        $("#flash").fadeOut(4000);
       
        var img=new Image();
          img.src = response[0].src;
        
        var imageCell = document.getElementById("img_id"+idP);
        imageCell.innerHTML = " "; // Clear the cell's contents
       imageCell.appendChild(img); 
      },
      error: function (error) {
        console.error(error);
      }
    });
  //})
}


/**
 * Funzione che  manda una richiesta per salvare definitivamente sul db le eventuali modifiche
 * 
 * @param:idP identifica il prodotto del quale salvare le modifiche
 */
function saveData(idP){
  
    
  var data={
    nomeP:document.getElementById("nameP"+idP).value,
    typeP:document.getElementById("typeP"+idP).value,
    priceP:document.getElementById("priceP"+idP).value,
    newImage:document.getElementById("newImage"+idP).value,
    desc:document.getElementById("descP"+idP).value,
    id:idP,
    function:"saveData",
  }

  $.ajax({
    type: 'POST',
    url:'saveModify.php',
    contentType: "application/json",
    data:JSON.stringify(data),
   
    
    success: function(response){
          $("#flash").fadeIn(1000);
          var msg=document.getElementById("flash")
          msg.innerHTML="Prodotto modificato correttamente";
          $("#flash").fadeOut(4000);
          
    },
    error: function(e) {
      //called when there is an error
      alert("PHP CODE ERROR");

      console.log(e.message);
      }

  });

  
 


}

/**
 * Funzione che  manda una richiesta per eliminare un prodotto dalla vendita (e quindi dal db) 
 * e eventualmente anche dai carrelli dei clienti
 * 
 * @param:idP identifica il prodotto da eliminare
 */
function deleteProduct(idP){
  var data={idP:idP,
            function:"delete"
          }

  $.ajax({
    type: 'POST',
    url:'saveModify.php',
    contentType: "application/json",
    data:JSON.stringify(data),
    success: function(response){
        
      var prodotto = document.getElementById("prodotto"+idP);
      prodotto.innerHTML = ""; // Clear the cell's contents
      
      $("#flash").fadeIn(1000);
      var msg=document.getElementById("flash")
      msg.innerHTML="Prodotto modificato correttamente";
      $("#flash").fadeOut(4000);
    
    },
    error: function(e) {
      alert("PHP CODE ERROR");

      console.log(e.message);
      }

  
  })

}

/**
 * Funzione che  manda una richiesta per aggiunngere un nuovo prodotto in vendita (e quindi sul db)
 * 
 * @param:idP è l'identificatore del nuovo prodotto
 */
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
        '<td><select  name="type" id="typeP" ">'+
      '<option id="op2"value="Telefonia" >Telefonia</option>'+
      '<option id="op1" value="Elettronica" >Elettronica</option>'+
      '<option id="op3" value="Informatica">Informatica</option>'+
      '<option id="op4" value="Altro">Altro</option>'+
    '</select>'+
        
        '<td>'+'<input id="priceP" type ="text" value="prezzo"> </input>'+'</td>'+
        '<td>'+
      '<textarea class="textBox" id="descP" name="productDescription" rows="3" cols="50" maxlength="500"></textarea>'+
      '<button id="resetSize" name="reretSizeDescriptionProduct" onclick="resetSizeDesc()">Reset size</button>'+
      '</td>'+
        '<td id="id_td" value="immagine">' +'</td><td>'+
        '<td>'+
          '<input type="file" id="newImage"><br>'+
          '<button id="upload_img" name="uploadbtn" onclick="upload()"  >'+"Carica Immagine" +'</button>'+
       '</td>'+
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
      $('#resetSize').attr('onclick', 'resetSizeDesc('+$idP+')');
      $('#resetSize').attr('id', 'resize'+$idP);
      $('#descP').attr('id', 'descP'+$idP);

    
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


//Funzioni per gestire il drag and drop
  function allowDrop(ev) {
    ev.preventDefault();
  }
  
  /**
   * Funzione per gestire il drag
   */
  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
  }
  
  /**
   * 
   * Funzione per gestire il drop, quando un prodotto draggable viene droppato in una apposita zona
   * si aggiunge il prodotto nel carrello  
   */
  function drop(ev) {

    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    addToBasket(data);
  
  }


