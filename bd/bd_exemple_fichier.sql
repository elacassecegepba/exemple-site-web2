CREATE DATABASE IF NOT EXISTS `bd_exemple_fichier` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bd_exemple_fichier`;

SET default_storage_engine=InnoDB;

CREATE TABLE `images` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(255) NOT NULL,
  `fichier` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `images` (`titre`, `fichier`) VALUES
('Nerd and Jock', 'couverture.png');