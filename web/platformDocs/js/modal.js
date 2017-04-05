// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("btn_modal");
// Get the <span> element that closes the modal
var span = document.getElementById("modal_close");

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
    $('#new_repair_btn').text('создать');
    $('#myModal').attr("type","new_repair");
}
span.onclick = function() {
    modal.style.display = "none";
};

// When the user clicks on <span> (x), close the modal
$('#action_selector').on('click','#repair_edit',function(e){
            /**
             * меняем запись о ремонте
             */
    var platform_id = $(this).parent().parent().attr('platform');
    var rep_id = $(this).parent().parent().attr('id');

    var repair = window.session.platf_repairs[platform_id][rep_id];
    $('#myModal').attr("type","change_repair");
    $('#myModal').attr("rep_id",rep_id);
    modal.style.display = "block";
    $.each($('.select-option'), function(index, value){
        value.removeAttribute("selected");
        //if(value.getAttribute("value") == "0") { value.setAttribute("selected","") }
        if(value.getAttribute("value") == repair['repaire_type_code']) { value.setAttribute("selected","") }
        // console.log(value.val());
    });
    $('#new_repair_btn').text('изменить');
    $('#rep_start').attr('value', repair.repair_start);
    $('#rep_end').attr('value', repair.repair_end);
    
    //console.log(window.session.platf_repairs[platform_id][rep_id]['full_name']);

});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

$('#new_repair_btn').click(function(){
    var n_rep_date = $('#rep_start').val();
    var n_rep_type = $('#rep_type').val();
    var rep_end = $('#rep_end').val();
    var platf_number = $('.change_pl').attr('platform');
    $('#rep_end').attr( 'value', undefined );
   
    // alert(platf_number);
    if($('#myModal').attr("type") == "new_repair"){
        $.post("./ajax/insert_repair.php", {
            n_rep_date: n_rep_date,
            n_rep_type: n_rep_type,
            n_rep_end: rep_end,
            platf_number: platf_number
            },function (data) {
            if(data != undefined){
                var modal = document.getElementById('myModal');
                modal.style.display = "none";
                location.href = "/platformDocs/index.php";

                //console.log(data);
                //$('body').html('');
                //$('body').append(data);
            }
        });
    }else if ($('#myModal').attr("type") == "change_repair") { /**еслт тип модального окна стоит "изменить запись о ремонте" */
        //if(confirm("Вы уверены?\nВсе данные о работах по этому ремонту будут утеряны!")){
            /**Если сменить вид ремонта, то список работ надо убивать
             * так как у каждого вида ремонта свой список работ
             * 2 вариант искать аналоги в списке работ и переносить их
             */
            var rep_id = $('#myModal').attr("rep_id"); /** считываем id(id из БД) ремонта записанное в модальное онко */

            $.post("./ajax/change_repair.php", {
                rep_date: n_rep_date,
                rep_type: n_rep_type,
                rep_end: rep_end,
                rep_id: rep_id
                },function (data) {
                if(data != undefined){
                    var modal = document.getElementById('myModal');
                    modal.style.display = "none";
                    // console.log(data);
                    location.href = "/platformDocs/index.php";
                    //$('body').html('');
                    //$('body').append(data);
                }
            });
        //}
    }
    
});