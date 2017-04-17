/**функция  возвращает фамилию и инициалы */
function getName(i){
    var fam = window.session.emps[i].surname;
    var name = window.session.emps[i].name;
    var middle_name = window.session.emps[i].middle_name;
    return fam + " " + name[0] + "." + middle_name[0] + ".";
}

$(function(){

var empNumber = window.session.emps.length;

//$('.content').html('');

/**Генерируем список фамилий */
var fams = '<div class="fams">';
for(var i = 0; i < empNumber; i++){
    fams += '<div fam_id="' + i + '" class="emp_fam vertical-text">' + getName(i) + '</div>';
}
fams += '</div>';

$('.content').append(fams); /**Вставляем список фамилий на страницу */

/* теперь таблица работ */
var platforms = window.session.platforms;
var jobsInfo = window.session.jobsInfo;
var emps = window.session.emps;
var jobs_emps = window.session.jobs_emps;
var mainTable = '<div class="mainTable">';
for( i = 0; i < platforms.all.length ; i++ ){/**перебираем платформы */
    mainTable += '<div class="platform">';
    mainTable += '<div class="title">' + "Платформа " + platforms[platforms.all[i]].name + " №" + platforms[platforms.all[i]].number + '</div>';
    for(var j=0 ; j < jobsInfo[platforms.all[i]].length; j++){ /**Перебираем ремонты. Вдруг их больше чем 1 */
        mainTable += '<div class="title repTitle"><div class="repairTitle">' + jobsInfo[platforms.all[i]][j].repairInfo.type + '</div></div>';
        $.each(jobsInfo[platforms.all[i]][j], function(index, value){
            mainTable += '<div class="tabString">';
            if(index != 'repairInfo'){
                if(value.section == 'К смазке'){
                    mainTable += '<div job_id="' + index + '" class="workTitle" title="' + value.name + '">' + "Смазать " + value.name.substring(0,30) + '</div>';
                }else{
                    mainTable += '<div job_id="' + index + '" class="workTitle" title="' + value.name + '">' + value.name.substring(0,35) + '</div>';
                }
                mainTable += '<div class="wceils">';
                for(var g = 0; g < empNumber; g ++){
                    mainTable += '<div ' +
                    'pl_num="' + platforms[platforms.all[i]].number + '" ' +
                    'rep_num = "' + j + '" ' +
                    'job_id="' + index + '" ' +
                    'fam_id="' + g + '" ' +
                    'busy="false" ' +
                    'class="wceil ';
                    if(jobs_emps[index] !== undefined && jobs_emps[index][emps[g].id] !== undefined) mainTable += "busy";
                    mainTable += ' "></div>';
                /**Каждая ячейка хранит в себе всю инфу */
                }
                mainTable += '</div>';
            }
            mainTable += '</div>'
        });
    }
    mainTable += '</div>';
}
mainTable += '</div>';
$('.content').append(mainTable);
});

$('.content').on('mouseenter','.wceil', function(){
    $(this).addClass('hovered');
    var job_id = $(this).attr('job_id');
    var fam_id = $(this).attr('fam_id');
    $('.workTitle').each(function(index, value){
        if($(this).attr('job_id') == job_id){
            $(this).addClass('hovered');
        }
    });
    $('.emp_fam').each(function(index, value){
        if($(this).attr('fam_id') == fam_id){
            $(this).addClass('txthvred');
        }
    });
});
$('.content').on('mouseleave','.wceil', function(){ 
    $(this).removeClass('hovered');
    var job_id = $(this).attr('job_id');
    var fam_id = $(this).attr('fam_id');
    $('.workTitle').each(function(index, value){
        if($(this).attr('job_id') == job_id){
            $(this).removeClass('hovered');
        }
    });
    $('.emp_fam').each(function(index, value){
        if($(this).attr('fam_id') == fam_id){
            $(this).removeClass('txthvred');
        }
    });
 });
$('.content').on('click','.wceil', function(){
    if(!$(this).hasClass('busy')){
       var plutform_id = $(this).attr('pl_num');
       var job_id = $(this).attr('job_id');
       var fam_id = window.session.emps[$(this).attr('fam_id')].id;
       var self = this;
       $(this).append('<i class="fa fa-spinner fa-pulse fa-2x fa-fw" aria-hidden="true"></i>');
       $.post("./ajax/addJobEmp.php", { /**Отправить запрос на внесение в изменений в бд */
       insert: true,
       job_id: job_id,
       fam_id: fam_id
       }, function (data) {
       if(data != undefined){
           if(data == 'done'){
               $(self).addClass('busy');
               $(self).html('');
           }else if(data == 'error'){
               alert('Ошибка.\nЧто-то пошло не так. Обратитесь к знающему человеку)')
               $(self).html('');
           }
            // $('body').html('');
            // $('body').append(data);
            // console.log(data);
            //location.href = '/platformDocs/index.php';
       }
       });
    } else {
        var plutform_id = $(this).attr('pl_num');
        var job_id = $(this).attr('job_id');
        var fam_id = window.session.emps[$(this).attr('fam_id')].id;
        var self = this;
        $(this).html('');
        $(this).append('<i class="fa fa-spinner fa-pulse fa-2x fa-fw" aria-hidden="true"></i>');
        $.post("./ajax/addJobEmp.php", { /**Отправить запрос на внесение в изменений в бд */
        insert: false,
        job_id: job_id,
        fam_id: fam_id
        }, function (data) {
        if(data != undefined){
            if(data == 'done'){
                $(self).removeClass('busy');
                $(self).html('');
            }else if(data == 'error'){
                alert('Ошибка.\nЧто-то пошло не так. Обратитесь к знающему человеку)');
                $(self).html('');
            }else{
                console.log(data);
            }
                // $('body').html('');
                // $('body').append(data);
                // console.log(data);
                //location.href = '/platformDocs/index.php';
        }
        });
    }
 });