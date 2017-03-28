<?php

require_once './vendor/autoload.php';

$repair_id = $_POST['repair_id'];
$platform_id = $_POST['platform_id'];
$platforms = json_decode($_POST['platform'], true);
$repairs = json_decode($_POST['platf_repairs'], true);

$repair = [];
foreach ($repairs[$platform_id] as $value) {
    if($value['id'] == $repair_id) {
        $repair = $value;
        $repair['release_date_arr'] = explode("-", $repair['release_date'] );
        $repair['rep_start_arr'] = explode("-", $repair['repair_start'] );
        //$repair['last_repair_arr'] = explode("-", $repair['last_repair_date'] );
        if($repair['repair_end'] != null){
            $repair['rep_end_arr'] = explode("-", $repair['repair_end'] );
        }
    }
}
var_dump($repair);
var_dump($platforms[$platform_id]);

$file = '../docs/passport_pl_№_'.$platform_id.'.docx';
$source = "../templates/passport.docx";

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($source);
$templateProcessor->setValue('name', $platforms[$platform_id]['platf_name']);
$templateProcessor->setValue('number', $platform_id);
$templateProcessor->setValue('owner', $repair['owner']);
$templateProcessor->setValue('factory_number', $platforms[$platform_id]['factory_number']);
$templateProcessor->setValue( 'std', date('j', mktime(0, 0, 0, $repair['rep_start_arr'][1], $repair['rep_start_arr'][2], $repair['rep_start_arr'][0] )));
$templateProcessor->setValue( 'stm', date('m', mktime(0, 0, 0, $repair['rep_start_arr'][1], $repair['rep_start_arr'][2], $repair['rep_start_arr'][0] )));
$templateProcessor->setValue( 'sty', date('Y', mktime(0, 0, 0, $repair['rep_start_arr'][1], $repair['rep_start_arr'][2], $repair['rep_start_arr'][0] )));
if($repair['repair_end'] != null) {
    $templateProcessor->setValue('end', date('j', mktime(0, 0, 0, $repair['rep_end_arr'][1], $repair['rep_end_arr'][2], $repair['rep_end_arr'][0] )));
    $templateProcessor->setValue('enm', date('m', mktime(0, 0, 0, $repair['rep_end_arr'][1], $repair['rep_end_arr'][2], $repair['rep_end_arr'][0] )));
    $templateProcessor->setValue('eny', date('Y', mktime(0, 0, 0, $repair['rep_end_arr'][1], $repair['rep_end_arr'][2], $repair['rep_end_arr'][0] )));
} else {
    $templateProcessor->setValue('end', "__");
    $templateProcessor->setValue('enm', "_____");
    $templateProcessor->setValue('eny', "____");
}
$templateProcessor->setValue('fac_name', $repair['fac_name']);
$templateProcessor->setValue('full_name', $repair['full_name']);
$templateProcessor->setValue('release_date', date('m', mktime(0, 0, 0, $repair['release_date_arr'][1], $repair['release_date_arr'][2], $repair['release_date_arr'][0] ))." ".date('Y', mktime(0, 0, 0, $repair['release_date_arr'][1], $repair['release_date_arr'][2], $repair['release_date_arr'][0] )));
$templateProcessor->setValue('last_repair_date', $repair['last_repair_date']);
$templateProcessor->setValue('last_rep_type', $repair['last_rep_type']);
$templateProcessor->setValue('repair_company_name', $repair['repair_company_name']);
$templateProcessor->setValue('repair_type', $repair['repair_type']);
$templateProcessor->setValue('other_info', $repair['other_info']);
$templateProcessor->saveAs($file);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!--<?=$body?>-->
</body>
</html>