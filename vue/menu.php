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
          <a class="nav-link <?php NavClass("/livres"); ?>" href="index.php?ressource=/livres">Livres</a>
        </li>
      </ul>
      <!-- Éléments du menu à droite -->
      <ul class="navbar-nav">
        <?php if (!isset($_SESSION['utilisateur'])) { ?>
          <li class="nav-item">
            <a class="nav-link <?php NavClass("/connexion"); ?>" href="index.php?ressource=/connexion">Connexion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php NavClass("/inscription"); ?>" href="index.php?ressource=/inscription">Inscription</a>
          </li>
        <?php } else { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php out($_SESSION['utilisateur']['email']) ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="index.php?ressource=/utilisateurs/moi/livres">Vos livres</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="index.php?ressource=/deconnexion">Déconnexion</a></li>
            </ul>
          </li>
        <?php } ?>
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