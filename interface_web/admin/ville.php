<?php
  //Préremplissage du formulaire avec les informations de la base de donnée
  $infosVillage = getInfosVillage();

  $nom = $infosVillage["Nom"];
  $rue = $infosVillage["Adresse"];
  $cp = $infosVillage["Code_postal"];
  $mail = $infosVillage["Mail"];
  $telephone = $infosVillage["Numero"];
  $lat = $infosVillage["Latitude"];
  $long = $infosVillage["Longitude"];


  // Si le formulaire à été envoyé -> insertion dans la base
  if (isset($_POST["envoyer"])){
echo 'ENVOYE';
    //test des champs du formulaire
    if (!empty($_POST["Nom"]) &&
        !empty($_POST["Rue"]) &&
        !empty($_POST["Cp"]) &&
        !empty($_POST["Mail"]) &&
        !empty($_POST["Telephone"])){

      // Test si le village est déjà renseigné --> update
      if (!empty($nom)){
		  echo 'UPDATE';
        if (updateInfosVillage($_POST["Nom"], $_POST["Rue"], $_POST["Cp"], $_POST["Mail"], $_POST["Telephone"], $_POST["Latitude"], $_POST["Longitude"])){
          echo alert_success("","Les informations ont bien été mises à jour");
          header('Location: index.php?step=3');
        }
        else
          echo alert_error("ERREUR !","La base de donnée n'a pas été mise à jour");
      }
      
      // sinon nouveau --> insert
      else {
		echo 'SET';
        if (setInfosVillage($_POST["Nom"], $_POST["Rue"], $_POST["Cp"], $_POST["Mail"], $_POST["Telephone"], $_POST["Latitude"], $_POST["Longitude"])){
          echo alert_success("","Les informations ont bien été mises à jour");
          header('Location: index.php?step=3');
        }
        else
          echo alert_error("ERREUR !","La base de donnée n'a pas été mise à jour");
      }
    }
    else
      echo alert_error("ERREUR !","Le formulaire n'est pas complet");

  }


 ?>
    <h1>2. Configuration du village : </h1>

    <form method="post" action="">
      <div class="form-group">
        <label for="Nom">Nom de la ville</label>
        <input type="text" class="form-control" id="Nom" name="Nom" value="<?= $nom ?>" required>
      </div>

      <div class="form-group">
        <label for="Rue">Rue</label>
        <input type="text" class="form-control" id="Rue" name="Rue" value="<?= $rue ?>" required>
      </div>

      <div class="form-group">
        <label for="Cp">Code postal</label>
        <input type="text" class="form-control" id="Cp" name="Cp" value="<?= $cp ?>" required>
      </div>

      <div class="form-group">
        <label for="Mail">E-mail</label>
        <input type="text" class="form-control" id="Mail" name="Mail" value="<?= $mail ?>" required>
      </div>

      <div class="form-group">
        <label for="Telephone">Téléphone</label>
        <input type="text" class="form-control" id="Telephone" name="Telephone" value="<?= $telephone ?>" required>
      </div>

      <div class="form-group">
        <label for="Latitude">Latitude</label>
        <input type="text" class="form-control" id="Latitude" name="Latitude" value="<?= $lat ?>" required>
      </div>

      <div class="form-group">
        <label for="Longitude">Longitude</label>
        <input type="text" class="form-control" id="Longitude" name="Longitude" value="<?= $long ?>" required>
      </div>

      <button type="submit" class="btn btn-primary btn-lg float-right" name="envoyer">Next »</button>
    </form>
