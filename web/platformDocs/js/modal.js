function getJobsList(root, lvl){
    var level = (lvl == undefined)? 1 : lvl;
    var banList = [ "main_t2", "main_t1", "smazka" ];
    var jobs = window.session.jobs;
    var sections = window.session.sections;
    var response = "";
    var haveChilds = false;
    
    $.each(sections, function(index, value){/**вставляем подразделы */
        if(value.parent_sec == root && ($.inArray(value.name, banList) == -1) ){
            var haveChilds = false;
            
            response +=
                '<div' + 
                ' style="width: ' + (80 - level * 5) +'%"' +
                ' level=' +  (parseInt(level) + 1)  +
                ' item_id=' + value.id +
                ' parent_id=' + value.parent_sec +
                ' class="item razdel" opened="false">' +
                value.name +
                '</div>\n';
        }
    });
    $.each(jobs, function(index, value){
        if( value.razdel == root ){
            response += 
            '<div' + 
                ' style="width: ' + (80 - level * 5) +'%"' +
                ' level=' + ( level + 1 ) +
                ' item_id=' + value.id +
                ' parent_id=' + value.razdel +
                ' class="job" opened="false">' +
                value.name +
                '</div>\n'; 
        }
    });

    return response;
};

function getSecJobName(id){
    var result = "null";
    var jobs = window.session.jobs;
    var sections = window.session.sections;
    $.each(sections, function(index, value){
        if(value.id == id ){
            result = value.namee;
        }
    });
    return result;
}

$('#modal2list').on('click','.item',function(){
    var id = $(this).attr('item_id');
    if($(this).attr('opened') == 'false'){
        $(this).attr('opened', "true");
        //$(this).html(getSecJobName($(this).attr('item_id')));
        $(this).after(getJobsList($(this).attr('item_id'),$(this).attr('level') ));
    } else {
        $(this).attr('opened', "false");
        $('.item').each(function(index, value){

            var localId = value.getAttribute('item_id')

            if(value.getAttribute('parent_id') == id ){
                value.remove();
                $('.job').each(function(index, val){
                    if(val.getAttribute('parent_id') == localId ){
                        val.remove();
                    }
                });
            }
        });
        $('.job').each(function(index, value){
            if(value.getAttribute('parent_id') == id ){
                value.remove();
            }
        });
    }
});

// Get the modal
var modal = document.getElementById('myModal');
var modal2 = document.getElementById('my_modal_2');

// Get the button that opens the modal
var btn = document.getElementById("btn_modal");
var btn2 = document.getElementById("btn_mdl2"); /**Кнопка добавить запись о работе */

// Get the <span> element that closes the modal
var span = document.getElementById("modal_close");
var span2 = document.getElementById("modal2_close");

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
    $('#new_repair_btn').text('создать');
    $('#myModal').attr("type","new_repair");
}
// Нажата кнопка вызова добавить запись о ремонте модального окна
btn2.onclick = function() {
    modal2.style.display = "block";
    $('#new_repair_btn').text('создать');
    $('#myModal').attr("type","new_repair");
    $('#modal2list').html(getJobsList(1, 0)); /* Запрашиваем разделы с работами, передаем туда id root элемента секции hardcode */

    /**возвращать надо что-то такого формата <div class="item"></div> */
}
span2.onclick= function() {
    modal2.style.display = "none";
};
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
    }else if(event.target == modal2){
        modal2.style.display = "none";
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
                // $('body').html(data);
                
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