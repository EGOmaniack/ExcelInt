


$(document).ready( function() {
    var defaultcolor = 'black';
    printP('Добро пожаловать', '#58A963');
    
    // сворачиваем разворачиваем текст
    $('.ShowHide').click(function(){
		$('.hiddeble').toggleClass('hidden');
	});
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

var BrowserDetect = { 
  init: function () { 
  this.browser = this.searchString(this.dataBrowser) || "An unknown browser"; 
  this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "an unknown version"; 
  this.OS = this.searchString(this.dataOS) || "an unknown OS"; 
  }, 
  searchString: function (data) { 
  for (var i=0;i<data.length;i++) { 
  var dataString = data[i].string; 
  var dataProp = data[i].prop; 
  this.versionSearchString = data[i].versionSearch || data[i].identity; 
  if (dataString) { 
  if (dataString.indexOf(data[i].subString) != -1) 
  return data[i].identity; 
  } 
  else if (dataProp) 
  return data[i].identity; 
  } 
  }, 
  searchVersion: function (dataString) { 
  var index = dataString.indexOf(this.versionSearchString); 
  if (index == -1) return; 
  return parseFloat(dataString.substring(index+this.versionSearchString.length+1)); 
  }, 
  dataBrowser: [ 
    { 
    string: navigator.userAgent, 
    subString: "Chrome", 
    identity: "Chrome" 
    }, 
    { string: navigator.userAgent, 
    subString: "OmniWeb", 
    versionSearch: "OmniWeb/", 
    identity: "OmniWeb" 
    }, 
    { 
    string: navigator.vendor, 
    subString: "Apple", 
    identity: "Safari", 
    versionSearch: "Version" 
    }, 
    { 
    prop: window.opera, 
    identity: "Opera", 
    versionSearch: "Version" 
    }, 
    { 
    string: navigator.vendor, 
    subString: "iCab", 
    identity: "iCab" 
    }, 
    { 
    string: navigator.vendor, 
    subString: "KDE", 
    identity: "Konqueror" 
    }, 
    { 
    string: navigator.userAgent, 
    subString: "Firefox", 
    identity: "Firefox" 
    }, 
    { 
    string: navigator.vendor, 
    subString: "Camino", 
    identity: "Camino" 
    }, 
    {  
    /* For Newer Netscapes (6+) */ 
    string: navigator.userAgent, 
    subString: "Netscape", 
    identity: "Netscape" 
    }, 
    { 
    string: navigator.userAgent, 
    subString: "MSIE", 
    identity: "Internet Explorer", 
    versionSearch: "MSIE" 
    }, 
    { 
    string: navigator.userAgent, 
    subString: "Gecko", 
    identity: "Mozilla", 
    versionSearch: "rv" 
    }, 
    {  
    /* For Older Netscapes (4-) */ 
    string: navigator.userAgent, 
    subString: "Mozilla", 
    identity: "Netscape", 
    versionSearch: "Mozilla" 
    } 
    ], 
    dataOS : [ 
    { 
    string: navigator.platform, 
    subString: "Win", 
    identity: "Windows" 
    }, 
    { 
    string: navigator.platform, 
    subString: "Mac", 
    identity: "Mac" 
    }, 
    { 
    string: navigator.userAgent, 
    subString: "iPhone", 
    identity: "iPhone/iPod" 
    }, 
    { 
    string: navigator.platform, 
    subString: "Linux", 
    identity: "Linux" 
    } 
  ] 

}; 
BrowserDetect.init();

// document.getElementById("name").innerHTML=BrowserDetect.browser; 
// document.getElementById("version").innerHTML=BrowserDetect.version; 
// document.getElementById("os").innerHTML=BrowserDetect.os

if(navigator.appName != "Microsoft Internet Explorer" && BrowserDetect.version > 12 ){
    $("#pkbsrv").hide();
}
