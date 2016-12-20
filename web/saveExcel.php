<?php
/**
 * Created by PhpStorm.
 * User: EGOmaniack
 * Date: 19.12.2016
 * Time: 13:22
 */

$arr = $_FILES['fileToSave']['tmp_name'];
//saveExcel();

function saveExcel($arr){
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
//Заполняем таблицу
    for($i =0; $i < count($arr); $i++){/*перебираем материалы*/
        $k = $i+1;
        $sheet->setCellValueByColumnAndRow(1, $i*2+10, $arr[$i][0]);
        $sheet->setCellValueByColumnAndRow(1, $i*2+11, $arr[$i][1]);
        $sheet->setCellValueByColumnAndRow(5, $i*2+10, $arr[$i][6]);
        $sheet->setCellValueByColumnAndRow(8, $i*2+10, $arr[$i][9]);
        $sheet->setCellValueByColumnAndRow(9, $i*2+10, $arr[$i][10]);
        $sheet->setCellValueByColumnAndRow(10, $i*2+10, ($arr[$i][9]*$arr[$i][10]));

    }

        // Выводим таблицу умножения
//        $sheet->setCellValueByColumnAndRow(2, 10, $arr[0][0]);
        // Применяем выравнивание
//        $sheet->getStyleByColumnAndRow(10, 2)->getAlignment()->
//        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


//header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
//header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
//header ( "Cache-Control: no-cache, must-revalidate" );
//header ( "Pragma: no-cache" );
header ( "Content-Type: application/vnd.ms-excel" );
header ( "Content-Disposition: attachment; filename='Калькуляция.xls'" );


//$objWriter = new PHPExcel_Writer_Excel5($xls);
//$objWriter->save('php://output');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel5');
$objWriter->save('php://output');
exit();
}
?>