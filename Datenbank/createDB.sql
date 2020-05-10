-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema webdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `webdb` DEFAULT CHARACTER SET utf8 ;
USE `webdb` ;



-- -----------------------------------------------------
-- Table `webdb`.`GENRE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdb`.`GENRE` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `genre_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `webdb`.`ACCOUNT`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdb`.`ACCOUNT` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `treuepunkte` INT NOT NULL,
  PRIMARY KEY (`id`)
  )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `webdb`.`KUNDE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdb`.`KUNDE` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `vorname` VARCHAR(45) NOT NULL,
  `nachname` VARCHAR(45) NOT NULL,
  `geburtsdatum` DATE NOT NULL,
  `nummer` INT NOT NULL,
  `bundesland` VARCHAR(45) NOT NULL,
  `plz` VARCHAR(5) NOT NULL,
  `ort` VARCHAR(45) NOT NULL,
  `strasse` VARCHAR(45) NOT NULL,
  `hausnummer` varchar(50) not null,
  `account_id` int not null,
  PRIMARY KEY (`id`),
  constraint FK_kunde_account FOREIGN KEY(`account_id`)
  REFERENCES `webdb`.`ACCOUNT`(`id`)
  )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `webdb`.`KUNDEN_INTERESSE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdb`.`KUNDEN_INTERESSE` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `genre` VARCHAR(45) NOT NULL,
  `ausgeliehen` INT NOT NULL,
  `gekauft` INT NOT NULL,
  `kunden_id` int not null,
  PRIMARY KEY (`id`),
  CONSTRAINT FK_kunden_interesse FOREIGN KEY(`kunden_id`)
  REFERENCES `webdb`.`KUNDE` (`id`)
  )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webdb`.`PRODUKT`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdb`.`PRODUKT` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `author` VARCHAR(45) NOT NULL,
  `verlag` VARCHAR(45) NOT NULL,
  `isbn` VARCHAR(45) NOT NULL,
  `preis` FLOAT NOT NULL,
  `genre_id` int NOT NULL,
  PRIMARY KEY (`id`),
  constraint FK_produkt_genre FOREIGN KEY(`genre_id`)
  REFERENCES `webdb`.`GENRE`(`id`)
  )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `webdb`.`BESTELLUNGEN`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webdb`.`BESTELLUNGEN` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `account_id` int not null,
  `bestelldatum` DATETIME NOT NULL,
  `produkt_id`int not null,
  PRIMARY KEY (`id`),
  constraint FK_bestellungen_produkt FOREIGN KEY (`produkt_id`)
  REFERENCES `webdb`.`PRODUKT`(`id`),
  constraint FK_account_bestellung FOREIGN Key (`account_id`)
  REFERENCES `webdb`.`ACCOUNT`(`id`)
  )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
