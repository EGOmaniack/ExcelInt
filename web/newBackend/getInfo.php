<?php
if(isset($_GET['flowName'])){
    $flowName = $_GET['flowName'];
    $cardsFile = file_get_contents('./jsdb/cards.json');
    $cards = json_decode($cardsFile, true);

    foreach ($cards as $card) {
        if($card['flowName'] == $flowName){

            header("Access-Control-Allow-Origin: *");
            echo $card['Discription'];
            exit;
        }
    }
        header("HTTP/1.0 406 Not Acceptable");
        die('Параметр flowName не найден');
} else {
    header("Access-Control-Allow-Origin: *");
    header("HTTP/1.0 406 Not Acceptable");
    die('Параметр flowName не задан');
}
?>