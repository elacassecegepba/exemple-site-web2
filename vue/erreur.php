<?php $titreOnglet = 'Erreur'; ?>

<?php // Tout ce qui se trouve entre ob_start et ob_get_clean n'est pas affiché à l'écran, mais retourné par ob_get_clean. ?>
<?php ob_start(); ?>

<div class="text-center">
  <h1>Une erreur est survenue&nbsp;:</h1>
  <p><?php out($msgErreur); ?></p>
</div>

<?php // $contenu sera utilisé par vue/gabarit.php ?>
<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>