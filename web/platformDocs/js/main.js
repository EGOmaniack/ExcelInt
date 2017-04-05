function rep_items(repairs, platf_number){

    var repaires = [];
    var list;
    $.each(repairs[platf_number], function(index, value){
        list  = '<div id="' + value.id /* - id ремонта*/ + '" platform="' + value.platf_number + '" class="item">';
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
    var repair_id = $(this).parent().parent().attr('id');
    var platform_num = $(this).parent().parent().attr('platform');
    var repText, repDateStart, repDateEnd;
    var jobs = [];
    var jobs_ids = [];
    var job_list="";
    $.each(window.session.platf_repairs[platform_num], function(index, value){
        if(value.id == repair_id) {
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
            if(value.id == job){
                jobs.push(value.name);
            }
        });
    });
    $('#job_list_main').html(jobs_items(jobs));
});


function jobs_items(jobs){
    var job_item ="";
    $.each(jobs, function(index, value){
        job_item += "<p class=\"item2\">" + value + "</p>";
    });
    
    return job_item;
}
