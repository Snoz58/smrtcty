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
    else if ($_GET['action'] == 'compare') {
      compare();
    }
    else if ($_GET['action'] == 'accueil') {
      accueil();
    }
    else if ($_GET['action'] == 'TEST') {
      TEST();
    }
    else
      // Cas par défaut --> Accueil
      accueil();
  }
  else {
    accueil();  // action par défaut
  }
}
catch (Exception $e) {
    erreur($e->getMessage());
}

?>
