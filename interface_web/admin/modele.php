<?php
ini_set('display_errors', 1);

/*--------------------------------------------------------*/
/*                    Common  database                    */
/*--------------------------------------------------------*/

  require "bddconnexion.php";

  // Connexion à la base de donnée
  function getConnection(){
      $username = USERNAME;
      $password = PASSWORD;
      $host = HOST;
      $db = DB;
      $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
      return $connection;
  }

  // Connexion au SGBD sans base de donnée (Uniquement utilisé par createDatabase())
  function getConnexionNoDb(){
    $username = USERNAME;
    $password = PASSWORD;
    $host = HOST;
    $connection = new PDO("mysql:host=$host", $username, $password);
    return $connection;
  }

  // Création de la base de donnée seule sans les tables
  function createDatabase(){
    $bdd = getConnexionNoDb();
    $bdd->exec('DROP DATABASE IF EXISTS `SmartVillageTEST`;');
    if($bdd->exec('CREATE DATABASE `SmartVillageTEST`;')){
      return true;
    }
    else {
      return false;
    }
  }

  // création des tables de la base créée avec getConnexionNoDb() en utilisant un fichier .sql
  function initdatabase() {
    $bdd = getConnection();
    $filename = "./base.sql"; //Fichier source des requêtes de création des tables
    $lastTable = "Ville"; // Dernière table créée, pour vérification du bon déroulement

    if (!file_exists($filename)) {
      return false;
    }

    $total = file_get_contents($filename); // recup du contenu du fichier sql dans $total

    $totalTab = explode (";", $total); // séparation de chaque requête

    foreach ($totalTab as $req) {
      if (strlen($req) > 1){
        $req = $req.';'; // rajout des ";" supprimés par le "explode"
        $bdd->exec($req);
      }
    }

    // Vérification de la création de la dernière table
    if ($bdd->query("SELECT * FROM ".$lastTable)){
      return true;
    }
    else {
      return false;
    }
  }

  /*--------------------------------------------------------*/
  /*                         Village                        */
  /*--------------------------------------------------------*/

  // Récupération de la table Ville
  function getInfosVillage(){
    $bdd = getConnection();
    $village = $bdd->query("select * from Ville");
    return $village->fetch();
  }

  // Initialisation de la table Ville avec le contenu
  function setInfosVillage($nom, $rue, $cp, $mail, $telephone){
    $bdd = getConnection();

    if ($bdd->exec('INSERT INTO Ville SET Nom = "'.$nom.'",
                                          Adresse = "'.$rue.'",
                                          Code_postal = "'.$cp.'",
                                          Mail = "'.$mail.'",
                                          Numero = "'.$telephone.'";')){
      return true;

    }
    else
      return false;
  }


  /*--------------------------------------------------------*/
  /*                          Node                          */
  /*--------------------------------------------------------*/

  // Récupération de la table Node
  function getNodeList(){
    $bdd = getConnection();
    $nodeList = $bdd->query("select * from Node");
    return $nodeList;
  }

  // Récupération d'un élément de la table Node
  function getInfosNode($id){
    $bdd = getConnection();
    $node = $bdd->query("select * from Node WHERE Id = ".$id);
    return $node->fetch();
  }

  // Créer un nouveau Node
  function setInfosNode($nom, $long, $lat){
    $bdd = getConnection();

    echo 'INSERT INTO Node (`Nom`, `Long`, `Lat`)
          VALUES ("'.$nom.'", "'.$long.'", "'.$lat.'");';

    if ($bdd->exec('INSERT INTO Node (`Nom`, `Long`, `Lat`)
                    VALUES ("'.$nom.'", "'.$long.'", "'.$lat.'");')){
      return true;
    }
    else
      return false;
  }

   // Mettre à jour un Node existant
  function updateInfosNode($id, $nom, $long, $lat){
    $bdd = getConnection();

    if ($bdd->exec('UPDATE Node SET `Nom` = "'.$nom.'",
                                    `Long` = "'.$long.'",
                                    `Lat` = "'.$lat.'"
                                WHERE Id = '.$id.';')){
      return true;

    }
    else
      return false;
  }

  // Supression d'un Node
  function deleteNode($id){
    $bdd = getConnection();
    if ($bdd->exec("DELETE FROM Node WHERE Id = ".$id))
      return true;
    else
      return false;
  }

  /*--------------------------------------------------------*/
  /*                         Sensor                         */
  /*--------------------------------------------------------*/

  // Récupération de tous les capteurs d'un Node
  function getSensorList($node){
    $bdd = getConnection();
    $sensorList = $bdd->query('SELECT * FROM Sensor
                               INNER JOIN Units ON Sensor.fk_IdUnits = Units.Id
                               WHERE fk_IdNode = '.$node);
    return $sensorList;
  }

  // Récupération d'un élément de la table Sensor
  function getInfosSensor($id){
    $bdd = getConnection();
    $node = $bdd->query("select * from Sensor WHERE Id = ".$id);
    return $node->fetch();
  }

  // Créer un nouveau capteur
  function setInfosSensor($nom, $node, $unit){
    $bdd = getConnection();
    if ($bdd->exec('INSERT INTO Sensor (`Nom`, `fk_IdNode`, `fk_IdUnits`)
                    VALUES ("'.$nom.'", "'.$node.'", "'.$unit.'");')){
      return true;
    }
    else
      return false;
  }

  // Mettre à jour un capteur
  function updateInfosSensor($id, $nom, $node, $unit){
    $bdd = getConnection();
    if ($bdd->exec('UPDATE Sensor SET Nom = "'.$nom.'",
                                      fk_IdNode =  "'.$node.'",
                                      fk_IdUnits = "'.$unit.'"
                    Where Id = "'.$id.'";')){
      return true;
    }
    else
      return false;
  }

  // Supression d'un capteur
  function deleteSensor($id){
    $bdd = getConnection();
    if ($bdd->exec("DELETE FROM Sensor WHERE Id = ".$id))
      return true;
    else
      return false;
  }

  /*--------------------------------------------------------*/
  /*                          Unit                          */
  /*--------------------------------------------------------*/

  // Récupération de la table Units
  function getUnitList(){
    $bdd = getConnection();
    $unitList = $bdd->query("select * from Units");
    return $unitList;
  }

  // Récupération d'un élément de la table unite
  function getInfosUnite($id){
    $bdd = getConnection();
    $node = $bdd->query("select * from Units WHERE Id = ".$id);
    return $node->fetch();
  }

  // Créer une nouvelle unite
  function setInfosUnite($label, $unite, $symbol){
    $bdd = getConnection();
    if ($bdd->exec('INSERT INTO Units (`label`, `Unite`, `Symbol`)
                    VALUES ("'.$label.'", "'.$unite.'", "'.$symbol.'");')){
      return true;
    }
    else
      return false;
  }

  // Mettre à jour une unite
  function updateInfosUnite($id, $label, $unite, $symbol){
    $bdd = getConnection();

    if ($bdd->exec('UPDATE Units SET Label = "'.$label.'",
                                      Unite =  "'.$unite.'",
                                      Symbol = "'.$symbol.'"
                    WHERE Id = "'.$id.'";')){
      return true;
    }
    else
      return false;
  }

  // Supression d'une unite
  function deleteUnite($id){
    $bdd = getConnection();
    if ($bdd->exec("DELETE FROM Units WHERE Id = ".$id))
      return true;
    else
      return false;
  }

?>
