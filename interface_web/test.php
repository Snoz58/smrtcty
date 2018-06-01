<?php

// $connection = new PDO("mysql:dbname=SmartVillage;host=localhost", "root", "");
// $connection->execute($args);


print("INSERT INTO Data (`Date`, `Value`, `fk_IdNode`, `fk_IdUnits`) VALUES<br />");

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
  print('("2018-04-'.($i+1).' 09:00:00", '.$val.', 1, 4),<br />');
  // print("insert into data values tes".$val."<br />");
}
?>
