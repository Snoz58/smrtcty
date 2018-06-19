<?php
ini_set('display_errors', 1);

  const USERNAME="root";
  const PASSWORD="";
  const HOST="localhost";
  const DB="SmartVillage";

  function getConnection(){
      $username = USERNAME;
      $password = PASSWORD;
      $host = HOST;
      $db = DB;
      $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
      return $connection;
  }

  function getNodeInfos(){
    $bdd = getConnection();
    $infos = $bdd->query("select * from Node");
    return $infos;
  }
?>
