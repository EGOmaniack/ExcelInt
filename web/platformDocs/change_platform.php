<?php

$sek = strtotime("now");
$platf_id = $_GET['pl'];
include_once './phpScripts/getPlatforms.php';
$platform = $_SESSION['platforms'][$platf_id];
// var_dump($platform);
//$json = json_encode( $_SESSION );
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Новая платформа</title>
    <link rel="stylesheet" href="./../css/main.css?<?=$sek?>">
    <link rel="stylesheet" href="./../css/change_pl.css?<?=$sek?>">
    <script type="text/javascript" src="./../../js/jquery-3.1.1.min.js"></script>
</head>
<body>
    <div class="mainwraper">
        <div class="devider"></div>
        <div class="wrapper">
            <h1 class="title">Изменение данных о платформе № <?=$platf_id?></h1>
            <input type="hidden" id="platf_id" value="<?=$platform['id']?>">
            <!--(.minwrapper>.inwrapper>h2.formname.text_down{Номер платформы}+input.field[type=text placeholder=номер_платформы])*6-->
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Наименование</h2>
                    <input id='name' type="text" value="<?=$platform['platf_name']?>" class="field" placeholder="ППК-2В">
                </div>
            </div>
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Номер платформы*</h2>
                    <input id='number' type="text" value="<?=$platf_id?>" class="field" placeholder="введите номер">
                </div>
            </div>
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Предприятие владелец</h2>
                    <input id='owner' type="text" value='<?=$platform['pms']?>' class="field" placeholder='ПМС-186' disabled>
                </div>
            </div>
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Полное наименование</h2>
                    <input id='full_name' type="text" class="field" value="Платформа механизированная" placeholder="Платформа механизированная">
                </div>
            </div>
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Заводской номер машины</h2>
                    <input id='factory_number' value="<?=$platform['factory_number']?>" type="text" class="field" placeholder="введите номер">
                </div>
            </div>
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Год выпуска</h2>
                    <input id='release_date' value="<?=$platform['release_date']?>" type="date" class="field" placeholder="номер_платформы">
                </div>
            </div>
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Изготовитель</h2>
                    <input id='factory_name' type="text" value='ОАО "транспортное машиностроение"' class="field" placeholder='ОАО "транспортное машиностроение"' disabled>
                </div>
            </div>
            <div id="" class="lable hide">готово</div>
            <div class="btn" id="change">Изменить</div>
            <div class="devider"></div>
        </div>
        <div class="devider"></div>
    </div>
    <script src="./../js/change_platf.js?<?=$sek?>" ></script>

</body>
</html>