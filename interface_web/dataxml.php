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
        $str = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $str .= '<root>'."\n";
        foreach ($values as $value) {
          $str .= " <row>\n";
          $str .= "  <date>".$value["Date"]."</date>\n";
          $str .= "  <valeur>".$value["Value"]."</valeur>\n";
          $str .= " </row>\n";
        }
        $str .= "</root>\n";
        echo $str;
      }
      else {
        echo "ERREUR autre";
      }

    }
else {
  echo "ERREUR";
}

header('Content-Type: text/xml');
header('Content-Disposition: filename="donnees.xml"');

?>
