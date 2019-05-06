<?php

echo ("INSERT INTO Data (Date, Value, fk_IdNode, fk_IdUnits, fk_IdSensor)
VALUES<br />");

$debut = 50;
$pasMax = 10;

for ($m = 1; $m <= 12; $m++){ // $m = mois
	for ($j = 1; $j <= 30; $j ++){ // $j = jour
		echo('("2019-'.$m.'-'.$j.' 09:00:00", '.$debut.', 1, 8, 2),'."<br />");
		modifchiffre($debut);
	}
}

function modifChiffre(&$chiffre){
$difference =  rand (-10, 10);

	// if (rand (0, 1)){
		$chiffre += $difference;
	// }
	// else {
	// 	$chiffre -= $difference;
	// }
echo "difference = $difference | ";
}

?>
