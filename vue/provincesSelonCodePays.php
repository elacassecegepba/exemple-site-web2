<?php $titreOnglet = "Provinces du " . $pays["nom"]; ?>
<?php ob_start(); ?>

<h1 class="text-center d-flex justify-content-center align-items-center">
  Provinces du&nbsp;<?php require 'vue/listePays.php'; ?>
</h1>

<?php require 'vue/listeProvinces.php'; ?>

<?php $contenu = ob_get_clean(); ?>
<?php require 'vue/gabarit.php'; ?>