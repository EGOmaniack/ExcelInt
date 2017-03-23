<?php
 include_once './phpScripts/vers.php';
 include_once './phpScripts/getPlatforms.php';
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
    <script type="text/javascript" src="./../js/jquery-3.1.1.min.js"></script>
</head>
<body>
<p id="version"><?=getver('ver.txt')[0]['ver']?></p>
    <div class="mainwraper">
        <div class="devider"></div>
        <div class="wrapper">
            <h1 class="title">Выберите платформу</h1>
            <div id="platforms">
            <?php
            if($platforms) {
                foreach($platforms as $pl){
                    $platforma = "<div class='platform new'>";
                    $platforma .="<img id='new_platform' src='img/platforma.png' alt='platform_ico'>";
                    $platforma .="<p class='lable'>№ ".$pl['platf_number']."</p>";
                    $platforma .="</div>";
                    echo $platforma;
                }
            }
            ?>
                <div class="platform">
                    <img src="img/platforma_new.png" alt="platform_ico">
                    <p class="lable">Новая патформа</p>
                </div>
            </div>
        </div>
        <div class="devider"></div>
        <div id='action_selector' class="wrapper hide">
            <h1 class="title">Выберите действие</h1>
            <p id="platform_info">222</p>
            <div class="btns">
                <a class="btn" id="change" href="/platformDocs/?flow=change">Изменить</a>
                <div class="adivider"></div>
                <a class="btn" id="print" href="/platformDocs/?flow=print">Печать</a>
            </div>
        </div>
        <div class="devider"></div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
    <?='<script type="text/javascript">a = '.$platforms.'</script>'?>
</body>
</html>