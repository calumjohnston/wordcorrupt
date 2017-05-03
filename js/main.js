$(document).ready(function(){

  $('#corrupt').prop('disabled', true);
  $('#download').prop('disabled', true);

  $("input[type=file]").change('click',function(){
      var $filename = $('input[type=file]').val().split('\\').pop();
      $("#filename").text("File:" + $filename);
  });
  $("input[type=file]").on('click',function(){
      $("#filename").text("");
      $("#success-message").text("");
  });

  $('.form-signin').submit(function(){
    $("#success-message").text("Successfully Corrupted");
    $('#corrupt').prop('disabled', true);
});


  //validation
  var myfile="";

  $("input[type=file]").on( 'change', function() {
     myfile= $( this ).val();
     var ext = myfile.split('.').pop();
     if(ext=="docx" || ext=="doc" || ext=="xlsx" || ext=="xlsm" || ext=="xls"){
         $('#corrupt').prop('disabled', false);
     } else{
         $("#filename").text("File has to be either .docx or .doc format.");
         $('#corrupt').prop('disabled', true);
     }
  });

//show about on click
$("#aboutlink").on("click",function(){
  $("#app").css("display","none");
  $("#aboutdiv").css("display","block");

})

$("#backbutton").on("click",function(){
  $("#app").css("display","block");
  $("#aboutdiv").css("display","none");

})


/* //blink
var x = 0;
var intervalID = setInterval(function () {

  $('.blink').each(function(){

      $(this).css('visibility' , $(this).css('visibility') === 'hidden' ? '' : 'hidden')

  });

   if (++x === 5) {
       window.clearInterval(intervalID);
       $(".blink").css('visibility','visible');
   }
}, 500);
*/

});
