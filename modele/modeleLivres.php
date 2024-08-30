<?php

require_once "bd/bd.php";

class ModeleLivres {
  public static function ObtenirLivres() {
    $req = BD::ObtenirConnexion()->prepare(
      "SELECT * FROM livres"
    );

    $req->execute();

    return $req;
  }

  public static function ObtenirLivreParId($id) {
    $req = BD::ObtenirConnexion()->prepare(
      "SELECT * FROM livres WHERE id = :id"
    );

    $req->bindParam(':id', $id);
    $req->execute();

    return $req;
  }

  public static function ObtenirLivresParIdUtilisateur($utilisateurId) {
    $req = BD::ObtenirConnexion()->prepare(
      "SELECT * FROM livres WHERE utilisateurs_id = :utilisateurs_id"
    );

    $req->bindParam(':utilisateurs_id', $utilisateurId);
    $req->execute();

    return $req;
  }

  public static function AjouterLivres($utilisateurId, $titre, $description, $imageCouverture, $dossier) {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      "INSERT INTO `livres` (`utilisateurs_id`, `titre`, `description`, `image_couverture`, `dossier`) VALUES
        (:utilisateurs_id, :titre, :description, :image_couverture, :dossier)"
    );

    $req->bindParam(':utilisateurs_id', $utilisateurId);
    $req->bindParam(':titre', $titre);
    $req->bindParam(':description', $description);
    $req->bindParam(':image_couverture', $imageCouverture);
    $req->bindParam(':dossier', $dossier);
    $req->execute();

    return $connexion->lastInsertId();
  }

  public static function AjouterCategoriesLivres($livresId, $categoriesId) {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      "INSERT INTO `categories_livres` (`livres_id`, `categories_id`) VALUES
        (:livres_id, :categories_id)"
    );

    $req->bindParam(':livres_id', $livresId);
    $req->bindParam(':categories_id', $categoriesId);
    $req->execute();

    return $connexion->lastInsertId();
  }
}
?>