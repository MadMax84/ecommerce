-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 21 Octobre 2013 à 07:10
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `grindhouse`
--
CREATE DATABASE IF NOT EXISTS `grindhouse` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `grindhouse`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ID_admin` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`ID_admin`, `login`, `password`, `email`, `nom`, `prenom`) VALUES
(1, 'Mathieu', '0ee34f9d7c20017e14cf63a088f7f31f', 'mathieu.fancelli@gmail.com', 'Fancelli', 'Mathieu');

-- --------------------------------------------------------

--
-- Structure de la table `catalogue`
--

CREATE TABLE IF NOT EXISTS `catalogue` (
  `ID_catalogue` int(11) NOT NULL AUTO_INCREMENT,
  `cat_libelle` varchar(45) DEFAULT NULL,
  `cat_description` varchar(500) DEFAULT NULL,
  `genre_ID_genre` int(11) NOT NULL,
  PRIMARY KEY (`ID_catalogue`),
  KEY `fk_catalogue_genre1_idx` (`genre_ID_genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `catalogue`
--

INSERT INTO `catalogue` (`ID_catalogue`, `cat_libelle`, `cat_description`, `genre_ID_genre`) VALUES
(1, 'Chaussure', 'Notre catalogue de chaussure hiver', 2);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `ID_client` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `date_naissance` varchar(45) DEFAULT NULL,
  `civilite` varchar(45) DEFAULT NULL,
  `telephone` int(13) DEFAULT NULL,
  `num_facturation` varchar(45) DEFAULT NULL,
  `adresse_facturation` varchar(45) DEFAULT NULL,
  `cp_facturation` int(7) DEFAULT NULL,
  `ville_facturation` varchar(45) DEFAULT NULL,
  `num_livraison` varchar(45) DEFAULT NULL,
  `adresse_livraison` varchar(45) DEFAULT NULL,
  `cp_livraison` int(7) DEFAULT NULL,
  `ville_livraison` varchar(45) DEFAULT NULL,
  `pays` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `ID_commande` int(11) NOT NULL AUTO_INCREMENT,
  `clients_ID_client` int(11) NOT NULL,
  `produits_ID_produit` int(11) NOT NULL,
  `transports_ID_transport` int(11) NOT NULL,
  `taxes_ID_taxe` int(11) NOT NULL,
  PRIMARY KEY (`ID_commande`),
  KEY `fk_commandes_clients1_idx` (`clients_ID_client`),
  KEY `fk_commandes_produits1_idx` (`produits_ID_produit`),
  KEY `fk_commandes_transports1_idx` (`transports_ID_transport`),
  KEY `fk_commandes_taxes1_idx` (`taxes_ID_taxe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `ID_genre` int(11) NOT NULL,
  `homme` tinyint(1) DEFAULT NULL,
  `femme` tinyint(1) DEFAULT NULL,
  `all` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`ID_genre`, `homme`, `femme`, `all`) VALUES
(1, 1, 0, 0),
(2, 0, 1, 0),
(3, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `ID_image` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `adrImage1` varchar(255) DEFAULT NULL,
  `adrImage2` varchar(255) DEFAULT NULL,
  `adrImage3` varchar(255) DEFAULT NULL,
  `produits_ID_produit` int(11) NOT NULL,
  PRIMARY KEY (`ID_image`),
  KEY `fk_images_produits1_idx` (`produits_ID_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `ID_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `marque` varchar(45) DEFAULT NULL,
  `dimensions` varchar(45) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `nouveaute` tinyint(1) DEFAULT NULL,
  `genre_ID_genre` int(11) NOT NULL,
  PRIMARY KEY (`ID_produit`),
  KEY `fk_produits_genre1_idx` (`genre_ID_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `ID_promotion` int(11) NOT NULL AUTO_INCREMENT,
  `type_promo` varchar(45) DEFAULT NULL,
  `valeur` int(11) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `produits_ID_produit` int(11) NOT NULL,
  PRIMARY KEY (`ID_promotion`),
  KEY `fk_promotion_produits1_idx` (`produits_ID_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `IDslideshow` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `adrSlides` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`IDslideshow`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `slideshow`
--

INSERT INTO `slideshow` (`IDslideshow`, `libelle`, `description`, `adrSlides`) VALUES
(1, 'yuuko', 'yuuko', 'slideshow/Konachan.com-142137-clamp-ichihara-yuuko-mokona-tagme-xxxholic.jpg'),
(2, 'mokona', 'mokona', 'slideshow/Konachan.com-92543-cake-mokona-strawberry-tsubasa-reservoir-chronicle-xxxholic.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `souscatalogue`
--

CREATE TABLE IF NOT EXISTS `souscatalogue` (
  `ID_souscatalogue` int(11) NOT NULL AUTO_INCREMENT,
  `souscat_libelle` varchar(45) DEFAULT NULL,
  `souscat_description` varchar(500) DEFAULT NULL,
  `catalogue_ID_catalogue` int(11) NOT NULL,
  PRIMARY KEY (`ID_souscatalogue`),
  KEY `fk_sous-catalogue_catalogue_idx` (`catalogue_ID_catalogue`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `souscatalogue`
--

INSERT INTO `souscatalogue` (`ID_souscatalogue`, `souscat_libelle`, `souscat_description`, `catalogue_ID_catalogue`) VALUES
(1, 'Chaussure Bleu', 'Nos chaussures bleu', 1);

-- --------------------------------------------------------

--
-- Structure de la table `taxes`
--

CREATE TABLE IF NOT EXISTS `taxes` (
  `ID_taxe` int(11) NOT NULL,
  `taxe` float DEFAULT NULL,
  PRIMARY KEY (`ID_taxe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `transports`
--

CREATE TABLE IF NOT EXISTS `transports` (
  `ID_transport` int(11) NOT NULL,
  PRIMARY KEY (`ID_transport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vip`
--

CREATE TABLE IF NOT EXISTS `vip` (
  `ID_vip` int(11) NOT NULL AUTO_INCREMENT,
  `vip` tinyint(1) DEFAULT NULL,
  `clients_ID_client` int(11) NOT NULL,
  PRIMARY KEY (`ID_vip`),
  KEY `fk_vip_clients1_idx` (`clients_ID_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `catalogue`
--
ALTER TABLE `catalogue`
  ADD CONSTRAINT `fk_catalogue_genre1` FOREIGN KEY (`genre_ID_genre`) REFERENCES `genre` (`ID_genre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `fk_commandes_clients1` FOREIGN KEY (`clients_ID_client`) REFERENCES `clients` (`ID_client`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_commandes_produits1` FOREIGN KEY (`produits_ID_produit`) REFERENCES `produits` (`ID_produit`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_commandes_taxes1` FOREIGN KEY (`taxes_ID_taxe`) REFERENCES `taxes` (`ID_taxe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_commandes_transports1` FOREIGN KEY (`transports_ID_transport`) REFERENCES `transports` (`ID_transport`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_produits1` FOREIGN KEY (`produits_ID_produit`) REFERENCES `produits` (`ID_produit`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_produits_genre1` FOREIGN KEY (`genre_ID_genre`) REFERENCES `genre` (`ID_genre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `fk_promotion_produits1` FOREIGN KEY (`produits_ID_produit`) REFERENCES `produits` (`ID_produit`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `souscatalogue`
--
ALTER TABLE `souscatalogue`
  ADD CONSTRAINT `fk_sous-catalogue_catalogue` FOREIGN KEY (`catalogue_ID_catalogue`) REFERENCES `catalogue` (`ID_catalogue`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vip`
--
ALTER TABLE `vip`
  ADD CONSTRAINT `fk_vip_clients1` FOREIGN KEY (`clients_ID_client`) REFERENCES `clients` (`ID_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
