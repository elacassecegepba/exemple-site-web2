<?php

function afficherPageFormulaire()
{
  require_once 'vue/formulaire.php';
}

function ajouterElementFormulaire()
{
  // Modifiez la validation côté client avec les DevTools (F12) du navigateur et
  // envoyez de mauvaises données pour voir l'utilité de cette validation.
  if (
    !isset($_POST["nomDuChamp"]) || // Est-ce qu'on a reçu un paramètre "nomDuChamp" (voir le name de l'input).
    strlen($_POST["nomDuChamp"]) < 3 || strlen($_POST["nomDuChamp"]) > 255 // Est-ce que la valeur du paramètre "nomDuChamp" a entre 3 (minlength) et 255 (maxlength) caractères. 
  ) {
    header("Location: index.php?ressource=/formulaire&erreur=Veuillez remplir le formulaire.");
    return;
  }

  require_once 'vue/affichageDonneesFormulaire.php';
}
