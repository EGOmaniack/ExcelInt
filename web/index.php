<?php

    if(count($_FILES['Excel']['size'])>0)var_dump($_FILES);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Первая страничка</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/main.css"/>
        <script src="js/jquery-3.1.1.min.js"></script>
        <!--<script src="js/office.js"></script>-->
        <!--<script src="https://appsforoffice.microsoft.com/lib/1/hosted/Office.js"/>-->

    </head>
    
    <body>
                <p id = "print"></p>

<!--        <form name="excelCalc" method="post" action="calc1.php"-->
<!--              enctype="multipart/form-data">-->
<!--            <p><br>-->
<!--                <input type="file" name="fileToUpload" >-->

<!--            </p>-->
<!---->

<!--                <textarea name="comment" cols="40" rows="3"></textarea></p>-->
<!--            <p><input type="submit" value="Отправить">-->
<!--                <input type="reset" value="Очистить"></p>-->
<!--        </form>-->

        <div calss="parant">
            <div class="block">

                <h2>Загрузите файл</h2>
                <input type="file" name="Excel"> <br>
                <input id="btn" type="button" name="go" value="Посчитать" disabled = "disables">
<!--                <img src="pics/mats.jpg" alt=""/>-->
            </div>
        </div>
    </body>
    <script src="js/main.js" type="text/javascript"></script>
</html>