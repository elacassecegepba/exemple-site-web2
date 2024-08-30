<?php

require_once "bd/bd.php";

class ModeleCategories {
  public static function ObtenirCategories() {
    $req = BD::ObtenirConnexion()->prepare(
      "SELECT * FROM categories"
    );

    $req->execute();

    return $req;
  }
}
?>