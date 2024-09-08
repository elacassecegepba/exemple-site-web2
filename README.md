# Univers de mots

Exemple d'un formulaire simple

## Fichiers importants
- Routeur
  - [index](index.php)
    - Appel de la bonne fonction du contrôleur selon la ressource et la méthode de la requête.
- Controleur
  - [controleurFormulaire](controleur/controleurFormulaire.php)
    - Gestion affichage du formulaire : `afficherPageFormulaire`.
    - Récupération et validation (côté serveur) des données soumises : `ajouterElementFormulaire`.
- Vue
  - [menu](vue/menu.php)
    - Bouton permettant d'accéder à la page du formulaire :
      ```php
      <a class="nav-link <?php NavClass("/formulaire"); ?>" href="index.php?ressource=/formulaire">Formulaire</a>
      ```
  - [formulaire](vue/formulaire.php)
    - Formulaire de type [Floating labels](https://getbootstrap.com/docs/5.3/forms/floating-labels/) avec [validation côté client](https://getbootstrap.com/docs/5.3/forms/validation/).
  - [affichageDonneesFormulaire](vue/affichageDonneesFormulaire.php)
    - Affichage des données soumises (`$_POST`).

