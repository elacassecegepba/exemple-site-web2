<?php $titreOnglet = 'Compteur'; ?>
<?php ob_start(); ?>

<?php $compteur = 1; ?>
<p>Compteur <strong>sans</strong> session : <?php echo $compteur; ?></p>
<?php $compteur++; ?>

<?php
// Si la variable n'existe pas on la crée
// Sinon, on incrémente sa valeur
if (!isset($_SESSION['compteur'])) {
  $_SESSION['compteur'] = 1;
} else {
  $_SESSION['compteur']++;
}
?>

<p>Compteur <strong>avec</strong> session : <?php echo $_SESSION['compteur']; ?></p>

<?php $contenu = ob_get_clean(); ?>
<?php require 'vue/gabarit.php'; ?>