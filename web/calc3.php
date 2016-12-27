<?php
require_once('Classes/PHPExcel.php');
include_once('Classes/PHPExcel/IOFactory.php');

$ftn = $_FILES['fileToUpload']['tmp_name'];
$filename = $_FILES['fileToUpload']['name'];

echo $filename.'<br>';
echo $ftn.'<br>';

$objreader = PHPExcel_IOFactory::createReader('Excel2007');//создали ридер
echo "Reader создан".'<br>';
$objreader->setReadDataOnly(true); //только на чтение файла
echo "Выставлены параметры чтения".'<br>';
//$objExcel = $objreader->load('ListAll2.xlsx');
$objExcel = $objreader->load($ftn);
echo "подгружаем файл".'<br>';
$objExcel ->setActiveSheetIndex(3);
$objWorkSheet = $objExcel->getActiveSheet(); //Вся таблица 1ого листа
$higestRow = $objWorkSheet->getHighestRow(); // Слишком много перезапишем



?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/main.css?2"/>
    <title>Вторая страница</title>
</head>

<body>
    <div>Ну хоть сюда ты зашел</div>
<!--<input type="button" value="Сравнить">-->



</body>
</html>
