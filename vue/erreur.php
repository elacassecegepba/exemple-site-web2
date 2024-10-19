<?php $titreOnglet = 'Erreur'; ?>

<?php http_response_code(400); // Ajout pour pouvoir détecter l'erreur avec AJAX ?>
<?php ob_start(); ?>

<div class="text-center">
  <h1>Une erreur est survenue&nbsp;:</h1>
  <p><?php out($msgErreur); ?></p>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>