<?php

include_once ("classi/Connessione.php");
include_once ("classi/Riepilogo.php");
include_once ("classi/Veicolo.php");

session_start();

$tipo = $_GET['tipo'];
$marca = $_GET['brand'];
$modello = $_GET['modello'];
$versione = $_GET['versione'];
$mesi = $_GET['mese'];
$prezzo = number_format($_GET['prezzo'], 2, '.', '');;
$chilometraggio = $_GET['chilometraggio'];
$anticipo = number_format($_GET['anticipo'], 2, '.', '');;
$riscatto;
$fissaKm;
$costiFissi;
$tanFisso = 3.00;
$taeg = 5.40;
$tanMensile = 3.04;
$marchiatura;
$pneumatici;
$speseIstruttoria;
$bolli;
$speseRendiconto;
$sepa;
$prezzoVeicolo;



/* mesi */
if ($mesi == 12) {
    $riscatto = number_format($prezzo * 0.75, 2, '.', '');
    $prezzoVeicolo = number_format($prezzo / 0.20, 2, '.', '');
} else if ($mesi == 24) {
    $riscatto = number_format($prezzo * 0.70, 2, '.', '');
    $prezzoVeicolo = number_format($prezzo / 0.34, 2, '.', '');
} else if ($mesi == 36) {
    $riscatto = number_format($prezzo * 0.64, 2, '.', '');
    $prezzoVeicolo = number_format($prezzo / 0.37, 2, '.', '');
} else if ($mesi == 48) {
    $riscatto = number_format($prezzo * 0.58, 2, '.', '');
    $prezzoVeicolo = number_format($prezzo / 0.45, 2, '.', '');
} else {
    header("location: calcola-finanziamento.php"); /* controllo che i dati acquisiti dal get siano veritieri */
    exit;
}


/* fissa per km */
if ($chilometraggio == 50000) {
    $fissaKm = 1.2;
} else if ($chilometraggio == 60000) {
    $fissaKm = 1.4;
} else if ($chilometraggio == 70000) {
    $fissaKm = 1.6;
} else if ($chilometraggio == 80000) {
    $fissaKm = 1.8;
} else if ($chilometraggio == 90000) {
    $fissaKm = 2;
} else if ($chilometraggio == 100000) {
    $fissaKm = 2.2;
} else {
    header("location: calcola-finanziamento.php"); /* controllo che i dati acquisiti dal get siano veritieri */
    exit;
}


$targa = Veicolo::getTarga($marca, $modello, $versione, $prezzoVeicolo);

if (!isset($targa) || empty($targa) || is_null($targa)) {
    header("location: calcola-finanziamento.php"); /* controllo che i dati acquisiti dal get siano veritieri */
    exit;
}
$totDaFinanziare = number_format(((($prezzo) + ($prezzo) * ($fissaKm / 100) + $costiFissi) - $anticipo), 2, '.', '');
$rataMensile = number_format(($totDaFinanziare * ($tanMensile / 100) * (1 + ($tanMensile / 100)) **$mesi) / ((1 + ($tanMensile / 100)) **$mesi - 1), 2, '.', '');
$totDaRimborsare = number_format($rataMensile * $mesi, 2, '.', '');
$interessi = number_format($totDaRimborsare - $totDaFinanziare, 2, '.', '');
$mesiPagati = (rand(1, $mesi));

$riepilogo = new Riepilogo($tipo, $targa, $mesi, $prezzo, $chilometraggio, $anticipo, $riscatto, $fissaKm, $prezzoVeicolo, $totDaFinanziare, $rataMensile, $totDaRimborsare, $interessi);

echo $riepilogo->costiFissi;

//Inserimento con utente registrato
if (isset($_POST['setValues'])) {
    if ($conn->connect_errno) {
        exit();
    }
    $riepilogo->inserisciRiepilogo($_SESSION['UserId']);
    echo '<script>alert("Eskere- ' . $_SESSION['UserId'] . '");</script>';
    header("location: user.php"); /*Redirect*/
}
?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Riepilogo</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .title {
            color: #b32d5c !important;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-image: -webkit-gradient(linear, left top, right top, from(#ff8177), color-stop(0%, #ff867a), color-stop(21%, #ff8c7f), color-stop(52%, #f99185), color-stop(78%, #cf556c), to(#b12a5b));
            background-image: -webkit-linear-gradient(left, #ff8177 0%, #ff867a 0%, #ff8c7f 21%, #f99185 52%, #cf556c 78%, #b12a5b 100%);
            background-image: linear-gradient(to right, #ff8177 0%, #ff867a 0%, #ff8c7f 21%, #f99185 52%, #cf556c 78%, #b12a5b 100%);
        }

    </style>
</head>

<body class="scrollbar-warning">
    <!-- Header -->
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark young-passion-gradient scrolling-navbar nav">
            <strong class="styleT navbar-brand">Avoc</strong>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dettagli.php">Dettagli</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="calcola-finanziamento.php">Finanziamento<i class="fas fa-hand-holding-usd"></i></a>
                    </li>

                </ul>
                <ul class="navbar-nav nav-flex-icons">
                </ul>
            </div>
        </nav>
    </header>

    <!-- Tutta la roba-->
    <div class="container">

        <!-- Titoletto -->
        <div class="mTop">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-12 col-md-auto">
                    <p class="title animated pulse">Avoc</p>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>

        <!-- titoletto -->
        <div class="row">
            <div class="col">
                <p class="center">Un mondo più vicino ai clienti</p>
            </div>
        </div>

        <!-- Riepilogo -->
        <div class="jumbotron text-center mTop">
            <form action="" method="post">
				<div class="row justify-content-md-center">
					<div class="container">
					  <div class="row">
						<div class="col-sm">
						  <a href="calcola-finanziamento.php" title="ricalcola">
							<i class="fas fa-arrow-alt-circle-left arrow"></i>
						</a>
						</div>
						<div class="col-sm">
						  <h2 class="card-title h2">Riepilogo <!--leasing/noleggio--></h2>
						</div>
						<div class="col-sm">
						</div>
					  </div>
					</div>
				  </div>
                <p class="pink-text my-4 font-weight-bold">tutti i dati selezionati durante l'operazione di finanziamento:</p>
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col-6 text-left">
                        <p class="font-weight-bold">Tipologia:<span class="font-weight-normal"> <?php echo $tipo ?></span></p>
                        <p class="font-weight-bold">Marca:<span class="font-weight-normal"> <?php echo $marca ?></span></p>
                        <p class="font-weight-bold">Modello:<span class="font-weight-normal"> <?php echo $modello ?></span></p>
                        <p class="font-weight-bold">Versione:<span class="font-weight-normal"> <?php echo $versione ?></span></p>
						<p class="font-weight-bold">Chilometraggio km:<span class="font-weight-normal"> <?php echo $chilometraggio ?></span></p>
						<p class="font-weight-bold">Mesi:<span class="font-weight-normal"> <?php echo $mesi ?></span></p>
                        <p class="font-weight-bold">Prezzo veicolo €:<span class="font-weight-normal"> <?php echo number_format(($prezzoVeicolo), 2, '.', ''); ?></span></p>                      
                        <p class="font-weight-bold">Anticipo €:<span class="font-weight-normal"> <?php echo number_format(($anticipo), 2, '.', ''); ?></span></p>                       
                        <p class="font-weight-bold">Valore riscatto €:<span class="font-weight-normal"> <?php echo number_format(($riscatto), 2, '.', ''); ?></span></p>
						<p class="font-weight-bold">Totale da finanziare €:<span class="font-weight-normal"> <?php echo number_format(($totDaFinanziare), 2, '.', ''); ?></span></p>
                        <p class="font-weight-bold">Totale da rimborsare €:<span class="font-weight-normal"> <?php  echo number_format(($totDaRimborsare), 2, '.', ''); ?></span></p>
						<p class="font-weight-bold">Interessi €:<span class="font-weight-normal"> <?php echo  number_format(($interessi), 2, '.', ''); ?></span></p>                       
                        <p class="font-weight-bold">Tan fisso :<span class="font-weight-normal"> <?php echo number_format(($tanFisso), 2, '.', '');?></span></p>   
                        <p class="font-weight-bold">Taeg :<span class="font-weight-normal"> <?php echo number_format(($taeg), 2, '.', '');?></span></p>
						<p class="font-weight-bold">Canone mensile €:<span class="font-weight-normal"> <?php echo number_format(($rataMensile), 2, '.', ''); ?></span></p>
                    </div>
                    <div class="col">
                    </div>
                </div>
                <hr class="my-4">
                <div class="pt-2">
                    <button type="submit" value="" class="btn btn-outline-pink waves-effect" name="setValues"  <?php echo $btn; ?> > Sottoscrivi <i class="fas fa-file-signature"></i></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small young-passion-gradient mTop">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">
            © 2022 Copyright:
            <a class="colorWhite" href="home.php"> Avoc.altervista.org</a>
        </div>
        <!-- Copyright -->

    </footer>

    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.js"></script>
    <!-- Icons for the site -->
    <script src="https://kit.fontawesome.com/42d7196ac9.js" crossorigin="anonymous"></script>
    <!-- Calcola finanziamento-->
    <script type="text/javascript" src="js/calcolaFinanziamento.js"></script>
</body>

</html>
