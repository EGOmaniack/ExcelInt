<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=thedata user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    $sqlstr = 'select r.repair_start, r.repair_end, p."number" "platf_number", c."name" "repair_company_name", t."type" "repair_type", r.operating_after_last_repair , r.other_info ';
    $sqlstr .='from platforms.repair r, platforms.repair_type t, platforms.platforma p, firms.companies c ';
    $sqlstr .='where r.platform_id=p.id and r.repair_copmany=c.id and r.repair_type=t.id;';

    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    $repairs=[];

    while($line = pg_fetch_assoc($result)){
        $repairs[$line['platf_number']][]=$line;
    }
    $_SESSION['platf_repairs'] = $repairs;
    //$_SESSION['platf_repairs']['count'] = count($repairs);
    // var_dump($platforms);
    pg_free_result($result);
    pg_close($dbconn);
    //echo 'done';
?>