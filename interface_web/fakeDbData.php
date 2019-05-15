<?php

echo ("INSERT INTO Data (Date, Value, fk_IdNode, fk_IdUnits, fk_IdSensor)
VALUES<br />");

$debut = 50;
$pasMax = 10;

$moisDebut = 1;
$moisFin = 12;


for ($m = $moisDebut; $m <= $moisFin; $m++){ // $m = mois
	for ($j = 1; $j <= 30; $j ++){ // $j = jour
		for ($h = 6; $h <= 22; $h +=2){ // $h = heure

			// Correctif : ajout d'un 0 devant les chiffres (01, 02, 03, [...], 09)
			$mstring = ($m < 10) ? '0'.$m : (string)$m;
			$hstring = ($h < 10) ? '0'.$h : (string)$h;

			echo('("2019-'.$mstring.'-'.$j.' '.$hstring.':00:00", '.$debut.', 1, 8, 2),'."<br />");

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
