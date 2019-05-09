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

    <!-- Javascript pour OpenLayers -->
    <script src="contenu/js/ol.js"></script>

    <title>Carte</title>

  </head>

  <body>

      <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">Smart*nomDuVillage*</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="carte.php">Carte</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="donnees.php">Données</a>
                </li>
              </ul>
                <a href="#" class="btn btn-outline-success my-2 my-sm-0">Connexion</a>
            </div>
          </nav>


    <div id="map" class="map"></div>
    <div id="popup" class="ol-popup">
      <a href="#" id="popup-closer" class="ol-popup-closer"></a>
      <div id="popup-content"></div>
    </div>    
    
    <!-- Carte à afficher sur la page -->
    <script src="contenu/js/carte.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="contenu/js/jquery-3.3.1.slim.min.js"></script>
    <script src="contenu/js/popper.min.js"></script>
    <script src="contenu/js/bootstrap.min.js"></script>
  </body>
</html>
