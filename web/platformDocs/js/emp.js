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
                    'pl_num="' + platforms[platforms.all[i]].number + '"' +
                    'rep_num = "' + j + '"' +
                    'job_id="' + index + '"' +
                    'fam_id="' + g + '"' +
                    'class="wceil"></div>';
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
    $(this).append('<i class="fa fa-spinner fa-pulse fa-2x fa-fw" aria-hidden="true"></i>');
 });