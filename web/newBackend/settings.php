<?php

class Settings {
    public $production;

    function __construct() {
        $this->production = false;
    }
}

$settings = new Settings();

?>