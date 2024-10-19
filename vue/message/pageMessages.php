<?php $titreOnglet = 'Messages'; ?>
<?php ob_start(); ?>

<div id="erreur"></div>

<div class='row gap-2' id='messages'>
  <?php require 'vue/message/messages.php' ?>
</div>

<button
  type="button"
  class="btn btn-success position-fixed"
  style="bottom: 3rem; right: 3rem;"
  title="Obtenir d'autres messages"
  id="btnAutresMessages">
  <i class="fa-solid fa-plus"></i>
  <div class="spinner-border d-none spinner-border-sm" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</button>

<button
  type="button"
  class="btn btn-danger position-fixed"
  style="bottom: 3rem; left: 3rem;"
  title="Exemple erreur AJAX"
  id="btnErreur">
  <i class="fa-solid fa-bomb"></i>
</button>

<script src="public/js/messages.js"></script>

<?php $contenu = ob_get_clean(); ?>
<?php require 'vue/gabarit.php'; ?>