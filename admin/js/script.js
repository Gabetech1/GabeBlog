tinymce.init({
  selector:'textarea',
  plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
  toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
  toolbar_mode: 'floating',
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',
});



$(document).ready(function(){
console.log('Hello world');


$('#selectAllBoxes').click(function(event){

if(this.checked){

  $('.checkBoxes').each(function(){
    this.checked = true;
  });

}else{

  $('.checkBoxes').each(function(){
    this.checked = false;
  });

}

});


/* var div_box = "<div id='load-screen'><div id='loading'></div></div>";
*/
$("body").prepend("hello");

/* $('#load-screen').delay(700).fadeOut(600, function(){
$(this).remove();
}) */


});

function loadUsersOnline(){
  $.get("functions.php?onlineusers=result", function(data){

    $(".usersonline").text(data);
    //console.log('users ',data);
  });
}
loadUsersOnline();

setInterval(() => {
  loadUsersOnline();
}, 500);


