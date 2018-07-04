<?php $infoVillage = getInfosVillage(); ?>
<?php $titre = 'SmartVillage'; ?>


<?php ob_start() ?>
<div class="accueil">
  <main role="main">
    <div class="accueil_contenu col-md-8 offset-md-2">

      <h1 class="cover-heading">Titre !</h1>
      <p class="lead">Contenu, quelques lignes explicatives sur le concept, le principe, le fonctionnement ...
      Le tout sur une super image de fond :P</p>
      <p class="lead">
        <a href="index.php?action=carte" class="btn btn-lg btn-success">Accéder à la carte</a>
      </p>

    </div>
  </main>
</div>
<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
