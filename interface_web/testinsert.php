<?php

$username = "xx";
$password = "xx";
$host = "xx.mysql.db";
$db = "xx";
$connection = new PDO("mysql:dbname=$db;host=$host", $username, $password,
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));

$insert = "INSERT INTO test (date) VALUES(NOW())";

$connection->query($insert);

?>
