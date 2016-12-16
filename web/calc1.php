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
$higestRow =600;
echo 'Начинаю обработку файла'.'<br/>';
$agrNum[] = array();//not used
$Data[] = array();//not used

$pust = 0; // количество пустых строк для цикла // not used

$gost = array('Шестигранник', 'Круг', 'Лист','Уголок','Швеллер');
$work = array('пропан', 'кислород', 'электроды','Эмаль');


for($i = 0; $i < $higestRow ; $i++ ) {
    $ncheck = $objWorkSheet->getCellByColumnAndRow(0,$i)->getValue();
    if($ncheck == 'n'){
        $agregat['name'] = $objWorkSheet->getCellByColumnAndRow(1,$i)->getValue();
        $agregat['matlist'] = create_block($i+1, $higestRow, $objWorkSheet, $gost,$work );
        unset($ncheck);
        $Data[]=$agregat;
    }
}

function create_block($startRow,$maxrow, $sheet, $spr2,$spr ){
    for ($j=$startRow; $j < $maxrow; $j++) {
        $val = $sheet->getCellByColumnAndRow(1,$j)->getValue();
        if(strlen($val) >0) {
            $pref = explode(' ',$val );


            if( in_array($pref[0],$spr2)){ // element 0,1,2 марка; 3-11 остальные ячейки
                $element[0] = $sheet->getCellByColumnAndRow(1,$j)->getValue();
                $element[1] = $sheet->getCellByColumnAndRow(1,$j+1)->getValue();
                $element[6] = $sheet->getCellByColumnAndRow(5,$j)->getValue();
                $element[9] = $sheet->getCellByColumnAndRow(8,$j)->getValue();
                $element[10] = $sheet->getCellByColumnAndRow(9,$j)->getValue();
                $element[11] = $sheet->getCellByColumnAndRow(10,$j)->getValue();

                if($j <12){var_dump($element);}
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
    }
}

//var_dump($Data);

$clone = $Data;

$compare;

$comparear;
foreach ($Data as $key => $value) {
    for($e = 0; $e < count($value['matlist']); $e++){

        foreach ($clone as $k => $v) {
            for($l = 0; $l < count($v['matlist']); $l++){
                if($clone[$k]['matlist'][$l] == $value['matlist'][$e] && $clone[$k]['name'] != $value['name']){
                   // echo 'clone'.$clone[$k]['name'].'<br>';
                   // echo 'original'.$value['name'].'<br>';
                    //var_dump($clone[$k]['matlist'][$l]);
// $compare[] = $clone[$key]['matlist'][$e];
                }
            }
        }

    }
}






 //Рисуем таблицу
 $table ='<table>';
 for($i=0;$i<count($Data);$i++){
 // $table .='<tr><td>'.$i.'</td><td>'.'$i + 1' .'</td></tr>';
 $table .='<tr><td>'.$Data[$i]['name'].'</td><td>'.$agrNum[$i].'</td></tr>';
 }
 $table .='</table>';

 //echo $table;


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
</head> 

<body> 

<!--<input type="button" value="Сравнить">--> 

</form> 

</body> 
</html>