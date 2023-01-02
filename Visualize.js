
$(document).ready(function(){
  $("#invia").click(function(){
    $.ajax({
      url: 'db1.php',
      type: 'GET',
      data: {query: $("#query").val()},
      success: function(response) {
      //called when successful
      $('#result').html(response);
      },
      error: function(e) {
      //called when there is an error
      console.log(e.message);
      }
      });
  });
});












