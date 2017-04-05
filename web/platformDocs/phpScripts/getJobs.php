<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=platformDocs user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

$sqlstr  ="select * from repair_stuff.work_sections order by weight desc;";
$result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

$works = [];

$sections_id = [];

while($line = pg_fetch_assoc($result)){
    $works[] = $line;
}
$all_works = [];

/* Убираем элементы верхнего уровня */
foreach ($works as $key => $value) {
    if( $value['parent_sec'] == 1 ){
        $all_works[] = $value;
        unset($works[$key]);
    }
}

for($i = 0; $i < 10; $i++){
    foreach ($works as $key => $value) {
        if($value['parent_sec'] != 1){
            foreach ($all_works as $key2 => $all_value) {
                if($all_value['id'] == $value['parent_sec']){
                    $all_works[$key2][] = $value;
                    unset($works[$key]);
                }
            }
        }
    }
}
$jobs = [];
$sqlstr  ="select * from repair_stuff.repair_jobs rj;";
pg_free_result($result);
$result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

while($line = pg_fetch_assoc($result)){
    if($line['replacement'] == 'f') {
        $line['replacement'] = false;
    }else{
        $line['replacement'] = true;
    }
    $jobs[] = $line;
}





// var_dump($jobs);
// exit;
$_SESSION['sections'] = $all_works;
$_SESSION['jobs'] = $jobs;
// var_dump($platforms);
pg_free_result($result);
pg_close($dbconn);
// echo 'done';
?>