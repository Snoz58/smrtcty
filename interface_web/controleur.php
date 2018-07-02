<?php

require 'modele.php';

function carte() {
  require 'vueCarte.php';
}

function accueil() {
  require 'vueAccueil.php';
  // require 'vueCarte.php';
}

function data() {
  require 'vueData.php';
}

// Affiche les détails sur un billet
function billet($idBillet) {
  $billet = getBillet($idBillet);
  $commentaires = getCommentaires($idBillet);
  require 'vueBillet.php';
}

// Affiche une erreur
function erreur($msgErreur) {
  require 'vueErreur.php';
}

?>
