<?php

require("modele.php");

// Récupération des infos sur les données à récupérer
if (isset($_GET["node"]) &&
    isset($_GET["sensor"])){

      $node = $_GET["node"];
      $sensor = $_GET["sensor"];

      // Initialisation de dates par défaut si aucune n'est spécifiée
      if (!empty($_GET["debut"])){ $debut = $_GET["debut"]; }
      else { $debut = "2000-01-01"; }

      if (!empty($_GET["fin"])){ $fin = $_GET["fin"]; }
      else { $fin = date('Y-m-d'); }

      $values = getSensorValues($node, $sensor, $debut, $fin);

      if (!empty($values)){
        $str = 'date,valeur
        ';
        foreach ($values as $value) {

        $str .= $value["Date"].", ".$value["Value"]."\n";

        }

        echo $str;
      }
      else {
        echo "ERREUR aucune données trouvée";
      }

    }
else {
  echo "ERREUR Node et / ou Capteur non renseignés";
}

// Header et nom du fichier pour le téléchargement
header('Content-Type: text/csv');
header('Content-Disposition: filename="donnees.csv"');


?>
