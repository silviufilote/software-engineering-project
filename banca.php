<?php
session_start();
include_once("php/utils.php");
checkSession(1);

$Dati = '';

//Prima tabella
$sql = '';
$conn = mysqli_connect('localhost','avoc','','my_avoc');
$stmt = $conn->prepare("SELECT Marca,Modello,Versione,idVeicolo,Annoimmatricolazione,Prezzo,NumPosti,Lunghezza,Larghezza,Peso from Veicolo where idVeicolo not in (Select v.idVeicolo from Veicolo v inner join Operazione o on o.idVeicolo = v.idVeicolo) and Veicolo.IDbanca = ? order by Veicolo.idVeicolo asc");

$stmt->bind_param('i',$_SESSION['UserId']);
$stmt->execute();
$result=$stmt->get_result();
while($row = $result->fetch_assoc())
{
  $Dati = $Dati.'<tr>';
  $Dati = $Dati.'<td class="pt-3-half" id="Marca-'.$row['idVeicolo'].'" contenteditable="true">'.$row['Marca'].'</td>';
  $Dati = $Dati.'<td class="pt-3-half" id="Modello-'.$row['idVeicolo'].'" contenteditable="true">'.$row['Modello'].'</td>';
  $Dati = $Dati.'<td class="pt-3-half" id="Versione-'.$row['idVeicolo'].'" contenteditable="true">'.$row['Versione'].'</td>';
  $Dati = $Dati.'<td class="pt-3-half" id="idVeicolo-'.$row['idVeicolo'].'" >'.$row['idVeicolo'].'</td>';
  $Dati = $Dati.'<td class="pt-3-half" id="Annoimmatricolazione-'.$row['idVeicolo'].'" contenteditable="true">'.$row['Annoimmatricolazione'].'</td>';
  $Dati = $Dati.'<td class="pt-3-half" id="Prezzo-'.$row['idVeicolo'].'" contenteditable="true">'.$row['Prezzo'].'</td>';
  $Dati = $Dati.'<td class="pt-3-half" id="NumPosti-'.$row['idVeicolo'].'" contenteditable="true">'.$row['NumPosti'].'</td>';
  $Dati = $Dati.'<td class="pt-3-half" id="Lunghezza-'.$row['idVeicolo'].'" contenteditable="true">'.$row['Lunghezza'].'</td>';
  $Dati = $Dati.'<td class="pt-3-half" id="Larghezza-'.$row['idVeicolo'].'" contenteditable="true">'.$row['Larghezza'].'</td>';
  $Dati = $Dati.'<td class="pt-3-half" id="Peso-'.$row['idVeicolo'].'" contenteditable="true">'.$row['Peso'].'</td>';
  $Dati = $Dati.'<td><span><button type="button" class="btn blue-gradient btn-sm pad" onclick="salvaModifiche('.$row['idVeicolo'].')" >Modifica</button><button type="button" class="btn btn-outline-primary waves-effect btn-sm pad" onclick="eliminaMacchina('.$row['idVeicolo'].')" >Elimina</button></span></td></tr>';
}

//Seconda tabella
$sql = '';
$conn = mysqli_connect('localhost','avoc','','my_avoc');
$stmt = $conn->prepare("select Marca,Modello,Versione,Operazione.idVeicolo,Utente.CF,(((tanFisso * (Prezzo - anticipo) * (durata/12)) /100)+ Prezzo)/ durata as Rata,tipo, durata - mesiPagati as rimanenti from Veicolo inner join Operazione on Veicolo.idVeicolo = Operazione.idVeicolo inner join Utente on Utente.ID = Operazione.IDutente where Veicolo.IDbanca = ?");
$stmt->bind_param('i',$_SESSION['UserId']);
$stmt->execute();
$result=$stmt->get_result();
while($row = $result->fetch_assoc())
{
  $Dati2 = $Dati2.'<tr>';
  $Dati2 = $Dati2.'<td class="pt-3-half" >'.$row['Marca'].'</td>';
  $Dati2 = $Dati2.'<td class="pt-3-half" >'.$row['Modello'].'</td>';
  $Dati2 = $Dati2.'<td class="pt-3-half" >'.$row['Versione'].'</td>';
  $Dati2 = $Dati2.'<td class="pt-3-half" >'.$row['idVeicolo'].'</td>';
  $Dati2 = $Dati2.'<td class="pt-3-half" >'.$row['CF'].'</td>';
  $Dati2 = $Dati2.'<td class="pt-3-half" >'.round($row['Rata'], 2).'</td>';
  $Dati2 = $Dati2.'<td class="pt-3-half" >'.$row['tipo'].'</td>';
  $Dati2 = $Dati2.'<td class="pt-3-half" >'.$row['rimanenti'].'</td>';
  $Dati2 = $Dati2.'</tr>';
}


    mysqli_close($conn);



    if(isset($_POST['btn-inserisciVeicolo'])){
        header("Location: http://www.google.com");
        exit();
    }



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Banca</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .title {
            color: #3143a2 !important;
        }

		.pad{
			padding: .5rem !important;
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
            background-image: -webkit-linear-gradient(330deg, #e0c3fc 0%, #8ec5fc 100%);
            background-image: linear-gradient(120deg, #e0c3fc 0%, #8ec5fc 100%);
        }

        .mmTop{
            margin-top: 3%;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark blue-gradient scrolling-navbar nav">
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

    <!-- Tutta la roba -->
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


         <!-- Inserimento macchina -->
         <div class="row mmTop">
            <div class="col">
                <div class="jumbotron text-center">
                    <h2 class="card-title h2">Inserimento nuova auto</h2>
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-7 pb-2">
                        <form method="post">
                            <p class="card-text">Inserisci tutte le informazioni all'interno delle caselle di testo.</p>
                                <div class="row mmTop">
                                    <div class="col center">
                                        <div class="form-outline">
                                            <input type="text" id="verificaMarca" class="form-control"  placeholder="Marca" onchange="verifica()" required/>
                                          </div>
                                    </div>
                                    <div class="col center">
                                        <div class="form-outline">
                                            <input type="text" id="verificaModello" class="form-control" placeholder="Modello" onchange="verifica()" required/>
                                          </div>
                                    </div>
                                    <div class="col center">
                                        <div class="form-outline">
                                            <input type="text" id="verificaVersione" class="form-control" placeholder="Versione" onchange="verifica()" required/>
                                          </div>
                                    </div>
                                    <div class="col center">
                                        <div class="form-outline">
                                            <input type="datetime" id="verificaAnno" class="form-control" placeholder="Anno Immatri." onchange="verifica()" required/>
                                          </div>
                                    </div>
                                </div>

                                <div class="row mmTop">
                                    <div class="col center">
                                        <div class="form-outline">
                                            <input type="number" id="verificaPrezzo" class="form-control" placeholder="Prezzo" onchange="verifica()" required/>
                                          </div>
                                    </div>
                                    <div class="col center">
                                        <div class="form-outline">
                                            <input type="number" id="verificaPeso" class="form-control" placeholder="Peso" onchange="verifica()" required/>
                                          </div>
                                    </div>
                                    <div class="col center">
                                        <div class="form-outline">
                                            <input type="number" id="verificaLunghezza" class="form-control" placeholder="Lunghezza"  onchange="verifica()" required/>
                                          </div>
                                    </div>
                                    <div class="col center">
                                        <div class="form-outline">
                                            <input type="number" id="verificaLarghezza" class="form-control" placeholder="Larghezza" onchange="verifica()" required/>
                                          </div>
                                    </div>
                                    <div class="col center">
                                        <div class="form-outline">
                                            <input type="number" id="verificaPosti" class="form-control" placeholder="Posti" onchange="verifica()" required/>
                                          </div>
                                    </div>
                                </div>


                                </form> 
                        </div>
                    </div>
                    <p class="mmTop"><b>*[Anno]: YYYY-mm-dd, <span>&nbsp;</span> *[Prezzo]: virgola decimali, <span>&nbsp;</span> *[Peso]: in Kg, <span>&nbsp;</span> *[Lughezza/larghezza]: in cm</b></p>
                </div>
                    <button type = "submit" class="btn btn-lg btn-block jumbotron text-center center btn-primary calcola" data-toggle="modal" data-target="#modalRegisterForm" id="btnInserisci" name="btnInserisci" onclick="inserisciVeicolo()" value="Btn inserisci" disabled>
                        <h1 class="text-white center text font-weight-bold" >
                            inserisci
                        </h1>
                    </button>
            </div>
        </div>

        <!-- Tabella auto listino -->
        <!--
        La cancellazione e l'agiunta di un veicolo
        la cencellazione del veicolo non può avvenire nel caso sia già stato affidato a un cliente, per cui fare un sistema nel database che idetifichi sta cosa
        e rimuovere il pulsante remove o disabilitarlo oppure fare la ricerca dopo aver premuto il pulsante
        -->
        <div class="card mTop">
            <h3 class="card-header text-center font-weight-bold text-uppercase py-4 blue-text ">Auto listino</h3>
            <div class="card-body">
                <div id="table" class="table-editable">
                    <table id="myTable" class="table table-bordered table-responsive-md table-striped text-center" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Modello</th>
                                <th class="text-center">Versione</th>
                                <th class="text-center">Targa</th>
                                <th class="text-center">Anno</th>
                                <th class="text-center">Prezzo</th>
                                <th class="text-center">Posti</th>
                                <th class="text-center">Lunghezza</th>
                                <th class="text-center">Larghezza</th>
                                <th class="text-center">Peso</th>
                                <th class="text-center">Azioni</th>
                            </tr>
                        </thead>
                        <tbody id="Tabella1">

                            <?php   echo $Dati; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Auto in leasing-->
        <div class="card mTop mBot">
            <h3 class="card-header text-center font-weight-bold text-uppercase py-4 blue-text ">Auto in leasing</h3>
            <div class="card-body">
                <div id="table" class="table table-striped">
                    <table class="table table-bordered table-responsive-md table-striped text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Modello</th>
                                <th class="text-center">Versione</th>
                                <th class="text-center">Targa</th>
                                <th class="text-center">Codice Fiscale</th>
                                <th class="text-center">Rata Mensile</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Mesi Rimanenti</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php   echo $Dati2; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small blue-gradient">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">
            © 2019 Copyright:
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
    <!-- My custom scripts (optional) -->
    <script type="text/javascript" src="js/myTable.js"></script>
    <!-- Icons for the site -->
    <script src="https://kit.fontawesome.com/42d7196ac9.js" crossorigin="anonymous"></script>

    <script>
    function salvaModifiche(targa){
      Marca = $('#Marca-'+targa).text();
      Modello = $('#Modello-'+targa).text();
      Versione = $('#Versione-'+targa).text();
      Targa = $('#idVeicolo-'+targa).text();
      Annoimmatricolazione = $('#Annoimmatricolazione-'+targa).text();
      Prezzo = $('#Prezzo-'+targa).text();
      NumPosti = $('#NumPosti-'+targa).text();
      Lunghezza = $('#Lunghezza-'+targa).text();
      Larghezza = $('#Larghezza-'+targa).text();
      Peso = $('#Peso-'+targa).text();
      //alert(Targa);
      //alert(Marca+Modello+Versione+Targa+Annoimmatricolazione+Prezzo+NumPosti+Lunghezza+Larghezza+Peso);
      $.ajax({
              type:'POST',
              data:"Marca="+Marca+"&Modello="+Modello+"&Versione="+Versione+"&Targa="+Targa+"&Annoimmatricolazione="+Annoimmatricolazione+"&Prezzo="+Prezzo+"&NumPosti="+NumPosti+"&Lunghezza="+Lunghezza+"&Larghezza="+Larghezza+"&Peso="+Peso,
              url:'php/veicolo/mod.php',
              success:function(data) {
                  //window.location.href = data;
                  alert('Modifica Effettuata!');
                  window.location.href = "../banca.php";

              }
          });
    }

    function eliminaMacchina(targa){
      $.ajax({
              type:'POST',
              data:"Targa="+targa,
              url:'php/veicolo/del.php',
              success:function(data) {
                  alert(data);
                  window.location.href = window.location.href;
              }
          });
    }

    function verifica() {
            if (document.getElementById('verificaMarca').value != "" && document.getElementById('verificaModello').value != "" && document.getElementById('verificaVersione').value != "" && document.getElementById('verificaAnno').value != "" && document.getElementById('verificaPrezzo').value != "" && document.getElementById('verificaPeso').value != ""  && document.getElementById('verificaPrezzo').value != "" && document.getElementById('verificaPeso').value != ""  && document.getElementById('verificaLunghezza').value != "" && document.getElementById('verificaLarghezza').value != "" && document.getElementById('verificaPosti').value != "" ) {
				document.getElementById("btnInserisci").disabled = false; 
			}
            else{
                document.getElementById("btnInserisci").disabled = true; 
            }
        }     
        
        function inserisciVeicolo(){
            Marca = $("#verificaMarca").val();
            Modello = $("#verificaModello").val();
            Versione = $("#verificaVersione").val();
            Anno = $("#verificaAnno").val();
            Prezzo = $("#verificaPrezzo").val();
            Peso = $("#verificaPeso").val();
            Lunghezza = $("#verificaLunghezza").val();
            Larghezza = $("#verificaLarghezza").val();
            Posti = $("#verificaPosti").val();
            $.ajax({
                    type:'POST',
                    data:"marca="+Marca+"&modello="+Modello+"&versione="+Versione+"&anno="+Anno+"&prezzo="+Prezzo+"&peso="+Peso+"&lunghezza="+Lunghezza+"&larghezza="+Larghezza+"&posti="+Posti,
                    url:'php/veicolo/ins.php',
                    success:function(data) {
                        window.location.href = data;
                        alert("Veicolo aggiunto");
                        location.reload();
                    },
                    error:function(data){
                        alert("Errore, veicolo non aggiunto");
                    }
                });
        }
    </script>
</body>
</html>
