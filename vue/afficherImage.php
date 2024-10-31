<?php $titreOnglet = 'Affichage Image'; ?>
<?php ob_start(); ?>

<div class="col-sm-6 col-md-4 col-lg-3 m-auto">
  <div class="card" title="Id : <?php out($image["id"]); ?>">
    <img
      src="index.php?ressource=/images/{id_image}&id_image=<?php out($image["id"]); ?>"
      class="card-img-top"
      alt="Image <?php out($image["titre"]); ?>">
    <div class="card-body">
      <h5 class="card-title text-center">
        <?php out($image["titre"]); ?>
      </h5>
    </div>
  </div>
</div>

<?php $contenu = ob_get_clean(); ?>
<?php require 'vue/gabarit.php'; ?>