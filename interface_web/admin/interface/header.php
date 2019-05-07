<?php


// état du menu pour les différentes étapes
$state1 = "disabled";
$state2 = "disabled";
$state3 = "disabled";
$state4 = "disabled";


if (!isset($_GET['step'])){
  $_GET['step'] = 1;
}

switch ($_GET['step']){
  case 1 :
    $state1 = "active";
    $state2 = "disabled";
    $state3 = "disabled";
    $state3 = "disabled";
    break;
  case 2 :
    $state1 = "";
    $state2 = "active";
    $state3 = "disabled";
    $state3 = "disabled";
    break;
  case 3 :
    $state1 = "";
    $state2 = "";
    $state3 = "active";
    $state4 = "disabled";
    break;
  case 4 :
    $state1 = "";
    $state2 = "";
    $state3 = "";
    $state4 = "active";
    break;
   default :
    $state1 = "active";
    $state2 = "disabled";
    $state3 = "disabled";
    $state3 = "disabled"; 

}

?>


<!DOCTYPE html>
<html>
  <head>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../contenu/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../contenu/css/style.css">

    <!-- <script src="../contenu/js/jquery-3.3.1.slim.min.js"></script> -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../contenu/js/bootstrap.min.js"></script>

    <title>Admin</title>

  </head>

  <body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
  <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?= $state1 ?>" href="index.php?step=1">1. Base de données</a>
      </li>
      <span class="nav-link disabled">»</span>
      <li class="nav-item">
        <a class="nav-link <?= $state2 ?>" href="index.php?step=2">2. Ville</a>
      </li>
      <span class="nav-link disabled">»</span>
      <li class="nav-item">
        <a class="nav-link <?= $state3 ?>" href="index.php?step=3">3. Accueil</a>
      </li>
      <span class="nav-link disabled">»</span>
      <li class="nav-item">
        <a class="nav-link <?= $state4 ?>" href="index.php?step=4">4. Node & capteurs</a>
      </li>

    </ul>
  </div>
</nav>

    <main role="main" class="container">
