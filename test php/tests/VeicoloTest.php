<?php

    require_once "../App/Connessione.php";

    ///////////////// Testing constructor ///////////////////////////////////////////////////

    // Testing constructor - validateDate method -> 1/1 Valid
    $veicolo1 = new App\Veicolo("fiat", "punto", "90cc", "01/01/01", "17990", "5", "230", "150", "0");

    // Testing constructor - if -> 1/1 Valid
    $veicolo2 = new App\Veicolo("fiat", "punto", "90cc", "01/01/01", "17990", "5", "0", "0", "0");


    // Testing constructor e inserisciVeicolo() -> 1/1 Valid
    $veicolo3 = new App\Veicolo("fiat", "punto", "90cc", "2011-01-01", "17990", "5", "230", "150", "5");
    $veicolo3->inserisciVeicolo();


    ///////////////// Testing Methods ///////////////////////////////////////////////////

    // Testing: static function eliminaVeicolo($targa) -> 1/1 valid 
    Veicolo::eliminaVeicolo("1249");

    // Testing: static function  modificaVeicolo($marca, $modello, $versione, $anno, $prezzo, $peso, $lunghezza, $larghezza, $posti, $targa) -> 1/1 valid 
    Veicolo::modificaVeicolo("prova", "prova", "prova", "2011-09-09", "100", "100", "100", "100", "100", "1244");

    // Testing: static function getTarga($marca, $modello, $versione, $prezzoVeicolo) -> 1/1 valid 
    echo Veicolo::getTarga("alfa romeo", "giulietta", "turbo 120 cv", "24500");

    // Testing: static function getPrezzoByTarga($targa) -> 1/1 valid 
    echo Veicolo::getPrezzoByTarga("1");

    // Testing: static function getBrand() -> 1/1 valid 
    Veicolo::getBrand();

    // Testing: static function getModel($brand) -> 1/1 valid 
    Veicolo::getModel("alfa romeo");

    // Testing: static function getVersion($modello) -> 1/1 valid 
    Veicolo::getVersion("giulietta");

    // Testing: static function getPrezzo($brand, $modello, $versione) -> 1/1 valid 
    echo Veicolo::getPrezzo("alfa romeo", "giulietta", "turbo 120 cv");
?>