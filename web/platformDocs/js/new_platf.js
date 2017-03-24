$(function(){
    
});

$('#insert').click(function () {
    $('#insert').html("Отправка...");
    console.log(this);
    self = this;
    $.post("./ajax/insert_platform.php", {
        name: $('#name').val(),
        number: $('#number').val(),
        owner: $('#owner').val(),
        full_name: $('#full_name').val(),
        factory_number: $('#factory_number').val(),
        release_date: $('#release_date').val()
    }, function (data) {
        if(data != undefined){
            alert(data);
            
            $('#insert').html("Отправлено");
            //location.href = "/platformDocs/index.php";
            //$(".form").children().val("");
        }
    });
});