<?php

echo ("INSERT INTO Data (Date, Value, fk_IdNode, fk_IdUnits, fk_IdSensor)
VALUES<br />");

$idNode = 2;
$idUnit = 1;
$idSensor = 4;

$debut = 10; // Première valeur
$pasMax = 2; // Différence max entre n et n+1 (en ajout)
$pasMin = -1*$pasMax; // Différence max entre n et n+1 (en diminution) -> Inverse de la valueur de $pasMax
$max = 19; // Valeur maximale
$min = 6; // Valeur minimale

$moisDebut = 1; // premier mois de la série
$moisFin = 12; // dernier mois de la série
$bissextile = true;

$texte = "";

for ($m = $moisDebut; $m <= $moisFin; $m++){ // $m = mois
	for ($j = 1; $j <= 30; $j ++){ // $j = jour
		if ($bissextile && $j > 28 && $m==2){ break; }

		for ($h = 6; $h <= 22; $h +=2){ // $h = heure

			// Correctif : ajout d'un 0 devant les chiffres (01, 02, 03, [...], 09)
			$mstring = ($m < 10) ? '0'.$m : (string)$m;
			$hstring = ($h < 10) ? '0'.$h : (string)$h;

			$texte.= '("2019-'.$mstring.'-'.$j.' '.$hstring.':00:00", '.$debut.', '.$idNode.', '.$idUnit.', '.$idSensor.'),'."<br />";

		modifchiffre($debut);
		}
	}
}

$texte = substr($texte, 0, -7);
echo $texte;

function modifChiffre(&$chiffre){
	// Récupération des variables gloales dans la fonction
	global $min;
	global $max;
	global $pasMin;
	global $pasMax;

	$difference =  rand ($pasMin, $pasMax);

	$chiffre += $difference;

	// Vérification des limites
	$chiffre = ($chiffre > $max) ? $max : $chiffre;
	$chiffre = ($chiffre < $min) ? $min : $chiffre;
}

?>
