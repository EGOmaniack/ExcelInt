<?php
if(isset($_GET['flowName'])){
    $flowName = $_GET['flowName'];
    $cardsFile = file_get_contents('./jsdb/cards.json');
    $cards = json_decode($cardsFile, true);

    header("Access-Control-Allow-Origin: *");
    echo $cards['discription'];
} else {
    header("Access-Control-Allow-Origin: *");
    header("HTTP/1.0 406 Not Acceptable");
    die('Параметр flowName не задан');
}
?>