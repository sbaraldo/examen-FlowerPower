-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 04 jun 2022 om 21:16
-- Serverversie: 5.7.31
-- PHP-versie: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowerpower1`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

DROP TABLE IF EXISTS `artikel`;
CREATE TABLE IF NOT EXISTS `artikel` (
  `idartikel` int(11) NOT NULL AUTO_INCREMENT,
  `omschrijving` varchar(45) NOT NULL,
  `prijs` int(45) NOT NULL,
  PRIMARY KEY (`idartikel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel_has_factuur`
--

DROP TABLE IF EXISTS `artikel_has_factuur`;
CREATE TABLE IF NOT EXISTS `artikel_has_factuur` (
  `artikel_idartikel` int(11) NOT NULL,
  `factuur_idfactuur` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `factuur`
--

DROP TABLE IF EXISTS `factuur`;
CREATE TABLE IF NOT EXISTS `factuur` (
  `idfactuur` int(11) NOT NULL AUTO_INCREMENT,
  `idklant` int(11) NOT NULL,
  `idwinkel` int(11) NOT NULL,
  `idmedewerker` int(11) NOT NULL,
  `datum` date NOT NULL,
  `afgehaald` tinyint(4) NOT NULL,
  PRIMARY KEY (`idfactuur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

DROP TABLE IF EXISTS `klant`;
CREATE TABLE IF NOT EXISTS `klant` (
  `idklant` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) NOT NULL,
  `tussenvoegsel` varchar(45) NOT NULL,
  `achternaam` varchar(45) NOT NULL,
  `adres` varchar(45) NOT NULL,
  `huisnummer` varchar(45) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `plaats` varchar(45) NOT NULL,
  `telefoon` varchar(10) NOT NULL,
  `geboortedatum` date NOT NULL,
  `email` varchar(254) NOT NULL,
  `wachtwoord` varchar(45) NOT NULL,
  `wachtwoordbv` varchar(45) NOT NULL,
  PRIMARY KEY (`idklant`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerker`
--

DROP TABLE IF EXISTS `medewerker`;
CREATE TABLE IF NOT EXISTS `medewerker` (
  `idmedewerker` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) NOT NULL,
  `tussenvoegsel` varchar(45) NOT NULL,
  `achternaam` varchar(45) NOT NULL,
  `wachtwoord` varchar(45) NOT NULL,
  PRIMARY KEY (`idmedewerker`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `medewerker`
--

INSERT INTO `medewerker` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`) VALUES
(1, 'Stefan', '', 'Baraldo', '1234'),
(2, 'Klaas', '', 'Boer', '12345'),
(6, 'Real', 'van', 'Madrid', 'naruto'),
(5, 'romeo', '', 'knol', 'hoi123');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `winkel`
--

DROP TABLE IF EXISTS `winkel`;
CREATE TABLE IF NOT EXISTS `winkel` (
  `idwinkel` int(11) NOT NULL AUTO_INCREMENT,
  `winkeladres` varchar(45) NOT NULL,
  `winkelhuisnummer` varchar(45) NOT NULL,
  `winkelpostcode` varchar(6) NOT NULL,
  `winkelplaats` varchar(45) NOT NULL,
  `winkeltelefoon` varchar(10) NOT NULL,
  `winkelemail` varchar(254) NOT NULL,
  PRIMARY KEY (`idwinkel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
