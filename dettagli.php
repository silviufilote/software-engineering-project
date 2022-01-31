<?php
session_start();
include_once("php/utils.php");
if(isset($_GET['Logout'])){
  logout();
}
$UserNavItems = '<li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalRegisterForm" id="log"><i class="fas fa-users"></i>Sign in</a></li>';
if(isset($_SESSION['UserId']))
{
  $UserNavItems = '<li class="nav-item"><a class="nav-link" href="home.php?Logout"  id="log">Logout</a></li>';
  if($_SESSION['UserType'] == 0){
    $UserNavItems .= '<li class="nav-item"><a class="nav-link" href="user.php">Profilo</a></li>';
  }else{
    $UserNavItems .= '<li class="nav-item"><a class="nav-link" href="banca.php">Profilo</a></li>';
  }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dettagli</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark peach-gradient scrolling-navbar nav">
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
                    <?php echo $UserNavItems; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="registrazione.php"><i class="fas fa-user-edit"></i>sing up</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Container -->
    <div class="container">
        <!-- Titolo -->
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
    </div>

    <!-- Sfondo mio -->
    <div class="parallax mTop">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-12 col-md-auto centered">
                    <button type="button" style="border-radius:50px; margin-top:50%" class="btn btn-outline-white waves-effect btn-lg animated bounce infinite">#WEWORKHAARDFORU<i class="fas fa-suitcase right fa-sm"></i></button>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>
    </div>

    <!-- Gradient -->
    <div class="jumbotron card card-image cardGradient">
        <div class="text-white text-center py-5 px-4">
            <div>
                <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Cosa è Avoc?</strong></h2>
                <p class="mx-5 mb-5">
                    L'avoc nasce con l'obiettivo di mettere a confronto leasing e noleggio di una determinata vettura, in modo tale da consentire ai clienti di scegliere il tipo di servizio più vantaggioso.
                </p>
            </div>
        </div>
    </div>

    <!-- Family -->
    <div class="card card-image cardFamily">
        <div class="text-white text-center rgba-stylish-strong py-5 px-4">
            <div class="py-5">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-2">
                    </div>
                    <div class="col-12 col-md-auto">
                        <img style="margin-bottom:" src="img/chart.png" alt="" />
                    </div>
                    <div class="col col-lg-2">
                    </div>
                </div>
                <p class="mb-4 pb-2 px-md-5 mx-md-5">Confronta subito le nostre offerte!</p>
                <a class="btn peach-gradient colorWhite" href="calcola-finanziamento.php" ><i class="fas fa-clone left colorWhite"></i>Calcola finanziamento</a>
            </div>
        </div>
    </div>

    <!-- Bianco -->
    <div class="jumbotron text-center noMargin">
        <!-- Title -->
        <h2 class="card-title h2">Differenze</h2>
        <!-- Subtitle -->
        <p class=" deep-orange-text my-4 font-weight-bold">Qual è la differenza tra leasing e noleggio a lungo termine?</p>

        <!-- Grid row -->
        <div class="row d-flex justify-content-center">

            <!-- Grid column -->
            <div class="col-xl-7 pb-2">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active Boxa" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                           aria-selected="true">Leasing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link Boxa" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                           aria-selected="false">Noleggio</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link Boxa" id="fonti-tab" data-toggle="tab" href="#fonti" role="tab" aria-controls="fonti"
                           aria-selected="false">Fonti</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p class="text-justify">
                          Il leasing auto per privati è un’operazione di finanziamento con la quale la società di leasing, proprietaria dell’auto, cede l’auto al privato dietro il pagamento di una rata fissa mensile. Allo scadere del contratto, il privato può decidere o di riscattare la proprietà della vettura, corrispondendo alla società di leasing il pagamento di una maxi rata finale, oppure scegliere di restituire l’auto alla società, sottoscrivere un nuovo contratto di leasing o prorogare il contratto esistente
                        </p>

                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="text-justify">
                          Il noleggio a lungo termine, invece, si caratterizza per essere un contratto di abbonamento che consente di utilizzare il veicolo senza diventarne proprietario. Così come nel leasing, anche nel noleggio a lungo termine è previsto il pagamento di una rata mensile, ma nel prezzo pattuito sono inclusi tutti i costi connessi all’uso della macchina, quali le spese inerenti l’assicurazione, quelli relativi alla manutenzione ordinaria e straordinaria, il bollo e l’assistenza stradale. Un’altra differenza tra leasing e noleggio a lungo termine si ha allo scadere del contratto di noleggio. In questo caso, infatti, il privato non avrà la possibilità di riscattare la vettura diventandone proprietario, ma potrà scegliere se restituire la stessa oppure sottoscrivere un nuovo contratto di noleggio a lungo termine optando per una nuova vettura.
                        </p>
                    </div>
					<div class="tab-pane fade" id="fonti" role="tabpanel" aria-labelledby="fonti-tab">
                        <p class="text-justify">
                         design - tan/taeg - leasing : <a href="https://www.fcabank.it/calcola-finanziamento">link</a></br>
						 noleggio: <a href="https://www.arval.it/noleggio-auto-lungo-termine">link</a></br>
						 costi fissi medi mensili: <a href="https://www.automobile.it/magazine/manutenzione-auto/costi-manutenzione-auto-9014">link1</a> - <a href="https://www.alvolante.it/news/quanto-costa-mantenere-auto-all-anno-2019-365534">link2</a></br>
						 costo al km: <a href="https://www.danea.it/blog/calcolo-rimborso-chilometrico/">link</a></br>
						 riscatto auto: <a href="https://www.automobile.it/magazine/risparmio/come-funziona-leasing-auto-1661">link</a>
                        </p>
                    </div>
                </div>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->
        <hr class="my-4">
        <div class="pt-2">
            <button type="button" class="btn btn-outline-deep-orange waves-effect" onclick="window.location.href='registrazione.php'">Registrati<i class="fas fa-users"></i></button>
        </div>
    </div>

    <!-- Login -->
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Log in</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" id="orangeForm-name" class="form-control validate">
                        <label data-error="wrong" data-success="right" for="orangeForm-name">Username</label>
                    </div>
                    <div class="md-form mb-4">
                        <i class="fas fa-lock prefix grey-text"></i>
                        <input type="password" id="orangeForm-pass" class="form-control validate">
                        <label data-error="wrong" data-success="right" for="orangeForm-pass">Password</label>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-deep-orange" onclick="checkLogin();">Log in</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small peach-gradient">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">
            © 2022 Copyright:
            <a class="colorWhite" href="home.php"> Avoc.altervista.org</a>
        </div>
        <!-- Copyright -->

    </footer>

    <script>

    function checkLogin(){
    Nick = $("#orangeForm-name").val();
    Pass = $("#orangeForm-pass").val();
    $.ajax({
            type:'POST',
            data:"nick="+Nick+"&pass="+Pass,
            url:'php/login.php',
            success:function(data) {
                window.location.href = data;
            }
        });
    }
    </script>
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
</body>
</html>
