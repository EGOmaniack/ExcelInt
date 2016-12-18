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

$Data; // Все агрегаты


//$pust = 0; // количество пустых строк для цикла // not used

$gost = array('шестигранник', 'круг', 'лист','уголок','швеллер','цепь','труба','пластина');
$work = array('пропан','электроды','эмаль','кислород','шток');


for($i = 0, $q = 0; $i < $higestRow ; $i++  ) {
    $ncheck = $objWorkSheet->getCellByColumnAndRow(0,$i)->getValue();
    if($ncheck == 'n'){
        $q++;
        $agregat['name'] = $objWorkSheet->getCellByColumnAndRow(1,$i)->getValue();
        $agregat['options']['number'] = $objWorkSheet->getCellByColumnAndRow(2,$i)->getValue();
        $agregat['matlist'] = create_block($i+1, $higestRow, $objWorkSheet, $gost,$work );
        unset($ncheck);
        $Data[$q]=$agregat;

    }
}

function save_mat($strok, $i ,$sheet){
    $elem1[] = array();
    switch ($strok){
        case 2 :
            $elem1[0] = $sheet->getCellByColumnAndRow(1,$i)->getValue();
            $elem1[1] = $sheet->getCellByColumnAndRow(1,$i+1)->getValue();
            $elem1[6] = $sheet->getCellByColumnAndRow(5,$i)->getValue();
            $elem1[9] = $sheet->getCellByColumnAndRow(8,$i)->getValue();
            $elem1[10] = $sheet->getCellByColumnAndRow(9,$i)->getValue();
            break;
        case 1 :
            $elem1[0] = $sheet->getCellByColumnAndRow(1,$i)->getValue();
            $elem1[6] = $sheet->getCellByColumnAndRow(5,$i)->getValue();
            $elem1[9] = $sheet->getCellByColumnAndRow(8,$i)->getValue();
            $elem1[10] = $sheet->getCellByColumnAndRow(9,$i)->getValue();
            $elem1[11] = $sheet->getCellByColumnAndRow(10,$i)->getValue();
            break;
    }
    return $elem1;
}

function create_block($startRow,$maxrow, $sheet, $spr2,$spr ){
    for ($j = $startRow, $pust = 0; $j < $maxrow; $j++) {
        $val = $sheet->getCellByColumnAndRow(1, $j)->getValue();
        if (strlen($val) > 0) {
            $pref = explode(' ', $val);


            if (in_array(strtolower_utf8($pref[0]), $spr2)) { // element 0,1,2 марка; 3-11 остальные ячейки

                $matlist[] = save_mat(2, $j, $sheet);
                unset($element);
                $j++;

            } elseif (in_array(strtolower_utf8($pref[0]), $spr)) {

                $matlist[] = save_mat(1, $j, $sheet);
                unset($element);

            }
            switch (strtolower_utf8($pref[0])) {
                case "цепь":
                    break;
                case "проволока":
                    break;
            }


        }


        if ($sheet->getCellByColumnAndRow(0, $j)->getValue() == 'n') {
            return $matlist;
        }
        // переписывем макс число строк и прерываем цикл
        if(strlen($sheet->getCellByColumnAndRow(1,$j)->getValue()) == 0 ){
            if($pust == 5){
                 $higestRow = $j;
                 echo 'Число строк равно '.($higestRow-6).'<br/>';
                return $matlist;
            }else{$pust++;}
                 // echo $pust;
        }else{$pust = 0;}

    }
}

echo 'Файл принят и обработан'.'<br><br>';

$clone = $Data;


$numsovp = 0;

//Поиск всех совпадающих материалов среди агрегатов
foreach ($Data as $key => $value) {
    for($e = 0; $e < count($value['matlist']); $e++){

        foreach ($clone as $k => $v) {
            for($l = 0; $l < count($v['matlist']); $l++){
                if(strtolower_utf8($clone[$k]['matlist'][$l][0]) == strtolower_utf8($value['matlist'][$e][0]) &&
                    strtolower_utf8($clone[$k]['matlist'][$l][1]) == strtolower_utf8($value['matlist'][$e][1]) &&
                    ($clone[$k]['name'] != $value['name'])){
                        unset($clone[$k]['matlist'][$l]);
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

$matmerge = array();
//var_dump($Data);exit;
//Собираем новый массив материалов
foreach ($Data as $value) {
    foreach ($value['matlist'] as $mat) {

        if(in_array($mat, $matmerge)){
            for($o =0; $o < count($matmerge); $o++){
                echo 1;
               if($matmerge[$o] == $mat[$kk]){
                   $matmerge[$o][9] = $matmerge[$o][9] + $mat[$kk][9];
                   $matmerge[$o][55] = 'Y';
               }
            }
        }else{
            $matmerge[]=$mat;
        }
    }
//
//    for($e = 0; $e < count($value['matlist']); $e++){
//        $matmerge =
//
//
//        //echo 'I\'m in cicle <br/>';
//        $exist = false; //Обозначает найдено ли совпадение
//
//        foreach ($matmerge as $k => $v){
//
//            if($matmerge[$v][0] == $Data[$k]['matlist'][$l][0] &&
//            $matmerge[$v][1] == $Data[$k]['matlist'][$l][1]){
//
//                $exist = true; //Найдено совпадение
//            }
//        }
//        //нет совпадения - копируем, если есть суммируем массу
//        if(!$exist){
//            $matmerge[$v] = $Data[$k]['matlist'][$l];
//        }else{
//            $matmerge[$v][9] += $Data[$k]['matlist'][$l][9];
//            // * $Data[$k]['options']['number'];
//        }
//
//    }
}
//var_dump($matmerge);

function strtolower_utf8($string){
    $convert_to = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
        "v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
        "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
        "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
        "ь", "э", "ю", "я"
    );
    $convert_from = array(
        "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
        "V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï",
        "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
        "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
        "Ь", "Э", "Ю", "Я"
    );

    return str_replace($convert_from, $convert_to, $string);
}

//Рисуем таблицу
 $table ='<table border="1">
        <caption>Таблица содержания файла</caption>
        <tr>
        <th>Наименование агрегата</th>
        <th>Кол-во <br/> агрегатов</th>
        <th>Кол-во <br/> материалов</th>
        </tr>';
 for($i=1 ;$i < count($Data) ;$i++){
 $table .='<tr><td>'.$Data[$i]['name'].'</td><td>'.$Data[$i]['options']['number'].'</td><td>'.count($Data[$i]['matlist']).'</td></tr>';
 }
 $table .='</table><br><br>';

// echo $table;
//var_dump($Data);


//Рисуем таблицу всех материалов
$table2 ='<table border="1">
        <caption>Таблица материалов</caption>
        <tr>
        <th>материал</th>
        <th>масса</th>
        </tr>';
for($i=0 ;$i < count($matmerge) ;$i++){
    $table2 .='<tr><td>'.$matmerge[$i][0].'</td><td>'.$matmerge[$i][9].'</td></tr>';
}
$table2 .='</table><br><br>';

//echo $table2;

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