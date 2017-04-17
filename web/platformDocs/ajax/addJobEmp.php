<?php
ini_set('display_errors', 0) ;


$job_id = $_POST['job_id'];
$fam_id = $_POST['fam_id'];
$insert = $_POST['insert'];

$dbconn = pg_connect("host=localhost port=5432 dbname=platformDocs user=postgres password=Rgrur4frg56eq16")
    or die('Could not connect: ' . pg_last_error());
if($insert == "true"){/*Это если хотим вставить новую запись*/
    $sqlstr = "insert into platforms.\"repairs-jobs-staff\" ( \"rep-job_id\", emp_id ) ";
    $sqlstr .= "values( " . $job_id . ", "  . $fam_id . " );";


    $result = pg_query($dbconn, $sqlstr) or die('error');


    pg_free_result($result);
    pg_close($dbconn);
    echo 'done';
}else{
    $sqlstr  = "delete from platforms.\"repairs-jobs-staff\" rjs ";
    $sqlstr .= "where rjs.\"rep-job_id\" = " . $job_id;
    $sqlstr .= " and rjs.emp_id = " . $fam_id;
    $sqlstr .= " ;";

    $result = pg_query($dbconn, $sqlstr) or die('error');
    pg_free_result($result);
    pg_close($dbconn);
    echo 'done';
}
/*
insert into platforms."repairs-jobs-staff" ( "rep-job_id", emp_id )
values ( 142, 2 );
*/

?>