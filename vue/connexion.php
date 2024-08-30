<?php $titreOnglet = 'Connexion'; ?>

<?php ob_start(); ?>

<?php if (isset($_GET['erreur'])) { ?>
  <div class="alert alert-danger text-center" role="alert">
    <?php out($_GET['erreur']) ?>
  </div>
<?php } ?>

<h1 class="h3 mb-3 text-center">Connexion</h1>

<form class="m-auto needs-validation" style="max-width: 32rem;" novalidate method="post" action="index.php?ressource=/connexion&methode=POST">
  <div class="form-floating mb-2">
    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
    <label for="email">Email</label>
    <div class="invalid-feedback">
      Veuillez entrer votre adresse courriel.
    </div>
  </div>

  <div class="form-floating mb-2">
    <input type="password" class="form-control" id="motDePasse" name="motDePasse" placeholder="Mot de passe" required>
    <label for="motDePasse">Mot de passe</label>
    <div class="invalid-feedback">
      Veuillez entrer votre mot de passe.
    </div>
  </div>

  <button class="btn btn-primary w-100 py-2" type="submit">Se connecter</button>
</form>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>