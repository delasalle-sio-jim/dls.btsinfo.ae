-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 16 Novembre 2015 à 23:54
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  'anciensetudiants'
--

-- --------------------------------------------------------

--
-- Structure de la table 'ae_administrateurs'
--

CREATE TABLE IF NOT EXISTS ae_administrateurs (
  id int(11) NOT NULL AUTO_INCREMENT,
  adrMail varchar(75) NOT NULL,
  motDePasse varchar(40) NOT NULL,
  prenom varchar(30) NOT NULL,
  nom varchar(30) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table 'ae_administrateurs'
--

INSERT INTO ae_administrateurs (id, adrMail, motDePasse, prenom, nom) VALUES
(1, 'jean.michel.cartron@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Jean-Michel', 'CARTRON'),
(2, 'cat-legendre@wanadoo.fr', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Catherine', 'LEGENDRE'),
(3, 'bouvier.samuel@free.fr', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Samuel', 'BOUVIER');

-- --------------------------------------------------------

--
-- Structure de la table 'ae_eleves'
--

CREATE TABLE IF NOT EXISTS ae_eleves (
  id int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(30) NOT NULL,
  prenom varchar(30) NOT NULL,
  sexe varchar(1) NOT NULL,
  anneeDebutBTS varchar(4) NOT NULL,
  tel varchar(14) DEFAULT NULL,
  adrMail varchar(50) NOT NULL,
  rue varchar(80) DEFAULT NULL,
  codePostal varchar(5) DEFAULT NULL,
  ville varchar(30) DEFAULT NULL,
  entreprise varchar(50) DEFAULT NULL,
  idFonction int(11) NOT NULL,
  compteAccepte tinyint(1) NOT NULL,
  motDePasse varchar(40) DEFAULT NULL,
  etudesPostBTS varchar(150) DEFAULT NULL,
  dateDerniereMAJ timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table 'ae_eleves'
--

INSERT INTO ae_eleves (id, nom, prenom, sexe, anneeDebutBTS, tel, adrMail, rue, codePostal, ville, entreprise, idFonction, compteAccepte, motDePasse, etudesPostBTS, dateDerniereMAJ) VALUES
(1, 'CARTRON', 'Jean-Michel', 'H', '1990', '02.99.87.12.12', 'jean.michel.cartron@gmail.com', '5 rue de la Motte Brulon', '35700', 'RENNES', 'Lycée De La Salle - Rennes', 7, 1, 'd83177daa22aeba3081abf055f98fd39cb8ecf4a', NULL, '2015-11-11 21:29:42'),
(4, 'FONFEC', 'Sophie', 'F', '2005', '11.22.33.44.55', 'sophie.fonfec@gmail.com', '1, rue de la mairie', '35000', 'RENNES', 'Orange', 1, 0, 'd83177daa22aeba3081abf055f98fd39cb8ecf4a', 'Bachelor Informatique "Systèmes, Réseaux et Cloud Computing" au Lycée De La Salle', '2015-11-15 19:16:48'),
(5, 'CARTRON', 'Jim', 'H', '1990', '11.22.33.44.55', 'jeanmichelcartron@gmail.com', '6, rue François Mauriac', '35760', 'St GREGOIRE', 'Lycée De La Salle - Rennes', 7, 0, 'd83177daa22aeba3081abf055f98fd39cb8ecf4a', 'Bachelor Informatique "Systèmes, Réseaux et Cloud Computing" au Lycée De La Salle', '2015-11-16 18:49:05');

-- --------------------------------------------------------

--
-- Structure de la table 'ae_fonctions'
--

CREATE TABLE IF NOT EXISTS ae_fonctions (
  id int(11) NOT NULL AUTO_INCREMENT,
  libelle varchar(40) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table 'ae_fonctions'
--

INSERT INTO ae_fonctions (id, libelle) VALUES
(1, 'Etudiant actuellement en BTS'),
(2, 'Etudiant actuellement en post-BTS'),
(3, 'Recherche d''emploi'),
(4, 'Développeur'),
(5, 'Technicien ou administrateur réseau'),
(6, 'Chef de projet'),
(7, 'Formateur'),
(8, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table 'ae_inscriptions'
--

CREATE TABLE IF NOT EXISTS ae_inscriptions (
  id int(11) NOT NULL AUTO_INCREMENT,
  dateInscription date NOT NULL,
  nbrePersonnes int(11) NOT NULL,
  montantRegle decimal(10,0) NOT NULL,
  montantRembourse decimal(10,0) NOT NULL DEFAULT '0',
  idEleve int(11) NOT NULL,
  idSoiree int(11) NOT NULL,
  inscriptionAnnulee tinyint(1) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table 'ae_soirees'
--

CREATE TABLE IF NOT EXISTS ae_soirees (
  id int(11) NOT NULL AUTO_INCREMENT,
  dateSoiree date NOT NULL,
  nomRestaurant varchar(50) NOT NULL,
  adresse varchar(150) NOT NULL,
  tarif decimal(10,0) NOT NULL,
  lienMenu varchar(100) DEFAULT NULL,
  latitude double NOT NULL DEFAULT '0',
  longitude double NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Contenu de la table 'ae_soirees'
--

INSERT INTO ae_soirees (id, dateSoiree, nomRestaurant, adresse, tarif, lienMenu, latitude, longitude) VALUES
(1, '2016-11-04', 'Cot'' et Boeuf', '1 Ter Route de Fougères, 35510 Cesson-Sévigné', '22', 'http://www.pagesjaunes.fr/pros/51832422', 48.1326846, -1.6339654);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
