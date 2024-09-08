DROP DATABASE IF EXISTS `bd_univers_de_mots`

/* utf8mb4 est nécessaire pour prendre en charge tous les caractères Unicode (English, Français, العربية, 汉语, עִבְרִית, ελληνικά, ភាសាខ្មែរ  et 👌😎😉😍❤️) */
/* utf8mb4_0900_ai_ci est basée sur les normes Unicode 9.0 et intègre les derniers développements en matière de tri et de comparaison de chaînes de caractères. Elle est "accent-insensitive" (ai) et "case-insensitive" (ci), ce qui signifie que les comparaisons de chaînes ne tiennent pas compte des accents ni de la casse. */
CREATE DATABASE IF NOT EXISTS `bd_univers_de_mots` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bd_univers_de_mots`;

/*
InnoDB est nécessaire pour :
  - Transactions ACID : Pour garantir la cohérence et la fiabilité des transactions.
  - Verrous de niveau ligne : Pour une meilleure gestion de la concurrence.
  - Clés étrangères : Pour assurer l'intégrité des relations entre les tables.
  - Récupération après crash : Pour minimiser les pertes de données après une panne.
  - Index Clustered : Pour améliorer l'efficacité des requêtes.
*/
SET default_storage_engine=InnoDB;

/*
Création des tables.
  - Nom en snake_case.
  - Nom des tables au pluriel.
  - Nom des colonnes au singulier.
  - Clé étrangère {nom_table}_id
  - Dans MySQL, NVARCHAR est un alias pour VARCHAR.
    Les deux se comportent de la même manière lorsqu'on utilise utf8mb4 comme charset,
    capable de gérer tous les caractères Unicode.
*/

DROP TABLE IF EXISTS `categories_livres`;
DROP TABLE IF EXISTS `pages`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `livres`;
DROP TABLE IF EXISTS `utilisateurs`;

/* Le mot de passe sera hashé avec password_hash (https://www.php.net/manual/fr/function.password-hash.php). */
/* La documentation recommande 255 caratères pour stocker le résultat de password_hash dans la BD. */
CREATE TABLE `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`email`)
);

CREATE TABLE `livres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_couverture` varchar(255) NOT NULL,
  `dossier` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs(id),
  UNIQUE (`dossier`)
);

CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `categories_livres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `livres_id` int NOT NULL,
  `categories_id` int NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (livres_id) REFERENCES livres(id),
  FOREIGN KEY (categories_id) REFERENCES categories(id)
);

CREATE TABLE `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `livres_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (livres_id) REFERENCES livres(id)
);

/* Insertion des données */
INSERT INTO `utilisateurs` (`email`, `mot_de_passe`) VALUES
	('test@example.com', '$2y$10$prWBjK/h1XPj1CwyI3RGsOuLuPruaJRObchlHiMuATMdquve2mYAW'), /* Password1! */
    ('example@test.com', '$2y$10$twI/.A.0V7RG.AO5yGyZ2uglORSkgijK.3.HjAjLZ.xzlTOFGP1Zq'); /* Password1! */

INSERT INTO `categories` (`categorie`) VALUES
    ('comedie'),
    ('action'),
    ('aventure'),
    ('drame');

INSERT INTO `livres` (`utilisateurs_id`, `titre`, `description`, `image_couverture`, `dossier`) VALUES
    ('1', 'Swords', 'In a world where everything is a sword, only the sharpest heroes survive! These are the tales of many different adventurers, living their lives in a realm corrupted by Seven Demon Swords.', 'swords.png', 'swords/'),
    ('2', 'Pixie and Brutus', 'This series focus\'s on the unlikely friendship between Pixie, a tiny, innocent, joyful kitten; and Brutus, a huge scar-faced retired military dog.', 'pixie-brutus.jpg', 'pixie-brutus/');

INSERT INTO `categories_livres` (`livres_id`, `categories_id`) VALUES
    ('1', '1'),
    ('1', '2'),
    ('1', '3'),
    ('2', '1');

INSERT INTO `pages` (`livres_id`, `image`) VALUES
    ('1', 'swords-1.jpg'),
    ('1', 'swords-2.jpg'),
    ('1', 'swords-3.jpg'),
    ('2', 'pixie-brutus-1.jpg'),
    ('2', 'pixie-brutus-2.jpg'),
    ('2', 'pixie-brutus-3.jpg'),
    ('2', 'pixie-brutus-4.jpg'),
    ('2', 'pixie-brutus-5.jpg');


