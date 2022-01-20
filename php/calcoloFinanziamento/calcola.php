<?php

include_once ("../../classi/Veicolo.php");

	$prezzo = null;
	if(isset($_POST['brand']) && isset($_POST['modello']) && isset($_POST['versione'])) {
		$brand = $_POST['brand'];
		$modello = $_POST['modello'];
		$versione = $_POST['versione'];

		$prezzo = Veicolo::getPrezzo($brand, $modello, $versione);
	} 
	echo $prezzo;
?>