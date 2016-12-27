<?php
require_once('Classes/PHPExcel.php');
include_once 'Classes/PHPExcel/IOFactory.php';

$filetmpname = $_FILES['fileToUpload']['tmp_name'];
$filename = $_FILES['fileToUpload']['name'];

echo $filename.'<br>';
echo $filetmpname;

$objreader = PHPExcel_IOFactory::createReader('Excel2007');//создали ридер
$objreader->setReadDataOnly(true); //только на чтение файла
//$objExcel = $objreader->load('ListAll2.xlsx');
$objExcel = $objreader->load($filename);
$objExcel ->setActiveSheetIndex(3);
$objWorkSheet = $objExcel->getActiveSheet(); //Вся таблица 1ого листа
$higestRow = $objWorkSheet->getHighestRow(); // Слишком много перезапишем

echo "Reader создан";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/main.css?1"/>
    <title>Вторая страница</title>
</head>

<body>
    <div>Ну хоть сюда ты зашел</div>
<!--<input type="button" value="Сравнить">-->



</body>
</html>
