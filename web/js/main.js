$(document).ready( function() {

 $('#nav-icon1').click(function(){
		$(this).toggleClass('open');
	});


var p = document.getElementById("print");

printP("<strong>Укажите Файл excel</strong>");




});


//сделать запись на экране
function printP (text){

    p.innerText = text;
}

