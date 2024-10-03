<?php

// ************************************************
// Démarrage de la session. Ainsi, on peut
// utiliser les variables de session partout dans
// l'application.
// ************************************************

session_start();

// ************************************************
// Importation des fichiers nécessaires
// ************************************************

require 'utils/utils.php';
require 'controleur/controleur.php';
require 'controleur/controleurFormulaire.php';

// ************************************************
// Vous n'avez rien à modifier dans le try catch
// ************************************************

try {
	// .htaccess envoie toutes les requêtes à index.php sauf pour ce qui est dans le dossier public (js, css, image, etc.).
	// Cependant l'URL dans le navigateur de l'utilisateur reste la mauvaise.
	// Donc, si la requête n'a pas été faite à index.php, on redirige vers index.php.
	$urlVersIndex = str_replace($_SERVER['DOCUMENT_ROOT'], "", str_replace("\\", "/", __FILE__));

	if (isset($_SERVER["REDIRECT_URL"]) && $_SERVER["REDIRECT_URL"] !== $urlVersIndex) {
		$urlAbsolueDeIndex = $_SERVER["HTTP_HOST"] . $urlVersIndex;
		$parametresGET = !empty($_SERVER["QUERY_STRING"]) ? '?' . $_SERVER["QUERY_STRING"] : "";
		$urlRedirectionAbsolue = $_SERVER["REQUEST_SCHEME"] . '://' . $urlAbsolueDeIndex . $parametresGET;
		header('Location: ' . $urlRedirectionAbsolue);
		return;
	}

	switch ($_SERVER['REQUEST_METHOD']) {
		case 'GET':
			gererRequetesGet();
			break;
		case 'POST':
			if (!isset($_GET['methode'])) {
				throw new Exception('404 : Veuillez spécifier la méthode');
			}
			switch (strtoupper($_GET['methode'])) {
				case "POST":
					gererRequetesPost();
					break;
				case "PUT":
					gererRequetesPut();
					break;
				case "DELETE":
					gererRequetesDelete();
					break;
				default:
					throw new Exception("404 : Méthode non supportée");
			}
			break;
		default:
			throw new Exception("404 : Méthode non supportée");
	}
} catch (PDOException $ex) {
	$msgErreur = $ex->getMessage();
	require 'vue/erreur.php';
} catch (Exception $ex) {
	$msgErreur = $ex->getMessage();
	require 'vue/erreur.php';
}

// ************************************************
// Ajoutez vos routes dans les functions suivantes :
// ************************************************

function gererRequetesGet()
{
	if (!isset($_GET['ressource'])) {
		return afficherPageDefaut();
	}

	switch ($_GET['ressource']) {
		case '/':
			afficherAccueil();
			break;
		case '/formulaire':
			afficherPageFormulaire();
			break;
		default:
			throw new Exception("404 : La page que vous recherchez n'existe pas");
	}
}

function gererRequetesPost()
{
	if (!isset($_GET['ressource'])) {
		throw new Exception("404 : Veuillez spécifier la ressource à ajouter");
	}

	switch ($_GET['ressource']) {
		case '/formulaire':
			ajouterElementFormulaire();
			break;
		default:
			throw new Exception("404 : Impossible d'ajouter ce type de ressource");
	}
}

function gererRequetesPut()
{
	if (!isset($_GET['ressource'])) {
		throw new Exception("404 : Veuillez spécifier la ressource à modifier");
	}

	switch ($_GET['ressource']) {
		default:
			throw new Exception("404 : Impossible de modifier ce type de ressource");
	}
}

function gererRequetesDelete()
{
	if (!isset($_GET['ressource'])) {
		throw new Exception("404 : Veuillez spécifier la ressource à supprimer");
	}

	switch ($_GET['ressource']) {
		default:
			throw new Exception("404 : Impossible de supprimer ce type de ressource");
	}
}
