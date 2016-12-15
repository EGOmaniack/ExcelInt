<?php
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
        <script src="js/main.js"></script>
    </head>
    
    <body>
    
        <div id="nav-icon1">
      <span></span>
      <span></span>
      <span></span>
        </div>

        <p id = "print">000</p>

        <form name="excelCalc" method="post" action="calc1.php"
              enctype="multipart/form-data">
            <p><br>
                <input type="file" name="fileToUpload" >
               <!-- <input type="HIDEN" name="send" value="uniqNumber">-->
            </p>

            <!--<p>Комментарий<Br>
                <textarea name="comment" cols="40" rows="3"></textarea></p>-->
            <p><input type="submit" value="Отправить">
                <input type="reset" value="Очистить"></p>
        </form>

    </body>
</html>