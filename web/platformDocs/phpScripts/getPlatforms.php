<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=platforms user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    $sqlstr ="select p.id, p.name platf_name, p.number platf_number,comp.number pms, comp.name pms_name, ";
    $sqlstr .="p.factory_number, p.release_date, p.last_repair, reptype.type last_rep_type ";
    $sqlstr .="from platforms.platforma p, firms.companies comp, platforms.repair_type reptype ";
    $sqlstr .="where p.owner=comp.id and p.last_rep_type=reptype.id order by p.id;";

    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    $platforms=[];

    while($line = pg_fetch_assoc($result)){
        $platforms[$line['platf_number']]=$line;
    }
    $_SESSION['platforms'] = $platforms;
    // var_dump($platforms);
    pg_free_result($result);
    pg_close($dbconn);
    //echo 'done';
?>