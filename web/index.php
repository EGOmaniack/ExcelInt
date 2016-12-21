<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Первая страничка</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/main.css?1"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <!--<script src="js/office.js"></script>-->
        <!--<script src="https://appsforoffice.microsoft.com/lib/1/hosted/Office.js"/>-->

    </head>
    
    <body>
                <p id = "print"></p>

        <form name="excelCalc" method="post" action="calc1.php"
              enctype="multipart/form-data">
            <p><br>
                <input type="file" name="fileToUpload" >
            </p>
            <p><input type="submit" value="На экран">
                <input type="reset" value="Очистить"></p>
        </form>
        <br><br>
                <form name="excelCalc" method="post" action="calc2.php"
                      enctype="multipart/form-data">
                    <p><br>
                        <input type="file" name="fileToUpload" >
                    </p>
                    <p><input type="submit" value="в Excel">
                        <input type="reset" value="Очистить"></p>
                </form>

<!--        <div calss="parant">-->
<!--            <div class="block">-->
<!---->
<!--                <h3>Загрузите файл</h3>-->
<!--                <input type="file" name="Excel" id="forma"> <br>-->
<!--                <input id="btn" type="button" name="go" value="Посчитать">-->
                <!--<input id="btn2" type="button" name="go" value="Посчитать" disabled = "disables">-->
<!--            </div>-->
<!--        </div>-->
    </body>
    <script src="js/main.js?1" type="text/javascript"></script>
</html>