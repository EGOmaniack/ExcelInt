<?php
 include_once 'vers.php';
$sek = strtotime("now");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>platforms</title>
    <link rel="stylesheet" href="css/main.css?<?=$sek?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
</head>
<body>
<p id="version"><?=getver('ver.txt')[0]['ver']?></p>
    <div class="mainwraper">
        <div class="devider"></div>
        <div class="wrapper zhide">
            <h1 class="title">Выберите действие</h1>
            <div class="btns">
                <a class="btn" id="change" href="/platformDocs/?flow=change">Изменить</a>
                <div class="adivider"></div>
                <a class="btn" id="print" href="/platformDocs/?flow=print">Печать</a>
            </div>
        </div>
        <div class="devider"></div>
        <div class="wrapper">
            <h1 class="title">Выберите платформу</h1>
            <div id="platforms">
                <div class="platform new">
                    <img id="new_platform" src="img/platforma.png" alt="platform_ico">
                    <p class="lable">№213123</p>
                </div>
                <div class="platform">
                    <img src="img/platforma_new.png" alt="platform_ico">
                    <p class="lable">Новая патформа</p>
                </div>
            </div>
        </div>
        <div class="devider"></div>
    </div>
</body>
</html>