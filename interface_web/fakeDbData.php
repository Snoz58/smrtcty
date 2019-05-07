<?php

echo ("INSERT INTO Data (Date, Value, fk_IdNode, fk_IdUnits, fk_IdSensor)
VALUES<br />");

$debut = 50;
$pasMax = 10;

for ($m = 10; $m <= 12; $m++){ // $m = mois
	for ($j = 1; $j <= 30; $j ++){ // $j = jour
		for ($h = 6; $h <= 22; $h +=2){ // $h = heure
		echo('("2019-'.$m.'-'.$j.' '.$h.':00:00", '.$debut.', 1, 8, 2),'."<br />");
		modifchiffre($debut);
		}
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
// echo "difference = $difference | ";
}

?>