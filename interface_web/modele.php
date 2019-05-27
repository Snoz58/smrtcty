<?php
ini_set('display_errors', 1);

/*--------------------------------------------------------*/
/*                    Common  database                    */
/*--------------------------------------------------------*/

  const USERNAME="root";
  const PASSWORD="root";
  const HOST="localhost";
  const DB="SmartVillagetest";

  function getConnection(){
      $username = USERNAME;
      $password = PASSWORD;
      $host = HOST;
      $db = DB;
      $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
      return $connection;
  }
  /*--------------------------------------------------------*/
  /*                         Accueil                        */
  /*--------------------------------------------------------*/

  function getAccueil(){
    $bdd = getConnection();
    $accueil = $bdd->query("select * from Accueil");
    return $accueil->fetch();

  }

  /*--------------------------------------------------------*/
  /*                         Village                        */
  /*--------------------------------------------------------*/

  function getInfosVillage(){
    $bdd = getConnection();
    $village = $bdd->query("select * from Ville");
    return $village->fetch();
  }

  function getCoordonee(){
    $bdd = getConnection();
    $CoordVillage = $bdd->query("SELECT latitude, longitude FROM Ville");
    return $CoordVillage->fetch();
  }
  /*--------------------------------------------------------*/
  /*                          Node                          */
  /*--------------------------------------------------------*/

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

  function getThatNodeName($id){
    $bdd = getConnection();
    $sensor = $bdd->query("select * from Node where Id = ".$id);
    return $sensor->fetch()[1];
  }

  /*--------------------------------------------------------*/
  /*                         Sensor                         */
  /*--------------------------------------------------------*/

  function getFirstSensor($node){
    $bdd = getConnection();
    $sensor = $bdd->query("select min(id) from Sensor where fk_IdNode = ".$node);
    return $sensor->fetch()[0];
  }

  function getAllSensorList(){
    $bdd = getConnection();
    $allSensorList = $bdd->query("SELECT Sensor.Id, Sensor.Nom, Node.Nom as Node, Units.Unite, Units.Label, Units.Symbol
                                  FROM Sensor
                                  INNER JOIN Node ON Node.Id = Sensor.fk_IdNode
                                  INNER JOIN Units ON Units.Id = Sensor.fk_IdUnits");
    return $allSensorList;
  }

  function getSensorList($node){
    $bdd = getConnection();
    $sensorList = $bdd->query("select * from Sensor where fk_IdNode = ".$node);
    return $sensorList;
  }

  function getSensorType($sensor){
    $bdd = getConnection();
    $sensorType = $bdd->query("select Nom from Sensor where Id = ".$sensor);
    return $sensorType->fetch()[0];
  }


  function getSensorValues1($sensor, $debut="2000-01-01", $fin="now()"){
    $bdd = getConnection();

    // Ajout de l'heure pour la requête
    $debut = "'".$debut." 00:00:00' ";
    if ($fin != "now()"){
      $fin = "'".$fin." 00:00:00' ";
    }

    $values = $bdd->query("SELECT Date, Value
                           FROM Data
                           INNER JOIN Sensor ON fk_IdSensor = Sensor.Id
                           WHERE fk_IdSensor = ".$sensor." AND
                                 Date > ".$debut." AND
                                 Date < ".$fin);
    return $values;
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

  function getLastTenSensorValues($node, $sensor){
    $bdd = getConnection();

    $values = $bdd->query("SELECT Date, Value
                           FROM (SELECT Date, Value
                                 FROM Data
                                 INNER JOIN Sensor ON fk_IdSensor = Sensor.Id
                                 WHERE Sensor.fk_IdNode = ".$node." AND fk_IdSensor = ".$sensor."
                                 ORDER BY Date DESC
                                 LIMIT 10) as t
                           ORDER BY Date");
    // Double requête pour remettre les données dans l'ordre chronologique
    // (précédemment inversées pour ne garder que les 10 derniers)
    return $values;
  }



  /*--------------------------------------------------------*/
  /*                          Units                         */
  /*--------------------------------------------------------*/

  function getUniteFromSensor($idSensor){
    $bdd = getConnection();
    $unit = $bdd->query("SELECT Unite FROM Units WHERE Id = ( SELECT fk_IdUnits FROM Sensor Where Id = $idSensor)");
    return $unit->fetch()[0];
  }

  function getSymbolFromSensor($idSensor){
    $bdd = getConnection();
    $unit = $bdd->query("SELECT Symbol FROM Units WHERE Id = ( SELECT fk_IdUnits FROM Sensor Where Id = $idSensor)");
    return $unit->fetch()[0];
  }

  /*--------------------------------------------------------*/
  /*                         Autres                         */
  /*--------------------------------------------------------*/

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

    // return date("d/m/Y", strtotime($date));
    return date("d/m", strtotime($date)); // Même date sans l'année
  }

  function dumpVar($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
  }

  function CreateDataString($idCapteur, $dateDebut, $dateFin, &$dataCapteur){
    $valuesCapteur = getSensorValues1($idCapteur, $dateDebut, $dateFin);
    foreach ($valuesCapteur as $data) {
      $dataCapteur .= $data["Value"].",";
    }
    $dataCapteur = substr($dataCapteur, 0, -1);
  }
?>
