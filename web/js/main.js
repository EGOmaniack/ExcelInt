$(document).ready( function() {
    // var defaultcolor = 'black';
    // printP('Укажите Файл excel с калькуляциями', '#5F2421');
    //
    // //Блокировак/разблокировка кнопки если вайл не выбран/выбран
    //  $('#btn').attr('disabled','disabled');
    // $('#forma').on('change', function (){
    //     $('#btn').removeAttr('disabled');
    // });





//сделать запись на экране
function printP (text, color){
    $('#print').text(text);
    $('#print').css('color', (color == undefined ? defaultcolor : color));
}

function names(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            printP(this.responseText);
        }
    };
    xhttp.open("GET", "names.txt", true);
    xhttp.send();
    }

    // $('#btn').click(function(){
    //     this.value="Wating...";
    //     $.ajax({
    //         url: "/ajax/Names.php",
    //         method: "POST",
    //         data: { name : $('#names').val(), age : 22 },
    //         dataType: "json"
    //
    //     }).done(function (aa) {
    //
    //         var array = $.map(aa, function(value, index) {
    //             return [value];
    //         });
    //         var Agregats,matlist;
    //
    //         // for (var j=0 ; j < array.length ; j++ ){
    //         //  // Agregats[array[j].name] = array[j].matlist;
    //         //  Agregats.push({array[j].name:array[j].matlist});
    //         // }
    //
    //         $('#btn').val('Ready');
    //         // $(body).appendTo('<br><div>'+aa.name+'</div>');
    //         // alert(aa.name);
    //         var htmlstr= "";
    //         for(var i = 0; i<array.length;i++){
    //             htmlstr += '<br><div>'+array[i].name+'</div>';
    //         }
    //         $('#cont').html(htmlstr);
    //         this.value="Ready";
    //     })
    //
    // });

});
