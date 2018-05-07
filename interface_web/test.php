<?php

// $connection = new PDO("mysql:dbname=SmartVillage;host=localhost", "root", "");
// $connection->execute($args);
$val = rand(5, 35);
for ($i = 0; $i < 30; $i++){ 
  $rand = rand(0, 10);
  $plusoumoins = rand(0,1);
  if ($plusoumoins){
    if ($val + $rand<=40){
      $val = $val + $rand;
    }
    else {
      $val = $val - $rand;
    }
  }
  else {
    if ($val - $rand>=0){
      $val = $val - $rand;
    }
    else {
      $val = $val + $rand;
    }
  }
  print("tes".$val."<br />");
}
?>
