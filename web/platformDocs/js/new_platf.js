$(function(){
    
});


$('#insert').click(function () {
    $('#insert').html("Отправка...");
    // debugger;
    console.log(this);
    self = this;
    $.post("./ajax/insert_platform.php", {
        name: $('#name').val(),
        number: $('#number').val(),
        owner: $('#owner').val(),
        full_name: $('#full_name').val(),
        factory_number: $('#factory_number').val(),
        release_date: $('#release_date').val(),
        factory_name: $('#factory_name').val()
    }, function (data) {
        if(data != undefined){
            console.log(data);
            
            $('#insert').html("Отправлено");
            // location.href = "./platformDocs/index.php";
            //$(".form").children().val("");
        }
    });
    location.href = "./platformDocs/index.php";
});