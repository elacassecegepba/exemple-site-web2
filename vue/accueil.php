<?php $titreOnglet = 'Accueil'; ?>

<?php // Tout ce qui se trouve entre ob_start et ob_get_clean n'est pas affiché à l'écran, mais retourné par ob_get_clean. ?>
<?php ob_start(); ?>

<h1 class="text-center">Bienvenue dans Univers de Mots!</h1>

<?php // $contenu sera utilisé par vue/gabarit.php ?>
<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>