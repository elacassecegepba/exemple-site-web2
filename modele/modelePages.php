<?php

require_once "bd/bd.php";

class ModelePages {
  public static function ObtenirPagesParLivreId($livreId) {
    $req = BD::ObtenirConnexion()->prepare(
      "SELECT * FROM pages WHERE livres_id = :livre_id"
    );

    $req->bindParam(':livre_id', $livreId);
    $req->execute();

    return $req;
  }

  public static function ObtenirPageParId($pageId) {
    $req = BD::ObtenirConnexion()->prepare(
      "SELECT pages.*, livres.dossier FROM pages
        INNER JOIN livres on livres.id = pages.livres_id
        WHERE pages.id = :page_id"
    );

    $req->bindParam(':page_id', $pageId);
    $req->execute();

    return $req;
  }

  public static function AjouterPage($livresId, $image) {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      "INSERT INTO `pages` (`livres_id`, `image`) VALUES
        (:livres_id, :image)"
    );

    $req->bindParam(':livres_id', $livresId);
    $req->bindParam(':image', $image);
    $req->execute();

    return $connexion->lastInsertId();
  }
}
?>