var repair = createStore({
    platfNumber: null,
    platformID: null,
    repairType: null,
    repairText: null,
    repairID: null,
    repairStart: null,
    repairEnd: null,
    jobs : [],
    lubjobs:[]
},
update);

repair.SetDev();/**Включаем режим разработки
                * Все изменения state будут записываться в _history
                */
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
function jobs_items(jobs){/**отрисовка элементов списка перечня работ */
    var job_item ="";
    $.each(jobs, function(index, value){
        job_item += "<div jobId=" + value.id + " class=\"item2\"><span class=\"job_del\">&times;</span><p style=\"marging: 0; adding: 0; display: inline;\">"
            + value.name + "</p></div>";
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
/* Показыть перечень работ для данного ремонта */
$('#action_selector').on('click','#repair_details',function(e){
    repair.dispatch({type: 'reset'});
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
            if(value.id == job && value.razdel != 4 ){ /**Хардкод раздел №4 это 'К смазке' */
                jobs.push({id:value.id, name: value.name});
            }
        });
    });
    $.each(jobs_ids, function (ind, job){
        $.each(window.session.jobs, function(index, value){
            if(value.id == job && value.razdel == 4 ){ /* hardcode 3 - правильный раздел только для платформы ППК-2В и только для ТР2 объема */
                jobs_lubs.push({id:value.id, name: value.name});
            }
        });
    });
    repair.dispatch( {type: "addjobs", payload: jobs} );
    repair.dispatch( {type:"setlubs", payload: jobs_lubs});
    $('#job_list_main').html(jobs_items(repair.get().jobs));
    $('#job_list_smazka').html(jobs_items(repair.get().lubjobs));
    repair.sine(function(){ /**подписал список работ на изменения */
        console.log("Список работ перерендерился");
        $('#job_list_main').html(jobs_items(repair.get().jobs));
        $('#job_list_smazka').html(jobs_items(repair.get().lubjobs));
    });
});

$('#jobs').on('click','.job_del', function(){
    var repId = repair.get().repairID;
    var jId = $(this).parent().attr('jobid');
    // console.log(repId, jId);

    $.post("./ajax/deljob.php", {
        repair_id: repId,
        jobId: jId
        },function (data) {
        if(data != undefined){
            /* $('body').html('');
            $('body').append(data); */
            location.href = '/platformDocs/index.php';
        }
    });
});



