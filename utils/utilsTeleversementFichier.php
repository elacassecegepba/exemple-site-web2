<?php

/**
 * Prépare les fichiers d'un input pour pouvoir les ajouter à la BD.
 *
 * @param string  $nomInput              Le nom de l'input (\<input name="nomInput">).
 * @param string  $dossierTeleversement  Le chemin du dossier où placer les fichiers.
 * @param int     $tailleMaximaleMB      La taille maximale d'un fichier en MB.
 * @param array   $typesAutorises       Un tableau des types de fichiers authorisés et leur extension.
 *                                       Ex. : ['image/png' => 'png', 'image/jpeg' => 'jpg']
 */
function preparerFichiersPourTeleversement($nomInput, $dossierTeleversement, $tailleMaximaleMB, $typesAutorises) {
	$infosValidation = validerFichiers(
		$nomInput, $tailleMaximaleMB, $typesAutorises
	);
  // Si un fichier n'est pas valide, on retourne l'erreur.
	if (!empty($infosValidation['erreur'])) {
		return $infosValidation;
	}

  $resultat = [];
  for ($i=0; $i < sizeof($infosValidation); $i++) { 
    $infosFichier = $infosValidation[$i];

    // On donne un nom aléatoire au fichier pour ne pas écraser un fichier existant.
	  $infosCheminFichier = obtenirCheminFichierUnique($dossierTeleversement, '.' . $infosFichier['extension']);

    // On renomme le fichier et on le déplace vers le dossier voulu.
    if (!move_uploaded_file($infosFichier['tmp_name'], $infosCheminFichier['chemin'])) {
      return ['erreur' => 'Une erreur est survenue lors du transfert de fichier.'];
    }

    // Retourne l'information nécessaire pour retrouver le fichier.
    $resultat[] = [
      'nom' => $infosCheminFichier['nom'],
      'nomComplet' => $infosCheminFichier['nomComplet'],
      'extension' => $infosFichier['extension'],
      'chemin' => $infosCheminFichier['chemin'],
      'nomOriginal' => basename($infosFichier['name'])
    ];
  }

  return $resultat;
}

function obtenirCheminFichierUnique($dossierParent, $suffixe = '/') {
  // On s'assure d'avoir un / entre le dossierParent et le nouveau fichier/dossier
  if (substr($dossierParent, -1) !== '/') {
    $dossierParent .= '/';
  }
  
  // Dans un environnement de production, on utiliserait un GUID au lieu de uniqid
  do {
    $nouveauNom = uniqid('', true);
    $nouveauChemin = $dossierParent . $nouveauNom . $suffixe;
  } while (file_exists($nouveauChemin));

  return [
		'nom' => $nouveauNom,
    'nomComplet' => $nouveauNom . $suffixe,
		'chemin' => $nouveauChemin,
	];
}

function validerFichiers($nomInput, $tailleMaximaleMB, $typesAutorises) {
	// On regarde si on a reçu un fichier.
	// $nomInput est le name de l'input de type file.
	if (!isset($_FILES[$nomInput])) {
		return ['erreur' => 'Au moins un fichier est manquant.'];
	}

  $fichiers = [];
  // La façon dont les données sont présentées est différente si on a un ou plusieurs fichiers.
  // On va harminoser cela.
  if (is_array($_FILES[$nomInput]['name'])) {
    $nombreDeFichiers = sizeof($_FILES[$nomInput]['name']);
    for ($i=0; $i < $nombreDeFichiers; $i++) {
      $fichiers[] = [
        'name' => $_FILES[$nomInput]['name'][$i],
        'type' => $_FILES[$nomInput]['type'][$i],
        'tmp_name' => $_FILES[$nomInput]['tmp_name'][$i],
        'error' => $_FILES[$nomInput]['error'][$i],
        'size' => $_FILES[$nomInput]['size'][$i],
      ];
    }
  } else {
    $fichiers[] = [
      'name' => $_FILES[$nomInput]['name'],
      'type' => $_FILES[$nomInput]['type'],
      'tmp_name' => $_FILES[$nomInput]['tmp_name'],
      'error' => $_FILES[$nomInput]['error'],
      'size' => $_FILES[$nomInput]['size'],
    ];
  }

  $resultat = [];
  $erreurs = [];
  for ($i = 0; $i < sizeof($fichiers); $i++) {
    // Lorsque PHP reçoit un fichier, il le place dans un dossier temporaire avec un nom autogénéré.
    // $fichier['tmp_name'] permet de récupérer le chemin d'accès à ce fichier.
    $infosFichier = $fichiers[$i];
    $validation = validerFichier($infosFichier, $tailleMaximaleMB, $typesAutorises);

    $resultat[$i] = array_merge($validation, $infosFichier);
    if (isset($validation['erreur'])) {
      $erreurs[$i] = $validation['erreur'];
    }
  }

  if (!empty($erreurs)) {
    $resultat['erreur'] = $erreurs[0];
    $resultat['erreurs'] = $erreurs;
  }

  return $resultat;
}

function validerFichier($infosFichier, $tailleMaximaleMB, $typesAutorises) {
  // Est-ce qu'il y a eu une erreur lors du téléversement
  if (!empty($infosFichier['error'])) {
		return ['erreur' => 'Une erreur est survenue.'];
  }

  // Nous ne pouvons pas nous fier aux informations transmise par l'utilisateur, donc
  // nous allons les déterminer directement à partir du fichier.
  // On calcul la taille du fichier.
  $cheminFichier = $infosFichier['tmp_name'];
	$tailleFichier = filesize($cheminFichier);
  // On récupère le type du fichier.
	$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
	$typeFichier = finfo_file($fileinfo, $cheminFichier);

	if ($tailleFichier === 0) {
		return ['erreur' => 'Au moins un fichier est vide.'];
	}

  $tailleMaximaleBytes = 1024 * 1024 * $tailleMaximaleMB; 
	if ($tailleFichier > $tailleMaximaleBytes) {
		return ['erreur' => 'Au moins un fichier dépasse la limite de ' . $tailleMaximaleMB . 'MB.'];
	}

	if (!in_array($typeFichier, array_keys($typesAutorises))) {
		return ['erreur' => "Au moins un fichier n'est pas supporté."];
	}

  // Si nous sommes rendus ici, c'est que le fichier respecte nos validations.
	return [
		'extension' => $typesAutorises[$typeFichier]
	];
}