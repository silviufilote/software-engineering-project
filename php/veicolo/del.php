<?php
session_start();
include_once("../utils.php");
include_once ("../../classi/Veicolo.php");

if(isset($_POST['Targa'])){
  Veicolo::eliminaVeicolo($_POST['Targa']);
}
echo "Auto eliminata correttamente!";
 ?>
