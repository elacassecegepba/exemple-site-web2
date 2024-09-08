<?php $titreOnglet = 'Données Formualire'; ?>

<?php ob_start(); ?>

<h1 class="text-center">Données reçues.</h1>

<?php highlight_array($_GET, '$_GET'); ?>

<?php highlight_array($_POST, '$_POST'); ?>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>