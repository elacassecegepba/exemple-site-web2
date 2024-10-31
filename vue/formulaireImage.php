<?php $titreOnglet = 'Formulaire Image'; ?>
<?php ob_start(); ?>

<div class="col-sm-10 col-md-8 col-lg-6 m-auto">
  <?php if (isset($_GET['erreur'])) { ?>
    <div class="alert alert-danger" role="alert">
      <?php out($_GET['erreur']); ?>
    </div>
  <?php } ?>

  <form class="needs-validation" novalidate action='index.php?ressource=/images&methode=POST' method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="titre" class="form-label">Titre</label>
      <input type="text" class="form-control" id="titre" name="titre" required maxlength="255" minlength="3">
      <div class="invalid-feedback">
        Veuillez entrer le titre de l'image. <br>
        Doit avoir entre 3 et 255 caractères.
      </div>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg" required>
      <div class="invalid-feedback">
        Veuillez choisir une image. <br>
        Seuls les images de type PNG et JPEG sont acceptés.
      </div>
    </div>

    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" value="" id="nonSecuritaire" name="nonSecuritaire">
      <label for="nonSecuritaire" class="form-check-label">Televersement non sécuritaire</label>
    </div>

    <button class="btn btn-primary" type="submit">
      Soumettre
    </button>
  </form>
</div>

<script src="public/js/formulaireImage.js"></script>

<?php $contenu = ob_get_clean(); ?>
<?php require 'vue/gabarit.php'; ?>