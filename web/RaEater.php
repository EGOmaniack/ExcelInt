<?php
/**
 * Created by PhpStorm.
 * User: EGOmaniack
 * Date: 25.12.2016
 * Time: 13:36
 */
$mysqli = new mysqli('localhost', 'root','Rgrur4frg56eq16','derdata');
//if ($mysqli->connect_errno) {
//    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
//}
//$mysqli->set_charset("utf8");
if(file_exists('111.txt')) {

    $Ra;

    $handle = fopen("111.txt", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            if (strpos($line, "BEGIN") === false && strpos($line, "END") === false) {
                if (strpos($line, "Ra") > 0) {
                    $raline = substr($line, strpos($line, "Ra"));

                } else {
                    $raline = "";
                }

                if (strlen($raline) > 0) {
                    $exp = explode("&", $raline);
                    $exp[1] = (int)$exp[1];
                    $Ra = implode("", $exp);
                    //echo $Ra.'<br>';
                } else {
                    $line = str_replace(',', '.', $line);
                    $s = preg_replace("/[^0-9\.]/", "", $line);
                    $item = (float)$s;
                    //echo $item.'<br>';
                    $sqls = "INSERT INTO ras(value, Ra) VALUES (" . $item . ",'" . $Ra . "');";
//                    $mysqli->query($sqls);
                }

            }
        }
//        $mysqli->commit();
echo "Готово)";
        fclose($handle);
//        unlink('111.txt');
    }
}