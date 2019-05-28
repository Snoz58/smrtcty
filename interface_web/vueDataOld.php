<?php
  $infoVillage = getInfosVillage();
  $titre = 'TEST';

/**************
VARIABLES :
$label = Initialisé vide, ordonnées des graphique (dates en général)
$data = Initialisé vide, abscisse des graphique (données de la base)
**************/

$data = array();
$labels = "";
$values = "";

$datasets = getDataIdLastDays();

// récupération des ID et unités des capteurs qui possèdent des valeurs pour les 7 derniers jours
if (!empty($datasets)){
  foreach ($datasets as $variable) {
    $dataToInsert = array();
    array_push($dataToInsert, $variable[0], $variable[1], $variable[2]);
    $realDatas = getDataLastDays($variable[0]);
    foreach ($realDatas as $listData) {

      // Conversion et stockage de l'horodatage pour l'abscisse du graphe
      $labels .= "'".convertdate($listData["Date"])."',";
      // Récupération des valeurs des capteurs
      $values .= $listData["Value"].",";

    }

    // Les variables $label et $data contiennent deux chaînes de caractère formatées avec une virgule entre chaque donnée
    // On enlève la dernière virgule de la chaîne
    $labels = substr($labels, 0, -1);
    $values = substr($values, 0, -1);

    array_push($dataToInsert, $labels, $values);

  //  dumpVar($dataToInsert);
  }
}









  // Valeurs par défaut en cas de non remplissage du formulaire
  $debut = (!empty($_POST["dateDebut"])) ? $_POST["dateDebut"] : "2000-01-01";
  // $debut = $_POST["dateDebut"];
  $fin = (!empty($_POST["dateFin"])) ? $_POST["dateFin"] : "now()";
  // $fin = $_POST["dateFin"];


  $node = (!empty($_GET["node"])) ? $_GET["node"] : 1;
  // $defaultSensor = (!empty(getFirstSensor($node))) ? getFirstSensor($node) : getFirstSensor($node);
  $sensor = (!empty($_GET["sensor"])) ? $_GET["sensor"] : getFirstSensor($node);


  $labels = "[";
  $data = "[";

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

    $labels .= "]";
    $data .= "]";
  }

  ob_start();
?>

<main role="main" class="container">




  <!-- <div class="chart-container"> -->
      <canvas id="canvas"></canvas>
  <!-- </div> -->
</main>

<script>

function CreateChart(titre, datas, dates, idCanvas){
// function CreateChart(Labels){
alert(idCanvas);

  testdatas = datas;
  alert(testdatas);
  var lineChartData = {

    labels : dates,
    datasets : [
    {
      label : titre,
      fill: "bottom",
      backgroundColor: "#a8d4ff ", // couleur des points de la courbe
      borderColor: "#17a2b8", // couleur de la courbe
      pointStrokeColor : "#F00",
      data : datas,
      bezierCurve : false
    }
    ]
  }

  var myLine = new Chart(document.getElementById(idCanvas).getContext("2d"),{
  	data:lineChartData,
    type:"line"
  });
}


function testParametres(titre, labels, datas, idCanvas){
  alert('Titre : '+idCanvas);
  var tabContent = "";
  for (var i=0; i<datas.length; i++){
    tabContent = tabContent + " - " + datas[i];
  }
  alert(tabContent);
}

var labelsjs = <?=  $labels ?>;
var datasjs = <?= $data ?>;
CreateChart(<?php echo "'".(getSensorType($sensor)." en ".getUniteFromSensor($sensor)."'"); ?>, labelsjs, datasjs, "canvas");


</script>

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
