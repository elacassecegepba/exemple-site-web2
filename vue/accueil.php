<?php $titreOnglet = 'Accueil'; ?>

<?php ob_start(); ?>

<h1 class="text-center">Exemple Synchronisation état client avec serveur</h1>

<?php require 'vue/formulaireAjoutMessage.php' ?>

<div id="messages" class="row mt-2">
    <?php afficherMessages(); ?>
</div>

<script src="public/js/messages.js"></script>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>