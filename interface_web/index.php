<?php

include('controleur.php');

try {
  if (isset($_GET['action'])) {

    if ($_GET['action'] == 'carte') {

      require 'vueCarte.php';
    }
    else
      throw new Exception("Action non valide");
  }
  else {
    accueil();  // action par défaut
  }
}
catch (Exception $e) {
    erreur($e->getMessage());
}

?>
