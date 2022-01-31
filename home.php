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
    <title>Home</title>
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
                        <a class="nav-link" href="registrazione.php"><i class="fas fa-user-edit"></i>sign up</a>
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
                                  Non sai cosa scegliere tra noleggio o leasing?
                                  <br />Scegli Avoc!
                                </p>
                                <a href="calcola-finanziamento.php">
                                    <button class="btn peach-gradient z-depth">calcola il tuo finanziamento</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WhiteCard -->
    <div class="jumbotron text-center noMargin">
        <p class="deep-orange-text my-4 font-weight-bold">A cosa serve Avoc?</p>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 pb-2">
                <p class="card-text ">
                  Avoc è una piattaforma digitale specializzata nel noleggio a lungo termine e nel leasing delle auto e si pone come obiettivo una semplificazione della scelta dei clienti rispetto al noleggio a lungo termine o al leasing. Questo tramite un sistema chiaro ed efficiente permette al cliente di risparmiare soldi e tempo in base alle proprie esigenze.
                </p>
            </div>
        </div>
        <hr class="my-4">
        <div class="pt-2">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a href="calcola-finanziamento.php">
                            <div class="card purple-gradient specialBtn z-depth-5">
                                <div class="card-body">
                                    <p><i class="fas fa-hand-holding-usd fa-3x colorWhite"></i></p>
                                    <strong class="colorWhite">richiedi finanziamento</strong>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="dettagli.php">
                            <div class="card aqua-gradient specialBtn z-depth-5">
                                <div class="card-body">
                                    <p><i class="fas fa-info-circle fa-3x colorWhite"></i></p>
                                    <strong class="colorWhite">continua a leggere</strong>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
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
</body>
</html>
