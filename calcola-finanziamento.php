<?php

include_once("classi/Connessione.php");

session_start();
  $op ='onclick="window.location.href='."'".'registrazione.php'."'".'"';
  $avvertimento = '<h6 style="color:red">*E'."'".' richiesto un account per continuare*</h6>';

  if(isset($_SESSION['UserId'])){
    $stmt = $conn->prepare("select count(codice) as num from Operazione o where o.IDutente = ?");
    $stmt->bind_param('i', $_SESSION['UserId']);
    $stmt->execute();
    $result=$stmt->get_result();
    $Numero = 0;
    while($row = $result->fetch_assoc())
    {
      $Numero = $row['num'];
    }
    if($Numero==0)
    {
      $op = 'onclick="finanziamento()"';
      $avvertimento = "";
    }
    else {
      $op ='onclick="window.location.href='."'".'registrazione.php'."'".'"';
      $avvertimento = '<h6 style="color:red">*E'."'".' permesso un solo finanziamento per account*</h6>';
    }

    //populate();

    $conn->close();
  }

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Calcola</title>
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
<body class="scrollbar-warning" onload="loadSelect()">
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


        <!-- Calcola Finanziamento -->
        <div class="row mTop">
            <div class="col">
                <div class="jumbotron text-center">
                    <h2 class="card-title h2">Calcola il tuo finanziamento</h2>
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-7 pb-2">
                            <p class="card-text">Calcola il tuo finanziamento Avoc: in base al veicolo che hai scelto ti proponiamo queste soluzioni, che coprono tutte le tipologie di finanziamento disponibili per la tua selezione.</p>
                            <?php echo $avvertimento ?>
                                <div class="row">
                                    <div class="col center">
                                        <select name="brand" id="brand" class="custom-select custom-select-sm btn-pink" onchange="myBrand(this)">
                                            <option selected>Brand</option>

                                        </select>
                                    </div>
                                    <div class="col center">
                                        <select name="modello" id="modello" class="custom-select custom-select-sm btn-pink" onchange="myVersione(this)">
                                            <option selected>Modello</option>
                                        </select>
                                    </div>
                                    <div class="col center">
                                        <select name="versione" id="versione" class="custom-select custom-select-sm btn-pink" onchange="calcola()">
                                            <option selected>Versione</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                    <button class="btn btn-lg btn-block btn-pink jumbotron text-center center btn-pink calcola" data-toggle="modal" data-target="#modalRegisterForm" id="myBtn" disabled>
                        <h1 class="text-white center text font-weight-bold"  onclick="datiForm()">
                            Prezzo:
                            € <span id="valore">0.00</span>
                        </h1>
						<h6>clicca qui per continuare</h6>
                    </button>
            </div>
        </div>


		<!-- Modal -->
		<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Finanziamento</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="row">
                                    <div class=" col">
                                        <p class="font-weight-bold" >Brand: <span class="font-weight-bold" id="datiBrand"></span></p>
                                        <p class="font-weight-bold" >Modello: <span class="font-weight-bold" id="datiModello"></span></p>
                                        <p class="font-weight-bold" >Versione: <span class="font-weight-bold" id="datiVersione"></span></p>
                                        <p class="font-weight-bold">
											Prezzo: €<span class="font-weight-bold" id="datiPrezzo"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row mTop">
									<div class="col">
                                        <h3 class="font-weight-bold">Tipologia:</h3>
                                        <!-- Default inline 1-->
									<div class="custom-control custom-radio">
									  <input type="radio" class="custom-control-input" id="tipo1" name="tipologia" value="leasing">
									  <label class="custom-control-label blue-text font-weight-bold" for="tipo1">leasing</label>
									</div>

									<!-- Default inline 2-->
										<div class="custom-control custom-radio">
										  <input type="radio" class="custom-control-input" id="tipo2" name="tipologia" value="noleggio" checked>
										  <label class="custom-control-label blue-text font-weight-bold" for="tipo2">noleggio</label>
										</div>
                                    </div>
                                    <div class="col">
                                        <h3>Rata mensile</h3>
                                        <!-- Group of default radios - option 1 -->
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="mesi1" name="datiMese" value = "12" onclick="datiForm()">
                                            <label class="custom-control-label" for="mesi1">12 mesi</label>
                                        </div>
                                        <!-- Group of default radios - option 2 -->
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="mesi2" name="datiMese"  value = "24" checked onclick="datiForm()">
                                            <label class="custom-control-label" for="mesi2">24 mesi</label>
                                        </div>
                                        <!-- Group of default radios - option 3 -->

								   <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="mesi3" name="datiMese" value = "36" onclick="datiForm()">
                                            <label class="custom-control-label" for="mesi3">36 mesi</label>
                                        </div>
                                        <!-- Group of default radios - option 4 -->
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="mesi4" name="datiMese" value = "48" onclick="datiForm()">
                                            <label class="custom-control-label" for="mesi4">48 mesi</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h3>Anticipo %</h3>
                                        <!-- Default inline 1-->
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="anticipo1" name="datiAnticipo" value = "0" >
                                            <label class="custom-control-label" for="anticipo1">0% - <span  id="datiAnticipo1"></span></label>
                                        </div>

                                        <!-- Default inline 2-->
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="anticipo2" name="datiAnticipo" value = "10" checked>
                                            <label class="custom-control-label" for="anticipo2">10% - <span  id="datiAnticipo2"></span></label>
                                        </div>

                                        <!-- Default inline 3-->
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="anticipo3" name="datiAnticipo" value = "20" >
                                            <label class="custom-control-label" for="anticipo3">20% - <span  id="datiAnticipo3"></span></label>
                                        </div>

                                        <!-- Default inline 3-->
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="anticipo4" name="datiAnticipo" value = "30">
                                            <label class="custom-control-label" for="anticipo4">30% - <span id="datiAnticipo4"></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mTop">
                                    <div class="col">
                                        <h3>Chilometraggio</h3>
                                        <!-- Default inline 1-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="km1" name="datiChilometraggio" value = "50000">
                                            <label class="custom-control-label" for="km1">50.000 Km</label>
                                        </div>

                                        <!-- Default inline 2-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="km2" name="datiChilometraggio" value = "60000">
                                            <label class="custom-control-label" for="km2">60.000 Km</label>
                                        </div>

                                        <!-- Default inline 3-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="km3" name="datiChilometraggio" value = "70000" checked>
                                            <label class="custom-control-label" for="km3">70.000 Km</label>
                                        </div>

                                        <!-- Default inline 4-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="km4" name="datiChilometraggio" value = "80000">
                                            <label class="custom-control-label" for="km4">80.000 Km</label>
                                        </div>

										<!-- Default inline 5-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="km5" name="datiChilometraggio" value = "90000">
                                            <label class="custom-control-label" for="km5">90.000 Km</label>
                                        </div>

										<!-- Default inline 6-->
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="km6" name="datiChilometraggio" value = "100000">
                                            <label class="custom-control-label" for="km6">100.000 Km</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center" >
                                <button class="btn btn-deep-orange" <?php echo $op ?> >Riepilogo</button>
                            </div>
                        </div>
                    </div>
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
	<!-- Ajax -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>

        function loadSelect(){
            $.ajax({
                url : 'php/calcoloFinanziamento/brand.php',
                type : 'POST',
                success : function(data) {              

                    var result = $.parseJSON(data);
                    var sel = document.getElementById('brand');

                    for (var i = 0; i < result.length; i++){
                    var obj = result[i];
                        for (var key in obj){
                            var value = obj[key];
                            var opt = document.createElement('option');
                            opt.innerHTML = value;
                            opt.value = value;
                            sel.appendChild(opt);
                        }
                    }
                },
                error : function(request,error){
                    alert("Errore marche");
                }
                });
        }

        function myBrand(selectObject){
            document.getElementById('modello').options.length = 1;
            document.getElementById('versione').options.length = 1;
            document.getElementById("valore").innerHTML = "";
            document.getElementById("valore").innerHTML = "0.00";
            document.getElementById("myBtn").disabled = true;
            $.ajax({
                url : 'php/calcoloFinanziamento/fillModel.php',
                type : 'POST',
                data:"Brand="+selectObject.value,
                success : function(data) {              

                    var result = $.parseJSON(data);
                    var sel = document.getElementById('modello');

                    for (var i = 0; i < result.length; i++){
                    var obj = result[i];
                        for (var key in obj){
                            var value = obj[key];
                            var opt = document.createElement('option');
                            opt.innerHTML = value;
                            opt.value = value;
                            sel.appendChild(opt);
                        }
                    }

                },
                error : function(request,error){
                    alert("Errore versioni");
                }
                });
        }

        function myVersione(selectObject){
            document.getElementById('versione').options.length = 1;
            document.getElementById("myBtn").disabled = true;
            document.getElementById("valore").innerHTML = "";
            document.getElementById("valore").innerHTML = "0.00";
            document.getElementById("myBtn").disabled = true;
            $.ajax({
                url : 'php/calcoloFinanziamento/fillVersione.php',
                type : 'POST',
                data:"Versione="+selectObject.value,
                success : function(data) {              

                    var result = $.parseJSON(data);
                    var sel = document.getElementById('versione');

                    for (var i = 0; i < result.length; i++){
                    var obj = result[i];
                        for (var key in obj){
                            var value = obj[key];
                            var opt = document.createElement('option');
                            opt.innerHTML = value;
                            opt.value = value;
                            sel.appendChild(opt);
                        }
                    }

                },
                error : function(request,error){
                    alert("Errore versioni");
                }
                });
        }


        function calcola() {
                var brand = document.getElementById("brand").value;
				var modello = document.getElementById("modello").value;
				var versione = document.getElementById("versione").value;
                var url_ok = "php/calcoloFinanziamento/calcola.php";
                $.ajax({
                    type: "POST",
                    url: url_ok,
                    data: {
                        "brand": brand,
                        "modello": modello,
						"versione": versione,
                    },
                    success: function(risposta) {
						document.getElementById("valore").innerHTML = risposta;
						document.getElementById("datiBrand").innerHTML = brand;
						document.getElementById("datiModello").innerHTML = modello;
						document.getElementById("datiVersione").innerHTML = versione;
						document.getElementById("datiPrezzo").innerHTML = risposta;
                    },
                error : function(request,error){
                    alert("Errore calcolo");
                }});
				document.getElementById("myBtn").disabled = false;
            }

    </script>
</body>
</html>
