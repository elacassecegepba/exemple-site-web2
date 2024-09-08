<?php $titreOnglet = 'Formualire'; ?>

<?php ob_start(); ?>

<h1 class="text-center">Exemple d'un formulaire simple.</h1>

<div class="mx-auto col-md-8 col-lg-6">

  <?php if (isset($_GET["erreur"])) { ?>
    <div class="alert alert-danger" role="alert">
      <?php out($_GET["erreur"]); ?>
    </div>
  <?php } ?>

  <form
    class="needs-validation" novalidate
    action="index.php?ressource=/formulaire&methode=POST" method="post">
    <div class="form-floating mb-3">
      <input
        type="text"
        class="form-control"
        id="premierChampDuFormulaire"
        name="nomDuChamp"
        placeholder="Champ texte à remplir"
        required
        minlength="3"
        maxlength="255">
      <label for="premierChampDuFormulaire">Champ texte à remplir</label>
      <div class="invalid-feedback">
        Veuillez entrer du texte. <br>
        Doit avoir entre 3 et 255 caractères.
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Soumettre</button>
  </form>

</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>