<?php

require_once 'modele/modeleUtilisateurs.php';

function afficherConnexion() {
  require 'vue/connexion.php';
}

function afficherInscription() {
  require 'vue/inscription.php';
}

function inscrireUtilisateur() {
  if (!isset($_POST['email']) || !isset($_POST['motDePasse']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ||
    !preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{8,}/', $_POST['motDePasse'])) {
    header('Location: index.php?ressource=/inscription&erreur=Veuillez fournir un courriel et un mot de passe valide.');
    return;
  }

  $email = $_POST['email'];
  $motDePasse = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
  $requeteUtilisateur = ModeleUtilisateurs::obtenirUtilisateurParEmail($email);
  $utilisateur = $requeteUtilisateur->fetch();
  $requeteUtilisateur->closeCursor();

  // Si l'utilisateur n'existe pas, on l'inscrit
  if (!$utilisateur) {
    ModeleUtilisateurs::inscrireUtilisateur($email, $motDePasse);
  }

  connecterUtilisateur();
}

function connecterUtilisateur() {
  if (!isset($_POST['email']) || !isset($_POST['motDePasse'])) {
    header('Location: index.php?ressource=/connexion&erreur=Veuillez fournir un courriel et un mot de passe valide.');
    return;
  }

  $email = $_POST['email'];
  $motDePasse = $_POST['motDePasse'];
  $requeteUtilisateur = ModeleUtilisateurs::obtenirUtilisateurParEmail($email);
  $utilisateur = $requeteUtilisateur->fetch();
  $requeteUtilisateur->closeCursor();

  if (!$utilisateur || !password_verify($motDePasse, $utilisateur['mot_de_passe'])) {
    header('Location: index.php?ressource=/connexion&erreur=Courriel ou mot de passe invalide.');
    return;
  }

  $_SESSION['utilisateur'] = $utilisateur;

  header('Location: index.php?ressource=/');
}

function deconnecterUtilisateur() {
  unset($_SESSION['utilisateur']);
  session_destroy();

  header('Location: index.php?ressource=/');
}