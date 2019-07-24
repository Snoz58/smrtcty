<?php

// Si l'étape n'est pas définie, on commence à la première
isset($_GET['step']) ? $step=$_GET['step'] : $step = 1;

include 'interface/header.php';
include 'interface/alerts.php';
include 'modele.php';


try {

    switch ($step){
      case 1 :
        include "base.php";
        break;
      case 2 :
        include "ville.php";
        break;
      case 3 :
        include "mentions.php";
        break;
      case 4 :
        include "node.php";
        break;
      case 5 :
      include "node.php";
      break;
    }

}
catch (Exception $e) {
    echo alert_error("ERREUR ! ", $e->getMessage());
}

include 'interface/footer.php';

?>
