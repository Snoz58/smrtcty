<?php $titre = 'Capteurs'; ?>

<?php ob_start(); ?>

<main role="main" class="container">
  <form method="POST" action="index.php?action=data ">
    <div class="form-row form-group">

      <div class="col">
        <label for="dateDebut">Date de début</label>
        <input type="date" class="form-control" id="dateDebut" name="dateDebut" <?php echo (empty($_POST['dateDebut'])) ? '' : 'value="'.$_POST['dateDebut'].'"'; ?>>
      </div>

      <div class="col">
        <label for="dateFin">Date de fin</label>
        <input type="date" class="form-control" id="dateFin" name="dateFin" <?php echo (empty($_POST['dateFin'])) ? '' : 'value="'.$_POST['dateFin'].'"'; ?>>
      </div>

      <div class="col">
        <label for="idCapteur">Point de capture</label>
        <select class="form-control" name="idNode">
          <option>Selection du point de capture</option>
        </select>
      </div>

      <div class="col">
        <label for="idCapteur">Date de fin</label>
        <select class="form-control" name="idCapteur">
          <option value="1">capteur</option>
        </select>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
  </form>
</main>

<?php
$values = getSensorValues(1,0,$_POST["dateDebut"],$_POST["dateFin"]);
var_dump($values);
?>
<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
