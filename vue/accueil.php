<?php $titreOnglet = 'Accueil'; ?>
<?php ob_start(); ?>

<h1 class="text-center">Bienvenue dans Univers de Mots!</h1>

<?php $contenu = ob_get_clean(); ?>
<?php require 'vue/gabarit.php'; ?>