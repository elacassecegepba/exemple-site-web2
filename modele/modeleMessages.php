<?php

require_once "bd/bd.php";

class ModeleMessages {
  public static function obtenirMessages() {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      "SELECT * FROM messages"
    );

    $req->execute();

    return $req;
  }

  public static function obtenirMessageParId($id) {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      "SELECT * FROM messages WHERE id = :id"
    );

    $req->bindParam(':id', $id);
    $req->execute();

    return $req;
  }

  public static function ajouterMessage($texte) {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      "INSERT INTO `messages` (`texte`)
       VALUES (:texte)"
    );

    $req->bindParam(':texte', $texte);
    $req->execute();

    return $connexion->lastInsertId();
  }
}
?>