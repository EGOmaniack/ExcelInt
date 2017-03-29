<?php

$sek = strtotime("now");

//$json = json_encode( $_SESSION );
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Новая платформа</title>
    <link rel="stylesheet" href="css/main.css?<?=$sek?>">
    <link rel="stylesheet" href="css/new_pl.css?<?=$sek?>">
    <script type="text/javascript" src="./../js/jquery-3.1.1.min.js"></script>
</head>
<body>
    <div class="mainwraper">
        <div class="devider"></div>
        <div class="wrapper">
            <h1 class="title">Введите данные для новой платформы</h1>
            <!--(.minwrapper>.inwrapper>h2.formname.text_down{Номер платформы}+input.field[type=text placeholder=номер_платформы])*6-->
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Наименование</h2>
                    <input id='name' type="text" value="ППК-2В" class="field" placeholder="ППК-2В">
                </div>
            </div>
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Номер платформы*</h2>
                    <input id='number' type="text" class="field" placeholder="введите номер">
                </div>
            </div>
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Предприятие владелец</h2>
                    <input id='owner' type="text" value='ПМС-186' class="field" placeholder='ПМС-186' disabled>
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
                    <input id='factory_number' type="text" class="field" placeholder="введите номер">
                </div>
            </div>
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Год выпуска</h2>
                    <input id='release_date' type="date" class="field">
                </div>
            </div>
            <div class="minwrapper">
                <div class="inwrapper">
                    <h2 class="formname text_down">Изготовитель</h2>
                    <input id='factory_name' type="text" value='ОАО "транспортное машиностроение"' class="field" placeholder='ОАО "транспортное машиностроение"' disabled>
                </div>
            </div>
            
            <div class="btn" id="insert">Создать</div>
            <div class="devider"></div>
        </div>
        <div class="devider"></div>
    </div>
    <script src="./js/new_platf.js?<?=$sek?>" ></script>

</body>
</html>