<?php

require("modele.php");

if (isset($_GET["node"]) &&
    isset($_GET["sensor"])){

      $node = $_GET["node"];
      $sensor = $_GET["sensor"];

      if (isset($_GET["debut"])){ $debut = $_GET["debut"]; }
      else { $debut = "2000-01-01"; }

      if (isset($_GET["fin"])){ $debut = $_GET["fin"]; }
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
        echo "ERREUR autre";
      }

    }
else {
  echo "ERREUR";
}


// header('Content-Type: text/csv');
// header('Content-Disposition: filename="donnees.csv"');


?>
