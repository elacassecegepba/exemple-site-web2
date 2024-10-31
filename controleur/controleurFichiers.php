<?php

require_once 'modele/ModeleImages.php';

define("DOSSIER_TELEVERSEMENT", "televersement/");
define("TAILLE_MAXIMAL_MB", "5");
define("TYPES_FICHIERS_AUTORISES", ['image/png' => 'png', 'image/jpeg' => 'jpg']);

function afficherFormulaireImage()
{
  require 'vue/formulaireImage.php';
}

function afficherImage()
{
  $requeteImages = ModeleImages::obtenirImage($_GET['id_image']);
  $image = $requeteImages->fetch();

  if (!$image) {
    http_response_code(404); // Not found
    throw new Exception("Aucune image ne correspond à l'id : " . $_GET['id_image']);
  }

  require 'vue/afficherImage.php';
}

function telechargerImage()
{
  if (!isset($_GET['id_image'])) {
    throw new Exception("Veuillez indiquer l'id de l'image");
  }

  $requeteImages = ModeleImages::obtenirImage($_GET['id_image']);
  $image = $requeteImages->fetch();

  if (!$image) {
    http_response_code(404); // Not found
    throw new Exception("Aucune image ne correspond à l'id : " . $_GET['id_image']);
  }

  telechargerFichier(DOSSIER_TELEVERSEMENT . $image['fichier'], $image['fichier']);
}

function televerserImage()
{
  if (isset($_POST['nonSecuritaire'])) {
    return televerserImageNonSecuritaire();
  }

  if (!isset($_POST['titre']) || strlen($_POST['titre']) < 3 || strlen($_POST['titre']) > 255) {
    header('Location: index.php?ressource=/formulaire-image&erreur=Veuillez remplir le formulaire');
    return;
  }

  // Validation et téléversement des fichiers
  $infosImages = preparerFichiersPourTeleversement(
    'image',
    DOSSIER_TELEVERSEMENT,
    TAILLE_MAXIMAL_MB,
    TYPES_FICHIERS_AUTORISES
  );

  // S'il y a eu une erreur lors du traitement du fichier.
  if (isset($infosImages['erreur'])) {
    // On redirige vers la page de publication et on affiche l'erreur.
    $msgErreur = $infosImages['erreur'];
    header('Location: index.php?ressource=/formulaire-image&erreur=' . $msgErreur);
    return;
  }

  // Ajout de l'image dans la BD.
  // preparerFichiersPourTeleversement() retourne toujours un tableau et
  // on a une image, donc on ajoute les infos de la 1ère image.
  $idImage = ModeleImages::AjouterImage($_POST['titre'], $infosImages[0]['nomComplet']);

  // Redirige vers la page d'affichage de l'image
  header('Location: index.php?ressource=/afficher-image/{id_image}&id_image=' . $idImage);
}


function televerserImageNonSecuritaire()
{
  if (!isset($_POST['titre']) || strlen($_POST['titre']) < 3 || strlen($_POST['titre']) > 255) {
    header('Location: index.php?ressource=/formulaire-image&erreur=Veuillez entrer le titre');
    return;
  }

  if (!move_uploaded_file($_FILES['image']['tmp_name'], 'public/televersement/' . $_FILES['image']['name'])) {
    header('Location: index.php?ressource=/formulaire-image&erreur=Une erreur est survenue lors du transfert de fichier');
    return;
  }

  // Redirige vers la page d'affichage de l'image
  header('Location: public/televersement');
}
