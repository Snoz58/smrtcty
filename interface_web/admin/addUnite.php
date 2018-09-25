<?php
include 'modele.php';
include 'interface/alerts.php';

$uniteList = getUnitList();

if (!empty($_GET['action'] ) ){
  // Supression d'une unité
  if ($_GET["action"] == "delUnit" && !empty($_GET["id"])){
    if (deleteUnite($_GET['id'])){
      echo alert_success("SUCCES !", "L'unité a bien été supprimé");
      header('Location: addUnite.php');
    }
    else{
      echo alert_error("ERREUR !", "L'Unité n'a pu être supprimé");
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
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../contenu/js/bootstrap.min.js"></script>
    <title>Admin</title>

  </head>
  <body>

  <main role="main" class="container">

    <table class="table table-bordered btn-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Unite</th>
          <th scope="col">Symbole</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($uniteList as $unite){?>

          <tr>
            <th scope="row"><?= $unite['Id'] ?></th>
            <td><?= $unite['Label'] ?></td>
            <td><?= $unite['Unite'] ?></td>
            <td class="text-center"><?= $unite['Symbol'] ?></td>
            <td class="text-center">
              <div class="btn-group" role="group">
                <a class="text-white btn btn-danger" href="addUnite.php?action=delUnit&id=<?= $unite["Id"] ?>">Supprimer</a>
                <a class="text-white btn btn-info" href="addUniteForm.php?id=<?= $unite["Id"] ?>" >Modifier</a>
              </div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="float-right">
      <a class="btn btn-outline-primary btn-lg" href="index.php?step=4">Revenir</a>
      <a class="btn btn-primary btn-lg" href="addUniteForm.php">Ajouter une unité</a>
    </div>
  </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../contenu/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../contenu/js/popper.min.js"></script>
    <script src="../contenu/js/bootstrap.min.js"></script>
  </body>
  </html>
