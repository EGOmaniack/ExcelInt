<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);
require_once('Classes/PHPExcel.php');
include_once 'Classes/PHPExcel/IOFactory.php';
//var_dump($_FILES);

$filename = $_FILES['fileToUpload']['tmp_name'];
$objreader = PHPExcel_IOFactory::createReader('Excel2007');//создали ридер
$objreader->setReadDataOnly(true); //только на чтение файла
//$objExcel = $objreader->load('ListAll2.xlsx');
$objExcel = $objreader->load($filename);
$objExcel ->setActiveSheetIndex(0);
$objWorkSheet = $objExcel->getActiveSheet(); //Вся таблица 1ого листа
$higestRow = $objWorkSheet->getHighestRow(); // Слишком много перезапишем

echo 'Начинаю обработку файла'.'<br/>';
$agrNum[] = array();  // Кол-во агрегатов
$Data[] = array(); // Все агрегаты

//$pust = 0; // количество пустых строк для цикла // not used

$gost = array('Шестигранник', 'Круг', 'Лист','Уголок','Швеллер','Цепь','Труба');
$work = array('пропан','электроды','Эмаль','Проволока','Кислород');


for($i = 0, $q = 0; $i < $higestRow ; $i++  ) {
    $ncheck = $objWorkSheet->getCellByColumnAndRow(0,$i)->getValue();
    if($ncheck == 'n'){
        $q++;
        $agregat['name'] = $objWorkSheet->getCellByColumnAndRow(1,$i)->getValue();
        $agregat['matlist'] = create_block($i+1, $higestRow, $objWorkSheet, $gost,$work );
        unset($ncheck);
        $Data[$q]=$agregat;
        $agrNum[$q] = $objWorkSheet->getCellByColumnAndRow(2,$i)->getValue();

    }
}

function create_block($startRow,$maxrow, $sheet, $spr2,$spr ){
    for ($j=$startRow , $pust = 0; $j < $maxrow; $j++) {
        $val = $sheet->getCellByColumnAndRow(1,$j)->getValue();
        if(strlen($val) >0) {
            $pref = explode(' ',$val );


            if( in_array($pref[0],$spr2)){ // element 0,1,2 марка; 3-11 остальные ячейки
                $element[0] = $sheet->getCellByColumnAndRow(1,$j)->getValue();
                $element[1] = $sheet->getCellByColumnAndRow(1,$j+1)->getValue();
                $element[6] = $sheet->getCellByColumnAndRow(5,$j)->getValue();
                $element[9] = $sheet->getCellByColumnAndRow(8,$j)->getValue();
                $element[10] = $sheet->getCellByColumnAndRow(9,$j)->getValue();
                //$element[11] = $sheet->getCellByColumnAndRow(10,$j)->getValue(); //Считывается формула текстом

                $matlist[] = $element;
                unset($element);
                $j++;
            }
            elseif(in_array($pref[0],$spr)){
                $element[0] = $sheet->getCellByColumnAndRow(1,$j)->getValue();
                $element[6] = $sheet->getCellByColumnAndRow(5,$j)->getValue();
                $element[9] = $sheet->getCellByColumnAndRow(8,$j)->getValue();
                $element[10] = $sheet->getCellByColumnAndRow(9,$j)->getValue();
                $element[11] = $sheet->getCellByColumnAndRow(10,$j)->getValue();
                $matlist[] = $element;
                unset($element);
            }


        }


        if($sheet->getCellByColumnAndRow(0,$j)->getValue() == 'n' ){
            return $matlist;
        }
        // переписывфем макс число строк и прерываем цикл
        if(strlen($sheet->getCellByColumnAndRow(1,$j)->getValue()) == 0 ){
            if($pust == 5){
                 $higestRow = $j;
                 echo 'Число строк равно '.($higestRow-6).'<br/>';
                 break;
                 }else{$pust++;}
                 // echo $pust;
                 }else{$pust = 0;}
             }
        }

var_dump($Data[3]);
echo '<br><br>';
var_dump($Data[6]);
echo 'Файл принят и обработан'.'<br><br>';

$clone = $Data;

$compare;

$comparear;
$numsovp = 0;
foreach ($Data as $key => $value) {
    for($e = 0; $e < count($value['matlist']); $e++){

        foreach ($clone as $k => $v) {
            for($l = 0; $l < count($v['matlist']); $l++){
                if($clone[$k]['matlist'][$l][0] == $value['matlist'][$e][0] &&
                    $clone[$k]['matlist'][$l][1] == $value['matlist'][$e][1] &&
                    ($clone[$k]['name'] != $value['name'])){
                        $numsovp++;
//                    echo 'original: '.$value['name'].'<br>';
//                    echo 'clone: '.$clone[$k]['name'].'<br>';
//                    echo $clone[$k]['matlist'][$l][0].'/'.$clone[$k]['matlist'][$l][1].'<br><br>';

                }
            }
        }

    }
}
echo 'Совпадений найдено - '.$numsovp.' шт.';




 //Рисуем таблицу
 $table ='<table>';
 for($i=0 ;$i < count($Data) ;$i++){
 $table .='<tr><td>'.$Data[$i]['name'].'</td><td>'.$agrNum[$i].'</td></tr>';
 }
 $table .='</table>';

 echo $table;

 echo '<br><br>';

//$table2 ='<table>';
//for($i=0 ;$i < count($Data) ;$i++){
//    $table2 .='<tr><td>'.$Data[$i]['name'].'</td><td>'.$agrNum[$i].'</td></tr>';
//}
//$table2 .='</table>';
//
//echo $table2;


//$string = preg_replace('/\s+/', '', $string); //удаление пробелов
/*
* $rest = substr("abcdef", 0, -1); // возвращает "abcde" 
* $rest = substr("abcdef", 2, -1); // возвращает "cde" 
* $rest = substr("abcdef", 4, -4); // возвращает false 
* $rest = substr("abcdef", -3, -1); // возвращает "de" 
*/ 
?> 

<!DOCTYPE html> 
<html> 
<head>
    <link rel="stylesheet" href="css/main.css?1"/>
</head> 

<body> 

<!--<input type="button" value="Сравнить">--> 

</form> 

</body> 
</html>