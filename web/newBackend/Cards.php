<?php
$cards = file_get_contents('./jsdb/cards.json');
$cardsdc = json_decode($cards, true);
$toExport = [];

include('./settings.php');

foreach ($cardsdc as $card) {
    if(!$settings->production || $card['flowName'] !== "TestFlow") {
        $newCard = [];
        $newCard['title'] = $card['title'];
        $newCard['pic'] = $card['pic'];
        $newCard['subTitle'] = $card['subTitle'];
        $newCard['inDeveloping'] = $card['inDeveloping'];
        $newCard['canIUse'] = $card['canIUse'];
        $newCard['shortDiscription'] = $card['shortDiscription'];
        $newCard['flowName'] = $card['flowName'];

        $toExport[] = $newCard;
        unset($newCard);
    }
};

header("Access-Control-Allow-Origin: *");
$json = json_encode( $toExport, JSON_UNESCAPED_UNICODE );
echo $json;

?>