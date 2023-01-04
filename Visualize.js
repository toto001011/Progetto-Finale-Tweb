
$(document).ready(function(){
//  $("#productsBtn").on('click',function(){
  $.ajax({
    url: 'visualize_products.php',
    type: 'POST',
    data: {query: $("SELECT * FROM products").val()},
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




/*
function showProducts(){
  $.ajax({
    url: 'db1.php',
    type: 'GET',
    data: {query: $("SELECT * FROM products").val()},
   
    success: function(response) {

    //called when successful
    $('#productsDiv').html(response);
    },
    error: function(e) {
    //called when there is an error
    console.log(e.message);
    }
    });
}
*/

