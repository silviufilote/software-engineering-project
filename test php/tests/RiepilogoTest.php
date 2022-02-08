<?php

    require_once "../App/Connessione.php";


    ///////////////// Testing constructor ///////////////////////////////////////////////////

    // Testing correct attributs insertion -> 1/1 valid
    $riepilogo = new App\Riepilogo("1","123","1","123.000","123","1","123.000","123","1","123.000","1","1","23");
    $riepilogo->inserisciRiepilogo("123");

    ///////////////// Testing Methods ///////////////////////////////////////////////////

    // Testing: static function CreazioneTabella($sessId) -> 1/1 valid 
    Riepilogo::creazioneTabella("123");

?>