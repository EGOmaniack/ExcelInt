<?php
// var_dump($_POST);

$pl_id=$_POST['id'];
$name=$_POST['name'];
$number=$_POST['number'];
$owner=$_POST['owner'];
$full_name=$_POST['full_name'];
$factory_number=$_POST['factory_number'];
$release_date=$_POST['release_date'];
$factory_name=$_POST['factory_name'];

$dbconn = pg_connect("host=localhost port=5432 dbname=platforms user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    $sqlstr = 'update platforms.platforma ';
    $sqlstr .="set (name, number, factory_number, release_date) = ( '".$name."', '".$number."', '".$factory_number."', '".$release_date."' )";
    $sqlstr .='where id='.$pl_id.' ;';
// var_dump($sqlstr);
// exit;
    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    pg_free_result($result);
    pg_close($dbconn);
    echo 'done';
?>