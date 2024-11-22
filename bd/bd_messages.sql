DROP DATABASE IF EXISTS `bd_messages`;

CREATE DATABASE IF NOT EXISTS `bd_messages` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bd_messages`;

SET default_storage_engine=InnoDB;

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `texte` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);
