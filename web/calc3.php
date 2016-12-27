<?php
require_once('Classes/PHPExcel.php');
require_once('Classes/PHPExcel/IOFactory.php');

$filetmpname = $_FILES['fileToUpload']['tmp_name'];
$filename = $_FILES['fileToUpload']['name'];

echo $filename.'<br>';
echo $filetmpname.'<br>';

$objreader = PHPExcel_IOFactory::createReader('Excel2007');//создали ридер
echo "Reader создан".'<br>';
$objreader->setReadDataOnly(true); //только на чтение файла
echo "Выставлены параметры чтения".'<br>';
//$objExcel = $objreader->load('ListAll2.xlsx');
$objExcel = $objreader->load($filename);
echo "подгружаем файл".'<br>';
$objExcel ->setActiveSheetIndex(3);
$objWorkSheet = $objExcel->getActiveSheet(); //Вся таблица 1ого листа
$higestRow = $objWorkSheet->getHighestRow(); // Слишком много перезапишем



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
