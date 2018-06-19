<?php $titre = 'Erreur'; ?>

<?php ob_start() ?>
<main role="main" class="container">
  <p>Une erreur est survenue : <?= $msgErreur ?></p>
  a<br/>
  B<br/>
  C<br/>
  D<br/>
  E<br/>
  F<br/>
  G<br/>
</main>
<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
