<?php $titreOnglet = 'Publier un livre'; ?>

<?php ob_start(); ?>

<?php if (isset($_GET['erreur'])) { ?>
  <div class="alert alert-danger text-center" role="alert">
    <?php out($_GET['erreur']) ?>
  </div>
<?php } ?>

<h1 class="h3 mb-3 text-center">Publier un livre</h1>

<!-- On n'utilise pas form-floating, car ce n'est pas supporté avec les <input type="file"/> 😢 -->
<!-- enctype="multipart/form-data" est nécessaire pour pouvoir envoyer des fichiers -->
<form class="m-auto needs-validation" style="max-width: 32rem;" novalidate method="post" action="index.php?ressource=/livres&methode=POST" enctype="multipart/form-data">
  <div class="mb-2">
    <label class="form-label" for="titre">Titre</label>
    <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" minlength="3" maxlength="255" required>
    <div class="invalid-feedback">
      Veuillez entrer le titre du livre.
    </div>
  </div>

  <div class="mb-2">
    <label class="form-label" for="description">Description</label>
    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description" minlength="3" maxlength="65535" required style="height: 7rem;"></textarea>
    <div class="invalid-feedback">
      Veuillez entrer la description du livre.
    </div>
  </div>

  <!-- Notez que le name du select doit être déclaré comme un tableau (categories[]) si l'on permet la sélection multiple -->
  <div class="mb-2">
    <label class="form-label" for="categories[]">Catégories</label>
    <select class="form-select" id="categories[]" name="categories[]" multiple required>
      <?php while ($catgorie = $requeteCategories->fetch()) { ?>
        <option value="<?php out($catgorie["id"]) ?>">
          <?php out($catgorie["categorie"]) ?>
        </option>
      <?php } ?>
      <?php $requeteCategories->closeCursor(); ?>
    </select>
    <div class="invalid-feedback">
      Veuillez sélectionner au moins une catégorie.
    </div>
  </div>

  <!-- Notez que l'utilisation d'accept pour n'autoriser que les fichiers PNG et JPEG -->
  <div class="mb-2">
    <label class="form-label" for="imageCouverture">Image de couverture</label>
    <input type="file" class="form-control" id="imageCouverture" name="imageCouverture" accept="image/png, image/jpeg" required>
    <div class="invalid-feedback">
      Veuillez sélectionnez une image (PNG ou JPEG) de couverture.
    </div>
  </div>

  <!-- Notez que l'utilisation de multiple pour autoriser la sélection de plusieurs fichiers -->
  <!-- Notez que le name de l'input doit être déclaré comme un tableau (pages[]) si l'on permet la sélection de plusieurs fichiers -->
  <div class="mb-2">
    <label class="form-label" for="pages[]">Pages</label>
    <div class="input-group">
      <input type="file" class="form-control" id="pages[]" name="pages[]" accept="image/png, image/jpeg"" multiple required>
      <a tabindex="0" class="btn btn-outline-secondary rounded-end" role="button" id="pagesInformation" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="Notez que l'ordre des pages sera déterminé par le nom des fichiers.">i</a>
      <div class="invalid-feedback">
        Veuillez sélectionnez vos pages (PNG ou JPEG).
      </div>
    </div>
    
  </div>

  <button class="btn btn-primary w-100 py-2" type="submit">Publier le livre</button>
</form>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>