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
	rjs.emp_id, rjs.start_date, rjs.end_date, ws."name"  "section"
from
	platforms.platforma pl
	full outer join
	platforms.repair rep
		on rep.platform_id = pl.id
	inner join
	platforms."repairs-jobs" rsjs
		on rsjs.rep_id = rep.id
	full outer join
	platforms."repairs-jobs-staff" rjs
		on rjs."rep-job_id" = rsjs.id
	inner join
	repair_stuff.repair_jobs rj
		on rsjs.job_id = rj.id
	inner join
	platforms.repair_type rt
		on rt.id = rep.repair_type
	inner join
	repair_stuff.work_sections ws
		on rj.razdel = ws.id
GROUP by ws.id, pl.id, rep.id, rsjs.id, rjs.id, rj.id, rt.id
order by pl."number", rep.repair_start, ws.weight desc
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
    $lines[] = $line;
}
// var_dump($jobsInfo);
// exit;
    

    $_SESSION['jobsInfo'] = $jobsInfo;
    $_SESSION['platforms'] = $platforms;
    //  var_dump($repairs);
    //  exit();
    pg_free_result($result);
    pg_close($dbconn);
    //echo 'done';
?>