<?php
 include_once './phpScripts/vers.php'; //Парсит лог версий
 include_once './phpScripts/getPlatforms.php'; //Вытаскивает из БД информацию по платформам
 include_once './phpScripts/getPlatf_repairs.php'; //Вытаскивает из БД информацию по всем ремонтам

$sek = strtotime("now");

$json = json_encode($_SESSION); // include 2 и 3 передают данные в session. Тут вытаскиваем их от туда.

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>platforms</title>
    <link rel="stylesheet" href="css/main.css?<?=$sek?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    <link href="css/modal.css?<?=$sek?>" rel="stylesheet">
    <script type="text/javascript" src="./../js/jquery-3.1.1.min.js"></script>
</head>
<body>
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
                    <img src="img/platforma_new.png" alt="platform_ico" href = "/platformDocs/new_platform.php">
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
            
            <div id="btn_modal">Добавить запись</div> <!-- The Modal -->

        </div>
        <div class="devider"></div>
        <div class="card zhide">
            <!--h1.title{ремонт такой-то такого-то объема}+p{Перечень работ}+(.inwrapper>.list>(.rep_detail_item{item $$}*5)+.plus_btn)+p{к смазке}+(.inwrapper>.list>(.rep_detail_item{item $$}*5)+.plus_btn)-->
            <h1 class="title">Ремонт такой-то такого-то объема</h1>
            <h4 class="min_head">Перечень работ</h4>
            <div class="inwrapper">
                <div class="list">
                    <div class="rep_detail_item">item 01</div>
                    <div class="rep_detail_item">item 02</div>
                    <div class="rep_detail_item">item 03</div>
                    <div class="rep_detail_item">item 04</div>
                    <div class="rep_detail_item">item 05</div>
                    <div class="plus_btn"></div>
                </div>
            </div>
            <h4 class="min_head">к смазке</h4>
            <div class="inwrapper">
                <div class="list">
                    <div class="rep_detail_item">item 01</div>
                    <div class="rep_detail_item">item 02</div>
                    <div class="rep_detail_item">item 03</div>
                    <div class="rep_detail_item">item 04</div>
                    <div class="rep_detail_item">item 05</div>
                    <div class="plus_btn"></div>
                </div>
            </div>
        </div>
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
    <div class="hide">
        <div class="new_rep">
                <form action="select1.php" method="post">
                <p><select name="hero[]">
                    <option disabled>Выберите героя</option>
                    <option value="Чебурашка">Чебурашка</option>
                    <option value="Крокодил Гена">Крокодил Гена</option>
                    <option value="Шапокляк">Шапокляк</option>
                    <option value="Крыса Лариса">Крыса Лариса</option>
                </select></p>
                <p><input type="submit" value="Отправить"></p>
                </form>
            </div>

                <?php
                $list = "";
                foreach ($firms as $value) {
                    $list .= "<option value=\"".$value."\"></option>";
                }
                ?>
            <p>Выберите любимого персонажа:</p>
            <p><input id="pmss" list="character">
            <datalist id="character">
                <?=$list?>
            </datalist></p>
            <div class="tst"></div>
    </div>

    <script type="text/javascript" src="js/main.js?<?=$sek?>"></script>
    <script type="text/javascript" src="js/modal.js?<?=$sek?>"></script>
    <?='<script type="text/javascript">window.session = '.$json.'</script>'?>
</body>
</html>