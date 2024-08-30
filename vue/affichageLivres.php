<div class="row justify-content-center">
  <?php while ($livre = $requeteLivres->fetch()) { ?>
    <div class="col-12 col-md-6 col-xl-4 mb-3">
      <a href="index.php?ressource=/livres/{id}&id=<?php out($livre['id']); ?>" class="text-decoration-none">
        <div class="card mx-auto" style="max-width: 28rem;">
          <div class="d-flex">
            <img src="index.php?ressource=/livres/{id}/couverture&id=<?php out($livre['id']); ?>" class="object-fit-cover rounded-4 p-2 flex-shrink-0" alt="" style="height: 9rem; width: 6rem;">
            <div class="card-body d-flex flex-column flex-1" style="height: 9rem;">
              <h5 class="card-title"><?php out($livre['titre']); ?></h5>
              <p class="card-text overflow-y-scroll flex-1"><?php out($livre['description']); ?></p>
            </div>
          </div>
        </div>
      </a>
    </div>
  <?php } ?>
  <?php $requeteLivres->closeCursor(); ?>
</div>