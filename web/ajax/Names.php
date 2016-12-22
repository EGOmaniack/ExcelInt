<?php
/**
 * Created by PhpStorm.
 * User: EGOmaniack
 * Date: 05.12.2016
 * Time: 13:27
 */
$_POST['name'];
$names['name']='Vasya';
$arr[0]=$names;
$names['name']='Olya';
$arr[1]=$names;
$names['name']='Kate';
$arr[2]=$names;
/*
if($_POST['name'] == 'Vasya'){
    $names['name']='Kristya';
    $arr[3]=$names;
}*/
$arrCount = count($arr);

for ($i = 0; $i < $arrCount ; $i++){
    if($_POST['name'] == $arr[$i] ){
        break;
    }elseif($i = $arrCount){
        $names['name']=$_POST['name'];
        $arr[1 + $arrCount] = $names;
    }
}
//sleep(2);
//
////$gg[] = array();
//$gg['agregat1']['name'] = "Агр вывоза блоков";
//$gg['agregat1']['matlist'] = array();
//$gg['agregat2']['name'] = "Выравневатель шпал";
//$gg['agregat2']['matlist'] = array();
//
//for($i = 0; $i < 2; $i++){
////    $nper[$i] = "text".$i;
//    $arr[] = "text".$i;
////    unset($nper);
//}
//$gg['agregat1']['matlist'] = $arr;
//$gg['agregat2']['matlist'] = $arr;




//var_dump($gg);

echo json_encode($arr);



//$jreadArr = $jarr;

//echo $jreadArr;