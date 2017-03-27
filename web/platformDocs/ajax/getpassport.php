<?php

require_once './vendor/autoload.php';

//var_dump($_POST);
$repair_id = $_POST['repair_id'];
$platform_id = $_POST['platform_id'];
$platforms = json_decode($_POST['platform'], true);
$repairs = json_decode($_POST['platf_repairs'], true);

var_dump($platforms);
//$ans = $platform_id;

// require_once '../../Classes/PHPWord.php';

// $PHPWord = new PHPWord();

// $document = $PHPWord->loadTemplate('../templates/passport.docx');

// $document->setValue( 'name', $platforms[$platform_id]['platf_name'] );
// //$document->setValue( 'number', $platform_id );
// //$document->setValue( 'factory_number', $platforms[$platform_id]['factory_number'] );


// $file = '../docs/passport_pl_№_'.$platform_id.'.docx';

// $document->save($file);

$phpWord = new \PhpOffice\PhpWord\PhpWord();

//Файл сохраняется вопрос как отдать
// header('Content-Description: File Transfer');
//     header('Content-Type: application/octet-stream');
//     header('Content-Disposition: attachment; filename="'.basename($file).'"');
//     header('Expires: 0');
//     header('Cache-Control: must-revalidate');
//     header('Pragma: public');
//     header('Content-Length: ' . filesize($file));
//     readfile($file);

//echo $ans;
    
?>