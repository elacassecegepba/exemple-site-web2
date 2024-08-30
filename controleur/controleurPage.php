<?php

require_once 'modele/modelePages.php';

function telechargerPagesParId() {
  if (!isset($_GET['id'])) {
		http_response_code(400);
		return;
	}

	$requetePage = ModelePages::ObtenirPageParId($_GET['id']);
	$page = $requetePage->fetch();
	$requetePage->closeCursor();

	if (!$page) {
		http_response_code(404);
		return;
	}

	$nomFichier = $page['image'];
	$cheminFichier = 'televersement/' . $page['dossier']  . $nomFichier;

  telechargerFichier($cheminFichier, $nomFichier);
}
