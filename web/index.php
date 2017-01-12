<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

require_once('BDgets.php');
require_once('logsParser.php');

$mergeLog = getlog('matmerge_versions_log.txt');
$mlog = "<div id = 'verdiv'>";
foreach($mergeLog as $key=> $value){
    $mlog .='<p class = "vername">'.$value['ver'].'</p><ul>';
    for($i = 0;$i < count($value['logs']);$i++){
        $mlog .="<li>".$value['logs'][$i]."</li>";
    }
    $mlog .="</ul>";
}
$mlog .="</div>";
$sek = strtotime("now");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Первая страничка</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/main.css?<?=$sek?>"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <link rel="icon" type="image/png" href="/pics/logo_min.png" />
        <!--<script src="js/office.js"></script>-->
        <!--<script src="https://appsforoffice.microsoft.com/lib/1/hosted/Office.js"/>-->

    </head>
    
    <body>
        <noscript>
            Для полной функциональности этого сайта необходимо включить JavaScript.
            Вот <a href="http://www.enable-javascript.com/ru/" target="_blank">
            инструкции, как включить JavaScript в вашем браузере</ a>.
        </noscript>
        <div class="main">
            <div id="top">
            <p id = "print"></p>
            </div>
            <div class="container" id="mergemat">
                <div class="blockhead">
                    Объединить материалы <a id="mw"><?=$mergeLog[0]['ver']?></a>
                </div>
                <div class="thumb">
                    <form name="excelCalc" method="post" action="find_mat_copy.php"
                        enctype="multipart/form-data">
                        <div class="text">Наш первый сервис позволяет объединять одинаковые
                             материалы из ведомости материалов с учетом количества агрегатов. 
                             <a href ="files/example.xlsx">Пример оформления заготовки</a><br>
                        </div>
                        <div class="text hiddeble">
                             Файл принимается как минимум в формате Excel 2007 - "xlsx"
                             Если планируется посчитать несколко агрегатов или др. инж. едениц, то:<br>
                             Внутри, агрегаты должны быть указаны, как показано в <a href ="files/example_many.xlsx">этом</a> примере:<br>
                             <lo><li> В колонке А ставится английское "n".</li>
                             <li> В колонке B название агрегата</li>
                             <li> В колонке С количество агрегатов</li></lo>
                             Все в одну строку. Если у вас один агрегат его указывать необязательно.<br>
                             Номер листа с материалами должен быть 4ым. Название листа не имеет значения.<br>
                             Стили оформления не имеют значения
                        </div>
                        <input class="ShowHide" type="button" name="ShowHide" value="Развернуть/Свернуть">
                        
                        <div class="picplace">
                            <input class = "picbtn" type="file" name="fileToUpload" >
                        </div>
                            
                        <div >
                            <p><input class = "submit btns" type="submit" value="Посчитать">
                            <input class="btns reset" type="reset" value="Очистить"></p>
                        </div>
                    </form>
                </div>
            </div>
            
            <div id="bottom">
            
            </div>
        </div>
        <p id = "ver"><?=getlog('all_ver_log.txt')[0]['ver']?> </p>
        <div id="modal_form"><!-- Сaмo oкнo --> 
            <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
            <?=$mlog?> 
            <!-- Тут любoе сoдержимoе -->
        </div>
        <div id="overlay"></div><!-- Пoдлoжкa -->
    </body>
    <script src="js/main.js?<?=$sek?>" type="text/javascript"></script>
</html>