<?php

    require_once "../App/Connessione.php";

    ///////////////// Testing constructor ///////////////////////////////////////////////////

    // Testing CF size (no 16 characters) -> 1/1 Valid
    $utente2 = new App\Utente("Silviu", "Filote", "1998-11-07", "FVZTPG58L49A792", "test@gm");

    // Testing USA format date -> 1/1 Valid
    $utente3 = new App\Utente("Silviu", "Filote", "07-11-1998", "FVZTPG58L49A792", "test@gm");

    // Testing no Name -> 1/1 Valid
    $utente4 = new App\Utente("", "Filote", "07-11-1998", "FVZTPG58L49A792", "test@gm");

    // Testing no Surname -> 1/1 Valid
    $utente5 = new App\Utente("Silviu", "", "07-11-1998", "FVZTPG58L49A792", "test@gm");

    // Testing no date -> 1/1 Valid
    $utente6 = new App\Utente("Silviu", "Filote", "", "FVZTPG58L49A792", "test@gm");

    // Testing no CF size -> 1/1 Valid
    $utente7 = new App\Utente("Silviu", "Filote", "1998-11-07", "", "test@gm");

    // Testing no email -> 1/1 Valid
    $utente8 = new App\Utente("Silviu", "Filote", "1998-11-07", "FVZTPG58L49A792", "test@gm");

    // Testing correct attributs insertion -> 1/1 valid
    $utente9 = new App\Utente("Silviu", "Filote", "1998-11-07", "FVZTPG58L49A792K", "test@gm");
    $utente9->inserisciUtente();


    ///////////////// Testing Methods ///////////////////////////////////////////////////

    // Testing: function generaNick($Nick) -> 1/1 valid 
    echo $utente9->generaNick("avoc-32963");

    // Testing: static function recuperoIdUtente($codiceFiscale)
    echo Utente::recuperoIdUtente("FVZTPG58L49A792K");

?>