
$(document).ready(function(){
//  $("#productsBtn").on('click',function(){
  $.ajax({
    url: 'visualize_products.php',
    type: 'POST',
    data: {query: $("SELECT * FROM products").val()},
    dataType: 'json',
    success: function(response) {

    //called when successful

    $('#productsDiv').html(response);

   
    //response = $.parseJSON(response);

   
    var trHTML = '';
    /*$.each(response, function (i, item) {
        trHTML += '<tr><td>' + item.name + '</td><td>' + item.content + '</td><td>' + item.UID + '</td></tr>';
    });*/
    var dataURI = 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQBWULz04u__ZfN3_ZFUIwXq2Bb3shG4d5ffCJ6WojQeKjchjjtDQmCU9Jp2qQ4AA&usqp=CAc';
    $('<img/>').attr('src', dataURI).appendTo('#productstable');
    $('#productstable').append('<tr><td>'+response.name+'</td>'+'<td>'+response.type+'</td>'+'<td>'+response.price+'</td>'+ '<td><a href="basket.php">'+"Acquista" +'</a></td>+</tr>');
    //$('#productstable').append('<tr><td>'+response.name+'</td>'+'<td>'+response.type+'</td>'+'<td>'+response.price+'</td>'+ '<td><a href="basket.php">'+"Acquista" +'</a></td>+</tr>');
   
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

