<?php

require_once "bd/bd.php";

class ModelePays {
  public static function obtenirPays() {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      'SELECT * FROM pays ORDER BY nom'
    );

    $req->execute();

    return $req;
  }

  public static function obtenirPaysSelonCodePays($codePays) {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      'SELECT * FROM pays WHERE code = :code_pays'
    );

    $req->bindparam(':code_pays', $codePays);
    $req->execute();

    return $req;
  }
}
?>