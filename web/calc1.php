<?php
require_once('Classes/PHPExcel.php');
include_once 'Classes/PHPExcel/IOFactory.php';
//var_dump($_FILES);

$filename = $_FILES['fileToUpload']['tmp_name'];


$objreader = PHPExcel_IOFactory::createReader('Excel2007');

$objreader->setReadDataOnly(true);

$objExcel = $objreader->load($filename);
$objWorkSheet = $objExcel->getActiveSheet(); //Вся таблица 1ого листа
$higestRow = $objWorkSheet->getHighestRow(); // Слишком много перезапишем

for($i = 2; $i < $higestRow ; $i++ ) {
    $check = $objWorkSheet->getCellByColumnAndRow(1,$i)->getValue();

    //$check2 = $objWorkSheet->getCellByColumnAndRow(1,($i+1))->getValue();
    if ($check == ''){

        for($j = 1; $j <= 4; $j++) {
            $check2 = $objWorkSheet->getCellByColumnAndRow(1,($i+$j))->getValue();
            if($check2 == ''){
                if($j==4){
                    echo $i;
                    break3;
                }
            }
            else{
                echo $i;
                break;
            }
        }
        //echo $i;
        break;
    }
}



/*if ($test == ''){
    echo "ничего нет";
}*/

$keys = array("David", "Amy", "John");

$table ='<table>';
for($i=0;$i<10;$i++){
   // $table .='<tr><td>'.$i.'</td><td>'.'$i + 1' .'</td></tr>';
    $table .='<tr><td>'.$i.'</td><td>'.($i+1).'</td></tr>';
}
$table .='</table>';
//echo $table;


//$string = preg_replace('/\s+/', '', $string); //удаление пробелов
/*
* $rest = substr("abcdef", 0, -1);  // возвращает "abcde"
* $rest = substr("abcdef", 2, -1);  // возвращает "cde"
* $rest = substr("abcdef", 4, -4);  // возвращает false
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
