<?php

function afficherPageCompteur()
{
  require_once 'vue/compteur.php';
}

function afficherPageFormulaire()
{
  require_once 'vue/formulaire.php';
}

function ajouterValeurFormulaire()
{
  if (
    !isset($_POST['nomDuChamp']) ||
    strlen($_POST['nomDuChamp']) < 3 || strlen($_POST['nomDuChamp']) > 255
  ) {
    header('Location: index.php?ressource=/formulaire&erreur=Veuillez remplir le formulaire');
    return;
  }

  // Ajoute la valeur que l'utilisateur a entrée dans l'input 'nomDuChamp' dans les variables de session
  $_SESSION['valeurFormulaire'] = $_POST['nomDuChamp'];

  header('Location: index.php?ressource=/formulaire');
}

function detruireSession()
{
  session_unset();
  session_destroy();

  header('Location: index.php');
}
