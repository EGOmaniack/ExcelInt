$(document).ready( function() {

    printP('Укажите Файл excel\'я', '#ffcc00');

    $('#btn').click(function () {
        this.value = 'Waiting...';
        var data = new FormData();
        alert('clicked');
        // jQuery.each(jQuery('#ExcelFile')[0].files, function(i, file) {
        //     data.append('file-'+i, file);
        // });
        // $.ajax({
        //     url: "/ajax/ajaxCalc.php",
        //     data: data,
        //     cache: false,
        //     contentType: false,
        //     processData: false,
        //     type: 'POST',
        //     success: function(data){
        //         alert(data);
        //     }
        // })
    });

});


//сделать запись на экране
function printP (text, color){
    $('#print').text(text);
    $('#print').css('color' , 'gray' );
}
//(color == undefined ? 'gray' : color)


