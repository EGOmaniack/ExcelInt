<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=platformDocs user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    $sqlstr ="select \"number\" from firms.companies;";

    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    $pms=[];

    while($line = pg_fetch_assoc($result)){
        $pms[]=$line['number'];
    }
    $_SESSION['pms'] = $pms;
    pg_free_result($result);
    pg_close($dbconn);
?>