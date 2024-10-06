<?php $titreOnglet = "Mémoire"; ?>
<?php ob_start(); ?>

<div class="container mt-5 text-center">
  <h1>Chronomètre</h1>
  <div id="chronometre" class="display-4 mb-4">00:00:00.0</div>
  <button id="demarrer" class="btn btn-success me-2">Démarrer</button>
  <button id="arreter" class="btn btn-danger me-2" disabled>Arrêter</button>
  <button id="reinitialiser" class="btn btn-primary">Réinitialiser</button>
</div>

<script src="public/js/chronometre.js"></script>

<?php $contenu = ob_get_clean(); ?>
<?php require 'vue/gabarit.php'; ?>