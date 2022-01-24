<?php

    include_once ("../../classi/Veicolo.php");

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $Marca = $_POST['marca'];
        $Modello = $_POST['modello'];
        $Versione = $_POST['versione'];
        $Anno = $_POST['anno'];
        $Prezzo = $_POST['prezzo'];
        $Peso = $_POST['peso'];
        $Lunghezza = $_POST['lunghezza'];
        $Larghezza = $_POST['larghezza'];
        $Posti = $_POST['posti'];


        $veicoloDaAggiungere = new Veicolo($Marca, $Modello, $Versione, $Anno, $Prezzo, $Peso, $Lunghezza, $Larghezza, $Posti);
        $veicoloDaAggiungere->inserisciVeicolo();
    }







?>