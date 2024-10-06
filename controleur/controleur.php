<?php

function afficherPageDefaut()
{
  afficherAccueil();
}

function afficherAccueil()
{
  require_once 'vue/accueil.php';
}

function afficherChronometre()
{
  require "vue/chronometre.php";
}
