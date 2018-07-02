<?php
require('controleur.php');

try {
  if (isset($_GET['action'])) {

    if ($_GET['action'] == 'carte') {
      carte();
    }
    else if ($_GET['action'] == 'data') {
      data();
    }
    else if ($_GET['action'] == 'accueil') {
      accueil();
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
