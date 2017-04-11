<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

include_once './phpScripts/getEmpJobs.php';
$sek = strtotime("now");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Назначения</title>
    <link href="css/head.css?<?=$sek?>" rel="stylesheet">
    <!--<link rel="stylesheet" href="css/main.css?<?=$sek?>">-->
    <link rel="stylesheet" href="css/emp.css?<?=$sek?>">
    <script type="text/javascript" src="./../js/jquery-3.1.1.min.js"></script>
</head>
<body>
    <?php include_once './components/head.php';?>

    <!--.content>(.empty+.emp_fam.vertical-text{Фамилия$$}*20+(.platform>.title{Платформа-ППК-$В}+(.repTitle>.title{ремонт}+.workTitle{работа$$$}*10)+(.lubTitle>.title{к_смазке}+.workTitle{смазка$$$}*10)+.wceil*20)*3)-->
    <div class="content">
        <div class="empty"></div>
        <div class="emp_fam vertical-text">Фамилия01</div>
        <div class="emp_fam vertical-text">Фамилия02</div>
        <div class="emp_fam vertical-text">Фамилия03</div>
        <div class="emp_fam vertical-text">Фамилия04</div>
        <div class="emp_fam vertical-text">Фамилия05</div>
        <div class="emp_fam vertical-text">Фамилия06</div>
        <div class="emp_fam vertical-text">Фамилия07</div>
        <div class="emp_fam vertical-text">Фамилия08</div>
        <div class="emp_fam vertical-text">Фамилия09</div>
        <div class="emp_fam vertical-text">Фамилия10</div>
        <div class="emp_fam vertical-text">Фамилия11</div>
        <div class="emp_fam vertical-text">Фамилия12</div>
        <div class="emp_fam vertical-text">Фамилия13</div>
        <div class="emp_fam vertical-text">Фамилия14</div>
        <div class="emp_fam vertical-text">Фамилия15</div>
        <div class="emp_fam vertical-text">Фамилия16</div>
        <div class="emp_fam vertical-text">Фамилия17</div>
        <div class="emp_fam vertical-text">Фамилия18</div>
        <div class="emp_fam vertical-text">Фамилия19</div>
        <div class="emp_fam vertical-text">Фамилия20</div>
        <div class="platform">
            <div class="title">Платформа-ППК-1В</div>
            <div class="repTitle">
                <div class="title">ремонт</div>
                <div class="workTitle">работа001</div>
                <div class="workTitle">работа002</div>
                <div class="workTitle">работа003</div>
                <div class="workTitle">работа004</div>
                <div class="workTitle">работа005</div>
                <div class="workTitle">работа006</div>
                <div class="workTitle">работа007</div>
                <div class="workTitle">работа008</div>
                <div class="workTitle">работа009</div>
                <div class="workTitle">работа010</div>
            </div>
            <div class="lubTitle">
                <div class="title">к_смазке</div>
                <div class="workTitle">смазка001</div>
                <div class="workTitle">смазка002</div>
                <div class="workTitle">смазка003</div>
                <div class="workTitle">смазка004</div>
                <div class="workTitle">смазка005</div>
                <div class="workTitle">смазка006</div>
                <div class="workTitle">смазка007</div>
                <div class="workTitle">смазка008</div>
                <div class="workTitle">смазка009</div>
                <div class="workTitle">смазка010</div>
            </div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
        </div>
        <div class="platform">
            <div class="title">Платформа-ППК-2В</div>
            <div class="repTitle">
                <div class="title">ремонт</div>
                <div class="workTitle">работа001</div>
                <div class="workTitle">работа002</div>
                <div class="workTitle">работа003</div>
                <div class="workTitle">работа004</div>
                <div class="workTitle">работа005</div>
                <div class="workTitle">работа006</div>
                <div class="workTitle">работа007</div>
                <div class="workTitle">работа008</div>
                <div class="workTitle">работа009</div>
                <div class="workTitle">работа010</div>
            </div>
            <div class="lubTitle">
                <div class="title">к_смазке</div>
                <div class="workTitle">смазка001</div>
                <div class="workTitle">смазка002</div>
                <div class="workTitle">смазка003</div>
                <div class="workTitle">смазка004</div>
                <div class="workTitle">смазка005</div>
                <div class="workTitle">смазка006</div>
                <div class="workTitle">смазка007</div>
                <div class="workTitle">смазка008</div>
                <div class="workTitle">смазка009</div>
                <div class="workTitle">смазка010</div>
            </div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
        </div>
        <div class="platform">
            <div class="title">Платформа-ППК-3В</div>
            <div class="repTitle">
                <div class="title">ремонт</div>
                <div class="workTitle">работа001</div>
                <div class="workTitle">работа002</div>
                <div class="workTitle">работа003</div>
                <div class="workTitle">работа004</div>
                <div class="workTitle">работа005</div>
                <div class="workTitle">работа006</div>
                <div class="workTitle">работа007</div>
                <div class="workTitle">работа008</div>
                <div class="workTitle">работа009</div>
                <div class="workTitle">работа010</div>
            </div>
            <div class="lubTitle">
                <div class="title">к_смазке</div>
                <div class="workTitle">смазка001</div>
                <div class="workTitle">смазка002</div>
                <div class="workTitle">смазка003</div>
                <div class="workTitle">смазка004</div>
                <div class="workTitle">смазка005</div>
                <div class="workTitle">смазка006</div>
                <div class="workTitle">смазка007</div>
                <div class="workTitle">смазка008</div>
                <div class="workTitle">смазка009</div>
                <div class="workTitle">смазка010</div>
            </div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
            <div class="wceil"></div>
        </div>
    </div>

    <script type="text/javascript" src="js/store.js?<?=$sek?>"></script>
    <script type="text/javascript" src="js/emp.js?<?=$sek?>"></script>
</body>
</html>

<?php

//var_dump($_SESSION);

?>