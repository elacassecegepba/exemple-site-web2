<?php

require_once "bd/bd.php";

class ModeleUtilisateurs {
  public static function inscrireUtilisateur($email, $motDePasse) {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      "INSERT INTO utilisateurs (email, mot_de_passe) VALUES (:email, :mot_de_passe)"
    );

    $req->bindParam(':email', $email);
    $req->bindParam(':mot_de_passe', $motDePasse);
    $req->execute();

    return $connexion->lastInsertId();
  }

  public static function obtenirUtilisateurParEmail($email) {
    $req = BD::ObtenirConnexion()->prepare(
      "SELECT * FROM utilisateurs WHERE email = :email"
    );

    $req->bindParam(':email', $email);
    $req->execute();

    return $req;
  }
}
?>