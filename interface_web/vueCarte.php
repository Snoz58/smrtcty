<?php $infoVillage = getInfosVillage(); ?>
<?php $titre = 'Carte' ?>

<?php ob_start(); ?>

<div id="map" class="map"></div>
<div id="popup" class="ol-popup">
  <a href="#" id="popup-closer" class="ol-popup-closer"></a>
  <div id="popup-content"></div>
</div>

<!-- Carte à afficher sur la page -->
<script src="contenu/js/carte.js"></script>

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
