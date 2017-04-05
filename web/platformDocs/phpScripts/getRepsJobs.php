<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=platformDocs user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

$sqlstr  ="select * from platforms.\"repairs-jobs\";";

$result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

$repsJobs = [];

while($line = pg_fetch_assoc($result)){
    $repsJobs[] = $line;
}


$_SESSION['repsJobs'] = $repsJobs;
// var_dump($platforms);
pg_free_result($result);
pg_close($dbconn);

?>