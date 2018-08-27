<?php
ini_set('display_errors', 1);

  const USERNAME="root";
  const PASSWORD="root";
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

  function getInfosVillage(){
    $bdd = getConnection();
    $village = $bdd->query("select * from Ville");
    return $village->fetch();
  }

  function getNodeList(){
    $bdd = getConnection();
    $nodeList = $bdd->query("select * from Node");
    return $nodeList;
  }

  function getNodeInfos(){
    $bdd = getConnection();
    $infos = $bdd->query("select * from Node");
    return $infos;
  }

  function getFirstSensor($node){
    $bdd = getConnection();
    $sensor = $bdd->query("select min(id) from Sensor where fk_IdNode = ".$node);
    return $sensor->fetch()[0];
  }

  function getSensorList($node){
    $bdd = getConnection();
    $sensorList = $bdd->query("select * from Sensor where fk_IdNode = ".$node);
    return $sensorList;
  }

  function getSensorValues($node, $sensor, $debut="2000-01-01", $fin="now()"){
    $bdd = getConnection();

    $debut = "'".$debut." 00:00:00' ";

    if ($fin != "now()"){
      $fin = "'".$fin." 00:00:00' ";
    }

    $values = $bdd->query("SELECT Date, Value
                           FROM Data
                           INNER JOIN Sensor ON fk_IdSensor = Sensor.Id
                           WHERE Sensor.fk_IdNode = ".$node." AND
                                 fk_IdSensor = ".$sensor." AND
                                 Date > ".$debut." AND
                                 Date < ".$fin);
    return $values;
  }

  function convertDate($date){

    $conversion = array(
      "Mon" => "Lun.",
      "Tue" => "Mar.",
      "Wed" => "Mer.",
      "Thu" => "Jeu.",
      "Fri" => "Ven.",
      "Sat" => "Sam.",
      "Sun" => "Dim."
    );

    return date("d/m/Y", strtotime($date));
  }
?>
