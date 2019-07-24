  <?php

  //Preremplissage du formulaire avec les informations de la base de donnee
  $infosProprietaire = getInfosProprietaire();

  $nomP = $infosProprietaire["Nom"];
  $prenomP = $infosProprietaire["Prenom"];
  $statutP  = $infosProprietaire["Statut"];
  $adresseP = $infosProprietaire["Adresse"];
  $cpP = $infosProprietaire["Code postal"];
  $villeP = $infosProprietaire["Ville"];

  $infosCreateur = getInfosCreateur();

  $nomC = $infosCreateur["Nom"];
  $URLC = $infosCreateur["URL"];

  $infosResponsable = getInfosResponsable();

  $nomR = $infosResponsable["Nom"];
  $prenomR = $infosResponsable["Prenom"];
  $contactR = $infosResponsable["Contact"];

  $infosWebmaster = getInfosWebmaster();

    $nomW = $infosWebmaster["Nom"];
    $prenomW = $infosWebmaster["Prenom"];
    $contactW = $infosWebmaster["Contact"];

  $infosHebergeur = getInfosHebergeur();

  $nomH = $infosHebergeur["Nom"];
  $adresseH = $infosHebergeur["Adresse"];
  $cpH = $infosHebergeur["Code postal"];
  $villeH = $infosHebergeur["Ville"];

  // Si le formulaire à ete envoye -> insertion dans la base
  if (isset($_POST["envoyer"])){
echo 'ENVOYE';
    //test des champs du formulaire
    if (!empty($_POST["NomP"]) &&
        !empty($_POST["PrenomP"]) &&
        !empty($_POST["StatutP"]) &&
        !empty($_POST["AdresseP"]) &&
        !empty($_POST["Code_PostalP"]) &&
        !empty($_POST["VilleP"])){

      // Test si le Proprietaire est dejà renseigne --> update
      if (!empty($nomP)){
      echo 'UPDATEP';    
        if (updateInfosProprietaire($_POST["NomP"], $_POST["PrenomP"], $_POST["StatutP"], $_POST["AdresseP"], $_POST["Code_PostalP"], $_POST["VilleP"])){
          echo alert_success("","Les informations ont bien ete mises à jour");
          header('Location: index.php?step=3');
        }
        else
          echo alert_error("ERREUR !","La base de donnee n'a pas ete mise à joura");
      }
      
      // sinon nouveau --> insert
      else {
		echo 'SETP';
        if (setInfosProprietaire($_POST["NomP"], $_POST["PrenomP"], $_POST["StatutP"], $_POST["AdresseP"], $_POST["Code_PostalP"], $_POST["VilleP"])){
          echo alert_success("","Les informations ont bien ete mises à jourb");
          header('Location: index.php?step=3');
        }
        else
          echo alert_error("ERREUR !","La base de donnee n'a pas ete mise à jour");
      }
    }
    else
      echo alert_error("ERREUR !","Le formulaire n'est pas complet");



  // Test si le Hebergeur est dejà renseigne --> update
  if (!empty($nomH)){
    echo 'UPDATEH';
      if (updateInfosHebergeur($_POST["NomH"], $_POST["AdresseH"], $_POST["Code_PostalH"], $_POST["VilleH"])){
        echo alert_success("","Les informations ont bien ete mises à jour");
        header('Location: index.php?step=3');
      }
      else
        echo alert_error("ERREUR !","La base de donnee n'a pas ete mise à jour");
    }
    
    // sinon nouveau --> insert
    else {
  echo 'SETH';
      if (setInfosHebergeur($_POST["NomH"], $_POST["AdresseH"], $_POST["Code_PostalH"], $_POST["VilleH"])){
        echo alert_success("","Les informations ont bien ete mises à jour");
        header('Location: index.php?step=3');
      }
      else
 
        echo alert_error("ERREUR !","La base de donnee n'a pas ete mise à jour");
    }

     // Test si le Responsable est dejà renseigne --> update
  if (!empty($nomR)){
    echo 'UPDATER';
      if (updateInfosResponsable($_POST["NomR"], $_POST["PrenomR"], $_POST["ContactR"])){
        echo alert_success("","Les informations ont bien ete mises à jour");
        header('Location: index.php?step=3');
      }
      else
        echo alert_error("ERREUR !","La base de donnee n'a pas ete mise à jour");
    }
    
    // sinon nouveau --> insert
    else {
  echo 'SETR';
      if (setInfosResponsable($_POST["NomR"], $_POST["PrenomR"], $_POST["ContactR"])){
        echo alert_success("","Les informations ont bien ete mises à jour");
        header('Location: index.php?step=3');
      }
      else
 
        echo alert_error("ERREUR !","La base de donnee n'a pas ete mise à jour");
    }

     // Test si le Webmaster est dejà renseigne --> update
     if (!empty($nomW)){
      echo 'UPDATEW';
        if (updateInfosWebmaster($_POST["NomW"], $_POST["PrenomW"], $_POST["ContactW"])){
          echo alert_success("","Les informations ont bien ete mises à jour");
          header('Location: index.php?step=3');
        }
        else
          echo alert_error("ERREUR !","La base de donnee n'a pas ete mise à jour");
      }
      
      // sinon nouveau --> insert
      else {
    echo 'SETW';
        if (setInfosWebmaster($_POST["NomW"], $_POST["PrenomW"], $_POST["ContactW"])){
          echo alert_success("","Les informations ont bien ete mises à jour");
          header('Location: index.php?step=3');
        }
        else
   
          echo alert_error("ERREUR !","La base de donnee n'a pas ete mise à jour");
      }


     // Test si le Createur est dejà renseigne --> update
     if (!empty($nomC)){
      echo 'UPDATEC';
        if (updateInfosCreateur($_POST["NomC"], $_POST["URLC"])){
          echo alert_success("","Les informations ont bien ete mises à jour");
          header('Location: index.php?step=3');
        }
        else
          echo alert_error("ERREUR !","La base de donnee n'a pas ete mise à jour");
      }
      
      // sinon nouveau --> insert
      else {
    echo 'SETC';
        if (setInfosCreateur($_POST["NomC"], $_POST["URLC"])){
          echo alert_success("","Les informations ont bien ete mises à jour");
          header('Location: index.php?step=3');
        }
        else
   
          echo alert_error("ERREUR !","La base de donnee n'a pas ete mise à jour");
      }
}
  

 ?>
    <h1>2. Configuration des Mentions Légales : </h1>
    <h2>a. Configuration du Propriétaire : </h2>

    <form method="post" action="">
      <div class="form-group">
        <label for="NomP">Nom </label>
        <input type="text" class="form-control" id="NomP" name="NomP" value="<?= $nomP ?>" required>
      </div>

      <div class="form-group">
        <label for="PrenomP">Prénom</label>
        <input type="text" class="form-control" id="PrenomP" name="PrenomP" value="<?= $prenomP ?>" required>
      </div>

      <div class="form-group">
        <label for="StatutP">Statut</label>
        <input type="text" class="form-control" id="StatutP" name="StatutP" value="<?= $statutP ?>" required>
      </div>

      <div class="form-group">
        <label for="AdresseP">Adresse</label>
        <input type="text" class="form-control" id="AdresseP" name="AdresseP" value="<?= $adresseP ?>" required>
      </div>

      <div class="form-group">
        <label for="Code_PostalP">Code Postal</label>
        <input type="text" class="form-control" id="Code_PostalP" name="Code_PostalP" value="<?= $cpP ?>" required>
      </div>

      <div class="form-group">
        <label for="VilleP">Ville</label>
        <input type="text" class="form-control" id="VilleP" name="VilleP" value="<?= $villeP ?>" required>
      </div>

      <h2>c. Configuration du Créateur : </h2>

<form method="post" action="">
  <div class="form-group">
    <label for="NomC">Nom </label>
    <input type="text" class="form-control" id="NomC" name="NomC" value="<?= $nomC ?>" required>
  </div>

  <div class="form-group">
    <label for="URLC">URL</label>
    <input type="text" class="form-control" id="URLC" name="URLC" value="<?= $URLC ?>" required>
  </div>

    <h2>b. Configuration du Responsable de publication : </h2>

<form method="post" action="">
  <div class="form-group">
    <label for="NomR">Nom </label>
    <input type="text" class="form-control" id="NomR" name="NomR" value="<?= $nomR ?>" required>
  </div>

  <div class="form-group">
    <label for="PrenomR">Prénom</label>
    <input type="text" class="form-control" id="PrenomR" name="PrenomR" value="<?= $prenomR ?>" required>
  </div>

  <div class="form-group">
    <label for="ContactR">Contact</label>
    <input type="text" class="form-control" id="ContactR" name="ContactR" value="<?= $contactR ?>" required>
  </div>

  <h2>c. Configuration du Webmaster : </h2>

<form method="post" action="">
  <div class="form-group">
    <label for="NomW">Nom </label>
    <input type="text" class="form-control" id="NomW" name="NomW" value="<?= $nomW ?>" required>
  </div>

  <div class="form-group">
    <label for="PrenomW">Prénom</label>
    <input type="text" class="form-control" id="PrenomW" name="PrenomW" value="<?= $prenomW ?>" required>
  </div>

  <div class="form-group">
    <label for="ContactW">Contact</label>
    <input type="text" class="form-control" id="ContactW" name="ContactW" value="<?= $contactW ?>" required>
  </div>

    <h2>d. Configuration de l'Hébergeur : </h2>


<form method="post" action="">
  <div class="form-group">
    <label for="NomH">Nom </label>
    <input type="text" class="form-control" id="NomH" name="NomH" value="<?= $nomH ?>" required>
  </div>
  <div class="form-group">
    <label for="AdresseH">Adresse</label>
    <input type="text" class="form-control" id="AdresseH" name="AdresseH" value="<?= $adresseH ?>" required>
  </div>

  <div class="form-group">
    <label for="Code PostalH">Code Postal</label>
    <input type="text" class="form-control" id="Code PostalH" name="Code PostalH" value="<?= $cpH ?>" required>
  </div>

  <div class="form-group">
    <label for="VilleH">Ville</label>
    <input type="text" class="form-control" id="VilleH" name="VilleH" value="<?= $villeH ?>" required>
  </div>

  <button type="submit" class="btn btn-primary btn-lg float-right" name="envoyer">Next »</button>

  
</form>