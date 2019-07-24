SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Units`;
CREATE TABLE `Units` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Unite` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Symbol` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `Node`;
CREATE TABLE `Node` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Lat` float(10,6) NOT NULL,
  `Long` float(10,6) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `Sensor`;
CREATE TABLE `Sensor` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_IdNode` int(11) NOT NULL,
  `fk_IdUnits` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_IdNode` (`fk_IdNode`),
  KEY `fk_IdUnits` (`fk_IdUnits`),
  CONSTRAINT `Sensor_ibfk_1` FOREIGN KEY (`fk_IdNode`) REFERENCES `Node` (`Id`) ON DELETE CASCADE,
  CONSTRAINT `Sensor_ibfk_2` FOREIGN KEY (`fk_IdUnits`) REFERENCES `Units` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `Data`;
CREATE TABLE `Data` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` datetime NOT NULL,
  `Value` int(11) NOT NULL,
  `fk_IdNode` int(11) NOT NULL,
  `fk_IdUnits` int(11) NOT NULL,
  `fk_IdSensor` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_IdUnits` (`fk_IdUnits`),
  KEY `fk_IdNode` (`fk_IdNode`),
  KEY `fk_IdSensor` (`fk_IdSensor`),
  CONSTRAINT `Data_ibfk_4` FOREIGN KEY (`fk_IdSensor`) REFERENCES `Sensor` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `Utilisateurs`;
CREATE TABLE `Utilisateurs` (
  `Login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `Ville`;
CREATE TABLE `Ville` (
  `Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Adresse` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Code_postal` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Numero` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Latitude` float(10,6) NOT NULL,
  `Longitude` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `Accueil`;
CREATE TABLE `Accueil` (
  `Titre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contenu` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `Proprietaire`;
CREATE TABLE `Proprietaire` (
`Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`Prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`Statut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`Adresse` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`Code postal` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
`Ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `Hebergeur`;
CREATE TABLE `Hebergeur` (
`Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`Adresse` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`Code postal` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
`Ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `Responsable`;
CREATE TABLE `Responsable` (
`Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`Prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`Contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `Webmaster`;
CREATE TABLE `Webmaster` (
`Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`Prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`Contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `Createur`;
CREATE TABLE `Createur` (
`Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
`URL` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Units` (`Id`, `Label`, `Unite`, `Symbol`) VALUES
(1,	'Temperature',	'Degrés Celcius',	'°C'),
(2,	'Pression',	'Hectopascal',	'Hpa'),
(3,	'Consommation electrique',	'KiloWatt par heure',	'KW/h'),
(4,	'Vitesse',	'Kilomètre par heure',	'Km/h'),
(5,	'Distance',	'Centimètre',	'cm'),
(6,	'Distance',	'Mètre',	'm'),
(7,	'Concentration',	'Pied cube',	'cf');
