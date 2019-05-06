<?php
  $infoVillage = getInfosVillage();
  $titre = 'Capteurs';
  
/**************
VARIABLES :
$debut = Date de la première donnée à afficher
$fin = Date de la dernière donnée à afficher
$node = ID du point de captage
$sensor = ID du capteur
$label = Initialisé vide, ordonnées du graphique (dates en général)
$data = Initialisé vide, abscisse du graphique (données de la base)
**************/

  // Valeurs par défaut en cas de non remplissage du formulaire
  $debut = (!empty($_POST["dateDebut"])) ? $_POST["dateDebut"] : "2000-01-01";
  // $debut = $_POST["dateDebut"];
  $fin = (!empty($_POST["dateFin"])) ? $_POST["dateFin"] : "now()";
  // $fin = $_POST["dateFin"];


  $node = (!empty($_GET["node"])) ? $_GET["node"] : 1;
  // $defaultSensor = (!empty(getFirstSensor($node))) ? getFirstSensor($node) : getFirstSensor($node);
  $sensor = (!empty($_GET["sensor"])) ? $_GET["sensor"] : getFirstSensor($node);


  $labels = "";
  $data = "";

  // Plus grande et plus petite valeur des données à afficher
  $smallesData = 99999;
  $biggestData = 0;

  // Marges entre les données extrèmes et le bord du graphique
  $offsetChart = 20;

  // Récupération des données choisies ($node et $sensor)

  if (isset($debut) && isset($fin)){
    $values = getSensorValues($node, $sensor, $debut, $fin);
  }
  else {
    $values = getLastTenSensorValues($node, $sensor);
  }
  if (!empty($values)){
    foreach ($values as $variable) {
      // Conversion et stockage de l'horodatage pour l'abscisse du graphe
      $labels .= "'".convertdate($variable["Date"])."',";
      // Récuopération des valeurs des capteurs
      $data .= $variable["Value"].",";

      if ($variable["Value"] < $smallesData)
        $smallesData = $variable["Value"];
      if ($variable["Value"] > $biggestData)
        $biggestData = $variable["Value"];
    }

    // Les variables $label et $data contiennent deux chaînes de caractère formatées avec une virgune entre chaque donnée
    // On enlève la dernière virgule de la chaîne
    $labels = substr($labels, 0, -1);
    $data = substr($data, 0, -1);

  }

  ob_start();
?>

<main role="main" class="container">

  <?php

?>

  <div class="row clearfix">
    <div class="col">
      <div class="dropdown float-left">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Point de captage <?php echo $node.' - '.getThatNodeName($node); ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <?php
          $nodeList = getNodeList();
          foreach ($nodeList as $Value) {
            if ($node == $Value["Id"]){
              echo '<a class="dropdown-item active" href="index.php?action=data&node='.$Value["Id"].'">Point de captage '.$Value["Id"].' - '.$Value["Nom"].'</a>';
            }
            else {
              echo '<a class="dropdown-item" href="index.php?action=data&node='.$Value["Id"].'">Point de captage '.$Value["Id"].' - '.$Value["Nom"].'</a>';
            }
          }
          ?>
        </div>
      </div>

      <div class="dropdown float-left">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo getSensorType($sensor); ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <?php $sensorList = getSensorList($node);
          foreach ($sensorList as $Value) {
            echo '<a class="dropdown-item" href="index.php?action=data&node='.$node.'&sensor='.$Value["Id"].'">'.$Value["Nom"].'</a>';
          }
          ?>
        </div>
      </div>

      <div class="dropdown float-right">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Télécharger
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" target="_blank" href="datacsv.php?node=<?= $node ?>&sensor=<?= $sensor ?>&debut=<?= $debut ?>&fin=<?= $fin ?>">CSV</a>
          <a class="dropdown-item" target="_blank" href="dataxml.php?node=<?= $node ?>&sensor=<?= $sensor ?>&debut=<?= $debut ?>&fin=<?= $fin ?>">XML</a>
          <a class="dropdown-item" id = "downloadImage" target="_blank" href="#" download="donnees_capteur.png" >Image</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <a href="#plus" class="btn btn-info dropdown-toggle" data-toggle="collapse">Plus de paramètres</a>
      <div id="plus" class="collapse">
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
              <label for="dateFin">&nbsp</label>
              <button type="submit" class="btn btn-primary form-control">Appliquer</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="chart-container">
      <canvas id="canvas"></canvas>
  </div>
</main>

<script>

var ctx = document.getElementById("canvas").getContext("2d");

// ctx.fillStyle = 'rgb(200, 0, 0)';
// ctx.fillRect(10, 10, 50, 50);


var lineChartData = {
  // fillColor : "#ffff00",
    // strokeColor : "#000000",
			labels : [<?= $labels ?>],
			datasets : [
				{
          label : "<?php echo (getSensorType($sensor)." (en ".getUniteFromSensor($sensor)." )"); ?>",

          fill: "bottom",
          backgroundColor: "#a8d4ff ", // couleur des points de la courbe
          borderColor: "#17a2b8", // couleur de la courbe
					pointStrokeColor : "#F00",
					data : [<?= $data ?>],
					bezierCurve : false
				}
			]

		}

function done(){

// ------------------------------------------------------------- Début tests fond image PNG

  // génération d'une image à partir du graphique

  // change non-opaque pixels to white

console.log('-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_');
  var context = document.getElementById('canvas').getContext('2d');
  var canvas = context.canvas;
  var imgData = context.getImageData(0,0,canvas.width,canvas.height);
  var data = imgData.data;

  for(var i=0;i<data.length;i+=4){
    var transparence = data[i+3];

    if (transparence < 255){
      // Si le pixel est totalement transparent -> on le passe en blanc
      // if(transparence==0){
      //     data[i]=255;
      //     data[i+1]=255;
      //     data[i+2]=255;
      //     data[i+3]=255;
      // }

      // Si il n'est ni opaque, ni totalement transparent
      // else {
      // console.log("Old :"+data[i]);
      //   data[i]=data[i]*data[i+3]/255;
      //   data[i+1]=data[i+1]*data[i+3]/255;
      //   data[i+2]=data[i=2]*data[i+3]/255;
      //   data[i+3]=255;
      // }
    }
  }
  //context.putImageData(imgData,0,0);

// ------------------------------------------------------------- Fin tests fond image PNG

  var url = myLine.toBase64Image();
  // var url = imgData.toDataURL();


  // window.open(myLine.toBase64Image(),'_blank');
  document.getElementById("downloadImage").href=url;
}
var options = {
  responsive: true,
  maintainaspectratio: false,
  animation: {
    onComplete: done
  },
  scales: {
        yAxes: [{
            ticks: {
                suggestedMin: <?= $smallesData - $offsetChart ?>,
                suggestedMax: <?= $biggestData + $offsetChart ?>
            }
        }]
    },
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

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
