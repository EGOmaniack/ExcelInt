function rep_items(repairs, platf_number){

    var repaires = [];
    var list;
    $.each(repairs[platf_number], function(index, value){
        list = '<div class="item">';
        list += '<div class="inwrapper">';
        list += '<h4 class="rep_name">Дата: '+value.repair_start+'</h4>';
        list += '<div class="spacer"></div>';
        list += '<p class="rep_type">'+value.repair_type+'</p>';
        list += '<div class="spacer"></div>';
        list += '<div title="Редактировать" class="edit"></div>';
        list += '<div class="spacer"></div>';
        list += '<div title="Распечатать паспорт" class="print"></div>';
        list += '</div>';
        list += '</div>';
        repaires.push(list);
    });
        
        return repaires;
}

$(function(){
    $('.old_platf').click(function(){
        $('#action_selector').removeClass('hide');
        $('#platform_info').text("Платформа "
        + window.session.platforms[this.id].platf_name
        + " №" + window.session.platforms[this.id].platf_number);
        $('#repairs').html(rep_items(window.session.platf_repairs, this.id));
    });
    
    $('.new_platf').click(function(){
        $('#action_selector').addClass('hide');
    });

    // console.log(window.session.platf_repairs);
});