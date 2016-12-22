<?php
/**
 * Created by PhpStorm.
 * User: EGOmaniack
 * Date: 19.12.2016
 * Time: 13:22
 */

$arr = $_FILES['fileToSave']['tmp_name'];
//saveExcel();

function saveExcel($arr, $dubstr, $onestr){
    $xls = new PHPExcel();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('ведомость материалов');

// Вставляем текст в ячейку A1
$sheet->setCellValue("B2", 'Ведомость материалов');
$sheet->getStyle('B2')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('B2')->getFill()->getStartColor()->setRGB('EEEEEE');

// Объединяем ячейки
$sheet->mergeCells('B2:H2');

// Выравнивание текста
$sheet->getStyle('B2')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//расставляем номера колонок
for ($n=0; $n < 11; $n++){
    $sheet->setCellValueByColumnAndRow($n, 8, $n+1);

}
//zapoln($sheet,$arr);
Zapoln2($sheet, $arr, $dubstr, $onestr);

//header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
//header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
//header ( "Cache-Control: no-cache, must-revalidate" );
//header ( "Pragma: no-cache" );
header ( "Content-Type: application/vnd.ms-excel" );
header ( "Content-Disposition: attachment; filename='Калькуляция.xls'" );



$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel5');
$objWriter->save('php://output');
exit();
}

//Заполнение
function zapoln($sheet, $arr){
    for($i =0; $i < count($arr); $i++){/*перебираем материалы*/
        $sheet->setCellValueByColumnAndRow(1, $i*2+10, $arr[$i]['name']);
        $sheet->setCellValueByColumnAndRow(1, $i*2+11, $arr[$i]['mat']);
        $sheet->setCellValueByColumnAndRow(5, $i*2+10, $arr[$i]['ei']);
        $sheet->setCellValueByColumnAndRow(8, $i*2+10, $arr[$i]['mass']);
        $sheet->setCellValueByColumnAndRow(9, $i*2+10, $arr[$i]['cost']);
        $sheet->setCellValueByColumnAndRow(10, $i*2+10, ($arr[$i]['mass']*$arr[$i]['cost']));
    }
}
//Заполнение с сортировкой
function Zapoln2($sheet, $arr, $dubstr, $onestr){
    $k = 0; /* общий номер строки куда писать в Excel*/
    for($i =0; $i < count($dubstr); $i++){/*перебираем двустрочный перечень материалов*/
        findelem($dubstr[$i], $arr, $sheet, $k);
        $k++;
    }
    for($j =0; $j < count($onestr); $j++){/*перебираем однострочный перечень материалов*/
        findelem($onestr[$j], $arr, $sheet, $k);
        $k++;
    }

}

function findelem ($ela,$mats,$sheet, $k){
    for($i =0; $i < count($mats); $i++){/*перебираем материалы*/
        $val = killSpaces($mats[$i]['name']);
        $val = explode(' ', $val);
        $val = strtolower_utf8($val[0]);

        if($val[0] == $ela){
            $sheet->setCellValueByColumnAndRow(1, $k*2+10, $mats[$i]['name']);
            $sheet->setCellValueByColumnAndRow(1, $k*2+11, $mats[$i]['mat']);
            $sheet->setCellValueByColumnAndRow(5, $k*2+10, $mats[$i]['ei']);
            $sheet->setCellValueByColumnAndRow(8, $k*2+10, $mats[$i]['mass']);
            $sheet->setCellValueByColumnAndRow(9, $k*2+10, $mats[$i]['cost']);
            $sheet->setCellValueByColumnAndRow(10, $k*2+10, ($mats[$i]['mass']*$mats[$i]['cost']));
        }
    }
}





?>