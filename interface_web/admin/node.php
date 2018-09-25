<h1>1. Configuration des noeuds et capteurs : </h1>
<div class="row">
  <div class="col form-group">
    <a class="btn btn-primary" href="addNode.php" role="button">Ajouter un noeud</a>
    <a class="btn btn-primary" href="addSensor.php" role="button">Ajouter un capteur</a>
    <a class="btn btn-primary" href="addUnite.php" role="button">Modifier les unités</a>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalNode">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-center">
      <div class='modal-header'>
        <h5 class='col-12 modal-title text-center'>Attention !</h5>
      </div>
      <div class="modal-body">
        Voulez vous vraiment supprimer ce Node ? <br />
        Tous les capteurs associés seront également supprimés.
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" href="index.php?step=4">Annuler</a>
        <a class="btn btn-primary" href="index.php?step=4&action=delNodeOk&id=<?= $_GET['id'] ?>">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<?php
if (!empty($_GET['action'] ) ){

  // Supression d'un capteur
  if ($_GET["action"] == "delSensor" && !empty($_GET["id"])){
    if (deleteSensor($_GET['id'])){
      echo alert_success("SUCCES !", "Le capteur a bien été supprimé");
      header('Location: index.php?step=4');
    }
    else{
      echo alert_error("ERREUR !", "Le capteur n'a pu être supprimé");
    }
  }

  // Supression d'un node -> demande de confirmation
  if ($_GET["action"] == "delNode" && !empty($_GET["id"])){
    echo '<script> $("#ModalNode").modal("show"); </script>';
  }

  // Suppression d'un node validé par l'utilisateur
  if ($_GET["action"] == "delNodeOk" && !empty($_GET["id"])){
    if (deleteNode($_GET['id'])){
      echo alert_success("SUCCES !", "Le Node a bien été supprimé");
      header('Location: index.php?step=4');
    }
    else{
      echo alert_error("ERREUR !", "Le Node n'a pu être supprimé");
    }
  }
}
$nodeList = getNodeList(); // Id, Nom, Lat, Long

foreach ($nodeList as $node) {

  $sensorList = getSensorList($node['Id']); //Id, Nom, Unite, Symbole
?>
  <div class="row">
    <div class="col form-group">
      <h3 class="float-left"><?= $node['Id'] ?> - <?= $node['Nom'] ?></h3>
      <div class="float-right">
        <a class="btn btn-outline-danger" href="index.php?step=4&action=delNode&id=<?= $node['Id'] ?>" role="button">Supprimer</a>
        <a class="btn btn-outline-info" href="addNode.php?id=<?= $node['Id'] ?>">Modifier</a>
      </div>
    </div>

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
        <?php foreach ($sensorList as $sensor){?>

          <tr>
            <th scope="row"><?= $sensor[0] ?></th>
            <td><?= $sensor['Nom'] ?></td>
            <td><?= $sensor['Unite'] ?></td>
            <td class="text-center"><?= $sensor['Symbol'] ?></td>
            <td class="text-center">
              <div class="btn-group" role="group" aria-label="Basic example">
                <a class="text-white btn btn-danger" href="index.php?step=4&action=delSensor&id=<?= $sensor[0] ?>">Supprimer</a>
                <a class="text-white btn btn-info" href="addSensor.php?id=<?= $sensor[0] ?>">Modifier</a>
              </div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php
}
?>


<button type="submit" class="btn btn-primary btn-lg float-right" name="envoyer">Next »</button>
