<?php

require_once "bd/bd.php";

class ModeleProvinces {
  public static function obtenirProvinces() {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      'SELECT provinces.*, pays.nom as pays_nom, villes.nom as capitale_nom
      FROM provinces
      INNER JOIN pays ON pays.id = provinces.pays_id
      INNER JOIN villes ON villes.id = provinces.capitale_villes_id
      ORDER BY nom'
    );

    $req->execute();

    return $req;
  }

  public static function obtenirProvincesSelonCodePays($codePays) {
    $connexion = BD::ObtenirConnexion();
    $req = $connexion->prepare(
      'SELECT provinces.*, pays.nom as pays_nom, villes.nom as capitale_nom
      FROM provinces
      INNER JOIN pays ON pays.id = provinces.pays_id
      INNER JOIN villes ON villes.id = provinces.capitale_villes_id
      WHERE pays.code = :code_pays
      ORDER BY provinces.nom'
    );

    $req->bindparam(':code_pays', $codePays);
    $req->execute();

    return $req;
  }
}
?>