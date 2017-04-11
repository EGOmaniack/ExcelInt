<?php

$repId=$_POST['repair_id'];
$jobs=$_POST['jobs'];

// var_dump($_POST);
// exit;

$dbconn = pg_connect("host=localhost port=5432 dbname=platformDocs user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    $sqlstr = 'insert into platforms."repairs-jobs" ( rep_id, job_id ) ';
    $sqlstr .="values ";
    for ($i=0; $i < count($jobs)-1 ; $i++) { 
        $sqlstr .= "( ".$repId.", " . $jobs[$i]['id'] . " ), ";
    }
     $sqlstr .= "( ".$repId.", " . $jobs[count($jobs)-1]['id'] . " ) ";
    $sqlstr .=' ;';

    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    pg_free_result($result);
    pg_close($dbconn);
    //echo 'done';
?>