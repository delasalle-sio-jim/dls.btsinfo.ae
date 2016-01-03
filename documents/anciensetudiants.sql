-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 13 Novembre 2015 à 00:53
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

CREATE TABLE ae_administrateurs (
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
(1, 'jean.michel.cartron@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Jean-Michel', 'CARTRON'),
(2, 'cat-legendre@wanadoo.fr', '21232f297a57a5a743894a0e4a801fc3', 'Catherine', 'LEGENDRE'),
(3, 'bouvier.samuel@free.fr', '21232f297a57a5a743894a0e4a801fc3', 'Samuel', 'BOUVIER');

-- --------------------------------------------------------

--
-- Structure de la table 'ae_eleves'
--

CREATE TABLE ae_eleves (
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
  dateDerniereMAJ timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table 'ae_eleves'
--

INSERT INTO ae_eleves (id, nom, prenom, sexe, anneeDebutBTS, tel, adrMail, rue, codePostal, ville, entreprise, idFonction, compteAccepte, motDePasse, dateDerniereMAJ) VALUES
(1, 'CARTRON', 'Jean-Michel', 'H', '1990', '02.99.87.12.12', 'jean.michel.cartron@gmail.com', '5 rue de la Motte Brulon', '35700', 'RENNES', 'Lycée De La Salle - Rennes', 7, 1, 'b89f7a5ff3e3a225d572dac38b2a67f7', '2015-11-11 21:29:42'),
(2, 'FONFEC', 'Sophie', 'F', '2005', '11.22.33.44.55', 'sophie.fonfec@gmail.com', '1, rue de la mairie', '35000', 'RENNES', 'Orange', 1, 0, 'b89f7a5ff3e3a225d572dac38b2a67f7', '2015-11-12 15:28:22');

-- --------------------------------------------------------

--
-- Structure de la table 'ae_fonctions'
--

CREATE TABLE ae_fonctions (
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

CREATE TABLE ae_inscriptions (
  id int(11) NOT NULL,
  dateInscription date NOT NULL,
  nbrePersonnes int(11) NOT NULL,
  montantRegle decimal(10,0) NOT NULL,
  idEleve int(11) NOT NULL,
  idSoiree int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table 'ae_soirees'
--

CREATE TABLE ae_soirees (
  id int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  nomRestaurant varchar(50) NOT NULL,
  adresse varchar(150) NOT NULL,
  tarif decimal(10,0) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
