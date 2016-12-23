<?php
ini_set('display_errors', 0) ;
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);
require_once('saveExcel.php');
require_once('Classes/PHPExcel.php');
include_once 'Classes/PHPExcel/IOFactory.php';
//require_once('Classes/PHPExcel/Writer/Excel5.php');
//var_dump($_FILES);

$filename = $_FILES['fileToUpload']['tmp_name'];
$objreader = PHPExcel_IOFactory::createReader('Excel2007');//создали ридер
$objreader->setReadDataOnly(true); //только на чтение файла
//$objExcel = $objreader->load('ListAll2.xlsx');
$objExcel = $objreader->load($filename);
$objExcel ->setActiveSheetIndex(3);
$objWorkSheet = $objExcel->getActiveSheet(); //Вся таблица 1ого листа
$higestRow = $objWorkSheet->getHighestRow(); // Слишком много перезапишем

//echo 'Начинаю обработку файла'.'<br/>';

$Data; // Все агрегаты


//$pust = 0; // количество пустых строк для цикла // not used

$gost = array('шестигранник', 'круг', 'лист','уголок','швеллер','шнур','труба',
    'пластина','канат','подкладка','капролон','изделие-заготовка');/*Двустрочные материалы*/
$work = array('пропан','электроды','эмаль','кислород','шток','краска','грунтовка',
    'растворитель','сч','бра9мц2л','бра10мц2л','подкладка');/*Однострочные материалы*/


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
        case 1 :
            $elem1[0] = $sheet->getCellByColumnAndRow(1,$i)->getValue();
            $elem1[6] = $sheet->getCellByColumnAndRow(5,$i)->getValue();
            $elem1[9] = $sheet->getCellByColumnAndRow(8,$i)->getValue();
            $elem1[10] = $sheet->getCellByColumnAndRow(9,$i)->getValue();
            $elem1[11] = $sheet->getCellByColumnAndRow(10,$i)->getValue();
            break;
        default :
            $elem1[0] = $sheet->getCellByColumnAndRow(1,$i)->getValue();
            $elem1[1] = $sheet->getCellByColumnAndRow(1,$i+1)->getValue();
            $elem1[6] = $sheet->getCellByColumnAndRow(5,$i)->getValue();
            $elem1[9] = $sheet->getCellByColumnAndRow(8,$i)->getValue();
            $elem1[10] = $sheet->getCellByColumnAndRow(9,$i)->getValue();

    }
    return $elem1;
}
/*Удаляем пробелы вначале фразы*/
function killSpaces($str){
    $exp = explode(' ',$str);
    $co = count($exp);
    for($i = 0; $i < $co; $i++){
        if($exp[$i] == ''){
            unset($exp[$i]);
        }else{

            break;}
    }
    $str = implode(' ', $exp);
    return $str;

}

//function

function create_block($startRow,$maxrow, $sheet, $spr2,$spr ){
    for ($j = $startRow, $pust = 0; $j < $maxrow; $j++) {
        $val = $sheet->getCellByColumnAndRow(1, $j)->getValue();
        if (strlen($val) > 0) {
            $val = killSpaces($val);
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
                    $matlist[] = save_mat(2,$j,$sheet);
                    break;
                case "проволока":
                    //Заплата /В данном документе все равно нет совпадений по проволоке
                    $matlist[] = save_mat(2,$j,$sheet);
                    break;
            }


        }


        if ($sheet->getCellByColumnAndRow(0, $j)->getValue() == 'n') {
            return $matlist;
        }
        // переписывем макс число строк и прерываем цикл
        if(strlen($sheet->getCellByColumnAndRow(1,$j)->getValue()) == 0 ){
            if($pust == 50){
                 $higestRow = $j;
                 echo 'Число строк равно '.($higestRow-51).'<br/>';
                return $matlist;
            }else{$pust++;}
                 // echo $pust;
        }else{$pust = 0;}

    }
}

echo 'Файл принят и обработан'.'<br><br>';


//Собираем новый массив материалов

$count;
$matmerge;
//Объединение все в единый массив с проверкой копий
foreach ($Data as $key => $value){
    for($i = 0; $i < count($value['matlist']);$i++){

        $copy = false;
        $y = 0;
        unset($y);
        for($j = 0; $j < count($matmerge);$j++){   /*Смотрим есть ли копия очередного материала в matmerge*/
            if(preg_replace('/\s+/', '', strtolower_utf8($matmerge[$j][0])) == preg_replace('/\s+/', '', strtolower_utf8($value['matlist'][$i][0])) &&
                preg_replace('/\s+/', '', strtolower_utf8($matmerge[$j][1])) == preg_replace('/\s+/', '', strtolower_utf8($value['matlist'][$i][1]))) {
                $count++; /*Считаем количество учтенных совпадений*/
                $copy = true;/*Нашли совпадение*/
                $y = $j;/*Запоминаем порядковый номер совпадения*/
                break;/*больше не проверяем раз уж нашли одно совпадение*/
//                echo 'Есть...'.$matmerge[$j][0].'/'.$matmerge[$j][1].'<br/>'
//                    . 'Копия'.$value['matlist'][$i][0].'/'.$value['matlist'][$i][1].$Data[$key]['name'].' масса= '.$Data[$key]['matlist'][$i][9].'<br/><br/>';
            }
        }
        if(!$copy) {
            $masscount = $value['matlist'][$i];
            $masscount[9] *= $value['options']['number'];
            $matmerge[] = $masscount;
            unset($masscount);

                //* $value['options']['number'];
        }else{
            $masscount = $value['matlist'][$i];
            $masscount[9] *= $value['options']['number'];
            $matmerge[$y][9] += $masscount[9];
            unset($masscount);
        }
    }
}
echo 'count '.$count.'<br/>';

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
 for($i=1 ;$i <= count($Data) ;$i++){
 $table .='<tr><td>'.$Data[$i]['name'].'</td><td>'.$Data[$i]['options']['number'].'</td><td>'.count($Data[$i]['matlist']).'</td></tr>';
 }
 $table .='</table><br><br>';

echo $table;


//Рисуем таблицу всех материалов
$table2 ='<table border="1">
        <caption>Таблица материалов</caption>
        <tr>
        <th>Марка</th>
        <th>обозначение <br/> стандарта или <br/> тех. Условия</th>
        <th>Код <br/> материала</th>
        <th>материал</th>
        <th>Еденица <br/> измерения</th>
        <th>Код <br/> еденицы <br/> измерения</th>
        <th>Норма <br/> расхода</th>
        <th>масса</th>
        <th>Стоимость <br/> еденицы <br/> измерения</th>
        <th>Сумма <br/> на <br/> комплект</th>
        </tr>';
for($i=0 ;$i < count($matmerge) ;$i++){
    $table2 .='<tr><td>'.$matmerge[$i][0].'</td>'.'<td></td><td></td><td></td>'.'<td>'.
        $matmerge[$i][6].'</td><td></td><td></td><td>'.round($matmerge[$i][9], 2).'</td><td>'.$matmerge[$i][10].'</td><td>'.
        $matmerge[$i][9] * $matmerge[$i][10].'</td></tr>';
    if($matmerge[$i][1] != null){$table2 .='<tr><td class="mat">'.$matmerge[$i][1].'</td></tr>';}
}
$table2 .='</table><br><br>';

echo $table2;


//saveExcel($matmerge);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/main.css?1"/>
</head>

<body>

<!--<input type="button" value="Сравнить">-->



</body>
</html>