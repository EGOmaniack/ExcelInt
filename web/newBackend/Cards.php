<?php
$cards = file_get_contents('./cards.json');

header("Access-Control-Allow-Origin: *");
echo $cards;

?>