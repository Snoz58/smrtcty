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
    $village = $bdd->query("SELECT * FROM ville");
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

  /*--------------------------------------------------------*/
  /*                         Données                        */
  /*--------------------------------------------------------*/

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

  function getDataIdLastDays(){
    $bdd = getConnection();
    $idLastDays = $bdd->query("SELECT Sensor.Id, Nom, Unite
                               FROM Data
                               INNER JOIN Sensor on Data.fk_IdSensor = Sensor.Id
                               INNER JOIN Units on Sensor.fk_IdUnits = Units.Id
                               WHERE Date > CURRENT_DATE - INTERVAL 7 DAY
                               GROUP BY fk_IdSensor");
    return $idLastDays;
  }

  function getDataLastDays($id){
    $bdd = getConnection();
    $dataLastDays = $bdd->query("SELECT Date, Value
                               FROM Data
                               WHERE Date BETWEEN CURRENT_DATE - INTERVAL 7 DAY AND CURRENT_DATE AND
                               fk_IdSensor = ".$id."
                               ORDER BY Date");
    return $dataLastDays;
  }

  function getLastData($id){
    $bdd = getConnection();
    $lastData = $bdd->query("SELECT Value
                             FROM Data
                             WHERE fk_IdSensor = ".$id."
                             ORDER BY Date DESC
                             LIMIT 1");
    return $lastData->fetch()[0];
  }
<<<<<<< HEAD

  function getDataCompare($id1, $id2, $debut="2000-01-01", $fin="now()"){

    $bdd = getConnection();

    $datasToCompare = $bdd->query("Select Date, Value, fk_IdSensor as Sensor
                       From Data
                      Where fk_IdSensor = ".$id1." OR fk_IdSensor = ".$id2." AND Date Between ".$debut." and ".$fin."
                      Order by Date LIMIT 60");

    // Création du tableau des données de la forme :
    //$datacompare[Date du relevé][id Capteur] = Valeur
    $datacompare = array();



    foreach ($datasToCompare as $values){
      // modification de la date pour enlever les secondes et ou minutes si besoin (décalage / latence dans l'insertion des données dans la base)
      $values["Date"] = date_format(date_create($values["Date"]), 'Y-m-d H:i');
      // id de l'autre capteur que celui de la boucle courante
      $otherSensor = ($values["Sensor"] == $id1 ? $id2 : $id1);
      // Si pas de valeur de l'autre capteur à comparer : NaN (si il y a des données, la valeur sera écrasée plus tard)
      if (!isset($datacompare[$values["Date"]][$otherSensor])){
        $datacompare[$values["Date"]][$otherSensor] = "NaN";
        //echo $values["Date"].' - '.$otherSensor;
      }
      $datacompare[$values["Date"]][$values["Sensor"]] = $values["Value"];
    }

    return $datacompare;
  }

  function dataCompareToDate($dataCompare){
    // Récupération des dates (clés dans le tableau associatif)
    $dates = array_keys($dataCompare);
    // Début du tableau pour Charts.js
    $strdate = "[";
    foreach ($dates as $values){
      $strdate .= "'".$values."',";
    }
    // Supression de la dernière virgule
    $strdate = substr($strdate, 0, -1);
    // Fermeture du tableau
    $strdate .= "]";
    return $strdate;
  }

  function dataCompareToSensor($dataCompare, $idSensor){

    // Début du tableau pour Charts.js
    $strsensor = "[";
    foreach ($dataCompare as $values){
      // echo $idSensor.' -> '.$values[$idSensor]."<br>";
      $strsensor .= ($values[$idSensor] == "NaN" ? "," : $values[$idSensor].",");

    }
    // Supression de la dernière virgule
    $strsensor = substr($strsensor, 0, -1);
    // Fermeture du tableau
    $strsensor .= "]";
    return $strsensor;
  }

=======
>>>>>>> f3702a7c5a34a8ef70ca63e5fb4eb0b6a30eb53a
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
  /*                  Mentions Légales                      */
  /*--------------------------------------------------------*/
            /*--------------------------------------------------------*/
            /*              Proprietaire du site                      */
            /*--------------------------------------------------------*/

  // Récupération de la table Proprietaire
  function getInfosProprietaire(){
    $bdd = getConnection();
    $Proprietaire = $bdd->query("select * from Proprietaire");
    return $Proprietaire->fetch();
  }

            /*--------------------------------------------------------*/
            /*              Hébergeur du site                      */
            /*--------------------------------------------------------*/


    // Récupération de la table Hebergeur
    function getInfosHebergeur(){
      $bdd = getConnection();
      $Hebergeur = $bdd->query("select * from Hebergeur");
      return $Hebergeur->fetch();
    }
  
            /*--------------------------------------------------------*/
            /*            Responsable de Publication                  */
            /*--------------------------------------------------------*/


    // Récupération de la table Responsable
    function getInfosResponsable(){
      $bdd = getConnection();
      $Responsable = $bdd->query("select * from Responsable");
      return $Responsable->fetch();
    }

            /*--------------------------------------------------------*/
            /*            Responsable de Publication                  */
            /*--------------------------------------------------------*/


    // Récupération de la table Webmaster
    function getInfosWebmaster(){
      $bdd = getConnection();
      $Webmaster = $bdd->query("select * from Webmaster");
      return $Webmaster->fetch();
    }

            /*--------------------------------------------------------*/
            /*                  Createur du site                      */
            /*--------------------------------------------------------*/


    // Récupération de la table Createur
    function getInfosCreateur(){
      $bdd = getConnection();
      $Createur = $bdd->query("select * from Createur");
      return $Createur->fetch();
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
