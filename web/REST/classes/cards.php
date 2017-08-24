<?php

class Cards {
    public $cards;
    private $DBcards;
    private $jsonCards;
    private $newCard;
    private $settings;

    public function __construct ($settings) {
        $this->settings = $settings;
        $this->DBcards = file_get_contents('../v1/jsdb/cards.json');
        $this->DBcards = json_decode($this->DBcards, true);
    }

    public function getCards () {
        foreach ($this->DBcards as $card) {
            if(!$this->settings->production ||
                    $card['flowName'] !== "TestFlow" &&
                    $card['canIUse'] !== "false" ) {
                $this->newCard = [];
                $this->newCard['title'] = $card['title'];
                $this->newCard['pic'] = $card['pic'];
                $this->newCard['subTitle'] = $card['subTitle'];
                $this->newCard['inDeveloping'] = $card['inDeveloping'];
                $this->newCard['canIUse'] = $card['canIUse'];
                $this->newCard['shortDiscription'] = $card['shortDiscription'];
                $this->newCard['flowName'] = $card['flowName'];
        
                $cards[] = $this->newCard;
                unset($this->newCard);
            }
        };

        
        $this->jsonCards = json_encode( $cards, JSON_UNESCAPED_UNICODE );
        return $this->jsonCards;
    }
}

?>