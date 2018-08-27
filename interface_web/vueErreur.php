<?php $infoVillage = getInfosVillage(); ?>
<?php $titre = 'Erreur' ?>

<?php ob_start() ?>
<main role="main" class="container">
  <p>Une erreur est survenue : <?= $msgErreur ?></p>
</main>
<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
