<?php $titreOnglet = 'Inscription'; ?>

<?php ob_start(); ?>

<?php if (isset($_GET['erreur'])) { ?>
  <div class="alert alert-danger text-center" role="alert">
    <?php out($_GET['erreur']) ?>
  </div>
<?php } ?>

<h1 class="h3 mb-3 text-center">Inscription</h1>

<form class="m-auto needs-validation" style="max-width: 32rem;" novalidate method="post" action="index.php?ressource=/inscription&methode=POST">
  <div class="form-floating mb-2">
    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
    <label for="email">Email</label>
    <div class="invalid-feedback">
      Veuillez entrer une adresse courriel valide.
    </div>
  </div>

  <!--
    (?=.*[A-Z]) : Au moins une lettre majuscule.
    (?=.*[a-z]) : Au moins une lettre minuscule.
    (?=.*\d) : Au moins un chiffre.
    (?=.*\W) : Au moins un caractère spécial.
    .{8,} : Au moins 8 caractères.
  -->
  <div class="form-floating mb-2">
    <input type="password" class="form-control" id="motDePasse" name="motDePasse" placeholder="Mot de passe" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}" required>
    <label for="motDePasse">Mot de passe</label>
    <div class="invalid-feedback">
      <div class="alert alert-danger" role="alert">
        <strong>Veuillez entrer un mot de passe respectant les critères de sécurité suivants&nbsp;:<br></strong>
        <ul class="m-0">
          <li id="auMoins8Caractere" class="text-danger">Au moins 8 caractères.</li>
          <li id="auMoinsUneLettreMajuscule" class="text-danger">Au moins une lettre majuscule.</li>
          <li id="auMoinsUneLettreMinuscule" class="text-danger">Au moins une lettre minuscule.</li>
          <li id="auMoinsUnChiffre" class="text-danger">Au moins un chiffre.</li>
          <li id="auMoinsUnCaractereSpecial" class="text-danger">Au moins un caractère spécial.</li>
        </ul>
      </div>
    </div>
  </div>

  <button class="btn btn-primary w-100 py-2" type="submit">S'inscrire</button>
</form>

<script src="public/js/inscription.js"></script>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/gabarit.php'; ?>