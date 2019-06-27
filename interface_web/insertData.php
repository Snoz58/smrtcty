<?php
require "modele.php";

$connexion = getConnection();


$value = $_GET["value"];
$node = $_GET["node"];
$units = $_GET["unit"];
$sensors = $_GET["sensor"];

$insert = "INSERT INTO Data (Date, Value, fk_IdNode, fk_IdUnits, fk_IdSensor)
VALUES (NOW(), ".$value.", ".$node.", ".$unit.", ".$sensors.")";

//$connection->query($insert);

echo $insert;
?>
