<?php

require_once './vendor/autoload.php';

//var_dump($_POST);
$repair_id = $_POST['repair_id'];
$platform_id = $_POST['platform_id'];
$platforms = json_decode($_POST['platform'], true);
$repairs = json_decode($_POST['platf_repairs'], true);

//var_dump($platforms);

//$ans = $platform_id;

// require_once '../../Classes/PHPWord.php';

// $PHPWord = new PHPWord();

// $document = $PHPWord->loadTemplate('../templates/passport.docx');

// $document->setValue( 'name', $platforms[$platform_id]['platf_name'] );
// //$document->setValue( 'number', $platform_id );
// //$document->setValue( 'factory_number', $platforms[$platform_id]['factory_number'] );


 $file = '../docs/passport_pl_№_'.$platform_id.'.docx';

// $document->save($file);

//$phpWord = new \PhpOffice\PhpWord\PhpWord();
$source = "../templates/passport.docx";

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($source);
$templateProcessor->setValue('name', 'ПМС-118');
$templateProcessor->setValue('number', '222');//${number}
$templateProcessor->saveAs($file);
// $objReader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
// $objReader2 = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
// $phpWord = $objReader->load($source);

// $body="";

// foreach($phpWord->getSections() as $section ) {
//     $arrays = $section->getElements(); //Все элементы на странице

//     foreach($arrays as $e) {
//         //echo get_class($e).'<br>';
//         if( get_class($e) === 'PhpOffice\PhpWord\Element\TextRun' ) {
//             foreach( $e-> getElements() as $text ){

//                 $font = $text->getFontStyle();

//                 $size = $font->getSize()/10;
//                 $bold = $font->isBold() ? 'font-weight:700' : '';
//                 $color = $font->getColor();
//                 $fontFamily = $font->getName();

//                 $body .='<span style="font-size: " '. $size .' em; font-family:'. $fontFamily .' ; '. $bold .'; color :#'. $color .' >';
//                 $body .= $text->getText().'</span>';

//                 // $text->getText();
//             } 
//         }else if ( get_class($e) === 'PhpOffice\PhpWord\Element\TextBreak' ) {
//             $body .='<br />';
//         }
//     }
// }

// $phpWordTemp = $objReader2->loadTemlate($source);

//var_dump($body);

// Файл сохраняется вопрос как отдать
// header('Content-Description: File Transfer');
// header('Content-Type: application/octet-stream');
// header('Content-Disposition: attachment; filename="'.basename($file).'"');
// header('Expires: 0');
// header('Cache-Control: must-revalidate');
// header('Pragma: public');
// header('Content-Length: ' . filesize($file));
//     readfile($file);

//echo $ans;
    
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