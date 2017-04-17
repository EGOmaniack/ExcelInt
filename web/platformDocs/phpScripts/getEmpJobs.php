<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 4);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

$dbconn = pg_connect("host=localhost port=5432 dbname=platformDocs user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());

    $workers = [];
$sqlstr  = <<<EOT
select emp.id, emp.surname, emp."name", emp.middle_name, pos.worker_position
from	
    staff.employees emp
    inner join
    staff.w_position pos
    on emp.position = pos.id
    inner join
    staff.workshop wshop
    on wshop.emp_id = emp.id
;
EOT;


    $result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

    while($line = pg_fetch_assoc($result)){
        $workers[] = $line;
    }

    $_SESSION['emps'] = $workers;

$sqlstr = <<<EOT
select 
	pl.full_name, rt.code, pl."name" plname, rsjs.id  rsjsid, pl."number",
	rep.repair_start, rep.repair_end, rep.id repair_id, rt."type", rj."name",
	ws."name"  "section"
from
	platforms.platforma pl
	full outer join
	platforms.repair rep
		on rep.platform_id = pl.id
	inner join
	platforms."repairs-jobs" rsjs
		on rsjs.rep_id = rep.id
	full outer join
	repair_stuff.repair_jobs rj
		on rsjs.job_id = rj.id
	inner join
	platforms.repair_type rt
		on rt.id = rep.repair_type
	inner join
	repair_stuff.work_sections ws
		on rj.razdel = ws.id
group by pl.id, rep.id, rsjs.id, rj.id, rt.id, ws.id
order by rsjs.id
;
EOT;

$jobsInfo = [];

$result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

$count = -1;
$lastPlatform = "";
$lastID = 0;
while($line = pg_fetch_assoc($result)){
    if( $line['number'] != $lastPlatform ){
        $count = -1;
        $lastPlatform = $line['number'];
        $lastID = 0;
        $platforms[] = $line['number'];
    }
    if( $line['repair_id'] != $lastID ) { $count++; $lastID = $line['repair_id']; }
    $jobsInfo[$line['number']][$count][$line['rsjsid']] = $line;
    $jobsInfo[$line['number']][$count]['repairInfo']['type'] = $line['type'];
    $jobsInfo[$line['number']][$count]['repairInfo']['repair_id'] = $line['repair_id'];
    $jobsInfo[$line['number']][$count]['repairInfo']['repair_start'] = $line['repair_start'];
    $jobsInfo[$line['number']][$count]['repairInfo']['repair_end'] = $line['repair_end'];
    $lines[] = $line;
}
// var_dump($jobsInfo);
// exit;
$sqlstr = 'select pl."name", pl.full_name, pl."number" from platforms.platforma pl;';
$result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());
$platformsInfo = [];
while($line = pg_fetch_assoc($result)){
    $platformsInfo[$line['number']] = $line;
    $platformsInfo['all'][] = $line['number'];
}
// var_dump($platformsInfo);
// exit;

$sqlstr = "select * from platforms.\"repairs-jobs-staff\";";
$result = pg_query($dbconn, $sqlstr) or die('Ошибка запроса: ' . pg_last_error());

$rjobsstaff=[];
while($line = pg_fetch_assoc($result)){
    $rjobsstaff[$line['rep-job_id']][$line['emp_id']] = $line;
}

    $_SESSION['jobsInfo'] = $jobsInfo;
    $_SESSION['platforms'] = $platformsInfo;
    $_SESSION['jobs_emps'] = $rjobsstaff;
    //  var_dump($repairs);
    //  exit();
    pg_free_result($result);
    pg_close($dbconn);
    //echo 'done';
?>