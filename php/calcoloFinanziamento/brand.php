<?php

session_start();
include_once("../utils.php");
include_once ("../../classi/Veicolo.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = Veicolo::getBrand();
    $response = array();
    
    while($row = $result->fetch_assoc()){
        $data = $row;
        array_push($response, $data);
    }

    $result = json_encode($response);
    echo $result;
}

?>