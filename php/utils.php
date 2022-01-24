<?php
session_start();
function checkSession($var){
  if($_SESSION['UserType']!=$var)
  {
    rilogga();
  }
  if(isset($_SESSION['UserId']))
  {
    if($_SESSION['UserId']<0)
    {
        rilogga();
    }
  }
  else {
    rilogga();
  }
}

function rilogga(){
  try{
    logout();
    header('Location: ../home.php');
    die();
  } catch (\Exception $e) {
    rilogga();
    die();
  }
}

function logout(){
  $_SESSION  = array();
  ob_start();
  ob_end_flush();
}
?>
