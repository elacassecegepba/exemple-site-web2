<?php

require_once 'modele/modeleMessages.php';

function afficherMessages()
{
  // Récupère tous les messages de la BD.
  $requeteMessages = ModeleMessages::obtenirMessages();

  // Affiche les messages.
  require_once 'vue/messages.php';
}

function ajouterMessage() {
  if (!isset($_POST['texte']) || strlen($_POST['texte']) < 3 || strlen($_POST['texte']) > 255) {
    http_response_code(400);
    echo 'Veuillez inscrire un message';
    return;
  }

  $idMessage = ModeleMessages::ajouterMessage($_POST['texte']);

  echo "Le message a été ajouter avec l'id : $idMessage";
}