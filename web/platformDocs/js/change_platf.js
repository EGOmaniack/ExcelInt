$('#change').click(function(){
    $(this).html('меняем...');
    $.post("./../ajax/change_platform.php", {
        id: $('#platf_id').val(),
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
            // $('body').html('');
            // $('body').append(data);
            // $('#insert').html("Изменить");
            location.href = "./platformDocs/index.php";
            //$(".form").children().val("");
        }
    });
    //location.href = "./platformDocs/index.php";
});