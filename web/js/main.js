$(document).ready( function() {
    var defaultcolor = 'black';
    printP('Укажите Файл excel с калькуляциями', '#5F2421');

    //Блокировак/разблокировка кнопки если вайл не выбран/выбран
     $('#btn').attr('disabled','disabled');
    $('#forma').on('change', function (){
        $('#btn').removeAttr('disabled');
    });





//сделать запись на экране
function printP (text, color){
    $('#print').text(text);
    $('#print').css('color', (color == undefined ? defaultcolor : color));
}

});
