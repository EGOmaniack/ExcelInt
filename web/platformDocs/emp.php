<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

include_once './phpScripts/getEmpJobs.php';
$sek = strtotime("now");

$json = json_encode($_SESSION);

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
    <link rel="stylesheet" href="css/reset.css?<?=$sek?>">
    <script type="text/javascript" src="./../js/jquery-3.1.1.min.js"></script>
</head>
<body>
    <?php include_once './components/head.php';?>

    <!--.content>(.fams>.emp_fam.vertical-text{Фамилия$$}*31)+(.mainTable>(.platform>(.title{Платформа-ППК-$В}+.title.repTitle>.repairTitle{ремонт$$})+(.tabString>.workTitle{работа$$$}+.wceils>.wceil*31)*15)*3)-->
    <div class="content">
    </div>
    

       
    <script type="text/javascript" src="js/store.js?<?=$sek?>"></script>
    <script type="text/javascript" src="js/emp.js?<?=$sek?>"></script>
    <?='<script type="text/javascript">window.session = ' . $json .'</script>'?>
</body>
</html>

<?php

//var_dump($_SESSION);

?>