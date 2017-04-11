<?php
$repair_id = $_POST['repair_id'];
$jobId = $_POST['jobId'];
// var_dump($_POST);
// exit;
$dbconn = pg_connect("host=localhost port=5432 dbname=platformDocs user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    $sqlstr ="delete from platforms.\"repairs-jobs\" ";
    $sqlstr .="where rep_id=".$repair_id;
    $sqlstr .= " and job_id=".$jobId;
    $sqlstr .= ";";

    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    // var_dump($platforms);
    pg_free_result($result);
    pg_close($dbconn);
    //echo 'done';
?>