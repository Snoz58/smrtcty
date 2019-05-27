<?php

require 'modele.php';

function carte() {
  require 'vueCarte.php';
}

function accueil() {
  require 'vueAccueil.php';
}

function data() {
  require 'vueData.php';
}

function compare() {
  require 'vueDataCompare.php';
}

function TEST() {
 require 'vueDataOld.php';
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
