SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `grindhouse` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `grindhouse` ;

-- -----------------------------------------------------
-- Table `grindhouse`.`admin`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`admin` (
  `ID_admin` INT NOT NULL ,
  `login` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `nom` VARCHAR(45) NULL ,
  `prenom` VARCHAR(45) NULL ,
  PRIMARY KEY (`ID_admin`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`genre`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`genre` (
  `ID_genre` INT NOT NULL ,
  `homme` TINYINT(1) NULL ,
  `femme` TINYINT(1) NULL ,
  `all` TINYINT(1) NULL ,
  PRIMARY KEY (`ID_genre`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`catalogue`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`catalogue` (
  `ID_catalogue` INT NOT NULL AUTO_INCREMENT ,
  `cat_libelle` VARCHAR(45) NOT NULL ,
  `cat_description` VARCHAR(500) NULL ,
  `cat_img` VARCHAR(255) NOT NULL ,
  `genre_ID_genre` INT NOT NULL ,
  PRIMARY KEY (`ID_catalogue`) ,
  INDEX `fk_catalogue_genre1_idx` (`genre_ID_genre` ASC) ,
  CONSTRAINT `fk_catalogue_genre1`
    FOREIGN KEY (`genre_ID_genre` )
    REFERENCES `grindhouse`.`genre` (`ID_genre` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`souscatalogue`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`souscatalogue` (
  `ID_souscatalogue` INT NOT NULL AUTO_INCREMENT ,
  `souscat_libelle` VARCHAR(45) NULL ,
  `souscat_description` VARCHAR(500) NULL ,
  `souscat_img` VARCHAR(255) NULL ,
  `catalogue_ID_catalogue` INT NOT NULL ,
  PRIMARY KEY (`ID_souscatalogue`) ,
  INDEX `fk_sous-catalogue_catalogue_idx` (`catalogue_ID_catalogue` ASC) ,
  CONSTRAINT `fk_sous-catalogue_catalogue`
    FOREIGN KEY (`catalogue_ID_catalogue` )
    REFERENCES `grindhouse`.`catalogue` (`ID_catalogue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`produits`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`produits` (
  `ID_produit` INT NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(45) NULL ,
  `description` VARCHAR(500) NULL ,
  `marque` VARCHAR(45) NULL ,
  `dimensions` VARCHAR(45) NULL ,
  `prix` INT NULL ,
  `quantite` INT NULL ,
  `nouveaute` TINYINT(1) NULL ,
  `genre_ID_genre` INT NOT NULL ,
  `souscatalogue_ID_souscatalogue` INT NOT NULL ,
  PRIMARY KEY (`ID_produit`) ,
  INDEX `fk_produits_genre1_idx` (`genre_ID_genre` ASC) ,
  INDEX `fk_produits_souscatalogue1_idx` (`souscatalogue_ID_souscatalogue` ASC) ,
  CONSTRAINT `fk_produits_genre1`
    FOREIGN KEY (`genre_ID_genre` )
    REFERENCES `grindhouse`.`genre` (`ID_genre` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produits_souscatalogue1`
    FOREIGN KEY (`souscatalogue_ID_souscatalogue` )
    REFERENCES `grindhouse`.`souscatalogue` (`ID_souscatalogue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`clients`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`clients` (
  `ID_client` INT NOT NULL AUTO_INCREMENT ,
  `pseudo` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `nom` VARCHAR(45) NULL ,
  `prenom` VARCHAR(45) NULL ,
  `date_naissance` VARCHAR(45) NULL ,
  `civilite` VARCHAR(45) NULL ,
  `telephone` INT(13) NULL ,
  `num_facturation` VARCHAR(45) NULL ,
  `adresse_facturation` VARCHAR(45) NULL ,
  `cp_facturation` INT(7) NULL ,
  `ville_facturation` VARCHAR(45) NULL ,
  `num_livraison` VARCHAR(45) NULL ,
  `adresse_livraison` VARCHAR(45) NULL ,
  `cp_livraison` INT(7) NULL ,
  `ville_livraison` VARCHAR(45) NULL ,
  `pays` VARCHAR(45) NULL ,
  PRIMARY KEY (`ID_client`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`vip`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`vip` (
  `ID_vip` INT NOT NULL AUTO_INCREMENT ,
  `vip` TINYINT(1) NULL ,
  `clients_ID_client` INT NOT NULL ,
  PRIMARY KEY (`ID_vip`) ,
  INDEX `fk_vip_clients1_idx` (`clients_ID_client` ASC) ,
  CONSTRAINT `fk_vip_clients1`
    FOREIGN KEY (`clients_ID_client` )
    REFERENCES `grindhouse`.`clients` (`ID_client` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`taxes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`taxes` (
  `ID_taxe` INT NOT NULL ,
  `taxe` FLOAT NULL ,
  PRIMARY KEY (`ID_taxe`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`promotion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`promotion` (
  `ID_promotion` INT NOT NULL AUTO_INCREMENT ,
  `type_promo` VARCHAR(45) NULL ,
  `valeur` INT NULL ,
  `dateDebut` DATE NULL ,
  `dateFin` DATE NULL ,
  `produits_ID_produit` INT NOT NULL ,
  PRIMARY KEY (`ID_promotion`) ,
  INDEX `fk_promotion_produits1_idx` (`produits_ID_produit` ASC) ,
  CONSTRAINT `fk_promotion_produits1`
    FOREIGN KEY (`produits_ID_produit` )
    REFERENCES `grindhouse`.`produits` (`ID_produit` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`images`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`images` (
  `ID_image` INT NOT NULL AUTO_INCREMENT ,
  `libelle` VARCHAR(45) NULL ,
  `description` VARCHAR(500) NULL ,
  `adrImage1` VARCHAR(255) NULL ,
  `adrImage2` VARCHAR(255) NULL ,
  `adrImage3` VARCHAR(255) NULL ,
  `produits_ID_produit` INT NOT NULL ,
  PRIMARY KEY (`ID_image`) ,
  INDEX `fk_images_produits1_idx` (`produits_ID_produit` ASC) ,
  CONSTRAINT `fk_images_produits1`
    FOREIGN KEY (`produits_ID_produit` )
    REFERENCES `grindhouse`.`produits` (`ID_produit` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`transports`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`transports` (
  `ID_transport` INT NOT NULL ,
  PRIMARY KEY (`ID_transport`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`commandes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`commandes` (
  `ID_commande` INT NOT NULL AUTO_INCREMENT ,
  `clients_ID_client` INT NOT NULL ,
  `produits_ID_produit` INT NOT NULL ,
  `transports_ID_transport` INT NOT NULL ,
  `taxes_ID_taxe` INT NOT NULL ,
  PRIMARY KEY (`ID_commande`) ,
  INDEX `fk_commandes_clients1_idx` (`clients_ID_client` ASC) ,
  INDEX `fk_commandes_produits1_idx` (`produits_ID_produit` ASC) ,
  INDEX `fk_commandes_transports1_idx` (`transports_ID_transport` ASC) ,
  INDEX `fk_commandes_taxes1_idx` (`taxes_ID_taxe` ASC) ,
  CONSTRAINT `fk_commandes_clients1`
    FOREIGN KEY (`clients_ID_client` )
    REFERENCES `grindhouse`.`clients` (`ID_client` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commandes_produits1`
    FOREIGN KEY (`produits_ID_produit` )
    REFERENCES `grindhouse`.`produits` (`ID_produit` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commandes_transports1`
    FOREIGN KEY (`transports_ID_transport` )
    REFERENCES `grindhouse`.`transports` (`ID_transport` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commandes_taxes1`
    FOREIGN KEY (`taxes_ID_taxe` )
    REFERENCES `grindhouse`.`taxes` (`ID_taxe` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grindhouse`.`slideshow`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `grindhouse`.`slideshow` (
  `IDslideshow` INT NOT NULL AUTO_INCREMENT ,
  `libelle` VARCHAR(45) NULL ,
  `description` VARCHAR(255) NULL ,
  `adrSlides` VARCHAR(500) NULL ,
  PRIMARY KEY (`IDslideshow`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
