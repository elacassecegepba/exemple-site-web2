<?php $titreOnglet = $livre['titre']; ?>

<?php // Tout ce qui se trouve entre ob_start et ob_get_clean n'est pas affiché à l'écran, mais retourné par ob_get_clean. 
?>
<?php ob_start(); ?>

<h1 class='text-center'><?php out($livre['titre']); ?></h1>

<div>
  <?php
  $pageId = 0;
  while ($page = $requetePages->fetch()) {
  ?>
    <img
      src='index.php?ressource=/pages/{id}&id=<?php out($page['id']); ?>'
      class="mx-auto d-block w-75"
      alt='Page-<?php out($pageId); ?>' />
  <?php
    $pageId++;
  }
  $requetePages->closeCursor();
  ?>
</div>

<?php // $contenu sera utilisé par vue/gabarit.php 
?>
<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>