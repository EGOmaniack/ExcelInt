function rep_items(repairs, platf_number){

    var repaires = [];
    var list;
    $.each(repairs[platf_number], function(index, value){
        list  = '<div id="' + value.id /* - id ремонта*/ + '" platform="' + value.platf_number + '" class="item">';
        list += '   <span class="close">&times;</span>'
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
function jobs_items(jobs){
    var job_item ="";
    $.each(jobs, function(index, value){
        job_item += "<div class=\"item2\"><span class=\"job_del\">&times;</span><p style=\"marging: 0; adding: 0; display: inline;\">"
            + value + "</p></div>";
    });
    
    return job_item;
}

$('.change_pl').click(function(){
    location.href = "/platformDocs/change_platform.php/?pl=" + $(this).attr('platform')
});

$('.old_platf').click(function(){
    $('#jobs').addClass('hide');
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

/* Показыть перечень работ для данного ремонта */
$('#action_selector').on('click','#repair_details',function(e){
    repair.dispatch({type: 'repIdPlatfNum', payload: {
      repairID: $(this).parent().parent().attr('id'),
      platfNumber: $(this).parent().parent().attr('platform')
     } });
    var repair_id = $(this).parent().parent().attr('id');
    var platform_num = $(this).parent().parent().attr('platform');

    var repText, repDateStart, repDateEnd;
    var jobs = [];
    var jobs_lubs = [];
    var jobs_ids = [];
    var job_list="";
    $.each(window.session.platf_repairs[platform_num], function(index, value){
        if(value.id == repair_id) { /**вытаскиваю данные о ремонте из сессии */
            repair.dispatch({type:'repTextStartEnd', payload: {
                repairText: value.repair_type,
                repairStart: value.repair_start,
                repairEnd: value.repair_end
            }
        });
            repText = value.repair_type;
            repDateStart = value.repair_start;
            repDateEnd = value.repair_end;
            // console.log( repText, repDateStart, repDateEnd );
        }
    });

    $('#jobs').removeClass('hide');
    $('#repJobsTitle').html(repText);
    $.each(window.session.repsJobs, function(index, value){
        if(value.rep_id == repair_id){
            jobs_ids.push( value.job_id );
        }
    });
    $.each(jobs_ids, function (ind, job){
        $.each(window.session.jobs, function(index, value){
            if(value.id == job && value.razdel != 3 ){
                jobs.push(value.name);
            }
        });
    });
    $.each(jobs_ids, function (ind, job){
        $.each(window.session.jobs, function(index, value){
            if(value.id == job && value.razdel == 3 ){
                jobs_lubs.push(value.name);
            }
        });
    });
    repair.dispatch( {type: "addjobs", payload: jobs} );
    repair.dispatch( {type:"addlubs", payload: jobs_lubs});
    $('#job_list_main').html(jobs_items(jobs));
    $('#job_list_smazka').html(jobs_items(repair.get().lubjobs));
});

$('#job_list_smazka').on('click','.job_del', function(){
    alert('Пока удалять нельзя )');
});


