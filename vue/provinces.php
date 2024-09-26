<?php $titreOnglet = "provinces"; ?>
<?php ob_start(); ?>

<div class="float-end">
  <?php require 'vue/listePays.php'; ?>
</div>
<h1 class="text-center">Provinces</h1>

<?php require 'vue/listeProvinces.php'; ?>

<?php $contenu = ob_get_clean(); ?>
<?php require 'vue/gabarit.php'; ?>