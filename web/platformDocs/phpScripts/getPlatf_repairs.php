<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=platforms user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    // $sqlstr = 'select r.id, r.repair_start, r.repair_end, p."number" "platf_number", c."name" "repair_company_name", t."type" "repair_type", r.operating_after_last_repair , r.other_info ';
    // $sqlstr .='from platforms.repair r, platforms.repair_type t, platforms.platforma p, firms.companies c ';
    // $sqlstr .='where r.platform_id=p.id and r.repair_copmany=c.id and r.repair_type=t.id;';

    $sqlstr  = 'select p.name, r.id, p."number" "platf_number",comp3."name" "repair_company_name" , ';
    $sqlstr .= 'comp2."name" "fac_name", comp."number" "owner", p.factory_number, ';
    $sqlstr .= 'p.release_date, p.last_repair, rtype2."type" "last_rep_type", ';
    $sqlstr .= 'p.full_name ,rtype."type" "repair_type", r.repair_start, r.repair_end, r.other_info ';
    $sqlstr .= ', to_char( p.last_repair ,\'DD.MM.YYYY г.\') "last_repair_date" ';
    $sqlstr .= 'from platforms.platforma p, ';
    $sqlstr .= 'firms.companies comp3, ';
    $sqlstr .= 'firms.companies comp, ';
    $sqlstr .= 'firms.companies comp2, ';
    $sqlstr .= 'platforms.repair r, ';
    $sqlstr .= 'platforms.repair_type rtype, ';
    $sqlstr .= 'platforms.repair_type rtype2 ';
    $sqlstr .= 'where p.owner=comp.id ';
    $sqlstr .= 'and r.repair_copmany = comp3.id ';
    $sqlstr .= 'and p.last_rep_type = rtype2.id ';
    $sqlstr .= 'and r.repair_type = rtype.id ';
    $sqlstr .= 'and p.factory_name = comp2.id ';
    $sqlstr .= 'and p.id = r.platform_id ';
    $sqlstr .= 'order by p.id;';


    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    $repairs=[];

    while($line = pg_fetch_assoc($result)){
        $repairs[$line['platf_number']][]=$line;
    }
    $_SESSION['platf_repairs'] = $repairs;
    //$_SESSION['platf_repairs']['count'] = count($repairs);
    //  var_dump($repairs);
    //  exit();
    pg_free_result($result);
    pg_close($dbconn);
    //echo 'done';
?>