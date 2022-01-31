<?php
if( isset($_POST['prezzo']) && isset($_POST['mese']) && isset($_POST['anticipo']) && isset($_POST['chilometraggio'])) {
	$tipo = 'leasing';
	$mese = $_POST['mese'];
	$mesiPagati = echo(rand(1,$_POST['mese']));

	$prezzo = $_POST['prezzo'];
	$anticipo = $prezzo * $_POST['anticipo'] / 100;


	$chilometraggio = $_POST['chilometraggio'];
	$valoreRiscatto = 5000;	/* valore costante mio*/
	$tanFisso = 5.3;
	$totFinanziare = $prezzo / $mese;
	$totRimborsare = $interessi + $prezzo;

	$marchiatura = 200;
	$polizzaPneu = 150;
	$bolliContrattuali = 80;
	$speseIstruttoria = 20;
	$speseRendiconto = 3;
	$sepa = 5;
	$utente =  $_SESSION['UserId']; /*$_SESSION['UserId']*/

	$idVeicolo = getTarga();
	$interessi = ($prezzo * $tanFisso * ($mese / 12))/100;
	$canoneMensile = ($interessi/$mese)+($totFinanziare/$mese);
	$taeg= 1; /* da calcolare bene */

	$mysqli = new mysqli('localhost','avoc','','my_avoc');
	if (mysqli_connect_errno()) {
		exit();
	}
	if ($stmt = $mysqli->prepare("INSERT INTO `Operazione` (`Codice`, `tipo`, `durata`, `mesiPagati`, `anticipo`, `km`, `valoreRiscatto`, `canoneMensile`, `tanFisso`, `totDaFinanziare`, `totDaRimborsare`, `marchiature`, `polizzaPneumatici`, `bolliContrattuali`, `speseIstruttoria`, `speseRendiconto`, `sepa`, `IDutente`, `idVeicolo`, `interessi`, taeg`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
		$stmt->bind_param("siididdddddddddddisdd", $tipo, $mese, $mesiPagati, $anticipo, $chilometraggio, $valoreRiscatto, $canoneMensile, $tanFisso, $totFinanziare, $totRimborsare, $marchiatura, $polizzaPneu, $bolliContrattuali, $speseIstruttoria, $speseRendiconto, $sepa, $utente, $idVeicolo, $interessi, $taeg`);
		$stmt->execute();
		$stmt->bind_result();
		$stmt->fetch();
		$stmt->close();
	}
	$mysqli->close();
	echo 'success';
}



function getTarga(){
	$mysqli = new mysqli('localhost','avoc','','my_avoc');
	if (mysqli_connect_errno()) {
		exit();
	}
	if ($stmt = $mysqli->prepare("SELECT idVeicolo WHERE marca = ? AND modello = ? AND versione = ?")) {
		$stmt->bind_param("sss", $_POST['brand'], $_POST['modello'], $_POST['versione']);
		$stmt->execute();
		$stmt->bind_result($targa);
		$stmt->fetch();
		$stmt->close();
	}
	$mysqli->close();
	echo $targa;
}
?>
