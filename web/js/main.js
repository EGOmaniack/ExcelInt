$(document).ready( function() {

 $('#nav-icon1').click(function(){
		$(this).toggleClass('open');
	});


var p = document.getElementById("print");

printP("Поле ввода");

function printP (text){

	p.innerText = text;
}


});
