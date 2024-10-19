<?php

function genererMessage()
{
  $debutPhrases = [
    "Bonjour,",
    "Salut,",
    "Coucou,",
    "Hey,",
    "Yo,",
    "Hello,",
    "Bonsoir,",
    "Salut toi,",
    "Coucou toi,",
    "Hey toi,",
    "Yo toi,",
    "Hello toi,",
    "Bonjour toi,",
    "Salut les amis,",
    "Coucou les amis,",
    "Hey les amis,",
    "Yo les amis,",
    "Hello les amis,",
    "Bonsoir les amis,",
    "Salut tout le monde,"
  ];

  $milieuPhrases = [
    "comment ça va?",
    "prêt pour une nouvelle journée?",
    "on fait quoi aujourd'hui?",
    "ça bouge?",
    "comment s'est passée ta journée?",
    "quoi de neuf?",
    "tout roule?",
    "des nouvelles?",
    "quoi de beau?",
    "ça va bien?",
    "des plans pour ce soir?",
    "prêt pour l'aventure?",
    "comment tu te sens?",
    "besoin de parler?",
    "quelles sont les nouvelles?",
    "envie de sortir?",
    "des projets en vue?",
    "ça se passe comment?",
    "tu fais quoi de beau?",
    "ça va bien se passer?"
  ];

  $finPhrases = [
    "Passe une bonne journée!",
    "Profite bien!",
    "À plus tard!",
    "Bonne chance!",
    "Prends soin de toi!",
    "À bientôt!",
    "Bonne soirée!",
    "Amuse-toi bien!",
    "Bon courage!",
    "À demain!",
    "Bonne continuation!",
    "Bonnes vacances!",
    "Bonne matinée!",
    "Bonne après-midi!",
    "Bonne nuit!",
    "À la prochaine!",
    "Sois prudent!",
    "Reste positif!",
    "Prends du temps pour toi!",
    "Sois heureux!"
  ];

  $debut = $debutPhrases[array_rand($debutPhrases)];
  $milieu = $milieuPhrases[array_rand($milieuPhrases)];
  $fin = $finPhrases[array_rand($finPhrases)];

  return "$debut $milieu $fin";
}


function afficherPageMessages()
{
  $messages = [];
  for ($i = 0; $i < 5; $i++) {
    $messages[] = genererMessage();
  }

  require 'vue/message/pageMessages.php';
}

function afficherAutresMessages()
{
  if (!isset($_POST['nbMessages'])) {
    http_response_code(400);
    echo 'Nombre de messages non reçus';
    return;
  }

  $messages = [];
  for ($i = 0; $i < $_POST['nbMessages']; $i++) {
    $messages[] = genererMessage();
  }

  require 'vue/message/messages.php';
}
