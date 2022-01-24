<?php
session_start();
include_once("../utils.php");
include_once ("../../classi/Veicolo.php");

if(isset($_POST['Targa'])){
  Veicolo::modificaVeicolo($_POST['Marca'],$_POST['Modello'],$_POST['Versione'],$_POST['Annoimmatricolazione'],$_POST['Prezzo'],$_POST['Peso'],$_POST['Lunghezza'],$_POST['Larghezza'],$_POST['NumPosti'],$_POST['Targa']);
}
 ?>
