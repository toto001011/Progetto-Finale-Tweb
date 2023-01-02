
$(document).ready(function(){
//  $("#productsBtn").on('click',function(){
    showProducts();
 // });
});





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


