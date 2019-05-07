<?php
ini_set('display_errors', 1);
// Si le formulaire à été envoyé -> insertion dans la base

$dbName = "SmartVillageTEST";

if (isset($_POST["envoyer"])){

  //test des champs du formulaire
  if (!empty($_POST["user"]) &&
	  //!empty($_POST["password"]) &&
      !empty($_POST["host"])) {

    if($fichier = fopen('bddconnexion.php', 'w+')){

      $contenu = '<?php
      const USERNAME="'.$_POST["user"].'";
      const PASSWORD="'.$_POST["password"].'";
      const HOST="'.$_POST["host"].'";
      const DB="'.$dbName.'";
      ?>';
      fwrite($fichier, $contenu);
      fclose($fichier);

      if (createDatabase()){
        echo alert_success("SUCCES !", "La base a bien été créée");
        if (initdatabase()){
          echo alert_success("SUCCES !", "La base a bien été initialisée");
          //header('Location: index.php?step=2');
        }
        else {
          echo alert_error("ERREUR !", "Erreur lors de l'initialisation de la base");
        }
      }
      else{
        echo alert_error("ERREUR !", "Erreur lors de la création de la base");
      }
    }
    else {
      echo alert_error("ERREUR !", "Problème d'accès au fichier de configuration");
    }
  }
  else
    echo alert_error("ERREUR !","Le formulaire n'est pas complet");

}
?>

    <h1>1. Configuration de la base de donnée : </h1>

    <form method="post" action="">
      <div class="form-group">
        <label for="user">identifiant de base de donnée</label>
        <input type="text" class="form-control" id="user" name="user">
      </div>

      <div class="form-group">
        <label for="password">Mot de passe de base de donnée</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>

      <div class="form-group">
        <label for="host">Hôte de base de donnée</label>
        <input type="text" class="form-control" id="host" name="host">
      </div>

      <button type="submit" class="btn btn-primary btn-lg float-right" name="envoyer">Créer la base »</button>
    </form>
