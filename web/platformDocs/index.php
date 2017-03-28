<?php
 include_once './phpScripts/vers.php';
 include_once './phpScripts/getPlatforms.php';
 include_once './phpScripts/getPlatf_repairs.php';
 include_once './phpScripts/get_pms.php';
$sek = strtotime("now");

$json = json_encode($_SESSION);
$firms = $_SESSION['pms'];
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
        <div id='action_selector' class="wrapper zhide">
            <p id="platform_info"></p>
            <div platform="" class='sbtn change_pl'>Изменить</div>
            <h1 class="title">Записи о ремонтах</h1>
            <div id="repairs"></div>
            <a href="/platformDocs/new_repair.php" id="new_rep">Добавить запись</a>
            <!--<div class="btns">
                <a class="btn" id="change" href="/platformDocs/?flow=change">Изменить</a>
                <div class="adivider"></div>
                <a class="btn" id="print" href="/platformDocs/?flow=print">Печать</a>
            </div>-->
            <div class="zhide new_rep">
                <form action="select1.php" method="post">
                <p><select name="hero[]">
                    <option disabled>Выберите героя</option>
                    <option value="Чебурашка">Чебурашка</option>
                    <option selected value="Крокодил Гена">Крокодил Гена</option>
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
        <div class="devider"></div>
    </div>
    <script type="text/javascript" src="js/main.js?<?=$sek?>"></script>
    <?='<script type="text/javascript">window.session = '.$json.'</script>'?>
</body>
</html>