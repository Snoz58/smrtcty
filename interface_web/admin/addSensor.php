
<?php
include 'modele.php';
include 'interface/alerts.php';

$nodeList = getNodeList();
$unitList= getUnitList();

// var_dump($_POST);

if (isset($_GET['id'])){
  $infosSensor = getInfosSensor($_GET['id']);

  var_dump($infosSensor);

  $nom = $infosSensor['Nom'];
  $nodeSelected = $infosSensor['fk_IdNode'];
  $unitSelected = $infosSensor['fk_IdUnits'];

  $btn = "Modifier";
}

else {

  $nom = "";
  $nodeSelected = "";
  $unitSelected = "";

  $btn = "Créer";
}

if (!empty($_POST['nom']) &&
    !empty($_POST['node']) &&
    !empty($_POST['unite'])){

  if (isset($_GET['id'])){
    if (updateInfosSensor($_GET['id'], $_POST['nom'], $_POST['node'], $_POST['unite'])){
      echo alert_success("SUCCES !", "Le capteur a bien été modifié");
      header('Location: index.php?step=3');
    }
    else {
      echo alert_error("ERREUR !", "Le capteur n'a pas été modifié");
    }
  }

  else {
    if (setInfosSensor($_POST['nom'], $_POST['node'], $_POST['unite'])){
      echo alert_success("SUCCES !", "Le capteur a bien été créé");
      header('Location: index.php?step=3');
    }
    else {
      echo alert_error("ERREUR !", "Le capteur n'a pas été créé");
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
        <label for="nom">Nom du capteur</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= $nom ?>">
      </div>

      <div class="form-group">
        <label for="node">Node correspondant</label>
        <select class="form-control" id="node" name="node">
          <?php
            foreach ($nodeList as $node) {
              echo $nodeSelected." / ".$node['Id'];
              if ($nodeSelected == $node['Id']){
                  echo '<option selected value="'.$node['Id'].'">Node '.$node['Id'].' : '.$node['Nom'].'</option>';
              }
              else{
                echo '<option value="'.$node['Id'].'">Node '.$node['Id'].' : '.$node['Nom'].'</option>';
              }
            }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="unite">Unité correspondante</label>
        <select class="form-control" id="unite" name="unite">
          <?php
            foreach ($unitList as $unit) {
              if ($unitSelected == $unit['Id']){
                  echo '<option selected value="'.$unit['Id'].'">'.$unit['Label'].' : '.$unit['Unite'].'('.$unit['Symbol'].')</option>';
              }
              else{
                echo '<option value="'.$unit['Id'].'">'.$unit['Label'].' : '.$unit['Unite'].'('.$unit['Symbol'].')</option>';
              }


            }
          ?>
        </select>
      </div>

      <div class="float-right">
        <a class="btn btn-outline-primary btn-lg" href="index.php?step=3">Revenir</a>
        <button type="submit" class="btn btn-primary btn-lg" name="envoyer"><?= $btn ?> le capteur</button>
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
