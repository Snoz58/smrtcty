
<?php
include 'modele.php';
include 'interface/alerts.php';

if (isset($_GET['id'])){
  $infosNode = getInfosNode($_GET['id']);

  // var_dump($infosNode);

  $nom = $infosNode["Nom"];
  $long = $infosNode["Long"];
  $lat = $infosNode["Lat"];
  $btn = "Modifier";

}
else {
  $nom = "";
  $long = "";
  $lat = "";
  $btn = "Créer";
}

if (!empty($_POST['nom']) &&
    !empty($_POST['long']) &&
    !empty($_POST['lat'])){

  if (isset($_GET['id'])){
    if (updateInfosNode($_GET['id'], $_POST['nom'], $_POST['long'], $_POST['lat'])){
      echo alert_success("SUCCES !", "Le node a bien été modifié");
      header('Location: index.php?step=4');
    }
    else {
      echo alert_error("ERREUR !", "Le node n'a pas été modifié");
    }
  }

  else {
    if (setInfosNode($_POST['nom'], $_POST['long'], $_POST['lat'], true)){
      echo alert_success("SUCCES !", "Le node a bien été créé");
      header('Location: index.php?step=4');
    }
    else {
      echo alert_error("CréerERREUR !", "Le node n'a pas été créé");
    }
  }

}

?>


<!DOCTYPE html>
<html>
  <head>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../contenu/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../contenu/css/style.css">

    <title>Admin</title>

  </head>

  <body>

  <main role="main" class="container">

    <form method="post" action="">
      <div class="form-group">
        <label for="nom">Nom du noeud</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= $nom ?>">
      </div>

      <div class="form-group">
        <label for="long">Longitude</label>
        <input type="text" class="form-control" id="long" name="long" value="<?= $long ?>">
      </div>

      <div class="form-group">
        <label for="lat">Latitude</label>
        <input type="text" class="form-control" id="lat" name="lat" value="<?= $lat ?>">
      </div>

      <div class="float-right">
        <a class="btn btn-outline-primary btn-lg" href="index.php?step=4">Revenir</a>
        <button type="submit" class="btn btn-primary btn-lg" name="envoyer"><?= $btn ?> le noeud</button>
      </div>
    </form>


  </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="contenu/js/jquery-3.3.1.slim.min.js"></script>
    <script src="contenu/js/popper.min.js"></script>
    <script src="contenu/js/bootstrap.min.js"></script>
  </body>
  </html>
