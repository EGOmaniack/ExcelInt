$(document).ready( function() {

    printP('Укажите Файл excel с калькуляциями', '#5F2421');
   // printP('Укажите Файл бля');



    // $('#btn').prop("disable", false);

    var defaultcolor = 'black';



//сделать запись на экране
function printP (text, color){
    $('#print').text(text);
    $('#print').css('color', (color == undefined ? defaultcolor : color));
}

});
