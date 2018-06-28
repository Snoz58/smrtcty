<?php
require("modele.php");

header('Content-Type: application/json');

// $pdo = new database;
// $truc = $pdo->getArray("select * from Node");

$node = getNodeInfos();

$str = '{
  "type": "FeatureCollection",
  "features": [
';
foreach ($node as $value) {

  $str .= '  {
    "type": "Feature",
    "properties": {
      "Id": "'.$value["Id"].'",
      "Name": "'.$value["Nom"].'",
      "Lien": "<a href=\'#\'>Lien</a>"
    },
    "geometry": {
      "type": "Point",
      "coordinates": ['.$value["Long"].', '.$value["Lat"].']
    }
  },';

}

// On enlève la denière virgule
$str = substr($str, 0, -1);

$str .= '
]

}
';
echo $str;
?>
