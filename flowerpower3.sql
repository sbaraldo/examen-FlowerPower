-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 11 jul 2022 om 01:42
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
-- Database: `flowerpower3`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `adminuser`
--

DROP TABLE IF EXISTS `adminuser`;
CREATE TABLE IF NOT EXISTS `adminuser` (
  `idadmin` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) NOT NULL,
  `tussenvoegsel` varchar(45) DEFAULT NULL,
  `achternaam` varchar(45) NOT NULL,
  `email` varchar(254) NOT NULL,
  `wachtwoord` varchar(254) NOT NULL,
  `rol` int(11) NOT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `adminuser`
--

INSERT INTO `adminuser` (`idadmin`, `voornaam`, `tussenvoegsel`, `achternaam`, `email`, `wachtwoord`, `rol`) VALUES
(22, 'Stefan', '', 'Baraldo', 'stefan@gmail.com', 'Baraldo', 1),
(23, 'chris', '', 'houkes', 'chris@gmail.com', '1234', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

DROP TABLE IF EXISTS `artikel`;
CREATE TABLE IF NOT EXISTS `artikel` (
  `idartikel` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) NOT NULL,
  `omschrijving` varchar(254) NOT NULL,
  `prijs` int(11) NOT NULL,
  `foto` varchar(254) NOT NULL,
  PRIMARY KEY (`idartikel`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `artikel`
--

INSERT INTO `artikel` (`idartikel`, `naam`, `omschrijving`, `prijs`, `foto`) VALUES
(4, 'Rode Roos', 'Rode roos uit Nederland', 20, 'IMG-62cb3921d7d758.04095960.jpg'),
(32, 'Roze roos', 'Roze roos', 40, 'IMG-62cb0db6d67187.71383734.jpg'),
(33, 'Zonnebloem', 'Mooi zonnebloem', 40, 'IMG-62cb0dd0142f10.59122794.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

DROP TABLE IF EXISTS `bestelling`;
CREATE TABLE IF NOT EXISTS `bestelling` (
  `idbestelling` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `totaalproduct` varchar(254) NOT NULL,
  `totaalprijs` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Afwachting',
  PRIMARY KEY (`idbestelling`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`idbestelling`, `userid`, `totaalproduct`, `totaalprijs`, `status`) VALUES
(50, 2, ', Rode Roos (2), Zonnebloemen (1), Roze roos (1)', 100, 'Afwachting'),
(51, 2, ', Zonnebloem (2), Rode Roos (3), Roze roos (1)', 180, 'Afwachting'),
(52, 3, ', Zonnebloem (3), Roze roos (2), Rode Roos (1)', 220, 'Afwachting');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) NOT NULL,
  `tussenvoegsel` varchar(45) DEFAULT NULL,
  `achternaam` varchar(45) NOT NULL,
  `adres` varchar(45) NOT NULL,
  `huisnummer` varchar(45) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `plaats` varchar(45) NOT NULL,
  `telefoon` varchar(10) NOT NULL,
  `geboortedatum` date NOT NULL,
  `email` varchar(254) NOT NULL,
  `wachtwoord` varchar(254) NOT NULL,
  `wachtwoordbv` varchar(254) NOT NULL,
  `rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`iduser`, `voornaam`, `tussenvoegsel`, `achternaam`, `adres`, `huisnummer`, `postcode`, `plaats`, `telefoon`, `geboortedatum`, `email`, `wachtwoord`, `wachtwoordbv`, `rol`) VALUES
(6, 'Ken', '', 'Kaneki', 'teststraat', '1', '1234QW', 'Almere', '1234567890', '1999-07-13', 'kaneki@gmail.com', '1234', '1234', NULL),
(2, 'Renato', '', 'Daman', 'Lotusbloemweg', '20', '1338VX', 'Almere', '0639328632', '1998-01-13', 'r.daman@gmail.com', 'test', 'test', NULL),
(3, 'Romeo', '', 'Boer', 'Parkwijklaan', '22', '1111AA', 'Almere', '0671525291', '1996-07-11', 'romeo@gmail.com', '1234', '1234', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `winkelwagen`
--

DROP TABLE IF EXISTS `winkelwagen`;
CREATE TABLE IF NOT EXISTS `winkelwagen` (
  `idwinkelwagen` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `artikelid` int(11) NOT NULL,
  `naam` varchar(45) DEFAULT NULL,
  `omschrijving` varchar(254) DEFAULT NULL,
  `prijs` int(11) DEFAULT NULL,
  `aantal` int(11) DEFAULT NULL,
  `foto` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`idwinkelwagen`)
) ENGINE=MyISAM AUTO_INCREMENT=272 DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
