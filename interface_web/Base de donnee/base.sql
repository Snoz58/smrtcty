-- Adminer 4.5.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

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

INSERT INTO `Data` (`Id`, `Date`, `Value`, `fk_IdNode`, `fk_IdUnits`, `fk_IdSensor`) VALUES
(38,	'2018-04-01 09:00:00',	30,	1,	4,	0),
(39,	'2018-04-02 09:00:00',	21,	1,	4,	0),
(40,	'2018-04-03 09:00:00',	31,	1,	4,	0),
(41,	'2018-04-04 09:00:00',	38,	1,	4,	0),
(42,	'2018-04-05 09:00:00',	36,	1,	4,	0),
(43,	'2018-04-06 09:00:00',	33,	1,	4,	0),
(44,	'2018-04-07 09:00:00',	32,	1,	4,	0),
(45,	'2018-04-08 09:00:00',	32,	1,	4,	0),
(46,	'2018-04-09 09:00:00',	36,	1,	4,	0),
(47,	'2018-04-10 09:00:00',	27,	1,	4,	0),
(48,	'2018-04-11 09:00:00',	35,	1,	4,	0),
(49,	'2018-04-12 09:00:00',	38,	1,	4,	0),
(50,	'2018-04-13 09:00:00',	38,	1,	4,	0),
(51,	'2018-04-14 09:00:00',	35,	1,	4,	0),
(52,	'2018-04-15 09:00:00',	38,	1,	4,	0),
(53,	'2018-04-16 09:00:00',	35,	1,	4,	0),
(54,	'2018-04-17 09:00:00',	25,	1,	4,	0),
(55,	'2018-04-18 09:00:00',	35,	1,	4,	0),
(56,	'2018-04-19 09:00:00',	31,	1,	4,	0),
(57,	'2018-04-20 09:00:00',	36,	1,	4,	0),
(58,	'2018-04-21 09:00:00',	29,	1,	4,	0),
(59,	'2018-04-22 09:00:00',	37,	1,	4,	0),
(60,	'2018-04-23 09:00:00',	40,	1,	4,	0),
(61,	'2018-04-24 09:00:00',	35,	1,	4,	0),
(62,	'2018-04-25 09:00:00',	27,	1,	4,	0),
(63,	'2018-04-26 09:00:00',	23,	1,	4,	0),
(64,	'2018-04-27 09:00:00',	28,	1,	4,	0),
(65,	'2018-04-28 09:00:00',	20,	1,	4,	0),
(66,	'2018-04-29 09:00:00',	26,	1,	4,	0),
(67,	'2018-04-30 09:00:00',	21,	1,	4,	0);

DROP TABLE IF EXISTS `Node`;
CREATE TABLE `Node` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Lat` float(10,6) NOT NULL,
  `Long` float(10,6) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Node` (`Id`, `Nom`, `Lat`, `Long`) VALUES
(1,	'Jeanne d\'Arc',	46.989040,	3.153046),
(2,	'Conseil ',	46.993881,	3.163317),
(3,	'Place Carnot',	46.988720,	3.157285);

DROP TABLE IF EXISTS `Sensor`;
CREATE TABLE `Sensor` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_IdNode` int(11) NOT NULL,
  `fk_IdUnits` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_IdNode` (`fk_IdNode`),
  KEY `fk_IdUnits` (`fk_IdUnits`),
  CONSTRAINT `Sensor_ibfk_1` FOREIGN KEY (`fk_IdNode`) REFERENCES `Node` (`Id`),
  CONSTRAINT `Sensor_ibfk_2` FOREIGN KEY (`fk_IdUnits`) REFERENCES `Units` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Sensor` (`Id`, `Nom`, `fk_IdNode`, `fk_IdUnits`) VALUES
(0,	'az',	1,	1);

DROP TABLE IF EXISTS `Units`;
CREATE TABLE `Units` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Label` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Unite` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Symbol` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Units` (`Id`, `Label`, `Unite`, `Symbol`) VALUES
(1,	'Temperature',	'Degrés Celcius',	'°C'),
(2,	'Pression',	'Hectopascal',	'Hpa'),
(3,	'Consommation electrique',	'KiloWatt par heure',	'KW/h'),
(4,	'Vitesse',	'Kilomètre par heure',	'Km/h');

DROP TABLE IF EXISTS `Utilisateurs`;
CREATE TABLE `Utilisateurs` (
  `Login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `Utilisateurs` (`Login`, `Password`, `Role`) VALUES
('',	'',	'');

DROP TABLE IF EXISTS `Ville`;
CREATE TABLE `Ville` (
  `Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Adresse` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Code postal` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Numéro` char(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2018-06-28 13:55:29
