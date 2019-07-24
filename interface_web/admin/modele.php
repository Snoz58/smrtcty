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
      $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
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
  /*                         Accueil                        */
  /*--------------------------------------------------------*/

  // Récupération de la table Ville
  function getInfosAccueil(){
    $bdd = getConnection();
    $accueil = $bdd->query("select * from Accueil");
    return $accueil->fetch();
  }

  // Initialisation de la table Ville avec le contenu
  function setInfosAccueil($titre, $contenu){
    $bdd = getConnection();

    if ($bdd->exec('INSERT INTO Accueil SET Titre = "'.$titre.'",
                                            Contenu = "'.$contenu.'";')){
      return true;

    }
    else
      return false;
  }

  // Mise à jour de la table Ville
  function updateInfosAccueil($titre, $contenu){
    $bdd = getConnection();

    if ($bdd->exec('UPDATE Accueil SET Titre = "'.$titre.'",
                                       Contenu = "'.$contenu.'";')){
      return true;

    }
    else
      return false;
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
  function setInfosVillage($nom, $rue, $cp, $mail, $telephone, $lat, $long){
    $bdd = getConnection();

    if ($bdd->exec('INSERT INTO Ville SET Nom = "'.$nom.'",
                                          Adresse = "'.$rue.'",
                                          Code_postal = "'.$cp.'",
                                          Mail = "'.$mail.'",
                                          Numero = "'.$telephone.'",
                                          Latitude = "'.$lat.'",
                                          Longitude = "'.$long.'";')){
      return true;

    }
    else
      return false;
  }

  // Mise à jour de la table Ville
  function updateInfosVillage($nom, $rue, $cp, $mail, $telephone, $lat, $long){
    $bdd = getConnection();
    if ($bdd->exec('UPDATE Ville SET Nom = "'.$nom.'",
                                     Adresse = "'.$rue.'",
                                     Code_postal = "'.$cp.'",
                                     Mail = "'.$mail.'",
                                     Numero = "'.$telephone.'",
                                     Latitude = "'.$lat.'",
                                     Longitude = "'.$long.'";')){
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

  // Initialisation de la table Proprietaire avec le contenu
  function setInfosProprietaire($nom, $prenom, $statut, $adresse, $cp, $ville){
    $bdd = getConnection();
    if ($bdd->exec('INSERT INTO Proprietaire SET Nom = "'.$nom.'",
                                                 Prenom = "'.$prenom.'",
                                                 Statut = "'.$statut.'",
                                                 Adresse = "'.$adresse.'",
                                                 `Code postal` = "'.$cp.'",
                                                 Ville = "'.$ville.'";')){
      return true;

    }
    else
      return false;
  }

  // Mise à jour de la table Proprietaire
  function updateInfosProprietaire($nom, $prenom, $statut, $adresse, $cp, $ville){
    $bdd = getConnection();

    if ($bdd->exec('UPDATE Proprietaire SET Nom = "'.$nom.'",
                                                 Prenom = "'.$prenom.'",
                                                 Statut = "'.$statut.'",
                                                 Adresse = "'.$adresse.'",
                                                 `Code postal` = "'.$cp.'",
                                                 Ville = "'.$ville.'";')){
      return true;

    }
    else
      return false;
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
  
    // Initialisation de la table Hebergeur avec le contenu
    function setInfosHebergeur($nom, $adresse, $cp, $ville){
      $bdd = getConnection();
      if ($bdd->exec('INSERT INTO Hebergeur SET `Nom` = "'.$nom.'",
                                                `Adresse` = "'.$adresse.'",
                                                `Code postal` = "'.$cp.'",
                                                `Ville` = "'.$ville.'";')){
        return true;
  
      }
      else
        return false;
    }
  
    // Mise à jour de la table Hebergeur
    function updateInfosHebergeur($nom, $adresse, $cp, $ville){
      $bdd = getConnection();

      if ($bdd->exec('UPDATE Hebergeur SET `Nom` = "'.$nom.'",
                                           `Adresse` = "'.$adresse.'",
                                           `Code postal` = "'.$cp.'",
                                           `Ville` = "'.$ville.'";')){
        return true;
  
      }
      else
        return false;
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
  
    // Initialisation de la table Responsable avec le contenu
    function setInfosResponsable($nom, $prenom, $contact){
      $bdd = getConnection();
      if ($bdd->exec('INSERT INTO Responsable SET `Nom` = "'.$nom.'",
                                                  `Prenom` = "'.$prenom.'",
                                                  `Contact` = "'.$contact.'";')){
        return true;
  
      }
      else
        return false;
    }
  
    // Mise à jour de la table Responsable
    function updateInfosResponsable($nom, $prenom, $contact){
      $bdd = getConnection();
      if ($bdd->exec('UPDATE Responsable SET `Nom` = "'.$nom.'",
                                             `Prenom` = "'.$prenom.'",
                                             `Contact` = "'.$contact.'";')){
        return true;
  
      }
      else
        return false;
    }
            /*--------------------------------------------------------*/
            /*              Webmaster du site                      */
            /*--------------------------------------------------------*/


    // Récupération de la table Webmaster
    function getInfosWebmaster(){
      $bdd = getConnection();
      $Webmaster = $bdd->query("select * from Webmaster");
      return $Webmaster->fetch();
    }
  
    // Initialisation de la table Webmaster avec le contenu
    function setInfosWebmaster($nom, $prenom, $contact){
      $bdd = getConnection();
      if ($bdd->exec('INSERT INTO Webmaster SET `Nom` = "'.$nom.'",
                                                `Prenom` = "'.$prenom.'",
                                                `Contact` = "'.$contact.'";')){
        return true;
  
      }
      else
        return false;
    }
  
    // Mise à jour de la table Webmaster
    function updateInfosWebmaster($nom, $prenom, $contact){
      $bdd = getConnection();
      if ($bdd->exec('UPDATE Webmaster SET `Nom` = "'.$nom.'",
                                            `Prenom` = "'.$prenom.'",
                                            `Contact` = "'.$contact.'";')){
        return true;
  
      }
      else
        return false;
    }

            /*--------------------------------------------------------*/
            /*                 Créateur du site                       */
            /*--------------------------------------------------------*/


    // Récupération de la table Createur
    function getInfosCreateur(){
      $bdd = getConnection();
      $Createur = $bdd->query("select * from Createur");
      return $Createur->fetch();
    }
  
    // Initialisation de la table Createur avec le contenu
    function setInfosCreateur($nom, $URL){
      $bdd = getConnection();
      if ($bdd->exec('INSERT INTO Createur SET `Nom` = "'.$nom.'",
                                               `URL` = "'.$URL.'";')){
        return true;
  
      }
      else
        return false;
    }
  
    // Mise à jour de la table Createur
    function updateInfosCreateur($nom, $URL){
      $bdd = getConnection();
      if ($bdd->exec('UPDATE Createur SET `Nom` = "'.$nom.'",
                                          `URL` = "'.$URL.'";')){
        return true;
  
      }
      else
        return false;
    }

?>
