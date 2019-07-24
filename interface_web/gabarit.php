<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
          <li class="nav-item <?php echo ($titre=="Comparer" ? 'active' : ''); ?>" >
            <a class="nav-link" href="index.php?action=compare">Comparer données</a>
          </li>
          </ul>
      </div>
    </nav>





    <!-- <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
         <a class="navbar-brand" href="#">Navbar</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarsExampleDefault">
           <ul class="navbar-nav mr-auto">
             <li class="nav-item active">
               <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#">Link</a>
             </li>
             <li class="nav-item">
               <a class="nav-link disabled" href="#">Disabled</a>
             </li>
             <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
               <div class="dropdown-menu" aria-labelledby="dropdown01">
                 <a class="dropdown-item" href="#">Action</a>
                 <a class="dropdown-item" href="#">Another action</a>
                 <a class="dropdown-item" href="#">Something else here</a>
               </div>
             </li>
           </ul>
           <form class="form-inline my-2 my-lg-0">
             <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
             <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
           </form>
         </div>
       </nav> -->





    <?= $contenu ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="contenu/js/jquery-3.3.1.slim.min.js"></script>
    <script src="contenu/js/popper.min.js"></script>
    <script src="contenu/js/bootstrap.min.js"></script>
  </body>
</html>
