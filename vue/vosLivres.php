<?php $titreOnglet = 'Vos livres'; ?>

<?php // Tout ce qui se trouve entre ob_start et ob_get_clean n'est pas affiché à l'écran, mais retourné par ob_get_clean. ?>
<?php ob_start(); ?>

<h1 class="text-center">Vos Livres</h1>

<a class="btn btn-success d-table mx-auto my-2" href="index.php?ressource=/publier-livre" role="button">
  Publier un livre
</a>

<?php require_once "vue/affichageLivres.php"; ?>

<?php // $contenu sera utilisé par vue/gabarit.php ?>
<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>