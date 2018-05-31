<?php
include "database.php";

header('Content-Type: application/json');

$testpdo = new database;
$truc = $testpdo->getArray("select * from Node");

$str = '{
  "type": "FeatureCollection",
  "features": [
';
foreach ($truc as $value) {

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
