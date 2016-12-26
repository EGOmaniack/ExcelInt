<?php
/**
 * Created by PhpStorm.
 * User: EGOmaniack
 * Date: 26.12.2016
 * Time: 14:23
 */
function BDgetRa()
{
    $mysqli = new mysqli('10.40.100.48', 'root', 'Rgrur4frg56eq16', 'thedata');
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