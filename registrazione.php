<?php

include_once "classi/Connessione.php";
include_once "classi/Utente.php";
include_once "classi/UtenteRegistrato.php";
include_once "utils.php";

session_start();


if (isset($_POST["pass"]) && isset($_POST["pass2"])) {
    $_SESSION["UserId"] = "";
    if ($_POST["pass"] != $_POST["pass2"]) {
        echo '<script>alert("Le password inserite non corrispondono!");</script>';
    } else {
        //Registrazione del nuovo utente
        if (isset($_POST["pass"])) {

            //Utente cliente
            $utente = new Utente($_POST["cognome"], $_POST["nome"], $_POST["nascita"], $_POST["cf"], $_POST["email"]);
            $utente->inserisciUtente();

            //Recupero id appena registrato
            $NuovoID = Utente::recuperoIdUtente($_POST["cf"]);

            //Utente id login
            $Pass = $_POST["pass"];
            $CryptPass = hash("md5", $Pass);
            $Nick = 0;
            $Nick = $utente->generaNick($Nick);
            $utenteReg = new UtenteRegistrato($Nick, $CryptPass, $NuovoID);
            $utenteReg->inserisciUtenteRegistrato();
            echo '<script>alert("Registrato correttamente come ' . $Nick . '");window.location.href = "calcola-finanziamento.php";</script>';
            $_SESSION["UserId"] = $NuovoID;
            $_SESSION["UserType"] = 0;
            $stmt->close();
            mysqli_close($conn);
        }
    }
}
?>




 <html>
 <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta http-equiv="x-ua-compatible" content="ie=edge">
     <title>Registrazione</title>
     <!-- Bootstrap core CSS -->
     <link rel="stylesheet" href="css/bootstrap.css" />
     <!-- Material Design Bootstrap -->
     <link rel="stylesheet" href="css/mdb.css">
     <!-- Your custom styles -->
     <link rel="stylesheet" href="css/style.css">
     <style>
		body{
			overflow-x: hidden;
			overflow-y: hidden;
		}

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
        <nav class="navbar navbar-expand-lg navbar-dark peach-gradient scrolling-navbar nav">
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
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLoginForm" id="log"><i class="fas fa-users"></i>Sign in</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Card -->
    <div class="parallaxHome img-gradient">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-md-auto">
                    <!-- Visit Card -->
                    <div class="card homeCard z-depth-5 card-image ">
                        <div class="text-white text-center d-flex align-items-center py-5 px-4">
                            <div>
                                <p class="card-title title animated pulse">Avoc</p>
                                <p class="text-dark ">
                                    Per accedere a tutte le funzionalita della piattaforma
                                    dovrai completare l'operazione di registrazione!
                                </p>
                                <a href="#" data-toggle="modal" data-target="#modalRegisterForm">
                                    <button class="btn peach-gradient z-depth">Registrati</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" action="registrazione.php">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Registrazione</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" name="nome" class="form-control validate">
                        <label for="nome">Nome</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" name="cognome" class="form-control validate">
                        <label for="cognome">Cognome</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" name="cf" class="form-control validate">
                        <label for="cf">Codice Fiscale</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="date" name="nascita" class="form-control validate">
                        <label for="nascita">Data di nascita</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" name="email" class="form-control validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="password" name="pass" class="form-control validate">
                        <label for="pass">Password</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="password" name="pass2" class="form-control validate">
                        <label for="pass2">Ripeti password</label>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <input class="btn btn-deep-orange" type="submit" value="Registrati" />
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    <footer class="page-footer font-medium peach-gradient">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-4">
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
<!-- Ajax -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 </body>
 </html>
