<?php
session_start();
include_once("php/utils.php");
include_once("classi/Connessione.php");
include_once("classi/Veicolo.php");
include_once("classi/Riepilogo.php");
checkSession(0);
$Dati = '';


/* il mio pezzo */
if ($stmt = $conn->prepare("SELECT tipo,durata,canoneMensile,totDaFinanziare,tanMensile,idVeicolo FROM Operazione WHERE IDutente = ? ")) {
		$stmt->bind_param("i", $_SESSION['UserId']);
		//$stmt->bind_param("i",$utente = 1);
		$stmt->execute();
		$stmt->bind_result($tipo,$durata,$canoneMensile,$totFin,$tanMensile,$targa );
		$stmt->fetch();
		$stmt->close();
	}


    $prezzo = Veicolo::getPrezzoByTarga($targa);

	$costiFissi = 200 + 300 + 16 + 3 + 3.50 + number_format(($prezzo * 0.0021) , 2, '.', '');

	$tot;
	for($x = 1; $x <= $durata; $x++){
    	$tot .= $x.",";
    }
	$tot = substr($tot,0,-1);


	if($tipo == 'leasing'){
		$totFin = $totFin + $costiFissi;
		$rataMensile = number_format(($totFin*($tanMensile/100)*(1+($tanMensile/100))**$durata)/((1+($tanMensile/100))**$durata - 1), 2, '.', '');

		$totNoleggio;
		for($x = 1; $x <= $durata; $x++){
			$totNoleggio .= $rataMensile.",";
			$totSoldiNoleggio += $rataMensile;
		}
		$totNoleggio = substr($totNoleggio,0,-1);


		$totLeasing;
		for($x = 1; $x <= $durata; $x++){
			$var = rand($canoneMensile,$rataMensile*1.05);
			$totLeasing .= $var.",";
			$totSoldiLeasing += $var;
		}
		$totLeasing = substr($totLeasing,0,-1);

	}else {
		$totFin = $totFin - $costiFissi;
		$rataMensile = number_format(($totFin*($tanMensile/100)*(1+($tanMensile/100))**$durata)/((1+($tanMensile/100))**$durata - 1), 2, '.', '');

		$totNoleggio;
		for($x = 1; $x <= $durata; $x++){
			$totNoleggio .= $canoneMensile.",";
			$totSoldiNoleggio += $canoneMensile;
		}
		$totNoleggio = substr($totNoleggio,0,-1);


		$totLeasing;
		for($x = 1; $x <= $durata; $x++){
			$var = rand($rataMensile,$canoneMensile*1.05);
			$totLeasing .= $var.",";
			$totSoldiLeasing += $var;
		}
		$totLeasing = substr($totLeasing,0,-1);
	}

	//Prima tabella
	$result = Riepilogo::creazioneTabella($_SESSION['UserId']);

	$cap;
	// vedi
	if($tipo == 'leasing'){
		$cap = $totSoldiLeasing;
	}else {
		$cap = $totSoldiNoleggio;
	}

	while($row = $result->fetch_assoc())
	{
	  //$Dati = $Dati.'<tr onclick="CaricaTabella('.$row['Codice'].')">';
	  //$Capitale = $row['totdaFinanziare'] -$row['anticipo'];
	  echo '<script>var Codice = '.$row['Codice'].'</script>';
	  $Dati = $Dati.'<td class="pt-3-half" >'.$row['marca'].'</td>';
	  $Dati = $Dati.'<td class="pt-3-half" >'.$row['modello'].'</td>';
	  $Dati = $Dati.'<td class="pt-3-half" >'.$row['versione'].'</td>';
	  $Dati = $Dati.'<td class="pt-3-half" >'.$row['idVeicolo'].'</td>';
	  $Dati = $Dati.'<td class="pt-3-half" >'.$row['rimanenti'].'</td>';
	  $Dati = $Dati.'<td class="pt-3-half" >'.number_format($row['Rata'], 2, '.', '').'</td>';
	  $Dati = $Dati.'<td class="pt-3-half" ">'.$row['tipo'].'</td>';
	  $Dati = $Dati.'<td class="pt-3-half" >'.$row['tanFisso'].'</td>';
	  $Dati = $Dati.'<td class="pt-3-half" >'.$row['Prezzo'].'</td>';
	  $Dati = $Dati.'<td class="pt-3-half" >'.number_format($cap, 2, '.', '').'</td>';
	  $Dati = $Dati.'<td class="pt-3-half" >'.number_format($row['totdaFinanziare'], 2, '.', '').'</td>';
	  $Dati = $Dati.'</tr>';
	}
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>User</title>
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
<body>
    <!-- Header -->
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark young-passion-gradient scrolling-navbar nav">
            <strong class="styleT navbar-brand">Avoc</strong>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
									<li class="nav-item"><a class="nav-link" href="home.php?Logout"  id="log">Logout</a></li>
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

        <!-- Calcola finanziamento-->
        <div class="row">
            <div class="col center mTop">
                <a cla href="calcola-finanziamento.php" alt="not-found.html">
                    <button class="btn young-passion-gradient white-text">Calcola finanziamento</button>
                </a>
            </div>
        </div>

        <!-- Grafici -->
        <div class="row mTop">
            <div class="col">
                <canvas id="chart"></canvas>
            </div>
        </div>

		<!--
		<div class="row mTop">
            <div class="col">
                <canvas id="present"></canvas>
            </div>
        </div>
		-->
		
		
        <!--Titolo tabella -->
        <div class="row mTop">
            <div class="col center">
                <h3 class="font-weight-bold text-uppercase py-4 pink-text">Auto in possesso</h3>
            </div>
        </div>

        <!-- Tabella -->
        <div class="row">
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm pink-text font-weight-bold">
                            Marca
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Modello
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Versione
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Targa
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Mesi Rimanenti
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Rata Mensile
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Tipo
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Tan
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Prezzo Veicolo
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Totale da rimborsare
                        </th>
						<th class="th-sm pink-text font-weight-bold">
                            Totale da finanziare
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php   echo $Dati; ?>
                </tbody>
            </table>
        </div>

        <!--Titolo tabella -->
        <div class="row mTop">
            <div class="col center">
                <h3 class="font-weight-bold text-uppercase py-4 pink-text">Ammortamento</h3>
            </div>
        </div>

        <!-- Ammortamento -->
		<div class="row">
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm pink-text font-weight-bold">
                            Mesi
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Capitale
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Rata
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Quota interessi
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Capitale restituito
                        </th>
                        <th class="th-sm pink-text font-weight-bold">
                            Capitale residuo
                        </th>
                    </tr>
                </thead>
                <tbody id="tBody">
                </tbody>
            </table>
        </div>


    </div>

    <!-- Footer -->
    <footer class="page-footer font-small young-passion-gradient">

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

		<script>


	//line
	var ctxL = document.getElementById("chart").getContext('2d');
	var myLineChart = new Chart(ctxL, {
		type: 'line',
		data: {
			labels: [<?php echo $tot ?>],
			datasets: [{
					label: 'Leasing: <?php echo $totSoldiLeasing ?> €',
					data: [<?php echo $totLeasing ?>],
					backgroundColor: 'rgb(255,134,122,0.5)',
					borderColor:'rgb(248,40,40,0.8)',
					borderWidth: 2,
				},
				{
					label: "Noleggio: <?php echo $totSoldiNoleggio ?> €",
					data: [<?php echo $totNoleggio ?>],
					backgroundColor: 'rgb(180,47,93,0.5)',
					borderColor: 'rgb(91,50,65,0.8)',
					borderWidth: 2,
				}
			]
		},
		options: {
			scales: {
				yAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Costo',
						fontColor: 'black'
					}
				}],
				xAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Mesi',
						fontColor: 'black'
					}
				}]
			},
			responsive: true
		}
	});

/*
	var grafico = document.getElementById("present").getContext('2d');
	var myLineChart2 = new Chart(grafico, {
		type: 'line',
		data: {
			labels: [<?php echo $tot ?>],
			datasets: [{
					label: 'Leasing: <?php echo $totSoldiLeasing ?> €',
					data: [<?php echo $totLeasing ?>],
					backgroundColor: 'rgb(255,134,122,0.5)',
					borderColor:'rgb(248,40,40,0.8)',
					borderWidth: 2,
				},
				{
					label: "Noleggio: <?php echo $totSoldiNoleggio ?> €",
					data: [<?php echo $totNoleggio ?>],
					backgroundColor: 'rgb(180,47,93,0.5)',
					borderColor: 'rgb(91,50,65,0.8)',
					borderWidth: 2,
				}
			]
		},
		options: {
			scales: {
				yAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Costo',
						fontColor: 'black'
					}
				}],
				xAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Mesi',
						fontColor: 'black'
					}
				}]
			},
			responsive: true
		}
	});
*/

$(document).ready(function() {   $.ajax({
          type:'POST',
          data:"Codice="+Codice,
          url:'php/tabellauser.php',
          success:function(data) {
              document.getElementById('tBody').innerHTML = data;
          }
      });});

	</script>

</body>
</html>
