<?php
 include_once './phpScripts/vers.php'; //Парсит лог версий
 include_once './phpScripts/getPlatforms.php'; //Вытаскивает из БД информацию по платформам
 include_once './phpScripts/getPlatf_repairs.php'; //Вытаскивает из БД информацию по всем ремонтам
 include_once './phpScripts/getJobs.php'; //Вытаскиваем из бд пересень работ и разделов
 include_once './phpScripts/getRepsJobs.php';

$sek = strtotime("now");

$json = json_encode($_SESSION); // include 2 и 3 передают данные в session. Тут вытаскиваем их от туда.

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>platforms</title>
    <link rel="stylesheet" href="css/main.min.css?<?=$sek?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    <link href="css/modal.min.css?<?=$sek?>" rel="stylesheet">
    <link href="css/head.min.css?<?=$sek?>" rel="stylesheet">
    <script type="text/javascript" src="./../js/jquery-3.1.1.min.js"></script>
</head>
<body>
    <?php include_once './components/head.php';?>
    <p id="version"><?=getver('ver.txt')[0]['ver']?></p>
    <div class="mainwraper">
        <div class="devider"></div>
        <div class="card"> <!-- Карточка с платформами -->
            <h1 class="title">Выберите платформу</h1>
            <div id="platforms">
                <?php
                if($platforms) {
                    foreach($platforms as $key => $pl){
                        $platforma = "<div id='".$platforms[$key]['platf_number']."' class='platform old_platf'>";
                        $platforma .="<img src='img/platforma.png' alt='platform_ico'>";
                        $platforma .="<p class='lable'>№ ".$pl['platf_number']."</p>";
                        $platforma .="</div>";
                        echo $platforma;
                    }
                }
                ?>
                <div class="platform new_platf">
                    <img src="img/platforma_new.png" alt="platform_ico" href = "./platformDocs/new_platform.php">
                    <p class="lable">Новая платформа</p>
                </div>
            </div>
        </div>
        <div class="devider"></div>
        <div id='action_selector' class="card hide">
            <p id="platform_info"></p>
            <div platform="" class='sbtn change_pl'>Изменить</div>
            <h1 class="title">Записи о ремонтах</h1>
            <div id="repairs"></div>
            
            <div id="btn_modal" class="btn_mdl">Добавить запись</div> <!-- The Modal -->
        </div>
        <div class="devider"></div>
        <div class="card hide" id="jobs">
            <!--h1.title{ремонт такой-то такого-то объема}+p{Перечень работ}+(.inwrapper>.list>(.rep_detail_item{item $$}*5)+.plus_btn)+p{к смазке}+(.inwrapper>.list>(.rep_detail_item{item $$}*5)+.plus_btn)-->
            <h1 class="title" id="repJobsTitle">Ремонт такой-то такого-то объема</h1>
            <div id="btn_mdl2" class="btn_mdl">Добавить работу</div>
            <h4 class="min_head">Перечень работ</h4>
            <div class="inwrapper">
                <div id="job_list_main" class="list"></div>
                <div class="plus_btn"></div>
            </div>
            <h4 class="min_head">к смазке</h4>
            <div class="inwrapper">
                <div id="job_list_smazka" class="list">
                    <div class="rep_detail_item">item 01</div>
                    <div class="plus_btn"></div>
                </div>
            </div>
        </div>
        <div class="devider"></div>
        <div class="devider"></div>
    </div>
     <!-- The Modal -->
            <div type="new_repair" id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content repair_model">
                    <span id="modal_close" class="close">&times;</span>
                    <div class="modal_wrapper">
                        <h3 class="title">Заполните форму</h3>
                        <span>Дата начала ремонта:     </span><input value="<?=date('Y-m-d')?>" id='rep_start' type="date" class="field"><br>
                        <span>Дата окончания ремонта:  </span><input id='rep_end' type="date" class="field"><br>
                        <span>Вид ремонта           :  </span>
                        <select id="rep_type" name="rep_type">
                            <option class="select-option" value="0" disabled>Выберите вид ремонта</option>
                            <option class="select-option" value="t1">текущий ремонт 1 объема</option>
                            <option class="select-option" selected  value="t2">текущий ремонт 2 объема</option>
                            <option class="select-option" value="k1">капитальный ремонт 1 объема</option>
                            <option class="select-option" value="dep">деповской ремонт</option>
                        </select><br>
                        <button class="sbtn create" id="new_repair_btn" type="button">Создать</button>
                    </div>
                </div>
                <div class="modal-content repair_job_modal hide"></div>

            </div>
    <!-- End of The Modal -->
    <!--modal2-->
        <div id="my_modal_2" class="modal">
            <div id="m2content">
                <span id="modal2_close" class="close">&times;</span>
                <div id="modal2_wrap">
                    <h2 class="title">Выберите_строку</h2>
                    <div id="modal2list" class="list">
                    </div>
                </div>
                <div class="btn" id="addjob">Добавить</div>
            </div>
        </div>
    <!--End of modal2-->
    </div>
    <script type="text/javascript" src="js/modal.js?<?=$sek?>"></script>
    <script type="text/javascript" src="js/store.js?<?=$sek?>"></script>
    <script type="text/javascript" src="js/main.js?<?=$sek?>"></script>
    <?='<script type="text/javascript">window.session = '.$json.'</script>'?>
</body>
</html>