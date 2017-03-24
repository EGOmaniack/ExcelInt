<?php

$name=$_POST['name'];
$number=$_POST['number'];
$owner=$_POST['owner'];
$full_name=$_POST['full_name'];
$factory_number=$_POST['factory_number'];
$release_date=$_POST['release_date'];

echo 111;

exit();
$dbconn = pg_connect("host=localhost port=5432 dbname=thedata user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    $sqlstr = '';
    $sqlstr .='';
    $sqlstr .='';

    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    pg_free_result($result);
    pg_close($dbconn);
    //echo 'done';
?>