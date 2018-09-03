<?php

  // Si le formulaire à été envoyé -> insertion dasn la base
  if (isset($_POST["envoyer"])){

    //test des champs du formulaire
    if (!empty($_POST["Nom"]) &&
        !empty($_POST["Rue"]) &&
        !empty($_POST["Cp"]) &&
        !empty($_POST["Mail"]) &&
        !empty($_POST["Telephone"])){

      if (setInfosVillage($_POST["Nom"], $_POST["Rue"], $_POST["Cp"], $_POST["Mail"], $_POST["Telephone"])){
        echo alert_success("","Les informations ont bien été mises à jour");
        header('Location: index.php?step=3');
      }
      else
        echo alert_error("ERREUR !","La base de donnée n'a pas été mise à jour");

    }
    else
      echo alert_error("ERREUR !","Le formulaire n'est pas complet");

  }

  // Préremplissage du formulaire avec les informations de la base de donnée
  $infosVillage = getInfosVillage();

  $nom = $infosVillage["Nom"];
  $rue = $infosVillage["Adresse"];
  $cp = $infosVillage["Code_postal"];
  $mail = $infosVillage["Mail"];
  $telephone = $infosVillage["Numero"];

 ?>
    <h1>2. Configuration du village : </h1>

    <form method="post" action="">
      <div class="form-group">
        <label for="Nom">Nom de la ville</label>
        <input type="text" class="form-control" id="Nom" name="Nom" value="<?= $nom ?>">
      </div>

      <div class="form-group">
        <label for="Adresse">Rue</label>
        <input type="text" class="form-control" id="Rue" name="Rue" value="<?= $rue ?>">
      </div>

      <div class="form-group">
        <label for="Nom">Code postal</label>
        <input type="text" class="form-control" id="Cp" name="Cp" value="<?= $cp ?>">
      </div>

      <div class="form-group">
        <label for="Nom">E-mail</label>
        <input type="text" class="form-control" id="Mail" name="Mail" value="<?= $mail ?>">
      </div>

      <div class="form-group">
        <label for="Nom">Téléphone</label>
        <input type="text" class="form-control" id="Telephone" name="Telephone" value="<?= $telephone ?>">
      </div>

      <button type="submit" class="btn btn-primary btn-lg float-right" name="envoyer">Next »</button>
    </form>
