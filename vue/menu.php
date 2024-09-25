<nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Navigation principale">
  <div class="container">
    <a class="navbar-brand" href="index.php?ressource=/">
      <img src="public/image/logo-64x64.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      Univers de Mots
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <!-- Éléments du menu à gauche -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link <?php NavClass("/compteur"); ?>" href="index.php?ressource=/compteur">Compteur</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php NavClass("/formulaire"); ?>" href="index.php?ressource=/formulaire">Formulaire</a>
        </li>
      </ul>
      <!-- Éléments du menu à droite -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-danger <?php NavClass("/detruire-session"); ?>" href="index.php?ressource=/detruire-session">Détruire session</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
// Détermine si le lien de menu est actif selon la ressource demandée dans l'URL
function NavClass($menu)
{
  if (
    isset($_GET['ressource']) &&
    $_GET['ressource'] === $menu
  ) {
    echo ' active ';
  }
}
?>