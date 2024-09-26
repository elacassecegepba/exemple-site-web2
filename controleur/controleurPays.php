<?php

require_once 'modele/modelePays.php';
require_once 'modele/modeleProvinces.php';

function afficherProvinces()
{
  // Récupère toutes les données à afficher de la BD
  $requetePays = ModelePays::obtenirPays();
  $requeteProvinces = ModeleProvinces::obtenirProvinces();

  // La vue va utiliser les variables $requetePays et $requeteProvinces
  require_once 'vue/provinces.php';
}

function afficherProvincesSelonCodePays()
{
  // Vérifie qu'on a reçu un code de pays
  if (!isset($_GET["code_pays"])) {
    header('Location: index.php?ressource=/provinces');
  }

  // Récupère les infos du pays demandé
  $requetePays = ModelePays::obtenirPaysSelonCodePays($_GET["code_pays"]);
  $pays = $requetePays->fetch();

  // S'il n'y a pas de pays qui correspond au code reçu
  if (!$pays) {
    header('Location: index.php?ressource=/provinces');
  }

  // Récupère toutes les données à afficher de la BD
  $requetePays = ModelePays::obtenirPays();
  $requeteProvinces = ModeleProvinces::obtenirProvincesSelonCodePays($_GET["code_pays"]);

  // La vue va utiliser les variables $requetePays et $requeteProvinces
  require_once 'vue/provincesSelonCodePays.php';
}
