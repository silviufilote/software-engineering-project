<?php

    require_once "../App/Connessione.php";


    ///////////////// Testing constructor ///////////////////////////////////////////////////

    // Testing correct attributs insertion -> 1/1 valid
    $utenteReg = new App\UtenteRegistrato("avoc-99999", "tavolo", "112");
    $utenteReg->inserisciUtenteRegistrato();

    ///////////////// Testing Methods ///////////////////////////////////////////////////

    // Testing: static function generateAdmin($nickname) -> 1/1 valid 
    echo UtenteRegistrato::generateAdmin("avoc-99999");

?>