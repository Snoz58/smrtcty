<!DOCTYPE html>
<html>
  <head>

    <!-- OpenLayers CSS -->
    <link rel="stylesheet" type="text/css" href="contenu/css/ol.css" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="contenu/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="contenu/css/style.css">
    <!-- CSS de la Carte -->
    <link rel="stylesheet" type="text/css" href="contenu/css/carte.css">
    <!-- CSS de l'accueil -->
    <link rel="stylesheet" type="text/css" href="contenu/css/accueil.css">
    <!-- Javascript pour OpenLayers -->
    <script src="contenu/js/ol.js"></script>
    <!-- Javascript pour Charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>

    <title><?= $titre." - ".$infoVillage["Nom"] ?></title>

  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="index.php">Smart-<?= $infoVillage["Nom"] ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo ($titre=="SmartVillage" ? 'active' : ''); ?>" href="index.php?action=accueil">Accueil</a>
          </li>
          <li class="nav-item <?php echo ($titre=="Carte" ? 'active' : ''); ?>">
            <a class="nav-link" href="index.php?action=carte">Carte</a>
          </li>
          <li class="nav-item <?php echo ($titre=="Capteurs" ? 'active' : ''); ?>" >
            <a class="nav-link" href="index.php?action=data">Données</a>
          </li>
        </ul>
      </div>
    </nav>

    <?= $contenu ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="contenu/js/jquery-3.3.1.slim.min.js"></script>
    <script src="contenu/js/popper.min.js"></script>
    <script src="contenu/js/bootstrap.min.js"></script>
  </body>
</html>
