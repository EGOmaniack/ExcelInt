<?php
$cards = file_get_contents('./jsdb/cards.json');
$cardsdc = json_decode($cards, true);
$toExport = [];

foreach ($cardsdc as $card) {
    $newCard = [];
    $newCard['Title'] = $card['Title'];
    $newCard['pic'] = $card['pic'];
    $newCard['SubTitle'] = $card['SubTitle'];
    $newCard['inDeveloping'] = $card['inDeveloping'];
    $newCard['shortDiscription'] = $card['shortDiscription'];
    $newCard['flowName'] = $card['flowName'];

    $toExport[] = $newCard;
    unset($newCard);
}

header("Access-Control-Allow-Origin: *");
$json = json_encode( $toExport, JSON_UNESCAPED_UNICODE );
echo $json;

?>