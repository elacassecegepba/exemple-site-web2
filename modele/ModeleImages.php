<?php

require_once "bd/bd.php";

class ModeleImages {
  public static function ajouterImage($titre, $fichier) {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      "INSERT INTO `images` (`titre`, `fichier`) VALUES
      (:titre, :fichier)"
    );

    $req->bindParam(':titre', $titre);
    $req->bindParam(':fichier', $fichier);
    $req->execute();

    return $connexion->lastInsertId();
  }

  public static function obtenirImages() {
    $req = BD::ObtenirConnexion()->prepare(
      "SELECT * FROM images"
    );

    $req->execute();

    return $req;
  }

  public static function obtenirImage($id) {
    $req = BD::ObtenirConnexion()->prepare(
      "SELECT * FROM images WHERE id = :id"
    );

    $req->bindParam(':id', $id);
    $req->execute();

    return $req;
  }
}
