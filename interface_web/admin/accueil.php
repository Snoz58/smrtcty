<?php
  // Préremplissage du formulaire avec les informations de la base de donnée
  $infosAccueil = getInfosAccueil();

  $titre = $infosAccueil["Titre"];
  $contenu = $infosAccueil["Contenu"];

  // Si le formulaire à été envoyé -> insertion dans la base
  if (isset($_POST["envoyer"])){

    //test des champs du formulaire
    if (!empty($_POST["Titre"]) &&
        !empty($_POST["Contenu"])){

      // Test si l'accueil est déjà renseigné --> update
      if (!empty($titre)){
        if (updateInfosAccueil($_POST["Titre"], $_POST["Contenu"])){
          echo alert_success("","Les informations ont bien été mises à jour");
          header('Location: index.php?step=4');
        }
        else
          echo alert_error("ERREUR !","La base de donnée n'a pas été mise à jour");
      }

      // sinon nouveau --> insert
      else {
        if (setInfosAccueil($_POST["Titre"], $_POST["Contenu"])){
          echo alert_success("","Les informations ont bien été mises à jour");
          header('Location: index.php?step=4');
        }
        else
          echo alert_error("ERREUR !","La base de donnée n'a pas été mise à jour");
      }
    }
    else
      echo alert_error("ERREUR !","Le formulaire n'est pas complet");

  }

 ?>
    <h1>3. Configuration de l'accueil : </h1>

    <form method="post" action="">
      <div class="form-group">
        <label for="Titre">Titre de la page d'accueil</label>
        <input type="text" class="form-control" id="Titre" name="Titre" value="<?= $titre ?>">
      </div>

      <div class="form-group">
        <label for="Contenu">Contenu</label>
        <textarea type="text" class="form-control" id="Contenu" name="Contenu"><?= $contenu ?></textarea>
      </div>

      <button type="submit" class="btn btn-primary btn-lg float-right" name="envoyer">Next »</button>
    </form>
