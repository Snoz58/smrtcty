<?php

  $infoVillage = getInfosVillage();
  $titre = 'Comparer';

// Réupération de la liste des capteurs :
$allSensorList = getAllSensorList();
$dropdownSensors = "";
foreach ($allSensorList as $Value) {
  $dropdownSensors .= '<option value="'.$Value['Id'].'">'.$Value['Nom'].' - '.$Value['Node'].'</option>';
}

$formOK = false;


if(isset($_POST["dateDebut"]) &&
   isset($_POST["dateFin"]) &&
   isset($_POST["capteur1"]) &&
   isset($_POST["capteur2"])) {

  $dateDebut = $_POST["dateDebut"];
  $dateFin = $_POST["dateFin"];
  $idCapteur1 = $_POST["capteur1"];
  $idCapteur2 = $_POST["capteur2"];

  $dataCapteur1 = "";
  CreateDataString($idCapteur1, $dateDebut, $dateFin, $dataCapteur1);

  $dataCapteur2 = "";
  CreateDataString($idCapteur2, $dateDebut, $dateFin, $dataCapteur2);

  echo $dataCapteur1;

  $formOK = true;
}

if ($formOK) {

}

  ob_start();
?>

<main role="main" class="container">

<?php

// dumpVar($dataCapteur1);
// dumpVar($dataCapteur2);
$tabDataToCompare = getDataCompare(4,2);

//dumpvar($tabDataToCompare);

$dates =  dataCompareToDate($tabDataToCompare);
$dataSensor1 = dataCompareToSensor($tabDataToCompare, 4);
$dataSensor2 = dataCompareToSensor($tabDataToCompare, 2);

 ?>

  <div class="row">
    <div class="col">
      <form method="POST" action="index.php?action=compare">
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
            <label for="capteur1">Jeu de donnée 2</label>
                <select class="form-control" id="capteur1" name="capteur1">
                  <?= $dropdownSensors ?>
                </select>
          </div>

          <div class="col">
            <label for="capteur2">Jeu de donnée 2</label>
                <select class="form-control" id="capteur2" name="capteur2">
                  <?= $dropdownSensors ?>
                </select>
          </div>

          <div class="col">
            <label for="a">&nbsp</label>
            <button type="submit" class="btn btn-primary form-control">Appliquer</button>
          </div>

        </div>
      </form>
    </div>
  </div>

  <div class="chart-container">
      <canvas id="canvas"></canvas>
  </div>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<script>
var ctx = document.getElementById('canvas').getContext('2d');

var utils = Samples.utils;
var presets = window.chartColors;

var lineChartData = {
			labels : <?= $dates ?>,
			datasets : [
				{
          label : "Donnée 1",

          fill: "bottom",
          backgroundColor: utils.transparentize(presets.blue), // couleur des points de la courbe
          borderColor: "#17a2b8", // couleur de la courbe
					pointStrokeColor : "#F00",
					data : <?= $dataSensor1 ?>,
					bezierCurve : false
				},
        {
          label : "Donnée 2",

          fill: "bottom",
          backgroundColor: utils.transparentize(presets.green), // couleur des points de la courbe
          borderColor: "#3ecf84", // couleur de la courbe
          pointStrokeColor : "#F00",
          data : <?= $dataSensor2 ?>,
          bezierCurve : false
        }
			]

		}

    var options = {
      responsive: true,
      maintainaspectratio: true,
      chartArea: {
          backgroundColor: 'rgba(251, 85, 85, 0.4)'
      }

    };

    var myLine = new Chart(document.getElementById("canvas").getContext("2d"),{
    	data:lineChartData,
      type:"line",
      options:options
    });

</script>

</main>

<?php $contenu = ob_get_clean(); ?>
<?php require 'gabarit.php'; ?>
