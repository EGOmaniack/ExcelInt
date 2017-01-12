<?php
/**
 * Created by PhpStorm.
 * User: EGOmaniack
 * Date: 26.12.2016
 * Time: 14:23
 */


function BDgetRa()
{
    $mysqli = new mysqli('localhost', 'root', 'Rgrur4frg56eq16', 'thedata');
    if ($mysqli->connect_errno) {
        echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $values[] = array();
    $mysqli->set_charset("utf8");
    $zapros = "SELECT DISTINCT item FROM thedata.ras ORDER BY item;";
    $rezult = $mysqli->query($zapros);
    while ($actor = $rezult->fetch_assoc()) {
        $values[] = $actor['item'];
    }
    return $values;

}

function setDictionary(){

    $mysqli = new mysqli('localhost', 'root', 'Rgrur4frg56eq16', 'thedata');
    $mysqli->set_charset("utf8");
    if ($mysqli->connect_errno) {
        echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $ddubStr = BDgetDictionary(2);
    $donestr = BDgetDictionary(1);

    $dubstr = array('шестигранник', 'круг', 'лист','уголок','шнур','труба',
        'пластина','канат','подкладка','капролон','швеллер','изделие-заготовка','трубка',
        'полоса','квадрат');/*Двустрочные материалы*/
    $onestr = array('пропан','электроды','эмаль','кислород','шток','краска','грунтовка',
        'растворитель','сч','бра9мц2л','бра10мц2л','рельс','маслобензостойкая','бесшовная');/*Однострочные материалы*/

    foreach ($dubstr as $value){
        if(!in_array($value, $ddubStr)) {
            $sqls = "INSERT INTO mat_dictionary(strok, item) VALUES (" . 2 . ",'" . $value . "');";
            $mysqli->query($sqls);
        }
    }
    foreach ($onestr as $value) {
        if (!in_array($value, $donestr)) {
            $sqls = "INSERT INTO mat_dictionary(strok, item) VALUES (" . 1 . ",'" . $value . "');";
            $mysqli->query($sqls);
        }
    }
    $mysqli->commit();
    echo "<br>"."Готово)";

}
//setDictionary();
//var_dump(BDgetDictionary(2));
function BDgetDictionary($i)
{
    $mysqli = new mysqli('localhost', 'root', 'Rgrur4frg56eq16', 'thedata');
    if ($mysqli->connect_errno) {
        echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $values[] = array();
    $mysqli->set_charset("utf8");
    $zapros = "SELECT item FROM thedata.mat_dictionary WHERE strok = $i;";
    $rezult = $mysqli->query($zapros);
    while ($actor = $rezult->fetch_assoc()) {
        $values[] = $actor['item'];
    }
    return $values;

}
