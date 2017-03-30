<?php

$rep_date = $_POST['rep_date'];
$rep_type = $_POST['rep_type'];
$rep_end = $_POST['rep_end'];
$rep_id = $_POST['rep_id'];

$dbconn = pg_connect("host=localhost port=5432 dbname=platformDocs user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    $sqlstr = 'update platforms.repair ';
    $sqlstr .="set repair_start = '".$rep_date."', repair_end = '".$rep_end."', repair_type  = ";
    $sqlstr .="( select id from platforms.repair_type where code = '".$rep_type."' ) ";
    $sqlstr .='where id = '.$rep_id.';';
 echo $sqlstr;
// exit;
    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    pg_free_result($result);
    pg_close($dbconn);
    //echo 'done';
?>