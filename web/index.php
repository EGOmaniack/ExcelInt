<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

 require_once('BDgets.php');
//$ra = BDgetRa();                
//var_dump($ra);
//$str = "45 ГОСТ 1050-88";
//$n_str = str_replace("1050-88","1050-2003",$str);
//echo $n_str;
$sek = strtotime("now");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Первая страничка</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/main.css?<?=$sek?>"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <!--<script src="js/office.js"></script>-->
        <!--<script src="https://appsforoffice.microsoft.com/lib/1/hosted/Office.js"/>-->

    </head>
    
    <body>
        <div class="main">
            <p id = "print"></p>
            <div class="container">
                <div class="blockhead">
                    Объединить материалы
                </div>
                <div class="thumb">
                    <form name="excelCalc" method="post" action="calc2.php"
                        enctype="multipart/form-data">
                        <div class="text">Наш первый сервис позволяет объединять одинаковые
                             материалы из ведомости материалов с учетом количества агрегатов. 
                             <a href ="/files/пример.xlsx">Пример оформления заготовки</a><br>
                        </div>
                        <div class="text hiddeble hidden">
                             Файл принимется как минимум в формате Excel 2007 - "xlsx"
                             Внутри, агрегаты должны быть указаны, как показано в примере:<br>
                             1) В колонке А ставится английское "n".<br>
                             2) В колонке B название агрегата<br>
                             3) В колонке С количество агрегатов<br>
                             Все в одну строку. Даже если у вас один агрегат его тоже надо указывать.
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
        </div>
    </body>
    <script src="js/main.js?<?=$sek?>" type="text/javascript"></script>
</html>