
if(navigator.appName != "Microsoft Internet Explorer"){
    $("#pkbsrv").hide();
}

$(document).ready( function() {
    var defaultcolor = 'black';
    printP('Добро пожаловать', '#58A963');
    
    // сворачиваем разворачиваем текст
    $('.ShowHide').click(function(){
		$('.hiddeble').toggleClass('hidden');
	});
    if(navigator.appName != "Microsoft Internet Explorer"){}
    //сделать запись на экране
    function printP (text, color){
        $('#print').text(text).css('color', (color == undefined ? defaultcolor : color));
    }


    $('a#mw').click( function(event){ // лoвим клик пo ссылки с id="go"
        event.preventDefault(); // выключaем стaндaртную рoль элементa
        $('#overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
            function(){ // пoсле выпoлнения предъидущей aнимaции
                $('#modal_form') 
                    .css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
                    .animate({opacity: 1, top: '50%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
        });
    });
    /* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
    $('#modal_close, #overlay').click( function(){ // лoвим клик пo крестику или пoдлoжке
        $('#modal_form')
            .animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                function(){ // пoсле aнимaции
                    $(this).css('display', 'none'); // делaем ему display: none;
                    $('#overlay').fadeOut(400); // скрывaем пoдлoжку
                }
            );
    });



    
    // //Блокировак/разблокировка кнопки если вайл не выбран/выбран
    //  $('#btn').attr('disabled','disabled');
    // $('#forma').on('change', function (){
    //     $('#btn').removeAttr('disabled');
    // });

    // $('#btn').click(function(){
    //     this.value="Wating...";
    //     $.ajax({
    //         url: "/ajax/Names.php",
    //         method: "POST",
    //         data: { name : $('#names').val(), age : 22 },
    //         dataType: "json"
    
    //     }).done(function (aa) {
    
    //         var array = $.map(aa, function(value, index) {
    //             return [value];
    //         });
    //         var Agregats,matlist;
    
    //         // for (var j=0 ; j < array.length ; j++ ){
    //         //  // Agregats[array[j].name] = array[j].matlist;
    //         //  Agregats.push({array[j].name:array[j].matlist});
    //         // }
    
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
    
    // });

});
