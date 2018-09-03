
<?php
include 'modele.php';
include 'interface/alerts.php';

var_dump($_POST);

if (isset($_GET['id'])){
  $infosUnite = getInfosUnite($_GET['id']);

  // var_dump($infosNode);

  $nom = $infosUnite["Label"];
  $long = $infosUnite["Unite"];
  $lat = $infosUnite["Symbol"];
  $btn = "Modifier";

}
else {
  $nom = "";
  $long = "";
  $lat = "";
  $btn = "Créer";
}

if (!empty($_POST['label']) &&
    !empty($_POST['unite']) &&
    !empty($_POST['symbol'])){

  if (isset($_GET['id'])){
    if (updateInfosUnite($_GET['id'], $_POST['label'], $_POST['unite'], $_POST['symbol'])){
      echo alert_success("SUCCES !", "L'unité a bien été modifié");
      header('Location: addUnite.php');
    }
    else {
      echo alert_error("ERREUR !", "L'unité n'a pas été modifié");
    }
  }

  else {
    if (setInfosUnite($_POST['label'], $_POST['unite'], $_POST['symbol'])){
      echo alert_success("SUCCES !", "L'unite' a bien été créé");
      header('Location: addUnite.php');
    }
    else {
      echo alert_error("ERREUR !", "L'unité n'a pas été créé");
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
        <label for="label">Label</label>
        <input type="text" class="form-control" id="label" name="label" value="<?= $nom ?>">
      </div>

      <div class="form-group">
        <label for="unite">Unité</label>
        <input type="text" class="form-control" id="unite" name="unite" value="<?= $long ?>">
      </div>

      <div class="form-group">
        <label for="symbol">Symbole</label>
        <input type="text" class="form-control" id="symbol" name="symbol" value="<?= $lat ?>">
      </div>

      <div class="float-right">
        <a class="btn btn-outline-primary btn-lg" href="addUnite.php">Revenir</a>
        <button type="submit" class="btn btn-primary btn-lg" name="envoyer"><?= $btn ?> l'unité</button>
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
