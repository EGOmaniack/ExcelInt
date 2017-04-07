<?php

$n_rep_date = $_POST['n_rep_date'];
$n_rep_type = $_POST['n_rep_type'];
$repair_end = $_POST['n_rep_end'];
$platf_number = $_POST['platf_number'];

$dbconn = pg_connect("host=localhost port=5432 dbname=platformDocs user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

$sqlstr = 'insert into platforms.repair ( platform_id, repair_type, repair_start';
if( $repair_end != "" ){ $sqlstr .=", repair_end"; }
$sqlstr .=" ) ".
    "select p.id, t.id, '".$n_rep_date."'";
if( $repair_end != "" ){ $sqlstr .=", '".$repair_end."'"; }
$sqlstr .=' from platforms.platforma p, platforms.repair_type t '.
    ' where p.number='.$platf_number.
    " and t.\"code\"='".$n_rep_type."'";
// var_dump($sqlstr);
// exit;
$result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

$sqlstr2  = "select rep.id ";
$sqlstr2 .= "from ";
$sqlstr2 .= "	platforms.repair rep ";
$sqlstr2 .= "	inner join ";
$sqlstr2 .= "	platforms.platforma pl ";
$sqlstr2 .= "	on rep.platform_id = pl.id ";
$sqlstr2 .= "where rep.repair_start = '".$n_rep_date."' ";
$sqlstr2 .= "and pl.\"number\" = '".$platf_number."' ";
$sqlstr2 .= ";";

//Запрашиваем полученный id для новой записи о ремонте
$result2 = pg_query($dbconn, $sqlstr2) or die('Ошибка запроса: ' . pg_last_error());
$new_id;
while($line = pg_fetch_assoc($result2)){
    $new_id = $line;
}
// запрашиваем все работы из раздела смазка для данного вида ремонта
$sqlstr3  = "select rj.id, rj.\"name\" ";
$sqlstr3 .= "from ";
$sqlstr3 .= "	repair_stuff.work_sections ws ";
$sqlstr3 .= "	inner join ";
$sqlstr3 .= "	platforms.repair_type rt ";
$sqlstr3 .= "		on ws.r_type_id = rt.id ";
$sqlstr3 .= "	inner join ";
$sqlstr3 .= "	repair_stuff.repair_jobs rj ";
$sqlstr3 .= "		on rj.razdel = ws.id ";
$sqlstr3 .= "where ";
$sqlstr3 .= "rt.code = '".$n_rep_type."' ";
$sqlstr3 .= "and ws.\"name\" = 'smazka'";
$sqlstr3 .= ";";

$result3 = pg_query($dbconn, $sqlstr3) or die('Ошибка запроса: ' . pg_last_error());

$smazka_job_ids = [];

while($line = pg_fetch_assoc($result3)){
    $smazka_job_ids[] = $line;
}
// Закидываем в новый ремонт соответствующие работы по смазке
$sqlstr4  = "insert into platforms.\"repairs-jobs\" ( rep_id, job_id ) ";
$sqlstr4 .= "values ";

for ($i=0; $i < count($smazka_job_ids)-1 ; $i++) { 
    $sqlstr4 .= "( ".$new_id['id'].", " . $smazka_job_ids[$i]['id'] . " ), ";
}

$sqlstr4 .= "( ".$new_id['id'].", ".$smazka_job_ids[count($smazka_job_ids)-1]['id']." ); ";

$result4 = pg_query( $dbconn, $sqlstr4 ) or die( 'Ошибка запроса: ' . preg_last_error() );

// var_dump($smazka_job_ids);

pg_free_result($result);
pg_close($dbconn);
//echo 'done';

?>