<?php

$n_rep_date = $_POST['n_rep_date'];
$n_rep_type = $_POST['n_rep_type'];
$repair_end = $_POST['n_rep_end'];
$platf_number = $_POST['platf_number'];

$dbconn = pg_connect("host=localhost port=5432 dbname=platforms user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    $sqlstr = 'insert into platforms.repair ( platform_id, repair_type, repair_start';
    if( $repair_end != "" ){ $sqlstr .=", repair_end"; }
    $sqlstr .=" ) ";
    $sqlstr .="select p.id, t.id, '".$n_rep_date."'";
    if( $repair_end != "" ){ $sqlstr .=", '".$repair_end."'"; }
    $sqlstr .=' from platforms.platforma p, platforms.repair_type t ';
    $sqlstr .=' where p.number='.$platf_number;
    $sqlstr .=" and t.\"code\"='".$n_rep_type."'";
// var_dump($sqlstr);
// exit;
    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    pg_free_result($result);
    pg_close($dbconn);
    //echo 'done';
?>