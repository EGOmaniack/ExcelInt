function rep_items(repairs, platf_number){

    var repaires = [];
    var list;
    $.each(repairs[platf_number], function(index, value){
        list  = '<div id="' + value.id + '" platform="' + value.platf_number + '" class="item">';
        list += '   <span id="modal_close" class="close">&times;</span>'
        list += '   <div class="inwrapper">';
        list += '   <div class="status ' + (value.repair_end == null ? "blue" : "green") + '"></div>';
        list += '       <h4 class="rep_name">Дата: ' + value.repair_start+'</h4>';
        list += '       <div class="spacer"></div>';
        list += '       <p class="rep_type">' + value.repair_type+'</p>';
        list += '       <div class="spacer"></div>';
        list += '       <div id="repair_details" title="данные по ремонту" class="details"></div>';
        list += '       <div class="spacer"></div>';
        list += '       <div id="repair_edit" title="Редактировать" class="edit"></div>';
        list += '       <div class="spacer"></div>';
        list += '       <div title="Распечатать паспорт" class="print"></div>';
        list += '   </div>';
        list += '</div>';

        repaires.push(list);
    });
        return repaires;
}



    $('.change_pl').click(function(){
        location.href = "/platformDocs/change_platform.php/?pl=" + $(this).attr('platform')
    });

    $('.old_platf').click(function(){
        $('#action_selector').removeClass('hide');
        $('#platform_info').text("Платформа "
        + window.session.platforms[this.id].platf_name
        + " №" + window.session.platforms[this.id].platf_number);
        $('#repairs').html(rep_items(window.session.platf_repairs, this.id));
        $('.change_pl').attr('platform', window.session.platforms[this.id].platf_number);
    });
    
    $('.new_platf').click(function(){
        location.href = "/platformDocs/new_platform.php";
    });

    $('#action_selector').on('click','.close',function(e){
        var id = $(this).parent().attr('id');
        if(confirm("Вы уверены?\nВсе данные об этом ремонте будут утеряны!")){
            console.log(id); // /ajax/delete_repair.php
            $.post("./ajax/delete_repair.php", {
            repair_id: id
            },function (data) {
            if(data != undefined){
                //alert('created');
                //$('body').html('');
                //$('body').append(data);
                location.href = '/platformDocs/index.php';
            }
            });
        }
    });

    $('#action_selector').on('click','.print',function(e){
        var id = $(this).parent().parent().attr('id');
        var platform_id = $(this).parent().parent().attr('platform');
        var platform = JSON.stringify(window.session.platforms);
        var repairs = JSON.stringify(window.session.platf_repairs);
        // console.log(id);
        // location.href = '/platformDocs/ajax/getpassport.php/?file=passport&id=' + id + '';
        $.post("./ajax/create_passport.php", {
        repair_id: id,
        platform_id: platform_id,
        platform: platform,
        platf_repairs: repairs
        },function (data) {
        if(data != undefined){
            //alert('created');
            //$('body').html('');
            //$('body').append(data);
            location.href = '/platformDocs/phpScripts/get_passport.php?file=' + data;
        }
        });
    });
    
$(function(){
    // console.log(window.session.platf_repairs);
});

$('.tst').click(function(){
    console.log($('#pmss').val());
});